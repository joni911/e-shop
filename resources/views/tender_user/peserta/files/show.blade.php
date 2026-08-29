@extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')

@section('title', 'File Peserta')

@section('content')
@php
    $fn = str_replace('.', ' ', "{$data->nama_pt}");
@endphp

@if ($message = Session::get('warning-limit'))
    <x-alert type="warning" dismissible>{{ $message }}</x-alert>
@endif

<div class="page-header">
    <h1>File Peserta</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>File Peserta</span>
    </div>
</div>

{{-- Status kesimpulan pemeriksaan --}}
@if ($pemeriksaan == null)
    <x-alert type="info">
        <strong>Tender {{ $data->id }} — User {{ $data->user_id }}</strong>
        <x-button label="Edit" href="{{ route('peserta.edit', ['pesertum' => $data->id]) }}" variant="primary" size="sm" icon="fas fa-pencil-alt"/>
    </x-alert>
@elseif ($pemeriksaan->kesimpulan != 'Lulus')
    <x-alert type="danger" :title="$pemeriksaan->kesimpulan">
        Tender {{ $data->nama_tender }}
        <x-button label="Edit" href="{{ route('peserta.edit', ['pesertum' => $data->id]) }}" variant="primary" size="sm" icon="fas fa-pencil-alt"/>
    </x-alert>
@else
    <x-alert type="success" :title="$pemeriksaan->kesimpulan">
        Tender {{ $data->nama_tender }}
        <x-button label="Edit" href="{{ route('peserta.edit', ['pesertum' => $data->id]) }}" variant="primary" size="sm" icon="fas fa-pencil-alt"/>
    </x-alert>
@endif

{{-- Data peserta --}}
<x-card title="Data Peserta">
    <table class="table align-middle mb-0">
        <tbody>
            <tr>
                <th style="width: 240px;">Nama Perusahaan</th>
                <td>{{ $data->nama_pt }}</td>
            </tr>
            <tr>
                <th>Nama User</th>
                <td>{{ $data->user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email ?? '' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $data->alamat }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $data->no_hp }}</td>
            </tr>
            <tr>
                <th>Peringkat Peserta</th>
                <td>
                    @forelse ($nilai as $urut => $n)
                        @if ($n->peserta_id == $data->id)
                            Peringkat ke : {{ $urut + 1 }}
                            <br>
                            Nilai : {{ $n->nilai }}
                        @endif
                    @empty
                        Tender Belum dinilai
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>File</th>
                <td>
                    @forelse ($file as $f)
                        <a href="/{{ $f->file }}">{{ $f->id }}</a><br>
                    @empty
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
</x-card>

{{-- Penawaran --}}
<x-card title="Penawaran Peserta">
    <h5 class="mb-0">Penawaran : {{ $pp->penawaran ?? '' }}</h5>
</x-card>

{{-- Tabs berkas & penilaian --}}
@include('tender_user.peserta.files.main.index')
@endsection