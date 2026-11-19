@extends('layouts.app')

@section('title', 'Pesanan Saya – Tuan Parfum')

@section('content')
<div class="space-y-8">

  <div class="reveal-on-scroll border-b border-white/10 pb-4">
    <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Pesanan Saya</h1>
    <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Pantau proses peracikan, pengemasan, dan pengantaran pesanan wewangian Anda</p>
  </div>

  <!-- Status Tabs Navigasi -->
  <div class="reveal-on-scroll flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold uppercase tracking-wider">
    <button class="px-4 py-2 rounded-sm bg-[#C9A227] text-[#0A0E17] whitespace-nowrap">Semua Pesanan</button>
    <button class="px-4 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Menunggu Bayar</button>
    <button class="px-4 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Diproses</button>
    <button class="px-4 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Dikemas</button>
    <button class="px-4 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Dikirim</button>
    <button class="px-4 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Selesai</button>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Daftar Ringkas Pesanan (Kiri) -->
    <div class="stagger-parent lg:col-span-5 space-y-3">
      <!-- Pesanan Aktif -->
      <div class="stagger-item card-interactive card-luxury p-5 rounded-sm border-l-2 border-l-[#C9A227] space-y-3 bg-[#101623] border border-white/10">
        <div class="flex justify-between items-start">
          <div>
            <span class="text-xs font-mono font-bold text-white tracking-wider">#TP-0001</span>
            <p class="text-xs text-[#A0AAB9] mt-0.5">28 Okt 2026 • 2 Produk</p>
          </div>
          <span class="px-2.5 py-0.5 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-[10px] font-semibold uppercase tracking-wider rounded-sm">
            Dikemas
          </span>
        </div>
        <div class="pt-2 border-t border-white/5 flex justify-between items-center text-sm">
          <span class="text-xs text-[#A0AAB9]">Total Pembayaran:</span>
          <span class="font-semibold text-[#C9A227] tabular-nums">Rp 390.000</span>
        </div>
      </div>

      <!-- Pesanan Kedua -->
      <div class="stagger-item card-interactive card-luxury p-5 rounded-sm opacity-80 hover:opacity-100 transition-opacity space-y-3 bg-[#101623] border border-white/10">
        <div class="flex justify-between items-start">
          <div>
            <span class="text-xs font-mono font-bold text-white tracking-wider">#TP-0002</span>
            <p class="text-xs text-[#A0AAB9] mt-0.5">27 Okt 2026 • 1 Produk</p>
          </div>
          <span class="px-2.5 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-[10px] font-semibold uppercase tracking-wider rounded-sm">
            Menunggu Bayar
          </span>
        </div>
        <div class="pt-2 border-t border-white/5 flex justify-between items-center text-sm">
          <span class="text-xs text-[#A0AAB9]">Total Pembayaran:</span>
          <span class="font-semibold text-white tabular-nums">Rp 150.000</span>
        </div>
      </div>
    </div>

    <!-- Rincian Pesanan Terpilih (Kanan) -->
    <div class="lg:col-span-7 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">

        <div class="flex flex-wrap justify-between items-center gap-4 border-b border-white/10 pb-4">
          <div>
            <h2 class="font-serif text-xl font-bold text-white">Rincian Pesanan #TP-0001</h2>
            <p class="text-xs text-[#A0AAB9] mt-0.5">Waktu Pemesanan: 28 Oktober 2026, 14:30 WIB</p>
          </div>
          <span class="px-3 py-1 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-semibold uppercase tracking-wider rounded-sm">
            Status: Dikemas
          </span>
        </div>

        <!-- Stepper Status Pengiriman -->
        <div class="grid grid-cols-5 gap-2 text-center text-[10px] uppercase font-semibold tracking-wider">
          <div class="space-y-1 text-[#34D399]">
            <div class="h-1 rounded-sm bg-[#34D399]"></div>
            <span>Bayar OK</span>
          </div>
          <div class="space-y-1 text-[#34D399]">
            <div class="h-1 rounded-sm bg-[#34D399]"></div>
            <span>Diproses</span>
          </div>
          <div class="space-y-1 text-[#C9A227]">
            <div class="h-1 rounded-sm bg-[#C9A227]"></div>
            <span>Dikemas</span>
          </div>
          <div class="space-y-1 text-[#6E7889]">
            <div class="h-1 rounded-sm bg-white/10"></div>
            <span>Dikirim</span>
          </div>
          <div class="space-y-1 text-[#6E7889]">
            <div class="h-1 rounded-sm bg-white/10"></div>
            <span>Selesai</span>
          </div>
        </div>

        <!-- Tabel Rincian Produk -->
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-[#E8ECF2]">
            <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
              <tr>
                <th class="py-3 px-4">Parfum</th>
                <th class="py-3 px-4 text-center">Jumlah</th>
                <th class="py-3 px-4 text-right">Harga</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
              <tr>
                <td class="py-3 px-4">Oud Imperial Extrait (100 ml)</td>
                <td class="py-3 px-4 text-center tabular-nums">2</td>
                <td class="py-3 px-4 text-right font-medium tabular-nums">Rp 300.000</td>
              </tr>
              <tr>
                <td class="py-3 px-4">Santal Velvet (50 ml)</td>
                <td class="py-3 px-4 text-center tabular-nums">1</td>
                <td class="py-3 px-4 text-right font-medium tabular-nums">Rp 90.000</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Info Alamat & Pembayaran -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-[#A0AAB9] bg-[#161E2E] p-4 rounded-sm border border-white/5">
          <div>
            <span class="text-white font-semibold uppercase tracking-wider block mb-1">Alamat Pengiriman</span>
            <p>Jl. Raya Sungai Bangek, RT 02 / RW 05, Kota Padang</p>
          </div>
          <div>
            <span class="text-white font-semibold uppercase tracking-wider block mb-1">Metode Pembayaran</span>
            <p>Transfer Bank BCA (Lunas Terverifikasi)</p>
          </div>
        </div>

        <!-- Total Tagihan -->
        <div class="flex flex-wrap justify-between items-center gap-4 pt-4 border-t border-white/10">
          <div>
            <span class="text-xs text-[#A0AAB9] block uppercase tracking-wider">Total Pesanan:</span>
            <span class="font-semibold text-2xl text-[#C9A227] tabular-nums">Rp 390.000</span>
          </div>
          <button type="button" class="btn-destructive px-4 py-2 rounded-sm text-xs font-semibold uppercase tracking-wider">
            Batalkan Pesanan
          </button>
        </div>

      </div>
    </div>

  </div>

</div>
@endsection
