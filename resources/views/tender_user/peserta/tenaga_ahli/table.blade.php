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
            <th>Pengalaman</th>
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
                    <td>{{$l->tgl_lahir}}</td>
                    <td>{{$l->jk}}</td>
                    <td>{{$l->alamat}}</td>
                    <td>{{$l->jabatan}}</td>
                    <td>{{$l->pengalaman}}</td>
                    <td><a name="" id="" class="btn btn-primary" href="{{ route('tenagaahli.edit', $l) }}" role="button"><i class="fas fa-edit    "></i></a></td>
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
