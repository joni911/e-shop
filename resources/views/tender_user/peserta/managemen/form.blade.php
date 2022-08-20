@include('global.alert')
<div class="card-body">

    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" id="" aria-describedby="helpId" placeholder=""
            value="{{$data->pekerjaan ?? ""}}">
        <input type="text" class="form-control" name="id" id="" hidden aria-describedby="helpId" placeholder=""
            value="{{$data->id ?? $managemen->id}}">
        <input type="text" class="form-control" name="tender_id" id="" hidden aria-describedby="helpId" placeholder=""
            value="{{$data->tender_id ?? $managemen->tender_id}}">
    </div>
    <div class="form-group">
        <label for="">Tanggal Menjabat</label>
        <input type="date" class="form-control" name="tgl_menjabat" id="" aria-describedby="helpId" placeholder=""
            value="{{$data->lokasi ?? ""}}">
    </div>
    <div class="form-group">
        <label for="">Tanggal Jabatan Berakhir</label>
        <input type="date" class="form-control" name="tgl_berakhir" id="" aria-describedby="helpId" placeholder=""
            value="{{$data->lokasi ?? ""}}">
    </div>
    <div class="form-group">
        <label for="">KTP</label>
        <input type="text" class="form-control" name="ktp" id="" aria-describedby="helpId" placeholder=""
            value="{{$data->no_hp ?? ""}}">
    </div>
    <div class="form-group">
        <label for="">NPWP</label>
        <input type="text" class="form-control" name="npwp" id="" aria-describedby="helpId" placeholder=""
            value="{{$data->no_hp ?? ""}}">
    </div>
    <div class="form-group">
        <label for="">Alamat</label>
        <textarea class="form-control" name="alamat" id="" rows="3">{{$data->alamat ?? ""}}</textarea>
    </div>
    <div class="form-group">
        <label for="">Status Dalam Manajemen</label>
        <select class="form-control" name="status" id="">
            <option value="">Pilih Data</option>
            <option value="Pemilik">Pemilik</option>
            <option value="Pengurus">Pengurus</option>
            <option value="Direktur">Direktur</option>
        </select>
    </div>
    <h2>Minimal 1 File Sertifikat</h2>
    <div class="form-group">
      <label for="">Sertifikat 1</label>
      <input type="file" class="form-control-file" name="file1" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
    <div class="form-group">
      <label for="">Keterangan Sertifikat</label>
      <input type="text"
        class="form-control" name="ket1" id="" aria-describedby="helpId" placeholder="">
    </div>
    <div class="form-group">
      <label for="">Sertifikat 2</label>
      <input type="file" class="form-control-file" name="file2" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
    <div class="form-group">
      <label for="">Keterangan Sertifikat Keahlian</label>
      <input type="text"
        class="form-control" name="ket2" id="" aria-describedby="helpId" placeholder="">
    </div><div class="form-group">
      <label for="">Sertifikat 3</label>
      <input type="file" class="form-control-file" name="file3" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
    <div class="form-group">
      <label for="">Keterangan Sertifikat</label>
      <input type="text"
        class="form-control" name="ket3" id="" aria-describedby="helpId" placeholder="">
    </div><div class="form-group">
      <label for="">Sertifikat 4</label>
      <input type="file" class="form-control-file" name="file4" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
    <div class="form-group">
      <label for="">Keterangan Sertifikat</label>
      <input type="text"
        class="form-control" name="ket4" id="" aria-describedby="helpId" placeholder="">
    </div><div class="form-group">
      <label for="">Sertifikat 5</label>
      <input type="file" class="form-control-file" name="file5" id="" placeholder="" aria-describedby="fileHelpId">
    </div>
    <div class="form-group">
      <label for="">Keterangan Sertifikat</label>
      <input type="text"
        class="form-control" name="ket5" id="" aria-describedby="helpId" placeholder="">
    </div>
</div>
