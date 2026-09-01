@extends('layouts.admin')

@section('title', 'Persiapan Penawaran')

@section('content')
<div class="page-header">
    <h1>Persiapan Penawaran — {{ $tender->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Penawaran</span>
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
        ['label' => 'Penawaran', 'icon' => 'fas fa-hand-holding-usd', 'active' => true],
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

{{-- Form Penawaran --}}
<x-card :title="$penawaran ? 'Edit Penawaran' : 'Tambah Penawaran'">
    <form action="{{ $penawaran ? route('penawaran.update', [$penawaran->id]) : route('penawaran.store') }}" method="POST">
        @csrf
        @if($penawaran) @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $tender->id }}">

        <div class="row g-4">
            <div class="col-12">
                <x-input label="Judul Penawaran" name="judul" value="{{ $penawaran->judul ?? '' }}" required placeholder="Contoh: Pengadaan Meubelair Kantor"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Anggaran" name="anggaran" type="number" value="{{ $penawaran->anggaran ?? '' }}" required placeholder="Masukkan nilai anggaran"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="HPS" name="hps" type="number" value="{{ $penawaran->hps ?? '' }}" required placeholder="Masukkan nilai HPS"/>
            </div>
            <div class="col-12">
                <x-textarea label="Penjelasan" name="penjelasan" rows="5" placeholder="Tulis penjelasan paket penawaran...">{{ $penawaran->penjelasan ?? '' }}</x-textarea>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_persyarat.tender', [$tender->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button :label="$penawaran ? 'Perbarui Penawaran' : 'Simpan Penawaran'" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Tambah File Penawaran --}}
<x-card title="Tambah File Penawaran">
    <form action="{{ route('penawaran_file.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $tender->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama File" name="nama" required placeholder="Contoh: Formulir Penawaran Harga"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Keterangan" name="keterngan" placeholder="Contoh: Format PDF, maks 10 MB"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Tambah File" type="submit" variant="primary" icon="fas fa-plus"/>
        </div>
    </form>
</x-card>

{{-- Daftar File Penawaran --}}
@if ($penawaran)
<x-card title="Daftar File Penawaran">
    <x-table :head="['No', 'Nama', 'Keterangan']">
        @forelse ($penawaran->penawaran_file as $no => $f)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $f->nama }}</td>
                <td>{{ $f->keterangan ?? '' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="table-empty">Belum ada file penawaran.</td>
            </tr>
        @endforelse
    </x-table>
</x-card>
@endif

{{-- Next step --}}
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah penawaran & file wajib siap, lanjutkan ke pengaturan <strong>Administrasi</strong> (daftar dokumen administrasi yang diperiksa).</p>
    <x-button label="Next Step: Administrasi" href="{{ route('administrasi.tender', [$tender->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
