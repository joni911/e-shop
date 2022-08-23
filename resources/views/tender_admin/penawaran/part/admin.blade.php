@if (!$penawaran)
    <form action="{{ route('penawaran.store') }}" enctype="multipart/form-data" method="post">
@else
    <form action="{{ route('penawaran.update',[$penawaran->id]) }}" enctype="multipart/form-data" method="post">
    @method('PUT')
@endif
    @csrf
    @include('tender_admin.tender_syarat.form')
    <!-- /.card-body -->

    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a name="" id="" class="btn btn-success" href="{{ route('tender_admin.index') }}" role="button">Selesai</a>

    </div>
</form>
<div class="card-header">
    <h3 class="card-title">Tambah File Penawaran {{$tender->nama}}</h3>
</div>

@include('tender_admin.penawaran.part.form')

