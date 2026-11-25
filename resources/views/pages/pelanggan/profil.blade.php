@extends('layouts.app')

@section('title', 'Profil Saya – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16">

  <div class="reveal-on-scroll border-b border-white/10 pb-4">
    <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Profil Pelanggan</h1>
    <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Kelola informasi akun dan alamat pengantaran utama wewangian Anda</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Navigasi Profil (Kiri) -->
    <div class="lg:col-span-4 space-y-4 reveal-on-scroll">
      <div class="card-luxury p-6 text-center space-y-4 rounded-sm bg-[#101623] border border-white/10">
        <div class="w-16 h-16 rounded-sm border border-[#C9A227] mx-auto bg-[#131824] flex items-center justify-center text-[#C9A227] font-serif text-2xl font-bold">
          {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}
        </div>
        <div>
          <h2 class="font-semibold text-white text-base">{{ Auth::user()->name }}</h2>
          <p class="text-xs text-[#A0AAB9]">{{ Auth::user()->email }}</p>
          <span class="inline-block mt-2 px-2.5 py-0.5 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-[10px] font-semibold uppercase tracking-wider rounded-sm">
            Akun {{ ucfirst(Auth::user()->role) }} Aktif
          </span>
        </div>
      </div>

      <div class="card-luxury p-2 space-y-1 text-xs font-semibold uppercase tracking-wider rounded-sm bg-[#101623] border border-white/10">
        <a href="{{ route('profil') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-sm bg-[#C9A227] text-[#0A0E17]">
          <i class="bi bi-person-badge"></i> Data Pribadi
        </a>
        <a href="{{ route('alamat.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-[#A0AAB9] hover:bg-white/5 hover:text-white transition-colors">
          <i class="bi bi-geo-alt"></i> Buku Alamat
        </a>
        <a href="{{ route('pesanan') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-[#A0AAB9] hover:bg-white/5 hover:text-white transition-colors">
          <i class="bi bi-bag-check"></i> Riwayat Pesanan
        </a>
      </div>
    </div>

    <!-- Form Data Pribadi (Kanan) -->
    <div class="lg:col-span-8 space-y-6 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h2 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Informasi Akun
        </h2>

        <form action="{{ route('profil.update') }}" method="POST" class="space-y-5">
          @csrf

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
                Nama Lengkap
              </label>
              <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                     class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C9A227]">
            </div>

            <div>
              <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
                Alamat Email
              </label>
              <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                     class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C9A227]">
            </div>
          </div>

          <div class="flex items-center gap-3 pt-4 border-t border-white/10">
            <button type="submit"
                    class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider">
              Simpan Perubahan
            </button>
            <a href="{{ route('alamat.index') }}"
               class="px-5 py-2.5 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-wider text-[#A0AAB9] hover:text-white transition-colors">
              Kelola Buku Alamat &rarr;
            </a>
          </div>
        </form>
      </div>
    </div>

  </div>

</div>
@endsection
