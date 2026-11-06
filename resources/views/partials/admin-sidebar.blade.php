<a class="list-group-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
  <i class="bi bi-grid-1x2"></i> Dashboard
</a>
<a class="list-group-item {{ request()->routeIs('admin.parfum*') ? 'active' : '' }}" href="{{ route('admin.parfum') }}">
  <i class="bi bi-bottle"></i> Parfum
</a>
<a class="list-group-item {{ request()->routeIs('admin.stok') ? 'active' : '' }}" href="{{ route('admin.stok') }}">
  <i class="bi bi-boxes"></i> Stok
</a>
<a class="list-group-item {{ request()->routeIs('admin.kategori') ? 'active' : '' }}" href="{{ route('admin.kategori') }}">
  <i class="bi bi-tags"></i> Kategori
</a>
<a class="list-group-item {{ request()->routeIs('admin.pesanan*') ? 'active' : '' }}" href="{{ route('admin.pesanan') }}">
  <i class="bi bi-bag"></i> Pesanan
</a>
<a class="list-group-item {{ request()->routeIs('admin.laporan') ? 'active' : '' }}" href="{{ route('admin.laporan') }}">
  <i class="bi bi-file-bar-graph"></i> Laporan
</a>
<form action="{{ route('logout') }}" method="POST" class="d-inline">
  @csrf
  <button type="submit" class="list-group-item border-0 text-danger">
    <i class="bi bi-box-arrow-left"></i> Keluar
  </button>
</form>