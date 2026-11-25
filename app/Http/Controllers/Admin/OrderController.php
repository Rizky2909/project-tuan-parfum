<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Parfum;
use App\Models\User;
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
     * Tampilkan data dashboard statistik admin dengan metrik nyata
     */
    public function dashboard()
    {
        // 1. Total Pendapatan dari pesanan yang selesai
        $totalPendapatan = Order::where('status', 'selesai')->sum('total_harga');

        // 2. Pesanan Menunggu Verifikasi
        $menungguVerifikasiCount = Order::where('status', 'menunggu_verifikasi')->count();

        // 3. Pesanan Baru / Menunggu Pembayaran
        $menungguPembayaranCount = Order::where('status', 'menunggu_pembayaran')->count();

        // 4. Pesanan Perlu Diproses & Dikirim
        $perluDikirimCount = Order::where('status', 'diproses')->count();

        // 5. Total Pesanan Selesai
        $pesananSelesaiCount = Order::where('status', 'selesai')->count();

        // 6. Peringatan Stok Rendah (<= 5)
        $stokRendah = Parfum::where('stok', '<=', 5)->get();
        $stokRendahCount = $stokRendah->count();

        // 7. 5 Pesanan Terbaru
        $pesananTerbaru = Order::with(['user', 'items'])
            ->latest()
            ->take(5)
            ->get();

        return view('pages.admin.dashboard', compact(
            'totalPendapatan',
            'menungguVerifikasiCount',
            'menungguPembayaranCount',
            'perluDikirimCount',
            'pesananSelesaiCount',
            'stokRendah',
            'stokRendahCount',
            'pesananTerbaru'
        ));
    }

    /**
     * Tampilkan daftar pesanan masuk untuk dikelola Admin
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'kurir', 'items']);

        // Filter status
        $filterStatus = $request->query('status');
        if ($filterStatus && $filterStatus !== 'semua') {
            $query->where('status', $filterStatus);
        }

        // Pencarian kode order atau nama pelanggan/penerima
        if ($request->filled('q')) {
            $q = trim($request->query('q'));
            $query->where(function ($w) use ($q) {
                $w->where('kode_order', 'like', "%{$q}%")
                  ->orWhere('penerima_nama', 'like', "%{$q}%")
                  ->orWhereHas('user', function ($u) use ($q) {
                      $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                  });
            });
        }

        $orders = $query->latest()->get();

        // Hitungan per status untuk counter badge tab
        $counts = [
            'semua'               => Order::count(),
            'menunggu_pembayaran' => Order::where('status', 'menunggu_pembayaran')->count(),
            'menunggu_verifikasi' => Order::where('status', 'menunggu_verifikasi')->count(),
            'diproses'            => Order::where('status', 'diproses')->count(),
            'dikirim'             => Order::where('status', 'dikirim')->count(),
            'selesai'             => Order::where('status', 'selesai')->count(),
            'dibatalkan'          => Order::where('status', 'dibatalkan')->count(),
        ];

        return view('pages.admin.pesanan', compact('orders', 'counts', 'filterStatus'));
    }

    /**
     * Tampilkan detail & panel kontrol pesanan Admin
     */
    public function show($id)
    {
        $order = Order::with(['user', 'kurir', 'items.parfum', 'statusLogs.changer'])
            ->where('id', $id)
            ->orWhere('kode_order', $id)
            ->firstOrFail();

        // Daftar kurir aktif yang bisa ditugaskan
        $kurirList = User::where('role', 'kurir')->orderBy('name')->get();

        return view('pages.admin.pesanan-detail', compact('order', 'kurirList'));
    }

    /**
     * Verifikasi bukti pembayaran valid
     */
    public function verifyPayment(Request $request, $id)
    {
        $admin = Auth::user();
        $order = Order::findOrFail($id);

        try {
            $this->orderService->verifyPaymentProof($order, $admin);

            return back()->with('success', "Bukti pembayaran pesanan #{$order->kode_order} berhasil diverifikasi!");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Tolak bukti pembayaran tidak valid
     */
    public function rejectPayment(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255',
        ], [
            'alasan_penolakan.required' => 'Wajib menyertakan alasan penolakan bukti transfer.',
        ]);

        $admin = Auth::user();
        $order = Order::findOrFail($id);

        try {
            $this->orderService->rejectPaymentProof($order, $request->alasan_penolakan, $admin);

            return back()->with('info', "Bukti pembayaran pesanan #{$order->kode_order} telah ditolak dan pelanggan diminta mengunggah ulang.");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Penugasan kurir pengantar
     */
    public function assignCourier(Request $request, $id)
    {
        $request->validate([
            'kurir_id'   => 'required|exists:users,id',
            'nomor_resi' => 'nullable|string|max:50',
        ], [
            'kurir_id.required' => 'Pilih salah satu kurir untuk ditugaskan.',
        ]);

        $admin = Auth::user();
        $order = Order::findOrFail($id);

        try {
            $this->orderService->assignCourier($order, (int) $request->kurir_id, $request->nomor_resi, $admin);

            return back()->with('success', 'Kurir pengantar berhasil ditugaskan ke pesanan ini.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Pembatalan pesanan oleh Admin + Restock otomatis
     */
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'alasan_batal' => 'required|string|max:255',
        ], [
            'alasan_batal.required' => 'Mohon isi alasan pembatalan pesanan.',
        ]);

        $admin = Auth::user();
        $order = Order::findOrFail($id);

        try {
            $this->orderService->cancelOrder($order, $request->alasan_batal, $admin);

            return back()->with('info', "Pesanan #{$order->kode_order} berhasil dibatalkan dan stok wewangian telah dikembalikan.");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
