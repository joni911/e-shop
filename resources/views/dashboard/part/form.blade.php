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
              <option value="{{$data->jenis_kontrak_id ?? ""}}">{{$data->jkn ?? "Pilih Kontrak"}}</option>
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
            <option value="{{$data->jenis_pegadaan_id ?? ""}}">{{$data->jpn ?? "Pilih Jenis Pengadaan"}}</option>
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
            <option value="{{$data->metode_pengadaan_id ?? ""}}">{{$data->mpn ?? "Pilih Metode Pengadaan"}}</option>

            @forelse ($metode as $m)
                <option value="{{$m->id}}">{{$m->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
        <div class="form-group">
          <label for="">K\L\PD</label>
          <input type="text" class="form-control" name="klpd" id="" aria-describedby="helpId" placeholder="" value="{{$data->KLPD ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Lembaga</small>
        </div>
        <div class="form-group">
          <label for="">Lokasi Pekerjaan</label>
          <input type="text" class="form-control" name="lokasi" id="" aria-describedby="helpId" placeholder="" value="{{$data->lokasi_pekerjaan ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Sumber Dana</label>
          <input type="text" class="form-control" name="dana" id="" aria-describedby="helpId" placeholder="" value="{{$data->sumber_dana ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Satuan Kerja</label>
          <input type="text" class="form-control" name="satuan_kerja" id="" aria-describedby="helpId" placeholder="" value="{{$data->satuan_kerja ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Lokasi Pekerjaan</small>
        </div>
        <div class="form-group">
          <label for="">Tanggal Anggaran</label>
          <input type="date" class="form-control" name="tanggal" id="" aria-describedby="helpId" placeholder="" value="{{$data->tahun_anggaran ?? ""}}">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Nilai Anggaran</label>
          <input type="number" class="form-control" name="nilai" id="" aria-describedby="helpId" placeholder="" value="{{$data->nilai_pagu ?? 0}}">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Nilai HPS</label>
          <input type="number" class="form-control" name="hps" id="" aria-describedby="helpId" placeholder="" value="{{$data->hps ?? 0}}">
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for="">Status Pengadaan</label>
          <select class="form-control form-control-sm" name="status" id="status">
            <option value="{{$data->status_tender_id ?? ""}}">{{$data->stn ?? "Pilih Status Pengadaan"}}</option>
            @forelse ($status as $s)
                <option value="{{$s->id}}">{{$s->nama}}</option>
            @empty
                <option value="">Pilihan Kosong</option>
            @endforelse
          </select>
        </div>
    </div>
