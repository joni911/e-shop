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

{{-- <!doctype html>
  <html lang="en">
    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    </head> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    <body>
      {{-- <div>
        <h3 class="card-title">Tabel Barang</h3>
        <br>
        <a name="" id="" class="btn btn-primary" href="{{ route('barang.create') }}" role="button">Tambah</a>
      </div> --}}

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">

                {{-- <h4 class="card-title" style="margin-top: 20px; color: #1a642bad" >
                  Tabel Tender </h4> --}}

              <div class="update ml-3">
                @if (auth()->user()->hak_akses != 'user')

                <a type="submit" class="btn btn-primary" href="{{ route('tender_admin.create') }}" role="button" style="margin-left: 5px; margin-top: 20px;" ><b>+ Tambah</b></a>
                @endif
              </div>
              <div class="card-body">
                <div class="table-responsive">

              <table class="table">
                <thead class="thead-primary">
                  <tr>

                    <th><b>No</b></th>
                    <th><b>Nama Tender</b></th>
                    <th><b>HPS</b></th>
                    <th><b>Status</b></th>
                    <th style="text-align: center"><b>Tahapan</b></th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                  <tr class="alert" role="alert">
                    <td>
                        {{$no++}}
                    </td>
                    <td>
                        <a href="{{ route('tender_home.show', [$d->id]) }}">{{$d->nama}}</a>
                    </td>
                    <td>
                        {{$d->hps}}
                    </td>
                    <td>{{$d->stn}}</td>
                    <td>

                        <table>
                            @foreach ($d->tahapan as $t)
                               <tr>



                                @if ($now<$t->akhir)
                                    <td class="text-justify"><a href="{{ route('tahapan.show', $d->id) }}">{{$t->nama}}</a></td>
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






                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>



    {{-- <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script> --}}


    </body>
  </html>

@stop

@section('css')

@stop

@section('js')

@stop
