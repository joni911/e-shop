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
            <th>File</th>
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
                    <td>{{$l->npwp ?? $l->NPWP}}</td>
                    <td>{{$l->alamat}}</td>
                    <td>{{$l->tgl_menjabat}}</td>
                    <td>{{$l->tgl_berakhir}}</td>
                    <td>{{$l->status}}</td>
                    <td><a href="{{$l->file1 ?? "#"}}">{{$l->ket1 ?? "Kosong" }}</a> <br>
                        <a href="{{$l->file2 ?? "#"}}">{{$l->ket2 ?? "Kosong" }}</a> <br>
                        <a href="{{$l->file3 ?? "#"}}">{{$l->ket3 ?? "Kosong" }}</a> <br>
                        <a href="{{$l->file4 ?? "#"}}">{{$l->ket4 ?? "Kosong" }}</a> <br>
                        <a href="{{$l->file5 ?? "#"}}">{{$l->ket5 ?? "Kosong" }}</a> <br>
                    </td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('managemen.edit', $l) }}" role="button">
                            <i class="fas fa-edit    "></i>
                        </a>
                    </td>
                  </tr>
            @empty
                <tr>
                    <td colspan="10" align="center">Kosong</td>
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
