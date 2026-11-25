<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Models\Parfum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seed data untuk akun Admin, Kurir, Pelanggan, Produk, Alamat, dan Sampel Pesanan.
     */
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@tuanparfum.com'],
            [
                'name'     => 'Admin Tuan Parfum',
                'password' => Hash::make('admin'),
                'role'     => 'admin',
            ]
        );

        // 2. Akun Kurir
        $kurir = User::updateOrCreate(
            ['email' => 'kurir@tuanparfum.com'],
            [
                'name'     => 'Kurir Tuan Parfum',
                'password' => Hash::make('kurir'),
                'role'     => 'kurir',
            ]
        );

        // 3. Akun Pelanggan Contoh
        $pelanggan = User::updateOrCreate(
            ['email' => 'pelanggan@tuanparfum.com'],
            [
                'name'     => 'Budi Prasetyo',
                'password' => Hash::make('123'),
                'role'     => 'pelanggan',
            ]
        );

        // 4. Sampel Produk Parfum
        $parfumsData = [
            [
                'nama'      => 'Oud Imperial Extrait',
                'kategori'  => 'Unisex',
                'volume'    => 100,
                'harga'     => 650000,
                'stok'      => 20,
                'deskripsi' => 'Perpaduan agarwood Kamboja langka dengan sentuhan amber resin dan vanilla madagascar hangat.',
                'foto'      => null,
            ],
            [
                'nama'      => 'Santal Velvet',
                'kategori'  => 'Pria',
                'volume'    => 100,
                'harga'     => 520000,
                'stok'      => 15,
                'deskripsi' => 'Keharuman kayu cendana Mysore berpadu dengan rempah kapulaga dan cedarwood elegan.',
                'foto'      => null,
            ],
            [
                'nama'      => 'Rose Ébène',
                'kategori'  => 'Wanita',
                'volume'    => 100,
                'harga'     => 580000,
                'stok'      => 18,
                'deskripsi' => 'Mawar damaskus misterius yang dipadukan dengan kayu eboni gelap dan sentuhan patchouli lembut.',
                'foto'      => null,
            ],
            [
                'nama'      => 'Bergamot Drift',
                'kategori'  => 'Unisex',
                'volume'    => 100,
                'harga'     => 480000,
                'stok'      => 25,
                'deskripsi' => 'Kesegaran bergamot Calabria dengan aroma laut segar dan sentuhan vetiver aromatik.',
                'foto'      => null,
            ],
        ];

        $parfums = [];
        foreach ($parfumsData as $item) {
            $parfums[$item['nama']] = Parfum::updateOrCreate(
                ['nama' => $item['nama']],
                $item
            );
        }

        // 5. Sampel Alamat Pelanggan
        $alamat1 = Address::updateOrCreate(
            [
                'user_id' => $pelanggan->id,
                'label'   => 'Rumah',
            ],
            [
                'nama_penerima'  => 'Budi Prasetyo',
                'no_hp'          => '081234567890',
                'alamat_lengkap' => 'Jl. Raya Sungai Bangek, RT 02 / RW 05, Kelurahan Balai Gadang',
                'kecamatan'      => 'Koto Tangah',
                'kota'           => 'Padang',
                'kode_pos'       => '25175',
                'patokan'        => 'Pagar hitam depan pos satpam',
                'is_default'     => true,
            ]
        );

        Address::updateOrCreate(
            [
                'user_id' => $pelanggan->id,
                'label'   => 'Kantor',
            ],
            [
                'nama_penerima'  => 'Budi Prasetyo (Kantor)',
                'no_hp'          => '081234567890',
                'alamat_lengkap' => 'Jl. Khatib Sulaiman No. 42',
                'kecamatan'      => 'Padang Utara',
                'kota'           => 'Padang',
                'kode_pos'       => '25133',
                'patokan'        => 'Lantai 2 Gedung Graha',
                'is_default'     => false,
            ]
        );

        // 6. Sampel Orders Lintas Status
        // Order 1: Menunggu Verifikasi
        $order1 = Order::updateOrCreate(
            ['kode_order' => 'TP-20261122-A101'],
            [
                'user_id'           => $pelanggan->id,
                'kurir_id'          => null,
                'penerima_nama'     => $alamat1->nama_penerima,
                'penerima_hp'       => $alamat1->no_hp,
                'alamat_pengiriman' => $alamat1->alamat_lengkap,
                'kecamatan'         => $alamat1->kecamatan,
                'kota'              => $alamat1->kota,
                'patokan'           => $alamat1->patokan,
                'metode_pengiriman' => 'kurir_toko',
                'metode_pembayaran' => 'transfer_bank',
                'subtotal'          => 650000,
                'ongkir'            => 0, // gratis karena >= 500k
                'total_harga'       => 650000,
                'catatan_pembeli'   => 'Mohon bubble wrap tebal untuk gift.',
                'status'            => 'menunggu_verifikasi',
                'bukti_bayar'       => null,
                'dibayar_at'        => now()->subHours(2),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'nama_parfum' => 'Oud Imperial Extrait'],
            [
                'parfum_id'    => $parfums['Oud Imperial Extrait']->id,
                'volume'       => 100,
                'harga_satuan' => 650000,
                'qty'          => 1,
                'subtotal'     => 650000,
            ]
        );

        OrderStatusLog::firstOrCreate(
            ['order_id' => $order1->id, 'status' => 'menunggu_pembayaran'],
            [
                'keterangan' => 'Pesanan berhasil dibuat. Menunggu bukti transfer bank.',
                'changed_by' => $pelanggan->id,
                'created_at' => now()->subHours(3),
            ]
        );

        OrderStatusLog::firstOrCreate(
            ['order_id' => $order1->id, 'status' => 'menunggu_verifikasi'],
            [
                'keterangan' => 'Pelanggan mengunggah bukti transfer BCA. Menunggu verifikasi admin.',
                'changed_by' => $pelanggan->id,
                'created_at' => now()->subHours(2),
            ]
        );

        // Order 2: Sedang Dikirim (Ditugaskan ke Kurir)
        $order2 = Order::updateOrCreate(
            ['kode_order' => 'TP-20261122-B202'],
            [
                'user_id'           => $pelanggan->id,
                'kurir_id'          => $kurir->id,
                'penerima_nama'     => $alamat1->nama_penerima,
                'penerima_hp'       => $alamat1->no_hp,
                'alamat_pengiriman' => $alamat1->alamat_lengkap,
                'kecamatan'         => $alamat1->kecamatan,
                'kota'              => $alamat1->kota,
                'patokan'           => $alamat1->patokan,
                'metode_pengiriman' => 'kurir_toko',
                'metode_pembayaran' => 'cod',
                'subtotal'          => 480000,
                'ongkir'            => 15000,
                'total_harga'       => 495000,
                'catatan_pembeli'   => 'Telepon sebelum antar ke rumah.',
                'status'            => 'dikirim',
                'nomor_resi'        => 'KURIR-TP-01',
                'dikirim_at'        => now()->subMinutes(45),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'nama_parfum' => 'Bergamot Drift'],
            [
                'parfum_id'    => $parfums['Bergamot Drift']->id,
                'volume'       => 100,
                'harga_satuan' => 480000,
                'qty'          => 1,
                'subtotal'     => 480000,
            ]
        );

        OrderStatusLog::firstOrCreate(
            ['order_id' => $order2->id, 'status' => 'diproses'],
            [
                'keterangan' => 'Pesanan berhasil dibuat (Metode COD). Kurir ditugaskan: Kurir Tuan Parfum.',
                'changed_by' => $admin->id,
                'created_at' => now()->subHours(1),
            ]
        );

        OrderStatusLog::firstOrCreate(
            ['order_id' => $order2->id, 'status' => 'dikirim'],
            [
                'keterangan' => 'Kurir telah memulai perjalanan mengantar pesanan.',
                'changed_by' => $kurir->id,
                'created_at' => now()->subMinutes(45),
            ]
        );

        // Order 3: Selesai
        $order3 = Order::updateOrCreate(
            ['kode_order' => 'TP-20261120-C303'],
            [
                'user_id'           => $pelanggan->id,
                'kurir_id'          => $kurir->id,
                'penerima_nama'     => $alamat1->nama_penerima,
                'penerima_hp'       => $alamat1->no_hp,
                'alamat_pengiriman' => $alamat1->alamat_lengkap,
                'kecamatan'         => $alamat1->kecamatan,
                'kota'              => $alamat1->kota,
                'patokan'           => $alamat1->patokan,
                'metode_pengiriman' => 'ambil_di_toko',
                'metode_pembayaran' => 'transfer_bank',
                'subtotal'          => 520000,
                'ongkir'            => 0,
                'total_harga'       => 520000,
                'catatan_pembeli'   => null,
                'status'            => 'selesai',
                'dibayar_at'        => now()->subDays(2),
                'selesai_at'        => now()->subDays(2),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'nama_parfum' => 'Santal Velvet'],
            [
                'parfum_id'    => $parfums['Santal Velvet']->id,
                'volume'       => 100,
                'harga_satuan' => 520000,
                'qty'          => 1,
                'subtotal'     => 520000,
            ]
        );

        OrderStatusLog::firstOrCreate(
            ['order_id' => $order3->id, 'status' => 'selesai'],
            [
                'keterangan' => 'Pesanan diambil dan selesai di toko fisik Tuan Parfum.',
                'changed_by' => $admin->id,
                'created_at' => now()->subDays(2),
            ]
        );
    }
}
