<div class="space-y-1 text-xs font-semibold uppercase tracking-wider">
  <a href="{{ route('admin.dashboard') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-grid-1x2 text-sm"></i>
    <span>Dashboard</span>
  </a>

  <a href="{{ route('admin.parfum') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.parfum*') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-droplet text-sm"></i>
    <span>Koleksi Parfum</span>
  </a>

  <a href="{{ route('admin.stok') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.stok') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-boxes text-sm"></i>
    <span>Manajemen Stok</span>
  </a>

  <a href="{{ route('admin.kategori') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.kategori') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-tags text-sm"></i>
    <span>Kategori Aroma</span>
  </a>

  <a href="{{ route('admin.pesanan') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.pesanan*') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-bag-check text-sm"></i>
    <span>Pesanan Masuk</span>
  </a>

  <a href="{{ route('admin.laporan') }}"
     class="flex items-center gap-3 px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.laporan') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <i class="bi bi-file-bar-graph text-sm"></i>
    <span>Laporan Penjualan</span>
  </a>

  <div class="pt-4 mt-4 border-t border-white/10 space-y-1">
    <a href="{{ route('beranda') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-sm text-[#C9A227] hover:bg-[#C9A227]/10 transition-colors">
      <i class="bi bi-shop text-sm"></i>
      <span>Lihat Toko Publik</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" class="m-0">
      @csrf
      <button type="submit"
              class="w-full flex items-center gap-3 px-4 py-3 rounded-sm text-[#F87171] hover:bg-red-500/10 transition-colors text-left font-semibold uppercase tracking-wider text-xs">
        <i class="bi bi-box-arrow-left text-sm"></i>
        <span>Keluar Sistem</span>
      </button>
    </form>
  </div>
</div>
