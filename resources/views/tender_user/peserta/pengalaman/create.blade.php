@extends('adminlte::page')

@section('title', 'Pendaftaran Peserta Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Tender {{$data->tender->nama ?? $peserta->tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('pengalaman.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_user.peserta.pengalaman.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('routeName', ['id'=>1]) }}" role="button">Selesai</a>
          </div>
        </form>
    </div>
    <div class="card card-primary">
        @include('tender_user.peserta.pengalaman.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
