@extends('adminlte::page')

@section('title', 'Pendaftaran Pekerjaan Berjalan Tender')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Pekerjaan Berjalan {{$data->tender->nama ?? $peserta->tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        @if ($status == 'show')
        {{-- <p>Show</p>     --}}
        <form action="{{ route('pekerjaan_berjalan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
        @else
        <form action="{{ route('pekerjaan_berjalan.update',$data) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf
        @endif
            @include('tender_user.peserta.pekerjaan_berjalan.form')
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('tender_home.index') }}" role="button">Selesai Pergi Ke Menu Tender</a>
            {{-- <a name="" id="" class="btn btn-success" href="{{ route('tender_home.show', [$peserta->tender_id]) }}" role="button">Selesai</a> --}}
          </div>
        </form>
    </div>
    <div class="card card-primary">
        @include('tender_user.peserta.pekerjaan_berjalan.table')
    </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
