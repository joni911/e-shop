@extends('adminlte::page')

@section('title', 'Pendaftaran Peserta Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Tender {{$data->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        @if ($list->isEmpty())
        <form action="{{ route('administrasi_list.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-md">
                @include('tender_user.peserta.administrasi.detail.admin')
            </div>
            {{-- @include('tender_user.peserta.part.eform') --}}
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            {{-- <a name="" id="" class="btn btn-success" href="{{ route('administrasi_list.show', [$data->id]) }}" role="button">Berikutnya</a> --}}
            <a name="" id="" class="btn btn-success" href="{{ route('pengalaman.show', [$peserta->id]) }}" role="button">Berikutnya</a>
          </div>
        </form>
        @else
            <a name="" id="" class="btn btn-success" href="{{ route('pengalaman.show', [$peserta->id]) }}" role="button">Berikutnya</a>
        @endif
        <div class="col-md">
            @include("tender_user.peserta.administrasi.detail.list")
        </div>
        <div class="col-md">
            <p>Untuk Upload Ulang harap hapus file dahulu</p>
            <form action="{{ route('administrasi_list.destroy' , $peserta->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}

                        <div class="modal-footer no-border">
                            {{-- <button type="button" class="btn btn-info" data-dismiss="modal">No</button> --}}
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
            </form>
        </div>
      </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
