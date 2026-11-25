@extends('layouts.app')

@section('title', 'Alamat & Pengiriman – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16">

  <!-- Stepper Alur Transaksi -->
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
    <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Penyelesaian Pesanan</h1>
    <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Konfirmasi alamat, opsi pengiriman, dan metode pembayaran Anda</p>
  </div>

  <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    @csrf

    <!-- Kolom Kiri: Form Alamat & Opsi Pengiriman (7 Kolom) -->
    <div class="lg:col-span-7 space-y-6 reveal-on-scroll">

      <!-- Step 1: Opsi Pengiriman -->
      <div class="card-luxury p-6 sm:p-7 space-y-5 rounded-sm bg-[#101623] border border-white/10">
        <div class="flex items-center gap-3 border-b border-white/10 pb-3">
          <i class="bi bi-truck text-[#C9A227] text-lg"></i>
          <h2 class="font-serif text-xl font-bold text-white">1. Metode Pengiriman</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Kurir Toko (Padang) -->
          <label class="shipping-card relative flex flex-col justify-between p-4 rounded-sm bg-[#151B2C] border-2 border-[#C9A227] cursor-pointer hover:border-[#DFB942] transition-colors">
            <div class="space-y-1">
              <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-white">Kurir Toko (Kota Padang)</span>
                <input type="radio" name="metode_pengiriman" value="kurir_toko" checked class="accent-[#C9A227] w-4 h-4" onchange="updateShipping(this.value)">
              </div>
              <p class="text-xs text-[#A0AAB9] leading-relaxed">
                Pengantaran langsung oleh kurir Tuan Parfum ke alamat Anda di wilayah Padang & sekitarnya.
              </p>
            </div>
            <div class="pt-3 mt-2 border-t border-white/5 flex items-baseline justify-between">
              <span class="text-[11px] text-[#9AA3B2] uppercase tracking-wider">Ongkir:</span>
              <span class="text-xs font-semibold {{ $isFreeShipping ? 'text-[#34D399]' : 'text-[#C9A227]' }} tabular-nums">
                {{ $isFreeShipping ? 'Gratis (Min. Rp 500k)' : 'Rp 15.000 (Flat)' }}
              </span>
            </div>
          </label>

          <!-- Ambil di Toko -->
          <label class="shipping-card relative flex flex-col justify-between p-4 rounded-sm bg-[#151B2C] border border-white/10 cursor-pointer hover:border-white/30 transition-colors">
            <div class="space-y-1">
              <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-white">Ambil di Toko Fisik</span>
                <input type="radio" name="metode_pengiriman" value="ambil_di_toko" class="accent-[#C9A227] w-4 h-4" onchange="updateShipping(this.value)">
              </div>
              <p class="text-xs text-[#A0AAB9] leading-relaxed">
                Ambil langsung di Toko Tuan Parfum, Sungai Bangek, Balai Gadang, Koto Tangah.
              </p>
            </div>
            <div class="pt-3 mt-2 border-t border-white/5 flex items-baseline justify-between">
              <span class="text-[11px] text-[#9AA3B2] uppercase tracking-wider">Ongkir:</span>
              <span class="text-xs font-semibold text-[#34D399] tabular-nums">Rp 0 (Gratis)</span>
            </div>
          </label>
        </div>
      </div>

      <!-- Step 2: Alamat Pengiriman (Hanya aktif untuk Kurir Toko) -->
      <div id="section-alamat" class="card-luxury p-6 sm:p-7 space-y-5 rounded-sm bg-[#101623] border border-white/10">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
          <div class="flex items-center gap-3">
            <i class="bi bi-geo-alt text-[#C9A227] text-lg"></i>
            <h2 class="font-serif text-xl font-bold text-white">2. Alamat Tujuan Pengiriman</h2>
          </div>
          <button type="button" onclick="openAddressModal()" class="text-xs text-[#C9A227] hover:underline uppercase tracking-wider font-semibold inline-flex items-center gap-1">
            <i class="bi bi-plus-lg"></i> Tambah Alamat
          </button>
        </div>

        @if($addresses->isEmpty())
          <div class="p-6 text-center border border-dashed border-white/20 rounded-sm space-y-3 bg-[#151B2C]">
            <p class="text-xs text-[#A0AAB9]">Anda belum memiliki alamat tersimpan untuk pengantaran.</p>
            <button type="button" onclick="openAddressModal()" class="btn-gold px-5 py-2 text-xs uppercase tracking-wider inline-flex items-center gap-2">
              <i class="bi bi-plus-circle"></i> Tambah Alamat Pertama
            </button>
          </div>
        @else
          <div class="space-y-3">
            @foreach($addresses as $addr)
              <label class="address-card relative flex items-start gap-3 p-4 rounded-sm bg-[#151B2C] border {{ $addr->id === ($selectedAddress->id ?? null) ? 'border-[#C9A227]' : 'border-white/10' }} cursor-pointer hover:border-white/30 transition-colors">
                <input type="radio" name="address_id" value="{{ $addr->id }}" {{ $addr->id === ($selectedAddress->id ?? null) ? 'checked' : '' }} class="accent-[#C9A227] mt-1">
                <div class="flex-1 space-y-1 text-xs">
                  <div class="flex items-center gap-2">
                    <span class="font-bold text-white text-sm">{{ $addr->nama_penerima }}</span>
                    <span class="px-2 py-0.5 bg-white/5 border border-white/10 text-[#9AA3B2] text-[10px] uppercase font-medium rounded-sm">
                      {{ $addr->label }}
                    </span>
                    @if($addr->is_default)
                      <span class="px-2 py-0.5 bg-[#C9A227]/15 border border-[#C9A227]/30 text-[#C9A227] text-[10px] uppercase font-semibold rounded-sm">
                        Utama
                      </span>
                    @endif
                  </div>
                  <p class="text-[#9AA3B2] font-mono tabular-nums">{{ $addr->no_hp }}</p>
                  <p class="text-[#E6E9EF] leading-relaxed">{{ $addr->formatted_full }}</p>
                </div>
              </label>
            @endforeach
          </div>
        @endif
      </div>

      <!-- Info Alamat Toko Fisik (Muncul otomatis saat Ambil di Toko) -->
      <div id="section-toko-fisik" class="hidden card-luxury p-6 rounded-sm bg-[#151B2C] border border-[#C9A227]/30 space-y-3">
        <div class="flex items-center gap-2 text-sm font-bold text-white">
          <i class="bi bi-shop text-[#C9A227]"></i>
          <span>Lokasi Pengambilan: Toko Fisik Tuan Parfum</span>
        </div>
        <p class="text-xs text-[#E6E9EF] leading-relaxed">
          Jl. Raya Sungai Bangek, RT 02 / RW 05, Kelurahan Balai Gadang, Kecamatan Koto Tangah, Kota Padang, Sumatera Barat 25175.
        </p>
        <p class="text-[11px] text-[#A0AAB9]">
          * Jam Operasional: Setiap hari 09:00 – 21:00 WIB. Tunjukkan kode order kepada staf kami saat pengambilan.
        </p>
      </div>

      <!-- Step 3: Metode Pembayaran -->
      <div class="card-luxury p-6 sm:p-7 space-y-5 rounded-sm bg-[#101623] border border-white/10">
        <div class="flex items-center gap-3 border-b border-white/10 pb-3">
          <i class="bi bi-credit-card text-[#C9A227] text-lg"></i>
          <h2 class="font-serif text-xl font-bold text-white">3. Metode Pembayaran</h2>
        </div>

        <div class="space-y-3">
          <!-- Transfer Bank Manual -->
          <label class="flex items-start gap-3 p-4 rounded-sm bg-[#151B2C] border-2 border-[#C9A227] cursor-pointer hover:border-[#DFB942] transition-colors">
            <input type="radio" name="metode_pembayaran" value="transfer_bank" checked class="accent-[#C9A227] mt-1 w-4 h-4">
            <div>
              <span class="text-sm font-bold text-white block">Transfer Bank Manual (BCA)</span>
              <p class="text-xs text-[#A0AAB9] mt-0.5">
                Transfer ke rekening resmi Tuan Parfum dan upload bukti transfer setelah pesanan dibuat. Diverifikasi oleh Admin.
              </p>
            </div>
          </label>

          <!-- Bayar di Tempat (COD) -->
          <label class="flex items-start gap-3 p-4 rounded-sm bg-[#151B2C] border border-white/10 cursor-pointer hover:border-white/30 transition-colors">
            <input type="radio" name="metode_pembayaran" value="cod" class="accent-[#C9A227] mt-1 w-4 h-4">
            <div>
              <span class="text-sm font-bold text-white block">Bayar di Tempat (COD)</span>
              <p class="text-xs text-[#A0AAB9] mt-0.5">
                Bayar tunai kepada kurir kami saat paket wewangian sampai di rumah Anda (Wilayah Kota Padang).
              </p>
            </div>
          </label>
        </div>
      </div>

      <!-- Step 4: Catatan Pesanan -->
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-3">
        <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9]">
          4. Catatan untuk Penjual / Kurir (Opsional)
        </label>
        <textarea name="catatan_pembeli" rows="2"
                  placeholder="Contoh: Mohon dikemas rapi untuk kado, titip di satpam jika rumah kosong..."
                  class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-4 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227] transition-colors"></textarea>
      </div>

    </div>

    <!-- Kolom Kanan: Ringkasan & Tombol Buat Pesanan (5 Kolom Desktop) -->
    <div class="lg:col-span-5 reveal-on-scroll">
      <div class="card-luxury p-6 sm:p-7 space-y-6 sticky top-28 rounded-sm bg-[#101623] border border-white/10">
        <h3 class="font-serif text-xl font-bold text-white tracking-wide border-b border-white/10 pb-3">
          Rincian Pesanan
        </h3>

        <!-- Daftar Item Ringkas -->
        <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
          @foreach($cartItems as $item)
            <div class="flex items-center justify-between text-xs text-[#E6E9EF] border-b border-white/5 pb-2">
              <div>
                <p class="font-medium text-white">{{ $item->parfum->nama }}</p>
                <p class="text-[11px] text-[#9AA3B2] tabular-nums">{{ $item->qty }} x {{ $item->parfum->harga_rupiah }}</p>
              </div>
              <span class="font-semibold tabular-nums text-[#C9A227]">{{ $item->subtotal_rupiah }}</span>
            </div>
          @endforeach
        </div>

        <!-- Perhitungan Ongkir & Total -->
        <div class="space-y-3 text-sm pt-2 border-t border-white/10">
          <div class="flex justify-between text-[#A0AAB9]">
            <span>Subtotal Produk:</span>
            <span class="text-white font-medium tabular-nums" id="display-subtotal" data-val="{{ $subtotal }}">
              Rp {{ number_format($subtotal, 0, ',', '.') }}
            </span>
          </div>

          <div class="flex justify-between text-[#A0AAB9]">
            <span>Biaya Pengiriman:</span>
            <span class="font-medium tabular-nums {{ $defaultOngkir === 0 ? 'text-[#34D399]' : 'text-white' }}" id="display-ongkir">
              {{ $defaultOngkir === 0 ? 'Gratis' : 'Rp ' . number_format($defaultOngkir, 0, ',', '.') }}
            </span>
          </div>

          <div class="border-t border-white/10 pt-4 flex justify-between items-baseline">
            <span class="text-xs font-semibold uppercase tracking-wider text-white">Total Tagihan:</span>
            <span class="font-semibold text-2xl text-[#C9A227] tabular-nums" id="display-total">
              Rp {{ number_format($defaultTotal, 0, ',', '.') }}
            </span>
          </div>
        </div>

        <button type="submit" id="btn-submit-order"
                class="btn-gold w-full h-12 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg">
          <i class="bi bi-lock-fill"></i> Buat Pesanan Sekarang
        </button>

        <p class="text-center text-[11px] text-[#6E7889] leading-relaxed">
          Dengan membuat pesanan, Anda menyetujui transaksi wewangian resmi di Tuan Parfum Padang.
        </p>
      </div>
    </div>

  </form>
</div>

<!-- Modal Tambah Alamat Baru -->
<div id="address-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="card-luxury p-6 sm:p-8 rounded-sm bg-[#101623] border border-white/20 w-full max-w-lg space-y-5 animate-subtle-in">
    <div class="flex items-center justify-between border-b border-white/10 pb-3">
      <h3 class="font-serif text-lg font-bold text-white">Tambah Alamat Baru</h3>
      <button type="button" onclick="closeAddressModal()" class="text-[#A0AAB9] hover:text-white text-lg">&times;</button>
    </div>

    <form action="{{ route('alamat.store') }}" method="POST" class="space-y-4 text-xs">
      @csrf
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Label Alamat</label>
          <input type="text" name="label" required placeholder="Rumah / Kantor" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Nama Penerima</label>
          <input type="text" name="nama_penerima" required value="{{ Auth::user()->name }}" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
      </div>

      <div>
        <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Nomor WhatsApp / HP Aktif</label>
        <input type="text" name="no_hp" required placeholder="081234567890" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
      </div>

      <div>
        <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Alamat Lengkap</label>
        <textarea name="alamat_lengkap" rows="2" required placeholder="Nama jalan, nomor rumah, RT/RW..." class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Kecamatan</label>
          <input type="text" name="kecamatan" required placeholder="Contoh: Koto Tangah" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Kota</label>
          <input type="text" name="kota" required value="Padang" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Patokan Rumah</label>
          <input type="text" name="patokan" placeholder="Depan masjid / pagar hitam" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Kode Pos</label>
          <input type="text" name="kode_pos" placeholder="25175" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
        </div>
      </div>

      <label class="flex items-center gap-2 pt-1 cursor-pointer">
        <input type="checkbox" name="is_default" value="1" checked class="accent-[#C9A227]">
        <span class="text-[#A0AAB9]">Jadikan sebagai alamat pengantaran utama</span>
      </label>

      <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
        <button type="button" onclick="closeAddressModal()" class="px-4 py-2 rounded-sm border border-white/10 text-[#A0AAB9] hover:text-white uppercase tracking-wider">
          Batal
        </button>
        <button type="submit" class="btn-gold px-5 py-2 rounded-sm uppercase tracking-wider font-semibold">
          Simpan Alamat
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function updateShipping(method) {
    const subtotal = parseInt(document.getElementById('display-subtotal').getAttribute('data-val'), 10);
    const sectionAlamat = document.getElementById('section-alamat');
    const sectionToko = document.getElementById('section-toko-fisik');
    const displayOngkir = document.getElementById('display-ongkir');
    const displayTotal = document.getElementById('display-total');

    let ongkir = 0;

    if (method === 'ambil_di_toko') {
      ongkir = 0;
      sectionAlamat.classList.add('hidden');
      sectionToko.classList.remove('hidden');
      displayOngkir.innerText = 'Gratis';
      displayOngkir.className = 'font-medium tabular-nums text-[#34D399]';
    } else {
      sectionAlamat.classList.remove('hidden');
      sectionToko.classList.add('hidden');
      ongkir = subtotal >= 500000 ? 0 : 15000;
      if (ongkir === 0) {
        displayOngkir.innerText = 'Gratis (Min. Rp 500k)';
        displayOngkir.className = 'font-medium tabular-nums text-[#34D399]';
      } else {
        displayOngkir.innerText = 'Rp ' + ongkir.toLocaleString('id-ID');
        displayOngkir.className = 'font-medium tabular-nums text-white';
      }
    }

    const total = subtotal + ongkir;
    displayTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
  }

  function openAddressModal() {
    document.getElementById('address-modal').classList.remove('hidden');
  }

  function closeAddressModal() {
    document.getElementById('address-modal').classList.add('hidden');
  }

  // Anti double submit
  document.getElementById('checkout-form').addEventListener('submit', function() {
    const btn = document.getElementById('btn-submit-order');
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-spin inline-block mr-2">⟳</span> Memproses Pesanan...';
  });
</script>
@endsection
