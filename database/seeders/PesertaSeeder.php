<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\peserta;
use App\Models\daftar_peserta;
use App\Models\pengalaman_tender;
use App\Models\tenaga_ahli;
use App\Models\peralatan;
use App\Models\pekerjaan_berjalan;
use App\Models\managemen;
use App\Models\penawaran;
use App\Models\penawaran_peserta;
use App\Models\penawaran_peserta_file;
use App\Models\tender_file_detail;
use Carbon\Carbon;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // ============================================
        // PESERTA 1: PT Maju Jaya Konstruksi (User id=2)
        // Mendaftar Tender 1 (Pembangunan Gedung)
        // ============================================
        $p1 = peserta::create([
            'tender_id' => 1,       // tender default
            'user_id' => 2,
            'NPWP' => '123456789012345',
            'nama_npwp' => 'PT Maju Jaya Konstruksi',
            'nama_pt' => 'PT Maju Jaya Konstruksi',
            'no_hp' => '081234567890',
            'email' => 'peserta1@maju-jaya.co.id',
            'alamat' => 'Jl. Raya Cilandak No. 10, Jakarta Selatan',
            'izin' => 'NIB',
            'nomor_izin' => '8120001234567',
            'izin_berlaku' => '2050-01-01',
            'instansi_pemberi' => 'Kementerian Perdagangan RI',
            'kualifikasi' => 'Menengah',
            'klasifikasi' => 'Bangunan Gedung',
            'no_akta' => '001',
            'tgl_akta' => '2015-03-15',
            'notaris' => 'Notaris Sri Wahyuni, SH',
            'no_aktab' => '072',
            'tgl_aktab' => '2020-07-10',
            'notaris_b' => 'Notaris Budi Santoso, SH',
            'kswp_npwp' => '123456789012345',
            'kswp_nama' => 'PT Maju Jaya Konstruksi',
            'penawaran' => 24500000000,
            'harga_koreksi' => 24450000000,
        ]);

        // File peserta (tender_file_detail) - mencerminkan upload registrasi tender default (id=1)
        tender_file_detail::create([
            'tender_file_id' => 1,      // Dokumen Kualifikasi (tender1)
            'peserta_id' => $p1->id,
            'user_id' => 2,
            'files' => 'Tender/FILE/1/1/dummy1.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 2,      // Surat Penawaran
            'peserta_id' => $p1->id,
            'user_id' => 2,
            'files' => 'Tender/FILE/1/2/dummy2.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 3,      // Dokumen Teknis
            'peserta_id' => $p1->id,
            'user_id' => 2,
            'files' => 'Tender/FILE/1/3/dummy3.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 4,      // Dokumen Penawaran Harga
            'peserta_id' => $p1->id,
            'user_id' => 2,
            'files' => 'Tender/FILE/1/4/dummy4.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);

        // Pengalaman tender untuk peserta 1
        pengalaman_tender::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'pekerjaan' => 'Pembangunan Gedung Kantor 3 Lantai',
            'lokasi' => 'Jakarta',
            'instansi' => 'Kementerian PUPR',
            'alamat' => 'Jl. Pattimura No. 20, Jakarta',
            'no_hp' => '081234567890',
            'no_kontrak' => 'KONTR/001/2021',
            'tgl_kontrak' => '2021-02-01',
            'presentasi' => 100,
            'tgl_selesai_kontrak' => '2021-12-31',
            'tgl_serah_terima' => '2022-01-15',
            'keterangan' => 'Proyek selesai tepat waktu',
            'nilai_kontrak' => '15000000000',
            'file' => 'Tender/FILE/pengalaman/1.pdf',
            'nama_file' => 'Kontrak.pdf',
        ]);
        pengalaman_tender::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'pekerjaan' => 'Renovasi Gedung Sekolah',
            'lokasi' => 'Bogor',
            'instansi' => 'Dinas Pendidikan',
            'alamat' => 'Jalan Ahmad Yani, Bogor',
            'no_hp' => '081234567890',
            'no_kontrak' => 'KONTR/002/2020',
            'tgl_kontrak' => '2020-05-01',
            'presentasi' => 100,
            'tgl_selesai_kontrak' => '2020-11-30',
            'tgl_serah_terima' => '2020-12-10',
            'keterangan' => 'Proyek selesai',
            'nilai_kontrak' => '8000000000',
            'file' => 'Tender/FILE/pengalaman/2.pdf',
            'nama_file' => 'Kontrak2.pdf',
        ]);

        // Tenaga Ahli & Teknis peserta 1
        tenaga_ahli::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'nama' => 'Ir. Bambang Sutrisno',
            'tgl_lahir' => '1980-05-10',
            'jk' => 'L',
            'alamat' => 'Jl. Kapten Tendean, Jakarta',
            'negara' => 'Indonesia',
            'jabatan' => 'Project Manager',
            'pengalaman' => '15 tahun di bidang konstruksi',
            'email' => 'bambang@maju-jaya.co.id',
            'keterangan' => 'Sertifikasi Ahli Madya',
            'file' => 'Tender/FILE/tenaga/1.pdf',
            'nama_file' => 'CV.pdf',
        ]);
        tenaga_ahli::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'nama' => 'Andi Wijaya, ST',
            'tgl_lahir' => '1985-08-20',
            'jk' => 'L',
            'alamat' => 'Jl. Fatmawati, Jakarta',
            'negara' => 'Indonesia',
            'jabatan' => 'Site Engineer',
            'pengalaman' => '10 tahun di bidang konstruksi',
            'email' => 'andi@maju-jaya.co.id',
            'keterangan' => 'Sertifikasi Ahli Muda',
            'file' => 'Tender/FILE/tenaga/2.pdf',
            'nama_file' => 'CV2.pdf',
        ]);

        // Peralatan peserta 1
        peralatan::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'nama' => 'Excavator PC 200',
            'jumlah' => '2',
            'kapasitas' => '20 ton',
            'merk' => 'Komatsu',
            'tahun' => '2020',
            'kondisi' => 'Baik',
            'lokasi' => 'Jakarta',
            'kepemilikan' => 'Milik Sendiri',
            'bukti' => 'Serah Terima',
            'file' => 'Tender/FILE/peralatan/1.pdf',
        ]);
        peralatan::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'nama' => 'Crane 25 ton',
            'jumlah' => '1',
            'kapasitas' => '25 ton',
            'merk' => 'Tadano',
            'tahun' => '2019',
            'kondisi' => 'Baik',
            'lokasi' => 'Jakarta',
            'kepemilikan' => 'Milik Sendiri',
            'bukti' => 'Serah Terima',
            'file' => 'Tender/FILE/peralatan/2.pdf',
        ]);

        // Pekerjaan berjalan peserta 1
        pekerjaan_berjalan::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'pekerjaan' => 'Pembangunan Jembatan',
            'lokasi' => 'Kalimantan',
            'instansi' => 'Kementerian PUPR',
            'alamat' => 'Jl. Kapten Pierre Tendean',
            'no_hp' => '081234567890',
            'no_kontrak' => 'KONTR/003/2023',
            'tgl_kontrak' => '2023-01-01',
            'presentasi' => 50,
            'tgl_selesai_kontrak' => '2024-01-01',
            'tgl_serah_terima' => '2024-02-01',
            'keterangan' => 'Sedang berjalan',
            'nilai_kontrak' => '20000000000',
        ]);

        // Managemen peserta 1
        managemen::create([
            'peserta_id' => $p1->id,
            'tender_id' => 2,
            'user_id' => 2,
            'nama' => 'H. Ahmad Fauzi, SE',
            'tgl_menjabat' => '2015-01-01',
            'tgl_berakhir' => '2025-01-01',
            'no_rekening' => '012345678901',
            'master_id' => '100001',
            'alamat' => 'Jl. Cilandak No. 10, Jakarta',
            'npwp' => '123456789012345',
            'status' => 'Direktur Utama',
            'file1' => 'Tender/FILE/managemen/ktp.pdf',
            'ket1' => 'Sertifikat 1',
        ]);

        // Daftar peserta (mengikuti lelang tender 2)
        daftar_peserta::create([
            'user_id' => 2,
            'tender_id' => 2,
            'peserta_id' => $p1->id,
        ]);

        // ============================================
        // PESERTA 2: PT Sejahtera Abadi (User id=3)
        // ============================================
        $p2 = peserta::create([
            'tender_id' => 1,       // tender default
            'user_id' => 3,
            'NPWP' => '987654321098765',
            'nama_npwp' => 'PT Sejahtera Abadi',
            'nama_pt' => 'PT Sejahtera Abadi',
            'no_hp' => '082198765432',
            'email' => 'peserta2@sejahtera.co.id',
            'alamat' => 'Jl. Pasar Minggu No. 25, Jakarta Selatan',
            'izin' => 'NIB',
            'nomor_izin' => '8120007654321',
            'izin_berlaku' => '2050-01-01',
            'instansi_pemberi' => 'Kementerian Perdagangan RI',
            'kualifikasi' => 'Menengah',
            'klasifikasi' => 'Bangunan Sipil',
            'no_akta' => '012',
            'tgl_akta' => '2016-06-20',
            'notaris' => 'Notaris Dewi Lestari, SH',
            'no_aktab' => '088',
            'tgl_aktab' => '2021-01-15',
            'notaris_b' => 'Notaris Agus Salim, SH',
            'kswp_npwp' => '987654321098765',
            'kswp_nama' => 'PT Sejahtera Abadi',
            'penawaran' => 24600000000,
            'harga_koreksi' => 24550000000,
        ]);

        // File peserta 2
        tender_file_detail::create([
            'tender_file_id' => 1,
            'peserta_id' => $p2->id,
            'user_id' => 3,
            'files' => 'Tender/FILE/1/1/dummy-p2-1.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 2,
            'peserta_id' => $p2->id,
            'user_id' => 3,
            'files' => 'Tender/FILE/1/2/dummy-p2-2.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 3,
            'peserta_id' => $p2->id,
            'user_id' => 3,
            'files' => 'Tender/FILE/1/3/dummy-p2-3.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 4,
            'peserta_id' => $p2->id,
            'user_id' => 3,
            'files' => 'Tender/FILE/1/4/dummy-p2-4.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);

        // Pengalaman peserta 2
        pengalaman_tender::create([
            'peserta_id' => $p2->id,
            'tender_id' => 2,
            'user_id' => 3,
            'pekerjaan' => 'Pembangunan Jalan Tol',
            'lokasi' => 'Jawa Barat',
            'instansi' => 'Kementerian PUPR',
            'alamat' => 'Bandung',
            'no_hp' => '082198765432',
            'no_kontrak' => 'KONTR/101/2019',
            'tgl_kontrak' => '2019-03-01',
            'presentasi' => 100,
            'tgl_selesai_kontrak' => '2021-03-31',
            'tgl_serah_terima' => '2021-04-20',
            'keterangan' => 'Selesai',
            'nilai_kontrak' => '30000000000',
            'file' => 'Tender/FILE/pengalaman/p2.pdf',
            'nama_file' => 'Kontrak.pdf',
        ]);

        // Tenaga ahli peserta 2
        tenaga_ahli::create([
            'peserta_id' => $p2->id,
            'tender_id' => 2,
            'user_id' => 3,
            'nama' => 'Ir. Hendra Gunawan',
            'tgl_lahir' => '1975-02-12',
            'jk' => 'L',
            'alamat' => 'Jl. Melati, Jakarta',
            'negara' => 'Indonesia',
            'jabatan' => 'Project Director',
            'pengalaman' => '20 tahun',
            'email' => 'hendra@sejahtera.co.id',
            'keterangan' => 'Sertifikasi Ahli Utama',
            'file' => 'Tender/FILE/tenaga/p2-1.pdf',
            'nama_file' => 'CV.pdf',
        ]);

        // Peralatan peserta 2
        peralatan::create([
            'peserta_id' => $p2->id,
            'tender_id' => 2,
            'user_id' => 3,
            'nama' => 'Bulldozer D85',
            'jumlah' => '3',
            'kapasitas' => '30 ton',
            'merk' => 'Komatsu',
            'tahun' => '2021',
            'kondisi' => 'Baik',
            'lokasi' => 'Bekasi',
            'kepemilikan' => 'Milik Sendiri',
            'bukti' => 'Serah Terima',
            'file' => 'Tender/FILE/peralatan/p2-1.pdf',
        ]);

        // Managemen peserta 2
        managemen::create([
            'peserta_id' => $p2->id,
            'tender_id' => 2,
            'user_id' => 3,
            'nama' => 'Siti Rahma, MBA',
            'tgl_menjabat' => '2016-01-01',
            'tgl_berakhir' => '2026-01-01',
            'no_rekening' => '023456789012',
            'master_id' => '100002',
            'alamat' => 'Jl. Pasar Minggu No. 25, Jakarta',
            'npwp' => '987654321098765',
            'status' => 'Direktur Utama',
            'file1' => 'Tender/FILE/managemen/p2-ktp.pdf',
            'ket1' => 'Sertifikat 1',
        ]);

        // Daftar peserta 2
        daftar_peserta::create([
            'user_id' => 3,
            'tender_id' => 2,
            'peserta_id' => $p2->id,
        ]);

        // ============================================
        // PESERTA 3: PT Bangun Nusantara (User id=4)
        // ============================================
        $p3 = peserta::create([
            'tender_id' => 1,
            'user_id' => 4,
            'NPWP' => '555444333222111',
            'nama_npwp' => 'PT Bangun Nusantara',
            'nama_pt' => 'PT Bangun Nusantara',
            'no_hp' => '085156789012',
            'email' => 'peserta3@bangun-nusantara.co.id',
            'alamat' => 'Jl. Sudirman No. 88, Jakarta Pusat',
            'izin' => 'NIB',
            'nomor_izin' => '8120005554443',
            'izin_berlaku' => '2049-01-01',
            'instansi_pemberi' => 'Kementerian Perdagangan RI',
            'kualifikasi' => 'Besar',
            'klasifikasi' => 'Konstruksi Gedung',
            'no_akta' => '023',
            'tgl_akta' => '2014-09-10',
            'notaris' => 'Notaris Ratna Dewi, SH',
            'no_aktab' => '101',
            'tgl_aktab' => '2022-03-05',
            'notaris_b' => 'Notaris Joko Susilo, SH',
            'kswp_npwp' => '555444333222111',
            'kswp_nama' => 'PT Bangun Nusantara',
            'penawaran' => 24300000000,
            'harga_koreksi' => 24250000000,
        ]);

        // File peserta 3
        tender_file_detail::create([
            'tender_file_id' => 1,
            'peserta_id' => $p3->id,
            'user_id' => 4,
            'files' => 'Tender/FILE/1/1/dummy-p3-1.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 2,
            'peserta_id' => $p3->id,
            'user_id' => 4,
            'files' => 'Tender/FILE/1/2/dummy-p3-2.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 3,
            'peserta_id' => $p3->id,
            'user_id' => 4,
            'files' => 'Tender/FILE/1/3/dummy-p3-3.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 4,
            'peserta_id' => $p3->id,
            'user_id' => 4,
            'files' => 'Tender/FILE/1/4/dummy-p3-4.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);

        // Pengalaman peserta 3
        pengalaman_tender::create([
            'peserta_id' => $p3->id,
            'tender_id' => 2,
            'user_id' => 4,
            'pekerjaan' => 'Pembangunan Apartemen 10 Lantai',
            'lokasi' => 'Jakarta Utara',
            'instansi' => 'BUMN',
            'alamat' => 'Jakarta',
            'no_hp' => '085156789012',
            'no_kontrak' => 'KONTR/201/2020',
            'tgl_kontrak' => '2020-06-01',
            'presentasi' => 100,
            'tgl_selesai_kontrak' => '2022-06-30',
            'tgl_serah_terima' => '2022-07-20',
            'keterangan' => 'Selesai',
            'nilai_kontrak' => '120000000000',
            'file' => 'Tender/FILE/pengalaman/p3.pdf',
            'nama_file' => 'Kontrak.pdf',
        ]);

        // Tenaga ahli peserta 3
        tenaga_ahli::create([
            'peserta_id' => $p3->id,
            'tender_id' => 2,
            'user_id' => 4,
            'nama' => 'Ir. Rudi Hermawan',
            'tgl_lahir' => '1978-11-05',
            'jk' => 'L',
            'alamat' => 'Jl. M.H. Thamrin, Jakarta',
            'negara' => 'Indonesia',
            'jabatan' => 'General Manager',
            'pengalaman' => '18 tahun',
            'email' => 'rudi@bangun-nusantara.co.id',
            'keterangan' => 'Sertifikasi Ahli Utama',
            'file' => 'Tender/FILE/tenaga/p3-1.pdf',
            'nama_file' => 'CV.pdf',
        ]);

        // Managemen peserta 3
        managemen::create([
            'peserta_id' => $p3->id,
            'tender_id' => 2,
            'user_id' => 4,
            'nama' => 'Drs. Bambang Priyanto, MM',
            'tgl_menjabat' => '2014-01-01',
            'tgl_berakhir' => '2024-01-01',
            'no_rekening' => '034567890123',
            'master_id' => '100003',
            'alamat' => 'Jl. Sudirman No. 88, Jakarta',
            'npwp' => '555444333222111',
            'status' => 'Direktur Utama',
            'file1' => 'Tender/FILE/managemen/p3-ktp.pdf',
            'ket1' => 'Sertifikat 1',
        ]);

        // Daftar peserta 3
        daftar_peserta::create([
            'user_id' => 4,
            'tender_id' => 2,
            'peserta_id' => $p3->id,
        ]);

        // ============================================
        // PESERTA 4: PT Mitra Sejati (User id=5)
        // ============================================
        $p4 = peserta::create([
            'tender_id' => 1,
            'user_id' => 5,
            'NPWP' => '777666555444333',
            'nama_npwp' => 'PT Mitra Sejati',
            'nama_pt' => 'PT Mitra Sejati',
            'no_hp' => '082233445566',
            'email' => 'peserta4@mitra-sejati.co.id',
            'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
            'izin' => 'NIB',
            'nomor_izin' => '8120007776665',
            'izin_berlaku' => '2048-01-01',
            'instansi_pemberi' => 'Kementerian Perdagangan RI',
            'kualifikasi' => 'Menengah',
            'klasifikasi' => 'Bangunan Gedung',
            'no_akta' => '034',
            'tgl_akta' => '2017-04-12',
            'notaris' => 'Notaris Mega Puspita, SH',
            'no_aktab' => '115',
            'tgl_aktab' => '2021-08-18',
            'notaris_b' => 'Notaris Fajar Nugroho, SH',
            'kswp_npwp' => '777666555444333',
            'kswp_nama' => 'PT Mitra Sejati',
            'penawaran' => 24700000000,
            'harga_koreksi' => 24650000000,
        ]);

        // File peserta 4
        tender_file_detail::create([
            'tender_file_id' => 1,
            'peserta_id' => $p4->id,
            'user_id' => 5,
            'files' => 'Tender/FILE/1/1/dummy-p4-1.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 2,
            'peserta_id' => $p4->id,
            'user_id' => 5,
            'files' => 'Tender/FILE/1/2/dummy-p4-2.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 3,
            'peserta_id' => $p4->id,
            'user_id' => 5,
            'files' => 'Tender/FILE/1/3/dummy-p4-3.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);
        tender_file_detail::create([
            'tender_file_id' => 4,
            'peserta_id' => $p4->id,
            'user_id' => 5,
            'files' => 'Tender/FILE/1/4/dummy-p4-4.pdf',
            'keterangan' => '',
            'tender_id' => 1,
            'status_id' => 1,
        ]);

        // Pengalaman peserta 4
        pengalaman_tender::create([
            'peserta_id' => $p4->id,
            'tender_id' => 2,
            'user_id' => 5,
            'pekerjaan' => 'Pembangunan Gedung Perkantoran',
            'lokasi' => 'Jakarta Barat',
            'instansi' => 'Kementerian Keuangan',
            'alamat' => 'Jakarta',
            'no_hp' => '082233445566',
            'no_kontrak' => 'KONTR/301/2021',
            'tgl_kontrak' => '2021-02-15',
            'presentasi' => 100,
            'tgl_selesai_kontrak' => '2022-02-14',
            'tgl_serah_terima' => '2022-03-01',
            'keterangan' => 'Selesai',
            'nilai_kontrak' => '10000000000',
            'file' => 'Tender/FILE/pengalaman/p4.pdf',
            'nama_file' => 'Kontrak.pdf',
        ]);

        // Tenaga ahli peserta 4
        tenaga_ahli::create([
            'peserta_id' => $p4->id,
            'tender_id' => 2,
            'user_id' => 5,
            'nama' => 'Ir. Agus Kurniawan',
            'tgl_lahir' => '1982-09-25',
            'jk' => 'L',
            'alamat' => 'Jl. Rasuna Said, Jakarta',
            'negara' => 'Indonesia',
            'jabatan' => 'Site Manager',
            'pengalaman' => '12 tahun',
            'email' => 'agus@mitra-sejati.co.id',
            'keterangan' => 'Sertifikasi Ahli Madya',
            'file' => 'Tender/FILE/tenaga/p4-1.pdf',
            'nama_file' => 'CV.pdf',
        ]);

        // Managemen peserta 4
        managemen::create([
            'peserta_id' => $p4->id,
            'tender_id' => 2,
            'user_id' => 5,
            'nama' => 'Yulia Kusuma, SH',
            'tgl_menjabat' => '2017-01-01',
            'tgl_berakhir' => '2027-01-01',
            'no_rekening' => '045678901234',
            'master_id' => '100004',
            'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta',
            'npwp' => '777666555444333',
            'status' => 'Direktur Utama',
            'file1' => 'Tender/FILE/managemen/p4-ktp.pdf',
            'ket1' => 'Sertifikat 1',
        ]);

        // Daftar peserta 4
        daftar_peserta::create([
            'user_id' => 5,
            'tender_id' => 2,
            'peserta_id' => $p4->id,
        ]);

        // ============================================
        // PENAWARAN (dari admin) & PENAWARAN PESERTA
        // ============================================
        $penawaran = penawaran::create([
            'user_id' => 1,
            'tender_id' => 2,
            'judul' => 'Penawaran Pembangunan Gedung Perkantoran 5 Lantai',
            'penjelasan' => 'Penawaran terbaik dengan harga terendah dan kualifikasi memenuhi syarat',
            'anggaran' => '25000000000',
            'hps' => '24500000000',
        ]);

        $pp1 = penawaran_peserta::create([
            'user_id' => 2,
            'tender_id' => 2,
            'peserta_id' => $p1->id,
            'penawaran' => '24500000000',
            'koreksi' => '24450000000',
        ]);
        penawaran_peserta_file::create([
            'user_id' => 2,
            'penawaran_peserta_id' => $pp1->id,
            'file' => 'Tender/FILE/2/penawaran/p1.pdf',
            'nama' => 'Penawaran PT Maju Jaya',
        ]);

        $pp2 = penawaran_peserta::create([
            'user_id' => 3,
            'tender_id' => 2,
            'peserta_id' => $p2->id,
            'penawaran' => '24600000000',
            'koreksi' => '24550000000',
        ]);
        penawaran_peserta_file::create([
            'user_id' => 3,
            'penawaran_peserta_id' => $pp2->id,
            'file' => 'Tender/FILE/2/penawaran/p2.pdf',
            'nama' => 'Penawaran PT Sejahtera Abadi',
        ]);

        $pp3 = penawaran_peserta::create([
            'user_id' => 4,
            'tender_id' => 2,
            'peserta_id' => $p3->id,
            'penawaran' => '24300000000',
            'koreksi' => '24250000000',
        ]);
        penawaran_peserta_file::create([
            'user_id' => 4,
            'penawaran_peserta_id' => $pp3->id,
            'file' => 'Tender/FILE/2/penawaran/p3.pdf',
            'nama' => 'Penawaran PT Bangun Nusantara',
        ]);

        $pp4 = penawaran_peserta::create([
            'user_id' => 5,
            'tender_id' => 2,
            'peserta_id' => $p4->id,
            'penawaran' => '24700000000',
            'koreksi' => '24650000000',
        ]);
        penawaran_peserta_file::create([
            'user_id' => 5,
            'penawaran_peserta_id' => $pp4->id,
            'file' => 'Tender/FILE/2/penawaran/p4.pdf',
            'nama' => 'Penawaran PT Mitra Sejati',
        ]);
    }
}