
<form action="{{ route('penawaran_file.store') }}" method="post">
    @csrf
    <div class="card-body">
        <div class="form-group">
          <label for="">Nama File</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="">
            <input type="text"
            class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$tender->id ?? ""}}" hidden>
            <small id="helpId" class="form-text text-muted">Masukkan Nama Tahapan</small>
        </div>
        <div class="form-group">
          <label for="">Keterangan</label>
          <input type="text"
            class="form-control" name="keterangan" id="" aria-describedby="helpId" placeholder="">
        </div>
    </div>
    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>

    </div>
</form>
