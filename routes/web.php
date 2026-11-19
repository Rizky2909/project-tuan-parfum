<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParfumController;
use App\Models\Parfum;
use Illuminate\Support\Facades\Route;

// ===== Halaman Publik =====
Route::get('/', function () {
    $parfums = Parfum::latest()->get();
    return view('pages.beranda', compact('parfums'));
})->name('beranda');

Route::get('/katalog', function (\Illuminate\Http\Request $request) {
    $query = Parfum::query();
    if ($request->filled('q')) {
        $q = $request->q;
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
    $parfum = Parfum::find($id);
    return view('pages.pelanggan.detail', compact('id', 'parfum'));
})->name('katalog.detail');

// ===== Autentikasi Pengguna =====
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== Area Pelanggan (Wajib Login) =====
Route::middleware(['auth'])->group(function () {
    Route::view('/keranjang', 'pages.pelanggan.keranjang')->name('keranjang');
    Route::view('/checkout', 'pages.pelanggan.checkout')->name('checkout');
    Route::view('/pembayaran', 'pages.pelanggan.pembayaran')->name('pembayaran');
    Route::view('/pesanan', 'pages.pelanggan.pesanan')->name('pesanan');
    Route::view('/profil', 'pages.pelanggan.profil')->name('profil');
});

// ===== Area Admin (Hanya Role Admin) =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');

    // CRUD Produk Parfum
    Route::get('/parfum', [ParfumController::class, 'index'])->name('parfum');
    Route::get('/parfum/create', [ParfumController::class, 'create'])->name('parfum.create');
    Route::post('/parfum', [ParfumController::class, 'store'])->name('parfum.store');
    Route::get('/parfum/{id}/edit', [ParfumController::class, 'edit'])->name('parfum.edit');
    Route::put('/parfum/{id}', [ParfumController::class, 'update'])->name('parfum.update');
    Route::delete('/parfum/{id}', [ParfumController::class, 'destroy'])->name('parfum.destroy');

    // Menu Manajemen Lainnya
    Route::view('/stok', 'pages.admin.stok')->name('stok');
    Route::view('/kategori', 'pages.admin.kategori')->name('kategori');
    Route::view('/pesanan', 'pages.admin.pesanan')->name('pesanan');
    Route::get('/pesanan/{id}', function ($id) {
        return view('pages.admin.pesanan-detail', ['id' => $id]);
    })->name('pesanan.detail');
    Route::view('/laporan', 'pages.admin.laporan')->name('laporan');
});

// ===== Area Kurir (Hanya Role Kurir) =====
Route::middleware(['auth', 'role:kurir'])->group(function () {
    Route::view('/kurir/pengiriman', 'pages.kurir.pengiriman')->name('kurir.pengiriman');
});
