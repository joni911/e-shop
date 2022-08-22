@extends('adminlte::page')

@section('title', 'Create Persyaratan')

@section('content_header')



@stop

@section('content')

<body>
    <div class="card card-primary">


       @if ($admin->hak_akses == 'admin')
        <div class="card-header">
            <h3 class="card-title">Tambah Persyaratan {{$tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        
            @include('tender_admin.tender_syarat.part.admin')
       @endif

       @if ($persyaratan)
        <div class="card-header">
            <h3 class="card-title">Daftar File Persyaratan {{$tender->nama}}</h3>
        </div>
        <div class="card-body">
            <h3>{{$persyaratan->judul ?? ""}}</h3>
            <p>{!!$persyaratan->penjelasan ?? ""!!}</p>
            <h5 class="text-center">Data File yang Bisa Di Download</h5>
            @include('tender_admin.tender_syarat.files.table')

        </div>
       @endif



    </div>
</body>

@stop

@section('css')

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
@stop
