<div class="col-md">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills text-center">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Administrasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Persyaratan Kualifikasi</a></li>
          <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Evaluasi Teknis</a></li>
          <li class="nav-item"><a class="nav-link" href="#s1" data-toggle="tab">Penawaran Peserta</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <!-- Aktivity -->
            <h1 class="text-center">
                Administrasi
            </h1>
            <!-- End Aktivity -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <h2 class="text-center">Persyaratan Kualifikasi</h2>
                @include('tender_user.peserta.admin.file')


          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="settings">
            @include('tender_user.peserta.files.part.kualifikasi')
          </div>

          <!-- /.tab-pane -->
          <div class="tab-pane" id="s1">
            @include('tender_user.peserta.files.part.penawaran')
        </div>
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
