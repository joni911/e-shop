@include('jenis_kontrak.part.alert')

    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Tender</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Tender</small>
        </div>
        <div class="form-group">
          <label for="">Jenis Kontrak</label>
          <select class="form-control form-control-sm" name="jk" id="jk">
            @forelse ($kontrak as $k)
                <option value="{{$k->id}}">{{$k->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
        <div class="form-group">
          <label for="">Jenis Pengadaan</label>
          <select class="form-control form-control-sm" name="jp" id="jp">
            @forelse ($pengadaan as $p)
                <option value="{{$p->id}}">{{$p->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
        <div class="form-group">
          <label for="">Metode Pengadaan</label>
          <select class="form-control form-control-sm" name="mp" id="mp">
            @forelse ($metode as $m)
                <option value="{{$m->id}}">{{$m->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
        <div class="form-group">
          <label for="">K\L\PD</label>
          <input type="text" class="form-control" name="klpd" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Lembaga</small>
        </div>
        <div class="form-group">
          <label for="">Lokasi Pekerjaan</label>
          <input type="text" class="form-control" name="lokasi" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Sumber Dana</label>
          <input type="text" class="form-control" name="dana" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Satuan Kerja</label>
          <input type="text" class="form-control" name="satuan_kerja" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Tanggal Anggaran</label>
          <input type="date" class="form-control" name="tanggal" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Nilai Anggaran</label>
          <input type="number" class="form-control" name="nilai" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Nilai HPS</label>
          <input type="number" class="form-control" name="hps" id="" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Status Pengadaan</label>
          <select class="form-control form-control-sm" name="status" id="status">
            @forelse ($status as $s)
                <option value="{{$s->id}}">{{$s->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
    </div>
