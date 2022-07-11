@extends('adminlte::page')

@section('title', 'Create Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Tender {{$data->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('tender_file.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('dashboard.files.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          <a name="" id="" class="btn btn-success" href="{{ route('dashboard.index') }}" role="button">Selesai</a>

          </div>
        </form>

        <div class="card-header">
            <h3 class="card-title">Daftar Tender {{$data->nama}}</h3>
        </div>

        @include('dashboard.files.table')

    </div>
</body>

@stop

@section('css')

@stop

@section('js')

@stop
