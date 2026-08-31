@extends('layouts.app')

@section('title', 'Pendaftaran Kelengkapan Berkas Peserta')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Kelengkapan Berkas Peserta</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Registrasi Peserta</span>
    </div>
</div>

<div class="card">
    <div class="card-body text-center py-5">
        <h2 class="mb-3">Anda Belum Melengkapi Berkas yang Dibutuhkan!</h2>
        <p class="text-muted">Daftarkan perusahaan Anda di link berikut ini:</p>
        <x-button label="Daftarkan Perusahaan Anda" href="{{ route('peserta.create') }}" variant="success" icon="fas fa-building"/>
    </div>
</div>
@endsection
