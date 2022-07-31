@include('global.alert')
    <div class="card-body">

        <div class="form-group">
          <label for="">Nama Alat</label>
          <input type="text"
            class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="" value="{{$data->nama ?? ""}}">
            <input type="text"
            class="form-control" name="id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->id ?? $peralatan->id}}">
            <input type="text"
            class="form-control" name="tender_id" id="" hidden aria-describedby="helpId" placeholder="" value="{{$data->tender_id ?? $peralatan->tender_id}}">
        </div>
        <div class="form-group">
            <label for="">Jumlah</label>
            <input type="number"
              class="form-control" name="jumlah" id="" aria-describedby="helpId" placeholder="" value="{{$data->jumlah ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Kapasitas</label>
            <input type="text"
              class="form-control" name="kapasitas" id="" aria-describedby="helpId" placeholder="" value="{{$data->kamapsitas ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Merk</label>
            <input type="text"
              class="form-control" name="merk" id="" aria-describedby="helpId" placeholder="" value="{{$data->merk ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Tahun Pembelian</label>
            <input type="number"
              class="form-control" name="tahun" id="" aria-describedby="helpId" placeholder="" value="{{$data->tahun ?? ""}}">
        </div>
        <div class="form-group">
            <label for="">Kepemilikan</label>
              <select class="form-control" name="kepemilikan" id="">
                <option value="">Pilih Kepemilikan Barang</option>
                <option value="Sewa">Sewa</option>
                <option value="Miliki Sendiri">Milik Sendiri</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Kondisi</label>
              <select class="form-control" name="kondisi" id="">
                <option value="">Pilih Jenis Klamin</option>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
              </select>
          </div>
          <div class="form-group">
            <label for="">Lokasi Alat</label>
            <textarea class="form-control" name="lokasi" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
          </div>
            <div class="form-group">
                <label for="">Bukti Kepemilikan</label>
                <input type="text"
                class="form-control" name="bukti" id="" aria-describedby="helpId" placeholder="" value="{{$data->merk ?? ""}}">
            </div>





    </div>
