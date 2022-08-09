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
        </select>
    </div>

</div>
