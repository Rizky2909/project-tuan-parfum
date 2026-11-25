<?php

namespace App\Services;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Models\Parfum;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    /**
     * Hitung ongkos kirim berdasarkan metode dan subtotal
     */
    public function calculateShipping(string $metodePengiriman, int $subtotal): int
    {
        if ($metodePengiriman === 'ambil_di_toko') {
            return 0;
        }

        // Untuk kurir_toko (Kota Padang): gratis jika belanja >= 500.000, selain itu flat 15.000
        if ($subtotal >= 500000) {
            return 0;
        }

        return 15000;
    }

    /**
     * Generate kode order unik: TP-YYYYMMDD-XXXX
     */
    public function generateOrderCode(): string
    {
        $date = now()->format('Ymd');

        do {
            $random = strtoupper(Str::random(4));
            $kode = "TP-{$date}-{$random}";
        } while (Order::where('kode_order', $kode)->exists());

        return $kode;
    }

    /**
     * Eksekusi Checkout dengan transaksi atomik dan pengurangan stok
     */
    public function checkout(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {
            $cartItems = CartItem::with('parfum')
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Keranjang belanja Anda masih kosong.',
                ]);
            }

            // Validasi ketersediaan stok aktual
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $parfum = $item->parfum;

                if (!$parfum) {
                    throw ValidationException::withMessages([
                        'cart' => 'Produk di keranjang tidak ditemukan.',
                    ]);
                }

                if ($parfum->stok < $item->qty) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok untuk wewangian '{$parfum->nama}' tidak mencukupi (Tersisa: {$parfum->stok} botol).",
                    ]);
                }

                $subtotal += ($item->qty * $parfum->harga);
            }

            // Kurangi stok produk segera
            foreach ($cartItems as $item) {
                $item->parfum->decrement('stok', $item->qty);
            }

            $metodePengiriman = $data['metode_pengiriman'];
            $ongkir = $this->calculateShipping($metodePengiriman, $subtotal);
            $totalHarga = $subtotal + $ongkir;
            $metodePembayaran = $data['metode_pembayaran'];

            // Setup Snapshot Alamat
            if ($metodePengiriman === 'ambil_di_toko') {
                $penerimaNama = $user->name;
                $penerimaHp = $data['no_hp'] ?? ($user->defaultAddress()?->no_hp ?? '-');
                $alamatPengiriman = 'Toko Fisik Tuan Parfum, Jl. Raya Sungai Bangek, RT 02 / RW 05, Kelurahan Balai Gadang, Koto Tangah, Kota Padang';
                $kecamatan = 'Koto Tangah';
                $kota = 'Padang';
                $patokan = 'Depan Kampus / Pusat Toko Tuan Parfum';
            } else {
                $address = Address::where('user_id', $user->id)
                    ->where('id', $data['address_id'])
                    ->first();

                if (!$address) {
                    throw ValidationException::withMessages([
                        'address_id' => 'Alamat pengiriman tidak ditemukan.',
                    ]);
                }

                $penerimaNama = $address->nama_penerima;
                $penerimaHp = $address->no_hp;
                $alamatPengiriman = $address->alamat_lengkap;
                $kecamatan = $address->kecamatan;
                $kota = $address->kota;
                $patokan = $address->patokan;
            }

            // Tentukan status awal
            // COD langsung diproses, Transfer Bank menunggu bukti pembayaran
            $initialStatus = ($metodePembayaran === 'cod')
                ? 'diproses'
                : 'menunggu_pembayaran';

            $order = Order::create([
                'kode_order'        => $this->generateOrderCode(),
                'user_id'           => $user->id,
                'kurir_id'          => null,
                'penerima_nama'     => $penerimaNama,
                'penerima_hp'       => $penerimaHp,
                'alamat_pengiriman' => $alamatPengiriman,
                'kecamatan'         => $kecamatan,
                'kota'              => $kota,
                'patokan'           => $patokan,
                'metode_pengiriman' => $metodePengiriman,
                'metode_pembayaran' => $metodePembayaran,
                'subtotal'          => $subtotal,
                'ongkir'            => $ongkir,
                'total_harga'       => $totalHarga,
                'catatan_pembeli'   => $data['catatan_pembeli'] ?? null,
                'status'            => $initialStatus,
            ]);

            // Buat snapshot item pesanan
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'parfum_id'    => $item->parfum_id,
                    'nama_parfum'  => $item->parfum->nama,
                    'volume'       => $item->parfum->volume,
                    'harga_satuan' => $item->parfum->harga,
                    'qty'          => $item->qty,
                    'subtotal'     => $item->qty * $item->parfum->harga,
                ]);
            }

            // Catat log status awal
            $keteranganAwal = ($metodePembayaran === 'cod')
                ? 'Pesanan berhasil dibuat (Metode COD - Bayar di Tempat). Sedang disiapkan.'
                : 'Pesanan berhasil dibuat. Menunggu bukti transfer bank.';

            OrderStatusLog::create([
                'order_id'   => $order->id,
                'status'     => $initialStatus,
                'keterangan' => $keteranganAwal,
                'changed_by' => $user->id,
                'created_at' => now(),
            ]);

            // Kosongkan keranjang belanja
            CartItem::where('user_id', $user->id)->delete();

            return $order;
        });
    }

    /**
     * Upload Bukti Transfer oleh Pelanggan
     */
    public function uploadBuktiBayar(Order $order, $file, User $user): Order
    {
        if (!in_array($order->status, ['menunggu_pembayaran', 'menunggu_verifikasi'], true)) {
            throw new \Exception('Pesanan tidak dalam status menunggu pembayaran.');
        }

        $fileName = 'bukti_' . $order->kode_order . '_' . time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('images/bukti-bayar');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);
        $relativePath = 'images/bukti-bayar/' . $fileName;

        $order->update([
            'bukti_bayar'   => $relativePath,
            'status'        => 'menunggu_verifikasi',
            'dibayar_at'    => now(),
            'catatan_admin' => null, // reset catatan penolakan jika ada
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'menunggu_verifikasi',
            'keterangan' => 'Pelanggan mengunggah bukti pembayaran transfer bank. Menunggu verifikasi admin.',
            'changed_by' => $user->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Verifikasi Bukti Pembayaran oleh Admin
     */
    public function verifyPaymentProof(Order $order, User $admin): Order
    {
        if ($order->status !== 'menunggu_verifikasi') {
            throw new \Exception('Hanya pesanan berstatus menunggu verifikasi yang dapat disetujui.');
        }

        $order->update([
            'status'        => 'diproses',
            'catatan_admin' => null,
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'diproses',
            'keterangan' => 'Bukti pembayaran disetujui dan diverifikasi oleh Admin. Pesanan siap dikemas.',
            'changed_by' => $admin->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Tolak Bukti Pembayaran oleh Admin
     */
    public function rejectPaymentProof(Order $order, string $alasan, User $admin): Order
    {
        if ($order->status !== 'menunggu_verifikasi') {
            throw new \Exception('Pesanan tidak dalam status menunggu verifikasi.');
        }

        $order->update([
            'status'        => 'menunggu_pembayaran',
            'catatan_admin' => $alasan,
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'menunggu_pembayaran',
            'keterangan' => "Bukti pembayaran ditolak oleh Admin: {$alasan}. Silakan unggah kembali bukti transfer yang valid.",
            'changed_by' => $admin->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Penugasan Kurir oleh Admin
     */
    public function assignCourier(Order $order, int $kurirId, ?string $nomorResi, User $admin): Order
    {
        $kurir = User::where('id', $kurirId)->where('role', 'kurir')->firstOrFail();

        $order->update([
            'kurir_id'   => $kurir->id,
            'nomor_resi' => $nomorResi ?: $order->nomor_resi,
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => $order->status,
            'keterangan' => "Kurir pengantar ditugaskan: {$kurir->name}." . ($nomorResi ? " (No. Resi: {$nomorResi})" : ''),
            'changed_by' => $admin->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Kurir Mulai Mengantar Pesanan
     */
    public function startDelivery(Order $order, User $kurir): Order
    {
        if ($order->kurir_id !== $kurir->id) {
            throw new \Exception('Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== 'diproses') {
            throw new \Exception('Pesanan belum siap diantar.');
        }

        $order->update([
            'status'     => 'dikirim',
            'dikirim_at' => now(),
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'dikirim',
            'keterangan' => "Kurir ({$kurir->name}) telah memulai perjalanan mengantar pesanan ke alamat tujuan.",
            'changed_by' => $kurir->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Kurir Menyelesaikan Pengantaran
     */
    public function completeDelivery(Order $order, User $kurir, $buktiFoto = null, ?string $catatan = null): Order
    {
        if ($order->kurir_id !== $kurir->id && $kurir->role !== 'admin') {
            throw new \Exception('Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== 'dikirim') {
            throw new \Exception('Pesanan tidak dalam status sedang dikirim.');
        }

        $buktiPath = $order->bukti_pengiriman;
        if ($buktiFoto) {
            $fileName = 'antar_' . $order->kode_order . '_' . time() . '.' . $buktiFoto->getClientOriginalExtension();
            $destinationPath = public_path('images/bukti-pengiriman');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $buktiFoto->move($destinationPath, $fileName);
            $buktiPath = 'images/bukti-pengiriman/' . $fileName;
        }

        $order->update([
            'status'           => 'selesai',
            'bukti_pengiriman' => $buktiPath,
            'catatan_kurir'    => $catatan,
            'selesai_at'       => now(),
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'selesai',
            'keterangan' => 'Pesanan berhasil diserahkan kepada penerima. Pengiriman selesai.' . ($catatan ? " Catatan: {$catatan}" : ''),
            'changed_by' => $kurir->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Pelanggan Konfirmasi Pesanan Diterima
     */
    public function confirmReceived(Order $order, User $customer): Order
    {
        if ($order->user_id !== $customer->id) {
            throw new \Exception('Anda tidak memiliki hak akses pesanan ini.');
        }

        if ($order->status !== 'dikirim') {
            throw new \Exception('Pesanan belum dalam status dikirim.');
        }

        $order->update([
            'status'     => 'selesai',
            'selesai_at' => now(),
        ]);

        OrderStatusLog::create([
            'order_id'   => $order->id,
            'status'     => 'selesai',
            'keterangan' => 'Pelanggan telah mengonfirmasi bahwa pesanan wewangian telah diterima dengan baik.',
            'changed_by' => $customer->id,
            'created_at' => now(),
        ]);

        return $order;
    }

    /**
     * Pembatalan Pesanan dengan Auto-Restock Stok Produk
     */
    public function cancelOrder(Order $order, string $alasan, User $user): Order
    {
        return DB::transaction(function () use ($order, $alasan, $user) {
            // Jika sudah dibatalkan atau selesai, hentikan
            if ($order->status === 'dibatalkan') {
                return $order;
            }

            if ($order->status === 'selesai') {
                throw new \Exception('Pesanan yang sudah selesai tidak dapat dibatalkan.');
            }

            // Jika pelanggan yang batalkan, hanya boleh jika menunggu_pembayaran
            if ($user->role === 'pelanggan') {
                if ($order->user_id !== $user->id) {
                    throw new \Exception('Akses ditolak.');
                }
                if ($order->status !== 'menunggu_pembayaran') {
                    throw new \Exception('Pesanan yang sudah diproses atau diverifikasi tidak dapat dibatalkan mandiri oleh pelanggan.');
                }
            }

            // Kembalikan stok untuk setiap item produk (Auto-Restock)
            $order->load('items');
            foreach ($order->items as $item) {
                if ($item->parfum_id) {
                    Parfum::where('id', $item->parfum_id)->increment('stok', $item->qty);
                }
            }

            $order->update([
                'status'       => 'dibatalkan',
                'alasan_batal' => $alasan,
            ]);

            $actor = $user->role === 'admin' ? 'Admin' : 'Pelanggan';
            OrderStatusLog::create([
                'order_id'   => $order->id,
                'status'     => 'dibatalkan',
                'keterangan' => "Pesanan dibatalkan ({$actor}): {$alasan}. Stok produk telah dikembalikan ke inventaris.",
                'changed_by' => $user->id,
                'created_at' => now(),
            ]);

            return $order;
        });
    }
}
