@extends('layouts.app')

@section('title', ($parfum->nama ?? 'Detail Parfum') . ' – Tuan Parfum')

@section('content')
<div class="space-y-10 animate-subtle-in">

  <!-- Breadcrumbs Navigasi (R-24) -->
  <nav class="flex items-center gap-2 text-xs text-[#A0AAB9]">
    <a href="{{ route('beranda') }}" class="hover:text-white transition-colors">Beranda</a>
    <span>/</span>
    <a href="{{ route('katalog') }}" class="hover:text-white transition-colors">Katalog</a>
    <span>/</span>
    <span class="text-[#C9A227] font-medium">{{ $parfum->nama ?? ('Parfum #' . $id) }}</span>
  </nav>

  @if(!$parfum)
    <!-- Empty State jika ID tidak ditemukan (R-27) -->
    <div class="card-luxury p-12 text-center rounded-sm bg-[#101623] border border-white/10 space-y-4">
      <h2 class="font-serif text-2xl font-bold text-white">Parfum Tidak Ditemukan</h2>
      <p class="text-xs text-[#A0AAB9]">Produk wewangian yang Anda cari tidak tersedia dalam basis data inventaris.</p>
      <a href="{{ route('katalog') }}" class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-block">
        Kembali ke Katalog
      </a>
    </div>
  @else
    <!-- Layout 2 Kolom (Sesuai Dokumentasi 7.1) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

      <!-- Kolom Kiri: Visual Showcase 3:4 Sticky -->
      <div class="reveal-on-scroll lg:col-span-5 lg:sticky lg:top-24 space-y-4">
        <div class="card-luxury card-interactive aspect-[3/4] w-full rounded-sm overflow-hidden bg-[#131824] relative border border-white/10 flex items-center justify-center group">
          @if(!empty($parfum->foto))
            <img src="{{ asset($parfum->foto) }}" alt="{{ $parfum->nama }}" class="w-full h-full object-cover img-zoom-smooth">
          @else
            <!-- Minimalist Perfume Bottle Silhouette Placeholder -->
            <div class="w-full h-full p-8 flex flex-col justify-between items-center text-center">
              <div class="w-full flex justify-between items-center text-xs text-[#A0AAB9] uppercase tracking-wider">
                <span class="px-2.5 py-1 bg-[#0A0E17] border border-white/10 text-white font-medium">
                  {{ $parfum->kategori }}
                </span>
                <span>{{ $parfum->volume }} ml</span>
              </div>

              <div class="my-auto flex flex-col items-center">
                <svg class="w-16 h-24 stroke-[#C9A227] fill-none stroke-[1.2] mb-3 opacity-85 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300" viewBox="0 0 24 38">
                  <rect x="7" y="2" width="10" height="6" rx="0.5" stroke="currentColor"/>
                  <rect x="9" y="8" width="6" height="2" stroke="currentColor"/>
                  <rect x="3" y="10" width="18" height="25" rx="1" stroke="currentColor"/>
                  <rect x="6" y="15" width="12" height="15" rx="0.5" stroke="currentColor" stroke-dasharray="1 1" opacity="0.6"/>
                  <text x="12" y="24" text-anchor="middle" font-size="5" fill="#C9A227" font-family="serif" font-weight="bold">TP</text>
                </svg>
                <span class="font-serif text-lg text-white font-semibold tracking-wider block">
                  {{ $parfum->nama }}
                </span>
                <span class="text-[10px] uppercase tracking-[0.28em] text-[#C9A227] mt-1 font-sans">
                  Tuan Parfum Padang
                </span>
              </div>

              <div class="w-full text-center text-xs text-[#6E7889]">
                Format Botol Rasio 3:4 Vertikal
              </div>
            </div>
          @endif

          <!-- Kategori & Volume Tag Overlay jika ada foto -->
          @if(!empty($parfum->foto))
            <div class="absolute top-4 left-4 right-4 flex justify-between items-center pointer-events-none">
              <span class="px-2.5 py-1 bg-[#0A0E17]/80 backdrop-blur-sm border border-white/10 text-xs uppercase font-semibold text-white">
                {{ $parfum->kategori }}
              </span>
              <span class="px-2.5 py-1 bg-[#0A0E17]/80 backdrop-blur-sm border border-white/10 text-xs uppercase font-medium text-[#A0AAB9]">
                {{ $parfum->volume }} ml
              </span>
            </div>
          @endif
        </div>
      </div>

      <!-- Kolom Kanan: Rincian Produk, Profil Aroma & Pemesanan -->
      <div class="reveal-on-scroll lg:col-span-7 space-y-6">

        <!-- Title & Category -->
        <div>
          <span class="text-xs font-semibold uppercase tracking-[0.16em] text-[#C9A227] block mb-1">
            {{ $parfum->kategori }} • {{ $parfum->volume }} ml
          </span>
          <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white tracking-wide">
            {{ $parfum->nama }}
          </h1>
        </div>

        <!-- Price & Stock Status Bar -->
        <div class="flex flex-wrap items-center gap-4 py-4 border-y border-white/10">
          <div>
            <span class="text-[10px] uppercase tracking-wider text-[#6E7889] block">Harga Satuan</span>
            <span class="font-semibold text-2xl sm:text-3xl text-[#C9A227] tabular-nums">
              {{ $parfum->harga_rupiah ?? ('Rp ' . number_format($parfum->harga, 0, ',', '.')) }}
            </span>
          </div>

          <div class="ml-auto">
            @if($parfum->stok > 5)
              <span class="px-3 py-1.5 bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] text-xs font-medium rounded-sm">
                Stok Tersedia ({{ $parfum->stok }} Botol)
              </span>
            @elseif($parfum->stok > 0)
              <span class="px-3 py-1.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-medium rounded-sm">
                Stok Terbatas (Sisa {{ $parfum->stok }} Botol)
              </span>
            @else
              <span class="px-3 py-1.5 bg-[#F87171]/10 border border-[#F87171]/30 text-[#F87171] text-xs font-medium rounded-sm">
                Stok Habis
              </span>
            @endif
          </div>
        </div>

        <!-- Deskripsi Produk -->
        <div class="space-y-2">
          <h3 class="text-xs uppercase font-semibold tracking-wider text-white">Deskripsi Aroma</h3>
          <p class="text-sm leading-relaxed text-[#A0AAB9] font-light">
            {{ $parfum->deskripsi ?? 'Wewangian extrait berkualitas tinggi racikan Tuan Parfum dengan ketahanan aroma yang optimal untuk menemani rutinitas harian maupun momen istimewa.' }}
          </p>
        </div>

        <!-- Piramida Karakter Aroma (Scent Notes - Staggered) -->
        <div class="card-luxury p-5 rounded-sm grid grid-cols-3 gap-4 text-center border border-white/10 bg-[#101623] stagger-parent is-visible">
          <div class="stagger-item space-y-1 p-2 rounded-sm hover:bg-[#161E2E] transition-colors group">
            <span class="text-[10px] uppercase font-semibold text-[#C9A227] group-hover:text-[#DFB942] block tracking-wider transition-colors">Top Notes</span>
            <p class="text-xs text-white font-medium">Citrus / Herbal</p>
            <p class="text-[10px] text-[#6E7889]">Kesan awal segar</p>
          </div>
          <div class="stagger-item space-y-1 border-x border-white/10 p-2 rounded-sm hover:bg-[#161E2E] transition-colors group">
            <span class="text-[10px] uppercase font-semibold text-[#C9A227] group-hover:text-[#DFB942] block tracking-wider transition-colors">Heart Notes</span>
            <p class="text-xs text-white font-medium">Floral / Spices</p>
            <p class="text-[10px] text-[#6E7889]">Karakter inti wangi</p>
          </div>
          <div class="stagger-item space-y-1 p-2 rounded-sm hover:bg-[#161E2E] transition-colors group">
            <span class="text-[10px] uppercase font-semibold text-[#C9A227] group-hover:text-[#DFB942] block tracking-wider transition-colors">Base Notes</span>
            <p class="text-xs text-white font-medium">Amber / Woody</p>
            <p class="text-[10px] text-[#6E7889]">Aroma jejak tahan lama</p>
          </div>
        </div>

        <!-- Spesifikasi Detail -->
        <div class="card-luxury p-4 rounded-sm border border-white/5 bg-[#161E2E] space-y-2 text-xs">
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Konsentrasi:</span>
            <span class="text-white font-medium">Extrait de Parfum</span>
          </div>
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Daya Tahan:</span>
            <span class="text-white font-medium">8 hingga 12 Jam</span>
          </div>
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Pengiriman:</span>
            <span class="text-white font-medium">Kurir Langsung Padang & Sekitarnya</span>
          </div>
        </div>

        <!-- Tombol Aksi Desktop -->
        <div class="space-y-3 pt-3">
          @if($parfum->stok > 0)
            @auth
              <form action="{{ route('keranjang.store') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="parfum_id" value="{{ $parfum->id }}">
                <div class="flex items-center gap-3">
                  <div class="inline-flex items-center border border-white/10 rounded-sm bg-[#161E2E] h-12">
                    <button type="button" onclick="let q = document.getElementById('detail-qty'); if(q.value > 1) q.value--;" class="px-3 py-2 text-white hover:text-[#C9A227] transition-colors">-</button>
                    <input type="number" id="detail-qty" name="qty" value="1" min="1" max="{{ $parfum->stok }}" class="w-12 bg-transparent text-center font-bold text-sm text-white tabular-nums border-none focus:outline-none">
                    <button type="button" onclick="let q = document.getElementById('detail-qty'); if(parseInt(q.value) < {{ $parfum->stok }}) q.value++;" class="px-3 py-2 text-white hover:text-[#C9A227] transition-colors">+</button>
                  </div>
                  <button type="submit" name="tambah_keranjang" value="1" class="flex-1 h-12 rounded-sm border border-[#C9A227]/60 hover:border-[#C9A227] text-[#C9A227] hover:bg-[#C9A227]/10 text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
                    <i class="bi bi-cart-plus"></i> + Keranjang
                  </button>
                </div>
                <button type="submit" name="beli_sekarang" value="1" class="btn-gold w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-md">
                  <i class="bi bi-bag-check-fill"></i> Pesan Langsung
                </button>
              </form>
            @else
              <a href="{{ route('login', ['pesan' => 1]) }}"
                 class="btn-gold w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-md">
                <i class="bi bi-bag"></i> Masuk untuk Memesan
              </a>
            @endauth
          @else
            <button type="button" disabled
                    class="w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider bg-white/5 text-[#6E7889] border border-white/5 cursor-not-allowed flex items-center justify-center">
              Produk Sedang Habis
            </button>
          @endif

          @guest
            <div class="p-3 bg-[#161E2E] border border-white/5 rounded-sm text-center">
              <p class="text-[11px] text-[#A0AAB9] font-light">
                Sebagai pengunjung, Anda akan diarahkan ke halaman login untuk melanjutkan pemesanan.
              </p>
            </div>
          @endguest

          <div>
            <a href="{{ route('katalog') }}" class="text-xs text-[#A0AAB9] hover:text-[#C9A227] transition-colors inline-flex items-center gap-1.5">
              <i class="bi bi-arrow-left"></i> Kembali ke Katalog
            </a>
          </div>
        </div>

      </div>

    </div>

    <!-- Sticky Bottom Action Bar Khusus Mobile (Dokumentasi 7.1) -->
    <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0A0E17]/95 backdrop-blur-md border-t border-white/10 p-3 px-4 flex items-center justify-between gap-4">
      <div>
        <span class="text-[10px] uppercase tracking-wider text-[#6E7889] block">Total</span>
        <span class="font-semibold text-lg text-[#C9A227] tabular-nums">
          {{ $parfum->harga_rupiah ?? ('Rp ' . number_format($parfum->harga, 0, ',', '.')) }}
        </span>
      </div>

      @if($parfum->stok > 0)
        @auth
          <form action="{{ route('keranjang.store') }}" method="POST" class="flex-1 max-w-[200px] m-0">
            @csrf
            <input type="hidden" name="parfum_id" value="{{ $parfum->id }}">
            <input type="hidden" name="beli_sekarang" value="1">
            <button type="submit" class="btn-gold w-full h-11 px-4 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
              Pesan Sekarang
            </button>
          </form>
        @else
          <a href="{{ route('login', ['pesan' => 1]) }}"
             class="btn-gold h-11 px-4 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 flex-1 max-w-[200px]">
            Masuk & Pesan
          </a>
        @endauth
      @else
        <button disabled class="h-11 px-6 rounded-sm text-xs font-semibold uppercase tracking-wider bg-white/5 text-[#6E7889] flex items-center justify-center flex-1 max-w-[200px]">
          Habis
        </button>
      @endif
    </div>
  @endif

</div>
@endsection
