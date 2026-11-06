@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
  <div class="p-5 mb-4 bg-light rounded-3 text-center">
    <h1>Selamat Datang di Toko Tuan Parfum</h1>
    <p class="lead">Pesan parfum favorit Anda dari Sungai Bangek tanpa harus datang ke toko.</p>
    <a href="{{ route('katalog') }}" class="btn btn-primary btn-lg">Lihat Katalog</a>
  </div>
  <div class="row text-center">
    <div class="col-md-4"><h5>Katalog Lengkap</h5><p>Lihat harga, kategori, dan stok parfum.</p></div>
    <div class="col-md-4"><h5>Pesan Mudah</h5><p>Keranjang, checkout, dan pembayaran dalam satu sistem.</p></div>
    <div class="col-md-4"><h5>Pantau Pesanan</h5><p>Status pesanan dapat dipantau kapan saja.</p></div>
  </div>
@endsection