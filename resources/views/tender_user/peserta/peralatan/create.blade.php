@extends('adminlte::page')

@section('title', 'Pendaftaran Alat Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Peralatan Tender {{$data->tender->nama ?? $peralatan->tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('peralatan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_user.peserta.peralatan.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('tender_home.index') }}" role="button">Selesai</a>
          </div>
        </form>
    </div>
    <div class="card card-primary">
        @include('tender_user.peserta.peralatan.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
