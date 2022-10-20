@extends('adminlte::page')

@section('title', 'Pendaftaran Pengalaman Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Penglaman Tender</h3>
        </div>
        <p class="form-text">
            Masukkanlah Pengalaman Pengalaman dalam pengadaan barang jasa ataupun pembangunan yang telah dilakukan perusahaan anda
        </p>
        <!-- /.card-header -->
        <!-- form start -->

        {{-- @if ($status == 'show') --}}

        <form action="{{ route('pengalaman.store') }}" enctype="multipart/form-data" method="post">
            @csrf
        {{-- @else
        <form action="{{ route('pengalaman.update',$data->id) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
        @endif --}}
            @include('tender_user.peserta.pengalaman.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            @if ($list != null)
            <a name="" id="" class="btn btn-success" href="{{ route('tenagaahli.show', [$peserta->id]) }}" role="button">Selesai</a>
            @endif
          </div>
        </form>
    </div>

    <div class="card card-primary">
        @include('tender_user.peserta.pengalaman.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
