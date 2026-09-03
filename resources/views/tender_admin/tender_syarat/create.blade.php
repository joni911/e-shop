@extends('layouts.admin')

@section('title', 'Persyaratan & Penawaran')

@section('content')
<div class="page-header">
    <h1>Persyaratan & Penawaran — {{ $tender->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Persyaratan</span>
    </div>
</div>

{{-- Step wizard --}}
@include('tender_admin.part.tender-setup-steps', ['tender' => $tender, 'active' => 5])

@if ($errors->any())
    <x-alert type="danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

{{-- Form Persyaratan --}}
<x-card :title="$persyaratan ? 'Edit Persyaratan' : 'Tambah Persyaratan'">
    <form action="{{ $persyaratan ? route('tender_persyarat.update', [$persyaratan->id]) : route('tender_persyarat.store') }}" method="POST">
        @csrf
        @if($persyaratan) @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $tender->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Persyaratan" name="nama" value="{{ $persyaratan->judul ?? '' }}" required placeholder="Contoh: Spesifikasi Teknis"/>
            </div>
        </div>
        <div class="row g-4 mt-0">
            <div class="col-12">
                <x-textarea label="Penjelasan Persyaratan" name="content" rows="6" required placeholder="Tulis penjelasan/spesifikasi...">{{ $persyaratan->penjelasan ?? '' }}</x-textarea>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_file.show', [$tender->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button :label="$persyaratan ? 'Perbarui Persyaratan' : 'Simpan Persyaratan'" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Upload File Persyaratan --}}
@if ($persyaratan)
<x-card title="Upload File Persyaratan">
    <form action="{{ route('tender_persyaratan_file.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $persyaratan->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama File" name="nama" required placeholder="Contoh: Spesifikasi Teknis.pdf"/>
            </div>
            <div class="col-12 col-md-6">
                <x-file label="File" name="file" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.zip" hint="Dokumen pendukung persyaratan"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Upload File" type="submit" variant="primary" icon="fas fa-upload"/>
        </div>
    </form>
</x-card>

{{-- Daftar File Persyaratan --}}
<x-card title="Daftar File Persyaratan">
    <x-table :head="['No', 'Nama', 'Aksi']">
        @forelse ($persyaratan->tender_persyaratan_file as $no => $t)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $t->nama ?? '' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        @php
                            $pv = $t; // path ->file
                            $pv_prefix = 'persyaratan-file';
                            $label = $t->nama ?? 'File ' . $t->id;
                        @endphp
                        @include('tender_user.peserta.files.part.preview')
                        <x-button label="Download" href="/{{ $t->file }}" :download="$t->nama" variant="primary" size="sm" icon="fas fa-download"/>
                        @if ($admin->hak_akses == 'admin')
                            <form method="POST" action="{{ route('tender_persyaratan_file.destroy', $t->id) }}" class="m-0" onsubmit="return confirm('Hapus file ini?')">
                                @csrf
                                @method('DELETE')
                                <x-button label="Hapus" type="submit" variant="danger" size="sm" icon="fas fa-trash"/>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="table-empty">Belum ada file persyaratan.</td>
            </tr>
        @endforelse
    </x-table>
</x-card>
@endif

{{-- Next step --}}
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah persyaratan & file selesai, lanjutkan ke <strong>Persiapan Penawaran</strong> (HPS, anggaran, dan file wajib penawaran).</p>
    <x-button label="Next Step: Persiapan Penawaran" href="{{ route('penawaran.tender', [$tender->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
