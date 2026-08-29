@extends('layouts.admin')

@section('title', 'Tambah Tahapan')

@section('content')
<div class="page-header">
    <h1>Tambah Tahapan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tahapan.index') }}">Tahapan</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Tahapan">
    <form action="{{ route('tahapan.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Tahapan" name="nama" placeholder="Masukkan Nama Tahapan" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Mulai" name="awal" type="date" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Berakhir" name="akhir" type="date" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Jenis" name="status" :options="[0 => 'Biasa', 1 => 'Masa Pendaftaran', 2 => 'Masa Pembukaan File', 3 => 'Pengumuman Pemenang', 4 => 'Upload File']" placeholder="Pilih Status" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tahapan.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection