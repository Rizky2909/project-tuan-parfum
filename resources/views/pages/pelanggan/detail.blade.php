@extends('layouts.app')
@section('title', 'Detail Parfum')
@section('content')
  <div class="row">
    <div class="col-md-5">
      <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-2" style="height:320px">Foto Utama</div>
      <div class="d-flex gap-2">
        <div class="bg-secondary flex-fill" style="height:70px"></div>
        <div class="bg-secondary flex-fill" style="height:70px"></div>
        <div class="bg-secondary flex-fill" style="height:70px"></div>
      </div>
    </div>
    <div class="col-md-7">
      <h2>Parfum {{ $id }}</h2>
      <p class="text-muted">Kategori: Floral • Volume: 100 ml</p>
      <h3 class="text-primary">Rp 150.000</h3>
      <span class="badge bg-success mb-3">Stok tersedia: 20</span>
      <p>Deskripsi aroma dan keterangan produk ditampilkan di sini.</p>

      <div class="input-group mb-3" style="max-width:160px">
        <button class="btn btn-outline-secondary" type="button">-</button>
        <input type="text" class="form-control text-center" value="1">
        <button class="btn btn-outline-secondary" type="button">+</button>
      </div>
      <button class="btn btn-primary">Tambah ke Keranjang</button>
      <a href="{{ route('katalog') }}" class="btn btn-outline-secondary">Kembali ke Katalog</a>
    </div>
  </div>
@endsection