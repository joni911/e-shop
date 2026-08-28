@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
        <h1>Sistem Pengadaan Tender</h1>
        <p>Reset Password</p>
    </div>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <x-input label="Email" name="email" type="email" value="{{ old('email') }}"
                 placeholder="nama@email.com" required Autofocus/>

        <x-input label="Password Baru" name="password" type="password" placeholder="••••••••" required/>
        <x-input label="Konfirmasi Password" name="password_confirmation" type="password"
                 placeholder="••••••••" required/>

        <button type="submit" class="btn btn-primary w-100 mt-2">
            <i class="fas fa-sync-alt"></i> Reset Password
        </button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</div>
@endsection
