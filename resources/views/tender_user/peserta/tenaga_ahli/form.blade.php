@include('global.alert')
    <div class="card-body">

        <div class="form-group">
          <label for="">Nama</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->pekerjaan ?? ""}}">
            <input type="text"
            class="form-control" name="id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->id ?? $peserta->id}}">
            <input type="text"
            class="form-control" name="tender_id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->tender_id ?? $peserta->tender_id}}">
        </div>
        <div class="form-group">
            <label for="">Tanggal Lahir</label>
            <input type="date"
              class="form-control" name="tgl_lahir" id="" aria-describedby="helpId" placeholder="" value="{{$data->lokasi ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Jenis Klamin</label>
              <select class="form-control" name="jk" id="">
                <option value="">Pilih Jenis Klamin</option>
                <option value="Laki - Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea class="form-control" name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">Negara Asal</label>
            <input type="text"
              class="form-control" name="negara" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_hp ?? ""}}">
          </div>

          <div class="form-group">
            <label for="">Jabatan</label>
            <input type="text"
              class="form-control" name="jabatan" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_kontrak ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Pengalaman</label>
            <input type="text"
              class="form-control" name="pengalaman" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_kontrak ?? ""}}">
            <small id="helpId" class="form-text text-muted">Lama Berapa Tahun Dalam Bekerja</small>
          </div>

          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="">
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="" rows="3">{{$data->keterangan ?? ""}}</textarea>
            <small id="helpId" class="form-text text-muted">Deskripsikan Pengalaman Kerja Petugas Disini</small>
          </div>


    </div>
