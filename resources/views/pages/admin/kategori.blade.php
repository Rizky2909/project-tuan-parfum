@extends('layouts.admin')
@section('title', 'Kategori Parfum')
@section('content')
  <h2 class="mb-3">Kategori Parfum</h2>
  <div class="row">
    <div class="col-md-7">
      <table class="table table-bordered align-middle">
        <thead class="table-light"><tr><th>No</th><th>Kategori</th><th>Jumlah Produk</th><th>Aksi</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Floral</td><td>5</td><td><button class="btn btn-sm btn-warning">Ubah</button> <button class="btn btn-sm btn-danger">Hapus</button></td></tr>
          <tr><td>2</td><td>Woody</td><td>3</td><td><button class="btn btn-sm btn-warning">Ubah</button> <button class="btn btn-sm btn-danger">Hapus</button></td></tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-5">
      <div class="card"><div class="card-body">
        <h5>Tambah / Ubah Kategori</h5>
        <form action="#" method="POST">
          <div class="mb-3"><label class="form-label">Nama Kategori</label><input type="text" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" rows="3"></textarea></div>
          <button class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-outline-secondary">Batal</button>
        </form>
      </div></div>
    </div>
  </div>
@endsection