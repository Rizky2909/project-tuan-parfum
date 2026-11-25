<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengirimanController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Tampilkan antarmuka daftar pengantaran mobile-first untuk kurir
     */
    public function index(Request $request)
    {
        $kurir = Auth::user();

        // Ambil pesanan yang ditugaskan ke kurir ini
        $query = Order::with(['items.parfum', 'user'])
            ->where('kurir_id', $kurir->id);

        $filterStatus = $request->query('status', 'diproses');

        if ($filterStatus && $filterStatus !== 'semua') {
            $query->where('status', $filterStatus);
        }

        $orders = $query->latest()->get();

        // Hitungan per status untuk tab
        $counts = [
            'diproses' => Order::where('kurir_id', $kurir->id)->where('status', 'diproses')->count(),
            'dikirim'  => Order::where('kurir_id', $kurir->id)->where('status', 'dikirim')->count(),
            'selesai'  => Order::where('kurir_id', $kurir->id)->where('status', 'selesai')->count(),
            'semua'    => Order::where('kurir_id', $kurir->id)->count(),
        ];

        return view('pages.kurir.pengiriman', compact('orders', 'counts', 'filterStatus'));
    }

    /**
     * Kurir memulai pengantaran (Status: diproses -> dikirim)
     */
    public function startDelivery($id)
    {
        $kurir = Auth::user();
        $order = Order::where('id', $id)
            ->where('kurir_id', $kurir->id)
            ->firstOrFail();

        try {
            $this->orderService->startDelivery($order, $kurir);

            return back()->with('success', "Pengantaran untuk pesanan #{$order->kode_order} telah dimulai!");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Kurir menyelesaikan pengantaran (Status: dikirim -> selesai)
     */
    public function completeDelivery(Request $request, $id)
    {
        $request->validate([
            'bukti_pengiriman' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'catatan_kurir'    => 'nullable|string|max:255',
        ]);

        $kurir = Auth::user();
        $order = Order::where('id', $id)
            ->where('kurir_id', $kurir->id)
            ->firstOrFail();

        try {
            $this->orderService->completeDelivery(
                $order,
                $kurir,
                $request->file('bukti_pengiriman'),
                $request->catatan_kurir
            );

            return back()->with('success', "Pesanan #{$order->kode_order} berhasil diselesaikan. Terima kasih!");
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
