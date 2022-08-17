@extends('adminlte::page')

@section('title', 'Pendaftaran Kelengkapan Berkas Peserta')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h2 class="card-title">Pendaftaran Kelengkapan Berkas Peserta</h2>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('peserta.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_user.peserta.registrasi.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
