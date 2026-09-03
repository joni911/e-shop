@extends('layouts.admin')

@section('title', 'Atur File Tender')

@section('content')
<div class="page-header">
    <h1>Atur File Tender — {{ $data->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>File Tender</span>
    </div>
</div>

{{-- Step wizard --}}
@include('tender_admin.part.tender-setup-steps', ['tender' => $data, 'active' => 4])

@if ($errors->any())
    <x-alert type="danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

{{-- Tambah / Edit File --}}
<x-card :title="$page == 'edit' ? 'Edit File' : 'Tambah File Wajib'">
    @if ($page == 'lihat')
        <form action="{{ route('tender_file.store') }}" method="POST">
    @else
        <form action="{{ route('tender_file.update', [$file->id ?? '']) }}" method="POST">
            @method('PUT')
    @endif
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama File" name="nama" value="{{ $file->nama ?? '' }}" required placeholder="Contoh: Surat Penawaran"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Keterangan File" name="keterangan" value="{{ $file->keterangan ?? '' }}" placeholder="Contoh: Format PDF, maks 10 MB"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_admin.syarat', [$data->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            @if ($page == 'edit')
                <x-button label="Perbarui File" type="submit" variant="primary" icon="fas fa-save"/>
            @else
                <x-button label="Simpan File" type="submit" variant="primary" icon="fas fa-save"/>
            @endif
        </div>
    </form>
</x-card>

{{-- Daftar File --}}
<x-card title="Daftar File Tender">
    <x-table :head="['No', 'Nama', 'Keterangan', 'Aksi']">
        @forelse ($table as $no => $t)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $t->nama ?? '' }}</td>
                <td>{{ $t->keterangan ?? '' }}</td>
                <td>
                    <x-button label="Edit" href="{{ route('tender_file.edit', [$t->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Belum ada file tender.</td>
            </tr>
        @endforelse
    </x-table>
</x-card>

{{-- Next step --}}
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah file wajib selesai, lanjutkan mengatur <strong>Persyaratan & Penawaran</strong> (spesifikasi teknis + data penawaran panitia).</p>
    <x-button label="Next Step: Persyaratan & Penawaran" href="{{ route('tender_persyarat.tender', [$data->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
