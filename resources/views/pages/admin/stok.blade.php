@extends('layouts.admin')

@section('title', 'Manajemen Stok – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Manajemen Stok Inventaris</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Pantau dan perbarui ketersediaan unit botol parfum di toko</p>
    </div>
  </div>

  <!-- Search & Filter Bar -->
  <div class="reveal-on-scroll flex items-center gap-3">
    <div class="relative flex-1">
      <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-[#A0AAB9] text-sm pointer-events-none"></i>
      <input type="text"
             placeholder="Cari varian parfum untuk cek stok..."
             class="w-full bg-[#161E2E] border border-white/10 rounded-sm pl-11 pr-4 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]">
    </div>
  </div>

  <!-- Form Penyesuaian Stok -->
  <form action="#" method="POST" class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    @csrf

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">Nama Varian Parfum</th>
            <th class="py-3 px-4 text-center">Stok Saat Ini</th>
            <th class="py-3 px-4 text-center">Penyesuaian (+/-)</th>
            <th class="py-3 px-4">Status Ketersediaan</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5 text-xs">
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-medium text-white">
              Oud Imperial Extrait (100 ml)
              <span class="block text-[10px] text-[#A0AAB9]">Unisex</span>
            </td>
            <td class="py-3.5 px-4 text-center text-sm font-semibold text-white tabular-nums">20</td>
            <td class="py-3.5 px-4 text-center">
              <input type="number" value="0"
                     class="w-20 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-xs text-white focus:outline-none focus:border-[#C9A227] tabular-nums">
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] rounded-sm font-medium">
                Aman (20 Botol)
              </span>
            </td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-medium text-white">
              Santal Velvet (50 ml)
              <span class="block text-[10px] text-[#A0AAB9]">Pria</span>
            </td>
            <td class="py-3.5 px-4 text-center text-sm font-semibold text-white tabular-nums">15</td>
            <td class="py-3.5 px-4 text-center">
              <input type="number" value="0"
                     class="w-20 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-xs text-white focus:outline-none focus:border-[#C9A227] tabular-nums">
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] rounded-sm font-medium">
                Aman (15 Botol)
              </span>
            </td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-medium text-white">
              Rose Ébène Extrait (100 ml)
              <span class="block text-[10px] text-[#A0AAB9]">Wanita</span>
            </td>
            <td class="py-3.5 px-4 text-center text-sm font-semibold text-[#F87171] tabular-nums">2</td>
            <td class="py-3.5 px-4 text-center">
              <input type="number" value="0"
                     class="w-20 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-xs text-white focus:outline-none focus:border-[#C9A227] tabular-nums">
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#F87171]/10 border border-[#F87171]/30 text-[#F87171] rounded-sm font-medium">
                Menipis (Sisa 2 Botol)
              </span>
            </td>
          </tr>

          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-3.5 px-4 font-medium text-white">
              Bergamot Drift (100 ml)
              <span class="block text-[10px] text-[#A0AAB9]">Unisex</span>
            </td>
            <td class="py-3.5 px-4 text-center text-sm font-semibold text-[#FBBF24] tabular-nums">4</td>
            <td class="py-3.5 px-4 text-center">
              <input type="number" value="0"
                     class="w-20 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-xs text-white focus:outline-none focus:border-[#C9A227] tabular-nums">
            </td>
            <td class="py-3.5 px-4">
              <span class="px-2.5 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] rounded-sm font-medium">
                Perlu Restock (Sisa 4 Botol)
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="pt-4 border-t border-white/10 flex justify-end">
      <button type="button" onclick="alert('Penyesuaian stok berhasil disimpan!')"
              class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider">
        Simpan Penyesuaian Stok
      </button>
    </div>
  </form>

</div>
@endsection
