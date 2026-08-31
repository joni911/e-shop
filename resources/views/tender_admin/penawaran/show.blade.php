@extends('layouts.app')

@section('title', 'Upload Penawaran')

@section('content')
<div class="page-header">
    <h1>Upload Penawaran</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_home.show', $tender->id) }}">Detail Tender</a> / <span>Penawaran</span>
    </div>
</div>

@include('global.alert')

{{-- HPS Display --}}
<div class="penawaran-hps">
    <div class="penawaran-hps-label">Harga Perkiraan Sendiri (HPS)</div>
    <div class="penawaran-hps-value">@currency(optional($data)->hps ?? 0)</div>
</div>

@if($data)
<div class="card mb-4">
    <div class="card-body">
        <p><strong>Penjelasan:</strong></p>
        <p>{!! optional($data)->penjelasan ?? '' !!}</p>
    </div>
</div>
@endif

@if(!$pp)
@if(!$daftar)
    {{-- Zona: belum terdaftar -> tidak boleh upload, wajib daftar dulu --}}
    <div class="card">
        <div class="card-body">
            <x-alert type="warning" dismissible title="Belum Terdaftar">
                Anda belum terdaftar sebagai peserta untuk tender ini. Silakan <a href="{{ route('tender_home.show', $tender->id) }}">daftar sebagai peserta</a> terlebih dahulu sebelum dapat mengupload penawaran.
            </x-alert>
            <a href="{{ route('tender_home.show', $tender->id) }}" class="btn btn-primary">Kembali ke Detail Tender</a>
        </div>
    </div>
@else
<div class="card" id="formUpload">
    <div class="card-header">
        <h3>Input Penawaran</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('penawaran_peserta.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $tender->id }}">

            <div class="form-group">
                <x-input label="Nilai Penawaran (Rp)" name="penawaran" type="number" required
                         placeholder="Masukkan nominal penawaran" hint="Masukkan tanpa titik atau koma"/>
            </div>

            @forelse (optional($data)->penawaran_file ?? [] as $pf)
                @php
                    // Tampilkan file yang sudah diupload (untuk update/re-upload)
                    $existingFile = null;
                    if ($pp) {
                        $existingFile = $pp->penawaran_peserta_file
                            ->where('nama', $pf->nama)
                            ->first();
                    }
                @endphp
                <div class="form-group">
                    <x-file label="{{ $pf->nama }} *" name="file_{{ $pf->id }}" required
                            accept=".pdf,.jpg,.jpeg,.zip" hint="{{ $pf->keterangan ?? '' }}"
                            :current="optional($existingFile)->file" download_label="File penawaran saat ini"/>
                </div>
            @empty
                <p class="text-muted">Tidak ada file penawaran yang diwajibkan.</p>
            @endforelse

            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('tender_home.show', $tender->id) }}" class="btn btn-secondary">Batal</a>
                <x-button label="Kirim Penawaran" type="submit" variant="primary" icon="fas fa-paper-plane"/>
            </div>
        </form>
    </div>
</div>
    @endif
@else
<div class="card" id="existingPenawaran">
    <div class="card-header">
        <h3>Penawaran Anda</h3>
    </div>
    <div class="card-body">
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="tender-detail-item">
                    <span class="tender-detail-item-label">Nilai Penawaran</span>
                    <span class="tender-detail-item-value text-primary fw-bold">@currency($pp->penawaran)</span>
                </div>
            </div>
        </div>

        <h4 class="mb-3" style="font-size:var(--text-sm);font-weight:600;">File Penawaran</h4>
        @forelse ($pp->penawaran_peserta_file as $no => $item)
            @php
                $pv = $item; // path ->file
                $pv_prefix = 'penawaran-existing';
                $label = $item->nama ?? 'File ' . $item->id;
            @endphp
            <div class="file-item">
                <div class="file-item-icon"><i class="fas fa-file text-primary"></i></div>
                <div class="file-item-info">
                    <div class="file-item-name">{{ $item->nama }}</div>
                </div>
                <div class="file-item-actions">
                    @include('tender_user.peserta.files.part.preview')
                    <a href="/{{ $item->file }}" download="{{ $item->nama }}" class="btn btn-sm btn-secondary">Download</a>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada file penawaran.</p>
        @endforelse
    </div>
</div>
@endif
@endsection
