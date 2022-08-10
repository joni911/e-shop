@extends('adminlte::page')

@section('title', 'Pendaftaran Tenaga Ahli Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Tenaga Ahli Tender {{$data->tender->nama ?? $peserta->tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('tenagaahli.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_user.peserta.tenaga_ahli.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('peralatan.show', [$peserta->id]) }}" role="button">Selesai</a>
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