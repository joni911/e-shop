@extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')

@section('title', 'Sanggah Banding')

@section('content')
<div class="page-header">
    <h1>Sanggah Banding</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('sanggahan.index') }}">Sanggahan</a> / <span>{{ $data->nama }}</span>
    </div>
</div>

@include('global.alert')

{{-- Berita Acara Evaluasi --}}
<x-card title="Sanggah Banding">
    <p>Bagi peserta yang ingin mengecek hasil evaluasi, silakan buka dokumen Berita Acara Evaluasi di bawah ini.</p>

    <x-button label="Buka Berita Acara Evaluasi" variant="warning" icon="fas fa-file" data-modal="modal-berita-acara"/>
    <x-modal id="modal-berita-acara" title="Dokumen Berita Acara Evaluasi" size="lg">
        <iframe src="https://drive.google.com/file/d/1_xsXiFa1pvIZa2lRRslC7b_Iy8JfF42b/preview" frameborder="0" scrolling="no" style="overflow:hidden;height:480px;width:100%" height="480px" width="100%"></iframe>
        <x-slot:footer>
            <x-button label="Tutup" variant="secondary" data-modal-close="modal-berita-acara"/>
        </x-slot:footer>
    </x-modal>
</x-card>

@if ($sanggah)
    {{-- Sanggahan sudah ada --}}
    <x-card title="Sanggahan">
        <p>{!! $sanggah->keterangan !!}</p>

        @if ($sanggah->file)
            <x-button label="Buka File Sanggahan" variant="success" icon="fas fa-file" data-modal="modal-sanggah-file"/>
            <x-modal id="modal-sanggah-file" title="File Sanggahan" size="lg">
                <object data="/{{ $sanggah->file }}" frameborder="0" scrolling="no" style="overflow:hidden;height:480px;width:100%" height="480px" width="100%"></object>
                <x-slot:footer>
                    <x-button label="Download" href="/{{ $sanggah->file }}" variant="primary" icon="fas fa-download"/>
                    <x-button label="Tutup" variant="secondary" data-modal-close="modal-sanggah-file"/>
                </x-slot:footer>
            </x-modal>
        @endif
    </x-card>

    <x-card title="Hapus Sanggahan">
        <p class="text-muted">Untuk mengedit dokumen, silakan hapus lalu kirim ulang.</p>
        <form method="POST" action="{{ route('sanggahan.destroy', $sanggah->id) }}" onsubmit="return confirm('Apakah Anda yakin menghapus sanggahan Anda?')">
            @csrf
            @method('DELETE')
            <x-button label="Hapus Data" type="submit" variant="danger" icon="fas fa-trash"/>
        </form>
    </x-card>
@else
    {{-- Form sanggahan baru --}}
    <x-card title="Kirim Sanggahan">
        <p class="text-muted">Untuk masa sanggah banding, isi keterangan dan unggah file di bawah ini.</p>
        <form action="{{ route('sanggahan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-12">
                    <x-textarea label="Keterangan" name="keterangan" rows="4" placeholder="Tulis sanggahan di sini..."/>
                </div>
                <div class="col-12 col-md-6">
                    <x-file label="File Sanggahan" name="file" required hint="Berkas pendukung sanggahan (PDF/gambar/arsip)"/>
                </div>
            </div>
            <input type="hidden" name="peserta" value="{{ $peserta->id }}">
            <input type="hidden" name="tender" value="{{ $data->id }}">
            <div class="d-flex gap-3 justify-content-end mt-4">
                <x-button label="Submit" type="submit" variant="primary"/>
            </div>
        </form>
    </x-card>
@endif
@endsection