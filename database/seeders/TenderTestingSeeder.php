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
use App\Models\penawaran;
use App\Models\penawaran_file;
use Carbon\Carbon;

/**
 * Seeder untuk 1 TENDER UJI COBA yang BELUM diikuti peserta mana pun.
 * Alur skenario: user peserta login -> /tender_home/{id} -> Daftar Karena status=1
 * -> daftar_peserta -> upload berkas -> upload penawaran (status=4).
 * Sengaja TIDAK membuat peserta / daftar_peserta / penawaran / penilaian.
 */
class TenderTestingSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $adminId = \App\Models\User::where('hak_akses', 'admin')->value('id') ?? 1;

        $nama = 'Pengadaan Meubelair Kantor (Tender Uji Coba)';

        // Jika tender sudah ada: RESET jadwal tahapan ke hari ini agar selalu siap di-test.
        if ($existing = tender::where('nama', $nama)->first()) {
            $this->command?->info('[update] Tender uji coba sudah ada (id=' . $existing->id . ') — jadwal tahapan di-reset ke hari ini.');
            $today = $now->copy()->format('Y-m-d');
            $map = [
                1 => ['label' => 'Pendaftaran', 'mulai' => $today, 'akhir' => $now->copy()->addDays(7)->format('Y-m-d')],
                2 => ['label' => 'Pengambilan Dok', 'mulai' => $today, 'akhir' => $now->copy()->addDays(7)->format('Y-m-d')],
                4 => ['label' => 'Upload File', 'mulai' => $today, 'akhir' => $now->copy()->addDays(14)->format('Y-m-d')],
                3 => ['label' => 'Pemenang', 'mulai' => $now->copy()->addDays(30)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(35)->format('Y-m-d')],
            ];
            $n = 0;
            foreach (tahapan::where('tender_id', $existing->id)->orderBy('status')->get() as $th) {
                if (isset($map[$th->status])) {
                    $th->update(['mulai' => $map[$th->status]['mulai'], 'akhir' => $map[$th->status]['akhir']]);
                } else { // status 0 -> bertahap setelah hari ini
                    $mulai = $now->copy()->addDays(15 + $n)->format('Y-m-d');
                    $th->update(['mulai' => $mulai, 'akhir' => $mulai]);
                    $n++;
                }
            }
            $this->ensurePenawaran($existing->id, $adminId);
            return;
        }

        // ==========================================
        // TENDER UTAMA (default=0, publish)
        // ==========================================
        $t = tender::create([
            'user_id' => $adminId,
            'nama' => $nama,
            'paket' => 'PB-TEST/001/TA/' . $now->format('Y'),
            'tahapan_id' => 0,
            'jenis_pegadaan_id' => 1,          // Pengadaan Barang
            'jenis_kontrak_id' => 1,           // Lump Sum
            'metode_pengadaan_id' => 1,        // Tender Umum
            'syarat_id' => 0,
            'status_tender_id' => 2,           // Publish
            'KLPD' => 'Pemerintah Daerah',
            'sumber_dana' => 'APBD',
            'satuan_kerja' => 'Bagian Umum Sekretariat Daerah',
            'tahun_anggaran' => $now->format('Y') . '-01-01',
            'lokasi_pekerjaan' => 'Kantor Bupati',
            'nilai_pagu' => 1500000000,        // 1,5 M
            'hps' => 1450000000,               // 1,45 M
            'default' => 0,
        ]);

        // ==========================================
        // TAHAPAN (status 1 = Masa Pendaftaran, 4 = Upload File)
        // ==========================================
        $tahapan = [
            ['nama' => 'Pendaftaran', 'mulai' => $now->copy()->format('Y-m-d'), 'akhir' => $now->copy()->addDays(7)->format('Y-m-d'), 'status' => 1],
            ['nama' => 'Pengambilan Dokumen', 'mulai' => $now->copy()->format('Y-m-d'), 'akhir' => $now->copy()->addDays(10)->format('Y-m-d'), 'status' => 2],
            ['nama' => 'Upload File Penawaran', 'mulai' => $now->copy()->format('Y-m-d'), 'akhir' => $now->copy()->addDays(14)->format('Y-m-d'), 'status' => 4],
            ['nama' => 'Pembukaan Penawaran', 'mulai' => $now->copy()->addDays(15)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(15)->format('Y-m-d'), 'status' => 0],
            ['nama' => 'Evaluasi', 'mulai' => $now->copy()->addDays(16)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(25)->format('Y-m-d'), 'status' => 0],
            ['nama' => 'Penetapan Pemenang', 'mulai' => $now->copy()->addDays(26)->format('Y-m-d'), 'akhir' => $now->copy()->addDays(30)->format('Y-m-d'), 'status' => 3],
        ];
        foreach ($tahapan as $th) {
            tahapan::create([
                'tender_id' => $t->id,
                'nama' => $th['nama'],
                'mulai' => $th['mulai'],
                'akhir' => $th['akhir'],
                'keterangan' => 'Jadwal: ' . $th['nama'],
                'status' => $th['status'],
            ]);
        }

        // ==========================================
        // SYARAT & DETAIL
        // ==========================================
        $s = syarat::create([
            'tender_id' => $t->id,
            'judul' => 'Persyaratan Peserta Pengadaan Barang',
            'izin' => 'NIB',
            'usaha' => 'Badan Usaha',
            'content' => 'Persyaratan kualifikasi peserta pengadaan meubelair sesuai ketentuan PBJ.',
        ]);
        syarat_detail::create(['syarat_id' => $s->id, 'keterangan' => 'Memiliki NIB yang masih berlaku']);
        syarat_detail::create(['syarat_id' => $s->id, 'keterangan' => 'Memiliki NPWP dan KSWP valid']);
        syarat_detail::create(['syarat_id' => $s->id, 'keterangan' => 'Sanggup menyelesaikan pekerjaan sesuai spesifikasi']);

        // ==========================================
        // TENDER_FILE (berkas wajib yang diupload peserta)
        // ==========================================
        $files = [
            ['nama' => 'Surat Izin Usaha (NIB)', 'keterangan' => 'Scan NIB yang masih berlaku'],
            ['nama' => 'Akta Pendirian Perusahaan', 'keterangan' => 'Scan akta pendirian & perubahan terakhir'],
            ['nama' => 'NPWP & KSWP', 'keterangan' => 'Scan NPWP dan bukti KSWP'],
            ['nama' => 'Surat Penawaran', 'keterangan' => 'Penawaran harga + dokumen teknis'],
        ];
        foreach ($files as $f) {
            tender_file::create([
                'tender_id' => $t->id,
                'nama' => $f['nama'],
                'keterangan' => $f['keterangan'],
            ]);
        }

        // ==========================================
        // TENDER PERSYARATAN + FILE
        // ==========================================
        $tp = tender_persyaratan::create([
            'user_id' => $adminId,
            'tender_id' => $t->id,
            'judul' => 'Spesifikasi Meubelair',
            'penjelasan' => 'Meja kantor 1/2 biro kayu multiplek finishing HPL, kursi besi rotan, lemari arsip 4 susun, dan rak buku. Standar SNI.',
        ]);
        tender_persyaratan_file::create([
            'user_id' => $adminId,
            'tender_persyaratan_id' => $tp->id,
            'file' => 'Tender/FT/meubelair-spec.pdf',
            'nama' => 'Spesifikasi Teknis.pdf',
        ]);

        // ==========================================
        // ADMINISTRASI PEMERIKSAAN (tanpa file peserta)
        // ==========================================
        $a = administrasi::create([
            'user_id' => $adminId,
            'tender_id' => $t->id,
            'nama' => 'Kelengkapan Dokumen Administrasi',
            'keterangan' => 'Pemeriksaan dokumen administrasi peserta.',
        ]);
        foreach (['Surat Izin Usaha', 'Akta Pendirian', 'NPWP', 'KSWP', 'Surat Penawaran'] as $ad) {
            administrasi_detail::create([
                'user_id' => $adminId,
                'tender_id' => $t->id,
                'peserta_id' => 0,
                'administrasi_id' => $a->id,
                'nama' => $ad,
                'file' => '',
            ]);
        }

        $this->ensurePenawaran($t->id, $adminId);

        $this->command?->info("[ok] Tender uji coba dibuat (id={$t->id}): {$t->nama}");
    }

    /**
     * Pastikan data penawaran (judul/hps + file wajib) tersedia untuk tender.
     * Tanpa ini, /penawaran_file/{id} tampil HPS 0 & submit penawaran error (penawaran null).
     */
    private function ensurePenawaran(int $tenderId, int $userId): void
    {
        if (penawaran::where('tender_id', $tenderId)->exists()) {
            return;
        }

        $p = penawaran::create([
            'user_id' => $userId,
            'tender_id' => $tenderId,
            'judul' => 'Penawaran Pengadaan Meubelair Kantor',
            'penjelasan' => 'Penawaran harga terendah yang memenuhi spesifikasi teknis meubelair.',
            'anggaran' => '1500000000',
            'hps' => '1450000000',
        ]);

        $p->penawaran_file()->createMany([
            ['user_id' => $userId, 'nama' => 'File Penawaran Harga', 'keterangan' => 'Rincian harga penawaran (RAB)'],
            ['user_id' => $userId, 'nama' => 'Dokumen Penawaran Teknis', 'keterangan' => 'Spesifikasi, jaminan barang, dan metode pelaksanaan'],
        ]);

        $this->command?->info('[ok] Data penawaran + file wajib dibuat untuk tender ' . $tenderId);
    }
}