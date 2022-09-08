@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

<header class="bg-light">
    <div class="container">

        <div class="text-center text-white">
        <h2 class="text-center text-dark">Hello Selamat datang {{$user->peserta->nama_pt ?? $user->name." Segera lengkapi data anda"}}</h2>
            @if (!$user->peserta)
                <h2>
                    <a href="/peserta">di Halaman {{--  --}}Peserta</a>
                </h2>
            @endif
            <img src="template/Background.jpg" style="height: 13cm; width:26cm; margin-top: 20px" />
            <p class="lead fw-normal text-white-50 mb-0" ></p>
        </div>
    </div>
</header>

{{-- @if((new \Jenssegers\Agent\Agent())->isMobile())
    <p><a href="{{ route('barang.index') }}">barang</a></p>
    <p>Menu 2</p>
@endif --}}



@stop

@section('css')

@stop

@section('js')

@stop
