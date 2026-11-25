@extends('layouts.admin')

@section('title', 'Dashboard Statistik – Admin Tuan Parfum')

@section('content')
<div class="space-y-8">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Dashboard Statistik</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Ringkasan performa penjualan dan status operasional inventaris</p>
    </div>
    <div class="text-xs text-[#A0AAB9]">
      Pembaruan: <span class="text-white font-medium">{{ date('d M Y, H:i') }} WIB</span>
    </div>
  </div>

  <!-- KPI Metrik Cards -->
  <div class="stagger-parent grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    <!-- Card 1: Menunggu Verifikasi -->
    <a href="{{ route('admin.pesanan', ['status' => 'menunggu_verifikasi']) }}"
       class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border {{ ($menungguVerifikasiCount ?? 0) > 0 ? 'border-indigo-500/50 bg-indigo-950/20' : 'border-white/10' }} space-y-2 block">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Menunggu Verifikasi</span>
        <i class="bi bi-clock-history text-indigo-400 text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-indigo-300 tabular-nums">
        {{ $menungguVerifikasiCount ?? 0 }}
      </div>
      <p class="text-[11px] {{ ($menungguVerifikasiCount ?? 0) > 0 ? 'text-indigo-300 font-semibold' : 'text-[#A0AAB9]' }}">
        {{ ($menungguVerifikasiCount ?? 0) > 0 ? 'Perlu tindakan verifikasi segera' : 'Semua bukti telah diperiksa' }}
      </p>
    </a>

    <!-- Card 2: Perlu Dikirim / Diproses -->
    <a href="{{ route('admin.pesanan', ['status' => 'diproses']) }}"
       class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2 block">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Perlu Dikirim</span>
        <i class="bi bi-box-seam text-[#C9A227] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#C9A227] tabular-nums">
        {{ $perluDikirimCount ?? 0 }}
      </div>
      <p class="text-[11px] text-[#A0AAB9]">Pesanan dalam proses kemas/antar</p>
    </a>

    <!-- Card 3: Total Pendapatan Selesai -->
    <div class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border border-white/10 space-y-2">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Total Pendapatan</span>
        <i class="bi bi-cash-stack text-[#34D399] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#34D399] tabular-nums">
        Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
      </div>
      <p class="text-[11px] text-[#A0AAB9]">Dari {{ $pesananSelesaiCount ?? 0 }} transaksi pesanan selesai</p>
    </div>

    <!-- Card 4: Stok Menipis -->
    <a href="{{ route('admin.stok') }}"
       class="stagger-item card-interactive card-luxury p-5 rounded-sm bg-[#101623] border {{ ($stokRendahCount ?? 0) > 0 ? 'border-amber-500/50' : 'border-white/10' }} space-y-2 block">
      <div class="flex items-center justify-between text-xs text-[#A0AAB9] uppercase tracking-wider">
        <span>Stok Menipis</span>
        <i class="bi bi-exclamation-triangle text-[#F87171] text-base"></i>
      </div>
      <div class="text-2xl sm:text-3xl font-bold text-[#F87171] tabular-nums">
        {{ $stokRendahCount ?? 0 }} Varian
      </div>
      <p class="text-[11px] text-[#A0AAB9]">Sisa stok &le; 5 botol wewangian</p>
    </a>

  </div>

  <!-- Layout Tengah: Peringatan Stok Rendah & Rangkuman Operasional -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Rangkuman Operasional Toko -->
    <div class="lg:col-span-7 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
          <h2 class="font-serif text-lg font-bold text-white">Status Operasional & Pengiriman</h2>
          <span class="text-xs text-[#C9A227] font-semibold uppercase tracking-wider">Sungai Bangek, Padang</span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs">
          <div class="p-4 rounded-sm bg-[#151B2C] border border-white/5 space-y-1">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[10px]">Belum Dibayar:</span>
            <div class="text-xl font-bold text-white tabular-nums">{{ $menungguPembayaranCount ?? 0 }}</div>
            <p class="text-[11px] text-[#A0AAB9]">Menunggu transfer pelanggan</p>
          </div>

          <div class="p-4 rounded-sm bg-[#151B2C] border border-white/5 space-y-1">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[10px]">Pesanan Selesai:</span>
            <div class="text-xl font-bold text-emerald-400 tabular-nums">{{ $pesananSelesaiCount ?? 0 }}</div>
            <p class="text-[11px] text-[#A0AAB9]">Paket berhasil terantar</p>
          </div>
        </div>

        <div class="p-4 rounded-sm bg-[#151B2C] border border-white/5 flex items-center justify-between text-xs">
          <div>
            <span class="font-bold text-white block">Ketentuan Pengiriman Toko:</span>
            <span class="text-[#A0AAB9]">Area Padang flat Rp 15.000 • Gratis jika order &ge; Rp 500.000</span>
          </div>
          <a href="{{ route('admin.pesanan') }}" class="btn-gold px-4 py-2 rounded-sm text-xs uppercase tracking-wider">
            Buka Pesanan
          </a>
        </div>
      </div>
    </div>

    <!-- Peringatan Stok Rendah -->
    <div class="lg:col-span-5 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
          <h2 class="font-serif text-lg font-bold text-white">Peringatan Stok Rendah</h2>
          <a href="{{ route('admin.stok') }}" class="text-xs text-[#C9A227] hover:underline uppercase tracking-wider">
            Kelola Stok
          </a>
        </div>

        <div class="space-y-3">
          @forelse($stokRendah ?? [] as $parfum)
            <div class="p-3.5 rounded-sm bg-[#161E2E] border border-amber-500/20 flex items-center justify-between">
              <div>
                <h4 class="font-serif font-bold text-white text-sm">{{ $parfum->nama }}</h4>
                <p class="text-xs text-[#A0AAB9]">{{ $parfum->kategori }} | {{ $parfum->volume }} ml</p>
              </div>
              <span class="px-2.5 py-1 bg-amber-500/15 border border-amber-500/40 text-amber-300 text-xs font-semibold tabular-nums rounded-sm">
                Sisa {{ $parfum->stok }} Botol
              </span>
            </div>
          @empty
            <div class="p-4 text-center text-xs text-[#A0AAB9]">
              Semua stok parfum dalam batas aman (&gt; 5 botol).
            </div>
          @endforelse
        </div>
      </div>
    </div>

  </div>

  <!-- Tabel 5 Pesanan Terbaru -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
    <div class="flex items-center justify-between border-b border-white/10 pb-3">
      <h2 class="font-serif text-lg font-bold text-white">Pesanan Masuk Terbaru</h2>
      <a href="{{ route('admin.pesanan') }}" class="text-xs text-[#C9A227] hover:underline uppercase tracking-wider">
        Lihat Semua Pesanan &rarr;
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No. Pesanan</th>
            <th class="py-3 px-4">Pelanggan</th>
            <th class="py-3 px-4">Tanggal</th>
            <th class="py-3 px-4">Total</th>
            <th class="py-3 px-4">Status Pesanan</th>
            <th class="py-3 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          @forelse($pesananTerbaru ?? [] as $order)
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
              <td class="py-3.5 px-4">
                <x-order-status-badge :status="$order->status" />
              </td>
              <td class="py-3.5 px-4 text-right">
                <a href="{{ route('admin.pesanan.detail', $order->id) }}"
                   class="px-3 py-1.5 rounded-sm border border-white/10 hover:border-[#C9A227] text-xs uppercase tracking-wider text-white hover:text-[#C9A227] transition-colors inline-block">
                  Kelola
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-6 text-center text-xs text-[#A0AAB9]">
                Belum ada pesanan yang masuk ke sistem.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
