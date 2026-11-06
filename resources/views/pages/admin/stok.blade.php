@extends('layouts.admin')
@section('title', 'Stok Parfum')
@section('content')
  <h2 class="mb-3">Stok Parfum</h2>
  <input type="text" class="form-control mb-3" placeholder="Cari parfum...">
  <form action="#" method="POST">
    <table class="table table-bordered align-middle">
      <thead class="table-light"><tr><th>Nama Parfum</th><th>Stok Saat Ini</th><th>Ubah Stok (+/-)</th><th>Status</th></tr></thead>
      <tbody>
        <tr><td>Parfum 1</td><td>20</td><td style="width:160px"><input type="number" class="form-control form-control-sm" value="0"></td><td><span class="badge bg-success">Aman</span></td></tr>
        <tr><td>Parfum 3</td><td>2</td><td><input type="number" class="form-control form-control-sm" value="0"></td><td><span class="badge bg-danger">Menipis</span></td></tr>
      </tbody>
    </table>
    <button class="btn btn-primary">Simpan</button>
  </form>
@endsection