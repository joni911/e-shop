<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\penilaian_administrasi;
use App\Models\penilaian_kualifikasi;
use App\Models\penilaian_teknis;
use App\Models\penilaian_penawaran_peserta;
use App\Models\penilaian_peserta;
use App\Models\pemeriksaan;
use App\Models\proses_tender;
use App\Models\validasi_file;
use App\Models\sanggah;
use App\Models\pemenang_tender;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ============================================
        // PENILAIAN PESERTA 1 (PT Maju Jaya) - LULUS SEMUA
        // ============================================
        penilaian_administrasi::create([
            'peserta_id' => 1,
            'user_id' => 1,
            'tender_id' => 2,
            'status' => 'Lulus',
            'keterangan' => 'Semua dokumen administrasi lengkap dan sesuai',
        ]);
        penilaian_kualifikasi::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 1,
            'status' => 'Lulus',
            'keterangan' => 'Kualifikasi perusahaan memenuhi syarat',
        ]);
        penilaian_teknis::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 1,
            'status' => 'Lulus',
            'keterangan' => 'Metode pelaksanaan sesuai spesifikasi',
        ]);
        penilaian_penawaran_peserta::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 1,
            'status' => 'Lulus',
            'keterangan' => 'Harga penawaran di bawah HPS',
        ]);

        // ============================================
        // PENILAIAN PESERTA 2 (PT Sejahtera Abadi) - LULUS 3
        // ============================================
        penilaian_administrasi::create([
            'peserta_id' => 2,
            'user_id' => 1,
            'tender_id' => 2,
            'status' => 'Lulus',
            'keterangan' => 'Dokumen lengkap',
        ]);
        penilaian_kualifikasi::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 2,
            'status' => 'Tidak Lulus',
            'keterangan' => 'Kualifikasi tidak memenuhi nilai minimal',
        ]);
        penilaian_teknis::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 2,
            'status' => 'Lulus',
            'keterangan' => 'Teknis sesuai',
        ]);
        penilaian_penawaran_peserta::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 2,
            'status' => 'Lulus',
            'keterangan' => 'Harga sesuai',
        ]);

        // ============================================
        // PENILAIAN PESERTA 3 (PT Bangun Nusantara) - LULUS SEMUA (HARGA TERENDAH)
        // ============================================
        penilaian_administrasi::create([
            'peserta_id' => 3,
            'user_id' => 1,
            'tender_id' => 2,
            'status' => 'Lulus',
            'keterangan' => 'Dokumen lengkap',
        ]);
        penilaian_kualifikasi::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 3,
            'status' => 'Lulus',
            'keterangan' => 'Kualifikasi Besar memenuhi syarat',
        ]);
        penilaian_teknis::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 3,
            'status' => 'Lulus',
            'keterangan' => 'Metode pelaksanaan sangat baik',
        ]);
        penilaian_penawaran_peserta::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 3,
            'status' => 'Lulus',
            'keterangan' => 'Harga terendah dan di bawah HPS',
        ]);

        // ============================================
        // PENILAIAN PESERTA 4 (PT Mitra Sejati) - TIDAK LULUS
        // ============================================
        penilaian_administrasi::create([
            'peserta_id' => 4,
            'user_id' => 1,
            'tender_id' => 2,
            'status' => 'Tidak Lulus',
            'keterangan' => 'Dokumen KSWP tidak sesuai',
        ]);
        penilaian_kualifikasi::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 4,
            'status' => 'Tidak Lulus',
            'keterangan' => 'Tidak memenuhi syarat kualifikasi',
        ]);
        penilaian_teknis::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 4,
            'status' => 'Tidak Lulus',
            'keterangan' => 'Teknis tidak sesuai spesifikasi',
        ]);
        penilaian_penawaran_peserta::create([
            'tender_id' => 2,
            'user_id' => 1,
            'peserta_id' => 4,
            'status' => 'Tidak Lulus',
            'keterangan' => 'Harga di atas HPS',
        ]);

        // ============================================
        // PENILAIAN PESERTA (RINGKASAN)
        // ============================================
        penilaian_peserta::create([
            'peserta_id' => 1,
            'tender_id' => 2,
            'user_id' => 1,
            'administrasi' => 'Lulus',
            'kualifikasi' => 'Lulus',
            'teknis' => 'Lulus',
            'penawaran_peserta' => 'Lulus',
            'kesimpulan' => 'Peringkat 2',
        ]);
        penilaian_peserta::create([
            'peserta_id' => 2,
            'tender_id' => 2,
            'user_id' => 1,
            'administrasi' => 'Lulus',
            'kualifikasi' => 'Tidak Lulus',
            'teknis' => 'Lulus',
            'penawaran_peserta' => 'Lulus',
            'kesimpulan' => 'Gugur pada kualifikasi',
        ]);
        penilaian_peserta::create([
            'peserta_id' => 3,
            'tender_id' => 2,
            'user_id' => 1,
            'administrasi' => 'Lulus',
            'kualifikasi' => 'Lulus',
            'teknis' => 'Lulus',
            'penawaran_peserta' => 'Lulus',
            'kesimpulan' => 'CALON PEMENANG (Harga Terendah)',
        ]);
        penilaian_peserta::create([
            'peserta_id' => 4,
            'tender_id' => 2,
            'user_id' => 1,
            'administrasi' => 'Tidak Lulus',
            'kualifikasi' => 'Tidak Lulus',
            'teknis' => 'Tidak Lulus',
            'penawaran_peserta' => 'Tidak Lulus',
            'kesimpulan' => 'Gugur semua tahap',
        ]);

        // ============================================
        // PEMERIKSAAN
        // ============================================
        pemeriksaan::create([
            'user_id' => 1,
            'tender_id' => 2,
            'peserta_id' => 1,
            'pengalaman' => 'Ada',
            'kpengalaman' => 'Pengalaman 2 proyek sesuai',
            'tenaga_ahli' => 'Ada',
            'ktenaga_ahli' => '2 tenaga ahli bersertifikat',
            'peralatan' => 'Ada',
            'kperalatan' => 'Peralatan lengkap',
            'pekerjaan_berjalan' => 'Ada',
            'kpekerjaan_berjalan' => '1 pekerjaan berjalan',
            'managemen' => 'Ada',
            'kmanagemen' => 'Manajemen lengkap',
            'file' => 'ada',
            'kfile' => 'File lengkap',
        ]);
        pemeriksaan::create([
            'user_id' => 1,
            'tender_id' => 2,
            'peserta_id' => 3,
            'pengalaman' => 'Ada',
            'kpengalaman' => 'Pengalaman proyek besar sesuai',
            'tenaga_ahli' => 'Ada',
            'ktenaga_ahli' => 'Tenaga ahli bersertifikat',
            'peralatan' => 'Ada',
            'kperalatan' => 'Peralatan lengkap',
            'pekerjaan_berjalan' => 'Tidak Ada',
            'kpekerjaan_berjalan' => 'Tidak ada pekerjaan berjalan',
            'managemen' => 'Ada',
            'kmanagemen' => 'Manajemen lengkap',
            'file' => 'ada',
            'kfile' => 'File lengkap',
        ]);

        // ============================================
        // PROSES TENDER
        // ============================================
        proses_tender::create([
            'tender_id' => 2,
            'peserta_id' => 1,
            'user_id' => 2,
            'pendaftaran' => 'selesai',
            'pengalaman' => 'selesai',
            'tenaga_ahli' => 'selesai',
            'peraltan' => 'selesai',
            'pekerjaan_berjalan' => 'selesai',
        ]);
        proses_tender::create([
            'tender_id' => 2,
            'peserta_id' => 3,
            'user_id' => 4,
            'pendaftaran' => 'selesai',
            'pengalaman' => 'selesai',
            'tenaga_ahli' => 'selesai',
            'peraltan' => 'bisa_diisi',
            'pekerjaan_berjalan' => 'selesai',
        ]);

        // ============================================
        // VALIDASI FILE
        // ============================================
        validasi_file::create([
            'tender_file_detail_id' => 1,
            'user_id' => 1,
            'status' => 'valid',
            'keterangan' => 'File sesuai',
        ]);

        // ============================================
        // PEMENANG TENDER
        // ============================================
        $pemenang = pemenang_tender::create([
            'lelang_id' => 2,
            'peserta_id' => 3,
            'komentar' => 'PT Bangun Nusantara menang dengan harga terkoreksi terendah 24.25 Miliar',
        ]);
    }
}