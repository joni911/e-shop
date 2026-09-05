@extends('layouts.peserta')

@section('title', 'Managemen Perusahaan')

@section('content')
@php
    // status 'show' = tambah baru (data belum ada), selain itu edit record managemen
    $isShow = ($status ?? 'show') === 'show';
    $rec = $isShow ? null : ($data ?? null); // record managemen saat mode edit
    $sert = [];
    for ($i = 1; $i <= 5; $i++) {
        $sert[] = [
            'n'    => $i,
            'req'  => $isShow && $i === 1, // minimal 1 sertifikat wajib saat tambah
            'file' => $rec ? ($rec->{'file' . $i} ?? null) : null,
            'ket'  => $rec ? ($rec->{'ket' . $i} ?? null) : null,
        ];
    }
@endphp

<div class="page-header">
    <h1>Managemen Perusahaan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Managemen</span>
    </div>
</div>

@include('global.alert')

@include('tender_user.peserta.part.validation-alert')

@include('tender_user.peserta.part.peserta-steps', ['steps' => $steps, 'activeKey' => 'managemen'])
@include('tender_user.peserta.part.tender-head')

<x-card :title="$isShow ? 'Tambah Managemen Perusahaan' : 'Edit Managemen Perusahaan'">
    <form action="{{ $isShow ? route('managemen.store') : route('managemen.update', [$rec]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(!$isShow) @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $peserta->id ?? '' }}">
        <input type="hidden" name="tender_id" value="{{ $rec->tender_id ?? ($tenderId ?? '') }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" value="{{ $rec->nama ?? '' }}" required placeholder="Nama pengurus/manajemen perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Menjabat" name="tgl_menjabat" type="date" value="{{ $rec->tgl_menjabat ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Jabatan Berakhir" name="tgl_berakhir" type="date" value="{{ $rec->tgl_berakhir ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. KTP" name="ktp" value="{{ $rec->ktp ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="NPWP" name="npwp" value="{{ $rec->npwp ?? '' }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3" required>{{ $rec->alamat ?? '' }}</x-textarea>
            </div>
        </div>

        {{-- Status dalam manajemen (select) --}}
        <div class="row g-4 mt-0">
            <div class="col-12 col-md-6">
                <x-select label="Status Dalam Manajemen" name="status"
                          :options="['Pemilik' => 'Pemilik', 'Pengurus' => 'Pengurus', 'Direktur' => 'Direktur']"
                          :value="$rec->status ?? ''" placeholder="Pilih Status" required/>
            </div>
        </div>

        {{-- File sertifikat managemen (file1..file5 + ket1..ket5) --}}
        <div class="row g-4 mt-4">
            <div class="col-12">
                <h6 class="fw-semibold text-primary mb-1"><i class="fas fa-certificate me-1"></i>File Sertifikat (minimal 1)</h6>
                <p class="text-muted small mb-0">Lampirkan sertifikat/ijazah pendukung untuk tiap pengurus/manajemen yang didaftarkan.</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($sert as $s)
                <div class="col-12 col-md-6">
                    <x-input label="Keterangan Sertifikat {{ $s['n'] }}" name="ket{{ $s['n'] }}"
                             value="{{ $s['ket'] ?? '' }}" :required="$s['req']"
                             placeholder="Contoh: Sertifikat Keahlian / Ijazah"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-file label="File Sertifikat {{ $s['n'] }}" name="file{{ $s['n'] }}"
                            :required="$s['req']" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.7z"
                            :current="$s['file']" download_label="Download sertifikat saat ini"
                            :hint="$s['req'] ? 'Wajib diisi minimal 1 sertifikat' : ($s['file'] ? 'Kosongkan bila tidak ingin mengganti file' : 'Opsional')"/>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('pekerjaan_berjalan.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button :label="$isShow ? 'Simpan Managemen' : 'Perbarui Managemen'" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Managemen --}}
<x-card title="Daftar Managemen">
    <x-table :head="['No', 'Nama', 'KTP', 'NPWP', 'Alamat', 'Tgl Menjabat', 'Tgl Berakhir', 'Status', 'Sertifikat', 'Aksi']">
        @forelse ($list as $no => $l)
            @php
                $lFiles = [];
                for ($i = 1; $i <= 5; $i++) {
                    if ($l->{'file' . $i}) {
                        $lFiles[] = ['file' => $l->{'file' . $i}, 'ket' => $l->{'ket' . $i}];
                    }
                }
            @endphp
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $l->nama }}</td>
                <td>{{ $l->ktp }}</td>
                <td>{{ $l->npwp }}</td>
                <td>{{ $l->alamat }}</td>
                <td>{{ $l->tgl_menjabat }}</td>
                <td>{{ $l->tgl_berakhir }}</td>
                <td>{{ $l->status }}</td>
                <td>
                    @forelse ($lFiles as $f)
                        <a href="/{{ $f['file'] }}" target="_blank" class="d-block text-primary">
                            <i class="fas fa-paperclip me-1"></i>{{ $f['ket'] ?: 'Sertifikat ' . $loop->parent->iteration }}
                        </a>
                    @empty
                        <span class="text-muted">Kosong</span>
                    @endforelse
                </td>
                <td>
                    <x-button label="Edit" href="{{ route('managemen.edit', [$l->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="table-empty">Belum ada data managemen.</td>
            </tr>
        @endforelse
    </x-table>
    @if (method_exists($list, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $list->links() }}</div>
    @endif
</x-card>

<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah data managemen selesai, lanjutkan mengisi <strong>Administrasi (Upload Berkas)</strong>.</p>
    <x-button label="Berikutnya: Administrasi" href="{{ route('administrasi_list.show', [$peserta->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
