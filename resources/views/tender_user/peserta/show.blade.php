@extends('adminlte::page')

@section('title', 'Daftar Peserta')

@section('content_header')



@stop

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title-center">Daftar Peserta Tender {{$data->nama}}</h3>
    </div>
    @include('tender_user.peserta.part.table')


</div>

@stop

@section('css')

@stop

@section('js')

@stop
