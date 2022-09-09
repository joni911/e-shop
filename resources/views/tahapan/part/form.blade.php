@include('tahapan.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Tahapan</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
           <small id="helpId" class="form-text text-muted">Masukkan Nama Tahapan</small>
        </div>
        <div class="form-group">
            <label for="">Tanggal Mulai</label>
            <input type="date"
                class="form-control form-control-sm" name="awal" id="" aria-describedby="helpId" placeholder="" value="{{$data->mulai ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Tanggal Mulai Tahapan</small>
          </div>
          <div class="form-group">
              <label for="">Tanggal Berakhir</label>
              <input type="date"
                  class="form-control form-control-sm" name="akhir" id="" aria-describedby="helpId" placeholder="" value="{{$data->akhir ?? ""}}">
              <small id="helpId" class="form-text text-muted">Masukkan Tanggal Akhir Tahapan</small>
            </div>
            <div class="form-group">
              <label for="">Jenis</label>
              <select class="form-control" name="status" id="">
                <option value="{{$data->status}}">
                    @switch($data->status)
                        @case(1)
                            Masa Pendaftaran
                            @break
                        @case(2)
                            Masa Pembukaan File

                            @break
                        @case(3)
                            Pengumuman Pemenang

                            @break
                        @case(4)
                            Upload File
                            @break
                        @default
                            Biasa
                    @endswitch
                </option>
                <option value="0">Biasa</option>
                <option value="1">Masa Pendaftaran</option>
                <option value="2">Masa Pembukaan File</option>
                <option value="3">Pengumuman Pemenang</option>
                <option value="4">Masa Upload File</option>
              </select>
            </div>
        <div class="form-group">
          <label for="">Keterangan Edit</label>
          <textarea class="form-control" name="keterangan" id="" rows="3">{{$data->keterangan ?? "" ?? ""}}</textarea>
        </div>
    </div>

