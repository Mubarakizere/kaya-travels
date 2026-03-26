<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Admin Panel') - Kaya Travels</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    :root {
      --gold: #c9a227;
      --gold-dark: #a8871e;
      --gold-light: #f5ecd0;
      --gold-hover: rgba(201,162,39,0.06);
      --cream: #f8f6f1;
      --sand: #f0ece3;
      --sidebar-bg: #ffffff;
      --text-dark: #1a1814;
      --text-body: #3d3830;
      --text-muted: #8a8278;
      --border: rgba(0,0,0,0.06);
      --radius: 10px;
    }

    * { box-sizing: border-box; }

    html, body {
      height: 100%;
      background: var(--cream);
      color: var(--text-body);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      overflow: hidden;
      margin: 0;
    }

    .wrapper {
      display: flex;
      height: 100vh;
    }

    /* ========== SIDEBAR ========== */
    .sidebar {
      width: 260px;
      background: var(--sidebar-bg);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      overflow: hidden;
    }

    /* Brand header */
    .sidebar-header {
      padding: 1.5rem 1.5rem 1.25rem;
      border-bottom: 1px solid var(--border);
    }

    .sidebar-header .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }

    .brand-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      flex-shrink: 0;
    }

    .brand-icon svg { width: 20px; height: 20px; }

    .brand-text h5 {
      margin: 0;
      font-weight: 700;
      font-size: 1rem;
      color: var(--text-dark);
      letter-spacing: -0.3px;
    }

    .brand-text span {
      font-size: 0.68rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 500;
    }

    /* Nav sections */
    .sidebar-nav {
      flex: 1;
      overflow-y: auto;
      padding: 0.75rem 0;
    }

    .nav-section {
      margin-bottom: 0.5rem;
    }

    .nav-section-label {
      padding: 0.5rem 1.5rem 0.35rem;
      font-size: 0.65rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1.8px;
      color: var(--text-muted);
      opacity: 0.7;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0.6rem 1.5rem;
      margin: 1px 0.75rem;
      border-radius: var(--radius);
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.88rem;
      font-weight: 500;
      transition: all 0.2s ease;
      position: relative;
    }

    .nav-link:hover {
      background: var(--gold-hover);
      color: var(--text-dark);
    }

    .nav-link.active {
      background: var(--gold-light);
      color: var(--gold-dark);
      font-weight: 600;
    }

    .nav-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 60%;
      background: var(--gold);
      border-radius: 0 3px 3px 0;
    }

    .nav-link [data-lucide],
    .nav-link .lucide {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
      opacity: 0.7;
    }

    .nav-link.active [data-lucide],
    .nav-link.active .lucide {
      opacity: 1;
    }

    .nav-link .nav-badge {
      margin-left: auto;
      background: var(--gold);
      color: #fff;
      font-size: 0.65rem;
      font-weight: 700;
      padding: 2px 7px;
      border-radius: 20px;
      min-width: 20px;
      text-align: center;
      line-height: 1.3;
    }

    /* Sidebar footer */
    .sidebar-footer {
      padding: 1rem 1.5rem;
      border-top: 1px solid var(--border);
    }

    .admin-profile {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 0.75rem;
    }

    .admin-avatar {
      width: 36px;
      height: 36px;
      background: var(--sand);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gold-dark);
      font-weight: 700;
      font-size: 0.8rem;
      flex-shrink: 0;
    }

    .admin-info {
      flex: 1;
      min-width: 0;
    }

    .admin-info .name {
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text-dark);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .admin-info .role {
      font-size: 0.68rem;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-logout {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 0.55rem;
      border: 1px solid rgba(200,50,50,0.15);
      border-radius: var(--radius);
      background: transparent;
      color: #b44;
      font-size: 0.82rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
    }

    .btn-logout:hover {
      background: #fef2f2;
      border-color: rgba(200,50,50,0.25);
      color: #933;
    }

    .btn-logout [data-lucide] { width: 16px; height: 16px; }

    /* ========== TOP BAR ========== */
    .topbar {
      height: 60px;
      background: #fff;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
      flex-shrink: 0;
    }

    .topbar-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text-dark);
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .topbar-link {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.85rem;
      font-weight: 500;
      padding: 0.4rem 0.75rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }

    .topbar-link:hover {
      background: var(--sand);
      color: var(--text-dark);
    }

    .topbar-link [data-lucide] { width: 16px; height: 16px; }

    /* ========== CONTENT ========== */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .content-wrapper {
      flex: 1;
      overflow-y: auto;
      padding: 2rem;
      background: var(--cream);
    }

    /* ========== UTILITY CLASSES ========== */
    .text-gold { color: var(--gold) !important; }

    .btn-gold {
      background: linear-gradient(135deg, var(--gold), var(--gold-dark));
      color: #fff;
      border: none;
      padding: 0.5rem 1.25rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-gold:hover {
      box-shadow: 0 4px 16px rgba(201,162,39,0.25);
      color: #fff;
      transform: translateY(-1px);
    }

    .btn-outline-gold {
      border: 1.5px solid var(--gold);
      color: var(--gold-dark);
      font-weight: 600;
      transition: 0.3s ease;
      border-radius: 8px;
    }

    .btn-outline-gold:hover {
      background: var(--gold);
      color: #fff;
    }

    /* Table styling */
    .table { color: var(--text-body); }
    .table-dark {
      --bs-table-bg: #fff !important;
      --bs-table-color: var(--text-body) !important;
      --bs-table-border-color: var(--border) !important;
      --bs-table-hover-bg: var(--sand) !important;
    }
    .table-gold {
      background-color: var(--gold) !important;
      color: #fff !important;
    }

    /* Cards */
    .card-metric {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 1.5rem;
      color: var(--text-dark);
      box-shadow: 0 1px 4px rgba(0,0,0,0.03);
      transition: 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .card-metric::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: linear-gradient(to bottom, var(--gold), var(--gold-dark));
      border-radius: 4px 0 0 4px;
    }

    .card-metric:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(201,162,39,0.1);
    }

    .card-metric h4 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.2rem;
      color: var(--text-dark);
    }

    .card-metric small {
      font-size: 0.85rem;
      color: var(--text-muted);
      display: block;
      font-weight: 500;
    }

    /* Alerts */
    .alert-warning {
      background: var(--gold-light);
      border: 1px solid rgba(201,162,39,0.2);
      color: var(--gold-dark);
    }

    /* ========== MOBILE ========== */
    .sidebar-toggle {
      position: fixed;
      top: 0.75rem;
      left: 0.75rem;
      z-index: 1050;
      background: #fff;
      border: 1.5px solid var(--gold);
      padding: 0.5rem 0.65rem;
      border-radius: 10px;
      color: var(--gold);
      font-size: 1.2rem;
      display: none;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      cursor: pointer;
    }

    .sidebar-toggle:hover { background: var(--gold-light); }

    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.3);
      z-index: 1035;
    }

    @media (max-width: 768px) {
      .sidebar-toggle { display: flex; align-items: center; justify-content: center; }
      .topbar { padding-left: 3.5rem; }

      .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        transform: translateX(-100%);
        z-index: 1040;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 4px 0 24px rgba(0,0,0,0.1);
      }

      .sidebar.show { transform: translateX(0); }
      .sidebar.show + .sidebar-overlay { display: block; }
    }
  </style>

  @stack('styles')
</head>
<body>

<!-- Mobile Toggle -->
<button class="sidebar-toggle d-md-none" id="sidebarToggle">
  <i data-lucide="menu"></i>
</button>

<div class="wrapper">
  <!-- Sidebar -->
  <nav class="sidebar" id="sidebar">
    <!-- Brand -->
    <div class="sidebar-header">
      <a href="{{ route('admin.dashboard') }}" class="brand">
        <div class="brand-icon">
          <i data-lucide="globe"></i>
        </div>
        <div class="brand-text">
          <h5>Kaya Travels</h5>
          <span>Admin Panel</span>
        </div>
      </a>
    </div>

    <!-- Navigation -->
    <div class="sidebar-nav">
      <div class="nav-section">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i data-lucide="layout-dashboard"></i> Dashboard
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Travel</div>
        <a href="{{ route('admin.flights.index') }}" class="nav-link {{ request()->routeIs('admin.flights.*') ? 'active' : '' }}">
          <i data-lucide="plane"></i> Flights
        </a>
        <a href="{{ route('admin.trips.index') }}" class="nav-link {{ request()->routeIs('admin.trips.*') ? 'active' : '' }}">
          <i data-lucide="compass"></i> Trips
        </a>
        <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
          <i data-lucide="map-pin"></i> Destinations
        </a>
        <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
          <i data-lucide="calendar-check"></i> Bookings
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Content</div>
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
          <i data-lucide="file-text"></i> Blog Posts
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
          <i data-lucide="tags"></i> Categories
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-label">Settings</div>
        <a href="{{ route('admin.site-images.index') }}" class="nav-link {{ request()->routeIs('admin.site-images.*') ? 'active' : '' }}">
          <i data-lucide="image"></i> Site Images
        </a>
      </div>
    </div>

    <!-- Footer -->
    <div class="sidebar-footer">
      <div class="admin-profile">
        <div class="admin-avatar">
          {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
        <div class="admin-info">
          <div class="name">{{ auth()->user()->name ?? 'Admin' }}</div>
          <div class="role">Administrator</div>
        </div>
      </div>
      <a href="{{ route('logout') }}" class="btn-logout"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i data-lucide="log-out"></i> Sign Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
  </nav>

  <!-- Overlay for mobile -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Main -->
  <div class="main-content">
    <!-- Top Bar -->
    <div class="topbar">
      <div class="topbar-title">@yield('title', 'Dashboard')</div>
      <div class="topbar-right">
        <a href="{{ url('/') }}" class="topbar-link" target="_blank">
          <i data-lucide="external-link"></i> View Site
        </a>
      </div>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // Mobile sidebar toggle
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggle) {
      toggle.addEventListener('click', () => sidebar.classList.toggle('show'));
    }
    if (overlay) {
      overlay.addEventListener('click', () => sidebar.classList.remove('show'));
    }
  });
</script>
@stack('scripts')
</body>
</html>
