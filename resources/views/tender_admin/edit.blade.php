@extends('layouts.admin')

@section('title', 'Edit Tender')

@section('content')
<div class="page-header">
    <h1>Edit Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <a href="{{ route('tender_admin.index') }}">Kelola Tender</a> / <span>Edit</span>
    </div>
</div>

{{-- Step wizard --}}
@include('tender_admin.part.tender-setup-steps', ['tender' => $data, 'active' => 1])

<x-card title="Edit Tender">
    <form action="{{ route('tender_admin.update', [$data->id]) }}" enctype="multipart/form-data" method="post">
        @method('put')
        @csrf
        @include('tender_admin.part.form')
        <div class="d-flex gap-2 mt-4">
            <x-button label="Simpan" type="submit" variant="primary" icon="fas fa-save"/>
            <x-button label="Batal" href="{{ route('tender_admin.index') }}" variant="secondary"/>
        </div>
    </form>
</x-card>
@endsection
