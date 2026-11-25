<!doctype html>
<html lang="id" class="no-js">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>document.documentElement.classList.replace('no-js', 'js-ready');</script>
  <title>@yield('title', 'Tuan Parfum') – Haute Parfumerie</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Vite Assets (Tailwind CSS & JS) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0A0E17] text-[#E6E9EF] font-sans antialiased min-h-screen flex flex-col selection:bg-[#C9A227] selection:text-[#0A0E17]">

  <!-- Header / Navigation (Solid matte luxury) -->
  <header class="sticky top-0 z-50 bg-[#0D121D]/98 border-b border-[#C9A227]/30 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">

        <!-- Brand Logo -->
        <a href="{{ route('beranda') }}" class="flex items-center gap-3 group transition-transform duration-200">
          <div class="w-11 h-11 rounded-sm border border-[#C9A227] flex items-center justify-center text-[#C9A227] font-serif text-lg font-bold tracking-widest group-hover:border-[#DFB942] group-hover:scale-105 transition-all duration-300">
            TP
          </div>
          <div class="flex flex-col">
            <span class="font-serif font-bold text-lg md:text-xl tracking-[0.24em] text-[#E6E9EF] uppercase leading-tight group-hover:text-white transition-colors">
              TUAN PARFUM
            </span>
            <span class="text-[9px] tracking-[0.38em] text-[#C9A227] uppercase font-sans font-medium">
              HAUTE PARFUMERIE
            </span>
          </div>
        </a>

        @php
          $cartCount = Auth::check() ? Auth::user()->cartCount() : 0;
        @endphp

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 text-xs font-semibold tracking-[0.16em] uppercase">
          <a href="{{ route('katalog') }}"
             class="transition-colors pb-1 border-b-2 {{ request()->routeIs('katalog*') ? 'text-[#E6E9EF] border-[#C9A227]' : 'text-[#9AA3B2] border-transparent hover:text-[#E6E9EF] hover:border-[#C9A227]/50' }}">
            Katalog
          </a>
          <a href="{{ route('keranjang') }}"
             class="flex items-center gap-2 transition-colors pb-1 border-b-2 {{ request()->routeIs('keranjang') ? 'text-[#E6E9EF] border-[#C9A227]' : 'text-[#9AA3B2] border-transparent hover:text-[#E6E9EF] hover:border-[#C9A227]/50' }}">
            <i class="bi bi-bag text-sm text-[#C9A227]"></i>
            <span>Keranjang</span>
            @if($cartCount > 0)
              <span class="px-1.5 py-0.5 bg-[#C9A227] text-[#0A0E17] text-[10px] font-bold rounded-sm tabular-nums leading-none">
                {{ $cartCount }}
              </span>
            @endif
          </a>
          <a href="{{ route('pesanan') }}"
             class="transition-colors pb-1 border-b-2 {{ request()->routeIs('pesanan*') ? 'text-[#E6E9EF] border-[#C9A227]' : 'text-[#9AA3B2] border-transparent hover:text-[#E6E9EF] hover:border-[#C9A227]/50' }}">
            Pesanan Saya
          </a>
          <a href="{{ route('profil') }}"
             class="transition-colors pb-1 border-b-2 {{ request()->routeIs('profil*') ? 'text-[#E6E9EF] border-[#C9A227]' : 'text-[#9AA3B2] border-transparent hover:text-[#E6E9EF] hover:border-[#C9A227]/50' }}">
            Profil
          </a>
        </nav>

        <!-- Desktop Auth & Admin/Kurir Dashboard Button -->
        <div class="hidden md:flex items-center gap-4 text-xs font-semibold tracking-[0.16em]">

          <!-- Tombol Pintasan Panel Admin -->
          @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-medium tracking-wide uppercase bg-[#C9A227] text-[#0A0E17] hover:bg-[#DFB942] transition-colors rounded-sm shadow-sm">
              <i class="bi bi-speedometer2" aria-hidden="true"></i>
              <span>Dashboard Admin</span>
            </a>
          @elseif(Auth::check() && Auth::user()->role === 'kurir')
            <a href="{{ route('kurir.pengiriman') }}"
               class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-medium tracking-wide uppercase bg-[#60A5FA] text-[#0A0E17] hover:bg-[#93C5FD] transition-colors rounded-sm shadow-sm">
              <i class="bi bi-bicycle" aria-hidden="true"></i>
              <span>Panel Kurir</span>
            </a>
          @endif

          @auth
            <span class="text-[#9AA3B2] normal-case tracking-normal text-sm">
              Halo, <span class="text-white font-medium">{{ Auth::user()->name }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" class="inline m-0">
              @csrf
              <button type="submit" class="text-[#9AA3B2] hover:text-[#C9A227] uppercase transition-colors">
                Keluar
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-[#9AA3B2] hover:text-white uppercase transition-colors">
              Masuk
            </a>
            <span class="text-white/20">|</span>
            <a href="{{ route('register') }}" class="text-[#C9A227] hover:text-[#E7B63C] uppercase transition-colors font-bold">
              Daftar
            </a>
          @endauth
        </div>

        <!-- Mobile Menu Toggle Button -->
        <div class="md:hidden flex items-center">
          <button id="mobile-menu-btn" type="button" class="p-2 text-[#9AA3B2] hover:text-[#C9A227] focus:outline-none transition-colors" aria-label="Toggle navigation">
            <i class="bi bi-list text-2xl" id="menu-icon-open"></i>
            <i class="bi bi-x text-2xl hidden" id="menu-icon-close"></i>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Dropdown Navigation -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-[#C9A227]/20 bg-[#0D121D] px-4 pt-3 pb-6 space-y-3 animate-subtle-in">

      <!-- Tombol Admin Mobile (Section 3.2 Dokumentasi) -->
      @if(Auth::check() && Auth::user()->role === 'admin')
        <div class="pb-2 border-b border-white/10">
          <a href="{{ route('admin.dashboard') }}" class="px-3 py-2.5 rounded-sm bg-[#C9A227] text-[#0A0E17] flex items-center gap-2 text-xs font-semibold uppercase tracking-wide">
            <i class="bi bi-speedometer2" aria-hidden="true"></i>
            <span>Kembali ke Dashboard Admin</span>
          </a>
        </div>
      @endif

      <nav class="flex flex-col space-y-2 text-xs font-semibold tracking-[0.16em] uppercase">
        <a href="{{ route('katalog') }}" class="px-3 py-2 rounded-sm transition-colors {{ request()->routeIs('katalog*') ? 'bg-[#C9A227]/10 text-[#C9A227]' : 'text-[#9AA3B2] hover:bg-white/5 hover:text-white' }}">
          Katalog
        </a>
        <a href="{{ route('keranjang') }}" class="px-3 py-2 rounded-sm flex items-center justify-between transition-colors {{ request()->routeIs('keranjang') ? 'bg-[#C9A227]/10 text-[#C9A227]' : 'text-[#9AA3B2] hover:bg-white/5 hover:text-white' }}">
          <div class="flex items-center gap-2">
            <i class="bi bi-bag text-[#C9A227]"></i>
            <span>Keranjang</span>
          </div>
          @if($cartCount > 0)
            <span class="px-1.5 py-0.5 bg-[#C9A227] text-[#0A0E17] text-[10px] font-bold rounded-sm tabular-nums">
              {{ $cartCount }}
            </span>
          @endif
        </a>
        <a href="{{ route('pesanan') }}" class="px-3 py-2 rounded-sm transition-colors {{ request()->routeIs('pesanan*') ? 'bg-[#C9A227]/10 text-[#C9A227]' : 'text-[#9AA3B2] hover:bg-white/5 hover:text-white' }}">
          Pesanan Saya
        </a>
        <a href="{{ route('profil') }}" class="px-3 py-2 rounded-sm transition-colors {{ request()->routeIs('profil*') ? 'bg-[#C9A227]/10 text-[#C9A227]' : 'text-[#9AA3B2] hover:bg-white/5 hover:text-white' }}">
          Profil
        </a>
      </nav>

      <div class="pt-4 border-t border-white/10 flex flex-col gap-2 text-xs font-semibold tracking-[0.16em]">
        @auth
          <span class="text-[#9AA3B2] text-sm px-3">
            Halo, <span class="text-white">{{ Auth::user()->name }}</span>
          </span>
          <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 text-[#9AA3B2] hover:text-[#C9A227] uppercase">
              Keluar
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="px-3 py-2 text-[#9AA3B2] hover:text-white uppercase">
            Masuk
          </a>
          <a href="{{ route('register') }}" class="px-3 py-2 text-[#C9A227] hover:text-[#E7B63C] uppercase font-bold">
            Daftar Akun
          </a>
        @endauth
      </div>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="flex-grow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

      <!-- Flash Messages -->
      @if(session('success'))
        <div class="mb-6 p-4 rounded-sm bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between animate-subtle-in">
          <div class="flex items-center gap-2">
            <i class="bi bi-check-circle-fill text-sm"></i>
            <span>{{ session('success') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-emerald-300 hover:text-white">&times;</button>
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 p-4 rounded-sm bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-center justify-between animate-subtle-in">
          <div class="flex items-center gap-2">
            <i class="bi bi-exclamation-octagon-fill text-sm"></i>
            <span>{{ session('error') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-rose-300 hover:text-white">&times;</button>
        </div>
      @endif

      @if(session('info'))
        <div class="mb-6 p-4 rounded-sm bg-sky-500/10 border border-sky-500/30 text-sky-300 text-xs flex items-center justify-between animate-subtle-in">
          <div class="flex items-center gap-2">
            <i class="bi bi-info-circle-fill text-sm"></i>
            <span>{{ session('info') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-sky-300 hover:text-white">&times;</button>
        </div>
      @endif

      @if(session('guest_order_info'))
        <div class="mb-6 p-4 rounded-sm bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs flex items-center justify-between animate-subtle-in">
          <div class="flex items-center gap-2">
            <i class="bi bi-shield-lock-fill text-sm"></i>
            <span>{{ session('guest_order_info') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-amber-300 hover:text-white">&times;</button>
        </div>
      @endif

      @yield('content')
    </div>
  </main>

  <!-- Footer (Solid matte dark luxury) -->
  <footer class="bg-[#0A0E17] border-t border-[#C9A227]/30 text-[#9AA3B2] mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">

        <!-- Column 1: Brand Info -->
        <div class="lg:col-span-5 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-sm border border-[#C9A227] flex items-center justify-center text-[#C9A227] font-serif text-base font-bold tracking-widest">
              TP
            </div>
            <div class="flex flex-col">
              <span class="font-serif font-bold text-lg tracking-[0.24em] text-[#E6E9EF] uppercase leading-tight">
                TUAN PARFUM
              </span>
              <span class="text-[9px] tracking-[0.36em] text-[#C9A227] uppercase font-sans font-medium">
                HAUTE PARFUMERIE
              </span>
            </div>
          </div>
          <p class="text-sm leading-relaxed text-[#9AA3B2] max-w-sm font-light">
            Koleksi parfum niche & extrait pilihan dengan konsentrasi tinggi untuk karakter aroma yang abadi, memikat, dan elegan.
          </p>
        </div>

        <!-- Column 2: Navigasi -->
        <div class="lg:col-span-2 space-y-3">
          <h6 class="text-xs uppercase font-semibold tracking-[0.16em] text-[#E6E9EF]">Navigasi</h6>
          <ul class="space-y-2 text-sm font-light">
            <li><a href="{{ route('beranda') }}" class="hover:text-white transition-colors">Beranda</a></li>
            <li><a href="{{ route('katalog') }}" class="hover:text-white transition-colors">Katalog</a></li>
            <li><a href="{{ route('keranjang') }}" class="hover:text-white transition-colors">Keranjang</a></li>
          </ul>
        </div>

        <!-- Column 3: Akun -->
        <div class="lg:col-span-2 space-y-3">
          <h6 class="text-xs uppercase font-semibold tracking-[0.16em] text-[#E6E9EF]">Akun</h6>
          <ul class="space-y-2 text-sm font-light">
            <li><a href="{{ route('pesanan') }}" class="hover:text-white transition-colors">Pesanan Saya</a></li>
            <li><a href="{{ route('profil') }}" class="hover:text-white transition-colors">Profil</a></li>
          </ul>
        </div>

        <!-- Column 4: Kontak -->
        <div class="lg:col-span-3 space-y-3">
          <h6 class="text-xs uppercase font-semibold tracking-[0.16em] text-[#E6E9EF]">Hubungi Kami</h6>
          <ul class="space-y-2.5 text-sm font-light">
            <li class="flex items-start gap-2.5">
              <i class="bi bi-geo-alt text-[#C9A227] mt-0.5"></i>
              <span>Sungai Bangek, Kota Padang, Sumatera Barat</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i class="bi bi-whatsapp text-[#C9A227] mt-0.5"></i>
              <span>+62 812-3456-7890</span>
            </li>
            <li class="flex items-start gap-2.5">
              <i class="bi bi-envelope text-[#C9A227] mt-0.5"></i>
              <span>concierge@tuanparfum.id</span>
            </li>
          </ul>
        </div>

      </div>

      <!-- Footer Bottom -->
      <div class="border-t border-white/10 mt-12 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-[#9AA3B2] gap-4">
        <p class="m-0">&copy; {{ date('Y') }} Tuan Parfum Haute Parfumerie. Hak Cipta Dilindungi Undang-Undang.</p>
        <div class="flex gap-6">
          <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
          <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
          <a href="#" class="hover:text-white transition-colors">Bantuan Concierge</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Mobile Menu Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btn = document.getElementById('mobile-menu-btn');
      const menu = document.getElementById('mobile-menu');
      const iconOpen = document.getElementById('menu-icon-open');
      const iconClose = document.getElementById('menu-icon-close');

      if (btn && menu) {
        btn.addEventListener('click', function () {
          const isHidden = menu.classList.contains('hidden');
          if (isHidden) {
            menu.classList.remove('hidden');
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
          } else {
            menu.classList.add('hidden');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
          }
        });
      }
    });
  </script>

</body>

</html>
