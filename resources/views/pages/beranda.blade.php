@extends('layouts.app')

@section('title', 'Tuan Parfum – Toko Parfum Online Sungai Bangek')

@section('content')
<div class="space-y-16 animate-subtle-in">

  <!-- Hero Section -->
  <section class="reveal-on-scroll relative overflow-hidden border border-white/10 bg-[#0F1420] rounded-sm group">
    <!-- Image Background -->
    <div class="absolute inset-0 w-full h-full pointer-events-none select-none overflow-hidden">
      <img src="{{ asset('images/banner-tuan.jpeg') }}"
           alt="Tuan Parfum Banner"
           class="w-full h-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-[1.02]">
      <!-- Dark clean overlay -->
      <div class="absolute inset-0 bg-[#0A0E17]/85"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 px-6 py-16 sm:px-12 sm:py-24 max-w-2xl">
      <span class="text-xs font-semibold tracking-wider text-[#C9A227] uppercase block mb-3 font-sans">
        Toko Parfum Sungai Bangek, Padang
      </span>

      <h1 class="font-serif text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight mb-4">
        Pesan Parfum Favorit Anda Secara Online
      </h1>

      <p class="text-sm sm:text-base text-[#9AA3B2] leading-relaxed mb-8 font-light">
        Tersedia pilihan aroma untuk pria, wanita, dan unisex. Pesan langsung dari rumah tanpa harus datang ke toko, pesanan diantar oleh kurir ke alamat Anda.
      </p>

      <div class="flex flex-wrap items-center gap-3">
        <a href="{{ route('katalog') }}"
           class="btn-gold px-6 py-3 rounded-sm text-xs font-semibold tracking-wider uppercase transition-colors">
          Lihat Katalog
        </a>
        <a href="{{ route('pesanan') }}"
           class="btn-outline-gold px-6 py-3 rounded-sm text-xs font-semibold tracking-wider uppercase transition-colors">
          Cek Pesanan
        </a>
      </div>
    </div>
  </section>

  <!-- Katalog Parfum Section (Professional 3:4 Cards) -->
  <section class="reveal-on-scroll space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 border-b border-white/10 pb-4">
      <div>
        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
          Katalog Parfum
        </h2>
        <p class="text-xs text-[#9AA3B2] mt-1 font-light">
          Pilihan parfum yang tersedia dan siap dipesan.
        </p>
      </div>
      <a href="{{ route('katalog') }}"
         class="text-xs font-semibold tracking-wider text-[#C9A227] hover:text-[#E7B63C] uppercase transition-colors">
        Lihat Semua di Katalog &rarr;
      </a>
    </div>

    <!-- Product Grid: Professional 3:4 Vertical Cards with Staggered Items -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger-parent">
      @forelse($parfums ?? [] as $item)
        <div class="stagger-item group card-luxury card-interactive rounded-sm overflow-hidden border border-white/10 hover:border-[#C9A227] flex flex-col justify-between bg-[#101623]">

          <!-- 3:4 Product Visual Container -->
          <a href="{{ route('katalog.detail', $item->id) }}" class="relative aspect-[3/4] w-full overflow-hidden bg-[#151B28] block">
            @if(!empty($item->foto))
              <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}"
                   class="w-full h-full object-cover object-center img-zoom-smooth">
            @else
              <!-- Minimalist Perfume Silhouette Visual Placeholder (3:4) -->
              <div class="w-full h-full bg-[#131824] p-5 flex flex-col justify-between items-center text-center relative border-b border-white/5 group-hover:bg-[#161D2C] transition-colors">
                <div class="w-full flex justify-between items-center text-[10px] text-[#9AA3B2] uppercase tracking-wider">
                  <span class="px-2 py-0.5 bg-[#0A0E17] border border-white/10 text-white font-medium">
                    {{ $item->kategori }}
                  </span>
                  <span>{{ $item->volume }} ml</span>
                </div>

                <!-- Bottle Graphic & Monogram -->
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
                  @if($item->stok > 0)
                    <span class="text-emerald-400 font-medium inline-flex items-center">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1.5 animate-soft-pulse"></span>
                      Tersedia ({{ $item->stok }} Botol)
                    </span>
                  @else
                    <span class="text-red-400 font-medium inline-flex items-center">
                      <span class="w-1.5 h-1.5 rounded-full bg-red-400 mr-1.5"></span>
                      Stok Habis
                    </span>
                  @endif
                </div>
              </div>
            @endif
          </a>

          <!-- Compact Metadata: Clean & Efficient Space -->
          <div class="p-4 flex flex-col flex-grow justify-between gap-3">
            <div>
              <div class="flex items-center justify-between text-[11px] text-[#9AA3B2] uppercase tracking-wider mb-1">
                <span>{{ $item->kategori }}</span>
                <span>{{ $item->volume }} ml</span>
              </div>
              <a href="{{ route('katalog.detail', $item->id) }}" class="block">
                <h3 class="font-serif text-base font-bold text-white hover:text-[#C9A227] transition-colors leading-snug">
                  {{ $item->nama }}
                </h3>
              </a>
            </div>

            <!-- Single Sleek Row: Price & Order Action -->
            <div class="pt-3 border-t border-white/5 flex items-center justify-between">
              <span class="font-bold text-sm text-[#C9A227] tabular-nums">
                {{ $item->harga_rupiah ?? 'Rp ' . number_format($item->harga, 0, ',', '.') }}
              </span>
              <!-- Guest diarahkan ke login saat memesan -->
              @auth
                <form action="{{ route('keranjang.store') }}" method="POST" class="m-0">
                  @csrf
                  <input type="hidden" name="parfum_id" value="{{ $item->id }}">
                  <button type="submit" class="btn-gold px-3.5 py-1.5 rounded-sm text-xs font-semibold tracking-wider uppercase transition-all flex items-center gap-1">
                    <i class="bi bi-cart-plus"></i> Pesan
                  </button>
                </form>
              @else
                <a href="{{ route('login', ['pesan' => 1]) }}"
                   class="btn-gold px-3.5 py-1.5 rounded-sm text-xs font-semibold tracking-wider uppercase transition-all">
                  Pesan
                </a>
              @endauth
            </div>
          </div>

        </div>
      @empty
        <!-- Fallback jika database masih kosong -->
        @foreach(['Oud Imperial' => 650000, 'Santal Velvet' => 520000, 'Rose Ébène' => 580000, 'Bergamot Drift' => 480000] as $nama => $harga)
          <div class="stagger-item card-luxury card-interactive rounded-sm overflow-hidden border border-white/10 bg-[#101623] flex flex-col justify-between">
            <div class="aspect-[3/4] bg-[#131824] p-5 flex flex-col justify-between items-center text-center">
              <div class="w-full flex justify-between text-[10px] text-[#9AA3B2] uppercase">
                <span>Unisex</span><span>100 ml</span>
              </div>
              <div class="my-auto flex flex-col items-center">
                <span class="font-serif text-lg text-[#C9A227] font-bold tracking-widest">TP</span>
                <span class="font-serif text-sm text-white font-semibold mt-1">{{ $nama }}</span>
                <span class="text-[9px] uppercase tracking-wider text-[#C9A227] mt-0.5">Tuan Parfum</span>
              </div>
              <div class="w-full text-left text-[9px] text-emerald-400">Tersedia</div>
            </div>
            <div class="p-4 flex flex-col justify-between gap-3 border-t border-white/5">
              <h3 class="font-serif text-base font-bold text-white">{{ $nama }}</h3>
              <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-[#C9A227] tabular-nums">Rp {{ number_format($harga, 0, ',', '.') }}</span>
                <a href="{{ Auth::check() ? route('keranjang') : route('login', ['pesan' => 1]) }}" class="btn-gold px-3 py-1 text-xs font-semibold rounded-sm">Pesan</a>
              </div>
            </div>
          </div>
        @endforeach
      @endforelse
    </div>
  </section>

  <!-- Informasi Layanan (Staggered Children) -->
  <section class="reveal-on-scroll grid grid-cols-1 md:grid-cols-3 gap-6 stagger-parent">

    <!-- Card 1 -->
    <div class="stagger-item card-luxury card-interactive p-6 rounded-sm border border-white/10 bg-[#101623] space-y-2 group">
      <div class="text-[#C9A227] group-hover:text-[#DFB942] transition-colors font-mono text-sm font-bold mb-2">01</div>
      <h3 class="font-bold text-white text-base group-hover:text-[#C9A227] transition-colors">Pilihan Aroma Lengkap</h3>
      <p class="text-xs text-[#9AA3B2] leading-relaxed font-light">
        Tersedia parfum untuk pria, wanita, dan unisex dengan deskripsi notes aroma yang jelas.
      </p>
    </div>

    <!-- Card 2 -->
    <div class="stagger-item card-luxury card-interactive p-6 rounded-sm border border-white/10 bg-[#101623] space-y-2 group">
      <div class="text-[#C9A227] group-hover:text-[#DFB942] transition-colors font-mono text-sm font-bold mb-2">02</div>
      <h3 class="font-bold text-white text-base group-hover:text-[#C9A227] transition-colors">Pemesanan Mudah</h3>
      <p class="text-xs text-[#9AA3B2] leading-relaxed font-light">
        Pilih parfum, tentukan jumlah pesanan, dan isi alamat pengiriman dengan praktis.
      </p>
    </div>

    <!-- Card 3 -->
    <div class="stagger-item card-luxury card-interactive p-6 rounded-sm border border-white/10 bg-[#101623] space-y-2 group">
      <div class="text-[#C9A227] group-hover:text-[#DFB942] transition-colors font-mono text-sm font-bold mb-2">03</div>
      <h3 class="font-bold text-white text-base group-hover:text-[#C9A227] transition-colors">Pengantaran Langsung</h3>
      <p class="text-xs text-[#9AA3B2] leading-relaxed font-light">
        Pesanan dikemas rapi dan diantar oleh kurir langsung ke alamat Anda di wilayah Padang dan sekitarnya.
      </p>
    </div>

  </section>

  <!-- Kontak & Bantuan (Efisien & jelas) -->
  <section class="reveal-on-scroll rounded-sm border border-white/10 bg-[#101623] p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div class="space-y-1">
      <h3 class="text-lg font-bold text-white">Butuh Rekomendasi Aroma?</h3>
      <p class="text-xs text-[#9AA3B2] font-light">
        Jika Anda bingung memilih parfum yang cocok, silakan hubungi kami via WhatsApp untuk konsultasi aroma atau ketersediaan stok.
      </p>
    </div>
    <div>
      <a href="https://wa.me/6281234567890?text=Halo%20Tuan%20Parfum,%20saya%20mau%20tanya%20produk%20parfum"
         target="_blank"
         rel="noopener noreferrer"
         class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold whitespace-nowrap inline-flex items-center gap-2">
        <i class="bi bi-whatsapp"></i> Chat WhatsApp
      </a>
    </div>
  </section>

</div>
@endsection
