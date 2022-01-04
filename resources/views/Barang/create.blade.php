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

        <form action="{{ route('barang.store') }}" enctype="multipart/form-data" method="post">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id='nama' name='nama' placeholder="Masukkan nama Barang">
            </div>
            <div class="form-group">
                <label for="katagori">Katagori</label>

                  <select class="form-control" name="katagori" id="katagori">
                    @foreach ($katagori as $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id='harga' name='harga' placeholder="Masukkan nama Barang">
            </div>
            <div class="form-group">
                <label for="harga">Jumlah</label>
                <input type="number" class="form-control" id='jumlah' name='jumlah' placeholder="Masukkan nama Barang">
            </div>
            <div class="form-group">
              <label for="">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="" rows="4"></textarea>
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
