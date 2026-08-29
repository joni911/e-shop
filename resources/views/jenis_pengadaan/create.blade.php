@extends('layouts.admin')

@section('title', 'Tambah Jenis Pengadaan')

@section('content')
<div class="page-header">
    <h1>Tambah Jenis Pengadaan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('jenis_pengadaan.index') }}">Jenis Pengadaan</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Jenis Pengadaan">
    <form action="{{ route('jenis_pengadaan.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" placeholder="Masukkan nama" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('jenis_pengadaan.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection