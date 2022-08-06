@extends('adminlte::page')

@section('title', 'Daftar Peserta')

@section('content_header')



@stop

@section('content')

@if ($message = Session::get('warning-limit'))

<x-adminlte-alert theme="warning" title="Warning" dismissable>
    <strong>{{ $message }}</strong>
</x-adminlte-alert>


@endif
@include('global.alert')
<div class="card">
    <div class="card-header">
        @if ($pemeriksaan->kesimpulan != 'Lulus')
        <h3 class="card-title-center text-center bg-danger">Tender {{$data->nama_tender}} {{$pemeriksaan->kesimpulan}}
            <a name="" id="" class="btn-sm btn-primary" href="{{ route('peserta.edit', ['pesertum'=>$data->id]) }}" role="button"><i class="fas fa-pencil-alt    "></i> Edit</a>
        </h3>
        @else
        <h3 class="card-title-center text-center bg-success">Tender {{$data->nama_tender}} {{$pemeriksaan->kesimpulan}}
            <a name="" id="" class="btn-sm btn-primary" href="{{ route('peserta.edit', ['pesertum'=>$data->id]) }}" role="button"><i class="fas fa-pencil-alt    "></i> Edit</a>
        </h3>
        @endif
    </div>
    <table class="table">
        <tbody>
            <tr>
                <td scope="row">Nama Perusahaan</td>
                <td>{{$data->nama_pt}}</td>
            </tr>
            <tr>
                <td scope="row">Nama User</td>
                <td>{{$data->user->name}}</td>
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
                        @if ($data->harga_koreksi<=0 && $data->user_id == Auth::id())
                        <x-adminlte-modal id="modalCustomml-{{$data->id}}" title="Hapus Data {{$data->nama_perusahaan}}" size="sm" theme="success"
                            icon="fas fa-plus" v-centered static-backdrop scrollable>
                            <div style="height:50px;">Apakah Anda yakin Mengubah Data {{$data->nama_perusahaan}}?</div>
                            <form action="{{ route('koreksi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="">Ajukan Koreksi Penawaran</label>
                            <input type="text" class="form-control" name="id" value="{{$data->id}}" hidden id="" aria-describedby="helpId" placeholder="">
                              <input type="number"
                                class="form-control" name="koreksi" id="" aria-describedby="helpId" placeholder="">
                            </div>

                            <x-slot name="footerSlot">
                                    <x-adminlte-button type="submit" class="mr-auto" theme="success" label="Ya"/>
                            </form>

                                <x-adminlte-button theme="danger" label="Tidak" data-dismiss="modal"/>
                            </x-slot>
                            </x-adminlte-modal>

                            <x-adminlte-button icon="fas fa-pencil-alt" data-toggle="modal" data-target="#modalCustomml-{{$data->id}}" class="bg-green"/>
                        @endif
                </td>

            </tr>

            <tr>
                <td>File</td>
                <td>
                    @forelse ($file as $f)
                       <a href="/{{$f->file}}">{{$f->id}}</a> <br>
                    @empty

                    @endforelse
                </td>
            </tr>

        </tbody>
    </table>
    <h3 class="text-center">File</h3>
    @include('tender_user.peserta.admin.file')
    @include('tender_user.peserta.admin.pemeriksaan.form')



    @include('tender_user.peserta.komentar.index')



</div>

@stop

@section('css')

@stop

@section('js')

@stop
