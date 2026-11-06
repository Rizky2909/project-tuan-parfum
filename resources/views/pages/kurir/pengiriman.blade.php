@extends('layouts.kurir')
@section('title', 'Daftar Pengiriman')
@section('content')
  <h2 class="mb-3">Daftar Pengiriman</h2>
  <div class="row">
    <div class="col-md-8">
      <table class="table table-bordered align-middle">
        <thead class="table-light"><tr><th>No Pesanan</th><th>Penerima</th><th>Alamat</th><th>No. HP</th><th>Status</th><th></th></tr></thead>
        <tbody>
          <tr><td>#TP-0001</td><td>Budi</td><td>Jl. Contoh No. 1</td><td>08xx-xxxx</td><td><span class="badge bg-info">Ditugaskan</span></td><td><button class="btn btn-sm btn-primary">Update</button></td></tr>
          <tr><td>#TP-0004</td><td>Sari</td><td>Jl. Mawar No. 5</td><td>08xx-xxxx</td><td><span class="badge bg-warning text-dark">Dalam Perjalanan</span></td><td><button class="btn btn-sm btn-primary">Update</button></td></tr>
          <tr><td>#TP-0005</td><td>Andi</td><td>Jl. Melati No. 9</td><td>08xx-xxxx</td><td><span class="badge bg-success">Terkirim</span></td><td><button class="btn btn-sm btn-primary">Update</button></td></tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5>Update Status</h5>
        <form action="#" method="POST">
          <div class="mb-3"><label class="form-label">Status</label>
            <select class="form-select"><option>Ditugaskan</option><option>Dalam Perjalanan</option><option>Terkirim</option></select>
          </div>
          <div class="mb-3"><label class="form-label">Catatan</label><textarea class="form-control" rows="3"></textarea></div>
          <button class="btn btn-primary w-100">Simpan Status</button>
        </form>
        <small class="text-muted">Jika status Terkirim, status pesanan otomatis menjadi Selesai.</small>
      </div></div>
    </div>
  </div>
@endsection