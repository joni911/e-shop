@extends('adminlte::page')

@section('title', 'Pendaftaran Peserta Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Tender {{$data->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('peserta.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_user.peserta.part.form')
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
