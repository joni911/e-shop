@extends('layouts.guest')

@section('title', 'Verifikasi Email')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <img src="{{ asset('ui/img/logo.png?v=1') }}" class="auth-logo-img" alt="Logo Pengadaan Tender">
        <h1>Sistem Pengadaan Tender</h1>
        <p>Verifikasi Email</p>
    </div>

    @if(session('resent'))
        <x-alert type="success">Link verifikasi baru telah dikirim ke email Anda.</x-alert>
    @endif

    <p>Sebelum melanjutkan, periksa email Anda untuk link verifikasi.</p>
    <p>Jika Anda tidak menerima email,</p>

    <form method="POST" action="{{ route('verification.resend') }}" class="mt-3">
        @csrf
        <x-button label="Kirim ulang verifikasi" type="submit" variant="primary"/>
    </form>

    <div class="auth-footer mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0">Keluar</button>
        </form>
    </div>
</div>
@endsection
