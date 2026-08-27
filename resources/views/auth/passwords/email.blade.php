@extends('auth.layout')

@section('title', 'Lupa Password')

@section('auth_subtitle', 'Reset password Anda')

@section('auth_body')
    <p class="text-muted mb-4" style="font-size:0.9rem;">
        Masukkan email Anda, kami akan mengirimkan link untuk mereset password.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" required autofocus>
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
@endsection