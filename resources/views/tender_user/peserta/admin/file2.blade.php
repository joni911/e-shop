<h3 class="text-center">File Penawaran</h3>
<table class="table">
    <tbody>
        <tr class="text-center">
            @if ($pp)
                @forelse ($pp->penawaran_peserta_file as $ppf)
                <td>
                    {{-- Custom --}}
                    <x-adminlte-modal id="modalCustom2-{{$ppf->id}}" title="{{$ppf->nama}}" size="lg" theme="teal"
                    icon="fas fa-bell" v-centered static-backdrop scrollable>
                    <h3>File {{$ppf->nama}}</h3>
                    <p>{{$ppf->file}}</p>
                    @php
                        $ext = pathinfo($ppf->file, PATHINFO_EXTENSION)
                    @endphp
                    <p>{{$ext}}</p>
                    <?php

                        $fs = round(filesize($ppf->file)/1024/1024,1)
                    ?>
                    @if ($fs<=10)
                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                        $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                        <img src="/{{$ppf->file}}" class="img-fluid" alt="Responsive image">

                        @elseif ($ext == 'pdf' || $ext == 'PDF')
                        <object data="/{{$ppf->file}}" width="750" height="400"></object>

                        @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                        <a name="" id="" class="btn btn-primary" href="/{{$ppf->file}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                        @else
                        File {{$ppf->file}}
                        <br>
                        Extensi {{$ext}} Tidak di dukung
                        @endif
                    @else
                        Ukuran File Terlalu Besar Silakan Simpan File
                    @endif


                    <x-slot name="footerSlot">
                        <x-adminlte-button class="mr-auto" theme="success" label="Accept"/>
                        <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                    </x-slot>
                    </x-adminlte-modal>
                    {{-- Example button to open modal --}}

                    <x-adminlte-button icon="fas fa-eye" label="{{$ppf->nama}}" data-toggle="modal" data-target="#modalCustom2-{{$ppf->id}}" class="bg-teal"/>
                    <a name="" id="" class="btn btn-primary" href="/{{$ppf->file}}" download="{{$ppf->nama}} {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>

                </td>
                @empty

                @endforelse
                @endif

        </tr>

    </tbody>
</table>
