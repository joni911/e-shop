@extends('layouts.peserta')

@section('title', 'Edit Pengalaman Tender')

@section('content')
<div class="page-header">
    <h1>Edit Pengalaman Pekerjaan Konstruksi</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Pengalaman</span>
    </div>
</div>

@include('global.alert')

@include('tender_user.peserta.part.validation-alert')

@include('tender_user.peserta.part.tender-head')

<x-alert type="warning" title="Ketentuan Pengalaman" class="mb-4">
    <ul class="mb-0">
        <li>Memiliki pengalaman paling kurang 1 (satu) Pekerjaan Konstruksi dalam kurun waktu 4 (empat) tahun terakhir, baik di lingkungan pemerintah maupun swasta, termasuk pengalaman subkontrak.</li>
        <li>Untuk kualifikasi Usaha Kecil yang baru berdiri kurang dari 3 (tiga) tahun: dalam hal Penyedia belum memiliki pengalaman, dikecualikan dari ketentuan huruf h untuk pengadaan dengan nilai paket sampai dengan paling banyak Rp2.500.000.000,00 (dua miliar lima ratus juta rupiah).</li>
        <li>Jika tidak ada keterangan, bisa diisi "-".</li>
    </ul>
</x-alert>

<x-card title="Edit Pengalaman">
    <form action="{{ route('pengalaman.update', [$data->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Kontrak" name="pekerjaan" value="{{ $data->pekerjaan }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Lokasi" name="lokasi" value="{{ $data->lokasi }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Instansi Pemberi Tugas" name="instansi" value="{{ $data->instansi }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3" required>{{ $data->alamat }}</x-textarea>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. Telepon" name="no_hp" type="number" value="{{ $data->no_hp }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. Kontrak" name="no_kontrak" value="{{ $data->no_kontrak }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nilai Kontrak" name="nilai_kontrak" type="number" value="{{ $data->nilai_kontrak }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Kontrak" name="tgl_kontrak" type="date" value="{{ $data->tgl_kontrak }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Persentase Pelaksanaan" name="presentasi" type="number" value="{{ $data->presentasi }}" required hint="Dalam persen (%)"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Selesai Kontrak" name="tgl_selesai_kontrak" type="date" value="{{ $data->tgl_selesai_kontrak }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tanggal Serah Terima" name="tgl_serah_terima" type="date" value="{{ $data->tgl_serah_terima }}" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Keterangan" name="keterangan" rows="3" required>{{ $data->keterangan }}</x-textarea>
            </div>
        </div>

        <div class="row g-4 mt-0">
            <div class="col-12 col-md-6">
                <x-file label="File Pendukung" name="file1" required accept=".jpg,.jpeg,.png,.xls,.xlsx,.pdf,.doc,.docx,.zip,.rar,.7z"
                        :current="$data->file ?? null" download_label="Download file saat ini"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nama File" name="nama_file" value="{{ $data->nama_file }}" required/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali ke Daftar" href="{{ route('pengalaman.show', [$peserta->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Simpan Perubahan" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Pengalaman --}}
<x-card title="Daftar Pengalaman">
    <x-table :head="['No', 'Nama Kontrak', 'Lokasi', 'Instansi', 'Nilai Kontrak', 'Persentase', 'File', 'Aksi']">
        @forelse ($list as $no => $l)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $l->pekerjaan }}</td>
                <td>{{ $l->lokasi }}</td>
                <td>{{ $l->instansi }}</td>
                <td>@currency($l->nilai_kontrak)</td>
                <td>{{ $l->presentasi }}%</td>
                <td>
                    @if($l->file)
                        <a href="/{{ $l->file }}" target="_blank" class="text-primary">{{ $l->nama_file ?? 'Lihat' }}</a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <x-button label="Edit" href="{{ route('pengalaman.edit', [$l->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="table-empty">Belum ada data pengalaman.</td>
            </tr>
        @endforelse
    </x-table>
    @if(method_exists($list, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $list->links() }}</div>
    @endif
</x-card>

@if ($list != null)
<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah pengalaman selesai, lanjutkan mengisi <strong>Personil Managerial (Tenaga Ahli)</strong>.</p>
    <x-button label="Berikutnya: Tenaga Ahli" href="{{ route('tenagaahli.show', [$peserta->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endif
@endsection
