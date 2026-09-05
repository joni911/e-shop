@extends('layouts.peserta')

@section('title', 'Pendaftaran Administrasi')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Administrasi</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Administrasi</span>
    </div>
</div>

@include('global.alert')
@include('tender_user.peserta.part.validation-alert')
@include('tender_user.peserta.part.peserta-steps', ['steps' => $steps, 'activeKey' => 'administrasi'])
@include('tender_user.peserta.part.tender-head')

@if ($list->isEmpty())
    <x-card title="Upload Dokumen Administrasi">
        <p class="text-muted mb-4">Upload dokumen administrasi wajib berikut (format PDF).</p>
        <form action="{{ route('administrasi_list.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('tender_user.peserta.administrasi.detail.admin')

            <div class="d-flex gap-3 justify-content-end mt-4">
                <x-button label="Kembali" href="{{ route('file_teknis.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
                <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
            </div>
        </form>
    </x-card>
@else
    <x-alert type="success" title="Dokumen Administrasi Sudah Diupload">
        Semua berkas administrasi sudah diupload.
    </x-alert>
    <div class="d-flex gap-3">
        <x-button label="Berikutnya: Pengalaman" href="{{ route('pengalaman.show', [$peserta->id]) }}" variant="success" icon="fas fa-arrow-right"/>
    </div>
@endif

{{-- Daftar file yang sudah diupload --}}
@include('tender_user.peserta.administrasi.detail.list')

@if (!$list->isEmpty())
    <x-card title="Upload Ulang">
        <p class="text-muted">Untuk mengupload ulang dokumen administrasi, hapus file yang sudah ada terlebih dahulu.</p>
        <form action="{{ route('administrasi_list.destroy', [$peserta->id]) }}" method="POST" onsubmit="return confirm('Hapus semua dokumen administrasi yang sudah diupload?')">
            @csrf
            @method('DELETE')
            <x-button label="Hapus Semua Dokumen" type="submit" variant="danger" icon="fas fa-trash"/>
        </form>
    </x-card>
@endif
@endsection
