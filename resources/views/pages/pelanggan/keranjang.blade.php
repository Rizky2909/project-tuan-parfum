@extends('layouts.app')

@section('title', 'Keranjang Belanja – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16 md:pb-0">

  <!-- Stepper Alur Transaksi -->
  <div class="reveal-on-scroll card-luxury p-4 rounded-sm bg-[#101623] border border-white/10">
    <div class="grid grid-cols-3 text-center text-xs font-semibold uppercase tracking-wider">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#C9A227] pb-2 sm:pb-0 border-b-2 sm:border-b-0 border-[#C9A227]">
        <span class="w-6 h-6 rounded-sm bg-[#C9A227] text-[#0A0E17] flex items-center justify-center text-xs font-bold">1</span>
        <span>Keranjang</span>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#6E7889] pb-2 sm:pb-0">
        <span class="w-6 h-6 rounded-sm bg-white/5 border border-white/10 flex items-center justify-center text-xs">2</span>
        <span>Alamat &amp; Kirim</span>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#6E7889] pb-2 sm:pb-0">
        <span class="w-6 h-6 rounded-sm bg-white/5 border border-white/10 flex items-center justify-center text-xs">3</span>
        <span>Pembayaran</span>
      </div>
    </div>
  </div>

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Keranjang Belanja</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Daftar wewangian pilihan yang siap Anda pesan</p>
    </div>
    @if(!$cartItems->isEmpty())
      <form action="{{ route('keranjang.clear') }}" method="POST" onsubmit="return confirm('Kosongkan seluruh isi keranjang belanja?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-xs text-[#F87171] hover:text-red-300 uppercase tracking-wider flex items-center gap-1.5 transition-colors">
          <i class="bi bi-trash3"></i> Kosongkan Keranjang
        </button>
      </form>
    @endif
  </div>

  @if($cartItems->isEmpty())
    <!-- Empty State Bersih & Elegan -->
    <div class="reveal-on-scroll card-luxury p-12 sm:p-16 text-center rounded-sm bg-[#101623] border border-white/10 max-w-xl mx-auto space-y-6">
      <div class="w-16 h-16 rounded-sm border border-[#C9A227]/30 bg-[#151B2C] mx-auto flex items-center justify-center text-[#C9A227] text-2xl">
        <i class="bi bi-bag-x"></i>
      </div>
      <div class="space-y-2">
        <h2 class="font-serif text-2xl font-bold text-white">Keranjang Belanja Anda Masih Kosong</h2>
        <p class="text-xs text-[#A0AAB9] max-w-md mx-auto leading-relaxed">
          Pilihlah salah satu wewangian extrait racikan khas Tuan Parfum dari katalog wewangian untuk memulai pesanan Anda.
        </p>
      </div>
      <div>
        <a href="{{ route('katalog') }}" class="btn-gold px-8 py-3 rounded-sm text-xs font-semibold uppercase tracking-[0.16em] inline-flex items-center gap-2">
          <i class="bi bi-compass"></i> Jelajahi Katalog Wewangian
        </a>
      </div>
    </div>
  @else
    <!-- Layout 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

      <!-- Kolom Kiri: Daftar Item (8 Kolom) -->
      <div class="lg:col-span-8 space-y-4 reveal-on-scroll">

        <!-- Banner Progres Gratis Ongkir -->
        <div class="p-4 rounded-sm bg-[#151B2C] border border-white/10 space-y-2">
          <div class="flex items-center justify-between text-xs">
            <span class="flex items-center gap-2 text-[#E6E9EF]">
              <i class="bi bi-truck text-[#C9A227]"></i>
              @if($isFreeShipping)
                <span class="text-[#34D399] font-medium">Selamat! Pesanan Anda berhak atas Gratis Ongkir Kurir Padang</span>
              @else
                <span>Tambah <strong class="text-[#C9A227] tabular-nums">Rp {{ number_format($remainingForFreeShipping, 0, ',', '.') }}</strong> lagi untuk <strong>Gratis Ongkir</strong></span>
              @endif
            </span>
            <span class="text-[#9AA3B2] font-mono tabular-nums text-[11px]">{{ $progressPercent }}%</span>
          </div>
          <div class="w-full bg-[#101623] h-1.5 rounded-sm overflow-hidden border border-white/5">
            <div class="bg-[#C9A227] h-full transition-all duration-500" style="width: {{ $progressPercent }}%;"></div>
          </div>
        </div>

        <!-- Tabel Item Keranjang -->
        <div class="card-luxury overflow-hidden rounded-sm bg-[#101623] border border-white/10">
          <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#E8ECF2]">
              <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.12em] text-[#A0AAB9] border-b border-white/10">
                <tr>
                  <th class="py-3.5 px-5">Produk Wewangian</th>
                  <th class="py-3.5 px-4">Harga</th>
                  <th class="py-3.5 px-4 text-center">Jumlah</th>
                  <th class="py-3.5 px-4">Subtotal</th>
                  <th class="py-3.5 px-4 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-white/5">
                @foreach($cartItems as $item)
                  <tr class="hover:bg-white/[0.02] transition-colors">
                    <td class="py-4 px-5">
                      <div class="flex items-center gap-4">
                        <!-- Thumbnail 3:4 -->
                        <div class="w-12 h-16 rounded-sm bg-[#131824] border border-white/10 flex-shrink-0 overflow-hidden relative">
                          @if($item->parfum->foto)
                            <img src="{{ asset($item->parfum->foto) }}" alt="{{ $item->parfum->nama }}" class="w-full h-full object-cover">
                          @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-center p-1">
                              <span class="font-serif text-xs font-bold text-[#C9A227]">TP</span>
                              <span class="text-[7px] text-[#A0AAB9] uppercase">{{ $item->parfum->volume }}ml</span>
                            </div>
                          @endif
                        </div>
                        <div>
                          <a href="{{ route('katalog.detail', $item->parfum_id) }}" class="font-serif font-bold text-white text-base hover:text-[#C9A227] transition-colors">
                            {{ $item->parfum->nama }}
                          </a>
                          <p class="text-xs text-[#A0AAB9]">
                            {{ $item->parfum->kategori }} • {{ $item->parfum->volume }} ml
                          </p>
                          @if($item->parfum->stok <= 5)
                            <span class="inline-block mt-1 text-[10px] text-amber-400">
                              <i class="bi bi-exclamation-circle"></i> Sisa stok: {{ $item->parfum->stok }} botol
                            </span>
                          @endif
                        </div>
                      </div>
                    </td>

                    <td class="py-4 px-4 font-medium text-[#C9A227] tabular-nums whitespace-nowrap">
                      {{ $item->parfum->harga_rupiah }}
                    </td>

                    <!-- Stepper Kontrol Jumlah -->
                    <td class="py-4 px-4 text-center">
                      <div class="inline-flex items-center border border-white/10 rounded-sm bg-[#161E2E]">
                        <!-- Tombol Kurangi (-) -->
                        @if($item->qty > 1)
                          <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="qty" value="{{ $item->qty - 1 }}">
                            <button type="submit" class="px-2.5 py-1 text-white hover:text-[#C9A227] hover:bg-white/5 transition-colors" title="Kurangi">
                              -
                            </button>
                          </form>
                        @else
                          <span class="px-2.5 py-1 text-white/30 cursor-not-allowed">-</span>
                        @endif

                        <span class="px-3 py-1 text-xs font-semibold text-white tabular-nums border-x border-white/10 min-w-[2.5rem] text-center">
                          {{ $item->qty }}
                        </span>

                        <!-- Tombol Tambah (+) -->
                        @if($item->qty < $item->parfum->stok)
                          <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="qty" value="{{ $item->qty + 1 }}">
                            <button type="submit" class="px-2.5 py-1 text-white hover:text-[#C9A227] hover:bg-white/5 transition-colors" title="Tambah">
                              +
                            </button>
                          </form>
                        @else
                          <span class="px-2.5 py-1 text-white/30 cursor-not-allowed" title="Batas stok tercapai">+</span>
                        @endif
                      </div>
                    </td>

                    <td class="py-4 px-4 font-semibold text-white tabular-nums whitespace-nowrap">
                      {{ $item->subtotal_rupiah }}
                    </td>

                    <td class="py-4 px-4 text-right">
                      <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Hapus {{ $item->parfum->nama }} dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[#F87171] hover:text-red-300 p-2 transition-colors" title="Hapus produk">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="pt-2 flex justify-between items-center">
          <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#C9A227] hover:text-[#DFB942] transition-colors">
            <i class="bi bi-arrow-left"></i> Tambah Parfum Lain dari Katalog
          </a>
        </div>
      </div>

      <!-- Kolom Kanan: Ringkasan Sticky (4 Kolom Desktop) -->
      <div class="lg:col-span-4 reveal-on-scroll">
        <div class="card-luxury p-6 sm:p-7 space-y-6 rounded-sm bg-[#101623] border border-white/10 sticky top-28">
          <h3 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
            Ringkasan Belanja
          </h3>

          <div class="space-y-3 text-sm">
            <div class="flex justify-between text-[#A0AAB9]">
              <span>Total Item:</span>
              <span class="text-white font-medium tabular-nums">{{ $cartItems->sum('qty') }} Botol</span>
            </div>
            <div class="flex justify-between text-[#A0AAB9]">
              <span>Subtotal Produk:</span>
              <span class="text-white font-medium tabular-nums">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-[#A0AAB9]">
              <span>Estimasi Pengiriman:</span>
              @if($isFreeShipping)
                <span class="text-[#34D399] font-medium text-xs uppercase tracking-wider">Gratis (Padang Area)</span>
              @else
                <span class="text-white font-medium tabular-nums text-xs">Dihitung di Checkout</span>
              @endif
            </div>
            <div class="border-t border-white/10 pt-4 flex justify-between items-baseline">
              <span class="text-xs font-semibold uppercase tracking-wider text-white">Subtotal Akhir:</span>
              <span class="font-semibold text-2xl text-[#C9A227] tabular-nums">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
          </div>

          <a href="{{ route('checkout') }}"
             class="btn-gold w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
            Lanjut ke Checkout <i class="bi bi-arrow-right"></i>
          </a>

          <div class="pt-2 text-center space-y-1">
            <span class="text-[11px] text-[#A0AAB9] flex items-center justify-center gap-1.5">
              <i class="bi bi-shield-check text-[#C9A227]"></i> Transaksi Aman & Terverifikasi
            </span>
            <p class="text-[10px] text-[#9AA3B2]">Pusat Toko: Sungai Bangek, Kota Padang</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Mobile Sticky Bottom Bar (Hanya tampil di layar kecil) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#0D121D]/98 border-t border-[#C9A227]/30 p-4 backdrop-blur shadow-2xl">
      <div class="flex items-center justify-between gap-4">
        <div>
          <span class="text-[10px] uppercase tracking-wider text-[#9AA3B2] block">Total Belanja:</span>
          <span class="font-semibold text-lg text-[#C9A227] tabular-nums">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <a href="{{ route('checkout') }}" class="btn-gold px-6 py-3 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center gap-2">
          Checkout <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  @endif

</div>
@endsection
