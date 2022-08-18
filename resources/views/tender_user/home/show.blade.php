@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')



@stop

@section('content')

  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

  <body>
    {{-- <div>
      <h3 class="card-title">Tabel Barang</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('barang.create') }}" role="button">Tambah</a>
    </div> --}}

    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card" style="background-color: #1a642b7a;">

            {{-- <div class="card"> --}}
              <div>
                <h3>{{$data->nama}}</h3>
              </div>
              <table class="table">
                  <tbody>
                      <tr>
                          <td scope="row" style="background-color: #1a642b30;">Nama Tender</td>
                          <td>{{$data->nama}}</td>
                      </tr>
                      <tr>

                          <td scope="row" style="background-color: #1a642b30;">Tanggal Pembuatan</td>
                          <td>{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Tahap Paket Saat Ini</td>
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
                          <td style="background-color: #1a642b30;">K/L/PD</td>
                          <td>{{$data->KLPD}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Satuan Kerja</td>
                          <td>{{$data->satuan_kerja}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Jenis Pengadaan</td>
                          <td>{{$data->jpn}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Metode Pengadaan</td>
                          <td>{{$data->mpn}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Tahun Anggaran</td>
                          <td>{{$data->tahun_anggaran}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Nilai Pagu Paket</td>
                          <td>{{$data->nilai_pagu}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Jenis Kontrak</td>
                          <td>{{$data->jkn}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Lokasi Pekerjaan</td>
                          <td>{{$data->lokasi_pekerjaan}}</td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Syarat Kualifikasi</td>
                          <td>
                              @forelse ($data->syarat as $s)
                                  {!! $s->content !!}
                              @empty

                              @endforelse
                          </td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">File yang Di Butuhkan</td>
                          <td>
                              <?php
                                  $key = 1;
                              ?>
                              @forelse ($data->tender_file as $fs)
                                  <p>{{$key++}}. {{$fs->nama}}</p>
                              @empty

                              @endforelse
                          </td>
                      </tr>
                      <tr>
                          <td style="background-color: #1a642b30;">Peserta</td>
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
                        {{-- <x-adminlte-modal id="modalGreen" title="Pendaftaran" theme="success"
                            icon="fas fa-pen" size='lg' disable-animations>

                            <h3 class="text-dark">Apakah anda Ingin mendaftarkan {{$peserta->nama_pt}} ?</h3>
                            <form action="{{ route('daftar_peserta.store') }}" method="post">
                                @csrf
                                <input type="text" class="form-control" name="id" value="{{$peserta->id}}" id="" aria-describedby="helpId" placeholder="" hidden>
                                <input type="text" class="form-control" name="tender_id" value="{{$data->id}}" id="" aria-describedby="helpId" placeholder="" hidden>
                                <button type="submit" class="btn btn-primary">Daftarkan</button>
                            </form>
                        </x-adminlte-modal> --}}
                        {{-- Example button to open modal --}}
                        {{-- <x-adminlte-button label="Daftar Sebagai Peserta" data-toggle="modal" data-target="#modalGreen" class="bg-success"/> --}}

                            <x-adminlte-modal id="modalCustom" title="Pendaftaran Tender" size="lg" theme="green"
                            icon="fas fa-bell" v-centered static-backdrop scrollable>
                            {{-- <div style="height:800px;">Read the account policies...</div> --}}
                            <x-slot name="footerSlot">
                                <h3 class="text-dark">Apakah anda Ingin mendaftarkan {{$peserta->nama_pt}} ?</h3>
                                <form action="{{ route('daftar_peserta.store') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" name="id" value="{{$peserta->id}}" id="" aria-describedby="helpId" placeholder="" hidden>
                                    <input type="text" class="form-control" name="tender_id" value="{{$data->id}}" id="" aria-describedby="helpId" placeholder="" hidden>
                                    <x-adminlte-button type="submit" class="mr-auto" theme="success" label="Daftarkan"/>
                                </form>
                                <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                            </x-slot>
                            </x-adminlte-modal>
                            {{-- Example button to open modal --}}
                            <x-adminlte-button label="Daftar Sebagai Peserta" data-toggle="modal" data-target="#modalCustom" class="bg-teal"/>
                          </td>
                      </tr>
                  </tbody>
              </table>

          </div>

      </div>
    </div>

  </div>
</div>



  <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/js/popper.js')}}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/main.js')}}"></script>

  </body>
</html>





@stop

@section('css')

@stop

@section('js')

@stop
