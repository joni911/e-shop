@extends('adminlte::page')

@section('title', 'Create Metode Pengadaan')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Metode Pengadaan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('metode_pengadaan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('metode_pengadaan.part.form')
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
