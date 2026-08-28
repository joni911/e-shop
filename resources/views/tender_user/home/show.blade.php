@extends('layouts.peserta')

@section('title', $data->nama)

@section('content')
<div class="page-header">
    <h1>{{ $data->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Detail Tender</span>
    </div>
</div>

{{-- Tender Info --}}
<div class="tender-detail-header">
    <div class="tender-detail-title">{{ $data->nama }}</div>
    <div class="tender-detail-grid">
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Jenis Pengadaan</span>
            <span class="tender-detail-item-value">{{ $data->jpn }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Jenis Kontrak</span>
            <span class="tender-detail-item-value">{{ $data->jkn }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Metode Pengadaan</span>
            <span class="tender-detail-item-value">{{ $data->mpn }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Status</span>
            <span class="tender-detail-item-value">{{ $data->stn }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">K/L/PD</span>
            <span class="tender-detail-item-value">{{ $data->KLPD }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Satuan Kerja</span>
            <span class="tender-detail-item-value">{{ $data->satuan_kerja }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Lokasi</span>
            <span class="tender-detail-item-value">{{ $data->lokasi_pekerjaan }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Nilai Pagu</span>
            <span class="tender-detail-item-value text-primary fw-bold">@currency($data->nilai_pagu)</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">HPS</span>
            <span class="tender-detail-item-value text-primary fw-bold">@currency($data->hps)</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Tahun Anggaran</span>
            <span class="tender-detail-item-value">{{ $data->tahun_anggaran }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Tanggal Pembuatan</span>
            <span class="tender-detail-item-value">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span>
        </div>
        <div class="tender-detail-item">
            <span class="tender-detail-item-label">Peserta</span>
            <span class="tender-detail-item-value">
                @php($j = $data->daftar_peserta->count())
                <a href="{{ route('peserta.tender', [$data->id]) }}">Peserta {{ $j }}</a>
            </span>
        </div>
    </div>
</div>

{{-- Action Zones --}}
<div class="mb-4" id="actionZones">
    @if(is_object($tahapan) && $today >= $tahapan->mulai && $today <= $tahapan->akhir)
        @if($daftar_peserta)
            <div class="alert alert-primary">
                <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div class="alert-content">
                    <strong>Zona Masa Pendaftaran</strong><br>
                    Periode: {{ \Carbon\Carbon::parse($tahapan->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tahapan->akhir)->format('d M Y') }}
                </div>
                <span class="badge badge-success ms-auto">Sudah Terdaftar</span>
            </div>
        @else
            @if($peserta)
                <div class="alert alert-primary">
                    <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="alert-content">
                        <strong>Zona Masa Pendaftaran</strong><br>
                        Periode: {{ \Carbon\Carbon::parse($tahapan->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tahapan->akhir)->format('d M Y') }}
                    </div>
                    <x-button label="Daftar Sebagai Peserta" data-bs-toggle="modal" data-bs-target="#modalDaftar" variant="primary" class="ms-auto"/>
                </div>
            @else
                <div class="alert alert-warning">
                    <div class="alert-content"><strong>Zona Masa Pendaftaran</strong> — Belum mendaftarkan perusahaan. Silakan lengkapi profil peserta terlebih dahulu.</div>
                </div>
            @endif
        @endif
    @elseif(is_object($tahapan))
        <div class="alert alert-info">
            <div class="alert-content">
                Tender Dimulai pada {{ \Carbon\Carbon::parse($tahapan->mulai)->format('d M Y') }}<br>
                Tender Selesai pada {{ \Carbon\Carbon::parse($tahapan->akhir)->format('d M Y') }}
            </div>
        </div>
    @endif

    @if(is_object($upfile) && $today >= $upfile->mulai && $today <= $upfile->akhir)
        <div class="alert alert-info">
            <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            <div class="alert-content">
                <strong>Zona Upload File</strong><br>
                Periode: {{ \Carbon\Carbon::parse($upfile->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($upfile->akhir)->format('d M Y') }}
            </div>
            <x-button :label="$penawaran ? 'Lihat File' : 'Masukkan File'" href="{{ route('penawaran_file.show', [$data->id]) }}" variant="primary" class="ms-auto"/>
        </div>
    @endif
</div>

{{-- Syarat Kualifikasi --}}
@if($data->syarat->count())
<div class="card mb-4">
    <div class="card-header">
        <h3>Syarat Kualifikasi</h3>
    </div>
    <div class="card-body">
        @foreach ($data->syarat as $s)
            {!! $s->content !!}
        @endforeach
    </div>
</div>
@endif

{{-- File yang dibutuhkan --}}
@if($data->tender_file->count())
<div class="card mb-4">
    <div class="card-header">
        <h3>File yang Dibutuhkan</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            @foreach ($data->tender_file as $fs)
                <li class="d-flex align-items-center gap-2 mb-2"><i class="fas fa-file text-primary"></i> {{ $fs->nama }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{-- Tahapan Timeline --}}
<div class="card">
    <div class="card-header">
        <h3>Jadwal Tahapan</h3>
    </div>
    <div class="card-body">
        <div class="tahapan-timeline" id="tahapanTimeline">
            @if($data->tahapan->count())
                @foreach ($data->tahapan as $t)
                    <?php
                        $isActive = $now >= \Carbon\Carbon::parse($t->mulai) && $now <= \Carbon\Carbon::parse($t->akhir);
                        $isCompleted = \Carbon\Carbon::parse($t->akhir) < $now;
                        $dotClass = $isActive ? 'active' : ($isCompleted ? 'completed' : '');
                    ?>
                    <div class="tahapan-item">
                        <div class="tahapan-dot {{ $dotClass }}"></div>
                        <div class="tahapan-content">
                            <h4>{{ $t->nama }}</h4>
                            <p>{{ \Carbon\Carbon::parse($t->mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($t->akhir)->format('d M Y') }}</p>
                            @if($t->status == 1)<span class="badge badge-primary">Masa Pendaftaran</span>@endif
                            @if($t->status == 4)<span class="badge badge-info">Upload File</span>@endif
                            @if($t->status == 3)<span class="badge badge-success">Pengumuman</span>@endif
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">Belum ada tahapan yang diatur.</p>
            @endif
        </div>
    </div>
</div>

{{-- Modal Daftar Peserta --}}
@if($peserta && !$daftar_peserta)
<x-modal id="modalDaftar" title="Konfirmasi Pendaftaran" size="lg" centered scrollable>
    <p class="mb-2">Apakah Anda ingin mendaftarkan <strong>{{ $peserta->nama_pt }}</strong>?</p>
    <p class="text-muted">Dengan menekan tombol DAFTARKAN, Anda menyatakan setuju untuk melakukan proses pengadaan barang/jasa sesuai aturan di PT. BPR Bank Daerah Bangli (Perseroda).</p>
    <x-slot name="footer">
        <form action="{{ route('daftar_peserta.store') }}" method="post" class="me-auto">
            @csrf
            <input type="hidden" name="id" value="{{ $peserta->id }}">
            <input type="hidden" name="tender_id" value="{{ $data->id }}">
            <x-button label="Daftar Sekarang" type="submit" variant="primary"/>
        </form>
        <x-button label="Batal" variant="secondary" data-bs-dismiss="modal"/>
    </x-slot>
</x-modal>
@endif
@endsection
