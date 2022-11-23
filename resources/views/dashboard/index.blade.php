@extends('adminlte::page')

@section('title', 'Tender')

@section('content_header')



@stop

@section('content')

<body>
    @include('global.alert')
    @include('dashboard.part.table')
</body>

@stop

@section('css')

@stop

@section('js')
@include('dashboard.part.deletejs')


@stop
