<div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>KTP</th>
            <th>NPWP</th>
            <th>Alamat</th>
            <th>Tgl Menjabat</th>
            <th>Tgl Selesai Menjabat</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($data->managemen as $m)

                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$m->nama}}</td>
                    <td>{{$m->ktp}}</td>
                    <td>{{$m->NPWP}}</td>
                    <td>{{$m->alamat}}</td>
                    <td>{{$m->tgl_menjabat}}</td>
                    <td>{{$m->tgl_berakhir}}</td>
                    <td>{{$m->status}}</td>
                    <td></td>
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
        {{-- {{$da->links()}} --}}
      </ul>
    </div>
  </div>
