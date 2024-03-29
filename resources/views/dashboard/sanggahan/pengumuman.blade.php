@extends('adminlte::page')

@section('title', 'Tender')

@section('content_header')



@stop

@section('content')

<body>
    @include('global.alert')
    <div class="container-fluid">
        <h2 class="text-center">Sanggah Banding </h2>
        <p>Bagi Peserta yang ingin mengecek hasil evalusi bisa membuka file dibawah</p>
        <div class="container text-center">
            <x-adminlte-modal id="modalPurple" title="Dokumen Berita Acara Evaluasi" theme="warning" icon="fas fa-file"
                size='lg' disable-animations>
                <iframe src="https://drive.google.com/file/d/1_xsXiFa1pvIZa2lRRslC7b_Iy8JfF42b/preview" frameborder="0"
                    scrolling="no" style="overflow:hidden;height:480px;width:100%" height="480px" width="100%"></iframe>
            </x-adminlte-modal>
            {{-- Example button to open modal --}}
            <x-adminlte-button label="Buka Berita Acara Evaluasi" data-toggle="modal" data-target="#modalPurple"
                class="bg-warning" />
        </div>
        <p>
            Untuk Masa Sanggah Banding akan di lakukan pada tgl 23 Nopember 2022 bisa di akses di link di bawah jika
            waktu sanggah banding sudah di buka maka peserta dapat mengakses form di bawah ini
        </p>
        @if ($sanggah)
        <h2 class="text-center">Sanggahan</h2>
        <p>{!!$sanggah->keterangan!!}</p>
        <div class="container text-center">
            {{-- Minimal --}}
            <x-adminlte-modal id="modalMin" title="Minimal" theme="success" size="lg">
                <object data="/{{$sanggah->file}}" frameborder="0" scrolling="no"
                    style="overflow:hidden;height:480px;width:100%" height="480px" width="100%"></object>
            </x-adminlte-modal>
            {{-- Example button to open modal --}}
            <x-adminlte-button label="Buka File Sanggahan" theme="success" data-toggle="modal" data-target="#modalMin" />

            <x-adminlte-modal id="modalCustom" title="Hapus Sanggahan" size="sm" theme="danger" icon="fas fa-bell"
                v-centered static-backdrop scrollable>
                <p>Apakah anda yakin menghapus sanggahan anda?</p>
                <x-slot name="footerSlot">
                    <form method="POST" action="{{ route('sanggahan.destroy', $sanggah->id) }}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn btn-danger btn-flat show_confirm" data-toggle="tooltip"
                            title='Delete'>Hapus</button>
                    </form>
                    <x-adminlte-button theme="success" label="Batal" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
            {{-- Example button to open modal --}}
            <x-adminlte-button label="Hapus Data" data-toggle="modal" data-target="#modalCustom" class="bg-danger" />


        </div>
        <p class="text-center">Untuk mengedit dokumen silakan hapus dan kirim ulang</p>
        @else
        <form action="{{ route('sanggahan.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            @php
            $config = [
            "height" => "100",
            "toolbar" => [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ],
            ]
            @endphp
            <x-adminlte-text-editor name="keterangan" label="Keterangan *" label-class="text" igroup-size="sm"
                placeholder="Tulis sanggahan disini..." :config="$config" />

            <div class="form-group">
                <label for="">Masukkan File Sanggahan Disini *</label>
                <input type="file" class="form-control-file" required name="file" id="" placeholder=""
                    aria-describedby="fileHelpId">
                {{-- <small id="fileHelpId" class="form-text text-muted">Hasil sanggahan akan di kirim ke </small> --}}

                <input type="text" name="peserta" hidden value="{{$peserta->id}}">
                <input type="text" name="tender" hidden value="{{$data->id}}">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @endif

    </div>

</body>

@stop

@section('css')

@stop

@section('js')
@include('dashboard.part.deletejs')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });

</script>


@stop
