@extends('layouts.app')

@section('title', 'Buku Alamat Pengiriman – Tuan Parfum')

@section('content')
<div class="space-y-8 pb-16">

  <!-- Header -->
  <div class="reveal-on-scroll border-b border-white/10 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h1 class="font-serif text-3xl font-bold text-white tracking-wide">Buku Alamat Pengiriman</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">
        Kelola tujuan pengantaran paket wewangian Anda di wilayah Padang & sekitarnya
      </p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('profil') }}" class="text-xs text-[#A0AAB9] hover:text-white uppercase tracking-wider">
        &larr; Kembali ke Profil
      </a>
      <button type="button" onclick="document.getElementById('add-address-modal').classList.remove('hidden')"
              class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-flex items-center gap-2">
        <i class="bi bi-plus-lg"></i> Tambah Alamat Baru
      </button>
    </div>
  </div>

  @if($addresses->isEmpty())
    <div class="reveal-on-scroll card-luxury p-12 text-center rounded-sm bg-[#101623] border border-white/10 max-w-lg mx-auto space-y-4">
      <div class="w-14 h-14 rounded-sm border border-white/10 bg-[#151B2C] mx-auto flex items-center justify-center text-[#A0AAB9] text-2xl">
        <i class="bi bi-geo-alt"></i>
      </div>
      <div>
        <h3 class="font-serif text-xl font-bold text-white">Belum Ada Alamat Tersimpan</h3>
        <p class="text-xs text-[#A0AAB9] mt-1">Tambahkan alamat pengantaran utama untuk mempermudah proses pemesanan.</p>
      </div>
      <button type="button" onclick="document.getElementById('add-address-modal').classList.remove('hidden')"
              class="btn-gold px-6 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider inline-block">
        Tambah Alamat Pertama
      </button>
    </div>
  @else
    <div class="stagger-parent grid grid-cols-1 md:grid-cols-2 gap-6">
      @foreach($addresses as $addr)
        <div class="stagger-item card-interactive card-luxury p-6 rounded-sm bg-[#101623] border {{ $addr->is_default ? 'border-[#C9A227]' : 'border-white/10' }} flex flex-col justify-between space-y-4">
          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <span class="px-2.5 py-0.5 rounded-sm text-[10px] uppercase font-bold tracking-wider {{ $addr->is_default ? 'bg-[#C9A227] text-[#0A0E17]' : 'bg-white/5 border border-white/10 text-[#9AA3B2]' }}">
                {{ $addr->label }}
              </span>
              @if($addr->is_default)
                <span class="text-[11px] text-[#C9A227] font-semibold uppercase tracking-wider flex items-center gap-1">
                  <i class="bi bi-check-circle-fill"></i> Alamat Utama
                </span>
              @endif
            </div>

            <h3 class="font-serif font-bold text-white text-lg">{{ $addr->nama_penerima }}</h3>
            <p class="text-xs text-[#9AA3B2] font-mono tabular-nums">{{ $addr->no_hp }}</p>
            <p class="text-xs text-[#E6E9EF] leading-relaxed pt-1">
              {{ $addr->alamat_lengkap }}
            </p>
            <p class="text-[11px] text-[#A0AAB9]">
              Kec. {{ $addr->kecamatan }}, Kota {{ $addr->kota }} {{ $addr->kode_pos ? "({$addr->kode_pos})" : '' }}
            </p>
            @if($addr->patokan)
              <p class="text-[11px] text-[#C9A227]/90 italic">Patokan: {{ $addr->patokan }}</p>
            @endif
          </div>

          <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
            <div>
              @if(!$addr->is_default)
                <form action="{{ route('alamat.default', $addr->id) }}" method="POST" class="inline m-0">
                  @csrf
                  <button type="submit" class="text-[#C9A227] hover:underline uppercase tracking-wider font-semibold">
                    Jadikan Utama
                  </button>
                </form>
              @endif
            </div>

            <form action="{{ route('alamat.destroy', $addr->id) }}" method="POST" class="inline m-0" onsubmit="return confirm('Hapus alamat ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-400 hover:text-red-300 uppercase tracking-wider">
                Hapus
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>

<!-- Modal Tambah Alamat Baru -->
<div id="add-address-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="card-luxury p-6 sm:p-8 rounded-sm bg-[#101623] border border-white/20 w-full max-w-lg space-y-5 animate-subtle-in">
    <div class="flex items-center justify-between border-b border-white/10 pb-3">
      <h3 class="font-serif text-lg font-bold text-white">Tambah Alamat Baru</h3>
      <button type="button" onclick="document.getElementById('add-address-modal').classList.add('hidden')" class="text-[#A0AAB9] hover:text-white text-lg">&times;</button>
    </div>

    <form action="{{ route('alamat.store') }}" method="POST" class="space-y-4 text-xs">
      @csrf
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block font-semibold uppercase tracking-wider text-[#A0AAB9] mb-1">Label Alamat</label>
          <input type="text" name="label" required placeholder="Rumah / Kantor / Kos" class="w-full bg-[#151B2C] border border-white/10 rounded-sm px-3 py-2 text-white focus:outline-none focus:border-[#C9A227]">
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
        <button type="button" onclick="document.getElementById('add-address-modal').classList.add('hidden')" class="px-4 py-2 rounded-sm border border-white/10 text-[#A0AAB9] hover:text-white uppercase tracking-wider">
          Batal
        </button>
        <button type="submit" class="btn-gold px-5 py-2 rounded-sm uppercase tracking-wider font-semibold">
          Simpan Alamat
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
