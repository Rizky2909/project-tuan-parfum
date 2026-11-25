@extends('layouts.app')

@section('title', 'Katalog Parfum – Tuan Parfum')

@section('content')
<div class="space-y-10 animate-subtle-in">

  <!-- Header Seksi (Sesuai Dokumentasi 8.2) -->
  <div class="reveal-on-scroll border-b border-white/10 pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
      <span class="text-xs font-semibold tracking-wider text-[#C9A227] uppercase block mb-1 font-sans">
        Koleksi Wewangian
      </span>
      <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white tracking-wide">
        Katalog Parfum
      </h1>
      <p class="text-xs sm:text-sm text-[#9AA3B2] mt-1 font-light">
        Seluruh varian di bawah ini tersedia dan siap dipesan.
      </p>
    </div>

    <!-- Quick Stats -->
    <div class="text-xs text-[#9AA3B2] font-sans">
      Menampilkan <span class="text-[#C9A227] font-semibold tabular-nums">{{ $parfums->count() }}</span> varian wewangian
    </div>
  </div>

  <!-- Filter & Search Toolbar -->
  <div class="reveal-on-scroll card-luxury p-4 sm:p-5 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <form action="{{ route('katalog') }}" method="GET" class="flex flex-col md:flex-row items-stretch md:items-center gap-3">

      <!-- Search Input -->
      <div class="relative flex-1">
        <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-[#9AA3B2] text-sm pointer-events-none"></i>
        <input type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari aroma, varian, atau nama parfum..."
               class="w-full bg-[#161E2E] border border-white/10 rounded-sm pl-11 pr-4 py-2.5 text-xs text-white placeholder-[#9AA3B2]/60 focus:outline-none focus:border-[#C9A227] transition-colors">
      </div>

      <!-- Kategori Filter -->
      <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0 scrollbar-none">
        @php
          $selectedCat = request('kategori', 'Semua');
          $categories = ['Semua', 'Pria', 'Wanita', 'Unisex', 'Koleksi Eksklusif'];
        @endphp

        @foreach($categories as $cat)
          <a href="{{ route('katalog', array_merge(request()->query(), ['kategori' => $cat])) }}"
             class="px-3 py-2 rounded-sm text-xs font-semibold uppercase tracking-wider transition-all duration-200 active:scale-95 whitespace-nowrap {{ $selectedCat === $cat ? 'bg-[#C9A227] text-[#0A0E17] shadow-sm' : 'bg-[#161E2E] text-[#A0AAB9] hover:text-white hover:border-[#C9A227]/30 border border-white/5' }}">
            {{ $cat }}
          </a>
        @endforeach
      </div>

      <!-- Submit / Reset Buttons -->
      <div class="flex items-center gap-2">
        <button type="submit" class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider whitespace-nowrap">
          Cari
        </button>
        @if(request()->has('q') || (request()->has('kategori') && request('kategori') !== 'Semua'))
          <a href="{{ route('katalog') }}" class="px-3 py-2.5 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-wider text-[#9AA3B2] hover:text-white transition-colors whitespace-nowrap">
            Reset
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- Product Grid (Standar Rasio 3:4 Sesuai Dokumentasi 6.1) -->
  @if($parfums->isEmpty())
    <!-- Empty State (R-27) -->
    <div class="card-luxury p-12 text-center rounded-sm bg-[#101623] border border-white/10 space-y-4">
      <div class="w-12 h-12 rounded-sm border border-[#C9A227]/40 text-[#C9A227] mx-auto flex items-center justify-center text-xl">
        <i class="bi bi-search"></i>
      </div>
      <div class="space-y-1">
        <h3 class="font-serif text-xl font-bold text-white">Tidak Ada Parfum Ditemukan</h3>
        <p class="text-xs text-[#9AA3B2] max-w-md mx-auto font-light">
          Varian parfum yang Anda cari tidak tersedia. Silakan gunakan kata kunci pencarian lain atau pilih kategori yang berbeda.
        </p>
      </div>
      <div>
        <a href="{{ route('katalog') }}" class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-2">
          Lihat Seluruh Katalog
        </a>
      </div>
    </div>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger-parent">
      @foreach($parfums as $item)
        <div class="stagger-item group card-luxury card-interactive rounded-sm overflow-hidden border border-white/10 hover:border-[#C9A227] flex flex-col justify-between bg-[#101623]">

          <!-- 3:4 Media Container -->
          <a href="{{ route('katalog.detail', $item->id) }}" class="relative aspect-[3/4] w-full overflow-hidden bg-[#151B28] block">

            @if(!empty($item->foto))
              <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}"
                   class="w-full h-full object-cover object-center img-zoom-smooth">
            @else
              <!-- Minimalist Bottle Silhouette SVG Placeholder (Matte Noir) -->
              <div class="w-full h-full bg-[#131824] p-5 flex flex-col justify-between items-center text-center relative border-b border-white/5 group-hover:bg-[#161D2C] transition-colors">
                <div class="w-full flex justify-between items-center text-[10px] text-[#9AA3B2] uppercase tracking-wider">
                  <span class="px-2 py-0.5 bg-[#0A0E17] border border-white/10 text-white font-medium">
                    {{ $item->kategori }}
                  </span>
                  <span>{{ $item->volume }} ml</span>
                </div>

                <div class="my-auto flex flex-col items-center">
                  <svg class="w-9 h-14 stroke-[#C9A227] fill-none stroke-[1.2] mb-2.5 opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300" viewBox="0 0 24 38">
                    <rect x="7" y="2" width="10" height="6" rx="0.5" stroke="currentColor"/>
                    <rect x="9" y="8" width="6" height="2" stroke="currentColor"/>
                    <rect x="3" y="10" width="18" height="25" rx="1" stroke="currentColor"/>
                    <rect x="6" y="15" width="12" height="15" rx="0.5" stroke="currentColor" stroke-dasharray="1 1" opacity="0.6"/>
                    <text x="12" y="24" text-anchor="middle" font-size="5" fill="#C9A227" font-family="serif" font-weight="bold">TP</text>
                  </svg>
                  <span class="font-serif text-sm text-white font-semibold tracking-wider block leading-tight">
                    {{ $item->nama }}
                  </span>
                  <span class="text-[9px] uppercase tracking-[0.25em] text-[#C9A227] mt-1 font-sans">
                    Tuan Parfum
                  </span>
                </div>

                <div class="w-full text-left text-[9px]">
                  @if($item->stok > 5)
                    <span class="text-[#34D399] font-medium inline-flex items-center">
                      <span class="w-1.5 h-1.5 rounded-full bg-[#34D399] mr-1.5 animate-soft-pulse"></span>
                      Tersedia ({{ $item->stok }} Botol)
                    </span>
                  @elseif($item->stok > 0)
                    <span class="text-[#FBBF24] font-medium inline-flex items-center">
                      <span class="w-1.5 h-1.5 rounded-full bg-[#FBBF24] mr-1.5 animate-soft-pulse"></span>
                      Sisa {{ $item->stok }} Botol
                    </span>
                  @else
                    <span class="text-[#F87171] font-medium inline-flex items-center">
                      <span class="w-1.5 h-1.5 rounded-full bg-[#F87171] mr-1.5"></span>
                      Stok Habis
                    </span>
                  @endif
                </div>
              </div>
            @endif

            <!-- Top Overlays: Kategori & Volume -->
            @if(!empty($item->foto))
              <div class="absolute top-3 left-3 right-3 flex items-center justify-between pointer-events-none">
                <span class="px-2 py-0.5 bg-[#0A0E17]/80 backdrop-blur-sm border border-white/10 text-[10px] uppercase font-semibold text-white tracking-wider">
                  {{ $item->kategori }}
                </span>
                <span class="px-2 py-0.5 bg-[#0A0E17]/80 backdrop-blur-sm border border-white/10 text-[10px] uppercase font-medium text-[#A0AAB9] tracking-wider">
                  {{ $item->volume }} ml
                </span>
              </div>
            @endif

            <!-- Out of Stock Overlay -->
            @if($item->stok === 0)
              <div class="absolute inset-0 bg-[#0A0E17]/70 backdrop-blur-[2px] flex items-center justify-center p-4">
                <span class="px-3 py-1 bg-[#F87171]/20 border border-[#F87171]/50 text-[#F87171] text-xs font-semibold uppercase tracking-wider">
                  Stok Habis
                </span>
              </div>
            @endif

          </a>

          <!-- Information & Action Bar -->
          <div class="p-4 flex flex-col flex-grow justify-between gap-3">
            <div>
              <div class="flex items-center justify-between text-[11px] text-[#A0AAB9] uppercase tracking-wider mb-1">
                <span>{{ $item->kategori }}</span>
                <span>{{ $item->volume }} ml</span>
              </div>
              <a href="{{ route('katalog.detail', $item->id) }}" class="block">
                <h2 class="font-serif text-base font-bold text-white hover:text-[#C9A227] transition-colors leading-snug line-clamp-2">
                  {{ $item->nama }}
                </h2>
              </a>
              @if(!empty($item->deskripsi))
                <p class="text-xs text-[#A0AAB9] line-clamp-2 mt-1 font-light">
                  {{ $item->deskripsi }}
                </p>
              @endif
            </div>

            <!-- Single Row: Price & Pesan Button (R-26) -->
            <div class="pt-3 border-t border-white/5 flex items-center justify-between gap-2">
              <div>
                <span class="block text-[10px] uppercase tracking-wider text-[#6E7889]">Harga</span>
                <span class="font-semibold text-sm sm:text-base text-[#C9A227] tabular-nums">
                  {{ $item->harga_rupiah ?? 'Rp ' . number_format($item->harga, 0, ',', '.') }}
                </span>
              </div>

              <!-- Tombol Pesan (Guest dialihkan ke login, disabled jika stok 0) -->
              @if($item->stok > 0)
                @auth
                  <form action="{{ route('keranjang.store') }}" method="POST" class="m-0">
                    @csrf
                    <input type="hidden" name="parfum_id" value="{{ $item->id }}">
                    <button type="submit" class="btn-gold px-4 py-2 rounded-sm text-xs font-semibold tracking-wider uppercase transition-all flex items-center gap-1.5 shadow-sm">
                      <i class="bi bi-cart-plus"></i> Pesan
                    </button>
                  </form>
                @else
                  <a href="{{ route('login', ['pesan' => 1]) }}"
                     class="btn-gold px-4 py-2 rounded-sm text-xs font-semibold tracking-wider uppercase transition-all flex items-center gap-1.5 shadow-sm">
                    Pesan
                  </a>
                @endauth
              @else
                <button type="button" disabled
                        class="px-4 py-2 rounded-sm text-xs font-semibold tracking-wider uppercase bg-white/5 text-[#6E7889] border border-white/5 cursor-not-allowed">
                  Habis
                </button>
              @endif
            </div>
          </div>

        </div>
      @endforeach
    </div>
  @endif

  <!-- Customer Support Banner -->
  <section class="reveal-on-scroll rounded-sm border border-white/10 bg-[#101623] p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div class="space-y-1">
      <h3 class="text-base sm:text-lg font-bold text-white">Bingung Memilih Aroma?</h3>
      <p class="text-xs text-[#A0AAB9] font-light">
        Konsultasikan selera aroma dan rekomendasi parfum terbaik langsung dengan peracik kami melalui WhatsApp.
      </p>
    </div>
    <div>
      <a href="https://wa.me/6281234567890?text=Halo%20Tuan%20Parfum,%20saya%20ingin%20konsultasi%20pilihan%20aroma"
         target="_blank"
         rel="noopener noreferrer"
         class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold whitespace-nowrap inline-flex items-center gap-2">
        <i class="bi bi-whatsapp"></i> Konsultasi WhatsApp
      </a>
    </div>
  </section>

</div>
@endsection
