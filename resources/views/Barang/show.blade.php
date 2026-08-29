@extends('layouts.admin')

@section('title', $barang->nama)

@section('content')
<div class="page-header">
    <h1>{{ $barang->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('barang.index') }}">Barang</a> / <span>{{ $barang->nama }}</span>
    </div>
</div>

<div class="row g-4">
    {{-- Galeri Foto --}}
    <div class="col-12 col-md-6">
        <x-card title="Foto Barang">
            @forelse($barang->barang_photo as $bp)
                <img src="/{{ $bp->foto }}" alt="Foto {{ $barang->nama }}" class="img-fluid rounded mb-2">
            @empty
                <p class="text-muted mb-0">Belum ada foto</p>
            @endforelse
        </x-card>
    </div>

    {{-- Info Barang --}}
    <div class="col-12 col-md-6">
        <x-card title="Detail Barang">
            <h3 class="fw-medium mb-2">{{ $barang->nama }}</h3>
            <p>{{ $barang->keterangan }}</p>

            <div class="bg-light border rounded p-3 mt-3 mb-3">
                <h2 class="mb-0" style="color: var(--bs-primary);">@currency($barang->harga)</h2>
                <small class="text-muted">Ex Tax: @currency($barang->harga)</small>
            </div>

            <div class="d-flex gap-3 flex-wrap">
                <x-button label="Add to Cart" variant="primary" icon="fas fa-cart-plus"/>
                <x-button label="Add to Wishlist" variant="secondary" icon="fas fa-heart"/>
            </div>

            <div class="mt-4 d-flex gap-3">
                <a href="#" class="text-secondary"><i class="fab fa-facebook-square fa-2x"></i></a>
                <a href="#" class="text-secondary"><i class="fab fa-twitter-square fa-2x"></i></a>
                <a href="#" class="text-secondary"><i class="fas fa-envelope-square fa-2x"></i></a>
                <a href="#" class="text-secondary"><i class="fas fa-rss-square fa-2x"></i></a>
            </div>
        </x-card>
    </div>
</div>

{{-- Deskripsi --}}
<x-card title="Deskripsi">
    {{ $barang->deskripsi }}
</x-card>

{{-- Komentar --}}
<x-card title="Komentar">
    @forelse($komentar as $k)
        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex justify-content-between">
                <span class="fw-medium">{{ $k->nama_user }}</span>
                <small class="text-muted">{{ $k->created_at }}</small>
            </div>
            <p class="mb-0 mt-1">{{ $k->komentar }}</p>
        </div>
    @empty
        <p class="text-muted mb-0">Belum ada komentar</p>
    @endforelse

    <form action="{{ route('komentar.store') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="id" value="{{ $barang->id }}">
        <x-textarea label="Komentar" name="komentar" rows="3" required/>
        <div class="mt-3">
            <x-button label="Simpan" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection