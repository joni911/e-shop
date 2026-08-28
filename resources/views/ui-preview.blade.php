@extends('layouts.guest')

@section('title', 'UI Preview')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">UI Preview — Komponen Design System</h1>

    <x-card title="Preview Komponen">
        <x-slot:actions>
            <x-button label="Tambah" variant="primary" icon="fas fa-plus"/>
            <x-button label="Batal" variant="secondary"/>
        </x-slot:actions>

        <div class="mb-3">
            <x-input label="Nama" name="nama" value="PT Maju Jaya" placeholder="Masukkan nama"/>
            <x-select label="Jenis Kontrak" name="jk" :options="[1 => 'Kontrak A', 2 => 'Kontrak B']" value="2" placeholder="Pilih kontrak"/>
            <x-file label="Dokumen" name="file"/>
            <x-textarea label="Deskripsi" name="deskripsi" value="Isi teks"/>
        </div>

        <x-alert type="success">Berhasil disimpan!</x-alert>
        <x-alert type="warning" dismissible title="Perhatian">Ada peringatan.</x-alert>

        <x-table :head="['No', 'Nama', 'Aksi']">
            <tr><td>1</td><td>PT Maju Jaya</td><td><x-button label="Edit" variant="secondary"/></td></tr>
        </x-table>

        <x-button label="Simpan" variant="primary" type="submit" icon="fas fa-save"/>
    </x-card>
</div>
@endsection
