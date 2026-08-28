@extends('layouts.admin')

@section('title', 'Tambah Tender')

@section('content')
<div class="page-header">
    <h1>Tambah Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Tender">
    <form action="{{ route('tender_admin.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        @include('tender_admin.part.form')
        <div class="d-flex gap-2 mt-4">
            <x-button label="Simpan" type="submit" variant="primary" icon="fas fa-save"/>
            <x-button label="Batal" href="{{ route('tender_admin.index') }}" variant="secondary"/>
        </div>
    </form>
</x-card>
@endsection
