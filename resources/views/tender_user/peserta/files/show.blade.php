@extends('adminlte::page')

@section('title', 'Daftar Peserta')

@section('content_header')



@stop

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title-center"></h3>
    </div>
    <table class="table">
        <tbody>
            <tr>
                <td scope="row">Nama Perusahaan</td>
                <td>{{$data->nama_perusahaan}}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>
                    {{$data->NPWP}}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{$data->alamat}}</td>
            </tr>
            <tr>
                <td>No HP</td>
                <td>{{$data->no_hp}}</td>
            </tr>
            <tr>
                <td>Nilai Tender</td>
                <td>HPS: {{$data->tender->hps}}
                    <br>
                    Pagu : {{$data->tender->nilai_pagu}}
                </td>
            </tr>
            <tr>
                <td>Penawaran</td>
                <td>Penwaran : {{$data->penawaran}}
                    Koreksi : {{$data->harga_koreksi}}
                </td>

            </tr>

            <tr>
                <td>File</td>
                <td>
                    @forelse ($file as $f)
                       <a href="/{{$f->file}}">{{$f->nama_file}}</a> <br>
                    @empty

                    @endforelse
                </td>
            </tr>

        </tbody>
    </table>
    @include('tender_user.peserta.komentar.index')

</div>

@stop

@section('css')

@stop

@section('js')

@stop
