@extends('adminlte::page')

@section('title', 'Create Barang')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Barang</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('photo.simpan') }}" enctype="multipart/form-data" method="post">
            @csrf
          <div class="form-group">
            <label for="">Foto Barang</label>
            <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">Help text</small>
          </div>
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
