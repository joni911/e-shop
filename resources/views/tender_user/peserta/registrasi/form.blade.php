@include('tender_user.peserta.part.alert')

{{-- Izin Usaha --}}
<div class="form-section">
    <div class="form-section-header">
        <h3>Izin Usaha</h3>
    </div>
    <div class="form-section-body">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Izin (NIB/IUJK)" name="izin" value="{{ $data->izin ?? '' }}" required
                         placeholder="Masukkan Izin Perusahaan NIB IUJK"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nomor Izin" name="nomor_izin" value="{{ $data->nomor_izin ?? '' }}" required
                         placeholder="Masukkan Nomor Surat Izin Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Izin Berlaku Sampai" name="izin_berlaku" type="date" value="{{ $data->izin_berlaku ?? '' }}" required
                         hint="Izin seumur hidup pakai sampai 2050"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Instansi Pemberi" name="instansi_pemberi" value="{{ $data->instansi_pemberi ?? '' }}" required
                         placeholder="Masukkan Instansi Pemberi Izin"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Kualifikasi" name="kualifikasi" value="{{ $data->kualifikasi ?? '' }}" required
                         placeholder="Masukkan Jenis Kualifikasi Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-textarea label="Klasifikasi" name="klasifikasi" rows="2" value="{{ $data->klasifikasi ?? '' }}" required/>
            </div>
        </div>
    </div>
</div>

{{-- Data Perusahaan --}}
<div class="form-section">
    <div class="form-section-header">
        <h3>Data Perusahaan</h3>
    </div>
    <div class="form-section-body">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="Nama PT" name="nama_pt" value="{{ $data->nama_pt ?? '' }}" required
                         placeholder="Masukkan Nama Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="No. HP" name="no_hp" value="{{ $data->no_hp ?? '' }}" required
                         placeholder="Masukkan Nomor Whatsapp Perusahaan"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Email" name="email" type="email" value="{{ $data->email ?? '' }}" required
                         placeholder="Masukkan Email Perusahaan"/>
            </div>
            <div class="col-12">
                <x-textarea label="Alamat" name="alamat" rows="3" value="{{ $data->alamat ?? '' }}" required/>
            </div>
        </div>
    </div>
</div>

{{-- Akta --}}
<div class="form-section">
    <div class="form-section-header">
        <h3>Akta Pendirian & Perubahan</h3>
    </div>
    <div class="form-section-body">
        <div class="row g-4">
            <div class="col-12 col-md-4"><x-input label="No. Akta Pendirian" name="no_akta" type="number" value="{{ $data->no_akta ?? '' }}" required/></div>
            <div class="col-12 col-md-4"><x-input label="Tgl. Akta Pendirian" name="tgl_akta" type="date" value="{{ $data->tgl_akta ?? '' }}" required/></div>
            <div class="col-12 col-md-4"><x-input label="Notaris" name="notaris" value="{{ $data->notaris ?? '' }}" required/></div>
            <div class="col-12 col-md-4"><x-input label="No. Akta Terbaru" name="no_aktab" type="number" value="{{ $data->no_aktab ?? '' }}" required/></div>
            <div class="col-12 col-md-4"><x-input label="Tgl. Akta Terbaru" name="tgl_aktab" type="date" value="{{ $data->tgl_aktab ?? '' }}" required/></div>
            <div class="col-12 col-md-4"><x-input label="Notaris Terbaru" name="notaris_b" value="{{ $data->notaris_b ?? '' }}" required/></div>
        </div>
    </div>
</div>

{{-- KSWP --}}
<div class="form-section">
    <div class="form-section-header">
        <h3>KSWP (Keterangan Status Wajib Pajak)</h3>
    </div>
    <div class="form-section-body">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <x-input label="NPWP" name="kswp_npwp" value="{{ $data->kswp_npwp ?? '' }}" required
                         placeholder="Masukkan No NPWP"/>
            </div>
            <div class="col-12 col-md-6">
                <x-input label="Nama Wajib Pajak" name="kswp_nama" value="{{ $data->kswp_nama ?? '' }}" required
                         placeholder="Masukkan Nama Pemilik NPWP"/>
            </div>
        </div>
    </div>
</div>

{{-- Berkas Persyaratan --}}
<div class="form-section">
    <div class="form-section-header">
        <h3>Berkas Persyaratan</h3>
        <p>Upload dokumen wajib (jpg/jpeg/png/pdf/zip/rar/7z)</p>
    </div>
    <div class="form-section-body">
        <div class="row g-4">
            @forelse ($file as $tf)
                <div class="col-12 col-md-6">
                    <x-file :label="($tf->nama ?? $tf->nama_file) . ' *'" name="file_{{ $tf->id }}" required
                            accept=".jpg,.jpeg,.png,.pdf,.zip,.rar,.7z" hint="{{ $tf->keterangan ?? '' }}"/>
                </div>
            @empty
                <div class="col-12 text-muted">Tidak ada berkas wajib.</div>
            @endforelse
        </div>
    </div>
</div>

<input type="hidden" name="id" value="{{ $data->id ?? '' }}">
