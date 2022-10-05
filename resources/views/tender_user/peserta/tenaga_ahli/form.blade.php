@include('global.alert')
    <div class="card-body">

        <div class="form-group">
          <label for="">Nama *</label>
          <input type="text"
            class="form-control" required name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
            <input type="text"
            class="form-control" required name="id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->id ?? $peserta->id}}">
            <input type="text"
            class="form-control" required name="tender_id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->tender_id ?? $peserta->tender_id}}">
        </div>
        <div class="form-group">
            <label for="">Tanggal Lahir *</label>
            <input type="date"
              class="form-control" required name="tgl_lahir" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_lahir ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Jenis Klamin *</label>
              <select class="form-control" required name="jk" id="">
                <option value="{{$data->jk ?? ""}}">{{$data->jk ?? "Pilih Jenis Klamin"}}</option>
                <option value="Laki - Laki">Laki - Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Alamat *</label>
            <textarea class="form-control" required name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">Negara Asal *</label>
            <input type="text"
              class="form-control" required name="negara" id="" aria-describedby="helpId" placeholder="" value="{{$data->negara ?? ""}}">
          </div>

          <div class="form-group">
            <label for="">Jabatan *</label>
            <input type="text"
              class="form-control" required name="jabatan" id="" aria-describedby="helpId" placeholder="" value="{{$data->jabatan ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Pengalaman *</label>
            <input type="text"
              class="form-control" required name="pengalaman" id="" aria-describedby="helpId" placeholder="" value="{{$data->pengalaman ?? ""}}">
            <small id="helpId" class="form-text text-muted">Lama Berapa Tahun Dalam Bekerja</small>
          </div>

          <div class="form-group">
            <label for="">Email *</label>
            <input type="email" class="form-control" required name="email" id="" aria-describedby="emailHelpId" placeholder="" value="{{$data->email ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Keterangan *</label>
            <textarea class="form-control" required name="keterangan" id="" rows="3">{{$data->keterangan ?? ""}}</textarea>
            <small id="helpId" class="form-text text-muted">Deskripsikan Pengalaman Kerja Petugas Disini</small>
          </div>

          <div class="form-group">
            <label for="">Sertifikat Pendukung *</label>
            <input type="file" class="form-control-file" required name="file" id="" placeholder="" aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text text-muted">Mohon Di isi dengan sertifikat yang dapat mendukung keahlian tenaga ahli</small>
          </div>
          <div class="form-group">
            <label for="">Nama Sertifikat *</label>
            <input type="text" class="form-control" required name="nama_file" id="" aria-describedby="helpId" placeholder="">
            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
          </div>
    </div>
