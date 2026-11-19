@extends('layouts.admin')

@section('title', 'Kategori Aroma – Admin Tuan Parfum')

@section('content')
<div class="space-y-6">

  <!-- Header -->
  <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-4">
    <div>
      <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">Kategori Aroma</h1>
      <p class="text-xs text-[#A0AAB9] uppercase tracking-[0.14em] mt-1">Klasifikasi piramida aroma dan varian segmentasi wewangian</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Kolom Kiri: Tabel Kategori -->
    <div class="lg:col-span-7 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Daftar Kategori Aktif
        </h2>

        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-[#E8ECF2]">
            <thead class="bg-[#161E2E] text-xs uppercase tracking-[0.1em] text-[#A0AAB9] border-b border-white/10">
              <tr>
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Nama Kategori</th>
                <th class="py-3 px-4 text-center">Jumlah Produk</th>
                <th class="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-xs">
              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-3.5 px-4 tabular-nums">1</td>
                <td class="py-3.5 px-4 font-medium text-white">Unisex</td>
                <td class="py-3.5 px-4 text-center tabular-nums">2 Produk</td>
                <td class="py-3.5 px-4 text-right space-x-2">
                  <button type="button" class="text-[#C9A227] hover:underline uppercase tracking-wider font-semibold">Ubah</button>
                  <button type="button" class="text-[#F87171] hover:underline uppercase tracking-wider font-semibold">Hapus</button>
                </td>
              </tr>

              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-3.5 px-4 tabular-nums">2</td>
                <td class="py-3.5 px-4 font-medium text-white">Pria</td>
                <td class="py-3.5 px-4 text-center tabular-nums">1 Produk</td>
                <td class="py-3.5 px-4 text-right space-x-2">
                  <button type="button" class="text-[#C9A227] hover:underline uppercase tracking-wider font-semibold">Ubah</button>
                  <button type="button" class="text-[#F87171] hover:underline uppercase tracking-wider font-semibold">Hapus</button>
                </td>
              </tr>

              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-3.5 px-4 tabular-nums">3</td>
                <td class="py-3.5 px-4 font-medium text-white">Wanita</td>
                <td class="py-3.5 px-4 text-center tabular-nums">1 Produk</td>
                <td class="py-3.5 px-4 text-right space-x-2">
                  <button type="button" class="text-[#C9A227] hover:underline uppercase tracking-wider font-semibold">Ubah</button>
                  <button type="button" class="text-[#F87171] hover:underline uppercase tracking-wider font-semibold">Hapus</button>
                </td>
              </tr>

              <tr class="hover:bg-white/[0.02] transition-colors">
                <td class="py-3.5 px-4 tabular-nums">4</td>
                <td class="py-3.5 px-4 font-medium text-white">Koleksi Eksklusif</td>
                <td class="py-3.5 px-4 text-center tabular-nums">0 Produk</td>
                <td class="py-3.5 px-4 text-right space-x-2">
                  <button type="button" class="text-[#C9A227] hover:underline uppercase tracking-wider font-semibold">Ubah</button>
                  <button type="button" class="text-[#F87171] hover:underline uppercase tracking-wider font-semibold">Hapus</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Form Tambah Kategori -->
    <div class="lg:col-span-5 reveal-on-scroll">
      <div class="card-luxury p-6 rounded-sm bg-[#101623] border border-white/10 space-y-4">
        <h2 class="font-serif text-lg font-bold text-white border-b border-white/10 pb-3">
          Tambah / Ubah Kategori
        </h2>

        <form action="#" method="POST" class="space-y-4">
          @csrf
          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Nama Kategori
            </label>
            <input type="text" required placeholder="Contoh: Woody & Amber"
                   class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]">
          </div>

          <div>
            <label class="block text-xs font-semibold uppercase tracking-[0.12em] text-[#A0AAB9] mb-1.5">
              Karakteristik &amp; Deskripsi
            </label>
            <textarea rows="3" placeholder="Penjelasan karakter notes aroma dalam kategori ini..."
                      class="w-full bg-[#161E2E] border border-white/10 rounded-sm px-4 py-2.5 text-xs text-white placeholder-[#6E7889] focus:outline-none focus:border-[#C9A227]"></textarea>
          </div>

          <div class="flex items-center gap-3 pt-2">
            <button type="button" onclick="alert('Kategori berhasil disimpan!')"
                    class="btn-gold px-5 py-2.5 rounded-sm text-xs font-semibold uppercase tracking-wider">
              Simpan Kategori
            </button>
            <button type="reset"
                    class="px-4 py-2.5 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-wider text-[#A0AAB9] hover:text-white transition-colors">
              Reset
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>

</div>
@endsection
