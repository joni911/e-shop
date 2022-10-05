@include('global.alert')
    <div class="card-body">

        <div class="form-group">
          <label for="">Nama Alat *</label>
          <input type="text"
            class="form-control" required name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
            <input type="text"
            class="form-control" required name="id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->id ?? $peralatan->id}}">
            <input type="text"
            class="form-control" required name="tender_id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->tender_id ?? $peralatan->tender_id}}">
        </div>
        <div class="form-group">
            <label for="">Jumlah *</label>
            <input type="number"
              class="form-control" required name="jumlah" id="" aria-describedby="helpId" placeholder="" value="{{$data->jumlah ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Kapasitas *</label>
            <input type="text"
              class="form-control" required name="kapasitas" id="" aria-describedby="helpId" placeholder="" value="{{$data->kapasitas ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Merk *</label>
            <input type="text"
              class="form-control" required name="merk" id="" aria-describedby="helpId" placeholder="" value="{{$data->merk ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Tahun Pembelian *</label>
            <input type="number"
              class="form-control" required name="tahun" id="" aria-describedby="helpId" placeholder="" value="{{$data->tahun ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Kepemilikan *</label>
              <select class="form-control" required name="kepemilikan" id="">
                <option value="{{$data->kepemilikan ?? ""}}">{{$data->kepemilikan ?? "Pilih Kepemilikan Barang"}}</option>
                <option value="Sewa">Sewa</option>
                <option value="Miliki Sendiri">Milik Sendiri</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Kondisi *</label>
              <select class="form-control" required name="kondisi" id="">
                <option value="{{$data->kondisi ?? ""}}">{{$data->kondisi ?? "Pilih Jenis Kondisi"}}</option>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Lokasi Alat *</label>
            <textarea class="form-control" required name="lokasi" id="" rows="3">{{$data->lokasi ?? ""}}</textarea>
          </div>
            <div class="form-group">
                <label for="">Bukti Kepemilikan *</label>
                <input type="text"
                class="form-control" required name="bukti" id="" aria-describedby="helpId" placeholder="" value="{{$data->bukti ?? ""}}">
            </div>
            <div class="form-group">
              <label for="">File Bukti Kepemilikan *</label>
              <input type="file" class="form-control-file" required name="file" id="" placeholder="" aria-describedby="fileHelpId">
              <small id="fileHelpId" class="form-text text-muted">Masukkan file yang bisa membuktikan kepemilikan alat</small>
            </div>




    </div>
