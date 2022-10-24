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

        <form action="{{ route('peserta.update',[$data->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            @include('tender_user.peserta.part.form')
            {{-- @include('tender_user.peserta.part.eform') --}}
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a name="" id="" class="btn btn-success" href="{{ route('pengalaman.show', [$data->id]) }}" role="button">Berikutnya</a>
          </div>
        </form>
      </div>

</body>

@stop

@section('css')

@stop

@section('js')

@stop
