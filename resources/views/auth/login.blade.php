@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
        <h1>Sistem Pengadaan Tender</h1>
        <p>Masuk ke akun Anda</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <x-input label="Email" name="email" type="email" value="{{ old('email') }}"
                 placeholder="nama@email.com" required Autofocus/>

        <x-input label="Password" name="password" type="password" placeholder="••••••••" required/>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <label class="d-flex align-items-center gap-2" style="font-size:0.875rem;color:var(--fg-muted);cursor:pointer;">
                <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--primary);" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
</div>
@endsection
