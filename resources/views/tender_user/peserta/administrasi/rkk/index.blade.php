@extends('adminlte::page')

@section('title', 'Pendaftaran Peserta Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Rencana Keselamatan Konstruksi (RKK) </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        @if (!$list)
        <form action="{{ route('file_teknis.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-md">
                @include('tender_user.peserta.administrasi.rkk.admin')
            </div>
            {{-- @include('tender_user.peserta.part.eform') --}}
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
                <a name="" id="" class="btn btn-success" href="{{ route('peralatan.show', [$peserta->id]) }}" role="button">Berikutnya</a>
        </div>
        </form>
        @else
                <a name="" id="" class="btn btn-success" href="{{ route('peralatan.show', [$peserta->id]) }}" role="button">Berikutnya</a>

        @endif

        @if ($list)
            <div class="col-md">
                @include("tender_user.peserta.administrasi.rkk.list")
            </div>
            <div class="col-md">
            <p>Untuk Upload Ulang harap hapus file dahulu</p>
            <form action="{{ route('file_teknis.destroy' , $list->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}

                        <div class="modal-footer no-border">
                            {{-- <button type="button" class="btn btn-info" data-dismiss="modal">No</button> --}}
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
            </form>
        </div>
        @endif
      </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
