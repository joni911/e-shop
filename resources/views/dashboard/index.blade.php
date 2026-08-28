@extends('layouts.admin')

@section('title', 'Pemeriksaan')

@section('content')
<div class="page-header">
    <h1>Pemeriksaan Peserta</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Pemeriksaan</span>
    </div>
</div>

@include('global.alert')
@include('dashboard.part.table')
@endsection
