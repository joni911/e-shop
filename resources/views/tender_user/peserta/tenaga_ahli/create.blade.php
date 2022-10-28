@extends('adminlte::page')

@section('title', 'Personil Managerial')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Personil Managerial</h3>
          {{-- <h3 class="card-title">Personil Managerial {{$data->tender->nama ?? $peserta->tender->nama}}</h3> --}}
        </div>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Tenaga Ahli Yang Dibutuhkan</h4>
          <li>
            1 (satu) orang Pelaksana, dengan SKT Pelaksana Bangunan Gedung /Pekerjaan Gedung, Pengalaman 2 Tahun.
          </li>
          <li>
            1 (satu) orang Petugas K3 Konstruksi Tanpa Pengalaman.
          </li>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        @if ($status == 'show')
        <form action="{{ route('tenagaahli.store') }}" enctype="multipart/form-data" method="post">
            @csrf
        @else
        <form action="{{ route('tenagaahli.update',[$data]) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
        @endif
          <!-- /.card-body -->
          @include('tender_user.peserta.tenaga_ahli.form')

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('file_teknis.show', [$peserta->id]) }}" role="button">Berikutnya</a>
            {{-- <a name="" id="" class="btn btn-success" href="{{ route('peralatan.show', [$peserta->id]) }}" role="button">Berikutnya</a> --}}
          </div>
        </form>
    </div>
    <div class="card card-primary">
        @include('tender_user.peserta.tenaga_ahli.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
