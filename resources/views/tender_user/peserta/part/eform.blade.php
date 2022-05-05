@include('tender_user.peserta.part.alert')
    <div class="card-body">
        <div class="form-group">
          <label for="">Nama Perusahaan</label>
          <input type="text"
            class="form-control" name="nama_pt" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_perusahaan ?? ""}}">
            <input type="text"
            class="form-control" name="id" hidden id="" aria-describedby="helpId" placeholder="" value="{{$data->id ?? ""}}">
          <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
        </div>
        <div class="form-group">
            <label for="">NPWP</label>
            <input type="text"
              class="form-control" name="NPWP" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_perusahaan ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">No HP</label>
            <input type="text"
              class="form-control" name="no_hp" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_hp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Whatsapp Perusahaan</small>
          </div>
          {{-- <div class="form-group">
            <label for="">No Telephone</label>
            <input type="text"
              class="form-control" name="no_tlp" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_tlp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Telephone Perusahaan</small>
          </div> --}}
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea class="form-control" name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">Penawaran</label>
            <input type="number"
              class="form-control" name="penawaran" id="" aria-describedby="helpId" placeholder="" value="{{$data->penawaran ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Telephone Perusahaan</small>
          </div>
          @forelse ($data->tender->tender_file as $tf)
            <div class="form-group">
              <label for="">{{$tf->nama}}</label>
              <input type="file" class="form-control-file" name="{{$tf->id}}" id="" placeholder="" aria-describedby="fileHelpId">
              <small id="fileHelpId" class="form-text text-muted">{{$tf->keterangan}}</small>
            </div>
          @empty

          @endforelse

    </div>
