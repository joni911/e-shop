@include('global.alert')
    <div class="card-body">

        <div class="form-group">
          <label for="">Pekerjaan *</label>
          <input type="text"
            class="form-control" required name="pekerjaan" id="" aria-describedby="helpId" placeholder="" value="{{$data->pekerjaan ?? ""}}">
            <input type="text"
            class="form-control" required name="id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->id ?? $peserta->id}}">
            <input type="text"
            class="form-control" required name="tender_id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->tender_id ?? $peserta->tender_id}}">
        </div>
        <div class="form-group">
            <label for="">Nilai Kontrak *</label>
            <input type="number"
              class="form-control" required name="nilai_kontrak" id="" aria-describedby="helpId" placeholder="" value="{{$data->nilai_kontrak ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Lokasi *</label>
            <input type="text"
              class="form-control" required name="lokasi" id="" aria-describedby="helpId" placeholder="" value="{{$data->lokasi ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Instansi Pemberi Tugas *</label>
            <input type="text"
              class="form-control" required name="instansi" id="" aria-describedby="helpId" placeholder="" value="{{$data->instansi ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Alamat *</label>
            <textarea class="form-control" required name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">No. Telepon *</label>
            <input type="number"
              class="form-control" required name="no_hp" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_hp ?? ""}}">
          </div>

          <div class="form-group">
            <label for="">No. Kontrak *</label>
            <input type="text"
              class="form-control" required name="no_kontrak" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_kontrak ?? ""}}">
          </div>
        <div class="form-group">
            <label for="">Tanggal Kontrak *</label>
            <input type="date"
              class="form-control" required name="tgl_kontrak" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_kontrak ?? ""}}">

          </div>

          <div class="form-group">
            <label for="">Persentase Pelaksanaan *</label>
            <input type="number"
              class="form-control" required name="presentasi" id="" aria-describedby="helpId" placeholder="" value="{{$data->presentasi ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Selesai Kontrak *</label>
            <input type="date"
              class="form-control" required name="tgl_selesai_kontrak" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_selesai_kontrak ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Serah Terima *</label>
            <input type="date"
              class="form-control" required name="tgl_serah_terima" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_serah_terima ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Keterangan *</label>
            <textarea class="form-control" required name="keterangan" id="" rows="3">{{$data->keterangan ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">File *</label>
            <input type="file"
            accept=".jpg, .jpeg, .png, .xls, .xlsx, .pdf, .doc, .docx, .pdf, .zip, .rar, .7z"
            class="form-control-file" required name="file1" id="" placeholder="" aria-describedby="fileHelpId">
          </div>
          <div class="form-group">
            <label for="">Nama File *</label>
            <input type="text"
              class="form-control" required value="{{$data->nama_file ?? ""}}" name="nama_file" id="" aria-describedby="helpId" placeholder="">
          </div>
    </div>
