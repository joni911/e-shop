{{-- Layout halaman Auth (M2 PRD_UI_MIGRATION) — tema orange Bootstrap 5.3 --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#FFF8F0" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1A1A1A" media="(prefers-color-scheme: dark)">
    <title>@yield('title') — Sistem Pengadaan Tender</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('ui/img/favicon-32.png?v=1') }}">
    <link rel="apple-touch-icon" href="{{ asset('ui/img/apple-touch-icon.png?v=1') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('ui/css/base.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/components.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('ui/css/pages.css?v=1') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="auth-page">
        <div class="auth-card" @hasSection('auth_card_width') style="@yield('auth_card_width')" @endif>
            <div class="auth-logo">
                <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
                <h1>Sistem Pengadaan Tender</h1>
                <p>@yield('auth_subtitle')</p>
            </div>

            {{-- Flash session status (verify/password) --}}
            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div class="alert-content">{{ session('status') }}</div>
                </div>
            @endif

            {{-- Error bag --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('auth_body')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('ui/js/ui.js?v=1') }}"></script>
    <script src="{{ asset('ui/js/app.js?v=1') }}"></script>
    @yield('js')
</body>
</html>
