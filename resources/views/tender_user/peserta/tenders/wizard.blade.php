@extends('layouts.peserta')

@section('title', 'Wizard Tender')

@section('content')
<div class="page-header">
    <h1>Wizard Pengisian Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('peserta.tenders') }}">Tender Saya</a> / <span>Wizard</span>
    </div>
</div>

@include('global.alert')

{{-- Banner konteks: peserta + tender terpilih --}}
<x-alert type="info" title="Mulai Pengisian" class="mb-4">
    <p class="mb-0">Pengisian <strong>{{ $tender->nama }}</strong> untuk peserta <strong>{{ $profil->nama_pt }}</strong>. Klik salah satu langkah di bawah untuk mengisi kelengkapannya.</p>
</x-alert>

{{-- Wizard stepper (pilih langkah) --}}
<x-card title="Langkah Kelengkapan">
    <div class="list-group">
        <a href="{{ route('peserta.edit', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-building me-2"></i>Data Perusahaan (Edit Profil)</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('pengalaman.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-briefcase me-2"></i>Pengalaman</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('tenagaahli.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-users me-2"></i>Tenaga Ahli</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('peralatan.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-tools me-2"></i>Peralatan</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('pekerjaan_berjalan.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-tasks me-2"></i>Pekerjaan Berjalan</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('managemen.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-user-tie me-2"></i>Managemen</span>
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('administrasi_list.show', [$profil->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span><i class="fas fa-folder-open me-2"></i>Administrasi (Upload Berkas)</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <div class="mt-3 d-flex gap-2 align-items-center">
        <a class="btn btn-secondary" href="{{ route('peserta.tenders') }}">Kembali ke Tender Saya</a>
        <span class="text-muted small">Tender aktif di sesi ini:</span>
        <span class="badge text-bg-primary">{{ $tender->nama }}</span>
    </div>
</x-card>
@endsection
