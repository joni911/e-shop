@extends('layouts.guest')

@section('title', 'Reset Password')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
        <h1>Sistem Pengadaan Tender</h1>
        <p>Reset Password</p>
    </div>

    @if(session('status'))
        <x-alert type="success">{{ session('status') }}</x-alert>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <x-input label="Email" name="email" type="email" value="{{ old('email') }}"
                 placeholder="nama@email.com" required Autofocus/>

        <button type="submit" class="btn btn-primary w-100 mt-2">
            <i class="fas fa-share-square"></i> Kirim Link Reset Password
        </button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</div>
@endsection
