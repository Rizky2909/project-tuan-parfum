@extends('layouts.app')

@section('title', 'Keranjang Belanja – Tuan Parfum')

@section('content')
<div class="space-y-8">

  <!-- Stepper Alur Transaksi (Sesuai Dokumentasi 7.3) -->
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

  <div class="reveal-on-scroll border-b border-white/10 pb-4">
    <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Keranjang Belanja</h1>
    <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Daftar wewangian pilihan yang siap Anda pesan</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Daftar Item Keranjang -->
    <div class="lg:col-span-8 space-y-4 reveal-on-scroll">
      <div class="card-luxury overflow-hidden rounded-sm bg-[#101623] border border-white/10">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-[#E8ECF2]">
            <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.12em] text-[#A0AAB9] border-b border-white/10">
              <tr>
                <th class="py-3.5 px-5">Produk</th>
                <th class="py-3.5 px-4">Harga</th>
                <th class="py-3.5 px-4 text-center">Jumlah</th>
                <th class="py-3.5 px-4">Subtotal</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-4 px-5">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-16 rounded-sm bg-[#131824] border border-white/10 flex-shrink-0 flex flex-col items-center justify-center text-center p-1">
                      <span class="font-serif text-xs font-bold text-[#C9A227]">TP</span>
                      <span class="text-[8px] text-[#A0AAB9] uppercase">100 ml</span>
                    </div>
                    <div>
                      <h4 class="font-serif font-bold text-white text-base">Oud Imperial Extrait</h4>
                      <p class="text-xs text-[#A0AAB9]">Unisex | 100 ml</p>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4 font-medium text-[#C9A227] tabular-nums">Rp 150.000</td>
                <td class="py-4 px-4 text-center">
                  <input type="number"
                         class="w-16 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-sm text-white focus:outline-none focus:border-[#C9A227] tabular-nums"
                         value="2" min="1" max="20">
                </td>
                <td class="py-4 px-4 font-semibold text-white tabular-nums">Rp 300.000</td>
                <td class="py-4 px-4 text-right">
                  <button type="button" class="text-[#F87171] hover:text-red-300 p-2 transition-colors" title="Hapus produk">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>

              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-4 px-5">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-16 rounded-sm bg-[#131824] border border-white/10 flex-shrink-0 flex flex-col items-center justify-center text-center p-1">
                      <span class="font-serif text-xs font-bold text-[#C9A227]">TP</span>
                      <span class="text-[8px] text-[#A0AAB9] uppercase">50 ml</span>
                    </div>
                    <div>
                      <h4 class="font-serif font-bold text-white text-base">Santal Velvet</h4>
                      <p class="text-xs text-[#A0AAB9]">Pria | 50 ml</p>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4 font-medium text-[#C9A227] tabular-nums">Rp 90.000</td>
                <td class="py-4 px-4 text-center">
                  <input type="number"
                         class="w-16 bg-[#161E2E] border border-white/10 rounded-sm px-2 py-1 text-center text-sm text-white focus:outline-none focus:border-[#C9A227] tabular-nums"
                         value="1" min="1" max="10">
                </td>
                <td class="py-4 px-4 font-semibold text-white tabular-nums">Rp 90.000</td>
                <td class="py-4 px-4 text-right">
                  <button type="button" class="text-[#F87171] hover:text-red-300 p-2 transition-colors" title="Hapus produk">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="pt-2">
        <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#C9A227] hover:text-[#DFB942] transition-colors">
          <i class="bi bi-arrow-left"></i> Tambah Parfum Lain dari Katalog
        </a>
      </div>
    </div>

    <!-- Ringkasan Pesanan -->
    <div class="lg:col-span-4 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-7 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h3 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Ringkasan Belanja
        </h3>

        <div class="space-y-3 text-sm">
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Total Item:</span>
            <span class="text-white font-medium">3 Botol</span>
          </div>
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Pengiriman:</span>
            <span class="text-[#34D399] font-medium text-xs uppercase tracking-wider">Gratis (Area Padang)</span>
          </div>
          <div class="border-t border-white/10 pt-4 flex justify-between items-baseline">
            <span class="text-xs font-semibold uppercase tracking-wider text-white">Total Akhir:</span>
            <span class="font-semibold text-2xl text-[#C9A227] tabular-nums">Rp 390.000</span>
          </div>
        </div>

        <a href="{{ route('checkout') }}"
           class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
          Lanjut ke Alamat Pengiriman <i class="bi bi-arrow-right"></i>
        </a>

        <div class="pt-2 text-center">
          <span class="text-[11px] text-[#A0AAB9] flex items-center justify-center gap-1.5">
            <i class="bi bi-shield-check text-[#C9A227]"></i> Pemesanan Terverifikasi
          </span>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection
