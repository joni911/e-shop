@include('jenis_kontrak.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Jenis Kontrak</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Jenis Kontrak</small>
        </div>
    </div>
