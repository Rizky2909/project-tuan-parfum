<!doctype html>
<html lang="id" class="no-js">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>document.documentElement.classList.replace('no-js', 'js-ready');</script>
  <title>@yield('title', 'Panel Kurir') – Tuan Parfum</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Vite Assets (Tailwind CSS & JS) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0A0E17] text-[#E8ECF2] font-sans antialiased min-h-screen flex flex-col selection:bg-[#C9A227] selection:text-[#0A0E17]">

  <!-- Topbar Kurir -->
  <header class="sticky top-0 z-40 bg-[#101623] border-b border-white/10 shadow-md">
    <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-sm border border-[#C9A227] flex items-center justify-center text-[#C9A227] font-serif font-bold text-sm">
          TP
        </div>
        <div>
          <span class="font-serif font-bold text-base tracking-widest text-white uppercase block leading-tight">
            TUAN PARFUM
          </span>
          <span class="text-[9px] uppercase tracking-[0.25em] text-[#C9A227] font-sans font-medium">
            Panel Kurir Lapangan
          </span>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <span class="hidden sm:inline text-xs text-[#A0AAB9]">
          Petugas: <strong class="text-white">{{ Auth::user()->name ?? 'Kurir' }}</strong>
        </span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
          @csrf
          <button type="submit" class="px-3 py-1.5 rounded-sm border border-white/10 text-xs font-semibold uppercase tracking-wider text-[#A0AAB9] hover:text-[#C9A227] hover:border-[#C9A227] transition-colors">
            Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Konten Utama Kurir -->
  <main class="flex-1 max-w-4xl w-full mx-auto px-4 py-6 animate-subtle-in">
    <!-- Flash Messages -->
    @if(session('success'))
      <div class="mb-5 p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
          <i class="bi bi-check-circle-fill"></i>
          <span>{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-300 hover:text-white">&times;</button>
      </div>
    @endif

    @if(session('error'))
      <div class="mb-5 p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
          <i class="bi bi-exclamation-octagon-fill"></i>
          <span>{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-300 hover:text-white">&times;</button>
      </div>
    @endif

    @yield('content')
  </main>

</body>

</html>
