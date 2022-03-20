@extends('adminlte::page')

@section('title', 'Edit Tahapan')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Tahapan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('tahapan.update', [$data->id]) }}" enctype="multipart/form-data" method="post">
            @method('put')
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
