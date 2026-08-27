<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tender;
use App\Models\tahapan;
use App\Models\syarat;
use App\Models\syarat_detail;
use App\Models\tender_file;
use App\Models\tender_persyaratan;
use App\Models\tender_persyaratan_file;
use App\Models\administrasi;
use App\Models\administrasi_detail;
use Carbon\Carbon;

class TenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminId = 1; // ID Admin
        $now = Carbon::now();

        // ==========================================
        // 1. TENDER DEFAULT (untuk registrasi peserta awal)
        // ==========================================
        $tenderDefault = tender::create([
            'user_id' => $adminId,
            'nama' => 'Registrasi Peserta Default',
            'paket' => 'Pendaftaran Awal Peserta',
            'tahapan_id' => 0,
            'jenis_pegadaan_id' => 1,
            'jenis_kontrak_id' => 1,
            'metode_pengadaan_id' => 1,
            'syarat_id' => 0,
            'status_tender_id' => 1, // Draft
            'KLPD' => 'Kementerian PUPR',
            'sumber_dana' => 'APBN',
            'satuan_kerja' => 'Direktorat Jenderal Cipta Karya',
            'tahun_anggaran' => $now->format('Y-m-d'),
            'lokasi_pekerjaan' => 'Jakarta',
            'nilai_pagu' => 0,
            'hps' => 0,
            'default' => 1,
        ]);

        // Tender File untuk Default
        $defaultFiles = [
            ['tender_id' => $tenderDefault->id, 'nama' => 'Surat Izin Usaha (NIB/SIUJK)', 'keterangan' => 'Scan izin usaha yang masih berlaku'],
            ['tender_id' => $tenderDefault->id, 'nama' => 'Akta Pendirian Perusahaan', 'keterangan' => 'Scan akta pendirian yang sudah disahkan'],
            ['tender_id' => $tenderDefault->id, 'nama' => 'NPWP Perusahaan', 'keterangan' => 'Scan NPWP perusahaan'],
            ['tender_id' => $tenderDefault->id, 'nama' => 'KSWP (Keterangan Status Wajib Pajak)', 'keterangan' => 'Bukti KSWP dari DJP'],
        ];
        foreach ($defaultFiles as $file) {
            tender_file::create($file);
        }

        // Tahapan untuk Tender Default (agar /tender_home/{id} tidak error $tahapan NULL)
        // Upload File: mulai hari ini s.d. tanggal 4 bulan depan (untuk uji coba)
        $tahapanDefault = [
            ['tender_id' => $tenderDefault->id, 'nama' => 'Pendaftaran', 'mulai' => $now->copy()->format('Y-m-d'), 'akhir' => $now->copy()->addDays(30)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pendaftaran', 'status' => 1],
            ['tender_id' => $tenderDefault->id, 'nama' => 'Upload File', 'mulai' => $now->copy()->format('Y-m-d'), 'akhir' => $now->copy()->addMonth()->startOfMonth()->addDays(3)->format('Y-m-d'), 'keterangan' => 'Jadwal: Upload File', 'status' => 4],
        ];
        foreach ($tahapanDefault as $t) {
            tahapan::create($t);
        }

        // ==========================================
        // 2. TENDER AKTIF 1: Pembangunan Gedung
        // ==========================================
        $tender1 = tender::create([
            'user_id' => $adminId,
            'nama' => 'Pembangunan Gedung Perkantoran 5 Lantai',
            'paket' => 'PK-01/PA/2024',
            'tahapan_id' => 0,
            'jenis_pegadaan_id' => 2, // Pekerjaan Konstruksi
            'jenis_kontrak_id' => 1, // Lump Sum
            'metode_pengadaan_id' => 1, // Tender Umum
            'syarat_id' => 0,
            'status_tender_id' => 2, // Publish
            'KLPD' => 'Kementerian PUPR',
            'sumber_dana' => 'APBN',
            'satuan_kerja' => 'Direktorat Jenderal Cipta Karya',
            'tahun_anggaran' => $now->format('Y') . '-01-01',
            'lokasi_pekerjaan' => 'Jakarta Selatan, DKI Jakarta',
            'nilai_pagu' => 25000000000, // 25 Miliar
            'hps' => 24500000000, // 24.5 Miliar
            'default' => 0,
        ]);

        // Tahapan Tender 1
        $tahapan1 = [
            ['tender_id' => $tender1->id, 'nama' => 'Pendaftaran dan Pengambilan Dokumen', 'mulai' => $now->copy()->addDays(1)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(14)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pendaftaran dan Pengambilan Dokumen', 'status' => 1],
            ['tender_id' => $tender1->id, 'nama' => 'Aanwijzing (Penjelasan Dokumen)', 'mulai' => $now->copy()->addDays(15)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(15)->format('Y-m-d'), 'keterangan' => 'Jadwal: Aanwijzing (Penjelasan Dokumen)', 'status' => 0],
            ['tender_id' => $tender1->id, 'nama' => 'Upload Dokumen Penawaran', 'mulai' => $now->copy()->addDays(16)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(30)->format('Y-m-d'), 'keterangan' => 'Jadwal: Upload Dokumen Penawaran', 'status' => 4],
            ['tender_id' => $tender1->id, 'nama' => 'Pembukaan Penawaran', 'mulai' => $now->copy()->addDays(31)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(31)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pembukaan Penawaran', 'status' => 0],
            ['tender_id' => $tender1->id, 'nama' => 'Evaluasi Penawaran', 'mulai' => $now->copy()->addDays(32)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(45)->format('Y-m-d'), 'keterangan' => 'Jadwal: Evaluasi Penawaran', 'status' => 0],
            ['tender_id' => $tender1->id, 'nama' => 'Negosiasi', 'mulai' => $now->copy()->addDays(46)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(50)->format('Y-m-d'), 'keterangan' => 'Jadwal: Negosiasi', 'status' => 0],
            ['tender_id' => $tender1->id, 'nama' => 'Penetapan Pemenang', 'mulai' => $now->copy()->addDays(51)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(55)->format('Y-m-d'), 'keterangan' => 'Jadwal: Penetapan Pemenang', 'status' => 3],
        ];
        foreach ($tahapan1 as $t) {
            tahapan::create($t);
        }

        // Syarat Tender 1
        $syarat1 = syarat::create([
            'tender_id' => $tender1->id,
            'judul' => 'Persyaratan Kualifikasi',
            'izin' => 'NIB, SBU, IUJK',
            'usaha' => 'Badan Usaha Konstruksi',
            'content' => 'Persyaratan kualifikasi untuk pekerjaan konstruksi sesuai ketentuan PBJ.',
        ]);

        syarat_detail::create([
            'syarat_id' => $syarat1->id,
            'keterangan' => 'Memiliki NIB dengan kualifikasi minimal Menengah',
        ]);
        syarat_detail::create([
            'syarat_id' => $syarat1->id,
            'keterangan' => 'Memiliki Sertifikat Badan Usaha (SBU) dengan klasifikasi G0121',
        ]);
        syarat_detail::create([
            'syarat_id' => $syarat1->id,
            'keterangan' => 'Pengalaman minimal 3 proyek konstruksi dalam 5 tahun terakhir',
        ]);

        // Tender File untuk Tender 1
        $files1 = [
            ['tender_id' => $tender1->id, 'nama' => 'Dokumen Kualifikasi', 'keterangan' => 'Surat Izin Usaha, Akta, NPWP, KSWP'],
            ['tender_id' => $tender1->id, 'nama' => 'Surat Penawaran', 'keterangan' => 'Surat penawaran bermaterai dan ditandatangani direksi'],
            ['tender_id' => $tender1->id, 'nama' => 'Dokumen Teknis', 'keterangan' => 'Metode pelaksanaan, jadwal, RKK'],
            ['tender_id' => $tender1->id, 'nama' => 'Dokumen Penawaran Harga', 'keterangan' => 'RAB dan rincian penawaran harga'],
        ];
        foreach ($files1 as $file) {
            tender_file::create($file);
        }

        // Tender Persyaratan untuk Tender 1
        $persyaratan1 = tender_persyaratan::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'judul' => 'Spesifikasi Teknis Pembangunan Gedung',
            'penjelasan' => 'Gedung perkantoran 5 lantai dengan luas lahan 2000 m2, luas bangunan 8000 m2. Standar SNI untuk konstruksi gedung.',
        ]);

        // Administrasi
        $administrasi1 = administrasi::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'nama' => 'Kelengkapan Dokumen Administrasi',
            'keterangan' => 'Pemeriksaan kelengkapan dokumen administrasi peserta',
        ]);

        administrasi_detail::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'peserta_id' => 0,
            'administrasi_id' => $administrasi1->id,
            'nama' => 'Surat Izin Usaha',
            'file' => '',
        ]);
        administrasi_detail::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'peserta_id' => 0,
            'administrasi_id' => $administrasi1->id,
            'nama' => 'Akta Pendirian',
            'file' => '',
        ]);
        administrasi_detail::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'peserta_id' => 0,
            'administrasi_id' => $administrasi1->id,
            'nama' => 'NPWP',
            'file' => '',
        ]);
        administrasi_detail::create([
            'user_id' => $adminId,
            'tender_id' => $tender1->id,
            'peserta_id' => 0,
            'administrasi_id' => $administrasi1->id,
            'nama' => 'KSWP',
            'file' => '',
        ]);

        // ==========================================
        // 3. TENDER AKTIF 2: Pengadaan Komputer
        // ==========================================
        $tender2 = tender::create([
            'user_id' => $adminId,
            'nama' => 'Pengadaan Laptop dan Komputer Kantor',
            'paket' => 'PB-02/PA/2024',
            'tahapan_id' => 0,
            'jenis_pegadaan_id' => 1, // Pengadaan Barang
            'jenis_kontrak_id' => 2, // Harga Satuan
            'metode_pengadaan_id' => 3, // Pemilihan Langsung
            'syarat_id' => 0,
            'status_tender_id' => 2, // Publish
            'KLPD' => 'Kementerian Komunikasi dan Informatika',
            'sumber_dana' => 'APBN',
            'satuan_kerja' => 'Direktorat Aplikasi Informatika',
            'tahun_anggaran' => $now->format('Y') . '-01-01',
            'lokasi_pekerjaan' => 'Jakarta Pusat, DKI Jakarta',
            'nilai_pagu' => 5000000000, // 5 Miliar
            'hps' => 4800000000, // 4.8 Miliar
            'default' => 0,
        ]);

        // Tahapan Tender 2
        $tahapan2 = [
            ['tender_id' => $tender2->id, 'nama' => 'Pendaftaran', 'mulai' => $now->copy()->addDays(1)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(7)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pendaftaran', 'status' => 1],
            ['tender_id' => $tender2->id, 'nama' => 'Pengambilan Dokumen', 'mulai' => $now->copy()->addDays(1)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(10)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pengambilan Dokumen', 'status' => 2],
            ['tender_id' => $tender2->id, 'nama' => 'Penawaran', 'mulai' => $now->copy()->addDays(11)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(20)->format('Y-m-d'), 'keterangan' => 'Jadwal: Penawaran', 'status' => 4],
            ['tender_id' => $tender2->id, 'nama' => 'Evaluasi', 'mulai' => $now->copy()->addDays(21)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(30)->format('Y-m-d'), 'keterangan' => 'Jadwal: Evaluasi', 'status' => 0],
        ];
        foreach ($tahapan2 as $t) {
            tahapan::create($t);
        }

        // Syarat Tender 2
        $syarat2 = syarat::create([
            'tender_id' => $tender2->id,
            'judul' => 'Persyaratan Pengadaan Barang',
            'izin' => 'NIB',
            'usaha' => 'Badan Usaha',
            'content' => 'Persyaratan kualifikasi pengadaan barang sesuai ketentuan PBJ.',
        ]);

        syarat_detail::create([
            'syarat_id' => $syarat2->id,
            'keterangan' => 'Memiliki NIB dengan kualifikasi minimal Kecil',
        ]);

        // Tender File untuk Tender 2
        $files2 = [
            ['tender_id' => $tender2->id, 'nama' => 'Surat Izin Usaha', 'keterangan' => 'NIB yang masih berlaku'],
            ['tender_id' => $tender2->id, 'nama' => 'Surat Penawaran', 'keterangan' => 'Penawaran harga dan teknis'],
        ];
        foreach ($files2 as $file) {
            tender_file::create($file);
        }

        // Tender Persyaratan untuk Tender 2
        $persyaratan2 = tender_persyaratan::create([
            'user_id' => $adminId,
            'tender_id' => $tender2->id,
            'judul' => 'Spesifikasi Teknis Komputer',
            'penjelasan' => 'Laptop Core i7 Gen 12, RAM 16GB, SSD 512GB, Windows 11 Pro. Komputer Desktop Core i5 Gen 12, RAM 8GB, SSD 256GB.',
        ]);

        // ==========================================
        // 4. TENDER AKTIF 3: Jasa Konsultansi
        // ==========================================
        $tender3 = tender::create([
            'user_id' => $adminId,
            'nama' => 'Jasa Konsultansi Perencanaan Jalan Tol',
            'paket' => 'JK-03/PA/2024',
            'tahapan_id' => 0,
            'jenis_pegadaan_id' => 3, // Jasa Konsultansi Badan Usaha
            'jenis_kontrak_id' => 5, // Biaya Plus Imbalan
            'metode_pengadaan_id' => 1, // Tender Umum
            'syarat_id' => 0,
            'status_tender_id' => 2, // Publish
            'KLPD' => 'Kementerian PUPR',
            'sumber_dana' => 'APBN',
            'satuan_kerja' => 'Direktorat Jenderal Bina Marga',
            'tahun_anggaran' => $now->format('Y') . '-01-01',
            'lokasi_pekerjaan' => 'Jawa Barat',
            'nilai_pagu' => 15000000000, // 15 Miliar
            'hps' => 14500000000, // 14.5 Miliar
            'default' => 0,
        ]);

        // Tahapan Tender 3
        $tahapan3 = [
            ['tender_id' => $tender3->id, 'nama' => 'Pendaftaran', 'mulai' => $now->copy()->addDays(1)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(14)->format('Y-m-d'), 'keterangan' => 'Jadwal: Pendaftaran', 'status' => 1],
            ['tender_id' => $tender3->id, 'nama' => 'Aanwijzing', 'mulai' => $now->copy()->addDays(15)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(15)->format('Y-m-d'), 'keterangan' => 'Jadwal: Aanwijzing', 'status' => 0],
            ['tender_id' => $tender3->id, 'nama' => 'Penawaran', 'mulai' => $now->copy()->addDays(16)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(35)->format('Y-m-d'), 'keterangan' => 'Jadwal: Penawaran', 'status' => 4],
            ['tender_id' => $tender3->id, 'nama' => 'Evaluasi', 'mulai' => $now->copy()->addDays(36)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(50)->format('Y-m-d'), 'keterangan' => 'Jadwal: Evaluasi', 'status' => 0],
            ['tender_id' => $tender3->id, 'nama' => 'Negosiasi', 'mulai' => $now->copy()->addDays(51)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(55)->format('Y-m-d'), 'keterangan' => 'Jadwal: Negosiasi', 'status' => 0],
            ['tender_id' => $tender3->id, 'nama' => 'Penetapan Pemenang', 'mulai' => $now->copy()->addDays(56)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(60)->format('Y-m-d'), 'keterangan' => 'Jadwal: Penetapan Pemenang', 'status' => 3],
        ];
        foreach ($tahapan3 as $t) {
            tahapan::create($t);
        }

        // Syarat Tender 3
        $syarat3 = syarat::create([
            'tender_id' => $tender3->id,
            'judul' => 'Persyaratan Kualifikasi Konsultan',
            'izin' => 'NIB',
            'usaha' => 'Badan Usaha Konsultansi',
            'content' => 'Persyaratan kualifikasi jasa konsultansi sesuai ketentuan PBJ.',
        ]);

        syarat_detail::create([
            'syarat_id' => $syarat3->id,
            'keterangan' => 'Memiliki NIB dengan kualifikasi minimal Besar',
        ]);
        syarat_detail::create([
            'syarat_id' => $syarat3->id,
            'keterangan' => 'Pengalaman minimal 5 proyek perencanaan infrastruktur dalam 10 tahun terakhir',
        ]);

        // Tender File untuk Tender 3
        $files3 = [
            ['tender_id' => $tender3->id, 'nama' => 'Dokumen Kualifikasi', 'keterangan' => 'Izin usaha, akta, NPWP'],
            ['tender_id' => $tender3->id, 'nama' => 'Proposal Teknis', 'keterangan' => 'Metodologi, jadwal, tenaga ahli'],
            ['tender_id' => $tender3->id, 'nama' => 'Proposal Harga', 'keterangan' => 'Rincian biaya jasa konsultansi'],
        ];
        foreach ($files3 as $file) {
            tender_file::create($file);
        }

        // Tender Persyaratan untuk Tender 3
        $persyaratan3 = tender_persyaratan::create([
            'user_id' => $adminId,
            'tender_id' => $tender3->id,
            'judul' => 'Tor Konsultansi Perencanaan Jalan Tol',
            'penjelasan' => 'Penyusunan DED (Detailed Engineering Design) jalan tol sepanjang 50 km termasuk jembatan dan underpass.',
        ]);
    }
}
