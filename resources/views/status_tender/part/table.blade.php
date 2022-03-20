<div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Status tender</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('status_tender.create') }}" role="button">Tambah</a>
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
                        <a name="" id="" class="btn btn-primary" href="{{ route('status_tender.edit', [$b->id]) }}" role="button"><i class="fas fa-pen    "></i></a>
                        <form method="POST" action="{{ route('status_tender.destroy', $b->id) }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" data-toggle="tooltip" title='Delete'><i class="fas fa-trash    "></i></button>
                        </form>
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
@include('status_tender.part.deletejs')
