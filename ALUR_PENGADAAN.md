# ALUR PENGADAAN BARANG/JASA - SISTEM PENGADAAN PBJ

## Ringkasan Arsitektur

- **Framework**: Laravel 8+ dengan Blade Template Engine
- **Auth**: Laravel Breeze/Jetstream (Auth::routes dengan verified email)
- **Template**: AdminLTE (via jeroennoten/Laravel-AdminLTE)
- **Frontend**: Vanilla JS + Bootstrap + jQuery (TIDAK ADA RTK/REDUX)
- **Database**: MySQL/MariaDB dengan Soft Deletes pada hampir semua tabel
- **Storage**: Local file system (folder Tender/)

## Struktur Entitas Utama

```
Tender (Pengadaan)
├── Status Tender (Draft, Publish, Selesai, dll)
├── Jenis Pengadaan (Barang, Jasa, Konstruksi, dll)
├── Metode Pengadaan (Tender Umum, Terbatas, Cepat, dll)
├── Jenis Kontrak (Lump Sum, Harga Satuan, Gabungan, dll)
├── Tahapan (Jadwal Tender)
├── Syarat & Detail Syarat
├── Tender File (File yang harus diupload peserta)
├── Tender Persyaratan & File Persyaratan
├── Peserta & File Peserta
├── Penawaran & Penawaran Peserta
├── Penilaian (Administrasi, Kualifikasi, Teknis, Penawaran)
├── Pemeriksaan
├── Sanggahan
└── Pemenang Tender
```

---

## ALUR INPUT PENGADAAN (ADMIN)

### Fase 1: Persiapan Master Data

1. **Jenis Pengadaan** (`/jenis_pengadaan`)
   - CRUD jenis pengadaan (Barang, Pekerjaan Konstruksi, Jasa Lainnya, dll)

2. **Jenis Kontrak** (`/jenis_kontrak`)
   - CRUD jenis kontrak (Lump Sum, Harga Satuan, Gabungan, dll)

3. **Metode Pengadaan** (`/metode_pengadaan`)
   - CRUD metode (Tender Umum, Tender Terbatas, Pemilihan Langsung, Penunjukan Langsung, dll)

4. **Status Tender** (`/status_tender`)
   - CRUD status (Draft, Publish, Berjalan, Selesai, Batal)

### Fase 2: Pembuatan Tender

1. **Create Tender** (`/tender_admin/create`)
   
   Input yang harus diisi:
   - Nama Paket Pengadaan
   - Jenis Pengadaan (dropdown)
   - Jenis Kontrak (dropdown)
   - Metode Pengadaan (dropdown)
   - Status Tender (dropdown)
   - KLPD (Kementerian/Lembaga)
   - Sumber Dana (APBN, APBD, BLU, dll)
   - Satuan Kerja
   - Tahun Anggaran (date)
   - Lokasi Pekerjaan
   - Nilai Pagu
   - HPS (Harga Perkiraan Sendiri)

2. **Setelah Submit**: Redirect ke halaman Tahapan

### Fase 3: Pengaturan Tahapan

1. **Tahapan Tender** (`/tender_admin/tahapan/{id}`)
   
   Setiap tahapan memiliki:
   - Nama tahapan (Pendaftaran, Pengambilan Dokumen, Aanwijzing, Penawaran, Pembukaan, Evaluasi, dll)
   - Tanggal Mulai
   - Tanggal Akhir
   - Status (aktif/tidak)

### Fase 4: Pengaturan Syarat

1. **Syarat Umum** (`/tender_admin/syarat/{id}`)
   - Judul syarat
   - Izin yang dibutuhkan (NIB, IUJK, SBU, dll)
   - Usaha yang diizinkan

2. **Detail Syarat** (`/syarat_detail`)
   - Keterangan detail setiap syarat

### Fase 5: Upload File Template

1. **Tender File** (`/tender_file`)
   - File-file yang harus diupload oleh peserta
   - Contoh: Dokumen Kualifikasi, Surat Penawaran, Akta Perusahaan, dll

### Fase 6: Pengaturan Persyaratan Teknis

1. **Tender Persyaratan** (`/tender_home/{id}/edit`)
   - Judul persyaratan teknis
   - Penjelasan detail
   - File-file pendukung

### Fase 7: Administrasi Pemeriksaan

1. **Administrasi** (`/administrasi`)
   - Buat daftar administrasi yang akan diperiksa
   - Detail administrasi dengan file yang harus diupload

---

## ALUR PENDAFTARAN PESERTA

### Prasyarat
1. User harus register dan login
2. Email harus terverifikasi (`verified` middleware)
3. User harus memiliki hak_akses = 'peserta'

### Langkah 1: Registrasi Peserta

**Route**: `GET /peserta/create`

**Halaman**: Pendaftaran peserta default (untuk tender default/umum)

Jika user sudah punya data peserta → redirect ke edit

### Langkah 2: Input Data Perusahaan

**Route**: `POST /peserta` (store)

Form pendaftaran peserta (dari `tender_user/peserta/part/form.blade.php`):

#### Data Izin Usaha:
- Izin Perusahaan (NIB/IUJK/SBU)
- Nomor Izin
- Berlaku Sampai (tanggal)
- Instansi Pemberi
- Kualifikasi
- Klasifikasi

#### Data Perusahaan:
- Nama PT
- No HP (WhatsApp)
- Email
- Alamat

#### Data Akta:
- Nomor Akta Pendirian
- Tanggal Akta
- Notaris

#### Akta Perubahan Terakhir:
- Nomor
- Tanggal
- Notaris

#### Bukti KSWP:
- NPWP
- Nama Pemilik NPWP

#### Upload File:
- File-file sesuai Tender File yang sudah diatur admin
- Format: .jpg, .jpeg, .png, .pdf, .zip, .rar, .7z

**Proses Store**:
1. Validasi semua file tidak boleh kosong
2. Simpan data peserta ke tabel `pesertas`
3. Upload file ke folder `Tender/FILE/{tender_id}/{tender_file_id}/`
4. Simpan path file ke tabel `tender_file_details`
5. Redirect ke pengisian pengalaman

### Langkah 3: Pengalaman Tender

**Route**: `GET /pengalaman/{peserta_id}`

Input:
- Pekerjaan
- Lokasi
- Instansi
- Alamat
- No HP
- No Kontrak
- Tgl Kontrak
- Presentasi (%)
- Tgl Selesai Kontrak
- Tgl Serah Terima
- Keterangan

### Langkah 4: Tenaga Ahli

**Route**: `/tenagaahli`

Input:
- Nama
- Tgl Lahir
- Jenis Kelamin
- Alamat
- Negara
- Jabatan
- Pengalaman
- Email
- Keterangan

### Langkah 5: Peralatan

**Route**: `/peralatan`

Input:
- Nama peralatan
- Jumlah
- Kapasitas
- Merk
- Tahun
- Kondisi
- Lokasi
- Kepemilikan
- Bukti kepemilikan

### Langkah 6: Pekerjaan Berjalan

**Route**: `/pekerjaan_berjalan`

Input:
- Pekerjaan
- Lokasi
- Instansi
- Alamat
- No HP
- No Kontrak
- Tgl Kontrak
- Presentasi
- Tgl Selesai
- Tgl Serah Terima
- Nilai Kontrak

### Langkah 7: Managemen

**Route**: `/managemen`

Input:
- Nama
- Tgl Menjabat
- Tgl Berakhir
- KTP
- Alamat
- NPWP
- Status

### Langkah 8: Daftar ke Tender Tertentu

**Route**: `GET /peserta/tender/{id}`

Peserta melihat daftar tender dan mendaftar ke tender yang dipilih:

1. Cek apakah sudah punya data peserta
2. Jika belum → redirect ke registrasi
3. Jika sudah → redirect ke halaman file peserta

---

## ALUR PENILAIAN TENDER (PBJ)

### 1. Penilaian Administrasi

**Route**: `/p_admin`

Penilaian kelengkapan dokumen administrasi:
- Status: Lulus / Tidak Lulus
- Keterangan

### 2. Penilaian Kualifikasi

**Route**: `/p_kualifikasi`

Penilaian kemampuan peserta:
- Status: Lulus / Tidak Lulus
- Keterangan

### 3. Penilaian Teknis

**Route**: `/p_teknis`

Penilaian teknis penawaran:
- Status: Lulus / Tidak Lulus
- Keterangan

### 4. Penilaian Penawaran

**Route**: `/p_peserta`

Penilaian harga penawaran:
- Status: Lulus / Tidak Lulus
- Keterangan

### Sistem Penilaian

Setiap penilaian yang Lulus = +1 point
Total 4 point = Lulus semua tahap

```php
if ($point >= 4) {
    "Selamat Anda Lulus dan akan masuk ke tahap selanjutnya"
} else {
    "Kami dari panitia tender menyampaikan bahwa saudara belum dapat dinyatakan lulus"
}
```

### Pemberitahuan Hasil

Admin dapat kirim email hasil penilaian ke peserta:
- Email berisi status tiap penilaian
- Keterangan dari masing-masing penilaian
- Kesimpulan akhir

---

## ALUR PEMENANG TENDER

1. Lihat dashboard hasil evaluasi
2. Pilih pemenang berdasarkan nilai tertinggi / harga terendah (sesuai metode)
3. Simpan ke tabel `pemenang_tenders`

---

## HAK AKSES

### Admin/Panitia
- Full access ke semua menu
- Bisa create, edit, delete tender
- Bisa nilai peserta
- Bisa kirim email hasil penilaian

### Peserta
- Hanya bisa lihat tender yang publish
- Bisa daftar dan upload dokumen
- Bisa lihat hasil penilaian sendiri
- Bisa kirim sanggahan

---

## CATATAN PENTING

1. **Tender Default**: Ada tender dengan `default=1` yang digunakan untuk registrasi awal peserta
2. **Soft Deletes**: Hampir semua tabel menggunakan SoftDeletes
3. **File Upload**: Semua file disimpan di `public/Tender/FILE/`
4. **Email**: Menggunakan Laravel Mail dengan SMTP
5. **Notifikasi**: Menggunakan Laravel Notifications
