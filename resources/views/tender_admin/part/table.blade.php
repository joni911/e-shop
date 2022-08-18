<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Tender</h3>
      <br>

      <a name="" id="" class="btn btn-primary" href="{{ route('tender_admin.create') }}" role="button">Tambah</a>
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
                        <a name="" id="" class="btn btn-primary" href="{{ route('tender_admin.edit', [$b->id]) }}" role="button"><i class="fas fa-pen    "></i></a>
                       @if ($b->default == false)
                       <form method="POST" action="{{ route('tender_admin.destroy', $b->id) }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                        </form>
                       @endif
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
