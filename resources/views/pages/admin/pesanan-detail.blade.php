@extends('layouts.admin')

@section('title', 'Kelola Pesanan #' . $order->kode_order . ' – Admin Tuan Parfum')

@section('content')
<div class="space-y-6 pb-16">

  <!-- Header & Navigasi -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4 print:hidden">
    <div>
      <div class="flex items-center gap-3">
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
          Pesanan #{{ $order->kode_order }}
        </h1>
        <x-order-status-badge :status="$order->status" />
      </div>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1 font-mono">
        Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB oleh {{ $order->user->name ?? $order->penerima_nama }}
      </p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.pesanan') }}" class="text-xs text-[#A0AAB9] hover:text-[#C9A227] uppercase tracking-wider transition-colors inline-flex items-center gap-1.5">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
      </a>
      <button type="button" onclick="window.print()" class="px-4 py-2 rounded-sm border border-white/10 hover:border-[#C9A227] text-white hover:text-[#C9A227] text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5">
        <i class="bi bi-printer"></i> Cetak Struk / Label
      </button>
    </div>
  </div>

  <!-- Cetak Struk Thermal / Label Pengiriman Khusus Media Print -->
  <div class="hidden print:block p-8 bg-white text-black font-sans text-xs space-y-4">
    <div class="border-b-2 border-black pb-3 text-center">
      <h2 class="text-lg font-bold uppercase tracking-widest font-serif">TUAN PARFUM</h2>
      <p class="text-[10px]">Jl. Raya Sungai Bangek, Balai Gadang, Koto Tangah, Padang</p>
      <p class="text-[10px] font-mono">No. Pesanan: #{{ $order->kode_order }} | {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="grid grid-cols-2 gap-4 border-b border-black pb-3">
      <div>
        <p class="font-bold uppercase text-[10px]">Penerima:</p>
        <p class="font-bold">{{ $order->penerima_nama }}</p>
        <p>{{ $order->penerima_hp }}</p>
        <p>{{ $order->alamat_pengiriman }}</p>
        @if($order->patokan) <p>Patokan: {{ $order->patokan }}</p> @endif
      </div>
      <div>
        <p class="font-bold uppercase text-[10px]">Detail Pengiriman:</p>
        <p>Metode: {{ $order->metode_pengiriman_label }}</p>
        <p>Pembayaran: {{ $order->metode_pembayaran_label }}</p>
        @if($order->nomor_resi) <p>No. Resi: {{ $order->nomor_resi }}</p> @endif
      </div>
    </div>

    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="border-b border-black text-[10px] uppercase">
          <th class="py-1">Item Parfum</th>
          <th class="py-1 text-center">Qty</th>
          <th class="py-1 text-right">Harga</th>
          <th class="py-1 text-right">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
          <tr class="border-b border-gray-300">
            <td class="py-1">{{ $item->nama_parfum }} ({{ $item->volume }}ml)</td>
            <td class="py-1 text-center">{{ $item->qty }}</td>
            <td class="py-1 text-right">{{ $item->harga_satuan_rupiah }}</td>
            <td class="py-1 text-right">{{ $item->subtotal_rupiah }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="py-1 font-bold">Ongkos Kirim:</td>
          <td class="py-1 text-right font-bold">{{ $order->ongkir_rupiah }}</td>
        </tr>
        <tr class="border-t-2 border-black">
          <td colspan="3" class="py-1 font-bold text-sm">TOTAL:</td>
          <td class="py-1 text-right font-bold text-sm">{{ $order->total_harga_rupiah }}</td>
        </tr>
      </tfoot>
    </table>
    <div class="text-center text-[10px] pt-4">
      <p>Terima kasih atas pesanan wewangian Anda di Tuan Parfum Padang.</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start print:hidden">

    <!-- Kolom Kiri: Produk, Alamat Snapshot, & Timeline (7 Kolom) -->
    <div class="lg:col-span-7 space-y-6 reveal-on-scroll">

      <!-- Rincian Produk -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Rincian Produk Dipesan
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
              @foreach($order->items as $item)
                <tr>
                  <td class="py-3.5 px-4 font-medium text-white">
                    <span class="block text-sm font-serif font-bold">{{ $item->nama_parfum }}</span>
                    <span class="text-[#9AA3B2] text-[11px]">{{ $item->volume }} ml</span>
                  </td>
                  <td class="py-3.5 px-4 text-center tabular-nums">{{ $item->qty }}</td>
                  <td class="py-3.5 px-4 text-right tabular-nums">{{ $item->harga_satuan_rupiah }}</td>
                  <td class="py-3.5 px-4 text-right font-semibold text-[#C9A227] tabular-nums">{{ $item->subtotal_rupiah }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="border-t border-white/10 text-xs font-semibold">
              <tr>
                <td colspan="3" class="py-2.5 px-4 uppercase text-[#A0AAB9]">Subtotal:</td>
                <td class="py-2.5 px-4 text-right text-white tabular-nums">{{ $order->subtotal_rupiah }}</td>
              </tr>
              <tr>
                <td colspan="3" class="py-2 px-4 uppercase text-[#A0AAB9]">Ongkos Kirim:</td>
                <td class="py-2 px-4 text-right text-white tabular-nums">{{ $order->ongkir_rupiah }}</td>
              </tr>
              <tr class="border-t border-white/10">
                <td colspan="3" class="py-3 px-4 uppercase text-white font-bold">Total Nilai Pesanan:</td>
                <td class="py-3 px-4 text-right text-base text-[#C9A227] font-bold tabular-nums">{{ $order->total_harga_rupiah }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <!-- Snapshot Alamat Pengiriman & Kontak -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Snapshot Alamat & Pembeli
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Nama Penerima:</span>
            <span class="font-bold text-white text-sm">{{ $order->penerima_nama }}</span>
          </div>

          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Nomor WhatsApp:</span>
            <div class="flex items-center gap-2">
              <span class="font-mono text-[#C9A227] text-sm">{{ $order->penerima_hp }}</span>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->penerima_hp) }}" target="_blank"
                 class="px-2 py-0.5 rounded-sm bg-emerald-500/15 text-[#34D399] border border-emerald-500/40 text-[10px] font-semibold uppercase">
                <i class="bi bi-whatsapp"></i> Chat
              </a>
            </div>
          </div>

          <div class="sm:col-span-2">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Alamat Tujuan:</span>
            <p class="text-white leading-relaxed">{{ $order->alamat_pengiriman }}</p>
            @if($order->patokan)
              <p class="text-[#A0AAB9] text-[11px] mt-0.5">Patokan: {{ $order->patokan }}</p>
            @endif
          </div>

          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Metode Pengiriman:</span>
            <span class="text-[#C9A227] font-medium">{{ $order->metode_pengiriman_label }}</span>
          </div>

          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Metode Pembayaran:</span>
            <span class="text-white font-medium">{{ $order->metode_pembayaran_label }}</span>
          </div>

          @if($order->catatan_pembeli)
            <div class="sm:col-span-2 p-3 rounded-sm bg-[#151B2C] border border-white/5">
              <span class="text-[#9AA3B2] uppercase tracking-wider text-[10px] block mb-0.5">Catatan Pembeli:</span>
              <p class="text-white italic">"{{ $order->catatan_pembeli }}"</p>
            </div>
          @endif
        </div>
      </div>

      <!-- Riwayat Timeline Pesanan -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Timeline Riwayat Status
        </h2>

        <x-order-timeline :logs="$order->statusLogs" />
      </div>

    </div>

    <!-- Kolom Kanan: Panel Aksi Operasional Admin (5 Kolom) -->
    <div class="lg:col-span-5 space-y-6 reveal-on-scroll">

      <!-- Panel 1: Verifikasi Bukti Pembayaran -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Verifikasi Pembayaran
        </h2>

        @if($order->bukti_bayar)
          <div class="space-y-3">
            <span class="text-xs text-[#9AA3B2] block">Foto Bukti Transfer Pelanggan (Klik untuk memperbesar):</span>
            <div class="aspect-[4/3] rounded-sm overflow-hidden border border-white/10 bg-black/40 cursor-pointer group relative"
                 onclick="document.getElementById('proof-modal').classList.remove('hidden')">
              <img src="{{ asset($order->bukti_bayar) }}" alt="Bukti Transfer" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
              <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-semibold uppercase tracking-wider transition-opacity">
                <i class="bi bi-arrows-fullscreen mr-1.5"></i> Perbesar Foto
              </div>
            </div>

            <p class="text-[11px] text-[#A0AAB9]">
              Diunggah: <span class="text-white font-mono">{{ $order->dibayar_at ? $order->dibayar_at->format('d M Y H:i') : '-' }} WIB</span>
            </p>

            @if($order->status === 'menunggu_verifikasi')
              <div class="pt-2 space-y-2">
                <form action="{{ route('admin.pesanan.verifikasi', $order->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-md">
                    <i class="bi bi-check2-circle text-base"></i> Setujui & Proses Pesanan
                  </button>
                </form>

                <button type="button" onclick="document.getElementById('reject-modal').classList.remove('hidden')"
                        class="w-full h-10 rounded-sm border border-red-500/30 hover:border-red-500/60 text-red-400 text-xs font-semibold uppercase tracking-wider transition-colors">
                  <i class="bi bi-x-circle"></i> Tolak Bukti Transfer
                </button>
              </div>
            @endif
          </div>
        @else
          <div class="p-4 rounded-sm bg-[#151B2C] border border-white/5 text-xs text-[#A0AAB9] space-y-1">
            <span class="font-bold text-white block">Status Pembayaran:</span>
            @if($order->metode_pembayaran === 'cod')
              <p class="text-[#34D399]">Metode Bayar di Tempat (COD). Tagih pembayaran saat kurir mengantar paket.</p>
            @else
              <p class="text-amber-300">Pelanggan belum mengunggah bukti transfer bank.</p>
            @endif
          </div>
        @endif
      </div>

      <!-- Panel 2: Penugasan Kurir & Ekspedisi -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Penugasan Kurir Pengantar
        </h2>

        <form action="{{ route('admin.pesanan.kurir', $order->id) }}" method="POST" class="space-y-4 text-xs">
          @csrf
          <div>
            <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1.5">Pilih Kurir Toko</label>
            <select name="kurir_id" required class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2.5 text-white focus:outline-none focus:border-[#C9A227]">
              <option value="">-- Pilih Kurir Aktif --</option>
              @foreach($kurirList as $kurir)
                <option value="{{ $kurir->id }}" {{ $order->kurir_id === $kurir->id ? 'selected' : '' }}>
                  {{ $kurir->name }} ({{ $kurir->email }})
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1.5">Nomor Resi / Kode Tracking (Opsional)</label>
            <input type="text" name="nomor_resi" value="{{ old('nomor_resi', $order->nomor_resi) }}"
                   placeholder="Contoh: KURIR-TP-01"
                   class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2.5 text-white focus:outline-none focus:border-[#C9A227]">
          </div>

          <button type="submit" class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
            <i class="bi bi-bicycle"></i> Simpan Penugasan Kurir
          </button>
        </form>
      </div>

      <!-- Panel 3: Pembatalan Pesanan Admin -->
      @if($order->status !== 'selesai' && $order->status !== 'dibatalkan')
        <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-red-500/20 space-y-3">
          <h3 class="font-serif text-sm font-bold text-red-300">
            Batalkan Pesanan Ini
          </h3>
          <p class="text-xs text-[#A0AAB9] leading-relaxed">
            Pembatalan oleh Admin akan secara otomatis mengembalikan jumlah stok wewangian ke inventaris tabel produk.
          </p>

          <form action="{{ route('admin.pesanan.batal', $order->id) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan #{{ $order->kode_order }}? Stok produk akan otomatis dikembalikan ke inventaris.');"
                class="space-y-3 pt-1">
            @csrf
            <input type="text" name="alasan_batal" required placeholder="Sertakan alasan pembatalan..."
                   class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-red-400">

            <button type="submit" class="w-full h-10 rounded-sm bg-red-600/20 hover:bg-red-600/30 border border-red-500/40 text-red-300 text-xs font-semibold uppercase tracking-wider transition-colors">
              Batalkan Pesanan & Restock
            </button>
          </form>
        </div>
      @endif

    </div>

  </div>

</div>

<!-- Lightbox Modal untuk Bukti Transfer -->
@if($order->bukti_bayar)
  <div id="proof-modal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-md flex items-center justify-center p-4"
       onclick="this.classList.add('hidden')">
    <div class="max-w-2xl max-h-[90vh] p-2 relative" onclick="event.stopPropagation()">
      <button type="button" onclick="document.getElementById('proof-modal').classList.add('hidden')"
              class="absolute top-4 right-4 text-white text-2xl bg-black/60 rounded-full w-9 h-9 flex items-center justify-center hover:bg-black">
        &times;
      </button>
      <img src="{{ asset($order->bukti_bayar) }}" alt="Bukti Transfer Enlarge" class="max-h-[85vh] max-w-full rounded-sm border border-white/20 shadow-2xl object-contain">
    </div>
  </div>
@endif

<!-- Modal Tolak Bukti Transfer -->
<div id="reject-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="card-luxury p-6 sm:p-8 rounded-sm bg-[#101623] border border-white/20 w-full max-w-md space-y-4 animate-subtle-in">
    <div class="flex items-center justify-between border-b border-white/10 pb-3">
      <h3 class="font-serif text-lg font-bold text-white">Tolak Bukti Pembayaran</h3>
      <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')" class="text-[#A0AAB9] hover:text-white text-lg">&times;</button>
    </div>

    <form action="{{ route('admin.pesanan.tolak', $order->id) }}" method="POST" class="space-y-4 text-xs">
      @csrf
      <p class="text-[#A0AAB9] leading-relaxed">
        Sertakan catatan alasan mengapa bukti transfer tidak valid (misal: nominal kurang, bukti buram/palsu, nomor rekening salah).
      </p>

      <div>
        <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1.5">Alasan Penolakan</label>
        <textarea name="alasan_penolakan" rows="3" required
                  placeholder="Contoh: Bukti transfer tidak terbaca / nominal yang ditransfer tidak sesuai total tagihan..."
                  class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2.5 text-white focus:outline-none focus:border-red-400"></textarea>
      </div>

      <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
        <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')" class="px-4 py-2 rounded-sm border border-white/10 text-[#A0AAB9] hover:text-white uppercase tracking-wider">
          Batal
        </button>
        <button type="submit" class="px-5 py-2 rounded-sm bg-red-600 hover:bg-red-700 text-white uppercase tracking-wider font-semibold">
          Tolak Bukti
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
