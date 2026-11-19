@extends('layouts.app')

@section('title', 'Alamat & Pengiriman – Tuan Parfum')

@section('content')
<div class="space-y-8">

  <!-- Stepper Alur Transaksi (Sesuai Dokumentasi 7.3) -->
  <div class="reveal-on-scroll card-luxury p-4 rounded-sm bg-[#101623] border border-white/10">
    <div class="grid grid-cols-3 text-center text-xs font-semibold uppercase tracking-wider">
      <a href="{{ route('keranjang') }}" class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#34D399] pb-2 sm:pb-0 hover:text-white transition-colors">
        <span class="w-6 h-6 rounded-sm bg-[#34D399]/20 border border-[#34D399]/40 text-[#34D399] flex items-center justify-center text-xs font-bold">✓</span>
        <span>1. Keranjang</span>
      </a>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#C9A227] pb-2 sm:pb-0 border-b-2 sm:border-b-0 border-[#C9A227]">
        <span class="w-6 h-6 rounded-sm bg-[#C9A227] text-[#0A0E17] flex items-center justify-center text-xs font-bold">2</span>
        <span>2. Alamat &amp; Kirim</span>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#6E7889] pb-2 sm:pb-0">
        <span class="w-6 h-6 rounded-sm bg-white/5 border border-white/10 flex items-center justify-center text-xs">3</span>
        <span>3. Pembayaran</span>
      </div>
    </div>
  </div>

  <div class="reveal-on-scroll border-b border-white/10 pb-4">
    <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Alamat Pengiriman</h1>
    <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Lengkapi data penerima dan alamat pengantaran kurir</p>
  </div>

  <form action="{{ route('pembayaran') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Form Alamat & Opsi Pengiriman -->
    <div class="lg:col-span-7 space-y-6 reveal-on-scroll">

      <!-- Kartu Alamat Pengiriman -->
      <div class="card-luxury p-6 sm:p-8 space-y-5 rounded-sm bg-[#101623] border border-white/10">
        <div class="flex items-center gap-3 border-b border-white/10 pb-3">
          <i class="bi bi-geo-alt text-[#C9A227] text-lg"></i>
          <h2 class="font-serif text-xl font-bold text-white">Data Penerima</h2>
        </div>

        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Nama Lengkap Penerima
            </label>
            <input type="text" name="nama_penerima" required value="{{ Auth::user()->name ?? 'Muhammad Ihsan' }}"
                   placeholder="Contoh: Muhammad Ihsan"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Nomor WhatsApp / HP Aktif
            </label>
            <input type="text" name="nomor_hp" required value="081234567890"
                   placeholder="081234567890"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
            <span class="text-[11px] text-[#6E7889] mt-1 block">Kurir akan mengonfirmasi via WhatsApp sebelum pengantaran.</span>
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Alamat Lengkap &amp; Patokan Rumah
            </label>
            <textarea name="alamat" rows="3" required
                      placeholder="Nama jalan, nomor rumah, RT/RW, dan patokan dekat lokasi..."
                      class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">Jl. Raya Sungai Bangek, RT 02 / RW 05, Kelurahan Balai Gadang, Koto Tangah</textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">Kota / Kabupaten</label>
              <input type="text" name="kota" value="Kota Padang" readonly
                     class="w-full bg-[#131824] border border-white/5 rounded-sm px-4 py-2.5 text-sm text-[#A0AAB9] cursor-not-allowed">
            </div>
            <div>
              <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">Kode Pos</label>
              <input type="text" name="kode_pos" value="25175"
                     class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C9A227]">
            </div>
          </div>
        </div>
      </div>

      <!-- Kartu Metode Pembayaran -->
      <div class="card-luxury p-6 sm:p-8 space-y-5 rounded-sm bg-[#101623] border border-white/10">
        <div class="flex items-center gap-3 border-b border-white/10 pb-3">
          <i class="bi bi-credit-card text-[#C9A227] text-lg"></i>
          <h2 class="font-serif text-xl font-bold text-white">Metode Pembayaran</h2>
        </div>

        <div class="space-y-3">
          <label class="flex items-center gap-3 p-4 rounded-sm bg-[#161E2E] border border-[#C9A227]/40 cursor-pointer">
            <input type="radio" name="metode" value="transfer" checked class="accent-[#C9A227] w-4 h-4">
            <div>
              <span class="text-sm font-semibold text-white block">Transfer Bank Manual (BCA)</span>
              <span class="text-xs text-[#A0AAB9]">Nomor rekening dan upload bukti transfer disediakan di langkah berikutnya.</span>
            </div>
          </label>

          <label class="flex items-center gap-3 p-4 rounded-sm bg-[#161E2E] border border-white/10 cursor-pointer hover:border-white/20 transition-colors">
            <input type="radio" name="metode" value="qris" class="accent-[#C9A227] w-4 h-4">
            <div>
              <span class="text-sm font-semibold text-white block">QRIS Tuan Parfum</span>
              <span class="text-xs text-[#A0AAB9]">Pindai barcode QRIS via GoPay, OVO, DANA, BCA Mobile.</span>
            </div>
          </label>
        </div>
      </div>

    </div>

    <!-- Kolom Kanan: Ringkasan Pesanan -->
    <div class="lg:col-span-5 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-8 space-y-6 sticky top-28 rounded-sm bg-[#101623] border border-white/10">
        <h3 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Ringkasan Pesanan
        </h3>

        <div class="space-y-3 text-sm">
          <div class="flex justify-between items-center text-white">
            <div>
              <p class="font-medium">Oud Imperial Extrait</p>
              <p class="text-xs text-[#A0AAB9]">2 x Rp 150.000</p>
            </div>
            <span class="font-semibold tabular-nums">Rp 300.000</span>
          </div>

          <div class="flex justify-between items-center text-white">
            <div>
              <p class="font-medium">Santal Velvet</p>
              <p class="text-xs text-[#A0AAB9]">1 x Rp 90.000</p>
            </div>
            <span class="font-semibold tabular-nums">Rp 90.000</span>
          </div>

          <div class="border-t border-white/10 pt-3 flex justify-between text-[#A0AAB9]">
            <span>Ongkos Kirim Kurir:</span>
            <span class="text-[#34D399] font-medium text-xs uppercase tracking-wider">Gratis (Padang Area)</span>
          </div>

          <div class="border-t border-white/10 pt-4 flex justify-between items-baseline">
            <span class="text-xs font-semibold uppercase tracking-wider text-white">Total Tagihan:</span>
            <span class="font-semibold text-2xl text-[#C9A227] tabular-nums">Rp 390.000</span>
          </div>
        </div>

        <button type="submit"
                class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
          Lanjut ke Pembayaran <i class="bi bi-arrow-right"></i>
        </button>

        <p class="text-center text-[11px] text-[#6E7889]">
          Pesanan akan dikonfirmasi dan disiapkan setelah bukti pembayaran diverifikasi.
        </p>
      </div>
    </div>

  </form>

</div>
@endsection
