@extends('adminlte::page')

@section('title', 'Edit Jenis Kontrak')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Jenis Kontrak</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('jenis_kontrak.update', [$data->id]) }}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
            @include('jenis_kontrak.part.form')
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
