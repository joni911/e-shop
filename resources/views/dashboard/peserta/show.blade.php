@extends('adminlte::page')

@section('title', 'Daftar Peserta')

@section('content_header')



@stop

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title-center">Daftar Peserta Tender {{$data->nama}}</h3>
    </div>
    {{-- <p>{{auth()->user()->hak_akses}}</p> --}}
    @if (auth()->user()->hak_akses == 'admin')
        @include('dashboard.peserta.part.admintable')
    @else
        @include('dashboard.peserta.part.table')

    @endif


</div>

@stop

@section('css')

@stop

@section('js')

@stop
