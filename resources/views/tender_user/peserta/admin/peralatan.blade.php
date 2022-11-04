<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Kapasitas</th>
            <th>Merek/Tipe</th>
            <th>Tahun</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Kepemilikan</th>
            <th>bukti</th>
            <th>File</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($data->peralatan as $p)

                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$p->nama}}</td>
                    <td>{{$p->jumlah}}</td>
                    <td>{{$p->kapasitas}}</td>
                    <td>{{$p->merk}}</td>
                    <td>{{$p->tahun}}</td>
                    <td>{{$p->kondisi}}</td>
                    <td>{{$p->lokasi}}</td>
                    <td>{{$p->kepemilikan}}</td>
                    <td>{{$p->bukti}}</td>
                    <td>
                        {{-- Custom --}}
                    <x-adminlte-modal id="modalCustom2-alat{{$p->id}}" title="{{$p->nama}}" size="lg" theme="teal"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <h3>File {{$p->nama}}</h3>
                        <p>{{$p->file}}</p>
                        @php
                            $ext = pathinfo($p->file, PATHINFO_EXTENSION)
                        @endphp


                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                            $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                            <img src="/{{$p->file}}" class="img-fluid" alt="Responsive image">

                            @elseif ($ext == 'pdf' || $ext == 'PDF')
                            <object data="/{{$p->file}}" width="750" height="400"></object>

                            @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                            <a name="" id="" class="btn btn-primary" href="/{{$p->file}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                            @else
                            File {{$p->file}}
                            <br>
                            Extensi {{$ext}} Tidak di dukung
                            @endif


                        <x-slot name="footerSlot">
                            <x-adminlte-button class="mr-auto" theme="success" label="Accept"/>
                            <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                        </x-slot>
                        </x-adminlte-modal>
                        {{-- Example button to open modal --}}

                        <x-adminlte-button icon="fas fa-eye" label="{{$p->nama}}" data-toggle="modal" data-target="#modalCustom2-alat{{$p->id}}" class="bg-teal"/>
                        <a name="" id="" class="btn btn-primary" href="/{{$p->file}}" download="{{$p->nama}} {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>

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
        {{$pist->links()}}
      </ul>
    </div> --}}
  </div>
