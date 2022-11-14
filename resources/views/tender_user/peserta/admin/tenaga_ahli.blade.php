<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Tgl Lahir</th>
            <th>Jenis Klamin</th>
            <th>Alamat</th>
            <th>Jabatan</th>
            <th>Pengalaman</th>
            <th>Pengalaman</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($data->tenaga_ahli as $ta)

                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$ta->nama}}</td>
                    <td>{{$ta->tgl_lahir}}</td>
                    <td>{{$ta->jk}}</td>
                    <td>{{$ta->alamat}}</td>
                    <td>{{$ta->jabatan}}</td>
                    <td>{{$ta->pengalaman}}</td>
                    <td>
                        {{-- <a href="/{{$ta->file}}">{{$ta->nama_file}}</a> --}}
                        {{-- Custom --}}
                    <x-adminlte-modal id="modalCustom2-ta{{$ta->id}}" title="{{$ta->nama}}" size="lg" theme="teal"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <h3>File {{$ta->nama}}</h3>
                        <p>{{$ta->file}}</p>
                        @php
                            $ext = pathinfo($ta->file, PATHINFO_EXTENSION)
                        @endphp


                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                            $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                            <img src="/{{$ta->file}}" class="img-fluid" alt="Responsive image">

                            @elseif ($ext == 'pdf' || $ext == 'PDF')
                            <object data="/{{$ta->file}}" width="750" height="400"></object>

                            @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                            <a name="" id="" class="btn btn-primary" href="/{{$ta->file}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                            @else
                            File {{$ta->file}}
                            <br>
                            Extensi {{$ext}} Tidak di dukung
                            @endif


                        <x-slot name="footerSlot">
                            {{-- <x-adminlte-button class="mr-auto" theme="success" label="Accept"/> --}}
                            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                        </x-slot>
                        </x-adminlte-modal>
                        {{-- Example button to open modal --}}

                        <x-adminlte-button icon="fas fa-eye" label="{{$ta->nama}}" data-toggle="modal" data-target="#modalCustom2-ta{{$ta->id}}" class="bg-teal"/>
                        <a name="" id="" class="btn btn-primary" href="/{{$ta->file}}" download="{{$ta->nama}} {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>

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

  </div>
