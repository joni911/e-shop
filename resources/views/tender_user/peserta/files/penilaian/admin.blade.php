@if (!$pa)
<form action="{{ route('p_admin.store') }}" method="post">
@else
<form action="{{ route('p_admin.update',$pa->id) }}" method="post">
    @method('PUT')
@endif
    @csrf
    <div class="form-group">
        <label for="">File</label>
        <select class="form-control" name="status" id="">
        <option value="{{$pa->status ?? ""}}">{{$pa->status ?? "Pilih Data"}}</option>
        <option value="Lulus">Lulus</option>
        <option value="Tidak Lulus">Tidak Lulus</option>
        </select>

        <input type="text" class="form-control" name="peserta_id" id="" hidden value="{{$data->id}}" aria-describedby="helpId" placeholder="">
        <input type="text" class="form-control" name="tender_id" id="" hidden value="{{$data->tender_id}}" aria-describedby="helpId" placeholder="">

    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="keterangan" id="" rows="3">{{$pa->keterangan ?? ""}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
