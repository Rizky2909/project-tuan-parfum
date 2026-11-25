<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Tampilkan formulir checkout pemesanan
     */
    public function index()
    {
        $user = Auth::user();

        $cartItems = CartItem::with('parfum')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('keranjang')
                ->with('info', 'Keranjang belanja Anda kosong. Silakan pilih wewangian terlebih dahulu.');
        }

        // Cek stok kembali sebelum checkout
        foreach ($cartItems as $item) {
            if ($item->parfum->stok < $item->qty) {
                return redirect()->route('keranjang')
                    ->with('error', "Stok untuk '{$item->parfum->nama}' tidak mencukupi (Tersisa: {$item->parfum->stok} botol). Silakan sesuaikan jumlah pesanan.");
            }
        }

        $addresses = Address::where('user_id', $user->id)
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        $selectedAddress = $addresses->firstWhere('is_default', true) ?? $addresses->first();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        $freeShippingThreshold = 500000;
        $isFreeShipping = $subtotal >= $freeShippingThreshold;
        $remainingForFreeShipping = max(0, $freeShippingThreshold - $subtotal);

        // Estimasi ongkir default kurir toko
        $defaultOngkir = $this->orderService->calculateShipping('kurir_toko', $subtotal);
        $defaultTotal = $subtotal + $defaultOngkir;

        return view('pages.pelanggan.checkout', compact(
            'cartItems',
            'addresses',
            'selectedAddress',
            'subtotal',
            'isFreeShipping',
            'remainingForFreeShipping',
            'defaultOngkir',
            'defaultTotal'
        ));
    }

    /**
     * Proses pembuatan pesanan secara atomik
     */
    public function process(Request $request)
    {
        $request->validate([
            'metode_pengiriman' => 'required|in:kurir_toko,ambil_di_toko',
            'metode_pembayaran' => 'required|in:transfer_bank,cod',
            'address_id'        => 'required_if:metode_pengiriman,kurir_toko',
            'catatan_pembeli'   => 'nullable|string|max:500',
            'no_hp'             => 'nullable|string|max:20',
        ], [
            'metode_pengiriman.required' => 'Pilih salah satu metode pengiriman.',
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
            'address_id.required_if'     => 'Pilih atau tambahkan alamat pengiriman untuk Kurir Toko.',
        ]);

        $user = Auth::user();

        try {
            $order = $this->orderService->checkout($user, $request->all());

            if ($order->metode_pembayaran === 'transfer_bank') {
                return redirect()->route('pembayaran', $order->kode_order)
                    ->with('success', 'Pesanan berhasil dibuat! Silakan selesaikan pembayaran transfer bank Anda.');
            }

            // Jika COD, langsung diarahkan ke detail pesanan
            return redirect()->route('pesanan.detail', $order->kode_order)
                ->with('success', 'Pesanan COD berhasil dibuat! Kurir kami akan mengonfirmasi sebelum pengantaran.');
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
