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
