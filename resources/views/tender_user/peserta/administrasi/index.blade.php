@extends('layouts.admin')

@section('title', 'Atur Administrasi')

@section('content')
<div class="page-header">
    <h1>Atur Administrasi — {{ $tender->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Administrasi</span>
    </div>
</div>

@include('global.alert')

{{-- Step wizard --}}
@php
    $steps = [
        ['label' => 'Data Tender', 'icon' => 'fas fa-file-alt', 'url' => route('tender_admin.edit', [$tender->id])],
        ['label' => 'Tahapan', 'icon' => 'fas fa-calendar-alt', 'url' => route('tender_admin.tahapan', [$tender->id])],
        ['label' => 'Syarat', 'icon' => 'fas fa-list-check', 'url' => route('tender_admin.syarat', [$tender->id])],
        ['label' => 'File Tender', 'icon' => 'fas fa-folder-open', 'url' => route('tender_file.show', [$tender->id])],
        ['label' => 'Persyaratan & Penawaran', 'icon' => 'fas fa-file-signature', 'url' => route('tender_persyarat.tender', [$tender->id])],
        ['label' => 'Penawaran', 'icon' => 'fas fa-hand-holding-usd', 'url' => route('penawaran.tender', [$tender->id])],
        ['label' => 'Administrasi', 'icon' => 'fas fa-clipboard-check', 'active' => true],
    ];
@endphp
<x-card title="Langkah Pengaturan Tender" class="mb-4">
    <div class="d-flex flex-wrap gap-2">
        @foreach($steps as $i => $s)
            @if(isset($s['active']))
                <span class="badge badge-primary px-3 py-2"><i class="{{ $s['icon'] }}"></i> {{ $i+1 }}. {{ $s['label'] }}</span>
            @else
                <a href="{{ $s['url'] }}" class="badge badge-default px-3 py-2 text-decoration-none"><i class="{{ $s['icon'] }}"></i> {{ $i+1 }}. {{ $s['label'] }}</a>
            @endif
        @endforeach
    </div>
</x-card>

{{-- Tambah Administrasi --}}
<x-card title="Tambah Administrasi">
    <form action="{{ route('administrasi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $tender->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Dokumen" name="nama" required placeholder="Contoh: Surat Izin Usaha"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Keterangan" name="keterangan" placeholder="Contoh: Jenis file yang bisa diupload: PDF"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('penawaran.tender', [$tender->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Simpan Administrasi" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Administrasi --}}
<x-card title="Daftar Administrasi">
    <x-table :head="['No', 'Nama', 'Keterangan', 'Aksi']">
        @forelse ($file as $no => $f)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $f->nama }}</td>
                <td>{{ $f->keterangan ?? '' }}</td>
                <td>
                    <form method="POST" action="{{ route('administrasi.destroy', $f->id) }}" class="m-0" onsubmit="return confirm('Hapus administrasi ini?')">
                        @csrf
                        @method('DELETE')
                        <x-button label="Hapus" type="submit" variant="danger" size="sm" icon="fas fa-trash"/>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Belum ada data administrasi.</td>
            </tr>
        @endforelse
    </x-table>
</x-card>

<x-alert type="info">
    Setelah semua langkah selesai, tender siap dibuka untuk pendaftaran peserta. Pastikan tahapan <strong>Masa Pendaftaran</strong> dan <strong>Upload File</strong> sudah diatur.
</x-alert>
@endsection
