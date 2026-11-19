@extends('layouts.admin')

@section('title', isset($parfum) ? 'Ubah Koleksi Parfum' : 'Tambah Koleksi Parfum Baru')

@section('content')
<div class="space-y-8 max-w-4xl">

  <!-- Header -->
  <div class="reveal-on-scroll border-b border-white/10 pb-4 flex justify-between items-center">
    <div>
      <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
        {{ isset($parfum) ? 'Ubah Parfum: ' . $parfum->nama : 'Tambah Koleksi Parfum Baru' }}
      </h2>
      <p class="text-xs text-[#9AA3B2] uppercase tracking-[0.16em] mt-1">
        Input spesifikasi aroma, volume, harga, dan visual kemasan
      </p>
    </div>
    <a href="{{ route('admin.parfum') }}" class="text-xs text-[#9AA3B2] hover:text-[#C9A227] uppercase tracking-wider transition-colors">
      &larr; Kembali ke Inventaris
    </a>
  </div>

  <!-- Error Alerts -->
  @if($errors->any())
    <div class="reveal-on-scroll p-4 rounded-sm bg-red-500/10 border border-red-500/30 text-red-300 text-xs tracking-wide">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Form -->
  <form action="{{ isset($parfum) ? route('admin.parfum.update', $parfum->id) : route('admin.parfum.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="reveal-on-scroll card-luxury p-6 sm:p-8 rounded-sm space-y-6">
    @csrf
    @if(isset($parfum))
      @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

      <!-- Left Column: Specs -->
      <div class="md:col-span-7 space-y-5">
        <div>
          <label class="form-label">Nama Parfum / Varian Extrait</label>
          <input type="text" name="nama" required
                 value="{{ old('nama', $parfum->nama ?? '') }}"
                 placeholder="Contoh: Oud Imperial Extrait"
                 class="form-control">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Kategori Aroma</label>
            <select name="kategori" class="form-select">
              @php
                $currentCat = old('kategori', $parfum->kategori ?? 'Unisex');
              @endphp
              <option value="Unisex" {{ $currentCat == 'Unisex' ? 'selected' : '' }}>Unisex</option>
              <option value="Pria" {{ $currentCat == 'Pria' ? 'selected' : '' }}>Pria</option>
              <option value="Wanita" {{ $currentCat == 'Wanita' ? 'selected' : '' }}>Wanita</option>
              <option value="Koleksi Eksklusif" {{ $currentCat == 'Koleksi Eksklusif' ? 'selected' : '' }}>Koleksi Eksklusif</option>
            </select>
          </div>

          <div>
            <label class="form-label">Volume (ml)</label>
            <input type="number" name="volume" required min="1"
                   value="{{ old('volume', $parfum->volume ?? 100) }}"
                   placeholder="100"
                   class="form-control">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" required min="0" step="1000"
                   value="{{ old('harga', $parfum->harga ?? 500000) }}"
                   placeholder="650000"
                   class="form-control">
          </div>

          <div>
            <label class="form-label">Stok Awal (Botol)</label>
            <input type="number" name="stok" required min="0"
                   value="{{ old('stok', $parfum->stok ?? 15) }}"
                   placeholder="20"
                   class="form-control">
          </div>
        </div>

        <div>
          <label class="form-label">Deskripsi & Karakteristik Notes</label>
          <textarea name="deskripsi" rows="4"
                    placeholder="Jelaskan aroma piramida (top, heart, base notes) dan ketahanan extrait..."
                    class="form-control">{{ old('deskripsi', $parfum->deskripsi ?? '') }}</textarea>
        </div>
      </div>

      <!-- Right Column: Visual Image & Preview -->
      <div class="md:col-span-5 space-y-4">
        <label class="form-label">Preview Visual Kartu</label>

        <!-- Clean Solid Preview Box (3:4) -->
        <div id="image-preview" class="aspect-[3/4] max-w-[240px] mx-auto w-full rounded-sm overflow-hidden border border-white/10 bg-[#131824] p-4 flex flex-col justify-between items-center text-center">
          <div class="w-full flex justify-between items-center text-[10px] text-[#9AA3B2]">
            <span class="px-2 py-0.5 bg-[#0A0E17] border border-white/10 text-white font-medium uppercase">
              Kategori
            </span>
            <span>100 ml</span>
          </div>

          <div class="my-auto flex flex-col items-center">
            <svg class="w-8 h-12 stroke-[#C9A227] fill-none stroke-[1.2] mb-2" viewBox="0 0 24 38">
              <rect x="7" y="2" width="10" height="6" rx="0.5" stroke="currentColor"/>
              <rect x="9" y="8" width="6" height="2" stroke="currentColor"/>
              <rect x="3" y="10" width="18" height="25" rx="1" stroke="currentColor"/>
              <text x="12" y="24" text-anchor="middle" font-size="5" fill="#C9A227" font-family="serif" font-weight="bold">TP</text>
            </svg>
            <span class="font-serif text-sm text-white font-semibold tracking-wider block">Preview Botol</span>
            <span class="text-[9px] uppercase tracking-wider text-[#C9A227] mt-0.5">Tuan Parfum</span>
          </div>

          <div class="text-[9px] text-[#9AA3B2]/60 text-right w-full">
            Rasio 3:4 Vertikal
          </div>
        </div>

        <div>
          <label class="form-label text-xs">Unggah Foto Produk (Opsional)</label>
          <input type="file" name="foto" accept="image/*" class="form-control text-xs">
          <p class="text-[11px] text-[#9AA3B2] mt-1 font-light">
            * Jika tidak ada foto, sistem akan menampilkan kartu standar Tuan Parfum.
          </p>
        </div>
      </div>

    </div>

    <!-- Actions -->
    <div class="pt-6 border-t border-white/10 flex items-center gap-4">
      <button type="submit" class="btn-gold px-8 py-3 rounded-sm text-xs font-semibold uppercase tracking-[0.16em] shadow-md">
        {{ isset($parfum) ? 'Perbarui Data Parfum' : 'Simpan Koleksi Parfum' }}
      </button>
      <a href="{{ route('admin.parfum') }}" class="px-6 py-3 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-[0.16em] text-[#9AA3B2] hover:text-white transition-colors">
        Batal
      </a>
    </div>

  </form>

</div>
@endsection
