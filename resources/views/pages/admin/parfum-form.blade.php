@extends('layouts.admin')
@section('title', isset($id) ? 'Ubah Parfum' : 'Tambah Parfum')
@section('content')
  <h2 class="mb-3">{{ isset($id) ? 'Ubah Parfum' : 'Tambah Parfum' }}</h2>
  <form action="#" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-8">
        <div class="mb-3"><label class="form-label">Nama Parfum</label><input type="text" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Kategori</label>
          <select class="form-select"><option>Floral</option><option>Woody</option><option>Fresh</option></select>
        </div>
        <div class="row">
          <div class="col-md-4 mb-3"><label class="form-label">Volume (ml)</label><input type="number" class="form-control"></div>
          <div class="col-md-4 mb-3"><label class="form-label">Harga</label><input type="number" class="form-control"></div>
          <div class="col-md-4 mb-3"><label class="form-label">Stok</label><input type="number" class="form-control"></div>
        </div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" rows="4"></textarea></div>
      </div>
      <div class="col-md-4">
        <label class="form-label">Foto Produk</label>
        <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-2" style="height:200px">Preview</div>
        <input type="file" class="form-control" accept="image/*">
      </div>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.parfum') }}" class="btn btn-outline-secondary">Batal</a>
  </form>
@endsection