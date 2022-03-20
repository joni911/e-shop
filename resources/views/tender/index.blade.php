@extends('adminlte::page')

@section('title', 'Tender')

@section('content_header')



@stop

@section('content')

<body>
    @include('tender.part.table')
</body>

@stop

@section('css')

@stop

@section('js')
@include('tender.part.deletejs')


@stop
