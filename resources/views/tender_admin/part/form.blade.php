@include('jenis_kontrak.part.alert')

<div class="card-body">
    <div class="form-section">
        <div class="form-section-header">
            <h3>Informasi Dasar</h3>
        </div>
        <div class="form-section-body">
            <div class="row g-4">
                <div class="col-12">
                    <x-input label="Nama Tender" name="nama" value="{{ $data->nama ?? '' }}" required
                             placeholder="Masukkan Nama Tender" hint="Masukkan Nama Tender"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-select label="Jenis Kontrak" name="jk" :options="$kontrak" value="{{ $data->jenis_kontrak_id ?? '' }}"
                              placeholder="{{ $data->jkn ?? 'Pilih Kontrak' }}"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-select label="Jenis Pengadaan" name="jp" :options="$pengadaan" value="{{ $data->jenis_pegadaan_id ?? '' }}"
                              placeholder="{{ $data->jpn ?? 'Pilih Jenis Pengadaan' }}"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-select label="Metode Pengadaan" name="mp" :options="$metode" value="{{ $data->metode_pengadaan_id ?? '' }}"
                              placeholder="{{ $data->mpn ?? 'Pilih Metode Pengadaan' }}"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-input label="K/L/PD" name="klpd" value="{{ $data->KLPD ?? '' }}" placeholder="Masukkan Nama Lembaga"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-input label="Lokasi Pekerjaan" name="lokasi" value="{{ $data->lokasi_pekerjaan ?? '' }}" placeholder="Masukkan Lokasi Pekerjaan"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-input label="Sumber Dana" name="dana" value="{{ $data->sumber_dana ?? '' }}" placeholder="Masukkan Sumber Dana"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-input label="Satuan Kerja" name="satuan_kerja" value="{{ $data->satuan_kerja ?? '' }}" placeholder="Masukkan Satuan Kerja"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-input label="Tahun Anggaran" name="tanggal" type="date" value="{{ $data->tahun_anggaran ?? '' }}"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-input label="Nilai Pagu" name="nilai" type="number" value="{{ $data->nilai_pagu ?? 0 }}" placeholder="Masukkan Nilai Anggaran"/>
                </div>
                <div class="col-12 col-md-4">
                    <x-input label="Nilai HPS" name="hps" type="number" value="{{ $data->hps ?? 0 }}" placeholder="Masukkan Nilai HPS"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-select label="Status Pengadaan" name="status" :options="$status" value="{{ $data->status_tender_id ?? '' }}"
                              placeholder="{{ $data->stn ?? 'Pilih Status Pengadaan' }}"/>
                </div>
            </div>
        </div>
    </div>
</div>
