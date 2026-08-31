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
        <div class="mb-3">
            <span class="badge {{ $sanggah->file ? 'badge-success' : 'badge-danger' }}">
                <i class="fas {{ $sanggah->file ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                {{ $sanggah->file ? 'File sudah diupload' : 'Belum ada file' }}
            </span>
        </div>
        <p>{!! $sanggah->keterangan !!}</p>

        @if ($sanggah->file)
            @php
                $pv = $sanggah; // path ->file
                $pv_prefix = 'sanggah';
                $label = 'File Sanggahan';
                $pv_path = $sanggah->file;
                $pv_ext = strtolower(pathinfo($pv_path, PATHINFO_EXTENSION));
                $pv_id = 'sanggah-file';
                $pv_dl = trim('Sanggahan ' . $data->nama);
            @endphp
            <x-button label="Buka File Sanggahan" variant="success" icon="fas fa-file" data-modal="{{ $pv_id }}"/>
            <x-button label="Download" href="/{{ $sanggah->file }}" :download="$pv_dl" variant="primary" icon="fas fa-download"/>
            <x-modal id="{{ $pv_id }}" title="File Sanggahan" size="lg">
                @if (in_array($pv_ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <img src="/{{ $pv_path }}" class="img-fluid rounded" alt="{{ $label }}">
                @elseif ($pv_ext === 'pdf')
                    <object data="/{{ $pv_path }}" type="application/pdf" width="100%" height="480">Browser tidak mendukung preview PDF — gunakan tombol unduh.</object>
                @elseif (in_array($pv_ext, ['zip', 'rar', '7z']))
                    <p class="mb-3">File arsip — gunakan tombol unduh untuk melihat isi.</p>
                    <x-button label="Download File" href="/{{ $pv_path }}" variant="primary" icon="fas fa-download"/>
                @else
                    <p class="mb-3">File: {{ $pv_path }}<br>Ekstensi {{ $pv_ext ?: '(tanpa ekstensi)' }} tidak didukung untuk preview — gunakan tombol unduh.</p>
                    <x-button label="Download File" href="/{{ $pv_path }}" variant="primary" icon="fas fa-download"/>
                @endif
                <x-slot:footer>
                    <x-button label="Download" href="/{{ $pv_path }}" :download="$pv_dl" variant="primary" icon="fas fa-download"/>
                    <x-button label="Tutup" variant="secondary" data-modal-close="{{ $pv_id }}"/>
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
                    <x-textarea label="Keterangan" name="keterangan" rows="4" placeholder="Tulis sanggahan di sini..." required/>
                </div>
                <div class="col-12 col-md-6">
                    <x-file label="File Sanggahan" name="file" required accept=".pdf,.jpg,.jpeg,.png,.zip,.rar,.7z" hint="Berkas pendukung sanggahan (PDF/gambar/arsip)"/>
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