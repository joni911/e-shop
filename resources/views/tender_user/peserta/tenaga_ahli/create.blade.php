@extends('layouts.peserta')

@section('title', 'Personil Managerial')

@section('content')
<div class="page-header">
    <h1>Personil Managerial</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Tenaga Ahli</span>
    </div>
</div>

@include('global.alert')

@include('tender_user.peserta.part.validation-alert')

@include('tender_user.peserta.part.tender-head')

<x-alert type="warning" title="Personil Managerial Yang Dibutuhkan" class="mb-4">
    <ul class="mb-0">
        <li>1 (satu) orang Pelaksana, dengan SKT Pelaksana Bangunan Gedung/Pekerjaan Gedung, Pengalaman 2 Tahun.</li>
        <li>1 (satu) orang Petugas K3 Konstruksi Tanpa Pengalaman.</li>
    </ul>
</x-alert>

<x-card title="{{ $status == 'show' ? 'Tambah Tenaga Ahli' : 'Edit Tenaga Ahli' }}">
    <form action="{{ $status == 'show' ? route('tenagaahli.store') : route('tenagaahli.update', [$data]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($status != 'show') @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $peserta->id ?? '' }}">
        <input type="hidden" name="tender_id" value="{{ $data->tender_id ?? ($tenderId ?? '') }}">

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" value="{{ $data->nama ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Lahir" name="tgl_lahir" type="date" value="{{ $data->tgl_lahir ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Jenis Kelamin" name="jk" :options="['Laki - Laki' => 'Laki - Laki', 'Perempuan' => 'Perempuan']" :value="$data->jk ?? ''" placeholder="Pilih Jenis Kelamin" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Negara Asal" name="negara" value="{{ $data->negara ?? '' }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3" required>{{ $data->alamat ?? '' }}</x-textarea>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Jabatan" name="jabatan" value="{{ $data->jabatan ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Pengalaman" name="pengalaman" value="{{ $data->pengalaman ?? '' }}" required hint="Lama bekerja (tahun)"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Email" name="email" type="email" value="{{ $data->email ?? '' }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Keterangan" name="keterangan" rows="3" required hint="Deskripsikan pengalaman kerja petugas di sini">{{ $data->keterangan ?? '' }}</x-textarea>
            </div>
        </div>

        <div class="row g-4 mt-0">
            <div class="col-12 col-md-6">
                <x-file label="Sertifikat Pendukung" name="file" required accept=".jpg,.jpeg,.png,.xls,.xlsx,.pdf,.doc,.docx,.zip,.rar,.7z"
                        :current="$data->file ?? null" download_label="Download sertifikat saat ini"
                        hint="Mohon diisi dengan sertifikat yang mendukung keahlian tenaga ahli"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nama Sertifikat" name="nama_file" value="{{ $data->nama_file ?? '' }}" required/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('pengalaman.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Tenaga Ahli --}}
<x-card title="Daftar Tenaga Ahli">
    <x-table :head="['No', 'Nama', 'Tgl Lahir', 'Jenis Kelamin', 'Jabatan', 'Pengalaman', 'Sertifikat', 'Aksi']">
        @forelse ($list as $no => $l)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $l->nama }}</td>
                <td>{{ $l->tgl_lahir }}</td>
                <td>{{ $l->jk }}</td>
                <td>{{ $l->jabatan }}</td>
                <td>{{ $l->pengalaman }}</td>
                <td>
                    @if($l->file)
                        <a href="/{{ $l->file }}" target="_blank" class="text-primary">{{ $l->nama_file ?? 'Lihat' }}</a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <x-button label="Edit" href="{{ route('tenagaahli.edit', [$l->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="table-empty">Belum ada data tenaga ahli.</td>
            </tr>
        @endforelse
    </x-table>
    @if(method_exists($list, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $list->links() }}</div>
    @endif
</x-card>

<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah tenaga ahli selesai, lanjutkan mengisi <strong>RKK (Rencana Keselamatan Konstruksi)</strong>.</p>
    <x-button label="Berikutnya: RKK" href="{{ route('file_teknis.show', [$peserta->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
