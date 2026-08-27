@extends('auth.layout')

@section('title', 'Konfirmasi Password')

@section('auth_subtitle', 'Konfirmasi password Anda untuk melanjutkan')

@section('auth_body')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required autofocus>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Konfirmasi Password</button>
    </form>
@endsection