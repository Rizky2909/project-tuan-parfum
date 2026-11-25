<nav class="flex flex-col gap-1">
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.dashboard') }}">
    <i class="bi bi-grid-1x2 text-base"></i> Dashboard
  </a>
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.parfum*') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.parfum') }}">
    <i class="bi bi-bottle text-base"></i> Parfum
  </a>
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.stok') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.stok') }}">
    <i class="bi bi-boxes text-base"></i> Stok
  </a>
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.kategori') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.kategori') }}">
    <i class="bi bi-tags text-base"></i> Kategori
  </a>
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

  @php
    $actionNeededOrders = \App\Models\Order::whereIn('status', ['menunggu_verifikasi', 'diproses'])->count();
  @endphp

  <a href="{{ route('admin.pesanan') }}"
     class="flex items-center justify-between px-4 py-3 rounded-sm transition-colors {{ request()->routeIs('admin.pesanan*') ? 'bg-[#C9A227] text-[#0A0E17]' : 'text-[#A0AAB9] hover:bg-white/5 hover:text-white' }}">
    <div class="flex items-center gap-3">
      <i class="bi bi-bag-check text-sm"></i>
      <span>Pesanan Masuk</span>
    </div>
    @if($actionNeededOrders > 0)
      <span class="px-1.5 py-0.5 bg-[#C9A227] text-[#0A0E17] text-[10px] font-bold rounded-sm tabular-nums">
        {{ $actionNeededOrders }}
      </span>
    @endif
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
  </a>
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.laporan') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.laporan') }}">
    <i class="bi bi-file-bar-graph text-base"></i> Laporan
  </a>
  <form action="{{ route('logout') }}" method="POST" class="mt-2 pt-2 border-t border-white/10">
    @csrf
    <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium text-[#F87171] hover:bg-[#F87171]/10 transition-colors w-full text-left">
      <i class="bi bi-box-arrow-left text-base"></i> Keluar
    </button>
  </form>
</nav>
