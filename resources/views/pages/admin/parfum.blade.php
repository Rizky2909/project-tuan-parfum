@extends('layouts.admin')
@section('title', 'Data Parfum')
@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h2>Data Parfum</h2>
    <a href="{{ route('admin.parfum.create') }}" class="btn btn-primary">+ Tambah Parfum</a>
  </div>
  <input type="text" class="form-control mb-3" placeholder="Cari parfum...">
  <table class="table table-bordered align-middle">
    <thead class="table-light"><tr><th>No</th><th>Foto</th><th>Nama</th><th>Kategori</th><th>Volume</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach ([1,2,3] as $i)
      <tr>
        <td>{{ $i }}</td>
        <td><div class="bg-secondary" style="width:50px;height:50px"></div></td>
        <td>Parfum {{ $i }}</td><td>Floral</td><td>100 ml</td><td>Rp 150.000</td><td>20</td>
        <td>
          <a href="{{ route('admin.parfum.edit', $i) }}" class="btn btn-sm btn-warning">Ubah</a>
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <nav><ul class="pagination">
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
  </ul></nav>
@endsection