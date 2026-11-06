<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ===== Publik =====
Route::view('/', 'pages.beranda')->name('beranda');

Route::view('/katalog', 'pages.pelanggan.katalog')->name('katalog');
Route::get('/katalog/{id}', function ($id) {
    return view('pages.pelanggan.detail', ['id' => $id]);
})->name('katalog.detail');

// ===== Auth =====
Route::view('/login', 'pages.auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::view('/register', 'pages.auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== Pelanggan (harus login) =====
Route::middleware(['auth'])->group(function () {
    Route::view('/keranjang', 'pages.pelanggan.keranjang')->name('keranjang');
    Route::view('/pesanan', 'pages.pelanggan.pesanan')->name('pesanan');
    Route::view('/profil', 'pages.pelanggan.profil')->name('profil');
});

// ===== Admin (hanya role admin) =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');
    Route::view('/parfum', 'pages.admin.parfum')->name('parfum');
    Route::view('/parfum/create', 'pages.admin.parfum-form')->name('parfum.create');
    Route::get('/parfum/{id}/edit', function ($id) {
        return view('pages.admin.parfum-form', ['id' => $id]);
    })->name('parfum.edit');
    Route::view('/stok', 'pages.admin.stok')->name('stok');
    Route::view('/kategori', 'pages.admin.kategori')->name('kategori');
    Route::view('/pesanan', 'pages.admin.pesanan')->name('pesanan');
    Route::get('/pesanan/{id}', function ($id) {
        return view('pages.admin.pesanan-detail', ['id' => $id]);
    })->name('pesanan.detail');
    Route::view('/laporan', 'pages.admin.laporan')->name('laporan');
});

// ===== Kurir (hanya role kurir) =====
Route::middleware(['auth', 'role:kurir'])->group(function () {
    Route::view('/kurir/pengiriman', 'pages.kurir.pengiriman')->name('kurir.pengiriman');
});