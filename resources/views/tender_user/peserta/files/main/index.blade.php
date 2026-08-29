<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills card-header-pills gap-1 flex-wrap" id="fileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-kualifikasi" type="button" role="tab">Persyaratan Kualifikasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-administrasi" type="button" role="tab">Administrasi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-teknis" type="button" role="tab">Evaluasi Teknis</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-harga" type="button" role="tab">Harga</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-penilaian" type="button" role="tab">Penilaian</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="fileTabsContent">
            <div class="tab-pane fade show active" id="tab-kualifikasi" role="tabpanel">
                <h2 class="text-center">Persyaratan Kualifikasi</h2>
                @include('tender_user.peserta.admin.file')
                <h3 class="text-center">Pengalaman</h3>
                @include('tender_user.peserta.admin.pengalaman')
                <h3 class="text-center">Pekerjaan Sedang Berjalan</h3>
                @include('tender_user.peserta.admin.pekerjaan_berjalan')
                @include('tender_user.peserta.files.penilaian.kualifikasi')
            </div>

            <div class="tab-pane fade" id="tab-administrasi" role="tabpanel">
                <h2 class="text-center">Administrasi</h2>
                @include('tender_user.peserta.admin.file3')
                @include('tender_user.peserta.files.penilaian.admin')
            </div>

            <div class="tab-pane fade" id="tab-teknis" role="tabpanel">
                @include('tender_user.peserta.files.part.kualifikasi')
                @include('tender_user.peserta.files.penilaian.teknis')
            </div>

            <div class="tab-pane fade" id="tab-harga" role="tabpanel">
                @include('tender_user.peserta.files.part.penawaran')
                @include('tender_user.peserta.admin.file2')
                @include('tender_user.peserta.files.penilaian.peserta')
            </div>

            <div class="tab-pane fade" id="tab-penilaian" role="tabpanel">
                @include('tender_user.peserta.files.part.penilaian')
            </div>
        </div>
    </div>
</div>