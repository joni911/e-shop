@include('tender.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Tahapan</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="">
            <input type="text"
            class="form-control" name="id" id="" aria-describedby="helpId" placeholder="" value="{{$data->id ?? ""}}" hidden>
            <small id="helpId" class="form-text text-muted">Masukkan Nama Tahapan</small>
        </div>
        <div class="form-group">
            <label for="">Tanggal Mulai</label>
            <input type="date"
                class="form-control form-control-sm" name="awal" id="" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted">Masukkan Tanggal Mulai Tahapan</small>
          </div>
          <div class="form-group">
              <label for="">Tanggal Berakhir</label>
              <input type="date"
                  class="form-control form-control-sm" name="akhir" id="" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-muted">Masukkan Tanggal Akhir Tahapan</small>
            </div>
    </div>

