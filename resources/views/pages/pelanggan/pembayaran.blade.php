@extends('layouts.app')

@section('title', 'Instruksi Pembayaran – Tuan Parfum')

@section('content')
<div class="space-y-8 animate-subtle-in">

  <!-- Stepper Alur Transaksi (Sesuai Dokumentasi 7.3) -->
  <div class="card-luxury p-4 rounded-sm bg-[#101623] border border-white/10">
    <div class="grid grid-cols-3 text-center text-xs font-semibold uppercase tracking-wider">
      <a href="{{ route('keranjang') }}" class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#34D399] pb-2 sm:pb-0 hover:text-white transition-colors">
        <span class="w-6 h-6 rounded-sm bg-[#34D399]/20 border border-[#34D399]/40 text-[#34D399] flex items-center justify-center text-xs font-bold">✓</span>
        <span>1. Keranjang</span>
      </a>
      <a href="{{ route('checkout') }}" class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#34D399] pb-2 sm:pb-0 hover:text-white transition-colors">
        <span class="w-6 h-6 rounded-sm bg-[#34D399]/20 border border-[#34D399]/40 text-[#34D399] flex items-center justify-center text-xs font-bold">✓</span>
        <span>2. Alamat &amp; Kirim</span>
      </a>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2 text-[#C9A227] pb-2 sm:pb-0 border-b-2 sm:border-b-0 border-[#C9A227]">
        <span class="w-6 h-6 rounded-sm bg-[#C9A227] text-[#0A0E17] flex items-center justify-center text-xs font-bold">3</span>
        <span>3. Pembayaran</span>
      </div>
    </div>
  </div>

  <div class="flex flex-wrap justify-between items-center gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Instruksi Pembayaran</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Selesaikan transfer untuk Pesanan #TP-0001</p>
    </div>
    <span class="px-3 py-1 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] text-xs font-semibold uppercase tracking-wider rounded-sm">
      Menunggu Pembayaran
    </span>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Rincian Tagihan & Rekening Bank dengan Tombol Salin -->
    <div class="lg:col-span-6 space-y-6">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h2 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Rincian Tagihan
        </h2>

        <div class="space-y-4">
          <div class="flex justify-between items-center">
            <span class="text-xs uppercase tracking-[0.12em] text-[#A0AAB9]">Total Tagihan:</span>
            <span class="font-semibold text-2xl sm:text-3xl text-[#C9A227] tabular-nums">Rp 390.000</span>
          </div>

          <!-- Kotak Rekening Bank dengan Tombol Salin Cepat -->
          <div class="p-4 rounded-sm bg-[#161E2E] border border-white/5 space-y-3 text-xs text-[#A0AAB9]">
            <div class="flex justify-between">
              <span>Batas Waktu Pembayaran:</span>
              <span class="text-white font-medium">1 x 24 Jam (Otomatis Dibatalkan)</span>
            </div>
            <div class="flex justify-between">
              <span>Bank Tujuan:</span>
              <span class="text-white font-medium">BCA (Bank Central Asia)</span>
            </div>
            <div class="flex justify-between items-center py-1 border-y border-white/5">
              <div>
                <span class="block text-[10px] uppercase tracking-wider text-[#6E7889]">Nomor Rekening:</span>
                <span id="rekening-number" class="text-[#C9A227] font-mono font-bold text-base tracking-wider">821098765432</span>
              </div>
              <button type="button" id="copy-btn" onclick="copyRekening()"
                      class="px-3 py-1.5 rounded-sm bg-[#C9A227]/10 hover:bg-[#C9A227]/20 border border-[#C9A227]/40 text-[#C9A227] text-xs font-semibold uppercase tracking-wider transition-all duration-150 active:scale-95 inline-flex items-center gap-1.5">
                <i class="bi bi-clipboard" id="copy-icon"></i>
                <span id="copy-text">Salin</span>
              </button>
            </div>
            <div class="flex justify-between">
              <span>Atas Nama Rekening:</span>
              <span class="text-white font-medium">Tuan Parfum Indonesia</span>
            </div>
          </div>
        </div>

        <!-- Opsi QRIS -->
        <div class="pt-2 text-center border-t border-white/5">
          <p class="text-xs text-[#A0AAB9] mb-3 uppercase tracking-wider">Atau bayar praktis via QRIS:</p>
          <div class="w-44 h-44 mx-auto rounded-sm bg-white p-3 shadow-md flex flex-col items-center justify-center">
            <i class="bi bi-qr-code text-7xl text-[#0A0E17]"></i>
            <span class="text-[9px] text-[#0A0E17] font-bold mt-1 tracking-widest uppercase">QRIS TUAN PARFUM</span>
          </div>
          <p class="text-[11px] text-[#6E7889] mt-2">Dukungan: BCA Mobile, GoPay, OVO, DANA, ShopeePay</p>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Form Konfirmasi & Upload Bukti Transfer dengan Pratinjau -->
    <div class="lg:col-span-6">
      <div class="card-luxury p-6 sm:p-8 space-y-6 rounded-sm bg-[#101623] border border-white/10">
        <h2 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Konfirmasi Pembayaran
        </h2>

        <form action="{{ route('pesanan') }}" method="GET" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Nama Pemilik Rekening Pengirim
            </label>
            <input type="text" name="nama_pengirim" required value="{{ Auth::user()->name ?? 'Muhammad Ihsan' }}"
                   placeholder="Contoh: Muhammad Ihsan"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors">
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Tanggal Transfer
            </label>
            <input type="date" name="tanggal_bayar" required value="{{ date('Y-m-d') }}"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C9A227]">
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Nominal yang Ditransfer (Rp)
            </label>
            <input type="number" name="nominal" required value="390000"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C9A227] tabular-nums">
          </div>

          <!-- File Upload dengan Instant Image Preview (Sesuai Dokumentasi 7.3) -->
          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Unggah Foto Struk / Bukti Transfer
            </label>
            <input type="file" id="bukti-input" name="bukti" accept="image/jpeg,image/png,image/jpg" onchange="previewBukti(this)"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2 text-xs text-[#A0AAB9] file:mr-3 file:py-1 file:px-3 file:rounded-sm file:border-0 file:text-xs file:font-semibold file:bg-[#C9A227] file:text-[#0A0E17] cursor-pointer">
            <p id="file-error" class="text-[11px] text-[#F87171] mt-1 hidden"></p>
            <p class="text-[11px] text-[#6E7889] mt-1">Gunakan berkas format JPG atau PNG dengan ukuran maksimal 2 MB.</p>
          </div>

          <!-- Area Pratinjau Bukti Transfer -->
          <div id="preview-container" class="hidden p-3 rounded-sm bg-[#161E2E] border border-white/5 animate-subtle-in">
            <span class="block text-[10px] uppercase tracking-wider text-[#A0AAB9] mb-2">Pratinjau Bukti:</span>
            <div class="relative max-w-[200px] aspect-[4/3] rounded-sm overflow-hidden border border-white/10 bg-[#0A0E17]">
              <img id="preview-image" src="" alt="Pratinjau Struk" class="w-full h-full object-cover">
            </div>
          </div>

          <button type="submit"
                  class="btn-gold w-full h-11 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 mt-4">
            <i class="bi bi-send"></i> Kirim Bukti Pembayaran
          </button>
        </form>
      </div>
    </div>

  </div>

</div>

<!-- Client-side Copy & Image Preview Script -->
<script>
  function copyRekening() {
    const text = document.getElementById('rekening-number').innerText;
    navigator.clipboard.writeText(text).then(() => {
      const btnText = document.getElementById('copy-text');
      const icon = document.getElementById('copy-icon');
      btnText.innerText = 'Tersalin';
      icon.className = 'bi bi-check2';
      setTimeout(() => {
        btnText.innerText = 'Salin';
        icon.className = 'bi bi-clipboard';
      }, 2500);
    });
  }

  function previewBukti(input) {
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileError = document.getElementById('file-error');

    if (input.files && input.files[0]) {
      const file = input.files[0];
      const maxSize = 2 * 1024 * 1024; // 2 MB

      if (file.size > maxSize) {
        fileError.innerText = 'Ukuran berkas melebihi 2 MB. Silakan unggah struk yang lebih kecil.';
        fileError.classList.remove('hidden');
        input.value = '';
        previewContainer.classList.add('hidden');
        return;
      } else {
        fileError.classList.add('hidden');
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewContainer.classList.remove('hidden');
      };
      reader.readAsDataURL(file);
    }
  }
</script>
@endsection
