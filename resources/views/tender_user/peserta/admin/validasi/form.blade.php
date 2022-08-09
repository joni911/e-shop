<div class="card-body">
    <div class="form-group">
        <label for="">Status File</label>
        <select class="form-control" name="status" id="">
            <option value="{{$tfd->validasi_file->status ?? ""}}">{{$tfd->validasi_file->status ?? "Pilih Data"}}</option>
            <option value="Setuju">Setuju</option>
            <option value="Tidak Setuju">Tidak Setuju</option>
        </select>
    </div>
    <div class="form-group">
      <label for="">Keterangan</label>
      <textarea class="form-control" name="keterangan" id="" rows="3">{{$tfd->validasi_file->keterangan ?? ""}}</textarea>
      <input type="text" name="id" hidden value="{{$tfd->id}}" id="">
    </div>

</div>
