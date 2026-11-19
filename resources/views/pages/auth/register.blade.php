@extends('layouts.app')

@section('title', 'Daftar Akun – Tuan Parfum')

@section('content')
<div class="flex items-center justify-center py-8">
  <div class="w-full max-w-md">

    <!-- Card Register -->
    <div class="card-luxury p-8 sm:p-10 rounded-sm bg-[#101623] border border-white/10">

      <!-- Title -->
      <div class="text-center mb-6">
        <span class="text-[10px] uppercase tracking-[0.25em] text-[#C9A227] font-semibold block mb-1">
          Pendaftaran Pelanggan
        </span>
        <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Daftar Akun</h1>
        <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Buat akun untuk memesan wewangian Tuan Parfum</p>
      </div>

      <!-- Error Alert -->
      @if ($errors->any())
        <div class="mb-6 p-3.5 rounded-sm bg-[#F87171]/10 border border-[#F87171]/30 text-[#F87171] text-xs tracking-wide">
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <!-- Form -->
      <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Nama Lengkap
          </label>
          <input type="text" name="name" value="{{ old('name') }}" required autofocus
                 placeholder="Contoh: Muhammad Ihsan"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Alamat Email
          </label>
          <input type="email" name="email" value="{{ old('email') }}" required
                 placeholder="nama@email.com"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Kata Sandi
          </label>
          <input type="password" name="password" required
                 placeholder="Minimal 8 karakter"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <div>
          <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
            Konfirmasi Kata Sandi
          </label>
          <input type="password" name="password_confirmation" required
                 placeholder="Ulangi kata sandi"
                 class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
        </div>

        <button type="submit"
                class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider mt-2">
          Daftar Sekarang
        </button>
      </form>

      <!-- Footer Links -->
      <div class="mt-6 pt-5 border-t border-white/10 text-center text-xs text-[#A0AAB9]">
        Sudah memiliki akun?
        <a href="{{ route('login') }}" class="text-[#C9A227] hover:text-[#DFB942] font-semibold tracking-wide ml-1 transition-colors">
          Masuk di sini
        </a>
      </div>

    </div>

  </div>
</div>
@endsection
