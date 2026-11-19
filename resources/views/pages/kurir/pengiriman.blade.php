@extends('layouts.kurir')

@section('title', 'Tugas Pengiriman – Panel Kurir')

@section('content')
<div class="space-y-6">

  <!-- Header & Status Filter Ringkas -->
  <div class="reveal-on-scroll space-y-3">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="font-serif text-2xl font-bold text-white tracking-wide">Daftar Pengantaran</h1>
        <p class="text-xs text-[#A0AAB9] uppercase tracking-wider mt-0.5">Wilayah Sungai Bangek &amp; Kota Padang</p>
      </div>
      <span class="px-3 py-1 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-semibold uppercase tracking-wider rounded-sm">
        3 Paket Aktif
      </span>
    </div>

    <!-- Filter Tab Sentuh Ramah Mobile -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs font-semibold uppercase tracking-wider">
      <button class="px-3.5 py-2 rounded-sm bg-[#C9A227] text-[#0A0E17] whitespace-nowrap">Semua (3)</button>
      <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Ditugaskan (1)</button>
      <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Dalam Jalan (1)</button>
      <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Selesai (1)</button>
    </div>
  </div>

  <!-- Daftar Kartu Vertikal Ergonomis (Sesuai Dokumentasi 7.4) -->
  <div class="stagger-parent space-y-4">

    <!-- Kartu Tugas 1 (Dalam Perjalanan) -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-4">
      <div class="flex items-start justify-between gap-3 border-b border-white/10 pb-3">
        <div>
          <span class="text-xs font-mono font-bold text-white tracking-wider">#TP-0004</span>
          <h2 class="font-bold text-white text-base mt-0.5">Sari Rahmadani</h2>
        </div>
        <span class="px-2.5 py-1 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-semibold uppercase tracking-wider rounded-sm">
          Dalam Perjalanan
        </span>
      </div>

      <!-- Detail Alamat & Paket -->
      <div class="space-y-2 text-xs">
        <div class="flex items-start gap-2 text-[#E8ECF2]">
          <i class="bi bi-geo-alt-fill text-[#C9A227] text-sm flex-shrink-0 mt-0.5"></i>
          <div>
            <p class="font-medium">Jl. Melati No. 12, RT 01 / RW 04</p>
            <p class="text-[#A0AAB9]">Kelurahan Balai Gadang, Sungai Bangek, Koto Tangah, Padang</p>
            <p class="text-[11px] text-[#6E7889] mt-0.5">Patokan: Pagar hitam depan musholla Al-Ikhlas</p>
          </div>
        </div>

        <div class="p-3 rounded-sm bg-[#161E2E] border border-white/5 flex justify-between items-center text-xs">
          <div>
            <span class="text-[#A0AAB9] block">Item Paket:</span>
            <span class="text-white font-medium">1x Oud Imperial (100 ml)</span>
          </div>
          <div class="text-right">
            <span class="text-[#A0AAB9] block">Status Bayar:</span>
            <span class="text-[#34D399] font-medium">Lunas (Transfer BCA)</span>
          </div>
        </div>
      </div>

      <!-- Tombol Aksi Sentuh Ramah Mobile (Tinggi h-11) -->
      <div class="grid grid-cols-2 gap-3 pt-1">
        <a href="https://wa.me/6281234567890?text=Halo%20Bu%20Sari,%20saya%20kurir%20Tuan%20Parfum%20sedang%20menuju%20ke%20alamat%20Anda"
           target="_blank"
           class="h-11 rounded-sm border border-emerald-500/30 bg-emerald-500/10 hover:bg-emerald-500/20 text-[#34D399] text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
          <i class="bi bi-whatsapp text-sm"></i> WhatsApp
        </a>
        <a href="tel:081234567890"
           class="h-11 rounded-sm border border-white/10 bg-[#161E2E] hover:bg-white/10 text-white text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
          <i class="bi bi-telephone text-sm"></i> Panggil
        </a>
      </div>

      <!-- Tombol Perubahan Status Utama (Satu Sentuhan H-11) -->
      <form action="#" method="POST" class="pt-1">
        @csrf
        <button type="button"
                onclick="alert('Status paket #TP-0004 berhasil diubah menjadi Terkirim!')"
                class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
          <i class="bi bi-check2-circle text-base"></i> Konfirmasi Paket Terkirim
        </button>
      </form>
    </div>

    <!-- Kartu Tugas 2 (Ditugaskan / Siap Antar) -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-4">
      <div class="flex items-start justify-between gap-3 border-b border-white/10 pb-3">
        <div>
          <span class="text-xs font-mono font-bold text-white tracking-wider">#TP-0001</span>
          <h2 class="font-bold text-white text-base mt-0.5">Budi Prasetyo</h2>
        </div>
        <span class="px-2.5 py-1 bg-[#60A5FA]/10 border border-[#60A5FA]/30 text-[#60A5FA] text-xs font-semibold uppercase tracking-wider rounded-sm">
          Ditugaskan
        </span>
      </div>

      <div class="space-y-2 text-xs">
        <div class="flex items-start gap-2 text-[#E8ECF2]">
          <i class="bi bi-geo-alt-fill text-[#C9A227] text-sm flex-shrink-0 mt-0.5"></i>
          <div>
            <p class="font-medium">Komplek Permata Sungai Bangek Blok C No. 4</p>
            <p class="text-[#A0AAB9]">Koto Tangah, Kota Padang</p>
          </div>
        </div>

        <div class="p-3 rounded-sm bg-[#161E2E] border border-white/5 flex justify-between items-center text-xs">
          <div>
            <span class="text-[#A0AAB9] block">Item Paket:</span>
            <span class="text-white font-medium">2x Santal Velvet (50 ml)</span>
          </div>
          <div class="text-right">
            <span class="text-[#A0AAB9] block">Total Nota:</span>
            <span class="text-[#C9A227] font-semibold tabular-nums">Rp 180.000</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3 pt-1">
        <a href="https://wa.me/6281234567891"
           target="_blank"
           class="h-11 rounded-sm border border-emerald-500/30 bg-emerald-500/10 hover:bg-emerald-500/20 text-[#34D399] text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
          <i class="bi bi-whatsapp text-sm"></i> WhatsApp
        </a>
        <a href="tel:081234567891"
           class="h-11 rounded-sm border border-white/10 bg-[#161E2E] hover:bg-white/10 text-white text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
          <i class="bi bi-telephone text-sm"></i> Panggil
        </a>
      </div>

      <button type="button"
              onclick="alert('Status paket #TP-0001 diubah menjadi Dalam Perjalanan!')"
              class="w-full h-11 rounded-sm border border-[#C9A227]/50 bg-[#C9A227]/10 hover:bg-[#C9A227]/20 text-[#C9A227] text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
        <i class="bi bi-bicycle"></i> Mulai Pengantaran
      </button>
    </div>

    <!-- Kartu Tugas 3 (Terkirim) -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 opacity-75 space-y-3">
      <div class="flex items-start justify-between gap-3 border-b border-white/10 pb-3">
        <div>
          <span class="text-xs font-mono font-bold text-[#A0AAB9] tracking-wider">#TP-0005</span>
          <h2 class="font-bold text-white text-base mt-0.5">Andi Saputra</h2>
        </div>
        <span class="px-2.5 py-1 bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] text-xs font-semibold uppercase tracking-wider rounded-sm">
          Terkirim
        </span>
      </div>

      <div class="text-xs text-[#A0AAB9]">
        <p>Jl. Mawar No. 9, Balai Gadang, Padang</p>
        <p class="text-[11px] text-[#6E7889] mt-1">Diterima pada: 19 Nov 2026, 16:45 WIB</p>
      </div>
    </div>

  </div>

</div>
@endsection
