<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#FFF8F0" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1A1A1A" media="(prefers-color-scheme: dark)">
    <title>@yield('title', 'Dashboard') — Sistem Pengadaan Tender</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('ui/img/favicon-32.png?v=1') }}">
    <link rel="apple-touch-icon" href="{{ asset('ui/img/apple-touch-icon.png?v=1') }}">
    {{-- Bootstrap 5.3 (CDN, fallback lokal) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome 6 (ikon fas fa-* tetap jalan) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    {{-- CSS template --}}
    <link href="{{ asset('ui/css/base.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/components.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/pages.css?v=1') }}" rel="stylesheet">
    @stack('css')
    @yield('css')
</head>
<body class="ui-shell @auth {{ auth()->user()->hak_akses }} @endauth">
    <div class="app-wrapper">
        {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon"><img src="{{ asset('ui/img/logo.png?v=1') }}" alt="Logo Pengadaan Tender"></div>
                <div class="sidebar-brand-text">Pengadaan Tender</div>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <a href="{{ route('peserta.create') }}" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <span class="nav-text">Peserta</span>
                    </a>
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">Beranda Tender</span>
                    </a>
                    <a href="{{ route('tender_admin.index') }}" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <span class="nav-text">Kelola Tender</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Master</div>
                    <a href="{{ route('jenis_pengadaan.index') }}" class="nav-link"><i class="fas fa-boxes nav-icon"></i><span class="nav-text">Jenis Pengadaan</span></a>
                    <a href="{{ route('jenis_kontrak.index') }}" class="nav-link"><i class="fas fa-certificate nav-icon"></i><span class="nav-text">Jenis Kontrak</span></a>
                    <a href="{{ route('metode_pengadaan.index') }}" class="nav-link"><i class="fas fa-route nav-icon"></i><span class="nav-text">Metode Pengadaan</span></a>
                    <a href="{{ route('status_tender.index') }}" class="nav-link"><i class="fas fa-info-circle nav-icon"></i><span class="nav-text">Status Tender</span></a>
                    <a href="{{ route('tahapan.index') }}" class="nav-link"><i class="fas fa-tasks nav-icon"></i><span class="nav-text">Tahapan</span></a>
                </div>
                <div class="nav-section">
                    <div class="nav-section-title">Pemeriksaan</div>
                    <a href="{{ route('dashboard.index') }}" class="nav-link"><i class="fas fa-search nav-icon"></i><span class="nav-text">Pemeriksaan</span></a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start" style="margin:0;">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <span class="nav-text">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <main class="main-content">
            {{-- Topbar --}}
            <header class="topbar">
                <div class="topbar-left">
                    <button class="btn-icon sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="topbar-title d-none d-md-block">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="topbar-right">
                    <div class="dropdown">
                        <button class="btn-icon" data-dropdown-toggle="userDropdown" aria-label="Menu pengguna">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-menu" id="userDropdown">
                            <div class="dropdown-header">{{ Auth::user()->name ?? 'Pengguna' }}</div>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-container">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- jQuery 3.7 global --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- Bootstrap 5.3 bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- JS template --}}
    <script src="{{ asset('ui/js/sidebar.js?v=1') }}"></script>
    <script src="{{ asset('ui/js/ui.js?v=1') }}"></script>
    <script src="{{ asset('ui/js/app.js?v=1') }}"></script>
    @stack('js')
    @yield('js')
</body>
</html>
