@include('tender.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Persyaratan</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="">
            <input type="text"
            class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$syarat->id ?? ""}}" hidden>
            <small id="helpId" class="form-text text-muted">Masukkan Nama Tahapan</small>
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
        <x-adminlte-text-editor name="content" label="Detail Persyaratan" label-class="text-default"
        igroup-size="sm" placeholder="Write some text..." :config="$config">

        </x-adminlte-text-editor>
    </div>

