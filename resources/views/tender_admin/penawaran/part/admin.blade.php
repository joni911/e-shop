@if (!$penawaran)
    <form action="{{ route('penawaran.store') }}" enctype="multipart/form-data" method="post">
@else
    <form action="{{ route('penawaran.update',[$penawaran->id]) }}" enctype="multipart/form-data" method="post">
    @method('PUT')
@endif
    @csrf
    @include('tender_admin.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Judul</label>
          <input type="text"
            class="form-control" name="judul" id="" aria-describedby="helpId" placeholder="" value="{{$penawaran->judul ?? ""}}">
            <input type="text"
            class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$tender->id ?? ""}}" hidden>
        </div>
        <div class="form-group">
          <label for="">Anggaran</label>
          <input type="number"
            class="form-control" name="anggaran" id="" aria-describedby="helpId" placeholder="" value="{{$penawaran->anggaran ?? ""}}">
        </div>
        <div class="form-group">
          <label for="">HPS</label>
          <input type="numeber"
            class="form-control" name="hps" id="" aria-describedby="helpId" placeholder="" value="{{$penawaran->hps ?? ""}}">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
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
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                ]
            @endphp
        <x-adminlte-text-editor name="penjelasan" label="Detail Persyaratan" label-class="text-default"
        igroup-size="sm" placeholder="Write some text..." :config="$config">
        {!!$penawaran->penjelasan ?? ""!!}
        </x-adminlte-text-editor>
    </div>


    <!-- /.card-body -->

    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a name="" id="" class="btn btn-success" href="{{ route('tender_admin.index') }}" role="button">Selesai</a>

    </div>
</form>
<div class="card-header">
    <h3 class="card-title">Tambah File Penawaran {{$tender->nama}}</h3>
</div>

@include('tender_admin.penawaran.part.form')

