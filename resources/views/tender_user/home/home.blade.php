@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')

@php
    $no = 1;

    $heads = [
    'No',
    'Nama Tender',
    'HPS',
    'Status',
    'Tahapan'
];
@endphp

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Tender </h3>
      <br>
      @if (auth()->user()->hak_akses != 'user')
      <a name="" id="" class="btn btn-primary" href="{{ route('tender_admin.create') }}" role="button">Tambah</a>

      @endif
    </div>
    <x-adminlte-datatable id="table6" :heads="$heads" head-theme="dark" theme="light"
    striped hoverable footer-theme="light" beautify>
        @forelse ($data as $d)
            <tr>
                <td>{{$no++}}</td>
                <td><a href="{{ route('tender_home.show', [$d->id]) }}">{{$d->nama}}</a></td>
                <td>{{$d->hps}}</td>
                <td>{{$d->stn}}</td>
                <td>
                    <table>
                    @foreach ($d->tahapan as $t)
                       <tr>



                        @if ($now<$t->akhir)
                            <td class="text-justify">{{$t->nama}}</td>
                            <td>Mulai {{$t->mulai}}</td>
                            <td>Berakhir {{$t->akhir}}</td>
                            @break
                        @else
                            {{-- <td class="text-justify">Selesai {{$t->nama}}</td>
                            <td>Mulai {{$t->mulai}}</td>
                            <td>Berakhir {{$t->akhir}}</td> --}}
                        @endif
                       </tr>
                    @endforeach
                </table>
               </td>
            </tr>
        @empty

        @endforelse
    </x-adminlte-datatable>

</div>

@stop

@section('css')

@stop

@section('js')

@stop
