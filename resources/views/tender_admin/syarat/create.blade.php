@extends('adminlte::page')

@section('title', 'Create Syarat')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Syarat {{$syarat->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <form action="{{ route('syarat.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_admin.syarat.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('tender_file.show',[$syarat->id]) }}" role="button">Selesai</a>

          </div>
        </form>

        <div class="card-header">
            <h3 class="card-title">Daftar Syarat {{$syarat->nama}}</h3>
        </div>

        @include('tender_admin.syarat.table')

    </div>
</body>

@stop

@section('css')

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
@stop
