@extends('layouts.admin')

@section('title', 'Edit Status Tender')

@section('content')
<div class="page-header">
    <h1>Edit Status Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('status_tender.index') }}">Status Tender</a> / <span>Edit</span>
    </div>
</div>

@if ($errors->any())
    <x-alert type="danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

<x-card title="Edit Status Tender">
    {{-- Note: route lama `status_tender_admin.update` tidak terdaftar → pakai route resource asli --}}
    <form action="{{ route('status_tender.update', [$data->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama" name="nama" value="{{ $data->nama }}" required/>
            </div>
        </div>
        <div class="d-flex gap-3 justify-content-end mt-4">
            <x-button label="Kembali" href="{{ route('status_tender.index') }}" variant="secondary"/>
            <x-button label="Submit" type="submit" variant="primary"/>
        </div>
    </form>
</x-card>
@endsection