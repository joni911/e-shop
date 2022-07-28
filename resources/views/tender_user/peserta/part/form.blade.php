@include('tender_user.peserta.part.alert')
    <div class="card-body">
        <div class="form-group">
            <label for="">Izin Perusahaan</label>
            <input type="text"
              class="form-control" name="izin" id="" aria-describedby="helpId" placeholder="" value="{{$data->izin ?? ""}}">
              <input type="text"
              class="form-control" name="id" hidden id="" aria-describedby="helpId" placeholder="" value="{{$data->id ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
        </div>
        <div class="form-group">
            <label for="">Nomor Surat</label>
            <input type="text"
              class="form-control" name="nomor_izin" id="" aria-describedby="helpId" placeholder="" value="{{$data->nomor_izin ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Berlaku Sampai</label>
            <input type="date"
              class="form-control" name="izin_berlaku" id="" aria-describedby="helpId" placeholder="" value="{{$data->izin_berlaku ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Instansi Pemberi</label>
            <input type="text"
              class="form-control" name="instansi_pemberi" id="" aria-describedby="helpId" placeholder="" value="{{$data->instansi_pemberi ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Kualifikasi</label>
            <input type="text"
              class="form-control" name="kualifikasi" id="" aria-describedby="helpId" placeholder="" value="{{$data->kualifikasi ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Klasifikasi</label>
            <textarea class="form-control" name="klasifikasi" id="" rows="3"></textarea>
          </div>
        <div class="form-group">
          <label for="">Nama Perusahaan</label>
          <input type="text"
            class="form-control" name="nama_pt" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_pt ?? ""}}">

          <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
        </div>
        <h3>Akta</h3>
        <div class="form-group">
            <label for="">Nomor</label>
            <input type="number"
              class="form-control" name="no_akta" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_akta ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Surat</label>
            <input type="date"
              class="form-control" name="tgl_akta" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_akta ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Notaris</label>
            <input type="text"
              class="form-control" name="notaris" id="" aria-describedby="helpId" placeholder="" value="{{$data->notaris ?? ""}}">
          </div>
          <h3>Akta Terbaru</h3>
          <div class="form-group">
            <label for="">Nomor</label>
            <input type="number"
              class="form-control" name="no_aktab" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_aktab ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Surat</label>
            <input type="date"
              class="form-control" name="tgl_aktab" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_aktab ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Notaris</label>
            <input type="text"
              class="form-control" name="notaris_b" id="" aria-describedby="helpId" placeholder="" value="{{$data->notaris_b ?? ""}}">
          </div>
          <h3>NPWP</h3>
        <div class="form-group">
            <label for="">NPWP</label>
            <input type="text"
              class="form-control" name="NPWP" id="" aria-describedby="helpId" placeholder="" value="{{$data->NPWP ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan No NPWP</small>
          </div>
          <div class="form-group">
            <label for="">Nama Pemilik NPWP</label>
            <input type="text"
              class="form-control" name="nama_npwp" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_npwp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Pemilik NPWP</small>
          </div>
          <h2>Bukti KSWP</h2>
          <div class="form-group">
            <label for="">NPWP</label>
            <input type="text"
              class="form-control" name="kswp_npwp" id="" aria-describedby="helpId" placeholder="" value="{{$data->kswp_npwp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan No NPWP</small>
          </div>
          <div class="form-group">
            <label for="">Nama Pemilik NPWP</label>
            <input type="text"
              class="form-control" name="kswp_nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->kswp_nama ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Pemilik NPWP</small>
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
            <textarea class="form-control" name="alamat" id="" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="">Penawaran</label>
            <input type="number"
              class="form-control" name="penawaran" id="" aria-describedby="helpId" placeholder="" value="{{$data->penawaran ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Telephone Perusahaan</small>
          </div>

          @forelse ($data->tender_file as $tf)
            <div class="form-group">
              <label for="">{{$tf->nama}}</label>
              <input type="file" class="form-control-file" name="{{$tf->id}}" id="" placeholder="" aria-describedby="fileHelpId">
              <small id="fileHelpId" class="form-text text-muted">{{$tf->keterangan}}</small>
            </div>
          @empty

          @endforelse

    </div>
