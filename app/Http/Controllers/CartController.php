<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Parfum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('parfum')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        // Threshold gratis ongkir: Rp 500.000
        $freeShippingThreshold = 500000;
        $isFreeShipping = $subtotal >= $freeShippingThreshold;
        $remainingForFreeShipping = max(0, $freeShippingThreshold - $subtotal);
        $progressPercent = min(100, (int) round(($subtotal / $freeShippingThreshold) * 100));

        return view('pages.pelanggan.keranjang', compact(
            'cartItems',
            'subtotal',
            'isFreeShipping',
            'remainingForFreeShipping',
            'progressPercent'
        ));
    }

    /**
     * Tambahkan wewangian ke keranjang
     */
    public function store(Request $request)
    {
        $request->validate([
            'parfum_id' => 'required|exists:parfums,id',
            'qty'       => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $parfum = Parfum::findOrFail($request->parfum_id);
        $qtyToAdd = (int) ($request->qty ?? 1);

        if ($parfum->stok < 1) {
            return back()->with('error', "Maaf, stok wewangian '{$parfum->nama}' sedang habis.");
        }

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('parfum_id', $parfum->id)
            ->first();

        $existingQty = $cartItem ? $cartItem->qty : 0;
        $newQty = $existingQty + $qtyToAdd;

        if ($newQty > $parfum->stok) {
            return back()->with('error', "Jumlah melebihi stok yang tersedia (Sisa stok: {$parfum->stok} botol).");
        }

        if ($cartItem) {
            $cartItem->update(['qty' => $newQty]);
        } else {
            CartItem::create([
                'user_id'   => $user->id,
                'parfum_id' => $parfum->id,
                'qty'       => $newQty,
            ]);
        }

        if ($request->has('beli_sekarang')) {
            return redirect()->route('checkout');
        }

        return redirect()->route('keranjang')
            ->with('success', "'{$parfum->nama}' berhasil ditambahkan ke keranjang belanja.");
    }

    /**
     * Perbarui jumlah (qty) produk di keranjang
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cartItem = CartItem::with('parfum')
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $parfum = $cartItem->parfum;
        $newQty = (int) $request->qty;

        if ($newQty > $parfum->stok) {
            return back()->with('error', "Jumlah pesanan melebihi ketersediaan stok ({$parfum->stok} botol).");
        }

        $cartItem->update(['qty' => $newQty]);

        return back()->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $namaParfum = $cartItem->parfum->nama ?? 'Produk';
        $cartItem->delete();

        return back()->with('success', "'{$namaParfum}' telah dihapus dari keranjang.");
    }

    /**
     * Kosongkan seluruh isi keranjang
     */
    public function clear()
    {
        $user = Auth::user();
        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('keranjang')
            ->with('info', 'Keranjang belanja telah dikosongkan.');
    }
}
