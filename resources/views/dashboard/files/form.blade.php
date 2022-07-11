@include('dashboard.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama File</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="">
            <input type="text"
            class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$data->id ?? ""}}" hidden>
            <small id="helpId" class="form-text text-muted">Masukkan Nama File</small>
        </div>
        <div class="form-group">
            <label for="">Keterangan File</label>
            <input type="text"
              class="form-control" name="keterangan" id="" aria-describedby="helpId" placeholder="" value="">
              <small id="helpId" class="form-text text-muted">Masukkan Keterangan</small>
          </div>
    </div>

