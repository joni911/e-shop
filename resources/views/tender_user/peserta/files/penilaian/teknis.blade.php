@if ($pt)
<form action="{{ route('p_teknis.update',$pt->id) }}" method="post">
@method('PUT')
@else
<form action="{{ route('p_teknis.store') }}" method="post">

@endif
@csrf
    <div class="form-group">
        <label for="">File</label>
        <select class="form-control" name="status" id="">
        <option value="{{$pt->status ?? ""}}">{{$pt->status ?? "Pilih Data"}}</option>
        <option value="Lulus">Lulus</option>
        <option value="Tidak Lulus">Tidak Lulus</option>
        </select>

        <input type="text" class="form-control" name="peserta_id" id="" hidden value="{{$data->id}}" aria-describedby="helpId" placeholder="">
        <input type="text" class="form-control" name="tender_id" id="" hidden value="{{$data->tender_id}}" aria-describedby="helpId" placeholder="">
        
    </div>
    <div class="form-group">
        <label for="">Keterangan</label>
        <textarea class="form-control" name="keterangan" id="" rows="3">{{$pt->keterangan ?? ""}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
