@extends('layouts.admin')

@section('title', 'Koleksi & Data Parfum – Admin Tuan Parfum')

@section('content')
<div class="space-y-8">

  <!-- Header Section -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Koleksi Wewangian</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Kelola katalog parfum, harga, stok, dan visual extrait</p>
    </div>
    <a href="{{ route('admin.parfum.create') }}"
       class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider flex items-center justify-center gap-2">
      <i class="bi bi-plus-lg"></i> Tambah Parfum Baru
    </a>
  </div>

  <!-- Notifikasi Sukses -->
  @if(session('success'))
    <div class="p-4 rounded-sm bg-[#34D399]/10 border border-[#34D399]/30 text-[#34D399] text-xs tracking-wide flex items-center justify-between">
      <div class="flex items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
      </div>
      <button type="button" onclick="this.parentElement.remove()" class="text-[#34D399] hover:text-white">&times;</button>
    </div>
  @endif

  <!-- Grid Pratinjau Visual 3:4 Interaktif -->
  <div class="reveal-on-scroll">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xs uppercase font-semibold tracking-wider text-[#C9A227]">
        Pratinjau Visual Kartu 3:4 ({{ $parfums->count() }} Produk)
      </h2>
    </div>

    @if($parfums->isEmpty())
      <div class="card-luxury p-12 text-center rounded-sm bg-[#101623] border border-white/10">
        <p class="text-sm text-[#A0AAB9] mb-4">Belum ada koleksi parfum yang ditambahkan.</p>
        <a href="{{ route('admin.parfum.create') }}" class="btn-gold px-5 py-2 text-xs uppercase tracking-wider inline-block">
          Mulai Tambah Parfum Pertama
        </a>
      </div>
    @else
      <div class="stagger-parent grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($parfums as $item)
          <div class="stagger-item card-interactive group card-luxury rounded-sm overflow-hidden border border-white/10 hover:border-[#C9A227] transition-all flex flex-col justify-between bg-[#101623]">

            <!-- Wadah Visual 3:4 -->
            <div class="relative aspect-[3/4] w-full overflow-hidden bg-[#131824]">
              @if($item->foto)
                <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
              @else
                <!-- Fallback Siluet Botol Minimalis (3:4) -->
                <div class="w-full h-full p-5 flex flex-col justify-between items-center text-center relative border-b border-white/5">
                  <div class="w-full flex justify-between items-center text-[10px] text-[#A0AAB9] uppercase tracking-wider">
                    <span class="px-2 py-0.5 bg-[#0A0E17] border border-white/10 text-white font-medium">
                      {{ $item->kategori }}
                    </span>
                    <span>{{ $item->volume }} ml</span>
                  </div>

                  <div class="my-auto flex flex-col items-center">
                    <svg class="w-9 h-14 stroke-[#C9A227] fill-none stroke-[1.2] mb-2.5 opacity-80" viewBox="0 0 24 38">
                      <rect x="7" y="2" width="10" height="6" rx="0.5" stroke="currentColor"/>
                      <rect x="9" y="8" width="6" height="2" stroke="currentColor"/>
                      <rect x="3" y="10" width="18" height="25" rx="1" stroke="currentColor"/>
                      <rect x="6" y="15" width="12" height="15" rx="0.5" stroke="currentColor" stroke-dasharray="1 1" opacity="0.6"/>
                      <text x="12" y="24" text-anchor="middle" font-size="5" fill="#C9A227" font-family="serif" font-weight="bold">TP</text>
                    </svg>
                    <span class="font-serif text-sm text-white font-semibold tracking-wider block leading-tight">
                      {{ $item->nama }}
                    </span>
                    <span class="text-[9px] uppercase tracking-[0.25em] text-[#C9A227] mt-1 font-sans">
                      Tuan Parfum
                    </span>
                  </div>

                  <div class="w-full text-right text-[9px] text-[#6E7889]">
                    Foto Belum Diunggah
                  </div>
                </div>
              @endif

              <!-- Badge Stok Floating -->
              <div class="absolute bottom-2 left-2 z-10">
                @if($item->stok > 5)
                  <span class="px-2 py-0.5 text-[10px] font-semibold bg-[#34D399]/20 text-[#34D399] border border-[#34D399]/40 rounded-sm uppercase tracking-wider tabular-nums">
                    Stok: {{ $item->stok }}
                  </span>
                @else
                  <span class="px-2 py-0.5 text-[10px] font-semibold bg-[#FBBF24]/20 text-[#FBBF24] border border-[#FBBF24]/40 rounded-sm uppercase tracking-wider tabular-nums">
                    Stok Rendah: {{ $item->stok }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Konten Kartu -->
            <div class="p-4 flex-grow flex flex-col justify-between space-y-3">
              <div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-[#A0AAB9] block mb-1">
                  {{ $item->kategori }} • {{ $item->volume }} ml
                </span>
                <h3 class="font-serif text-base font-bold text-white tracking-wide group-hover:text-[#C9A227] transition-colors leading-snug">
                  {{ $item->nama }}
                </h3>
                <p class="text-xs text-[#A0AAB9] line-clamp-2 mt-1 font-light">
                  {{ $item->deskripsi ?? 'Aroma niche extrait berkualitas tinggi racikan Tuan Parfum.' }}
                </p>
              </div>

              <!-- Harga & Aksi -->
              <div class="pt-3 border-t border-white/5 space-y-2">
                <div class="flex items-baseline justify-between">
                  <span class="text-[10px] uppercase tracking-wider text-[#6E7889]">Harga</span>
                  <span class="font-semibold text-base text-[#C9A227] tabular-nums">
                    {{ $item->harga_rupiah }}
                  </span>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1">
                  <a href="{{ route('admin.parfum.edit', $item->id) }}"
                     class="px-3 py-1.5 rounded-sm border border-white/10 hover:border-[#C9A227] text-white hover:text-[#C9A227] text-center text-xs font-semibold uppercase tracking-wider transition-colors">
                    Ubah
                  </a>
                  <form action="{{ route('admin.parfum.destroy', $item->id) }}" method="POST" class="m-0"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk wewangian {{ $item->nama }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-3 py-1.5 rounded-sm border border-red-500/20 hover:border-red-500/60 text-[#F87171] text-center text-xs font-semibold uppercase tracking-wider transition-colors">
                      Hapus
                    </button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        @endforeach
      </div>
    @endif
  </div>

  <!-- Tabel Data Inventaris Terstruktur (Sesuai Dokumentasi 7.4) -->
  <div class="reveal-on-scroll card-luxury p-6 rounded-sm space-y-4 bg-[#101623] border border-white/10">
    <div class="flex justify-between items-center border-b border-white/10 pb-3">
      <h2 class="font-serif text-lg font-bold text-white tracking-wide">Tabel Data Inventaris</h2>
      <span class="text-xs text-[#A0AAB9]">Total: <strong class="text-white">{{ $parfums->count() }}</strong> Varian</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-[#E8ECF2]">
        <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
          <tr>
            <th class="py-3 px-4">No</th>
            <th class="py-3 px-4">Nama Produk</th>
            <th class="py-3 px-4">Kategori</th>
            <th class="py-3 px-4">Volume</th>
            <th class="py-3 px-4">Harga Satuan</th>
            <th class="py-3 px-4">Stok</th>
            <th class="py-3 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
          @forelse($parfums as $index => $item)
            <tr class="hover:bg-white/[0.02] transition-colors">
              <td class="py-3 px-4 text-xs text-[#A0AAB9] tabular-nums">{{ $index + 1 }}</td>
              <td class="py-3 px-4 font-medium text-white">{{ $item->nama }}</td>
              <td class="py-3 px-4 text-xs text-[#A0AAB9]">{{ $item->kategori }}</td>
              <td class="py-3 px-4 text-xs text-[#A0AAB9]">{{ $item->volume }} ml</td>
              <td class="py-3 px-4 font-semibold text-[#C9A227] tabular-nums">{{ $item->harga_rupiah }}</td>
              <td class="py-3 px-4 text-xs">
                @if($item->stok <= 5)
                  <span class="px-2 py-0.5 bg-[#FBBF24]/10 border border-[#FBBF24]/30 text-[#FBBF24] rounded-sm tabular-nums">
                    {{ $item->stok }} Botol (Menipis)
                  </span>
                @else
                  <span class="text-[#34D399] tabular-nums">{{ $item->stok }} Botol</span>
                @endif
              </td>
              <td class="py-3 px-4 text-right space-x-2">
                <a href="{{ route('admin.parfum.edit', $item->id) }}" class="text-[#C9A227] hover:underline text-xs font-semibold uppercase tracking-wider">
                  Ubah
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-6 text-center text-xs text-[#A0AAB9]">Belum ada data parfum dalam inventaris.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
