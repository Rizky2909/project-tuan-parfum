<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Panel Kurir') - Tuan Parfum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Cormorant+Garamond:wght@500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0A0E17;
      --surface: #101623;
      --surface-2: #151B2C;
      --gold: #C9A227;
      --gold-light: #E7B63C;
      --text: #E6E9EF;
      --muted: #9AA3B2;
      --line: rgba(255, 255, 255, 0.08);
      --line-gold: rgba(201, 162, 39, 0.4);
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--bg);
      color: var(--text);
    }

    .kurir-topbar {
      background: radial-gradient(circle at top, #151B2C 0%, #101623 100%);
      border-bottom: 1px solid var(--line-gold);
      box-shadow: 0 10px 60px rgba(0, 0, 0, 0.4);
      padding: 14px 28px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .brand {
      font-family: 'Cormorant Garamond', serif;
      letter-spacing: 0.26em;
      text-transform: uppercase;
    }

    .brand small {
      display: block;
      font-size: 9px;
      letter-spacing: 0.36em;
      color: var(--gold);
      margin-top: 3px;
      font-family: 'Inter', sans-serif;
    }

    .card {
      background: radial-gradient(circle at top, rgba(255, 255, 255, 0.01) 0%, transparent 70%), var(--surface);
      border: 1px solid var(--line);
      border-radius: 14px;
      color: var(--text);
      box-shadow: 0 60px 90px -80px rgba(201, 162, 39, 0.18);
    }

    .card-header {
      background: transparent;
      border-bottom: 1px solid var(--line);
      color: var(--text);
    }

    .list-group-item {
      background: transparent;
      color: var(--text);
      border-color: var(--line);
    }

    .list-group-item.active {
      background: linear-gradient(90deg, rgba(201, 162, 39, 0.18) 0%, transparent 100%);
      color: var(--text);
      border-color: var(--line);
      box-shadow: inset 2px 0 0 var(--gold);
    }

    .btn-gold {
      background: linear-gradient(90deg, #b8941f 0%, #d9b63b 100%);
      color: #101623;
      border: none;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }

    .btn-gold:hover {
      filter: brightness(1.08);
      color: #101623;
    }

    .btn-outline-light {
      border: 1px solid var(--line);
      color: var(--muted);
    }

    .btn-outline-light:hover {
      color: var(--text);
      border-color: rgba(201, 162, 39, 0.7);
      background: transparent;
    }

    .form-control {
      background-color: transparent;
      border: 1px solid var(--line);
      color: var(--text);
      border-radius: 10px;
    }

    .form-control:focus {
      background-color: transparent;
      color: var(--text);
      border-color: rgba(201, 162, 39, 0.7);
      box-shadow: 0 0 0 1px rgba(201, 162, 39, 0.25);
    }

    .table {
      color: var(--text);
      --bs-table-bg: transparent;
      --bs-table-border-color: var(--line);
    }

    .table thead th {
      border-color: var(--line);
      color: var(--muted);
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 0.16em;
    }

    .table td,
    .table th {
      border-color: var(--line);
    }

    .text-muted {
      color: var(--muted) !important;
    }

    .badge-gold {
      background: linear-gradient(90deg, #b8941f 0%, #d9b63b 100%);
      color: #101623;
    }
  </style>
  @stack('styles')
</head>

<body>
  <header class="kurir-topbar d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
      <div class="d-flex align-items-center justify-content-center" style="width:42px;height:42px;border:1px solid var(--gold);border-radius:50%;color:var(--gold);font-family:'Cormorant Garamond',serif;font-size:18px;">TP</div>
      <div class="brand">
        <span>TUAN PARFUM</span>
        <small>PANEL KURIR</small>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2 text-secondary small">
      <i class="bi bi-truck"></i>
      <span>Kurir Tuan Parfum</span>
      <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
      </form>
    </div>
  </header>

  <main class="container py-4 py-lg-5">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>