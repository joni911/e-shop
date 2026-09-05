@extends('layouts.peserta')

@section('title', 'Tender Saya')

@section('content')
<div class="page-header">
    <h1>Tender Saya</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Tender Saya</span>
    </div>
</div>

@include('global.alert')

{{-- Status pengisian kelengkapan perusahaan (global utk profil) --}}
<x-card title="Status Kelengkapan &mdash; {{ $profil->nama_pt ?? 'Perusahaan' }}">
    @include('tender_user.peserta.part.peserta-steps', ['steps' => $steps])
    <a class="btn btn-primary" href="{{ route('peserta.edit', [$profil->id]) }}">
        <i class="fas fa-building nav-icon"></i> Edit Profil Perusahaan
    </a>
</x-card>

{{-- Daftar tender yang sudah didaftarkan profuk ini --}}
<x-card title="Tender yang Diikuti ({{ $rows->count() }})">
    @if($rows->isEmpty())
        <p class="text-muted mb-3">&laquo; Belum ada tender yang didaftarkan oleh perusahaan ini. &raquo;</p>
        <x-button label="Cari Tender di Beranda" href="{{ route('home') }}" variant="success" icon="fas fa-shopping-bag"/>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tender</th>
                        <th>HPS (Rp)</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $i => $row)
                        @php($t = $row['tender'])
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-medium">{{ $t->nama }}</td>
                            <td>{{ number_format($t->hps ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <x-button label="Mulai Isi (Wizard)"
                                          href="{{ route('peserta.wizard', [$profil->id, $t->id]) }}"
                                          variant="primary" size="sm" icon="fas fa-wand-magic-sparkles"/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-card>
@endsection
