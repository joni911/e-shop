@extends('layouts.peserta')

@section('title', 'Perubahan Jadwal')

@section('content')
<div class="page-header">
    <h1>Perubahan Jadwal — {{ $tahapan->tender->nama }}</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Perubahan Jadwal</span>
    </div>
</div>

@include('perubahan.part.table')
@endsection
