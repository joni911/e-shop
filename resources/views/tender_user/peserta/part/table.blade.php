<div class="card">
    {{-- <div class="card-header">
      <h3 class="card-title">Tabel Perubahan {{$tahapan->tender->nama}}</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('tender_admin.tahapan',[$tahapan->tender->id]) }}" role="button">Kembali</a>
    </div> --}}
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama PT</th>
            {{-- <td>Cek Kelengkapan</td> --}}

            {{-- <th>Aksi</th> --}}
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($peserta as $b)

                <tr>
                    <td scope="row">{{$no}}</td>

                    {{-- <td>Peserta {{$no++}} Menawarkan @currency($b->penawaran)</td> --}}
                    <td>Peserta {{$no++}} Mengikuti Tender</td>
                    {{-- <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('peserta.file', ['id'=>$data->id,'pid'=>$b->id]) }}" role="button">
                            <i class="fas fa-eye    "></i>
                        </a>
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
        {{$peserta->links()}}
      </ul>
    </div>
  </div>
