@extends('layouts.peserta')

@section('title', 'Pendaftaran Alat Tender')

@section('content')
<div class="page-header">
    <h1>Pendaftaran Peralatan Utama</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Peralatan</span>
    </div>
</div>

@include('global.alert')

<x-alert type="warning" title="Peralatan Yang Dibutuhkan" class="mb-4">
    <ul class="mb-0">
        <li>1 Unit Concrete Mixer kapasitas minimal 0,3 m3</li>
        <li>1 Unit Dump Truck kapasitas minimal 8 m3</li>
        <li>1 Unit Excavator kapasitas minimal 0,3 m3</li>
    </ul>
</x-alert>

<x-card title="{{ $status == 'show' ? 'Tambah Peralatan' : 'Edit Peralatan' }}">
    <form action="{{ $status == 'show' ? route('peralatan.store') : route('peralatan.update', [$data]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($status != 'show') @method('PUT') @endif

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama Alat" name="nama" value="{{ $data->nama ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Jumlah" name="jumlah" type="number" value="{{ $data->jumlah ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Kapasitas" name="kapasitas" value="{{ $data->kapasitas ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-4">
                <x-input label="Merk" name="merk" value="{{ $data->merk ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Tahun Pembelian" name="tahun" type="number" value="{{ $data->tahun ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Kepemilikan" name="kepemilikan" :options="['Sewa' => 'Sewa', 'Miliki Sendiri' => 'Milik Sendiri']" :value="$data->kepemilikan ?? ''" placeholder="Pilih Kepemilikan" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-select label="Kondisi" name="kondisi" :options="['Baik' => 'Baik', 'Rusak' => 'Rusak']" :value="$data->kondisi ?? ''" placeholder="Pilih Kondisi" required/>
            </div>
            <div class="col-12">
                <x-textarea label="Lokasi Alat" name="lokasi" rows="3" required>{{ $data->lokasi ?? '' }}</x-textarea>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Bukti Kepemilikan" name="bukti" value="{{ $data->bukti ?? '' }}" required/>
            </div>
            <div class="col-12 col-md-6">
                <x-file label="File Bukti Kepemilikan" name="file" accept=".jpg,.jpeg,.png,.pdf"
                        :current="$data->file ?? null" download_label="Download file saat ini"
                        hint="Masukkan file yang bisa membuktikan kepemilikan alat"/>
            </div>
        </div>

        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('file_teknis.show', [$peralatan->id]) }}" variant="secondary" icon="fas fa-arrow-left"/>
            <x-button label="Submit" type="submit" variant="primary" icon="fas fa-save"/>
        </div>
    </form>
</x-card>

{{-- Daftar Peralatan --}}
<x-card title="Daftar Peralatan">
    <x-table :head="['No', 'Nama', 'Jumlah', 'Kapasitas', 'Merk', 'Tahun', 'Kondisi', 'Lokasi', 'Kepemilikan', 'Bukti', 'Aksi']">
        @forelse ($list as $no => $p)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $p->nama }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->kapasitas }}</td>
                <td>{{ $p->merk }}</td>
                <td>{{ $p->tahun }}</td>
                <td>{{ $p->kondisi }}</td>
                <td>{{ $p->lokasi }}</td>
                <td>{{ $p->kepemilikan }}</td>
                <td>
                    @if($p->file)
                        <a href="/{{ $p->file }}" target="_blank" class="text-primary">{{ $p->bukti ?? 'Lihat' }}</a>
                    @else
                        <span class="text-muted">{{ $p->bukti ?? '-' }}</span>
                    @endif
                </td>
                <td>
                    <x-button label="Edit" href="{{ route('peralatan.edit', [$p->id]) }}" variant="secondary" size="sm" icon="fas fa-edit"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="table-empty">Belum ada data peralatan.</td>
            </tr>
        @endforelse
    </x-table>
    @if(method_exists($list, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $list->links() }}</div>
    @endif
</x-card>

<x-card title="Langkah Berikutnya">
    <p class="text-muted mb-3">Setelah peralatan selesai, lanjutkan mengisi <strong>Pekerjaan Sedang Berjalan</strong>.</p>
    <x-button label="Berikutnya: Pekerjaan Berjalan" href="{{ route('pekerjaan_berjalan.show', [$peralatan->id]) }}" variant="success" icon="fas fa-arrow-right"/>
</x-card>
@endsection
