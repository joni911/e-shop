<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#FFF8F0" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1A1A1A" media="(prefers-color-scheme: dark)">
    <title>@yield('title', 'Sistem Pengadaan Tender') — Sistem Pengadaan Tender</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('ui/img/favicon-32.png?v=1') }}">
    <link rel="apple-touch-icon" href="{{ asset('ui/img/apple-touch-icon.png?v=1') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('ui/css/base.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/components.css?v=2') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/pages.css?v=1') }}" rel="stylesheet">
    {{-- Tema publik (orange) untuk halaman non-sidebar --}}
    <link href="{{ asset('ui/css/theme-public.css?v=1') }}" rel="stylesheet">
    @stack('css')
    @yield('css')
</head>
<body class="ui-shell">
    <div class="auth-page">
        @yield('content')
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
