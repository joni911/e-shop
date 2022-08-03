<form action="{{ route('validasi_file.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    @include('tender_user.peserta.admin.validasi.form')
    <!-- /.card-body -->

    <div class="card">
        <button type="submit" class="btn btn-primary">Submit</button>

    </div>
</form>
