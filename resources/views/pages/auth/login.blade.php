@extends('layouts.app')

@section('title', 'Masuk – Tuan Parfum')

@section('content')
<div class="flex items-center justify-center py-8">
  <div class="w-full max-w-md">

    <!-- Card Login Luxury Editorial -->
    <div class="card-luxury p-8 sm:p-10 rounded-sm bg-[#101623] border border-white/10">

      <!-- Title -->
      <div class="text-center mb-6">
        <span class="text-[10px] uppercase tracking-[0.25em] text-[#C9A227] font-semibold block mb-1">
          Akses Akun
        </span>
        <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Selamat Datang</h1>
        <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Masuk ke Akun Tuan Parfum</p>
      </div>

      <!-- Banner Konteks Intersepsi Pemesanan Guest (Sesuai Dokumentasi 7.2) -->
      @if (session('guest_order_info'))
        <div class="mb-6 p-3.5 rounded-sm bg-[#C9A227]/10 border border-[#C9A227]/40 text-[#C9A227] text-xs flex items-center gap-2.5">
          <i class="bi bi-info-circle text-base flex-shrink-0"></i>
          <span>{{ session('guest_order_info') }}</span>
        </div>
      @endif

      <!-- Error Alert -->
      @if ($errors->any())
        <div class="mb-6 p-3.5 rounded-sm bg-[#F87171]/10 border border-[#F87171]/30 text-[#F87171] text-xs tracking-wide">
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <!-- Info Alert -->
      @if (session('info'))
        <div class="mb-6 p-3.5 rounded-sm bg-[#60A5FA]/10 border border-[#60A5FA]/30 text-[#60A5FA] text-xs tracking-wide">
          <span>{{ session('info') }}</span>
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Username / Email
          </label>
          <input type="text" name="email" value="{{ old('email') }}" required autofocus
                 placeholder="admin atau nama@email.com"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Kata Sandi
          </label>
          <input type="password" name="password" required
                 placeholder="••••••••"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <button type="submit"
                class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider mt-2">
          Masuk Sekarang
        </button>
      </form>

      <!-- Kredensial Pengujian Akun Mahasiswa / Demo (Sesuai Dokumentasi 3.3) -->
      <div class="mt-6 p-3.5 rounded-sm bg-[#161E2E] border border-white/5 text-[11px] text-[#A0AAB9] space-y-1.5">
        <p class="text-[#C9A227] font-semibold uppercase tracking-wider text-[10px]">Akun Pengujian Demo:</p>
        <div class="flex justify-between border-b border-white/5 pb-1">
          <span>Admin: <strong class="text-white">admin</strong></span>
          <span>Password: <strong class="text-white">admin</strong></span>
        </div>
        <div class="flex justify-between border-b border-white/5 pb-1">
          <span>Kurir: <strong class="text-white">kurir@tuanparfum.com</strong></span>
          <span>Password: <strong class="text-white">kurir</strong></span>
        </div>
        <div class="flex justify-between">
          <span>Pelanggan: <strong class="text-white">pelanggan@tuanparfum.com</strong></span>
          <span>Password: <strong class="text-white">123</strong></span>
        </div>
      </div>

      <!-- Footer Links -->
      <div class="mt-6 pt-5 border-t border-white/10 text-center text-xs text-[#A0AAB9]">
        Belum memiliki akun?
        <a href="{{ route('register') }}" class="text-[#C9A227] hover:text-[#DFB942] font-semibold tracking-wide ml-1 transition-colors">
          Daftar di sini
        </a>
      </div>

    </div>

  </div>
</div>
@endsection
