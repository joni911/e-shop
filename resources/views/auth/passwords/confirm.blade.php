@extends('layouts.guest')

@section('title', 'Konfirmasi Password')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="Konfirmasi Password">
                <p>Silakan konfirmasi password Anda untuk melanjutkan.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <x-input label="Password" name="password" type="password" required Autofocus
                             placeholder="Masukkan password Anda"/>

                    <x-button label="Konfirmasi" type="submit" variant="primary" icon="fas fa-arrow-right" class="mt-2"/>
                </form>

                <div class="mt-3">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </div>
            </x-card>
        </div>
    </div>
</div>
@endsection
