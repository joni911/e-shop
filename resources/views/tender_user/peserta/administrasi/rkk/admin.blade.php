
@include('tender_admin.part.alert')
<input type="text" name="tender_id" value="{{$data->id}}" hidden>
<input type="text" name="peserta" value="{{$peserta->id}}" hidden>

<div class="form-group">
<label for="">Elemen SMKK </label>
    <input id='files' type="file" class="form-control-file" name="smkk" id="" placeholder="Isi File Untuk Update File" aria-describedby="fileHelpId"
    accept=".pdf" required
    >
    <span>Jenis File Yang Bisa Di Upload : PDF</span>
{{-- <p>{{$tf}}</p> --}}
</div>
<div class="form-group">
  <label for="">Pakta Komitmen Keselamatan Konstruksi</label>
  <input type="file" class="form-control-file" name="komitmen" id="" placeholder="" aria-describedby="fileHelpId">
  <small id="fileHelpId" class="form-text text-muted">Jenis File Yang Bisa Di Upload : PDF</small>
</div>


