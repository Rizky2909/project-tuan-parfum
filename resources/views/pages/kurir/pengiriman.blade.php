@extends('layouts.kurir')

@section('title', 'Tugas Pengiriman – Panel Kurir Tuan Parfum')

@section('content')
<div class="space-y-6 pb-16">

  <!-- Header -->
  <div class="reveal-on-scroll flex items-center justify-between border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl font-bold text-white tracking-wide">Daftar Pengantaran</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-wider mt-0.5">Wilayah Sungai Bangek &amp; Kota Padang</p>
    </div>
    <span class="px-3 py-1 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-semibold uppercase tracking-wider rounded-sm font-mono tabular-nums">
      {{ $counts['diproses'] + $counts['dikirim'] }} Paket Aktif
    </span>
  </div>

  <!-- Filter Tab Sentuh Ramah Mobile -->
  <div class="reveal-on-scroll flex items-center gap-2 overflow-x-auto pb-1 text-xs font-semibold uppercase tracking-wider scrollbar-none">
    @php
      $kurirTabs = [
          'diproses' => 'Siap Antar',
          'dikirim'  => 'Sedang Diantar',
          'selesai'  => 'Riwayat Selesai',
          'semua'    => 'Semua',
      ];
      $currentTab = $filterStatus ?: 'diproses';
    @endphp

    @foreach($kurirTabs as $k => $title)
      <a href="{{ route('kurir.pengiriman', ['status' => $k]) }}"
         class="h-11 px-4 rounded-sm whitespace-nowrap transition-colors flex items-center gap-2 {{ $currentTab === $k ? 'bg-[#C9A227] text-[#0A0E17]' : 'bg-[#161E2E] text-[#A0AAB9] hover:text-white border border-white/5' }}">
        <span>{{ $title }}</span>
        @if(($counts[$k] ?? 0) > 0)
          <span class="px-1.5 py-0.2 rounded-sm text-[10px] font-bold tabular-nums {{ $currentTab === $k ? 'bg-[#0A0E17] text-[#C9A227]' : 'bg-white/10 text-[#E6E9EF]' }}">
            {{ $counts[$k] }}
          </span>
        @endif
      </a>
    @endforeach
  </div>

  @if($orders->isEmpty())
    <div class="reveal-on-scroll card-luxury p-10 text-center rounded-sm bg-[#101623] border border-white/10 space-y-3">
      <i class="bi bi-inbox text-3xl text-[#6E7889]"></i>
      <h3 class="font-serif text-lg font-bold text-white">Tidak Ada Paket Pengantaran</h3>
      <p class="text-xs text-[#A0AAB9]">
        Belum ada paket wewangian yang ditugaskan kepada Anda pada status ini.
      </p>
    </div>
  @else
    <!-- Daftar Kartu Vertikal Ergonomis -->
    <div class="stagger-parent space-y-4">
      @foreach($orders as $order)
        <div class="stagger-item card-interactive card-luxury p-5 sm:p-6 rounded-sm bg-[#101623] border {{ $order->status === 'dikirim' ? 'border-sky-500/40 bg-sky-950/10' : 'border-white/10' }} space-y-4">

          <!-- Baris Header Kartu -->
          <div class="flex items-start justify-between gap-3 border-b border-white/10 pb-3">
            <div>
              <span class="text-xs font-mono font-bold text-white tracking-wider block">#{{ $order->kode_order }}</span>
              <h2 class="font-bold text-white text-base mt-0.5">{{ $order->penerima_nama }}</h2>
            </div>
            <x-order-status-badge :status="$order->status" />
          </div>

          <!-- Highlight Penting Tagihan COD Jika COD -->
          @if($order->metode_pembayaran === 'cod')
            <div class="p-3.5 rounded-sm bg-amber-500/15 border-2 border-amber-500/50 flex items-center justify-between">
              <div class="flex items-center gap-2 text-amber-300">
                <i class="bi bi-cash-stack text-lg"></i>
                <span class="text-xs font-bold uppercase tracking-wider">TAGIH COD DARI PEMBELI:</span>
              </div>
              <span class="text-base font-bold text-amber-300 font-mono tabular-nums">
                {{ $order->total_harga_rupiah }}
              </span>
            </div>
          @else
            <div class="p-2.5 rounded-sm bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-between text-xs text-emerald-300">
              <span>Status Pembayaran:</span>
              <span class="font-bold">LUNAS (Transfer Bank)</span>
            </div>
          @endif

          <!-- Detail Alamat & Patokan -->
          <div class="space-y-2 text-xs">
            <div class="flex items-start gap-2.5 text-[#E8ECF2]">
              <i class="bi bi-geo-alt-fill text-[#C9A227] text-base flex-shrink-0 mt-0.5"></i>
              <div class="space-y-0.5">
                <p class="font-medium text-white text-sm leading-snug">{{ $order->alamat_pengiriman }}</p>
                <p class="text-[#A0AAB9]">Kec. {{ $order->kecamatan }}, Kota {{ $order->kota }}</p>
                @if($order->patokan)
                  <p class="text-xs text-[#C9A227] italic">Patokan: {{ $order->patokan }}</p>
                @endif
              </div>
            </div>

            <!-- Rincian Isi Paket -->
            <div class="p-3 rounded-sm bg-[#151B2C] border border-white/5 space-y-1">
              <span class="text-[#9AA3B2] uppercase tracking-wider text-[10px] block font-semibold">Isi Paket:</span>
              @foreach($order->items as $item)
                <div class="flex justify-between text-xs text-white">
                  <span>{{ $item->qty }}x {{ $item->nama_parfum }} ({{ $item->volume }}ml)</span>
                  <span class="text-[#A0AAB9] tabular-nums">{{ $item->subtotal_rupiah }}</span>
                </div>
              @endforeach
            </div>

            @if($order->catatan_pembeli)
              <div class="p-2.5 rounded-sm bg-white/5 border border-white/5 text-[11px] text-[#A0AAB9] italic">
                Catatan Penerima: "{{ $order->catatan_pembeli }}"
              </div>
            @endif
          </div>

          <!-- 2 Tombol Aksi Sentuh Cepat (WhatsApp & Maps - Min 48px Tinggi) -->
          @php
            $cleanPhone = preg_replace('/[^0-9]/', '', $order->penerima_hp);
            if (str_starts_with($cleanPhone, '0')) {
                $waPhone = '62' . substr($cleanPhone, 1);
            } else {
                $waPhone = $cleanPhone;
            }
            $mapsQuery = urlencode($order->alamat_pengiriman . ', ' . $order->kecamatan . ', ' . $order->kota);
          @endphp

          <div class="grid grid-cols-2 gap-3 pt-1">
            <a href="https://wa.me/{{ $waPhone }}?text=Halo%20{{ urlencode($order->penerima_nama) }},%20saya%20kurir%20Tuan%20Parfum%20sedang%20mengantar%20paket%20wewangian%20Anda."
               target="_blank"
               class="h-12 rounded-sm border border-emerald-500/40 bg-emerald-500/15 hover:bg-emerald-500/25 text-[#34D399] text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
              <i class="bi bi-whatsapp text-base"></i> WhatsApp
            </a>

            <a href="https://www.google.com/maps/search/?api=1&query={{ $mapsQuery }}"
               target="_blank"
               class="h-12 rounded-sm border border-white/10 bg-[#161E2E] hover:bg-white/10 text-white text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
              <i class="bi bi-pin-map text-base text-[#C9A227]"></i> Buka Maps
            </a>
          </div>

          <!-- Tombol Aksi Utama Sesuai Status -->
          <div class="pt-2 border-t border-white/5">
            @if($order->status === 'diproses')
              <form action="{{ route('kurir.pengiriman.mulai', $order->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full h-12 rounded-sm border border-[#C9A227] bg-[#C9A227] text-[#0A0E17] hover:bg-[#DFB942] text-xs font-bold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors shadow-md">
                  <i class="bi bi-bicycle text-lg"></i> Mulai Pengantaran Sekarang
                </button>
              </form>

            @elseif($order->status === 'dikirim')
              <!-- Form Selesaikan Pengantaran -->
              <div class="p-4 rounded-sm bg-[#151B2C] border border-sky-500/30 space-y-3">
                <span class="text-xs font-bold text-white uppercase tracking-wider block">
                  Konfirmasi Serah Terima Paket
                </span>

                <form action="{{ route('kurir.pengiriman.selesai', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                  @csrf
                  <div>
                    <label class="block text-[11px] text-[#A0AAB9] uppercase tracking-wider mb-1">
                      Foto Bukti Diterima (Opsional)
                    </label>
                    <input type="file" name="bukti_pengiriman" accept="image/*"
                           class="w-full bg-[#101623] border border-white/10 rounded-sm px-3 py-2 text-xs text-white file:mr-3 file:py-1 file:px-2 file:rounded-sm file:border-0 file:bg-[#C9A227] file:text-[#0A0E17] file:text-[11px] file:font-semibold">
                  </div>

                  <div>
                    <input type="text" name="catatan_kurir" placeholder="Catatan (misal: Diterima oleh pemilik rumah)"
                           class="w-full bg-[#101623] border border-white/10 rounded-sm px-3 py-2 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]">
                  </div>

                  <button type="submit"
                          class="btn-gold w-full h-12 rounded-sm text-xs font-bold uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg">
                    <i class="bi bi-check2-all text-lg"></i> Konfirmasi Paket Selesai Diantar
                  </button>
                </form>
              </div>

            @elseif($order->status === 'selesai')
              <div class="text-center py-2 text-xs text-emerald-400 font-semibold flex items-center justify-center gap-1.5">
                <i class="bi bi-check-circle-fill"></i> Pengantaran Sukses Diterima ({{ $order->selesai_at ? $order->selesai_at->format('d/m/Y H:i') : '' }})
              </div>
            @endif
          </div>

        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection
