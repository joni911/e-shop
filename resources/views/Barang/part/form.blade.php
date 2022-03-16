<div class="card-body">
            <div class="form-group">
              <label for="nama">Nama Barang</label>
              <input type="text" class="form-control" id='nama' name='nama' placeholder="Masukkan nama Barang" value="{{$barang->nama ?? ""}}">
            </div>
            <div class="form-group">
                <label for="katagori">Katagori</label>

                  <select class="form-control" name="katagori" id="katagori">

                      <option value="{{$barang->katagori_barang_id ?? ""}}">{{$barang->katagori_barang->nama}}</option>


                    @foreach ($katagori as $k)
                        <option value="{{$k->id}}">{{$k->nama}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id='harga' name='harga' placeholder="Masukkan nama Barang" value="{{$barang->harga ?? '0'}}">
            </div>
            <div class="form-group">
                <label for="harga">Jumlah</label>
                <input type="number" class="form-control" id='jumlah' name='jumlah' placeholder="Masukkan nama Barang" value="{{$barang->jumlah ?? "0"}}">
            </div>
            <div class="form-group">
              <label for="">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="" rows="4">{{$barang->keterangan ?? ""}}</textarea>
            </div>
             <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="" rows="4">{{$barang->deskripsi ?? ""}}</textarea>
            </div>
