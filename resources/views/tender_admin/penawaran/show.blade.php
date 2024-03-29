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
        <div class="card-body">
            <p>Nilai HPS        = @currency($data->hps ?? "")</p>
            {{-- <p>Niali Anggaran   = @currency($data->anggaran ?? "")</p> --}}
            <p>Penjelasan : </p>
            <p>{!!$data->penjelasan ?? ""!!}</p>
        </div>


        @if (!$pp)
            <form action="{{ route('penawaran_peserta.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="">Penawaran *</label>
                    <input type="number"
                        class="form-control" required name="penawaran" id="" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Masukkan nominal penawaran anda disini!</small>
                    </div>
                    @forelse ($data->penawaran_file as $no => $pf)
                    <div class="form-group">
                        <label for="">{{$pf->nama}} *</label>
                        <input required type="file" class="form-control-file" name="{{$pf->id}}" id="" placeholder="" aria-describedby="fileHelpId">
                        <small id="fileHelpId" class="form-text text-muted">{{$pf->keterangan}}</small>
                    </div>

                    @empty

                    @endforelse

                    <input type="text" class="form-control" name="id" hidden value="{{$tender->id}}" id="" aria-describedby="helpId" placeholder="">

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {{-- <a name="" id="" class="btn btn-success" href="{{ route('tender_file.show',[$syarat->id]) }}" role="button">Selesai</a> --}}

                </div>
            </form>
        @else
        <?php
            $no = 1;
        ?>
        <div class="card-body">
            <p>Penawaran : @currency($pp->penawaran)</p>
            @forelse ($pp->penawaran_peserta_file as $item)

                <p><a href="/{{$item->file}}" download="{{$item->nama}}">{{$no++}}. {{$item->nama}}</a></p>

            @empty

            @endforelse
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
