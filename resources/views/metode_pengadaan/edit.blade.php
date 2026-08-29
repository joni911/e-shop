@extends('layouts.admin')

@section('title', 'Edit Metode Pengadaan')

@section('content')
<div class="page-header">
    <h1>Edit Metode Pengadaan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('metode_pengadaan.index') }}">Metode Pengadaan</a> / <span>Edit</span>
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

<x-card title="Edit Metode Pengadaan">
    <form action="{{ route('metode_pengadaan.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" value="{{ $data->nama }}" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('metode_pengadaan.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection