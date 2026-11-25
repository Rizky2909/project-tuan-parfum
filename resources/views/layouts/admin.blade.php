<!doctype html>
<html lang="id" class="no-js">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>document.documentElement.classList.replace('no-js', 'js-ready');</script>
  <title>@yield('title', 'Admin Panel') – Tuan Parfum</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Vite Assets (Tailwind CSS & JS) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0A0E17] text-[#E8ECF2] font-sans antialiased min-h-screen flex selection:bg-[#C9A227] selection:text-[#0A0E17]">

  <!-- Desktop Sidebar -->
  <aside class="hidden lg:flex lg:flex-col w-64 bg-[#101623] border-r border-white/10 shrink-0 sticky top-0 h-screen overflow-y-auto">
    <!-- Brand Header -->
    <div class="p-6 border-b border-white/10 flex items-center gap-3">
      <div class="w-10 h-10 rounded-sm border border-[#C9A227] flex items-center justify-center text-[#C9A227] font-serif font-bold text-base">
        TP
      </div>
      <div>
        <span class="font-serif font-bold text-base tracking-widest text-white uppercase block leading-tight">
          TUAN PARFUM
        </span>
        <span class="text-[9px] uppercase tracking-[0.25em] text-[#C9A227] font-sans font-medium">
          Panel Administrator
        </span>
      </div>
    </div>

    <!-- Nav Items -->
    <div class="p-4 flex-1">
      @include('partials.admin-sidebar')
    </div>

    <!-- Admin Footer -->
    <div class="p-4 border-t border-white/10 text-xs text-[#A0AAB9]">
      <span class="block text-[10px] uppercase tracking-wider text-[#6E7889]">Petugas Aktif</span>
      <span class="font-medium text-white">{{ Auth::user()->name ?? 'Administrator' }}</span>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Topbar -->
    <header class="sticky top-0 z-40 bg-[#101623] border-b border-white/10 h-16 flex items-center justify-between px-4 sm:px-8">
      <div class="flex items-center gap-3">
        <!-- Mobile Sidebar Toggle -->
        <button id="admin-menu-btn" type="button" class="lg:hidden p-2 text-[#A0AAB9] hover:text-white" aria-label="Toggle navigation">
          <i class="bi bi-list text-2xl"></i>
        </button>
        <span class="text-xs uppercase font-semibold tracking-wider text-[#A0AAB9]">
          Sistem Administrasi &amp; Inventaris
        </span>
      </div>

      <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-wider">
        <a href="{{ route('beranda') }}"
           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-[#C9A227]/40 text-[#C9A227] hover:bg-[#C9A227]/10 transition-colors">
          <i class="bi bi-shop"></i> Toko Publik
        </a>
      </div>
    </header>

    <!-- Mobile Dropdown Sidebar Menu -->
    <div id="admin-mobile-menu" class="hidden lg:hidden bg-[#101623] border-b border-white/10 p-4">
      @include('partials.admin-sidebar')
    </div>

    <!-- Page Content -->
    <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto animate-subtle-in">
      <!-- Flash Messages -->
      @if(session('success'))
        <div class="mb-6 p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-emerald-300 hover:text-white">&times;</button>
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="bi bi-exclamation-octagon-fill"></i>
            <span>{{ session('error') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-rose-300 hover:text-white">&times;</button>
        </div>
      @endif

      @if(session('info'))
        <div class="mb-6 p-4 rounded-sm bg-sky-500/10 border border-sky-500/30 text-sky-300 text-xs flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="bi bi-info-circle-fill"></i>
            <span>{{ session('info') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-sky-300 hover:text-white">&times;</button>
        </div>
      @endif

      @yield('content')
    </main>

  </div>

  <script>
    const adminBtn = document.getElementById('admin-menu-btn');
    const adminMenu = document.getElementById('admin-mobile-menu');
    if (adminBtn && adminMenu) {
      adminBtn.addEventListener('click', () => {
        adminMenu.classList.toggle('hidden');
      });
    }
  </script>
</body>

</html>
