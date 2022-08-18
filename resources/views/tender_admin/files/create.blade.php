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
        @if ($page == 'lihat')
        <form action="{{ route('tender_file.store') }}" enctype="multipart/form-data" method="post">
            @csrf
        @else
        <form action="{{ route('tender_file.update',[$file->id ?? ""]) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
        @endif

            @include('tender_admin.files.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          <a name="" id="" class="btn btn-success" href="{{ route('tender_admin.index') }}" role="button">Selesai</a>

          </div>
        </form>

        <div class="card-header">
            <h3 class="card-title">Daftar Tender {{$data->nama}}</h3>
        </div>

        @include('tender_admin.files.table')

    </div>
</body>

@stop

@section('css')

@stop

@section('js')

@stop
