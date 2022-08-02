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
            @forelse ($data->pekerjaan as $pj)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td>{{$pj->pekerjaan}}</td>
                    <td>{{$pj->lokasi}}</td>
                    <td>{{$pj->instansi}}</td>
                    <td>{{$pj->alamat}}</td>
                    <td>{{$pj->no_hp}}</td>
                    <td>{{$pj->no_kontrak}}</td>
                    <td>{{$pj->tgl_kontrak}}</td>
                    <td>{{$pj->presentasi}} %</td>
                    <td>{{$pj->tgl_selesai_kontrak}}</td>
                    <td>{{$pj->tgl_serah_terima}}</td>
                    <td>{{$pj->nilai_kontrak}}</td>

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
        {{$pjist->links()}}
      </ul>
    </div> --}}
  </div>
