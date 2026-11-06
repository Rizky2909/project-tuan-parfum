@extends('layouts.app')
@section('title', 'Login')
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card"><div class="card-body">
        <h3 class="text-center mb-4">Masuk</h3>

        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Masuk</button>
        </form>
        <p class="text-center mt-3 mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
      </div></div>
    </div>
  </div>
@endsection