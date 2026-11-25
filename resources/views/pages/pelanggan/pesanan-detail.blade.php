@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->kode_order . ' – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16">

  <!-- Header -->
  <div class="reveal-on-scroll border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="flex items-center gap-3">
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
          Pesanan #{{ $order->kode_order }}
        </h1>
        <x-order-status-badge :status="$order->status" />
      </div>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1 font-mono">
        Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB
      </p>
    </div>
    <a href="{{ route('pesanan') }}" class="text-xs text-[#A0AAB9] hover:text-[#C9A227] uppercase tracking-wider transition-colors inline-flex items-center gap-1.5">
      <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
    </a>
  </div>

  <!-- Catatan Penolakan Admin Jika Ada -->
  @if($order->catatan_admin)
    <div class="reveal-on-scroll p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-start gap-3">
      <i class="bi bi-exclamation-octagon text-rose-400 text-base mt-0.5"></i>
      <div>
        <span class="font-bold uppercase tracking-wider block">Bukti Transfer Ditolak:</span>
        <p class="leading-relaxed mt-0.5">"{{ $order->catatan_admin }}"</p>
        <a href="{{ route('pembayaran', $order->kode_order) }}" class="underline text-white font-medium inline-block mt-1">
          Klik di sini untuk mengunggah ulang bukti transfer
        </a>
      </div>
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Rincian Produk & Pengiriman (7 Kolom) -->
    <div class="lg:col-span-7 space-y-6 reveal-on-scroll">

      <!-- Rincian Produk -->
      <div class="card-luxury p-6 sm:p-7 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Wewangian yang Dipesan
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
                <td colspan="3" class="py-2 px-4 uppercase text-[#A0AAB9]">Biaya Pengiriman:</td>
                <td class="py-2 px-4 text-right text-white tabular-nums">{{ $order->ongkir_rupiah }}</td>
              </tr>
              <tr class="border-t border-white/10">
                <td colspan="3" class="py-3 px-4 uppercase text-white font-bold">Total Pembayaran:</td>
                <td class="py-3 px-4 text-right text-base text-[#C9A227] font-bold tabular-nums">{{ $order->total_harga_rupiah }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <!-- Informasi Pengiriman & Penerima -->
      <div class="card-luxury p-6 sm:p-7 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Informasi Pengiriman & Alamat
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Nama Penerima:</span>
            <span class="font-semibold text-white text-sm">{{ $order->penerima_nama }}</span>
          </div>

          <div>
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Nomor Kontak / WhatsApp:</span>
            <span class="font-mono text-white text-sm">{{ $order->penerima_hp }}</span>
          </div>

          <div class="sm:col-span-2">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block mb-1">Alamat Pengiriman:</span>
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

          <!-- Informasi Kurir Jika Sudah Ditugaskan -->
          @if($order->kurir)
            <div class="sm:col-span-2 p-4 rounded-sm bg-[#151B2C] border border-sky-500/30 flex items-center justify-between">
              <div>
                <span class="text-[10px] uppercase tracking-wider text-sky-400 block font-bold">Kurir Pengantar:</span>
                <span class="text-white font-semibold text-sm">{{ $order->kurir->name }}</span>
                @if($order->nomor_resi)
                  <span class="text-[11px] text-[#9AA3B2] font-mono block">No. Resi: {{ $order->nomor_resi }}</span>
                @endif
              </div>
              <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->kurir->email) }}" target="_blank"
                 class="px-3 py-1.5 rounded-sm bg-emerald-500/15 border border-emerald-500/40 text-[#34D399] text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-1">
                <i class="bi bi-whatsapp"></i> Hubungi Kurir
              </a>
            </div>
          @endif

          <!-- Foto Bukti Pengiriman Jika Ada -->
          @if($order->bukti_pengiriman)
            <div class="sm:col-span-2 space-y-2 pt-2 border-t border-white/5">
              <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px] block">Bukti Serah Terima Paket:</span>
              <div class="aspect-[4/3] max-w-xs rounded-sm overflow-hidden border border-white/10 bg-black/40">
                <img src="{{ asset($order->bukti_pengiriman) }}" alt="Bukti Serah Terima" class="w-full h-full object-cover">
              </div>
            </div>
          @endif
        </div>
      </div>

    </div>

    <!-- Kolom Kanan: Timeline Riwayat & Tombol Aksi (5 Kolom) -->
    <div class="lg:col-span-5 space-y-6 reveal-on-scroll">

      <!-- Panel Aksi Kontekstual -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h3 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Aksi Pesanan
        </h3>

        <div class="space-y-3">
          @if($order->canUploadBuktiBayar())
            <a href="{{ route('pembayaran', $order->kode_order) }}"
               class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-md">
              <i class="bi bi-credit-card"></i> Unggah Bukti Pembayaran
            </a>
          @endif

          @if($order->canBeConfirmedReceived())
            <form action="{{ route('pesanan.terima', $order->kode_order) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa paket wewangian telah Anda terima?')">
              @csrf
              <button type="submit"
                      class="w-full h-11 rounded-sm bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-500/50 text-emerald-300 text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
                <i class="bi bi-check-circle-fill"></i> Konfirmasi Pesanan Diterima
              </button>
            </form>
          @endif

          @if($order->canBeCancelledByCustomer())
            <button type="button" onclick="document.getElementById('cancel-modal').classList.remove('hidden')"
                    class="w-full h-11 rounded-sm border border-red-500/30 hover:border-red-500/60 bg-red-500/10 text-red-300 text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 transition-colors">
              <i class="bi bi-x-circle"></i> Batalkan Pesanan Ini
            </button>
          @endif

          @if($order->status === 'selesai')
            <div class="p-3.5 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs text-center space-y-1">
              <i class="bi bi-check2-all text-xl"></i>
              <p class="font-bold">Pesanan ini telah selesai</p>
              <p class="text-[11px] text-emerald-300/80">Terima kasih telah mempercayai wewangian Tuan Parfum.</p>
            </div>
          @endif
        </div>
      </div>

      <!-- Timeline Status Pesanan (Menggunakan Komponen x-order-timeline) -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-5">
        <h3 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Riwayat Perjalanan Pesanan
        </h3>

        <x-order-timeline :logs="$order->statusLogs" />
      </div>

    </div>

  </div>

</div>

<!-- Modal Pembatalan Pesanan Pelanggan -->
@if($order->canBeCancelledByCustomer())
  <div id="cancel-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="card-luxury p-6 sm:p-8 rounded-sm bg-[#101623] border border-white/20 w-full max-w-md space-y-5 animate-subtle-in">
      <div class="flex items-center justify-between border-b border-white/10 pb-3">
        <h3 class="font-serif text-lg font-bold text-white">Batalkan Pesanan</h3>
        <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="text-[#A0AAB9] hover:text-white text-lg">&times;</button>
      </div>

      <form action="{{ route('pesanan.batal', $order->kode_order) }}" method="POST" class="space-y-4 text-xs">
        @csrf
        <p class="text-[#A0AAB9] leading-relaxed">
          Apakah Anda yakin ingin membatalkan pesanan wewangian ini? Stok produk akan otomatis dikembalikan.
        </p>

        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1.5">Alasan Pembatalan</label>
          <select name="alasan_batal" required class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
            <option value="Ingin mengubah alamat pengiriman">Ingin mengubah alamat pengiriman</option>
            <option value="Ingin menambah produk lain">Ingin menambah produk wewangian lain</option>
            <option value="Ingin mengganti metode pembayaran">Ingin mengganti metode pembayaran</option>
            <option value="Lainnya">Alasan lainnya</option>
          </select>
        </div>

        <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
          <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="px-4 py-2 rounded-sm border border-white/10 text-[#A0AAB9] hover:text-white uppercase tracking-wider">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-sm bg-red-600 hover:bg-red-700 text-white uppercase tracking-wider font-semibold">
            Ya, Batalkan
          </button>
        </div>
      </form>
    </div>
  </div>
@endif
@endsection
