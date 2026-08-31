@extends('layouts.admin')

@section('title', 'Edit Syarat')

@section('content')
<div class="page-header">
    <h1>Edit Syarat — {{ $syarat->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <a href="{{ route('tender_admin.syarat', [$syarat->id]) }}">Syarat</a> / <span>Edit</span>
    </div>
</div>

@if ($errors->any())
    <x-alert type="danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<x-card title="Edit Syarat">
    <form action="{{ route('syarat.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Persyaratan" name="nama" value="{{ $data->judul ?? '' }}" required/>
            </div>
        </div>
        <div class="row g-4 mt-0">
            <div class="col-12">
                <x-textarea label="Detail Persyaratan" name="content" rows="6" required>{{ $data->content ?? '' }}</x-textarea>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_admin.syarat', [$syarat->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Simpan" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>
@endsection
