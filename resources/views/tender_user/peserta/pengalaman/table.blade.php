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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($list as $l)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td>{{$l->pekerjaan}}</td>
                    <td>{{$l->lokasi}}</td>
                    <td>{{$l->instansi}}</td>
                    <td>{{$l->alamat}}</td>
                    <td>{{$l->no_hp}}</td>
                    <td>{{$l->no_kontrak}}</td>
                    <td>{{$l->tgl_kontrak}}</td>
                    <td>{{$l->presentasi}} %</td>
                    <td>{{$l->tgl_selesai_kontrak}}</td>
                    <td>{{$l->tgl_serah_terima}}</td>
                    <td>{{$l->nilai_kontrak}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('pengalaman.edit', $l->id) }}" role="button">
                            <i class="fas fa-pencil-alt    "></i>
                        </a>
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
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        {{$list->links()}}
      </ul>
    </div>
  </div>
