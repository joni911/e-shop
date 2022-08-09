
<table class="table">

    <tbody>
        <tr class="text-center">
            @foreach ($berkas as $tfd)
                {{-- <a href="{{$tfd->files}}">{{$tfd->tender_file->nama}}</a> --}}
                {{-- Custom --}}
                    <td>
                        <x-adminlte-modal id="modalCustom-{{$tfd->id}}" title="{{$tfd->tender_file->nama}}" size="lg" theme="teal"
                            icon="fas fa-bell" v-centered static-backdrop scrollable>
                            <div style="height:auto;">
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
                                @include('tender_user.peserta.admin.validasi.create')
                            </div>
                            <x-slot name="footerSlot">
                                {{-- <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Terima"/> --}}
                                <x-adminlte-button theme="danger" label="Tutup" data-dismiss="modal"/>
                            </x-slot>
                            </x-adminlte-modal>
                            {{-- Example button to open modal --}}
                            <x-adminlte-button label="{{$tfd->tender_file->nama}}" data-toggle="modal" data-target="#modalCustom-{{$tfd->id}}" class="bg-teal"/>
                            <p>Status File</p>
                            <p>{{$tfd->validasi_file->status ?? "Belum di verifikasi"}}</p>
                    </td>

            @endforeach
        </tr>

    </tbody>
</table>
