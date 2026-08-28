@extends('layouts.admin')

@section('title', 'Kelola Tender')

@section('content')
<div class="page-header">
    <h1>Kelola Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Kelola Tender</span>
    </div>
</div>

@include('tender_admin.part.table')
@endsection
