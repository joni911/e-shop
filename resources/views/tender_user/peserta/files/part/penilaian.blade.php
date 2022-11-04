<h1 class="text-center">Penilaian</h1>

<h2>Penilian Administrasi</h2>
<p>{{$pa->status ?? "Data Belum ada"}}</p>
<p>
    {{$pa->keterangan ?? "Data Belum ada"}}
</p>
<h2>Kualifikasi</h2>
<p>{{$pk->status ?? "Data Belum ada"}}</p>
<p>
    {{$pk->keterangan ?? "Data Belum ada"}}
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

