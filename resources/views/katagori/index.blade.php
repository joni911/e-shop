@extends('layouts.admin')

@section('title', 'Katagori')

@section('content')
<div class="page-header">
    <h1>Katagori</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('katagori.index') }}">Master</a> / <span>Katagori</span>
    </div>
</div>

<x-card title="Daftar Katagori">
    <x-slot:actions>
        <x-button label="Tambah" href="{{ route('katagori.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama', 'Keterangan']">
        @forelse($katagori as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $b->nama }}</td>
                <td>{{ $b->keterangan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>
</x-card>
@endsection