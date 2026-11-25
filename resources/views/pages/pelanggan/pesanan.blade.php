@extends('layouts.app')

@section('title', 'Pesanan Saya – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16">

  <!-- Header -->
  <div class="reveal-on-scroll border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Pesanan Saya</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">
        Pantau proses peracikan wewangian, verifikasi transfer, dan status pengantaran
      </p>
    </div>
    <a href="{{ route('katalog') }}" class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-2">
      <i class="bi bi-plus-lg"></i> Pesan Wewangian Baru
    </a>
  </div>

  <!-- Status Tabs Navigasi dengan Counter Badge -->
  <div class="reveal-on-scroll flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold uppercase tracking-wider">
    @php
      $tabs = [
          'semua'               => 'Semua',
          'menunggu_pembayaran' => 'Belum Bayar',
          'menunggu_verifikasi' => 'Verifikasi',
          'diproses'            => 'Diproses',
          'dikirim'             => 'Dikirim',
          'selesai'             => 'Selesai',
          'dibatalkan'          => 'Dibatalkan',
      ];
      $currentTab = $filterStatus ?: 'semua';
    @endphp

    @foreach($tabs as $key => $title)
      <a href="{{ route('pesanan', $key === 'semua' ? [] : ['status' => $key]) }}"
         class="px-4 py-2 rounded-sm whitespace-nowrap transition-colors flex items-center gap-2 {{ $currentTab === $key ? 'bg-[#C9A227] text-[#0A0E17]' : 'bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5' }}">
        <span>{{ $title }}</span>
        @if(($counts[$key] ?? 0) > 0)
          <span class="px-1.5 py-0.2 rounded-sm text-[10px] font-bold tabular-nums {{ $currentTab === $key ? 'bg-[#0A0E17] text-[#C9A227]' : 'bg-white/10 text-[#E6E9EF]' }}">
            {{ $counts[$key] }}
          </span>
        @endif
      </a>
    @endforeach
  </div>

  @if($orders->isEmpty())
    <!-- Empty State -->
    <div class="reveal-on-scroll card-luxury p-12 text-center rounded-sm bg-[#101623] border border-white/10 max-w-lg mx-auto space-y-4">
      <div class="w-14 h-14 rounded-sm border border-white/10 bg-[#151B2C] mx-auto flex items-center justify-center text-[#A0AAB9] text-2xl">
        <i class="bi bi-bag-x"></i>
      </div>
      <div>
        <h3 class="font-serif text-xl font-bold text-white">Tidak Ada Pesanan Ditemukan</h3>
        <p class="text-xs text-[#A0AAB9] mt-1">
          Tidak ada riwayat pesanan dengan filter status yang dipilih.
        </p>
      </div>
      <a href="{{ route('katalog') }}" class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-block">
        Lihat Katalog Wewangian
      </a>
    </div>
  @else
    <!-- Daftar Kartu Pesanan -->
    <div class="stagger-parent space-y-4">
      @foreach($orders as $order)
        <div class="stagger-item card-interactive card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-5">
          <!-- Header Kartu -->
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-white/10 pb-4">
            <div class="flex items-center gap-3">
              <span class="font-mono text-sm font-bold text-white tracking-wider">#{{ $order->kode_order }}</span>
              <span class="text-xs text-[#9AA3B2] font-mono tabular-nums">
                {{ $order->created_at->format('d M Y, H:i') }} WIB
              </span>
              <span class="px-2 py-0.5 bg-white/5 border border-white/10 text-[10px] text-[#A0AAB9] uppercase tracking-wider rounded-sm">
                {{ $order->metode_pengiriman_label }}
              </span>
            </div>

            <div class="flex items-center gap-2">
              <x-order-status-badge :status="$order->status" />
            </div>
          </div>

          <!-- Rincian Produk Singkat -->
          <div class="space-y-3">
            @foreach($order->items as $item)
              <div class="flex items-center justify-between text-xs text-[#E6E9EF]">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-10 rounded-sm bg-[#151B2C] border border-white/10 flex items-center justify-center text-center font-serif text-[10px] font-bold text-[#C9A227]">
                    TP
                  </div>
                  <div>
                    <h4 class="font-serif font-bold text-white text-sm">{{ $item->nama_parfum }}</h4>
                    <p class="text-[#9AA3B2] text-[11px] tabular-nums">
                      {{ $item->volume }} ml • {{ $item->qty }} botol x {{ $item->harga_satuan_rupiah }}
                    </p>
                  </div>
                </div>
                <span class="font-semibold text-white tabular-nums">{{ $item->subtotal_rupiah }}</span>
              </div>
            @endforeach
          </div>

          <!-- Footer Kartu: Total & Aksi Kontekstual -->
          <div class="pt-4 border-t border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
              <span class="text-[11px] text-[#9AA3B2] uppercase tracking-wider block">Total Tagihan:</span>
              <span class="text-xl font-bold text-[#C9A227] tabular-nums font-mono">{{ $order->total_harga_rupiah }}</span>
              <span class="text-[11px] text-[#A0AAB9] block mt-0.5">({{ $order->metode_pembayaran_label }})</span>
            </div>

            <div class="flex flex-wrap items-center gap-2">
              <a href="{{ route('pesanan.detail', $order->kode_order) }}"
                 class="px-4 py-2 rounded-sm border border-white/10 hover:border-[#C9A227] text-white hover:text-[#C9A227] text-xs font-semibold uppercase tracking-wider transition-colors">
                Lihat Detail Pesanan
              </a>

              @if($order->canUploadBuktiBayar())
                <a href="{{ route('pembayaran', $order->kode_order) }}"
                   class="btn-gold px-5 py-2 rounded-sm text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm">
                  <i class="bi bi-credit-card"></i> Bayar Sekarang
                </a>
              @endif

              @if($order->canBeConfirmedReceived())
                <form action="{{ route('pesanan.terima', $order->kode_order) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa pesanan wewangian telah Anda terima?')">
                  @csrf
                  <button type="submit" class="px-5 py-2 rounded-sm bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-500/40 text-emerald-300 text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5">
                    <i class="bi bi-check-circle"></i> Pesanan Diterima
                  </button>
                </form>
              @endif
            </div>
          </div>

        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection
