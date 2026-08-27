<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\jenis_pengadaan;
use App\Models\jenis_kontrak;
use App\Models\metode_pengadaan;
use App\Models\status_tender;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jenis Pengadaan sesuai Perpres 16/2018
        $jenisPengadaan = [
            ['nama' => 'Pengadaan Barang'],
            ['nama' => 'Pekerjaan Konstruksi'],
            ['nama' => 'Jasa Konsultansi Badan Usaha'],
            ['nama' => 'Jasa Konsultansi Perorangan'],
            ['nama' => 'Jasa Lainnya'],
        ];
        foreach ($jenisPengadaan as $jp) {
            jenis_pengadaan::create($jp);
        }

        // Jenis Kontrak
        $jenisKontrak = [
            ['nama' => 'Lump Sum'],
            ['nama' => 'Harga Satuan'],
            ['nama' => 'Gabungan Lump Sum dan Harga Satuan'],
            ['nama' => 'Terima Jadi (Turn Key)'],
            ['nama' => 'Persentase'],
            ['nama' => 'Biaya Plus Imbalan'],
        ];
        foreach ($jenisKontrak as $jk) {
            jenis_kontrak::create($jk);
        }

        // Metode Pengadaan sesuai Perpres 16/2018
        $metodePengadaan = [
            ['nama' => 'Tender Umum'],
            ['nama' => 'Tender Terbatas'],
            ['nama' => 'Pemilihan Langsung'],
            ['nama' => 'Penunjukan Langsung'],
            ['nama' => 'Pengadaan Langsung'],
            ['nama' => 'E-Purchasing'],
            ['nama' => 'Sayembara'],
        ];
        foreach ($metodePengadaan as $mp) {
            metode_pengadaan::create($mp);
        }

        // Status Tender
        $statusTender = [
            ['nama' => 'Draft'],
            ['nama' => 'Publish'],
            ['nama' => 'Pendaftaran'],
            ['nama' => 'Pengambilan Dokumen'],
            ['nama' => 'Aanwijzing'],
            ['nama' => 'Penawaran'],
            ['nama' => 'Evaluasi'],
            ['nama' => 'Negosiasi'],
            ['nama' => 'Selesai'],
            ['nama' => 'Batal'],
        ];
        foreach ($statusTender as $st) {
            status_tender::create($st);
        }
    }
}
