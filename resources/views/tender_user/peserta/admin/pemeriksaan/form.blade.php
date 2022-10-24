@if ($pemeriksaan !=null)
<form action="{{ route('pemeriksaan.update',[$pemeriksaan]) }}" method="post">
    @method('put')
@else
<form action="{{ route('pemeriksaan.store') }}" method="post">
@endif

    @csrf
    <div class="form-group">
        <label for="">File</label>
        <select class="form-control" name="file" id="">
          <option value="{{$pemeriksaan->file ?? ""}}">{{$pemeriksaan->file ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>

        <input type="text" class="form-control" name="peserta_id" id="" hidden value="{{$data->id}}" aria-describedby="helpId" placeholder="">
        <input type="text" class="form-control" name="tender_id" id="" hidden value="{{$data->tender_id}}" aria-describedby="helpId" placeholder="">

      </div>
      <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="kfile" id="" rows="3">{{$pemeriksaan->kfile ?? ""}}</textarea>
      </div>
      <h3 class="text-center">Pengalaman</h3>
    @include('tender_user.peserta.admin.pengalaman')

    <div class="form-group">
        <label for="">Pengalaman</label>
        <select class="form-control" name="pengalaman" id="">
          <option value="{{$pemeriksaan->pengalaman ?? ""}}">{{$pemeriksaan->pengalaman ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="kpengalaman" id="" rows="3">{{$pemeriksaan->kpengalaman ?? ""}}</textarea>
    </div>

    <h3 class="text-center">Tenaga Ahli Perusahaan</h3>
    @include('tender_user.peserta.admin.tenaga_ahli')
    <div class="form-group">
        <label for="">Tenaga Ahli</label>
        <select class="form-control" name="tenaga_ahli" id="">
          <option value="{{$pemeriksaan->tenaga_ahli ?? ""}}">{{$pemeriksaan->tenaga_ahli ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="ktenaga_ahli" id="" rows="3">{{$pemeriksaan->tenaga_ahli ?? ""}}</textarea>
    </div>
    <h3 class="text-center">Peralatan</h3>
    @include('tender_user.peserta.admin.peralatan')
    <div class="form-group">
        <label for="">Peralatan</label>
        <select class="form-control" name="peralatan" id="">
          <option value="{{$pemeriksaan->peralatan ?? ""}}">{{$pemeriksaan->peralatan ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="kperalatan" id="" rows="3">{{$pemeriksaan->kperalatan ?? ""}}</textarea>
    </div>
    <h3 class="text-center">Pekerjaan Sedang Berjalan</h3>
    @include('tender_user.peserta.admin.pekerjaan_berjalan')
    <div class="form-group">
        <label for="">Pekerjaan Berjalan</label>
        <select class="form-control" name="pekerjaan_berjalan" id="">
          <option value="{{$pemeriksaan->pekerjaan_berjalan ?? ""}}">{{$pemeriksaan->pekerjaan_berjalan ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="kpekerjaan_berjalan" id="" rows="3">{{$pemeriksaan->kpekerjaan_berjalan ?? ""}}</textarea>
    </div>
    <h3 class="text-center">Managemen Perusahaan</h3>
    @include('tender_user.peserta.admin.managemen')
    <div class="form-group">
        <label for="">Managemen</label>
        <select class="form-control" name="managemen" id="">
          <option value="{{$pemeriksaan->managemen ?? ""}}">{{$pemeriksaan->managemen ?? "Pilih Data"}}</option>
          <option value="Lulus">Lulus</option>
          <option value="Tidak Lulus">Tidak Lulus</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="kmanagemen" id="" rows="3">{{$pemeriksaan->kmanagemen ?? ""}}</textarea>
    </div>

  <button type="submit" class="btn btn-primary">Simpan</button>

</form>
