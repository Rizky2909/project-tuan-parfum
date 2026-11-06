@extends('layouts.app')
@section('title', 'Profil')
@section('content')
  <div class="row">
    <div class="col-md-3 text-center mb-3">
      <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:120px;height:120px">Foto</div>
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">Data Profil</a>
        <a href="#" class="list-group-item list-group-item-action">Ubah Password</a>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card"><div class="card-body">
        <h4 class="mb-3">Data Profil</h4>
        <form action="#" method="POST">
          <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" value="Nama Pelanggan"></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" value="pelanggan@contoh.com"></div>
          <div class="mb-3"><label class="form-label">Nomor HP</label><input type="text" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Alamat</label><textarea class="form-control" rows="3"></textarea></div>
          <button class="btn btn-primary">Simpan Perubahan</button>
          <a href="{{ route('profil') }}" class="btn btn-outline-secondary">Batal</a>
        </form>
      </div></div>
    </div>
  </div>
@endsection