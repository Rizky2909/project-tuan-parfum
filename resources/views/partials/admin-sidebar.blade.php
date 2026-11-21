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
  <a class="flex items-center gap-3 px-4 py-2.5 rounded-sm text-sm font-medium transition-colors {{ request()->routeIs('admin.pesanan*') ? 'bg-[#C9A227]/15 text-[#C9A227] shadow-[inset_2px_0_0_#C9A227]' : 'text-[#A0AAB9] hover:bg-[#C9A227]/10 hover:text-white' }}"
     href="{{ route('admin.pesanan') }}">
    <i class="bi bi-bag text-base"></i> Pesanan
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
