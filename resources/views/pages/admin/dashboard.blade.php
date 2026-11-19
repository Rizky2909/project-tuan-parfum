@extends('layouts.admin')

@section('title', 'Dashboard Statistik – Admin Tuan Parfum')

@section('content')
<div class="space-y-8">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Dashboard Statistik</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Ringkasan performa penjualan dan status operasional inventaris</p>
    </div>
    <div class="text-xs text-[#A0AAB9]">
      Pembaruan: <span class="text-white font-medium">{{ date('d M Y, H:i') }} WIB</span>
    </div>
  </div>

  <!-- KPI Metrik Cards (Section 5.1/5.2) -->
  <div class="stagger-parent grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    <!-- Card 1: Pesanan Baru -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Pesanan Baru</span>
        <i class="bi bi-bag-plus text-[#60A5FA] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-white tabular-nums">5</div>
      <p class="text-[11px] text-[#A0AAB9]">Perlu dikonfirmasi hari ini</p>
    </div>

    <!-- Card 2: Menunggu Verifikasi -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Menunggu Verifikasi</span>
        <i class="bi bi-clock-history text-[#FBBF24] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#FBBF24] tabular-nums">3</div>
      <p class="text-[11px] text-[#A0AAB9]">Bukti transfer baru diunggah</p>
    </div>

    <!-- Card 3: Penjualan Bulan Ini -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Penjualan Bulan Ini</span>
        <i class="bi bi-cash-stack text-[#34D399] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#34D399] tabular-nums">Rp 4.500.000</div>
      <p class="text-[11px] text-[#A0AAB9]">Total transaksi selesai</p>
    </div>

    <!-- Card 4: Stok Menipis -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Stok Menipis</span>
        <i class="bi bi-exclamation-triangle text-[#F87171] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#F87171] tabular-nums">2 Varian</div>
      <p class="text-[11px] text-[#A0AAB9]">Sisa stok &le; 5 botol</p>
    </div>

  </div>

  <!-- Layout Tengah: Grafik Penjualan & Peringatan Stok Rendah -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Ringkasan Grafik Penjualan -->
    <div class="lg:col-span-7 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
          <h2 class="font-serif text-lg font-bold text-white">Tren Penjualan Mingguan</h2>
          <span class="text-xs text-[#C9A227] font-semibold uppercase tracking-wider">Bulan Ini</span>
        </div>

        <div class="h-56 bg-[#161E2E] rounded-sm border border-white/5 p-4 flex flex-col justify-between">
          <div class="flex justify-between text-[11px] text-[#A0AAB9]">
            <span>Target Rp 5.000.000</span>
            <span class="text-[#34D399] font-medium">90% Tercapai</span>
          </div>

          <!-- Bar Chart Minimalis -->
          <div class="h-32 flex items-end gap-3 sm:gap-6 justify-between px-2 pt-4">
            <div class="flex-1 flex flex-col items-center gap-1">
              <div class="w-full bg-[#C9A227]/30 hover:bg-[#C9A227] transition-colors rounded-sm" style="height: 45%;"></div>
              <span class="text-[10px] text-[#A0AAB9]">M1</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-1">
              <div class="w-full bg-[#C9A227]/30 hover:bg-[#C9A227] transition-colors rounded-sm" style="height: 65%;"></div>
              <span class="text-[10px] text-[#A0AAB9]">M2</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-1">
              <div class="w-full bg-[#C9A227]/30 hover:bg-[#C9A227] transition-colors rounded-sm" style="height: 85%;"></div>
              <span class="text-[10px] text-[#A0AAB9]">M3</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-1">
              <div class="w-full bg-[#C9A227] rounded-sm" style="height: 95%;"></div>
              <span class="text-[10px] text-[#C9A227] font-bold">M4</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Peringatan Stok Rendah (Section 7.4) -->
    <div class="lg:col-span-5 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
          <h2 class="font-serif text-lg font-bold text-white">Peringatan Stok Rendah</h2>
          <a href="{{ route('admin.stok') }}" class="text-xs text-[#C9A227] hover:underline uppercase tracking-wider">
            Kelola
          </a>
        </div>

        <div class="space-y-3">
          <div class="p-3.5 rounded-sm bg-[#161E2E] border border-red-500/20 flex items-center justify-between">
            <div>
              <h4 class="font-serif font-bold text-white text-sm">Rose Ébène Extrait</h4>
              <p class="text-xs text-[#A0AAB9]">Wanita | 100 ml</p>
            </div>
            <span class="px-2.5 py-1 bg-[#F87171]/15 border border-[#F87171]/40 text-[#F87171] text-xs font-semibold tabular-nums rounded-sm">
              Sisa 2 Botol
            </span>
          </div>

          <div class="p-3.5 rounded-sm bg-[#161E2E] border border-amber-500/20 flex items-center justify-between">
            <div>
              <h4 class="font-serif font-bold text-white text-sm">Bergamot Drift</h4>
              <p class="text-xs text-[#A0AAB9]">Unisex | 100 ml</p>
            </div>
            <span class="px-2.5 py-1 bg-[#FBBF24]/15 border border-[#FBBF24]/40 text-[#FBBF24] text-xs font-semibold tabular-nums rounded-sm">
              Sisa 4 Botol
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Tabel Pesanan Terbaru -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <div class="flex items-center justify-between border-b border-white/10 pb-3">
      <h2 class="font-serif text-lg font-bold text-white">Pesanan Masuk Terbaru</h2>
      <a href="{{ route('admin.pesanan') }}" class="text-xs text-[#C9A227] hover:underline uppercase tracking-wider">
        Lihat Semua Pesanan
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No. Pesanan</th>
            <th class="py-3 px-4">Pelanggan</th>
            <th class="py-3 px-4">Total</th>
            <th class="py-3 px-4">Status Pesanan</th>
            <th class="py-3 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0001</td>
            <td class="py-3.5 px-4">Budi Prasetyo</td>
            <td class="py-3.5 px-4 font-semibold text-[#C9A227] tabular-nums">Rp 390.000</td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-medium rounded-sm">
                Dikemas
              </span>
            </td>
            <td class="py-3.5 px-4 text-right">
              <a href="{{ route('admin.pesanan.detail', 1) }}"
                 class="px-3 py-1 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors">
                Detail
              </a>
            </td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0002</td>
            <td class="py-3.5 px-4">Sari Rahmadani</td>
            <td class="py-3.5 px-4 font-semibold text-white tabular-nums">Rp 150.000</td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-medium rounded-sm">
                Menunggu Pembayaran
              </span>
            </td>
            <td class="py-3.5 px-4 text-right">
              <a href="{{ route('admin.pesanan.detail', 2) }}"
                 class="px-3 py-1 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors">
                Detail
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
