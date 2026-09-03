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
@include('tender_admin.part.tender-setup-steps', ['tender' => $tender, 'active' => 7])

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
