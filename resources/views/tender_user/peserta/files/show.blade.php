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

{{-- Kelengkapan berkas wajib --}}
@php
    $wajibFiles = $tender->tender_file ?? collect();
    $uploadedIds = $berkas->pluck('tender_file_id')->all();
    $totalWajib = $wajibFiles->count();
    $totalUploaded = collect($uploadedIds)->unique()->count();
    $allComplete = $totalWajib > 0 && $totalUploaded >= $totalWajib;
@endphp
@if($totalWajib > 0)
    <x-card title="Kelengkapan Berkas Wajib">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="progress flex-grow-1" style="height: 10px;">
                <div class="progress-bar {{ $allComplete ? 'bg-success' : 'bg-warning' }}" role="progressbar"
                     style="width: {{ $totalWajib ? round($totalUploaded / $totalWajib * 100) : 0 }}%;"></div>
            </div>
            <span class="badge {{ $allComplete ? 'badge-success' : 'badge-warning' }} text-nowrap">
                {{ $totalUploaded }}/{{ $totalWajib }} terupload
            </span>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($wajibFiles as $wf)
                @php
                    $has = in_array($wf->id, $uploadedIds);
                @endphp
                <li class="list-group-item d-flex align-items-center gap-2 py-2">
                    @if($has)
                        <i class="fas fa-check-circle text-success"></i>
                        <span>{{ $wf->nama }}</span>
                        <span class="badge badge-success ms-auto">Sudah diupload</span>
                    @else
                        <i class="fas fa-times-circle text-danger"></i>
                        <span>{{ $wf->nama }}</span>
                        <span class="badge badge-danger ms-auto">Belum diupload</span>
                    @endif
                </li>
            @endforeach
        </ul>
        @if(!$allComplete)
            <x-alert type="warning" class="mt-3 mb-0">
                Beberapa berkas wajib belum diupload. Silakan lengkapi melalui halaman Edit Peserta.
            </x-alert>
        @else
            <x-alert type="success" class="mt-3 mb-0">
                Semua berkas wajib telah diupload.
            </x-alert>
        @endif
    </x-card>
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