@extends('adminlte::page')

@section('title', 'Create Tahapan')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Tahapan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('tahapan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tahapan.part.form')
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
