@extends('adminlte::page')

@section('title', 'Tender')

@section('content_header')



@stop

@section('content')

<body>
    @include('tender_admin.part.table')
</body>

@stop

@section('css')

@stop

@section('js')
@include('tender_admin.part.deletejs')


@stop
