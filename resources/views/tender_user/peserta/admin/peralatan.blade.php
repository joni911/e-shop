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
    {{-- <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        {{$pist->links()}}
      </ul>
    </div> --}}
  </div>
