<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Perubahan {{$tahapan->tender->nama}}</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('tender_admin.tahapan',[$tahapan->tender->id]) }}" role="button">Kembali</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama tender</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>Perubahan</th>
            <th>Keterangan</th>
            {{-- <th>Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
            @forelse ($data as $no => $b)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td>{{$b->nama}}</td>
                    <td>{{$b->awal}}</td>
                    <td>{{$b->akhir}}</td>
                    <td>{{$b->created_at}}</td>
                    <td>{{$b->keterangan}}</td>
                    {{-- <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('perubahan.edit', [$b->id]) }}" role="button"><i class="fas fa-pen    "></i></a>
                        <form method="POST" action="{{ route('perubahan.destroy', $b->id) }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" data-toggle="tooltip" title='Delete'><i class="fas fa-trash    "></i></button>
                        </form>
                    </td> --}}
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
