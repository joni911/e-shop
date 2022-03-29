@extends('adminlte::page')

@section('title', 'Status tender')

@section('content_header')



@stop

@section('content')

<body>
    @include('status_tender_admin.part.table')
</body>

@stop

@section('css')

@stop

@section('js')
@include('status_tender_admin.part.deletejs')


@stop
