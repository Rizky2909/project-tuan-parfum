<?php

use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Kurir\PengirimanController as KurirPengirimanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParfumController;
use App\Models\Parfum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. Halaman Publik (Katalog & Informasi)
// ==========================================
Route::get('/', function () {
    $parfums = Parfum::latest()->get();
    return view('pages.beranda', compact('parfums'));
})->name('beranda');

Route::get('/katalog', function (Request $request) {
    $query = Parfum::query();
    if ($request->filled('q')) {
        $q = trim($request->q);
        $query->where(function ($w) use ($q) {
            $w->where('nama', 'like', "%{$q}%")
              ->orWhere('deskripsi', 'like', "%{$q}%");
        });
    }
    if ($request->filled('kategori') && $request->kategori !== 'Semua') {
        $query->where('kategori', $request->kategori);
    }
    $parfums = $query->latest()->get();
    return view('pages.pelanggan.katalog', compact('parfums'));
})->name('katalog');

Route::get('/katalog/{id}', function ($id) {
    $parfum = Parfum::findOrFail($id);
    return view('pages.pelanggan.detail', compact('id', 'parfum'));
})->name('katalog.detail');

// ==========================================
// 2. Autentikasi Pengguna
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. Area Pelanggan (Wajib Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Keranjang Belanja
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang', [CartController::class, 'store'])->name('keranjang.store');
    Route::put('/keranjang/{id}', [CartController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/clear', [CartController::class, 'clear'])->name('keranjang.clear');
    Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('keranjang.destroy');

    // Buku Alamat
    Route::get('/profil/alamat', [AddressController::class, 'index'])->name('alamat.index');
    Route::post('/profil/alamat', [AddressController::class, 'store'])->name('alamat.store');
    Route::put('/profil/alamat/{id}', [AddressController::class, 'update'])->name('alamat.update');
    Route::delete('/profil/alamat/{id}', [AddressController::class, 'destroy'])->name('alamat.destroy');
    Route::post('/profil/alamat/{id}/default', [AddressController::class, 'setDefault'])->name('alamat.default');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // Pembayaran & Upload Bukti Transfer
    Route::get('/pembayaran/{kode_order}', [OrderController::class, 'showPayment'])->name('pembayaran');
    Route::post('/pembayaran/{kode_order}/bukti', [OrderController::class, 'uploadBuktiBayar'])->name('pembayaran.upload');

    // Pesanan Pelanggan
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/{kode_order}', [OrderController::class, 'show'])->name('pesanan.detail');
    Route::post('/pesanan/{kode_order}/batal', [OrderController::class, 'cancel'])->name('pesanan.batal');
    Route::post('/pesanan/{kode_order}/terima', [OrderController::class, 'confirmReceived'])->name('pesanan.terima');

    // Profil Pelanggan
    Route::get('/profil', function () {
        $user = auth()->user();
        $addresses = $user->addresses()->latest()->get();
        return view('pages.pelanggan.profil', compact('user', 'addresses'));
    })->name('profil');

    Route::post('/profil', function (Request $request) {
        $user = auth()->user();
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update($request->only('name', 'email'));
        return back()->with('success', 'Profil akun Anda berhasil diperbarui.');
    })->name('profil.update');
});

// ==========================================
// 4. Area Admin (Role: Admin Saja)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard dengan metrik nyata
    Route::get('/dashboard', [AdminOrderController::class, 'dashboard'])->name('dashboard');

    // CRUD Produk Wewangian
    Route::get('/parfum', [ParfumController::class, 'index'])->name('parfum');
    Route::get('/parfum/create', [ParfumController::class, 'create'])->name('parfum.create');
    Route::post('/parfum', [ParfumController::class, 'store'])->name('parfum.store');
    Route::get('/parfum/{id}/edit', [ParfumController::class, 'edit'])->name('parfum.edit');
    Route::put('/parfum/{id}', [ParfumController::class, 'update'])->name('parfum.update');
    Route::delete('/parfum/{id}', [ParfumController::class, 'destroy'])->name('parfum.destroy');

    // Manajemen Pesanan
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/{id}', [AdminOrderController::class, 'show'])->name('pesanan.detail');
    Route::post('/pesanan/{id}/verifikasi', [AdminOrderController::class, 'verifyPayment'])->name('pesanan.verifikasi');
    Route::post('/pesanan/{id}/tolak', [AdminOrderController::class, 'rejectPayment'])->name('pesanan.tolak');
    Route::post('/pesanan/{id}/kurir', [AdminOrderController::class, 'assignCourier'])->name('pesanan.kurir');
    Route::post('/pesanan/{id}/batal', [AdminOrderController::class, 'cancel'])->name('pesanan.batal');

    // Menu Manajemen Lainnya
    Route::view('/stok', 'pages.admin.stok')->name('stok');
    Route::view('/kategori', 'pages.admin.kategori')->name('kategori');
    Route::view('/laporan', 'pages.admin.laporan')->name('laporan');
});

// ==========================================
// 5. Area Kurir (Role: Kurir Saja)
// ==========================================
Route::prefix('kurir')->name('kurir.')->middleware(['auth', 'role:kurir'])->group(function () {
    Route::get('/pengiriman', [KurirPengirimanController::class, 'index'])->name('pengiriman');
    Route::post('/pengiriman/{id}/mulai', [KurirPengirimanController::class, 'startDelivery'])->name('pengiriman.mulai');
    Route::post('/pengiriman/{id}/selesai', [KurirPengirimanController::class, 'completeDelivery'])->name('pengiriman.selesai');
});
