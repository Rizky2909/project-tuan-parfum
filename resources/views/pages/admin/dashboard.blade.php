@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
  <h2 class="mb-4">Dashboard</h2>
  <div class="row mb-4">
    <div class="col-md-3"><div class="card text-white bg-primary"><div class="card-body"><small>Pesanan Baru</small><h3>5</h3></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-warning"><div class="card-body"><small>Menunggu Verifikasi</small><h3>3</h3></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-success"><div class="card-body"><small>Penjualan Bulan Ini</small><h3>Rp 4.500.000</h3></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-danger"><div class="card-body"><small>Stok Menipis</small><h3>2</h3></div></div></div>
  </div>

  <div class="row">
    <div class="col-md-7">
      <div class="card mb-3"><div class="card-body">
        <h5>Grafik Penjualan</h5>
        <div class="bg-light d-flex align-items-center justify-content-center" style="height:220px">Area grafik</div>
      </div></div>
    </div>
    <div class="col-md-5">
      <div class="card mb-3"><div class="card-body">
        <h5>Stok Menipis</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between">Parfum 3 <span class="badge bg-danger">2</span></li>
          <li class="list-group-item d-flex justify-content-between">Parfum 7 <span class="badge bg-danger">4</span></li>
        </ul>
      </div></div>
    </div>
  </div>

  <div class="card"><div class="card-body">
    <h5>Pesanan Terbaru</h5>
    <table class="table table-sm">
      <thead><tr><th>No</th><th>Pelanggan</th><th>Total</th><th>Status</th></tr></thead>
      <tbody>
        <tr><td>#TP-0001</td><td>Budi</td><td>Rp 390.000</td><td><span class="badge bg-primary">Dikemas</span></td></tr>
        <tr><td>#TP-0002</td><td>Sari</td><td>Rp 150.000</td><td><span class="badge bg-warning text-dark">Menunggu Pembayaran</span></td></tr>
      </tbody>
    </table>
  </div></div>
@endsection