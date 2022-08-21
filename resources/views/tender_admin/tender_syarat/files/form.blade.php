<form action="{{ route('tender_persyaratan_file.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="card-body">
    <div class="form-group">
        <label for="">Nama File</label>
        <input type="text"
        class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$file->nama ?? ""}}">
        <input type="text"
        class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$persyaratan->id ?? ""}}" hidden>
        <small id="helpId" class="form-text text-muted">Masukkan Nama File</small>
    </div>
    <div class="form-group">
      <label for="">File</label>
      <input type="file" class="form-control-file" name="file" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
</div>
    <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
