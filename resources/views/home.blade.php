@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')

Dashboard
<br>

Welcome to this beautiful admin panel.

{{-- @if((new \Jenssegers\Agent\Agent())->isMobile())
    <p><a href="{{ route('barang.index') }}">barang</a></p>
    <p>Menu 2</p>
@endif --}}



@stop

@section('css')

@stop

@section('js')

@stop
