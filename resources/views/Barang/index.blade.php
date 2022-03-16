@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')

<body>
    <a href="{{ route('barang.create') }}">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $no => $b)
                <tr>
                    <td scope="row">{{$no}}</td>
                    <td> <a href="{{ route('barang.show', [$b->id]) }}">{{$b->nama}}</a></td>
                    <td>{{$b->inventory_barang->jumlah}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('barang.show', [$b->id]) }}" role="button">Edit</a>
                    </td>
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
