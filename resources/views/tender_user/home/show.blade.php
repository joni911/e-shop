@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title-center">{{$data->nama}}</h3>
    </div>
    <table class="table">
        <tbody>
            <tr>
                <td scope="row">Nama Tender</td>
                <td>{{$data->nama}}</td>
            </tr>
            <tr>

                <td scope="row">Tanggal Pembuatan</td>
                <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Tahap Paket Saat Ini</td>
                <td>
                    @foreach ($data->tahapan as $t)
                        @if ($t->akhir>$now)
                            <p>{{$t->nama}} {{$t->mulai}} : {{$t->akhir}}</p>
                            @break
                        @else

                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>K/L/PD</td>
                <td>{{$data->KLPD}}</td>
            </tr>
            <tr>
                <td>Satuan Kerja</td>
                <td>{{$data->satuan_kerja}}</td>
            </tr>
            <tr>
                <td>Jenis Pengadaan</td>
                <td>{{$data->jpn}}</td>
            </tr>
            <tr>
                <td>Metode Pengadaan</td>
                <td>{{$data->mpn}}</td>
            </tr>
            <tr>
                <td>Tahun Anggaran</td>
                <td>{{$data->tahun_anggaran}}</td>
            </tr>
            <tr>
                <td>Nilai Pagu Paket</td>
                <td>{{$data->nilai_pagu}}</td>
            </tr>
             {{-- {"id":1,"tahapan_id":0,"jenis_pegadaan_id":3,
                "metode_pengadaan_id":1,"jenis_kontrak_id":1,
                "syarat_id":0,"status_tender_id":1,
                "nama":"Pengadaan Alat Kebersihan","sumber_dana":"apbd",
                "KLPD":"bpr","satuan_kerja":"itx",
                "tahun_anggaran":"2022-03-21","lokasi_pekerjaan":"bangli",
                "created_at":"2022-03-21T02:09:09.000000Z",
                "updated_at":"2022-04-06T02:13:03.000000Z",
                "deleted_at":null,"nilai_pagu":1200000,"hps":1000000,
                "jpn":"Pekerjaan Konstruksi","jkn":"Kontrak Lumsum",
                "mpn":"Pengadaan 1 File","stn":"Dimulai"} --}}
            <tr>
                <td>Jenis Kontrak</td>
                <td>{{$data->jkn}}</td>
            </tr>
            <tr>
                <td>Lokasi Pekerjaan</td>
                <td>{{$data->lokasi_pekerjaan}}</td>
            </tr>
            <tr>
                <td>Syarat Kualifikasi</td>
                <td>
                    @forelse ($data->syarat as $s)
                        {!! $s->content !!}
                    @empty

                    @endforelse
                </td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>
                    <?php
                        $j = 0;
                    ?>
                    @forelse ($data->peserta as $p)
                    <?php
                        $j++
                    ?>
                    @empty

                    @endforelse
                    <a href="{{ route('peserta.tender', [$data->id]) }}">Peserta {{$j}}</a>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <a name="" id="" class="btn btn-primary" href="{{ route('peserta.show',[$data->id]) }}" role="button">Ajukan</a>
                </td>
            </tr>
        </tbody>
    </table>

</div>

@stop

@section('css')

@stop

@section('js')

@stop
