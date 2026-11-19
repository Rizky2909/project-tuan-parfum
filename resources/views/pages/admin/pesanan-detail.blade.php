@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $id . ' – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <div class="flex items-center gap-3">
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
          Detail Pesanan #TP-000{{ $id }}
        </h1>
        <span class="px-2.5 py-0.5 bg-[#C9A227]/10 border border-[#C9A227]/30 text-[#C9A227] text-xs font-semibold uppercase tracking-wider rounded-sm">
          Dikemas
        </span>
      </div>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Dipesan pada 28 Oktober 2026, 14:30 WIB</p>
    </div>
    <a href="{{ route('admin.pesanan') }}" class="text-xs text-[#A0AAB9] hover:text-[#C9A227] uppercase tracking-wider transition-colors inline-flex items-center gap-1.5">
      <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
    </a>
  </div>

  <form action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    @csrf

    <!-- Kolom Kiri: Data Pemesan & Rincian Produk -->
    <div class="lg:col-span-7 space-y-6 reveal-on-scroll">

      <!-- Data Pelanggan -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Informasi Pelanggan &amp; Pengiriman
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
          <div>
            <span class="text-[#A0AAB9] block mb-0.5">Nama Penerima:</span>
            <span class="text-white font-medium text-sm">Budi Prasetyo</span>
          </div>
          <div>
            <span class="text-[#A0AAB9] block mb-0.5">Nomor WhatsApp:</span>
            <span class="text-[#C9A227] font-medium text-sm">0812-3456-7890</span>
          </div>
          <div class="sm:col-span-2">
            <span class="text-[#A0AAB9] block mb-0.5">Alamat Lengkap:</span>
            <span class="text-white">Jl. Raya Sungai Bangek, RT 02 / RW 05, Kelurahan Balai Gadang, Koto Tangah, Kota Padang</span>
          </div>
        </div>
      </div>

      <!-- Rincian Produk -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Rincian Produk yang Dipesan
        </h2>

        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-[#E8ECF2]">
            <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
              <tr>
                <th class="py-3 px-4">Parfum</th>
                <th class="py-3 px-4 text-center">Jumlah</th>
                <th class="py-3 px-4 text-right">Harga Satuan</th>
                <th class="py-3 px-4 text-right">Subtotal</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-xs">
              <tr>
                <td class="py-3 px-4 font-medium text-white">Oud Imperial Extrait (100 ml)</td>
                <td class="py-3 px-4 text-center tabular-nums">2</td>
                <td class="py-3 px-4 text-right tabular-nums">Rp 150.000</td>
                <td class="py-3 px-4 text-right font-semibold text-[#C9A227] tabular-nums">Rp 300.000</td>
              </tr>
              <tr>
                <td class="py-3 px-4 font-medium text-white">Santal Velvet (50 ml)</td>
                <td class="py-3 px-4 text-center tabular-nums">1</td>
                <td class="py-3 px-4 text-right tabular-nums">Rp 90.000</td>
                <td class="py-3 px-4 text-right font-semibold text-[#C9A227] tabular-nums">Rp 90.000</td>
              </tr>
            </tbody>
            <tfoot class="border-t border-white/10 text-xs font-semibold">
              <tr>
                <td colspan="3" class="py-3 px-4 uppercase text-[#A0AAB9]">Total Pesanan:</td>
                <td class="py-3 px-4 text-right text-base text-[#C9A227] tabular-nums">Rp 390.000</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>

    <!-- Kolom Kanan: Verifikasi Bukti Bayar & Status Kurir -->
    <div class="lg:col-span-5 space-y-6 reveal-on-scroll">

      <!-- Bukti Pembayaran -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Verifikasi Pembayaran
        </h2>

        <div class="space-y-3">
          <div class="aspect-[4/3] bg-[#161E2E] rounded-sm border border-white/10 flex flex-col items-center justify-center text-center p-4">
            <i class="bi bi-receipt text-3xl text-[#C9A227] mb-2"></i>
            <span class="text-xs text-white font-medium">Bukti Transfer Bank BCA</span>
            <span class="text-[10px] text-[#A0AAB9]">Nominal: Rp 390.000 • Sesuai Tagihan</span>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <button type="button" class="py-2 rounded-sm bg-[#34D399]/15 border border-[#34D399]/40 text-[#34D399] text-xs font-semibold uppercase tracking-wider hover:bg-[#34D399]/25 transition-colors">
              <i class="bi bi-check2"></i> Bukti Valid
            </button>
            <button type="button" class="py-2 rounded-sm bg-[#F87171]/15 border border-[#F87171]/40 text-[#F87171] text-xs font-semibold uppercase tracking-wider hover:bg-[#F87171]/25 transition-colors">
              <i class="bi bi-x"></i> Tidak Valid
            </button>
          </div>
        </div>
      </div>

      <!-- Pengaturan Status & Penugasan Kurir -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Status &amp; Penugasan
        </h2>

        <div class="space-y-4">
          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Status Pesanan
            </label>
            <select class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-3 py-2 text-xs text-white focus:outline-none focus:border-[#C9A227]">
              <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
              <option value="Diproses">Diproses</option>
              <option value="Dikemas" selected>Dikemas</option>
              <option value="Dikirim">Dikirim</option>
              <option value="Selesai">Selesai</option>
              <option value="Dibatalkan">Dibatalkan</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Tugaskan Kurir Pengantar
            </label>
            <select class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-3 py-2 text-xs text-white focus:outline-none focus:border-[#C9A227]">
              <option value="">Pilih Kurir Lapangan</option>
              <option value="1" selected>Kurir 1 (Area Sungai Bangek)</option>
              <option value="2">Kurir 2 (Area Koto Tangah / Pusat Padang)</option>
            </select>
          </div>

          <button type="button" onclick="alert('Perubahan status pesanan berhasil disimpan!')"
                  class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
            Simpan Perubahan Pesanan
          </button>
        </div>
      </div>

    </div>

  </form>

</div>
@endsection
