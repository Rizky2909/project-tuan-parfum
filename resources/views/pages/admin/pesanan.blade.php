@extends('layouts.admin')

@section('title', 'Kelola Pesanan – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Kelola Pesanan Masuk</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Verifikasi pembayaran, proses racik kemasan, dan penugasan kurir</p>
    </div>
  </div>

  <!-- Filter Status Tabs -->
  <div class="reveal-on-scroll flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold uppercase tracking-wider">
    <button class="px-3.5 py-2 rounded-sm bg-[#C9A227] text-[#0A0E17] whitespace-nowrap">Semua (2)</button>
    <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Menunggu Bayar (1)</button>
    <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Diproses (0)</button>
    <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Dikemas (1)</button>
    <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Dikirim (0)</button>
    <button class="px-3.5 py-2 rounded-sm bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5 whitespace-nowrap">Selesai (0)</button>
  </div>

  <!-- Search Bar -->
  <div class="reveal-on-scroll relative">
    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-[#A0AAB9] text-sm pointer-events-none"></i>
    <input type="text"
           placeholder="Cari nomor pesanan atau nama penerima..."
           class="w-full bg-[#161E2E] border border-white/10 rounded-sm pl-11 pr-4 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]">
  </div>

  <!-- Tabel Pesanan -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No. Pesanan</th>
            <th class="py-3 px-4">Pelanggan</th>
            <th class="py-3 px-4">Tanggal</th>
            <th class="py-3 px-4">Total</th>
            <th class="py-3 px-4">Pembayaran</th>
            <th class="py-3 px-4">Status Pesanan</th>
            <th class="py-3 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0001</td>
            <td class="py-3.5 px-4">Budi Prasetyo</td>
            <td class="py-3.5 px-4 text-xs text-[#A0AAB9]">28 Okt 2026</td>
            <td class="py-3.5 px-4 font-semibold text-[#C9A227] tabular-nums">Rp 390.000</td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] text-xs font-medium rounded-sm">
                Terverifikasi (Valid)
              </span>
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-medium rounded-sm">
                Dikemas
              </span>
            </td>
            <td class="py-3.5 px-4 text-right">
              <a href="{{ route('admin.pesanan.detail', 1) }}"
                 class="px-3 py-1.5 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors">
                Detail
              </a>
            </td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0002</td>
            <td class="py-3.5 px-4">Sari Rahmadani</td>
            <td class="py-3.5 px-4 text-xs text-[#A0AAB9]">27 Okt 2026</td>
            <td class="py-3.5 px-4 font-semibold text-white tabular-nums">Rp 150.000</td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-medium rounded-sm">
                Menunggu Bukti
              </span>
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-medium rounded-sm">
                Menunggu Pembayaran
              </span>
            </td>
            <td class="py-3.5 px-4 text-right">
              <a href="{{ route('admin.pesanan.detail', 2) }}"
                 class="px-3 py-1.5 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors">
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
