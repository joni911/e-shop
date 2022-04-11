<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Barang</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('barang.create') }}" role="button">Tambah</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($barang as $no => $b)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td> <a href="{{ route('barang.show', [$b->id]) }}">{{$b->nama}}</a></td>
                    <td>{{$b->inventory_barang->jumlah}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('barang.edit', [$b->id]) }}" role="button">Edit</a>
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
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </div>
  </div>
