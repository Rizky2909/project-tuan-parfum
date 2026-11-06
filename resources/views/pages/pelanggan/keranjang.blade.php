@extends('layouts.app')
@section('title', 'Keranjang')
@section('content')
  <h2 class="mb-3">Keranjang Belanja</h2>
  <div class="row">
    <div class="col-md-8">
      <table class="table align-middle">
        <thead><tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr></thead>
        <tbody>
          <tr>
            <td>Parfum 1 <br><small class="text-muted">100 ml</small></td>
            <td>Rp 150.000</td>
            <td style="width:110px"><input type="number" class="form-control form-control-sm" value="2" min="1" max="20"></td>
            <td>Rp 300.000</td>
            <td><button class="btn btn-sm btn-danger">Hapus</button></td>
          </tr>
          <tr>
            <td>Parfum 2 <br><small class="text-muted">50 ml</small></td>
            <td>Rp 90.000</td>
            <td><input type="number" class="form-control form-control-sm" value="1" min="1" max="10"></td>
            <td>Rp 90.000</td>
            <td><button class="btn btn-sm btn-danger">Hapus</button></td>
          </tr>
        </tbody>
      </table>
      <a href="{{ route('katalog') }}">&larr; Lanjut Belanja</a>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5>Ringkasan</h5>
        <div class="d-flex justify-content-between"><span>Jumlah item</span><span>3</span></div>
        <div class="d-flex justify-content-between fw-bold"><span>Total</span><span>Rp 390.000</span></div>
        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mt-3">Checkout</a>
      </div></div>
    </div>
  </div>
@endsection