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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('ui/css/base.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/components.css?v=2') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/pages.css?v=1') }}" rel="stylesheet">
    @stack('css')
    @yield('css')
</head>
<body class="ui-shell @auth {{ auth()->user()->hak_akses }} @endauth">
    <div class="app-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon"><img src="{{ asset('ui/img/logo.png?v=1') }}" alt="Logo Pengadaan Tender"></div>
                <div class="sidebar-brand-text">Pengadaan Tender</div>
            </div>

            {{-- SWITCH SIDEBAR BERDASARKAN ROLE --}}
            @auth
                @if(auth()->user()->hak_akses == 'admin')
                    @include('layouts.partials.sidebar-admin')
                @else
                    @include('layouts.partials.sidebar-peserta')
                @endif
            @endauth

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('ui/js/sidebar.js?v=1') }}"></script>
    <script src="{{ asset('ui/js/ui.js?v=2') }}"></script>
    <script src="{{ asset('ui/js/app.js?v=2') }}"></script>
    @stack('js')
    @yield('js')
</body>
</html>