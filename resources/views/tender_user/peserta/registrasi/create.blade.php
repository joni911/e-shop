@extends('layouts.app')

@section('title', 'Pendaftaran Kelengkapan Berkas Peserta')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Kelengkapan Berkas Peserta</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Registrasi Peserta</span>
    </div>
</div>

<div class="steps">
    <div class="step active">
        <div class="step-number">1</div>
        <span>Data Perusahaan</span>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">2</div>
        <span>Pengalaman</span>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">3</div>
        <span>Tenaga Ahli</span>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">4</div>
        <span>Peralatan</span>
    </div>
</div>

<form action="{{ route('peserta.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    @include('tender_user.peserta.part.validation-alert')
    @include('tender_user.peserta.registrasi.form')
    <div class="d-flex gap-3 justify-content-end mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
        <x-button label="Simpan & Lanjutkan" type="submit" variant="primary" icon="fas fa-save"/>
    </div>
</form>
@endsection
