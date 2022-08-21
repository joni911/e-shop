@if (!$persyaratan)
    <form action="{{ route('tender_persyarat.store') }}" enctype="multipart/form-data" method="post">
@else
    <form action="{{ route('tender_persyarat.update',[$persyaratan->id]) }}" enctype="multipart/form-data" method="post">
    @method('PUT')
@endif
    @csrf
    @include('tender_admin.tender_syarat.form')
    <!-- /.card-body -->

    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a name="" id="" class="btn btn-success" href="{{ route('tender_file.index') }}" role="button">Selesai</a>

    </div>
</form>

<div class="card-header">
    <h3 class="card-title">File Persyaratan {{$tender->nama}}</h3>
</div>

@include('tender_admin.tender_syarat.files.form')
