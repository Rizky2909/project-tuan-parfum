@extends('layouts.app')
@section('title', 'Pesanan Saya')
@section('content')
  <h2 class="mb-3">Pesanan Saya</h2>
  <ul class="nav nav-pills mb-3">
    <li class="nav-item"><a class="nav-link active" href="#">Semua</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Menunggu Pembayaran</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Diproses</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Dikemas</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Dikirim</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Selesai</a></li>
  </ul>

  <div class="row">
    <div class="col-md-4">
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
          <div class="d-flex justify-content-between"><strong>#TP-0001</strong><span class="badge bg-light text-dark">Dikemas</span></div>
          <small>28 Okt 2026 • Rp 390.000</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <div class="d-flex justify-content-between"><strong>#TP-0002</strong><span class="badge bg-warning text-dark">Menunggu</span></div>
          <small>27 Okt 2026 • Rp 150.000</small>
        </a>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card"><div class="card-body">
        <h5>Detail Pesanan #TP-0001</h5>
        <div class="d-flex justify-content-between text-center my-3">
          <span class="badge bg-success">Menunggu Pembayaran</span>
          <span class="badge bg-success">Diproses</span>
          <span class="badge bg-primary">Dikemas</span>
          <span class="badge bg-secondary">Dikirim</span>
          <span class="badge bg-secondary">Selesai</span>
        </div>
        <table class="table table-sm">
          <thead><tr><th>Produk</th><th>Jumlah</th><th>Harga</th></tr></thead>
          <tbody>
            <tr><td>Parfum 1</td><td>2</td><td>Rp 300.000</td></tr>
            <tr><td>Parfum 2</td><td>1</td><td>Rp 90.000</td></tr>
          </tbody>
        </table>
        <p class="mb-1">Alamat: Jl. Contoh No. 1, Padang</p>
        <p class="mb-1">Metode bayar: Transfer Bank</p>
        <p class="fw-bold">Total: Rp 390.000</p>
        <button class="btn btn-outline-danger">Ajukan Pembatalan</button>
      </div></div>
    </div>
  </div>
@endsection