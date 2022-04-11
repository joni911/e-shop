@extends('adminlte::page')

@section('title', 'Perubahan')

@section('content_header')

@include('shops.asset')

@stop

@section('content')

<body>
    @include('shops.slide')
    @include('shops.item')
</body>

@stop

@section('css')

@stop

@section('js')
@include('shops.js')
@include('perubahan.part.deletejs')


@stop
