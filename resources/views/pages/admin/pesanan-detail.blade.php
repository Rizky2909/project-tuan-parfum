@extends('layouts.admin')
@section('title', 'Detail Pesanan')
@section('content')
  <h2 class="mb-3">Detail Pesanan #TP-000{{ $id }} <span class="badge bg-warning text-dark fs-6">Menunggu Pembayaran</span></h2>
  <form action="#" method="POST">
    <div class="row">
      <div class="col-md-7">
        <div class="card mb-3"><div class="card-body">
          <h5>Data Pelanggan</h5>
          <p class="mb-1">Nama: Budi</p>
          <p class="mb-1">Tanggal: 28 Okt 2026</p>
          <p class="mb-1">No. HP: 08xx-xxxx-xxxx</p>
          <p class="mb-0">Alamat: Jl. Contoh No. 1, Padang</p>
        </div></div>
        <div class="card"><div class="card-body">
          <h5>Rincian Produk</h5>
          <table class="table table-sm">
            <thead><tr><th>Produk</th><th>Jumlah</th><th>Harga</th></tr></thead>
            <tbody>
              <tr><td>Parfum 1</td><td>2</td><td>Rp 300.000</td></tr>
              <tr><td>Parfum 2</td><td>1</td><td>Rp 90.000</td></tr>
            </tbody>
            <tfoot><tr class="fw-bold"><td colspan="2">Total</td><td>Rp 390.000</td></tr></tfoot>
          </table>
        </div></div>
      </div>
      <div class="col-md-5">
        <div class="card mb-3"><div class="card-body">
          <h5>Bukti Pembayaran</h5>
          <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-3" style="height:200px">Bukti Transfer</div>
          <button type="button" class="btn btn-success">Valid</button>
          <button type="button" class="btn btn-danger">Tidak Valid</button>
        </div></div>
        <div class="card"><div class="card-body">
          <div class="mb-3"><label class="form-label">Status Pesanan</label>
            <select class="form-select">
              <option>Menunggu Pembayaran</option><option>Diproses</option><option>Dikemas</option>
              <option>Dikirim</option><option>Selesai</option><option>Dibatalkan</option>
            </select>
          </div>
          <div class="mb-3"><label class="form-label">Kurir</label>
            <select class="form-select"><option>Pilih kurir</option><option>Kurir 1</option><option>Kurir 2</option></select>
          </div>
          <button class="btn btn-primary w-100">Simpan Perubahan</button>
        </div></div>
      </div>
    </div>
  </form>
@endsection