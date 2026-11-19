@extends('layouts.admin')

@section('title', 'Laporan Penjualan – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Laporan Penjualan</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Rekapitulasi pendapatan dan kuantitas produk terdistribusi</p>
    </div>
  </div>

  <!-- Filter Tanggal & Aksi Cetak -->
  <div class="reveal-on-scroll card-luxury p-5 rounded-sm bg-[#101623] border border-white/10">
    <form class="flex flex-col sm:flex-row sm:items-end gap-3 text-xs">
      <div class="flex-1">
        <label class="block text-xs font-semibold uppercase tracking-[0.1em] text-[#A0AAB9] mb-1">Tanggal Awal</label>
        <input type="date" value="{{ date('Y-m-01') }}"
               class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
      </div>
      <div class="flex-1">
        <label class="block text-xs font-semibold uppercase tracking-[0.1em] text-[#A0AAB9] mb-1">Tanggal Akhir</label>
        <input type="date" value="{{ date('Y-m-d') }}"
               class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
      </div>
      <div class="flex items-center gap-2">
        <button type="button" class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider">
          Tampilkan
        </button>
        <button type="button" onclick="window.print()"
                class="px-4 py-2.5 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-wider text-white hover:border-[#C9A227] hover:text-[#C9A227] transition-colors inline-flex items-center gap-1.5">
          <i class="bi bi-printer"></i> Cetak Laporan
        </button>
      </div>
    </form>
  </div>

  <!-- Ringkasan Statistik Laporan -->
  <div class="stagger-parent grid grid-cols-1 sm:grid-cols-3 gap-5">
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-1">
      <span class="text-xs text-[#A0AAB9] uppercase tracking-wider block">Total Pesanan Selesai</span>
      <div class="text-2xl font-bold text-white tabular-nums">12 Transaksi</div>
    </div>
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-1">
      <span class="text-xs text-[#A0AAB9] uppercase tracking-wider block">Total Pendapatan Bersih</span>
      <div class="text-2xl font-bold text-[#34D399] tabular-nums">Rp 4.500.000</div>
    </div>
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-1">
      <span class="text-xs text-[#A0AAB9] uppercase tracking-wider block">Botol Extrait Terjual</span>
      <div class="text-2xl font-bold text-[#C9A227] tabular-nums">30 Botol</div>
    </div>
  </div>

  <!-- Tabel Rekap Transaksi -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
      Rincian Transaksi
    </h2>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No. Pesanan</th>
            <th class="py-3 px-4">Tanggal Transaksi</th>
            <th class="py-3 px-4">Varian Parfum</th>
            <th class="py-3 px-4 text-center">Jumlah Botol</th>
            <th class="py-3 px-4 text-right">Total Transaksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5 text-xs">
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0001</td>
            <td class="py-3.5 px-4 text-[#A0AAB9]">28 Okt 2026</td>
            <td class="py-3.5 px-4">Oud Imperial Extrait, Santal Velvet</td>
            <td class="py-3.5 px-4 text-center tabular-nums">3</td>
            <td class="py-3.5 px-4 text-right font-semibold text-[#C9A227] tabular-nums">Rp 390.000</td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-mono font-bold text-white">#TP-0003</td>
            <td class="py-3.5 px-4 text-[#A0AAB9]">26 Okt 2026</td>
            <td class="py-3.5 px-4">Bergamot Drift</td>
            <td class="py-3.5 px-4 text-center tabular-nums">1</td>
            <td class="py-3.5 px-4 text-right font-semibold text-[#C9A227] tabular-nums">Rp 120.000</td>
          </tr>
        </tbody>
        <tfoot class="border-t border-white/10 text-xs font-semibold">
          <tr>
            <td colspan="4" class="py-3 px-4 uppercase text-[#A0AAB9]">Subtotal Transaksi Ditampilkan:</td>
            <td class="py-3 px-4 text-right text-base text-[#C9A227] tabular-nums">Rp 510.000</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

</div>
@endsection
