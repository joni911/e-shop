   {{-- Custom --}}
   <x-adminlte-modal id="modalCustom2-smkk" title="SMKK" size="lg" theme="teal"
   icon="fas fa-bell" v-centered static-backdrop scrollable>
   {{-- <h3>File SMKK</h3>
   <p>{{$rkk->smkk}}</p> --}}
   @php
       $ext = pathinfo($rkk->smkk, PATHINFO_EXTENSION)
   @endphp


   @if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ||
       $ext == 'JPG' || $ext == 'PNG' || $ext == 'JPEG')
       <img src="/{{$rkk->smkk}}" class="img-fluid" alt="Responsive image">

       @elseif ($ext == 'pdf' || $ext == 'PDF')
       <object data="/{{$rkk->smkk}}" width="750" height="400"></object>

       @elseif ($ext == 'zip' || $ext == 'rar' || $ext == '7z')
       <a name="" id="" class="btn btn-primary" href="/{{$rkk->smkk}}" role="button"><i class="fas fa-download    "> Download File</i></a>
       @else
       File {{$rkk->smkk}}
       <br>
       Extensi {{$ext}} Tidak di dukung
       @endif


   <x-slot name="footerSlot">
       <x-adminlte-button class="mr-auto" theme="success" label="Accept"/>
       <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
   </x-slot>
   </x-adminlte-modal>
   {{-- Example button to open modal --}}

   <x-adminlte-button icon="fas fa-eye" label="SMKK" data-toggle="modal" data-target="#modalCustom2-smkk" class="bg-teal"/>
   <a name="" id="" class="btn btn-primary" href="/{{$rkk->smkk}}" download="SMKK {{$fn}}" role="button"><i class="fa fa-download" aria-hidden="true"></i></a>
