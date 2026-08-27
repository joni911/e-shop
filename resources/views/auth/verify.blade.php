@extends('auth.layout')

@section('title', 'Verifikasi Email')

@section('auth_subtitle', 'Verifikasi alamat email Anda')

@section('auth_body')
    <div class="text-center mb-4">
        <i class="fas fa-envelope" style="font-size:3rem;color:var(--primary);"></i>
        <p class="mt-3 text-muted">
            Link verifikasi telah dikirim ke <strong>{{ Auth::user()->email ?? 'email Anda' }}</strong>.
            Klik link tersebut untuk mengaktifkan akun.
        </p>
    </div>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary w-100">Kirim Ulang Email Verifikasi</button>
    </form>

    <div class="auth-footer">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
@endsection