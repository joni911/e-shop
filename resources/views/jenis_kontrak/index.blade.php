@extends('layouts.admin')

@section('title', 'Jenis Kontrak')

@section('content')
<div class="page-header">
    <h1>Jenis Kontrak</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('jenis_kontrak.index') }}">Master</a> / <span>Jenis Kontrak</span>
    </div>
</div>

<x-card title="Daftar Jenis Kontrak">
    <x-slot:actions>
        <x-button label="Tambah" href="{{ route('jenis_kontrak.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama', 'Aksi']">
        @forelse($data as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $b->nama }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <x-button label="Edit" href="{{ route('jenis_kontrak.edit', [$b->id]) }}" variant="primary" size="sm" icon="fas fa-pen"/>
                        <form method="POST" action="{{ route('jenis_kontrak.destroy', $b->id) }}" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <x-button label="Hapus" type="submit" variant="danger" size="sm" icon="fas fa-trash"/>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $data->links() }}</div>
    @endif
</x-card>
@endsection