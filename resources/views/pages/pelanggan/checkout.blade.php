@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
  <h2 class="mb-3">Checkout</h2>
  <form action="#" method="POST">
    <div class="row">
      <div class="col-md-7">
        <div class="card mb-3"><div class="card-body">
          <h5>Alamat Pengiriman</h5>
          <div class="mb-3"><label class="form-label">Nama Penerima</label><input type="text" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Nomor HP</label><input type="text" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Alamat Lengkap</label><textarea class="form-control" rows="3" required></textarea></div>
          <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Kota</label><input type="text" class="form-control"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Kode Pos</label><input type="text" class="form-control"></div>
          </div>
        </div></div>
        <div class="card"><div class="card-body">
          <h5>Metode Pembayaran</h5>
          <div class="form-check"><input class="form-check-input" type="radio" name="metode" id="m1" checked><label class="form-check-label" for="m1">Transfer Bank</label></div>
          <div class="form-check"><input class="form-check-input" type="radio" name="metode" id="m2"><label class="form-check-label" for="m2">E-Wallet / QRIS</label></div>
          <small class="text-muted">Instruksi pembayaran akan muncul setelah pesanan dibuat.</small>
        </div></div>
      </div>
      <div class="col-md-5">
        <div class="card"><div class="card-body">
          <h5>Ringkasan Pesanan</h5>
          <div class="d-flex justify-content-between"><span>Parfum 1 x2</span><span>Rp 300.000</span></div>
          <div class="d-flex justify-content-between"><span>Parfum 2 x1</span><span>Rp 90.000</span></div>
          <hr>
          <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>Rp 390.000</span></div>
          <button class="btn btn-primary w-100 mt-3">Buat Pesanan</button>
        </div></div>
      </div>
    </div>
  </form>
@endsection