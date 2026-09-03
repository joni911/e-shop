@extends('layouts.admin')

@section('title', 'Atur Tahapan Tender')

@section('content')
@php
    $statusText = [0 => 'Biasa', 1 => 'Masa Pendaftaran', 2 => 'Masa Pembukaan File', 3 => 'Pengumuman Pemenang', 4 => 'Upload File'];
    $statusClass = [0 => 'badge-default', 1 => 'badge-primary', 2 => 'badge-info', 3 => 'badge-success', 4 => 'badge-warning'];
@endphp

<div class="page-header">
    <h1>Atur Tahapan Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Tahapan</span>
    </div>
</div>

{{-- Step wizard --}}
@include('tender_admin.part.tender-setup-steps', ['tender' => $data, 'active' => 2])

{{-- Tender Info --}}
<x-alert type="info" class="mb-4">
    <strong>{{ $data->nama }}</strong><br>
    Pastikan terdapat minimal 1 tahapan dengan status <strong>Masa Pendaftaran</strong> dan 1 tahapan dengan status <strong>Upload File</strong>.
</x-alert>

{{-- Daftar Tahapan --}}
<x-card title="Daftar Tahapan">
    <x-table :head="['No', 'Nama Tahap', 'Mulai', 'Selesai', 'Status', 'Keterangan', 'Aksi']">
        @forelse($tahapan as $no => $t)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $t->nama }}</td>
                <td>{{ $t->mulai }}</td>
                <td>{{ $t->akhir }}</td>
                <td>
                    <span class="badge {{ $statusClass[$t->status] ?? 'badge-default' }}">{{ $statusText[$t->status] ?? 'Biasa' }}</span>
                </td>
                <td>
                    {{ $t->keterangan }}
                    @if($t->keterangan)
                        <a href="{{ route('perubahan.show', [$t->id]) }}">Periksa Perubahan</a>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <x-button label="Edit" href="{{ route('tahapan.edit', [$t->id]) }}" variant="primary" size="sm" icon="fas fa-edit"/>
                        <form method="POST" action="{{ route('tahapan.destroy', [$t->id]) }}" onsubmit="return confirm('Hapus tahapan ini?')">
                            @csrf
                            @method('DELETE')
                            <x-button label="Hapus" type="submit" variant="danger" size="sm" icon="fas fa-trash"/>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="table-empty">Jadwal Kosong</td>
            </tr>
        @endforelse
    </x-table>
</x-card>

{{-- Tambah Tahapan Baru --}}
<x-card title="Tambah Tahapan Baru">
    <form action="{{ route('tahapan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Tahap" name="nama" placeholder="Contoh: Evaluasi Administrasi" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Status Tahapan" name="status" :options="[0 => 'Biasa', 1 => 'Masa Pendaftaran', 2 => 'Masa Pembukaan File', 3 => 'Pengumuman Pemenang', 4 => 'Upload File']" placeholder="Pilih Status" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Mulai" name="awal" type="date" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Selesai" name="akhir" type="date" required/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tender_admin.index') }}" variant="secondary"/>
            <x-button label="Tambah Tahapan" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>

{{-- Next step: lanjut ke Syarat --}}
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah tahapan selesai, lanjutkan mengatur <strong>Syarat Kualifikasi</strong> yang wajib dipenuhi peserta.</p>
    <x-button label="Next Step: Atur Syarat" href="{{ route('tender_admin.syarat', [$data->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection