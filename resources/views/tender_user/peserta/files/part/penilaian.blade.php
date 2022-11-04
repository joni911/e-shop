<h1 class="text-center">Penilaian</h1>
<h2>Kualifikasi</h2>
<p>{{$pk->status ?? "Data Belum ada"}}</p>
<p>
    {{$pk->keterangan ?? "Data Belum ada"}}
</p>

<h2>Penilian Administrasi</h2>
<p>{{$pa->status ?? "Data Belum ada"}}</p>
<p>
    {{$pa->keterangan ?? "Data Belum ada"}}
</p>

<h2>
    Teknis
</h2>
<p>{{$pt->status ?? "Data Belum ada"}}</p>
<p>
    {{$pt->keterangan ?? "Data Belum ada"}}
</p>
<h2>Peserta</h2>
<p>{{$p_peserta->status ?? "Data Belum ada"}}</p>
<p>
    {{$p_peserta->keterangan ?? "Data Belum ada"}}
</p>


    @if ($point>=4)
        <p>Selamat Anda Lulus</p>
    @else
       @if ($pk==null&&$pa==null&&$pt==null&&$p_peserta==null)
        <p>Dalam Proses Pemeriksaan</p>
       @else
        <p>
            Mohon Maaf Anda Belum Lulus
        </p>
       @endif
    @endif

<form action="{{ route('send.hasil') }}" method="post">
@csrf
    <input type="text" name="peserta_id" value="{{$data->id}}" hidden id="">
    <input type="text" name="tender_id" value="{{$data->tender_id}}" hidden id="">
    <input type="text" name="point" value="{{$point}}" hidden id="">
    <div class="form-group">
      <label for="">Email</label>
      <input type="email" class="form-control" name="email" value="{{$data->email ?? ""}}" id="" aria-describedby="helpId" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary">Kirim Email</button>
</form>

