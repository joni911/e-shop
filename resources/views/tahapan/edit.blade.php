@extends('layouts.admin')

@section('title', 'Edit Tahapan')

@section('content')
<div class="page-header">
    <h1>Edit Tahapan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tahapan.index') }}">Tahapan</a> / <span>Edit</span>
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

<x-card title="Edit Tahapan">
    <form action="{{ route('tahapan.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Tahapan" name="nama" value="{{ $data->nama }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Mulai" name="awal" type="date" value="{{ $data->mulai }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Berakhir" name="akhir" type="date" value="{{ $data->akhir }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Jenis" name="status" :value="$data->status" :options="[0 => 'Biasa', 1 => 'Masa Pendaftaran', 2 => 'Masa Pembukaan File', 3 => 'Pengumuman Pemenang', 4 => 'Upload File']" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tahapan.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection