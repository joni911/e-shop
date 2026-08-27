@extends('auth.layout')

@section('title', 'Login')

@section('auth_subtitle', 'Masuk ke akun Anda')

@section('auth_body')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" required autofocus>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <label class="d-flex align-items-center gap-2" style="font-size:0.875rem;color:var(--fg-muted);cursor:pointer;">
                <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--primary);">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
@endsection
