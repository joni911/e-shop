@extends('layouts.peserta')

@section('title', 'Pendaftaran Rencana Keselamatan Konstruksi (RKK)')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Rencana Keselamatan Konstruksi (RKK)</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>RKK</span>
    </div>
</div>

@include('global.alert')

@if (!$list)
<x-card title="Upload RKK">
    <form action="{{ route('file_teknis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tender_id" value="{{ $data->id }}">
        <input type="hidden" name="peserta" value="{{ $peserta->id }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-file label="Elemen SMKK" name="smkk" required accept=".pdf" hint="Jenis file yang bisa diupload: PDF"/>
            </div>
            <div class="col-12 col-md-6">
                <x-file label="Pakta Komitmen Keselamatan Konstruksi" name="komitmen" accept=".pdf" hint="Jenis file yang bisa diupload: PDF"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('tenagaahli.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>
@else
    <x-card title="File RKK">
        <x-table :head="['No', 'File', 'Aksi']">
            <tr>
                <td>1</td>
                <td class="fw-medium">Elemen SMKK</td>
                <td>
                    @if($list->smkk)
                        @php
                            $pv = (object) ['id' => $list->id, 'files' => $list->smkk];
                            $pv_prefix = 'rkk-smkk';
                            $label = 'Elemen SMKK';
                        @endphp
                        <div class="d-flex gap-2">
                            @include('tender_user.peserta.files.part.preview')
                            <x-button label="Download" href="/{{ $list->smkk }}" :download="'SMKK ' . $peserta->nama_pt" variant="primary" size="sm" icon="fas fa-download"/>
                        </div>
                    @else
                        <span class="text-muted">Belum diupload</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td class="fw-medium">Pakta Komitmen Keselamatan Konstruksi</td>
                <td>
                    @if($list->komitmen)
                        @php
                            $pv = (object) ['id' => $list->id, 'files' => $list->komitmen];
                            $pv_prefix = 'rkk-komitmen';
                            $label = 'Pakta Komitmen SMKK';
                        @endphp
                        <div class="d-flex gap-2">
                            @include('tender_user.peserta.files.part.preview')
                            <x-button label="Download" href="/{{ $list->komitmen }}" :download="'Komitmen ' . $peserta->nama_pt" variant="primary" size="sm" icon="fas fa-download"/>
                        </div>
                    @else
                        <span class="text-muted">Belum diupload</span>
                    @endif
                </td>
            </tr>
        </x-table>
    </x-card>

    <x-card title="Upload Ulang RKK">
        <p class="text-muted">Untuk upload ulang, hapus file yang sudah ada terlebih dahulu.</p>
        <form method="POST" action="{{ route('file_teknis.destroy', $list->id) }}" onsubmit="return confirm('Hapus file RKK ini?')">
            @csrf
            @method('DELETE')
            <x-button label="Hapus File RKK" type="submit" variant="danger" icon="fas fa-trash"/>
        </form>
    </x-card>
@endif

<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah RKK selesai, lanjutkan mengisi <strong>Peralatan Utama</strong>.</p>
    <x-button label="Berikutnya: Peralatan" href="{{ route('peralatan.show', [$peserta->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
