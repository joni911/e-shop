@extends('layouts.admin')

@section('title', 'Tambah Katagori')

@section('content')
<div class="page-header">
    <h1>Tambah Katagori</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('katagori.index') }}">Katagori</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Katagori">
    <form action="{{ route('katagori.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Katagori" name="nama" placeholder="Masukkan nama katagori" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Keterangan" name="keterangan" placeholder="Masukkan keterangan"/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('katagori.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection