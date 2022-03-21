@include('perubahan.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Perubahan</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Perubahan</small>
        </div>

    </div>
