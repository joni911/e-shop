@extends('layouts.admin')

@section('title', 'Status Tender')

@section('content')
<div class="page-header">
    <h1>Status Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('status_tender.index') }}">Master</a> / <span>Status Tender</span>
    </div>
</div>

<x-card title="Daftar Status Tender">
    <x-slot:actions>
        <x-button label="Tambah" href="{{ route('status_tender.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama', 'Aksi']">
        @forelse($data as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $b->nama }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <x-button label="Edit" href="{{ route('status_tender.edit', [$b->id]) }}" variant="primary" size="sm" icon="fas fa-pen"/>
                        <form method="POST" action="{{ route('status_tender.destroy', $b->id) }}" onsubmit="return confirm('Hapus data ini?')">
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