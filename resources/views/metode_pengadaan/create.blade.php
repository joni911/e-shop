@extends('layouts.admin')

@section('title', 'Tambah Metode Pengadaan')

@section('content')
<div class="page-header">
    <h1>Tambah Metode Pengadaan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('metode_pengadaan.index') }}">Metode Pengadaan</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Metode Pengadaan">
    <form action="{{ route('metode_pengadaan.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" placeholder="Masukkan nama" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('metode_pengadaan.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection