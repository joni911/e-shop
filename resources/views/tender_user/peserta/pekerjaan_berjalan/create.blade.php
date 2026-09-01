@extends('layouts.peserta')

@section('title', 'Pendaftaran Pekerjaan Berjalan Tender')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Pekerjaan Berjalan — {{ $data->tender->nama ?? $peserta->tender->nama ?? '' }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Pekerjaan Berjalan</span>
    </div>
</div>

@include('global.alert')

@include('tender_user.peserta.part.validation-alert')

<x-card title="{{ $status == 'show' ? 'Tambah Pekerjaan Berjalan' : 'Edit Pekerjaan Berjalan' }}">
    <form action="{{ $status == 'show' ? route('pekerjaan_berjalan.store') : route('pekerjaan_berjalan.update', [$data]) }}" method="POST">
        @csrf
        @if($status != 'show') @method('PUT') @endif

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Pekerjaan" name="pekerjaan" value="{{ $data->pekerjaan ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nilai Kontrak" name="nilai_kontrak" type="number" value="{{ $data->nilai_kontrak ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Lokasi" name="lokasi" value="{{ $data->lokasi ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Instansi Pemberi Tugas" name="instansi" value="{{ $data->instansi ?? '' }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3" required>{{ $data->alamat ?? '' }}</x-textarea>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. Telepon" name="no_hp" type="number" value="{{ $data->no_hp ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. Kontrak" name="no_kontrak" value="{{ $data->no_kontrak ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Kontrak" name="tgl_kontrak" type="date" value="{{ $data->tgl_kontrak ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Persentase Pelaksanaan" name="presentasi" type="number" value="{{ $data->presentasi ?? '' }}" required hint="Dalam persen (%)"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Selesai Kontrak" name="tgl_selesai_kontrak" type="date" value="{{ $data->tgl_selesai_kontrak ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Serah Terima" name="tgl_serah_terima" type="date" value="{{ $data->tgl_serah_terima ?? '' }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Keterangan" name="keterangan" rows="3" required>{{ $data->keterangan ?? '' }}</x-textarea>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('peralatan.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Pekerjaan Berjalan --}}
<x-card title="Daftar Pekerjaan Berjalan">
    <x-table :head="['No', 'Pekerjaan', 'Nilai Kontrak', 'Lokasi', 'Instansi', 'Persentase', 'Aksi']">
        @forelse ($list as $no => $l)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $l->pekerjaan }}</td>
                <td>@currency($l->nilai_kontrak)</td>
                <td>{{ $l->lokasi }}</td>
                <td>{{ $l->instansi }}</td>
                <td>{{ $l->presentasi }}%</td>
                <td>
                    <x-button label="Edit" href="{{ route('pekerjaan_berjalan.edit', [$l->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="table-empty">Belum ada data pekerjaan berjalan.</td>
            </tr>
        @endforelse
    </x-table>
    @if(method_exists($list, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $list->links() }}</div>
    @endif
</x-card>

<x-card title="Selesai">
    <p class="text-muted mb-3">Semua data kelengkapan sudah diisi. Kembali ke menu tender untuk melihat daftar tender.</p>
    <x-button label="Selesai — Ke Menu Tender" href="{{ route('tender_home.index') }}" variant="success" icon="fas fa-check-circle"/>
</x-card>
@endsection
