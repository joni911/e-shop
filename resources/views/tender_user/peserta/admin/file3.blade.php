<h3 class="text-center">File Administrasi</h3>
<table class="table">
    <tbody>
        <tr class="text-center">
            @if ($admin)
                @forelse ($admin as $apf)
                <td>
                    {{-- Custom --}}
                    <x-adminlte-modal id="modalCustom2-{{$apf->id}}" title="{{$apf->nama}}" size="lg" theme="teal"
                    icon="fas fa-bell" v-centered static-backdrop scrollable>
                    <h3>File {{$apf->nama}}</h3>
                    <p>{{$apf->file}}</p>
                    @php
                        $ext = pathinfo($apf->file, PATHINFO_EXTENSION)
                    @endphp
                    <p>{{$ext}}</p>
                    <?php

                        $fs = round(filesize($apf->file)/1024/1024,1)
                    ?>
                    @if ($fs<=2)
                        @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
                        $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
                        <img src="/{{$apf->file}}" class="img-fluid" alt="Responsive image">

                        @elseif ($ext == 'pdf' || $ext == 'PDF')
                        <object data="/{{$apf->file}}" width="750" height="400"></object>

                        @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
                        <a name="" id="" class="btn btn-primary" href="/{{$apf->file}}" role="button"><i class="fas fa-download    "> Download File</i></a>
                        @else
                        File {{$apf->file}}
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

                    <x-adminlte-button icon="fas fa-eye" label="{{$apf->nama}}" data-toggle="modal" data-target="#modalCustom2-{{$apf->id}}" class="bg-teal"/>
                    <a name="" id="" class="btn btn-primary" href="/{{$apf->file}}" download="{{$apf->nama}} {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>

                </td>
                @empty

                @endforelse
                @endif

        </tr>

    </tbody>
</table>
