@extends('layouts.admin')

@section('title', 'Kelola Pesanan – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Kelola Pesanan Masuk</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">
        Verifikasi pembayaran transfer, kontrol persiapan kemasan, dan penugasan kurir
      </p>
    </div>
  </div>

  <!-- Filter Status Tabs dengan Counter Badges -->
  <div class="reveal-on-scroll flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold uppercase tracking-wider">
    @php
      $tabs = [
          'semua'               => 'Semua',
          'menunggu_verifikasi' => 'Perlu Verifikasi',
          'diproses'            => 'Diproses / Siap Antar',
          'menunggu_pembayaran' => 'Belum Bayar',
          'dikirim'             => 'Dalam Pengantaran',
          'selesai'             => 'Selesai',
          'dibatalkan'          => 'Dibatalkan',
      ];
      $currentTab = $filterStatus ?: 'semua';
    @endphp

    @foreach($tabs as $key => $title)
      <a href="{{ route('admin.pesanan', array_merge(request()->except('status'), $key === 'semua' ? [] : ['status' => $key])) }}"
         class="px-3.5 py-2 rounded-sm whitespace-nowrap transition-colors flex items-center gap-2 {{ $currentTab === $key ? 'bg-[#C9A227] text-[#0A0E17]' : 'bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5' }}">
        <span>{{ $title }}</span>
        @if(($counts[$key] ?? 0) > 0)
          <span class="px-1.5 py-0.2 rounded-sm text-[10px] font-bold tabular-nums {{ $currentTab === $key ? 'bg-[#0A0E17] text-[#C9A227]' : 'bg-white/10 text-[#E6E9EF]' }}">
            {{ $counts[$key] }}
          </span>
        @endif
      </a>
    @endforeach
  </div>

  <!-- Search Bar Form -->
  <form method="GET" action="{{ route('admin.pesanan') }}" class="reveal-on-scroll relative">
    @if(request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-[#A0AAB9] text-sm pointer-events-none"></i>
    <input type="text" name="q" value="{{ request('q') }}"
           placeholder="Cari nomor pesanan (#TP-...) atau nama pelanggan..."
           class="w-full bg-[#161E2E] border border-white/10 rounded-sm pl-11 pr-24 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]">
    @if(request('q'))
      <a href="{{ route('admin.pesanan', request('status') ? ['status' => request('status')] : []) }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-[#A0AAB9] hover:text-white">
        Reset
      </a>
    @endif
  </form>

  <!-- Tabel Pesanan -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No. Pesanan</th>
            <th class="py-3 px-4">Pelanggan & Penerima</th>
            <th class="py-3 px-4">Tanggal Order</th>
            <th class="py-3 px-4">Total</th>
            <th class="py-3 px-4">Metode Bayar</th>
            <th class="py-3 px-4">Status Pesanan</th>
            <th class="py-3 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          @forelse($orders as $order)
            <tr class="hover:bg-white/[0.02] transition-colors">
              <td class="py-3.5 px-4 font-mono font-bold text-white">#{{ $order->kode_order }}</td>
              <td class="py-3.5 px-4">
                <span class="font-medium text-white block">{{ $order->penerima_nama }}</span>
                <span class="text-[11px] text-[#9AA3B2]">{{ $order->metode_pengiriman_label }}</span>
              </td>
              <td class="py-3.5 px-4 text-xs text-[#A0AAB9] font-mono tabular-nums">
                {{ $order->created_at->format('d M Y, H:i') }}
              </td>
              <td class="py-3.5 px-4 font-semibold text-[#C9A227] tabular-nums">
                {{ $order->total_harga_rupiah }}
              </td>
              <td class="py-3.5 px-4 text-xs">
                <span class="px-2 py-0.5 rounded-sm bg-white/5 border border-white/10 text-[#E6E9EF]">
                  {{ $order->metode_pembayaran_label }}
                </span>
              </td>
              <td class="py-3.5 px-4">
                <x-order-status-badge :status="$order->status" />
              </td>
              <td class="py-3.5 px-4 text-right">
                <a href="{{ route('admin.pesanan.detail', $order->id) }}"
                   class="px-3.5 py-1.5 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors inline-block">
                  Kelola Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-8 text-center text-xs text-[#A0AAB9]">
                Tidak ada data pesanan yang sesuai dengan kriteria filter.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
