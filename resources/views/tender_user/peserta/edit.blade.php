@extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')

@section('title', 'Edit Peserta')

@section('content')
@php
    $fn = str_replace('.', ' ', "{$data->nama_pt}");
@endphp

<div class="page-header">
    <h1>Edit Peserta — {{ $data->nama_pt }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Edit Peserta</span>
    </div>
</div>

@include('tender_user.peserta.part.validation-alert')
@include('tender_user.peserta.part.peserta-steps', ['steps' => $steps, 'activeKey' => 'perusahaan'])

<form action="{{ route('peserta.update', [$data->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $data->id }}">

    {{-- Identitas Perusahaan --}}
    <x-card title="Identitas Perusahaan">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Perusahaan" name="nama_pt" value="{{ $data->nama_pt }}" placeholder="Masukkan Nama Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Kualifikasi" name="kualifikasi" value="{{ $data->kualifikasi }}" placeholder="Masukkan Jenis Kualifikasi Perusahaan"/>
            </div>
            <div class="col-12">
                <x-textarea label="Klasifikasi" name="klasifikasi" rows="3">{{ $data->klasifikasi }}</x-textarea>
            </div>
        </div>
    </x-card>

    {{-- Izin Perusahaan --}}
    <x-card title="Izin Perusahaan">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Izin Perusahaan (NIB/IUJK)" name="izin" value="{{ $data->izin }}" placeholder="Masukkan Izin Perusahaan NIB atau IUJK"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nomor Izin Perusahaan" name="nomor_izin" value="{{ $data->nomor_izin }}" placeholder="Masukkan Nomor Surat Izin Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Berlaku Sampai" name="izin_berlaku" type="date" value="{{ $data->izin_berlaku }}"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Instansi Pemberi" name="instansi_pemberi" value="{{ $data->instansi_pemberi }}" hint="Masa berlaku izin usaha — jika seumur hidup pakai sampai 2050"/>
            </div>
        </div>
    </x-card>

    {{-- Akta --}}
    <x-card title="Akta">
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <x-input label="Nomor" name="no_akta" type="number" value="{{ $data->no_akta }}"/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Tanggal Surat" name="tgl_akta" type="date" value="{{ $data->tgl_akta }}"/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Notaris" name="notaris" value="{{ $data->notaris }}"/>
            </div>
        </div>
    </x-card>

    {{-- Akta Perubahan Terakhir --}}
    <x-card title="Akta Perubahan Terakhir">
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <x-input label="Nomor" name="no_aktab" type="number" value="{{ $data->no_aktab }}"/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Tanggal Surat" name="tgl_aktab" type="date" value="{{ $data->tgl_aktab }}"/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Notaris" name="notaris_b" value="{{ $data->notaris_b }}"/>
            </div>
        </div>
    </x-card>

    {{-- Bukti KSWP --}}
    <x-card title="Bukti KSWP">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="NPWP" name="kswp_npwp" value="{{ $data->kswp_npwp }}" placeholder="Masukkan No NPWP"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nama Pemilik NPWP" name="kswp_nama" value="{{ $data->kswp_nama }}" placeholder="Masukkan Nama Pemilik NPWP"/>
            </div>
        </div>
    </x-card>

    {{-- Data Perusahaan --}}
    <x-card title="Data Perusahaan">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="No HP" name="no_hp" value="{{ $data->no_hp }}" placeholder="Masukkan Nomor Whatsapp Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Email" name="email" type="email" value="{{ $data->email }}" placeholder="Masukkan Email Perusahaan"/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3">{{ $data->alamat }}</x-textarea>
            </div>
        </div>
    </x-card>

    {{-- File Pendukung --}}
    <x-card title="File Pendukung">
        @forelse ($file as $tf)
            <div class="mb-4">
                <x-file :label="$tf->nama_file" name="file_{{ $tf->id }}" accept=".jpg, .jpeg, .png, .pdf, .zip, .rar, .7z"
                        :current="$tf->file" download_label="Download file saat ini"
                        hint="Isi untuk memperbarui file"/>
            </div>
        @empty
            <p class="text-muted mb-0">Tidak ada file pendukung.</p>
        @endforelse
    </x-card>

    <div class="d-flex gap-3 justify-content-end">
        <x-button label="Berikutnya" href="{{ route('administrasi_list.show', [$data->id]) }}" variant="success" icon="fas fa-arrow-right"/>
        <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
    </div>
</form>
@endsection