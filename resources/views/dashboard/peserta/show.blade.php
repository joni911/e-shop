@extends('layouts.admin')

@section('title', 'Daftar Peserta')

@section('content')
<div class="page-header">
    <h1>Daftar Peserta Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('dashboard.index') }}">Pemeriksaan</a> / <span>{{ $data->nama }}</span>
    </div>
</div>

<x-card title="Daftar Peserta Tender {{ $data->nama }}">
    <x-slot:actions>
        <x-button label="Kembali" href="{{ route('dashboard.index') }}" variant="secondary" icon="fas fa-arrow-left"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama PT', 'Cek Kelengkapan', 'Aksi']">
        @forelse($peserta as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $b->nama_pt }} Menawarkan @currency($b->penawaran_peserta ?? 1)</td>
                <td>
                    Email Perusahaan : {{ $b->email }}<br>
                    NPWP : {{ $b->NPWP }}<br>
                    Alamat : {{ $b->alamat }}<br>
                    No HP : {{ $b->no_hp }}
                    <p class="mb-0">{{ $b->managemen }}</p>
                    <p class="mb-0">User ID {{ $b->user_id }} Tender ID {{ $b->tender_id }}</p>
                </td>
                <td>
                    <div class="actions">
                        <x-button label="Lihat File" href="{{ route('peserta.file', ['id' => $data->id, 'pid' => $b->id]) }}" variant="warning" icon="fas fa-eye"/>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($peserta, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $peserta->links() }}</div>
    @endif
</x-card>
@endsection