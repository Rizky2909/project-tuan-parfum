<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Panel') - Tuan Parfum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Cormorant+Garamond:wght@500;600&display=swap" rel="stylesheet">
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

    * {
      scrollbar-color: rgba(201, 162, 39, 0.4) transparent;
      scrollbar-width: thin;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--bg);
      color: var(--text-primary);
      overflow-x: hidden;
    }

    .sidebar {
      background: radial-gradient(circle at top, #151B2C 0%, #101623 100%);
      border-right: 1px solid var(--line-gold);
      min-height: 100vh;
      position: sticky;
      top: 0;
    }

    .sidebar-brand {
      font-family: 'Cormorant Garamond', serif;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--text-primary);
    }

    .sidebar-brand small {
      display: block;
      font-size: 9px;
      letter-spacing: 0.38em;
      color: var(--gold);
      margin-top: 4px;
      font-family: 'Inter', sans-serif;
    }

    .sidebar .list-group-item {
      background: transparent;
      border: none;
      border-radius: 0 10px 10px 0;
      margin: 4px 14px 4px 12px;
      padding: .7rem 1rem .7rem 1.2rem;
      font-weight: 500;
      color: var(--text-secondary);
      display: flex;
      align-items: center;
      gap: .8rem;
      transition: all .2s ease-in-out;
    }

    .sidebar .list-group-item i {
      font-size: 18px;
    }

    .sidebar .list-group-item:hover {
      background: linear-gradient(90deg, rgba(201, 162, 39, 0.16) 0%, transparent 100%);
      color: var(--text-primary);
    }

    .sidebar .list-group-item.active {
      background: linear-gradient(90deg, rgba(201, 162, 39, 0.18) 0%, transparent 100%);
      color: var(--text-primary);
      box-shadow: inset 2px 0 0 var(--gold);
    }

    .navbar-admin {
      background: radial-gradient(circle at top, #151B2C 0%, #101623 100%);
      border-bottom: 1px solid var(--line-gold);
      box-shadow: 0 10px 60px rgba(0, 0, 0, 0.45);
      padding: .8rem 2rem;
    }

    .content-wrapper {
      min-height: calc(100vh - 76px);
    }

    .card {
      background: radial-gradient(circle at top, rgba(255, 255, 255, 0.01) 0%, transparent 70%), var(--surface);
      border: 1px solid var(--line);
      border-radius: 14px;
      box-shadow: 0 70px 100px -80px rgba(201, 162, 39, 0.18);
      color: var(--text-primary);
    }

    .card-header {
      background: transparent;
      border-bottom: 1px solid var(--line);
      color: var(--text-primary);
    }

    .table {
      color: var(--text-primary);
      --bs-table-bg: transparent;
      --bs-table-striped-bg: rgba(255, 255, 255, 0.01);
      --bs-table-hover-bg: rgba(201, 162, 39, 0.05);
      --bs-table-border-color: var(--line);
    }

    .table thead th {
      border-color: var(--line);
      color: var(--text-secondary);
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 0.16em;
      font-weight: 500;
    }

    .table td,
    .table th {
      border-color: var(--line);
      vertical-align: middle;
    }

    .form-control,
    .form-select {
      background-color: transparent;
      border: 1px solid var(--line);
      color: var(--text-primary);
      border-radius: 10px;
    }

    .form-control:focus,
    .form-select:focus {
      background-color: transparent;
      color: var(--text-primary);
      border-color: rgba(201, 162, 39, 0.7);
      box-shadow: 0 0 0 1px rgba(201, 162, 39, 0.25);
    }

    .form-label {
      color: var(--text-secondary);
      font-size: 13px;
    }

    .btn-primary {
      background: linear-gradient(90deg, #b8941f 0%, #d9b63b 100%);
      border: none;
      color: #101623;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }

    .btn-primary:hover {
      filter: brightness(1.08);
      color: #101623;
    }

    .btn-outline-secondary {
      border: 1px solid var(--line);
      color: var(--text-secondary);
    }

    .btn-outline-secondary:hover {
      color: var(--text-primary);
      border-color: rgba(201, 162, 39, 0.7);
      background: transparent;
    }

    .pagination .page-link {
      background-color: transparent;
      border-color: var(--line);
      color: var(--text-secondary);
    }

    .pagination .page-item.active .page-link {
      background: linear-gradient(90deg, #b8941f 0%, #d9b63b 100%);
      border-color: transparent;
      color: #101623;
    }
  </style>
  @stack('styles')
</head>

<body>
  <nav class="navbar navbar-admin navbar-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('admin.dashboard') ?? '#' }}">
        <div class="d-flex align-items-center justify-content-center" style="width:42px;height:42px;border:1px solid var(--gold);border-radius:50%;color:var(--gold);font-family:'Cormorant Garamond',serif;font-size:18px;">TP</div>
        <div class="sidebar-brand">
          <span>TUAN PARFUM</span>
          <small>ADMIN PANEL</small>
        </div>
      </a>
      <div class="d-flex align-items-center gap-3">
        <span class="text-secondary small text-uppercase" style="letter-spacing:.16em;">Administrator</span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <aside class="col-lg-2 sidebar p-0">
        <div class="pt-4 pb-2">
          <div class="list-group list-group-flush">
            @include('partials.admin-sidebar')
          </div>
        </div>
      </aside>
      <main class="col-lg-10 px-4 px-xl-5 py-4">
        <div class="content-wrapper">
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>