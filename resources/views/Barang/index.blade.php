@extends('layouts.admin')

@section('title', 'Barang')

@section('content')
<div class="page-header">
    <h1>Barang</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('barang.index') }}">e-shop</a> / <span>Barang</span>
    </div>
</div>

<x-card title="Tabel Barang">
    <x-slot:actions>
        <x-button label="Tambah" href="{{ route('barang.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama', 'Jumlah', 'Aksi']">
        @forelse($barang as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium"><a href="{{ route('barang.show', [$b->id]) }}">{{ $b->nama }}</a></td>
                <td>{{ $b->inventory_barang->jumlah ?? 0 }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <x-button label="Edit" href="{{ route('barang.edit', [$b->id]) }}" variant="primary" size="sm" icon="fas fa-pen"/>
                        <x-button label="Foto" href="{{ route('photo.edit', [$b->id]) }}" variant="warning" size="sm" icon="fas fa-image"/>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>
</x-card>
@endsection