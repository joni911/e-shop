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

        <table class="table">
            <tbody>
                  <?php
                      $int = 0;
                  ?>
                  <tr>
                  @foreach ($barang->barang_photo as $b)
                      <td><img src="/{{$b->foto}}" alt="" width="120" height="160" srcset=""></td>
                  @endforeach
                </tr>
            </tbody>
        </table>
        <form action="{{ route('photo.simpan') }}" enctype="multipart/form-data" method="post">
            @csrf
          <input type="text" class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$barang->id}}" hidden>
          <div class="form-group">
            <label for="">Foto Barang</label>
            <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId">
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-warning" href="{{ route('barang.index') }}" role="button">Selesai</a>
          </div>
        </form>
      </div>


</body>

@stop

@section('css')

@stop

@section('js')

@stop
