@extends('layouts.app')

@section('title', 'Instruksi Pembayaran – ' . $order->kode_order)

@section('content')
<div class="space-y-8 animate-subtle-in pb-16">

  <!-- Stepper Alur Transaksi -->
  <div class="reveal-on-scroll card-luxury p-4 rounded-sm bg-[#101623] border border-white/10">
    <div class="grid grid-cols-3 text-center text-xs font-semibold uppercase tracking-wider">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#34D399] pb-2 sm:pb-0">
        <span class="w-6 h-6 rounded-sm bg-[#34D399]/20 border border-[#34D399]/40 text-[#34D399] flex items-center justify-center text-xs font-bold">✓</span>
        <span>1. Keranjang</span>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#34D399] pb-2 sm:pb-0">
        <span class="w-6 h-6 rounded-sm bg-[#34D399]/20 border border-[#34D399]/40 text-[#34D399] flex items-center justify-center text-xs font-bold">✓</span>
        <span>2. Alamat &amp; Kirim</span>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#C9A227] pb-2 sm:pb-0 border-b-2 sm:border-b-0 border-[#C9A227]">
        <span class="w-6 h-6 rounded-sm bg-[#C9A227] text-[#0A0E17] flex items-center justify-center text-xs font-bold">3</span>
        <span>3. Pembayaran</span>
      </div>
    </div>
  </div>

  <!-- Header & Status -->
  <div class="reveal-on-scroll flex flex-wrap justify-between items-center gap-4 border-b border-white/10 pb-4">
    <div>
      <div class="flex items-center gap-3">
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
          Instruksi Pembayaran
        </h1>
        <span class="font-mono text-sm text-[#C9A227] font-semibold">#{{ $order->kode_order }}</span>
      </div>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">
        Selesaikan transfer bank untuk memproses pesanan wewangian Anda
      </p>
    </div>
    <div>
      <x-order-status-badge :status="$order->status" />
    </div>
  </div>

  <!-- Banner Catatan Penolakan Admin (Jika Sebelumnya Ditolak) -->
  @if($order->catatan_admin)
    <div class="reveal-on-scroll p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-start gap-3">
      <i class="bi bi-exclamation-triangle-fill text-rose-400 text-base mt-0.5"></i>
      <div class="space-y-1">
        <span class="font-bold uppercase tracking-wider block">Bukti Transfer Sebelumnya Perlu Diperbaiki</span>
        <p class="leading-relaxed">
          Catatan Admin: <strong>"{{ $order->catatan_admin }}"</strong>
        </p>
        <p class="text-[11px] text-rose-300/80">
          Silakan unggah kembali bukti transfer bank yang jelas dan sesuai nominal di bawah ini.
        </p>
      </div>
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Rincian Tagihan & Rekening Bank (6 Kolom) -->
    <div class="lg:col-span-6 space-y-6 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h2 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Rincian Pembayaran
        </h2>

        <!-- Total Tagihan dengan Tombol Salin Nominal -->
        <div class="p-4 rounded-sm bg-[#151B2C] border border-[#C9A227]/30 flex items-center justify-between">
          <div>
            <span class="text-[11px] uppercase tracking-wider text-[#9AA3B2] block">Total Nominal Transfer:</span>
            <span id="nominal-text" class="text-2xl sm:text-3xl font-bold text-[#C9A227] font-mono tabular-nums">
              {{ $order->total_harga_rupiah }}
            </span>
          </div>
          <button type="button" onclick="copyText('{{ $order->total_harga }}', 'btn-copy-nominal', 'Nominal')" id="btn-copy-nominal"
                  class="px-3.5 py-2 rounded-sm bg-[#C9A227]/10 hover:bg-[#C9A227]/20 border border-[#C9A227]/40 text-[#C9A227] text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5 active:scale-95">
            <i class="bi bi-clipboard"></i>
            <span>Salin</span>
          </button>
        </div>

        <!-- Rekening Bank Resmi -->
        <div class="p-5 rounded-sm bg-[#151B2C] border border-white/10 space-y-4 text-xs text-[#E6E9EF]">
          <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px]">Bank Tujuan:</span>
            <span class="font-bold text-white text-sm">{{ $rekeningInfo['bank'] }}</span>
          </div>

          <div class="flex items-center justify-between py-1">
            <div>
              <span class="text-[11px] uppercase tracking-wider text-[#9AA3B2] block">Nomor Rekening Resmi:</span>
              <span id="rekening-number" class="text-white font-mono font-bold text-lg tracking-wider">
                {{ $rekeningInfo['nomor'] }}
              </span>
            </div>
            <button type="button" onclick="copyText('{{ $rekeningInfo['nomor'] }}', 'btn-copy-rek', 'No. Rekening')" id="btn-copy-rek"
                    class="px-3.5 py-2 rounded-sm bg-[#C9A227]/10 hover:bg-[#C9A227]/20 border border-[#C9A227]/40 text-[#C9A227] text-xs font-semibold uppercase tracking-wider transition-colors inline-flex items-center gap-1.5 active:scale-95">
              <i class="bi bi-clipboard"></i>
              <span>Salin</span>
            </button>
          </div>

          <div class="flex items-center justify-between border-t border-white/10 pt-3">
            <span class="text-[#9AA3B2] uppercase tracking-wider text-[11px]">Atas Nama Rekening:</span>
            <span class="font-medium text-white">{{ $rekeningInfo['atas_nama'] }}</span>
          </div>
        </div>

        <!-- Petunjuk 3 Langkah -->
        <div class="space-y-3 pt-2 border-t border-white/5 text-xs text-[#A0AAB9]">
          <h4 class="font-semibold text-white uppercase tracking-wider text-[11px]">Panduan Pembayaran:</h4>
          <ol class="list-decimal list-inside space-y-1.5 leading-relaxed font-light">
            <li>Transfer nominal eksak melalui ATM, Mobile Banking (BCA Mobile), atau Internet Banking.</li>
            <li>Simpan bukti struk / tangkapan layar (screenshot) transfer yang berhasil.</li>
            <li>Unggah foto bukti transfer pada formulir di samping untuk konfirmasi otomatis ke Admin.</li>
          </ol>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Form Upload Bukti Transfer (6 Kolom) -->
    <div class="lg:col-span-6 space-y-6 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h2 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Konfirmasi Bukti Transfer
        </h2>

        @if($order->status === 'menunggu_verifikasi' && $order->bukti_bayar)
          <!-- Tampilan Saat Bukti Sedang Diverifikasi -->
          <div class="space-y-4 text-center p-6 rounded-sm bg-[#151B2C] border border-indigo-500/30">
            <div class="w-12 h-12 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 mx-auto flex items-center justify-center text-xl">
              <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="space-y-1">
              <h3 class="font-serif font-bold text-white text-base">Bukti Transfer Sedang Diverifikasi</h3>
              <p class="text-xs text-[#A0AAB9] leading-relaxed max-w-sm mx-auto">
                Bukti pembayaran Anda telah diterima pada {{ $order->dibayar_at ? $order->dibayar_at->format('d M Y, H:i') : '' }} WIB. Admin Tuan Parfum sedang memverifikasi dana Anda.
              </p>
            </div>

            <!-- Pratinjau Foto yang Diunggah -->
            <div class="aspect-[4/3] max-w-xs mx-auto rounded-sm overflow-hidden border border-white/10 bg-black/40">
              <img src="{{ asset($order->bukti_bayar) }}" alt="Bukti Transfer" class="w-full h-full object-contain">
            </div>

            <div class="pt-2">
              <a href="{{ route('pesanan.detail', $order->kode_order) }}" class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-2">
                Lihat Detail Pesanan <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        @else
          <!-- Form Unggah Bukti -->
          <form action="{{ route('pembayaran.upload', $order->kode_order) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Upload Area & Live Preview -->
            <div>
              <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-2">
                Foto / Screenshot Bukti Transfer
              </label>

              <div id="drop-area" class="border-2 border-dashed border-white/15 hover:border-[#C9A227] rounded-sm p-6 text-center cursor-pointer transition-colors bg-[#151B2C] relative"
                   onclick="document.getElementById('bukti_bayar').click()">
                <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/jpeg,image/png,image/webp" required class="hidden" onchange="previewImage(this)">

                <div id="preview-container" class="hidden mb-3">
                  <img id="img-preview" src="#" alt="Pratinjau Bukti" class="max-h-56 mx-auto rounded-sm border border-white/10 shadow-lg object-contain">
                </div>

                <div id="placeholder-container" class="space-y-2">
                  <i class="bi bi-cloud-arrow-up text-3xl text-[#C9A227]"></i>
                  <p class="text-xs text-white font-medium">Klik untuk memilih file gambar bukti transfer</p>
                  <p class="text-[11px] text-[#9AA3B2]">Format: JPG, PNG, atau WEBP (Maksimal 2 MB)</p>
                </div>
              </div>
            </div>

            <button type="submit"
                    class="btn-gold w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg">
              <i class="bi bi-send-check"></i> Kirim Bukti Pembayaran
            </button>

            <div class="text-center">
              <a href="{{ route('pesanan.detail', $order->kode_order) }}" class="text-xs text-[#9AA3B2] hover:text-white uppercase tracking-wider">
                Nanti Saja (Lihat Pesanan Saya)
              </a>
            </div>
          </form>
        @endif
      </div>
    </div>

  </div>

</div>

<script>
  function copyText(text, btnId, label) {
    navigator.clipboard.writeText(text).then(function() {
      const btn = document.getElementById(btnId);
      const originalHtml = btn.innerHTML;
      btn.innerHTML = '<i class="bi bi-check2 text-emerald-400"></i> <span class="text-emerald-400">' + label + ' Tersalin!</span>';
      setTimeout(function() {
        btn.innerHTML = originalHtml;
      }, 2000);
    });
  }

  function previewImage(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('img-preview').src = e.target.result;
        document.getElementById('preview-container').classList.remove('hidden');
        document.getElementById('placeholder-container').classList.add('hidden');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
