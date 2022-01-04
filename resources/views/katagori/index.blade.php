@extends('adminlte::page')

@section('title', 'katagori')

@section('content_header')



@stop

@section('content')

<body>
    <a href="{{ route('katagori.create') }}">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($katagori as $no => $b)
                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$b->nama}}</td>
                    <td>{{$b->keterangan}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">Kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

@stop

@section('css')

@stop

@section('js')

@stop
