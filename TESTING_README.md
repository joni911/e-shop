# PANDUAN TESTING - SISTEM PENGADAAN PBJ

## 🔧 Perbaikan Error: Unknown column 'status' (tahapans)

**Gejala**: `SQLSTATE[42S22]: Unknown column 'status' in 'where clause'` saat membuka detail tender
(`TenderHomeController@show` mem-filter `tahapans.status = 1` dan `status = 4`).

**Akibat**: tabel `tahapans` tidak punya kolom `status` — migration-nya hilang dari project,
sementara `TahapanController@store/update` dan view form tahapan sudah memakainya.

**Solusi yang diterapkan**:
1. Migration baru `2026_08_27_123208_add_status_to_tahapans_table.php` → kolom `status` integer default 0
2. `TenderSeeder` kini mengisi `status` tiap tahapan: 17 tahapan, distribusi `0→8, 1→3, 2→1, 3→2, 4→3`
3. Setiap tender publish (T2/T3/T4) punya minimal 1 tahapan `status=1` (Masa Pendaftaran) dan `status=4` (Upload File)

**Arti nilai status**: `0` Biasa, `1` Masa Pendaftaran, `2` Masa Pembukaan File, `3` Pengumuman Pemenang, `4` Upload File

---

## 🧪 Hasil Pengujian TDD (Pendaftaran & Upload Tender 1)

**Test suite**: `tests/Feature/PendaftaranTest.php` — 8 test alur pendaftaran (10 total suite, 31 assertions, hijau).

### Fungsi pendaftaran user SEBENARNYA
| Route | Fungsi |
|-------|--------|
| `GET /peserta/create` | User baru → form registrasi profil + berkas (tender default); user yang sudah punya profil → redirect ke edit |
| `POST /peserta` (store) | Simpan profil & upload **semua berkas wajib** tender default; validasi file wajib per tender_file |
| `POST /daftar_peserta` | Daftarkan profil yang sudah ada ke tender spesifik + kirim notifikasi (diduga "pendaftaran ke lelang") |
| `GET /tender_home/{id}` | Detail tender; tombol daftar aktif saat tahapan `status=1` (Masa Pendaftaran), tombol upload saat `status=4` |

### Bug yang ditemukan & diperbaiki
1. **File ke-4+ selalu ditolak saat registrasi** — `$request->$x` (magic property) dengan key numerik file gagal karena `array_merge` me-reindex key. Fix: nama input `file_{id}` + `hasFile('file_'.$x)`/`file('file_'.$x)`.
2. **Error 500 saat upload** — `tender_file_details.status_id` NOT NULL tapi tidak diisi. Fix: `$tfs->status_id = 0`.
3. **Path upload update rusak** — `update()` memakai `$request->id` (tidak ada di request edit). Fix: pakai `$data->tender_id`; hapus `echo $tfs` debug.
4. **UserSeeder tidak verified** — `email_verified_at` tidak lulus mass assignment. Fix: `forceFill`.
5. **TypeError `number_format` di `/penawaran_file/{id}`** — directive `@currency` menerima string kosong (penawaran belum ada). Fix: directive kini `is_numeric ? (float) : 0`; view pakai `optional($data)` + `?? []`.
6. **Error submit penawaran (`Attempt to read property "penawaran_file" on null`)** — `PenawaranPesertaController@store` membaca `$data->penawaran` (hasOne) yang null jika panitia belum menyiapkan `penawarans`+`penawaran_files`. Fix: guard null + pesan error, input file `file_{id}`, mkdir folder upload.
7. **HPS & file wajib tak tampil di `/penawaran_file/{id}`** — data `penawarans` belum ada di seeder. Fix: `TenderTestingSeeder.ensurePenawaran()` membuat penawaran (hps 1.45M) + 2 file wajib utk tender 5.
8. **`penawaran_pesertas.peserta_id` UNIQUE global** — peserta yang sudah isi penawaran (soft-deleted pun tak lepas) tidak bisa mengikuti tender lain → `Duplicate entry ... penawaran_pesertas_peserta_id_unique`. Fix: migration `fix_unique_penawaran_pesertas_per_peserta_tender` mengubah unique jadi **composite (peserta_id, tender_id)**, `store()` memakai `updateOrCreate` (submit ulang di tender sama = update + ganti file, bukan duplikat), dan model `penawaran_peserta` diberi `$fillable`. Peserta kini boleh mengikuti banyak tender.

### Verifikasi E2E (HTTP nyata, server lokal, DB MySQL)
- Peserta 1 (user 2) & Peserta 2 (user 3): login → `/tender_home/1` → "Daftar Sebagai Peserta" → `POST /daftar_peserta` → "Sudah Terdaftar" ✓
- Upload 4 file via `PUT /peserta/{id}` → path DB & file fisik di `public/Tender/FILE/1/{detail_id}/` ter-update ✓
- `daftar_pesertas`: user 2 & 3 terdaftar di tender 1 ✓

---

## Cara Menjalankan Seeders

```bash
# Reset database + jalankan semua seeder
php artisan migrate:fresh --seed

# Atau jalankan seeder spesifik
php artisan db:seed --class='Database\Seeders\MasterSeeder'
php artisan db:seed --class='Database\Seeders\UserSeeder'
php artisan db:seed --class='Database\Seeders\TenderSeeder'
php artisan db:seed --class='Database\Seeders\PesertaSeeder'
php artisan db:seed --class='Database\Seeders\PenilaianSeeder'
```

Semua user sudah `email_verified_at = now()`, jadi langsung bisa login tanpa verifikasi email.

---

## Akun Testing

| Role | Email | Password |
|------|-------|----------|
| Admin/Panitia | `admin@pbj.go.id` | `password` |
| Peserta 1 (PT Maju Jaya Konstruksi) | `peserta1@maju-jaya.co.id` | `password` |
| Peserta 2 (PT Sejahtera Abadi) | `peserta2@sejahtera.co.id` | `password` |
| Peserta 3 (PT Bangun Nusantara) | `peserta3@bangun-nusantara.co.id` | `password` |
| Peserta 4 (PT Mitra Sejati) | `peserta4@mitra-sejati.co.id` | `password` |

Login URL: `http://localhost:8000/login` (sesuaikan port)

---

## Data yang Di-seed

### Master Data
- **Jenis Pengadaan**: Barang, Konstruksi, Jasa Konsultansi BU, Jasa Konsultansi Perorangan, Jasa Lainnya
- **Jenis Kontrak**: Lump Sum, Harga Satuan, Gabungan, Turn Key, Persentase, Biaya Plus
- **Metode Pengadaan**: Tender Umum, Tender Terbatas, Pemilihan Langsung, Penunjukan Langsung, Pengadaan Langsung, E-Purchasing, Sayembara
- **Status Tender**: Draft s.d. Batal (10 status)

### Tender
| ID | Nama | Pagu | HPS | Status |
|----|------|------|-----|--------|
| 1 | Registrasi Peserta Default | 0 | 0 | default |
| 2 | Pembangunan Gedung Perkantoran 5 Lantai | 25 M | 24,5 M | Publish |
| 3 | Pengadaan Laptop dan Komputer Kantor | 5 M | 4,8 M | Publish |
| 4 | Jasa Konsultansi Perencanaan Jalan Tol | 15 M | 14,5 M | Publish |

Tiap tender punya: tahapan (total 17), syarat (3), tender_files (13), tender_persyaratan,
administrasi & administrasi_detail.

### Peserta & Proses (untuk Tender 2)
| Peserta | User | Penawaran | Hasil |
|---------|------|-----------|-------|
| P1 PT Maju Jaya Konstruksi | 2 | 24,50 M | Lulus semua (peringkat 2) |
| P2 PT Sejahtera Abadi | 3 | 24,60 M | Gugur kualifikasi |
| P3 PT Bangun Nusantara | 4 | 24,30 M | **CALON PEMENANG** (terendah) |
| P4 PT Mitra Sejati | 5 | 24,70 M | Gugur semua tahap |

Tiap peserta punya: tender_file_detail (4 file), pengalaman, tenaga ahli, peralatan,
managemen, daftar_peserta, penawaran_peserta + file.

### Penilaian
- 4 penilaian per tahap (administrasi, kualifikasi, teknis, penawaran) = 16 record
- 4 ringkasan penilaian_peserta
- 2 pemeriksaan
- 1 pemenang (`pemenang_tenders` → peserta 3)

---

## Skenario Test yang Disarankan

### Sebagai Admin (admin@pbj.go.id)
1. **Buat tender baru**: `/tender_admin/create` → isi form → submit → set tahapan di `/tender_admin/tahapan/{id}`
2. **Lihat daftar peserta tender**: `/dashboard/{id}`
3. **Penilaian**: `/p_admin`, `/p_kualifikasi`, `/p_teknis`, `/p_peserta`
4. **Kirim hasil via email**: di halaman peserta → `send_hasil`
5. **Status & sisa proses**: `/tender_admin`, `/perubahan`, `/periksa`

### Sebagai Peserta (peserta1@maju-jaya.co.id)
1. **Home tender**: `/home` → lihat daftar lelang publish
2. **Lihat detail tender**: `/tender_home/{id}` → tombol daftar
3. **Registrasi**: `/peserta/create` → isi data perusahaan + upload file
4. **Cek file & nilai**: `/peserta/{tender_id}/file_tender/{peserta_id}`
5. **Sanggahan**: `/sanggahan`
6. **Penawaran**: `/penawaran_peserta`

---

## Catatan Alur PBJ (sesuai ketentuan)

1. **PPK/KPA** menyiapkan paket → **Pejabat Pengadaan** membuat tender di `/tender_admin`
2. Tender di-**publish** → muncul di `/home` peserta
3. **Peserta** daftar → isi kualifikasi (izin, akta, KSWP, data PT) + upload dokumen
4. **Aanwijzing** → penjelasan dokumen
5. **Peserta** upload penawaran (administrasi + teknis + harga)
6. **Evaluasi** 4 tahap: Administrasi → Kualifikasi → Teknis → Penawaran (masing-masing dinilai Lulus/Tidak)
7. **Koreksi aritmatika** → **Negosiasi** (jika perlu)
8. **Penetapan pemenang** → `pemenang_tenders`
9. Peserta dapat **sanggah** jika tidak setuju hasil