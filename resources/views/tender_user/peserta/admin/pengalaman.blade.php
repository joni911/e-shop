<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama Kontrak</th>
            <th>Lokasi</th>
            <th>Instansi</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>No. Kontrak</th>
            <th>Tanggal Kontrak</th>
            <th>Persentase Pelaksanaan</th>
            <th>Tanggal Selesai Kontrak</th>
            <th>Nilai Kontrak</th>
            <th>Nomor Kontrak</th>
            <th>File</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($data->pengalaman as $pe)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td>{{$pe->pekerjaan}}</td>
                    <td>{{$pe->lokasi}}</td>
                    <td>{{$pe->instansi}}</td>
                    <td>{{$pe->alamat}}</td>
                    <td>{{$pe->no_hp}}</td>
                    <td>{{$pe->no_kontrak}}</td>
                    <td>{{$pe->tgl_kontrak}}</td>
                    <td>{{$pe->presentasi}} %</td>
                    <td>{{$pe->tgl_selesai_kontrak}}</td>
                    <td>{{$pe->tgl_serah_terima}}</td>
                    <td>{{$pe->nilai_kontrak}}</td>
                    <td>
                        {{-- <a href="/{{$pe->file}}">{{$pe->pekerjaan}}</a> --}}
                        {{-- Custom --}}
                    <x-adminlte-modal id="modalCustom2-pe{{$pe->id}}" title="{{$pe->pekerjaan}}" size="lg" theme="teal"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <h3>File {{$pe->pekerjaan}}</h3>
                        <p>{{$pe->file}}</p>
                        @php
                            $ext = pathinfo($pe->file, PATHINFO_EXTENSION)
                        @endphp


                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                            $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                            <img src="/{{$pe->file}}" class="img-fluid" alt="Responsive image">

                            @elseif ($ext == 'pdf' || $ext == 'PDF')
                            <object data="/{{$pe->file}}" width="750" height="400"></object>

                            @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                            <a name="" id="" class="btn btn-primary" href="/{{$pe->file}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                            @else
                            File {{$pe->file}}
                            <br>
                            Extensi {{$ext}} Tidak di dukung
                            @endif


                        <x-slot name="footerSlot">
                            <x-adminlte-button class="mr-auto" theme="success" label="Accept"/>
                            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                        </x-slot>
                        </x-adminlte-modal>
                        {{-- Example button to open modal --}}

                        <x-adminlte-button icon="fas fa-eye" label="{{$pe->pekerjaan}}" data-toggle="modal" data-target="#modalCustom2-pe{{$pe->id}}" class="bg-teal"/>
                        <a name="" id="" class="btn btn-primary" href="/{{$pe->file}}" download="{{$pe->pekerjaan}} {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>

                    </td>
                  </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">Kosong</td>
                </tr>
            @endforelse


        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        {{$peist->links()}}
      </ul>
    </div> --}}
  </div>
