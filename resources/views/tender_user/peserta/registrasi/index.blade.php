@extends('adminlte::page')

@section('title', 'Pendaftaran Kelengkapan Berkas Peserta')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-danger">
        <div class="card-header">
          <h2 class="card-title">Anda Belum melengkapi berkas berksa yang dibutuhkan!</h2>

        </div>
        <p class="text-center">Daftarkan perusahaan anda di link berikut ini </p>
          <a name="" id="" class="btn btn-success" href="{{ route('peserta.create') }}" role="button">Daftarkan Perusahaan Anda</a>
      </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
