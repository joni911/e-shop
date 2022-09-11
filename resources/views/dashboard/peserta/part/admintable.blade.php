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
            <th>Cek Kelengkapan</th>
            {{-- <th>Files</th> --}}
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            @forelse ($peserta as $b)

                <tr>
                    {{-- <td>{{$b}}</td> --}}
                    <td scope="row">{{$no++}}</td>

                    <td>{{$b->nama_pt}} Menawarkan @currency($b->penawaran_peserta ?? 1)</td>
                    <td>
                        Email Perusahaan : {{$b->email}} <br>
                        NPWP : {{$b->NPWP}} <br>
                        Alamat : {{$b->alamat}} <br>
                        No HP : {{$b->no_hp}}
                        {{-- Nilai : {{$b->nilai}} --}}
                        <p>{{$b->managemen}}</p>
                    </td>
                    {{-- <td>
                        @foreach ($b->tender_file_detail as $tfd)

                                <x-adminlte-modal id="modalCustom-{{$tfd->id}}" title="{{$tfd->tender_file->nama}}" size="lg" theme="teal"
                                icon="fas fa-bell" v-centered static-backdrop scrollable>
                                <div style="height:800px;">
                                    <h3>File {{$tfd->tender_file->nama}}</h3>
                                    @php
                                        $ext = pathinfo($tfd->files, PATHINFO_EXTENSION)
                                    @endphp
                                    @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                                         $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                                         <img src="/{{$tfd->files}}" class="img-fluid" alt="Responsive image">

                                    @elseif ($ext == 'pdf' || $ext == 'PDF')
                                        <object data="/{{$tfd->files}}" width="750" height="400"></object>

                                    @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                                        <a name="" id="" class="btn btn-primary" href="/{{$tfd->files}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                                    @else
                                        File {{$tfd->files}}
                                        <br>
                                        Extensi {{$ext}} Tidak di dukung
                                    @endif

                                </div>
                                <x-slot name="footerSlot">
                                    <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Terima"/>
                                    <x-adminlte-button theme="danger" label="Tolak" data-dismiss="modal"/>
                                </x-slot>
                                </x-adminlte-modal>

                                <x-adminlte-button label="{{$tfd->tender_file->nama}}" data-toggle="modal" data-target="#modalCustom-{{$tfd->id}}" class="bg-teal"/>
                        @endforeach
                    </td> --}}
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('peserta.file', ['id'=>$data->id,'pid'=>$b->id]) }}" role="button">
                            <i class="fas fa-eye    "></i>
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
        {{$peserta->links()}}
      </ul>
    </div>
  </div>
