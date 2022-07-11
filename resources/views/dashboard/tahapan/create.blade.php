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

        <form action="{{ route('tahapan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('tender_admin.tahapan.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          <a name="" id="" class="btn btn-success" href="{{ route('tender_admin.syarat', [$data->id]) }}" role="button">Selesai</a>

          </div>
        </form>

        <div class="card-header">
            <h3 class="card-title">Daftar Tender {{$data->nama}}</h3>
        </div>

        @include('tender_admin.tahapan.table')

    </div>
</body>

@stop

@section('css')

@stop

@section('js')

@stop
