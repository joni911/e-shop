@extends('layouts.peserta')

@section('title', 'Pendaftaran Peserta Tender')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Peserta Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Pendaftaran Peserta</span>
    </div>
</div>

@include('global.alert')

@include('tender_user.peserta.part.validation-alert')

<x-card :title="'Pendaftaran Tender ' . ($data->nama ?? '')">
    <form action="{{ route('peserta.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @include('tender_user.peserta.part.form')

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Batal" href="{{ route('tender_home.index') }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Simpan & Daftar" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>
@endsection
