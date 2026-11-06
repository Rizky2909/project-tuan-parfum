@extends('layouts.admin')
@section('title', 'Kelola Pesanan')
@section('content')
  <h2 class="mb-3">Kelola Pesanan</h2>
  <ul class="nav nav-pills mb-3">
    <li class="nav-item"><a class="nav-link active" href="#">Semua</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Menunggu Pembayaran</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Diproses</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Dikemas</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Dikirim</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Selesai</a></li>
    <li class="nav-item"><a class="nav-link" href="#">Dibatalkan</a></li>
  </ul>
  <input type="text" class="form-control mb-3" placeholder="Cari nomor pesanan atau nama pelanggan...">
  <table class="table table-bordered align-middle">
    <thead class="table-light"><tr><th>No Pesanan</th><th>Pelanggan</th><th>Tanggal</th><th>Total</th><th>Pembayaran</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      <tr><td>#TP-0001</td><td>Budi</td><td>28 Okt 2026</td><td>Rp 390.000</td><td><span class="badge bg-success">Valid</span></td><td><span class="badge bg-primary">Dikemas</span></td><td><a href="{{ route('admin.pesanan.detail', 1) }}" class="btn btn-sm btn-primary">Detail</a></td></tr>
      <tr><td>#TP-0002</td><td>Sari</td><td>27 Okt 2026</td><td>Rp 150.000</td><td><span class="badge bg-warning text-dark">Belum Diperiksa</span></td><td><span class="badge bg-warning text-dark">Menunggu Pembayaran</span></td><td><a href="{{ route('admin.pesanan.detail', 2) }}" class="btn btn-sm btn-primary">Detail</a></td></tr>
    </tbody>
  </table>
@endsection