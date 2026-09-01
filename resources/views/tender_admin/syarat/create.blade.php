@extends('layouts.admin')

@section('title', 'Atur Syarat Tender')

@section('content')
<div class="page-header">
    <h1>Atur Syarat — {{ $syarat->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Syarat</span>
    </div>
</div>

{{-- Step wizard --}}
@php
    $steps = [
        ['label' => 'Data Tender', 'icon' => 'fas fa-file-alt', 'url' => route('tender_admin.edit', [$syarat->id])],
        ['label' => 'Tahapan', 'icon' => 'fas fa-calendar-alt', 'url' => route('tender_admin.tahapan', [$syarat->id])],
        ['label' => 'Syarat', 'icon' => 'fas fa-list-check', 'active' => true],
        ['label' => 'File Tender', 'icon' => 'fas fa-folder-open', 'url' => route('tender_file.show', [$syarat->id])],
        ['label' => 'Persyaratan & Penawaran', 'icon' => 'fas fa-file-signature', 'url' => route('tender_persyarat.tender', [$syarat->id])],
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

@if ($errors->any())
    <x-alert type="danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

{{-- Tambah Syarat --}}
<x-card title="Tambah Syarat">
    <form action="{{ route('syarat.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $syarat->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Persyaratan" name="nama" required placeholder="Contoh: Persyaratan Kualifikasi"/>
            </div>
        </div>
        <div class="row g-4 mt-0">
            <div class="col-12">
                <x-textarea label="Detail Persyaratan" name="content" rows="6" required placeholder="Tulis detail persyaratan yang wajib dipenuhi peserta..."/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_admin.tahapan', [$syarat->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Simpan Syarat" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Syarat --}}
<x-card title="Daftar Syarat">
    <x-table :head="['No', 'Nama', 'Detail', 'Aksi']">
        @forelse ($data as $no => $t)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $t->judul ?? '' }}</td>
                <td>{!! $t->content ?? '' !!}</td>
                <td>
                    <x-button label="Edit" href="{{ route('syarat.edit', [$t->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Belum ada syarat.</td>
            </tr>
        @endforelse
    </x-table>
</x-card>

{{-- Next step --}}
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah syarat selesai, lanjutkan mengatur <strong>File Tender</strong> (berkas wajib yang diupload peserta).</p>
    <x-button label="Next Step: Atur File Tender" href="{{ route('tender_file.show', [$syarat->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
