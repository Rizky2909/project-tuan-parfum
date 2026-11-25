<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Tampilkan riwayat pesanan pelanggan dengan filter status
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Order::with(['items.parfum', 'kurir'])
            ->where('user_id', $user->id);

        $filterStatus = $request->query('status');

        if ($filterStatus && $filterStatus !== 'semua') {
            $query->where('status', $filterStatus);
        }

        $orders = $query->latest()->get();

        // Counter untuk badge tab
        $counts = [
            'semua'               => Order::where('user_id', $user->id)->count(),
            'menunggu_pembayaran' => Order::where('user_id', $user->id)->where('status', 'menunggu_pembayaran')->count(),
            'menunggu_verifikasi' => Order::where('user_id', $user->id)->where('status', 'menunggu_verifikasi')->count(),
            'diproses'            => Order::where('user_id', $user->id)->where('status', 'diproses')->count(),
            'dikirim'             => Order::where('user_id', $user->id)->where('status', 'dikirim')->count(),
            'selesai'             => Order::where('user_id', $user->id)->where('status', 'selesai')->count(),
            'dibatalkan'          => Order::where('user_id', $user->id)->where('status', 'dibatalkan')->count(),
        ];

        return view('pages.pelanggan.pesanan', compact('orders', 'counts', 'filterStatus'));
    }

    /**
     * Tampilkan detail pesanan spesifik
     */
    public function show($kode_order)
    {
        $user = Auth::user();
        $order = Order::with(['items.parfum', 'kurir', 'statusLogs.changer'])
            ->where('kode_order', $kode_order)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('pages.pelanggan.pesanan-detail', compact('order'));
    }

    /**
     * Tampilkan halaman instruksi pembayaran & upload bukti transfer
     */
    public function showPayment($kode_order)
    {
        $user = Auth::user();
        $order = Order::with('items')
            ->where('kode_order', $kode_order)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Data Rekening Resmi Tuan Parfum
        $rekeningInfo = [
            'bank'       => 'Bank Central Asia (BCA)',
            'nomor'      => '0321899201',
            'atas_nama'  => 'Tuan Parfum Official (M. Ihsan)',
            'cabang'     => 'KCU Padang',
        ];

        return view('pages.pelanggan.pembayaran', compact('order', 'rekeningInfo'));
    }

    /**
     * Proses unggah bukti pembayaran transfer bank
     */
    public function uploadBuktiBayar(Request $request, $kode_order)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'bukti_bayar.required' => 'Pilih file foto bukti transfer terlebih dahulu.',
            'bukti_bayar.image'    => 'File bukti transfer harus berupa gambar.',
            'bukti_bayar.mimes'    => 'Format gambar bukti transfer harus JPG, PNG, atau WEBP.',
            'bukti_bayar.max'      => 'Ukuran foto maksimal adalah 2 MB.',
        ]);

        $user = Auth::user();
        $order = Order::where('kode_order', $kode_order)
            ->where('user_id', $user->id)
            ->firstOrFail();

        try {
            $this->orderService->uploadBuktiBayar($order, $request->file('bukti_bayar'), $user);

            return redirect()->route('pesanan.detail', $order->kode_order)
                ->with('success', 'Bukti pembayaran berhasil diunggah! Admin kami akan segera memverifikasinya.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Pelanggan membatalkan pesanan (hanya untuk status menunggu_pembayaran)
     */
    public function cancel(Request $request, $kode_order)
    {
        $request->validate([
            'alasan_batal' => 'required|string|max:255',
        ], [
            'alasan_batal.required' => 'Mohon sertakan alasan pembatalan pesanan.',
        ]);

        $user = Auth::user();
        $order = Order::where('kode_order', $kode_order)
            ->where('user_id', $user->id)
            ->firstOrFail();

        try {
            $this->orderService->cancelOrder($order, $request->alasan_batal, $user);

            return redirect()->route('pesanan.detail', $order->kode_order)
                ->with('info', 'Pesanan berhasil dibatalkan dan stok wewangian telah dikembalikan.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Pelanggan konfirmasi pesanan telah diterima
     */
    public function confirmReceived($kode_order)
    {
        $user = Auth::user();
        $order = Order::where('kode_order', $kode_order)
            ->where('user_id', $user->id)
            ->firstOrFail();

        try {
            $this->orderService->confirmReceived($order, $user);

            return redirect()->route('pesanan.detail', $order->kode_order)
                ->with('success', 'Terima kasih telah mengonfirmasi penerimaan pesanan Tuan Parfum!');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
