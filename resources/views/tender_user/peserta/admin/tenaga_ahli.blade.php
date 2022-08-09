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
            @forelse ($data->tenaga_ahli as $ta)

                <tr>
                    <td scope="row">{{$no}}</td>
                    <td>{{$ta->nama}}</td>
                    <td>{{$ta->tgl_lahir}}</td>
                    <td>{{$ta->jk}}</td>
                    <td>{{$ta->alamat}}</td>
                    <td>{{$ta->jabatan}}</td>
                    <td>{{$ta->pengalaman}}</td>
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

  </div>
