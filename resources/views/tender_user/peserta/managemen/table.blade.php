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
            @forelse ($list as $l)

                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$l->nama}}</td>
                    <td>{{$l->ktp}}</td>
                    <td>{{$l->npwp}}</td>
                    <td>{{$l->alamat}}</td>
                    <td>{{$l->tgl_menjabat}}</td>
                    <td>{{$l->tgl_berakhir}}</td>
                    <td>{{$l->status}}</td>
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
        {{$list->links()}}
      </ul>
    </div>
  </div>
