<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Cormorant+Garamond:wght@500;600&family=Figtree:wght@400;500;600&family=Playfair+Display:wght@500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0A0E17;
      --surface: #101623;
      --surface-2: #151B2C;
      --gold: #C9A227;
      --gold-light: #E7B63C;
      --text-primary: #E6E9EF;
      --text-secondary: #9AA3B2;
      --line: rgba(255, 255, 255, 0.08);
      --line-gold: rgba(201, 162, 39, 0.4);
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--bg);
      color: var(--text-primary);
      line-height: 1.6;
    }

    .navbar {
      background: radial-gradient(circle at top, #151B2C 0%, #101623 100%);
      border-bottom: 1px solid var(--line-gold);
      box-shadow: 0 10px 60px rgba(0, 0, 0, 0.45);
      backdrop-filter: blur(6px);
    }

    .navbar-brand {
      font-weight: 700;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      font-family: 'Cormorant Garamond', serif;
      color: var(--text-primary) !important;
    }

    .navbar-brand small {
      display: block;
      font-size: 9px;
      letter-spacing: 0.38em;
      color: var(--gold);
      margin-top: 4px;
      font-family: 'Inter', sans-serif;
    }

    .nav-link {
      font-weight: 500;
      color: var(--text-secondary) !important;
      transition: all .2s ease-in-out;
      letter-spacing: 0.02em;
    }

    .nav-link:hover {
      color: var(--text-primary) !important;
    }

    .nav-link.active {
      color: var(--text-primary) !important;
      position: relative;
    }

    .nav-link.active::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -10px;
      width: 100%;
      height: 1px;
      background: linear-gradient(90deg, transparent 0%, var(--gold) 50%, transparent 100%);
    }

    .btn-primary {
      background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 100%);
      border: none;
      color: #101623;
      font-weight: 600;
    }

    .btn-primary:hover {
      filter: brightness(1.08);
      color: #101623;
    }

    .card {
      background: radial-gradient(circle at top, rgba(255, 255, 255, 0.01) 0%, transparent 70%), var(--surface);
      border: 1px solid var(--line);
      border-radius: 14px;
      box-shadow: 0 40px 80px -60px rgba(201, 162, 39, 0.25);
      overflow: hidden;
      color: var(--text-primary);
    }

    .card-header {
      background: transparent;
      border-bottom: 1px solid var(--line);
      font-weight: 600;
    }

    footer {
      background: radial-gradient(circle at top, #151B2C 0%, #0b101b 100%);
      border-top: 1px solid var(--line-gold);
      margin-top: 5rem;
      padding: 3rem 0 2rem;
      color: var(--text-secondary);
    }

    footer .footer-brand {
      font-weight: 700;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      font-family: 'Cormorant Garamond', serif;
      color: var(--text-primary);
    }

    footer .footer-brand small {
      display: block;
      font-size: 9px;
      letter-spacing: 0.36em;
      color: var(--gold);
      margin-top: 4px;
    }

    footer a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: color .2s ease;
    }

    footer a:hover {
      color: var(--text-primary);
    }

    footer h6 {
      color: var(--text-primary);
      letter-spacing: 0.12em;
      text-transform: uppercase;
      font-size: 12px;
    }

    footer hr {
      border-color: var(--line);
    }

    main {
      min-height: calc(100vh - 320px);
    }
  </style>
  <title>@yield('title', 'Tuan Parfum')</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('beranda') }}">
        <div class="d-flex align-items-center justify-content-center" style="width:44px;height:44px;border:1px solid var(--gold);border-radius:50%;color:var(--gold);font-family:'Cormorant Garamond',serif;font-size:18px;letter-spacing:.08em;">TP</div>
        <div>
          <span>TUAN PARFUM</span>
          <small>HAUTE PARFUMERIE</small>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto gap-lg-4">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('katalog*') ? 'active' : '' }}" href="{{ route('katalog') }}">KATALOG</a></li>
          <li class="nav-item"><a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('keranjang') ? 'active' : '' }}" href="{{ route('keranjang') }}"><i class="bi bi-bag"></i> KERANJANG</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('pesanan*') ? 'active' : '' }}" href="{{ route('pesanan') }}">PESANAN SAYA</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil*') ? 'active' : '' }}" href="{{ route('profil') }}">PROFIL</a></li>
        </ul>
        <div class="d-none d-lg-flex align-items-center gap-3">
          @auth
            <span class="text-secondary small">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="btn btn-link text-decoration-none small text-uppercase p-0" style="letter-spacing:.16em;color:var(--text-secondary);">KELUAR</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-decoration-none small text-uppercase" style="letter-spacing:.16em;color:var(--text-secondary);">MASUK</a>
            <span style="color:rgba(255,255,255,.2)">|</span>
            <a href="{{ route('register') }}" class="text-decoration-none small text-uppercase" style="letter-spacing:.16em;color:var(--gold);">DAFTAR</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <main class="flex-grow-1">
    <div class="container py-5">
      @yield('content')
    </div>
  </main>

  <footer>
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="d-flex align-items-center justify-content-center" style="width:42px;height:42px;border:1px solid var(--gold);border-radius:50%;color:var(--gold);font-family:'Cormorant Garamond',serif;">TP</div>
            <div class="footer-brand">
              <span>TUAN PARFUM</span>
              <small>HAUTE PARFUMERIE</small>
            </div>
          </div>
          <p class="mb-0">Koleksi parfum niche & extrait pilihan dengan konsentrasi tinggi untuk karakter aroma yang abadi dan elegan.</p>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-3">Navigasi</h6>
          <ul class="list-unstyled d-flex flex-column gap-2">
            <li><a href="{{ route('beranda') }}">Beranda</a></li>
            <li><a href="{{ route('katalog') }}">Katalog</a></li>
            <li><a href="{{ route('keranjang') }}">Keranjang</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-3">Akun</h6>
          <ul class="list-unstyled d-flex flex-column gap-2">
            <li><a href="{{ route('pesanan') }}">Pesanan Saya</a></li>
            <li><a href="{{ route('profil') }}">Profil</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h6 class="mb-3">Hubungi Kami</h6>
          <ul class="list-unstyled d-flex flex-column gap-2">
            <li class="d-flex align-items-start gap-2"><i class="bi bi-geo-alt mt-1"></i><span>Plaza Indonesia Lt. 2, Jakarta Pusat</span></li>
            <li class="d-flex align-items-start gap-2"><i class="bi bi-whatsapp mt-1"></i><span>+62 812-3456-7890</span></li>
            <li class="d-flex align-items-start gap-2"><i class="bi bi-envelope mt-1"></i><span>concierge@tuanparfum.id</span></li>
          </ul>
        </div>
      </div>
      <hr class="my-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
        <p class="mb-2 mb-md-0">&copy; {{ date('Y') }} Tuan Parfum Haute Parfumerie. Hak Cipta Dilindungi Undang-Undang.</p>
        <div class="d-flex gap-3">
          <a href="#">Syarat & Ketentuan</a>
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Bantuan Pelanggan</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>