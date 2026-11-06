@extends('layouts.app')
@section('title', 'Registrasi')
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card"><div class="card-body">
        <h3 class="text-center mb-4">Daftar Akun</h3>
        <form action="#" method="POST">
          <div class="mb-3"><label class="form-label">Nama Lengkap</label><input type="text" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" required></div>
          <div class="mb-3"><label class="form-label">Konfirmasi Password</label><input type="password" class="form-control" required></div>
          <button class="btn btn-primary w-100">Daftar</button>
        </form>
        <p class="text-center mt-3 mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
      </div></div>
    </div>
  </div>
@endsection