<div class="card">
    <div class="card-header">
      <h3 class="text-center">Daftar Pengadaan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($data as $no => $b)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td>{{$b->nama}}</td>
                    <td>
                        <a name="" id="" class="btn btn-warning" href="{{ route('sanggahan.show', [$b->id]) }}" role="button">Sanggahan</a>


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
        {{$data->links()}}
      </ul>
    </div>
  </div>
