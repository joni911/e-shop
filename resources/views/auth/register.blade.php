@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="auth-card" style="max-width:520px;">
    <div class="auth-logo">
        <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
        <h1>Sistem Pengadaan Tender</h1>
        <p>Buat akun baru</p>
    </div>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <x-input label="Nama / Nama PT" name="name" value="{{ old('name') }}"
                 placeholder="Nama lengkap atau nama perusahaan" required Autofocus/>

        <x-input label="Email" name="email" type="email" value="{{ old('email') }}"
                 placeholder="nama@email.com" required/>

        <x-input label="Password" name="password" type="password" placeholder="••••••••" required/>

        <x-input label="Konfirmasi Password" name="password_confirmation" type="password"
                 placeholder="••••••••" required/>

        <button type="submit" class="btn btn-primary w-100 mt-2">Register</button>
    </form>

    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </div>
</div>
@endsection
