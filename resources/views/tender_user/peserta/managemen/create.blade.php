@extends('adminlte::page')

@section('title', 'Pendaftaran managemen Perusahaan Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran managemen Perusahaan Tender {{$data->tender->nama ?? $managemen->tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        @if ($status == 'show')
        <form action="{{ route('managemen.store') }}" enctype="multipart/form-data" method="post">
            @csrf
        @else
        <form action="{{ route('managemen.update',$data) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
        @endif
            @include('tender_user.peserta.managemen.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('tender_home.index') }}" role="button">Selesai</a>
          </div>
        </form>
    </div>
    <div class="card card-primary">
        @include('tender_user.peserta.managemen.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
