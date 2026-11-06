@extends('layouts.admin')
@section('title', 'Laporan Penjualan')
@section('content')
  <h2 class="mb-3">Laporan Penjualan</h2>
  <form class="row g-2 mb-4">
    <div class="col-md-3"><label class="form-label">Tanggal Awal</label><input type="date" class="form-control"></div>
    <div class="col-md-3"><label class="form-label">Tanggal Akhir</label><input type="date" class="form-control"></div>
    <div class="col-md-6 d-flex align-items-end gap-2">
      <button class="btn btn-primary">Tampilkan</button>
      <button type="button" class="btn btn-outline-secondary" onclick="window.print()">Cetak</button>
    </div>
  </form>

  <div class="row mb-4">
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Total Pesanan</small><h3>12</h3></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Total Penjualan</small><h3>Rp 4.500.000</h3></div></div></div>
    <div class="col-md-4"><div class="card"><div class="card-body"><small>Produk Terjual</small><h3>30</h3></div></div></div>
  </div>

  <table class="table table-bordered">
    <thead class="table-light"><tr><th>No Pesanan</th><th>Tanggal</th><th>Produk</th><th>Jumlah</th><th>Total</th></tr></thead>
    <tbody>
      <tr><td>#TP-0001</td><td>28 Okt 2026</td><td>Parfum 1, Parfum 2</td><td>3</td><td>Rp 390.000</td></tr>
      <tr><td>#TP-0003</td><td>26 Okt 2026</td><td>Parfum 4</td><td>1</td><td>Rp 120.000</td></tr>
    </tbody>
    <tfoot><tr class="fw-bold"><td colspan="4">Total</td><td>Rp 510.000</td></tr></tfoot>
  </table>
@endsection