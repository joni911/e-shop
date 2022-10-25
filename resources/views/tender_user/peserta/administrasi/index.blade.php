@extends('adminlte::page')

@section('title', 'Create Penawaran')

@section('content_header')



@stop

@section('content')

<body>

    @include('global.alert')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Penawaran {{$tender->nama}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{-- {{$penawaran}} --}}

        @include('tender_user.peserta.administrasi.admin')

        <div class="card-header">
            <h3 class="card-title">Daftar File Penawaran {{$tender->nama}}</h3>
        </div>
        <div class="card-body">
            <?php
                $no = 1;
            ?>
            @if ($file)
                @forelse ($file as $f)
                <p>{{$no++}}. {{$f->nama}} {{$f->keterangan}}
                    <form action="{{ route('administrasi.destroy' , $f->id)}}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}

                        <div class="modal-footer no-border">
                            {{-- <button type="button" class="btn btn-info" data-dismiss="modal">No</button> --}}
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </p>
                @empty

                @endforelse
            @endif



        </div>




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
