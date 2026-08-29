@extends('layouts.admin')

@section('title', 'Tambah Barang')

@section('content')
<div class="page-header">
    <h1>Tambah Barang</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('barang.index') }}">Barang</a> / <span>Tambah</span>
    </div>
</div>

<x-card title="Tambah Barang">
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Barang" name="nama" placeholder="Masukkan nama barang" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Katagori" name="katagori" :options="$katagori" placeholder="Pilih Katagori" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Harga" name="harga" type="number" value="0" placeholder="Masukkan harga"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Jumlah" name="jumlah" type="number" value="0" placeholder="Masukkan jumlah"/>
            </div>
            <div class="col-12 col-md-6">
                <x-textarea label="Keterangan" name="keterangan" rows="4" placeholder="Keterangan barang"/>
            </div>
            <div class="col-12 col-md-6">
                <x-textarea label="Deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi barang"/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('barang.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection