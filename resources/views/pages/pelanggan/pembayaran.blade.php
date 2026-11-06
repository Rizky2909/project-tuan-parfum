@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Pembayaran Pesanan #TP-0001</h2>
    <span class="badge bg-warning text-dark fs-6">Menunggu Pembayaran</span>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-3"><div class="card-body">
        <h5>Instruksi Pembayaran</h5>
        <p class="mb-1">Total: <strong>Rp 390.000</strong></p>
        <p class="mb-1">Batas waktu: 1x24 jam</p>
        <p class="mb-1">Rekening tujuan: Bank XXX 1234567890 a.n. Tuan Parfum</p>
        <div class="bg-secondary text-white d-flex align-items-center justify-content-center mt-2" style="height:180px;width:180px">QR Code</div>
      </div></div>
    </div>
    <div class="col-md-6">
      <div class="card"><div class="card-body">
        <h5>Konfirmasi Pembayaran</h5>
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="mb-3"><label class="form-label">Nama Pengirim</label><input type="text" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Tanggal Bayar</label><input type="date" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Jumlah Dibayar</label><input type="number" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Bukti Transfer</label><input type="file" class="form-control" accept="image/*" required></div>
          <button class="btn btn-primary w-100">Kirim Bukti Pembayaran</button>
        </form>
      </div></div>
    </div>
  </div>
@endsection