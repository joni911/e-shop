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
                    <td>{{$l->jumlah}}</td>
                    <td>{{$l->kapasitas}}</td>
                    <td>{{$l->merk}}</td>
                    <td>{{$l->tahun}}</td>
                    <td>{{$l->kondisi}}</td>
                    <td>{{$l->lokasi}}</td>
                    <td>{{$l->kepemilikan}}</td>
                    <td>{{$l->bukti}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('peralatan.edit', $l) }}" role="button">
                            <i class="fas fa-edit    "></i>
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
