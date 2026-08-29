@extends('layouts.admin')

@section('title', 'Edit Jenis Kontrak')

@section('content')
<div class="page-header">
    <h1>Edit Jenis Kontrak</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('jenis_kontrak.index') }}">Jenis Kontrak</a> / <span>Edit</span>
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

<x-card title="Edit Jenis Kontrak">
    <form action="{{ route('jenis_kontrak.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" value="{{ $data->nama }}" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('jenis_kontrak.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection