@extends('adminlte::page')

@section('title', 'Perubahan')

@section('content_header')



@stop

@section('content')

<body>
    @include('perubahan.part.table')
</body>

@stop

@section('css')

@stop

@section('js')
@include('perubahan.part.deletejs')


@stop
