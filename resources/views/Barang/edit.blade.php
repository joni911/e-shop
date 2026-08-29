@extends('layouts.admin')

@section('title', 'Edit Barang')

@section('content')
<div class="page-header">
    <h1>Edit Barang</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('barang.index') }}">Barang</a> / <span>Edit</span>
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

<x-card title="Edit Barang">
    <form action="{{ route('barang.update', [$barang->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Barang" name="nama" value="{{ $barang->nama }}" placeholder="Masukkan nama barang" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Katagori" name="katagori" :options="$katagori" :value="$barang->katagori_barang_id" placeholder="Pilih Katagori" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Harga" name="harga" type="number" value="{{ $barang->harga ?? 0 }}" placeholder="Masukkan harga"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Jumlah" name="jumlah" type="number" value="{{ $barang->inventory_barang->jumlah ?? 0 }}" placeholder="Masukkan jumlah"/>
            </div>
            <div class="col-12 col-md-6">
                <x-textarea label="Keterangan" name="keterangan" rows="4">{{ $barang->keterangan }}</x-textarea>
            </div>
            <div class="col-12 col-md-6">
                <x-textarea label="Deskripsi" name="deskripsi" rows="4">{{ $barang->deskripsi }}</x-textarea>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('barang.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection