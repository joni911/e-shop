@include('tender_user.peserta.part.alert')
    <div class="card-body">
        <div class="form-group">
            <label for="">Izin Perusahaan *</label>
            <input type="text"
              class="form-control" required name="izin" id="" aria-describedby="helpId" placeholder="" value="{{$data->izin ?? ""}}">
              <input type="text"
              class="form-control" required name="id" hidden id="" aria-describedby="helpId" placeholder="" value="{{$data->id ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Izin Perusahaan NIB IUJK </small>
        </div>
        <div class="form-group">
            <label for="">Nomor Izin Perusahaan *</label>
            <input type="text"
              class="form-control" required name="nomor_izin" id="" aria-describedby="helpId" placeholder="" value="{{$data->nomor_izin ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Nomor Surat Izin Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Berlaku Sampai *</label>
            <input type="date"
              class="form-control" required name="izin_berlaku" id="" aria-describedby="helpId" placeholder="" value="{{$data->izin_berlaku ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Masa Berlaku Izin Usaha jika Izin Seumur hidup pakai sampai 2050</small>
          </div>
          <div class="form-group">
            <label for="">Instansi Pemberi *</label>
            <input type="text"
              class="form-control" required name="instansi_pemberi" id="" aria-describedby="helpId" placeholder="" value="{{$data->instansi_pemberi ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Instansi Pemeberi Izin</small>
          </div>
          <div class="form-group">
            <label for="">Kualifikasi *</label>
            <input type="text"
              class="form-control" required name="kualifikasi" id="" aria-describedby="helpId" placeholder="" value="{{$data->kualifikasi ?? ""}}">

            <small id="helpId" class="form-text text-muted">Masukkan Jenis Kualifikasi Perusahaan</small>
          </div>
          <div class="form-group">
            <label for="">Klasifikasi *</label>
            <textarea class="form-control" required name="klasifikasi" id="" rows="3">{{$data->klasifikasi ?? ""}}</textarea>
          </div>
        <div class="form-group">
          <label for="">Nama Perusahaan *</label>
          <input type="text"
            class="form-control" required name="nama_pt" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_pt ?? ""}}">

          <small id="helpId" class="form-text text-muted">Masukkan Nama Perusahaan</small>
        </div>
        <h3>Akta</h3>
        <div class="form-group">
            <label for="">Nomor *</label>
            <input type="number"
              class="form-control" required name="no_akta" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_akta ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Surat *</label>
            <input type="date"
              class="form-control" required name="tgl_akta" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_akta ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Notaris *</label>
            <input type="text"
              class="form-control" required name="notaris" id="" aria-describedby="helpId" placeholder="" value="{{$data->notaris ?? ""}}">
          </div>
          <h3>Akta Terbaru</h3>
          <div class="form-group">
            <label for="">Nomor *</label>
            <input type="number"
              class="form-control" required name="no_aktab" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_aktab ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Tanggal Surat *</label>
            <input type="date"
              class="form-control" required name="tgl_aktab" id="" aria-describedby="helpId" placeholder="" value="{{$data->tgl_aktab ?? ""}}">
          </div>
          <div class="form-group">
            <label for="">Notaris *</label>
            <input type="text"
              class="form-control" required name="notaris_b" id="" aria-describedby="helpId" placeholder="" value="{{$data->notaris_b ?? ""}}">
          </div>
          {{-- <h3>NPWP</h3>
        <div class="form-group">
            <label for="">NPWP *</label>
            <input type="text"
              class="form-control" required name="NPWP" id="" aria-describedby="helpId" placeholder="" value="{{$data->NPWP ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan No NPWP</small>
          </div>
          <div class="form-group">
            <label for="">Nama Pemilik NPWP *</label>
            <input type="text"
              class="form-control" required name="nama_npwp" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama_npwp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Pemilik NPWP</small>
          </div> --}}
          <h2>Bukti KSWP</h2>
          <div class="form-group">
            <label for="">NPWP *</label>
            <input type="text"
              class="form-control" required name="kswp_npwp" id="" aria-describedby="helpId" placeholder="" value="{{$data->kswp_npwp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan No NPWP</small>
          </div>
          <div class="form-group">
            <label for="">Nama Pemilik NPWP *</label>
            <input type="text"
              class="form-control" required name="kswp_nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->kswp_nama ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nama Pemilik NPWP</small>
          </div>
          <h2>Data Perusahaan</h2>
          <div class="form-group">
            <label for="">No HP *</label>
            <input type="text"
              class="form-control" required name="no_hp" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_hp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Whatsapp Perusahaan</small>
          </div>
          {{-- <div class="form-group">
            <label for="">No Telephone *</label>
            <input type="text"
              class="form-control" required name="no_tlp" id="" aria-describedby="helpId" placeholder="" value="{{$data->no_tlp ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Nomor Telephone Perusahaan</small>
          </div> --}}
          <div class="form-group">
            <label for="">Alamat *</label>
            <textarea class="form-control" required name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
          <div class="form-group">
            <label for="">Email *</label>
            <input type="email"
              class="form-control" required name="email" id="" aria-describedby="helpId" placeholder="" value="{{$data->email ?? ""}}">
            <small id="helpId" class="form-text text-muted">Masukkan Email Perusahaan</small>
          </div>
          <h2>File Upload</h2>
        @forelse ($file as $tf)
          @if ($tf->nama)
          <div class="form-group">
            <label for="">{{$tf->nama}} *</label>
            <input type="file"
            accept=".jpg, .jpeg, .png, .pdf, .pdf, .zip, .rar, .7z"
            class="form-control-file" required name="{{$tf->id}}" id="" placeholder="Isi File Untuk Update File" aria-describedby="fileHelpId">
            <small id="helpId" class="form-text text-muted">Masukkan File {{$tf->keterangan}}</small>

          </div>
          @else
          <div class="form-group">
            <label for="">{{$tf->nama_file}} *</label>
            <input type="file"
            accept=".jpg, .jpeg, .png, .pdf, .pdf, .zip, .rar, .7z"
            class="form-control-file" required name="{{$tf->id}}" id="" placeholder="Isi File Untuk Update File" aria-describedby="fileHelpId">
            <a href="/{{$tf->file}}">Download File {{$tf->nama_file}}</a>
          </div>
          @endif
        @empty

        @endforelse

    </div>
