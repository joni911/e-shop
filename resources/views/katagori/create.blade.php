@extends('adminlte::page')

@section('title', 'Create Katagori')

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
        <form action="{{ route('katagori.store') }}" enctype="multipart/form-data" method="post">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama katagori</label>
              <input type="text" class="form-control" id='nama' name='nama' placeholder="Masukkan nama Barang">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan katagori</label>
                <input type="text" class="form-control" id='keterangan' name='keterangan' placeholder="Masukkan nama Barang">
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