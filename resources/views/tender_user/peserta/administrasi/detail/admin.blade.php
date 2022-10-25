
@include('tender_admin.part.alert')
<input type="text" name="default" value="{{$data->id}}" hidden>
<input type="text" name="peserta" value="{{$peserta->id}}" hidden>
@forelse ($admin as $tf)
          <div class="form-group">
            <label for="">{{$tf->nama}}</label>
            <input id='files' type="file" class="form-control-file" name="{{$tf->id}}" id="" placeholder="Isi File Untuk Update File" aria-describedby="fileHelpId"
            accept=".pdf" required
            >
            <input type="text" name="1{{$tf->id}}" value="{{$tf->tender_id}}" hidden>
            <input type="text" name="2{{$tf->id}}" value="{{$tf->nama}}" hidden>
            <input type="text" name="3{{$tf->id}}" value="{{$tf->id}}" hidden>
            <span>{{$tf->keterangan ?? ""}}</span>
            {{-- <p>{{$tf}}</p> --}}
          </div>
        @empty

@endforelse


