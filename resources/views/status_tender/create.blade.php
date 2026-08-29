@extends('layouts.admin')

@section('title', 'Tambah Status Tender')

@section('content')
<div class="page-header">
    <h1>Tambah Status Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('status_tender.index') }}">Status Tender</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Status Tender">
    <form action="{{ route('status_tender.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" placeholder="Masukkan nama" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('status_tender.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection