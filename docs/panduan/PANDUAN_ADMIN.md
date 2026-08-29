# Panduan Penggunaan — Admin / Panitia PBJ

Sistem Pengadaan Barang/Jasa (PBJ) — Laravel 12 + Blade + Bootstrap 5 (tema orange).
Dokumen ini menjabarkan **seluruh menu & halaman yang dapat diakses admin**, berdasarkan pemetaan router → controller → fungsi.

---

## 1. Masuk Sistem

1. Buka **Login** (`/login`).
2. Masukkan **email** dan **password** akun admin/panitia, klik **Login**.
   - Akun harus **verified email**.
   - Lupa password → **Lupa Password** (`/password/reset`).

Akun contoh (hasil seed): `admin@pbj.go.id` / `password`

---

## 2. Navigasi Sidebar (Layout Admin)

| Menu | Halaman | Fungsi |
|---|---|---|
| **Peserta** | `/peserta/create` | Buka profil/registrasi peserta |
| **Beranda Tender** | `/home` | Daftar tender yang tampil (publish) |
| **Kelola Tender** | `/tender_admin` | Pusat CRUD tender + tahapan + syarat |
| **Master → Jenis Pengadaan** | `/jenis_pengadaan` | CRUD jenis pengadaan |
| **Master → Jenis Kontrak** | `/jenis_kontrak` | CRUD jenis kontrak |
| **Master → Metode Pengadaan** | `/metode_pengadaan` | CRUD metode pengadaan |
| **Master → Status Tender** | `/status_tender` | CRUD status tender |
| **Master → Tahapan** | `/tahapan` | Master tahapan (index/create/edit) |
| **Pemeriksaan** | `/dashboard` | Daftar tender untuk diperiksa & dinilai |

> Halaman lain yang dapat diakses admin (lewat URL/tautan kontekstual) dijelaskan di bagian 3–8.

---

## 3. Master Data

Semua modul master berbentuk **tabel + tombol Tambah + form (field `nama`)**.

### 3.1 Jenis Pengadaan (`/jenis_pengadaan`)
Contoh: Barang, Pekerjaan Konstruksi, Jasa Lainnya.
- Tombol **Tambah** → isi `nama` → **Submit**.
- Tabel: No, Nama, Aksi (**Edit** / **Hapus**).
- Route: `jenis_pengadaan.*` (index/create/store/edit/update/destroy).

### 3.2 Jenis Kontrak (`/jenis_kontrak`)
Contoh: Lump Sum, Harga Satuan, Gabungan. Sama seperti di atas (`jenis_kontrak.*`).

### 3.3 Metode Pengadaan (`/metode_pengadaan`)
Contoh: Tender Umum, Tender Terbatas, Pemilihan Langsung, Penunjukan Langsung (`metode_pengadaan.*`).

### 3.4 Status Tender (`/status_tender`)
Contoh: Draft, Publish, Berjalan, Selesai, Batal (`status_tender.*`).

### 3.5 Tahapan (`/tahapan`)
Master tahapan umum: tabel No/Nama/Aksi; **Tambah** form (`nama`, `awal`, `akhir`, `status` 0–4).
- `0=Biasa, 1=Masa Pendaftaran, 2=Masa Pembukaan File, 3=Pengumuman Pemenang, 4=Upload File`.
- **Catatan**: tahapan yang dipakai peserta adalah yang dibuat **per tender** (lihat 4.3).

---

## 4. Kelola Tender (Inti)

### 4.1 Daftar Tender (`/tender_admin`)
- Tabel daftar tender (nama, jenis, metode, status, pagu, HPS, aksi).
- Tombol **+ Tambah** → form create.

### 4.2 Buat / Edit Tender (`/tender_admin/create`, `/tender_admin/{id}/edit`)
Field form:
- **Nama** *(wajib)* — nama paket pengadaan
- **Paket** *(wajib)* — kode paket
- **Jenis Pengadaan** *(select, wajib)* — dari `jenis_pengadaans`
- **Jenis Kontrak** *(select, wajib)*
- **Metode Pengadaan** *(select, wajib)*
- **Status Tender** *(select, wajib)*
- **KLPD**, **Sumber Dana**, **Satuan Kerja**, **Tahun Anggaran** *(date)*, **Lokasi Pekerjaan** *(wajib)*
- **Nilai Pagu** *(number)* dan **HPS** *(number)*

Setelah submit → lanjut atur **Tahapan**.

### 4.3 Atur Tahapan Tender (`/tender_admin/tahapan/{id}`)
- **Info tender** + peringatan: wajib ada minimal 1 tahapan **Masa Pendaftaran** dan 1 **Upload File**.
- **Daftar Tahapan** (tabel): Nama Tahap, Mulai, Selesai, Status (badge warna), Keterangan (+ link **Periksa Perubahan**), Aksi (**Edit** / **Hapus**).
- **Tambah Tahapan Baru**: Nama Tahap *(wajib)*, Status Tahapan *(select 0–4)*, Tanggal Mulai *(wajib)*, Tanggal Selesai *(wajib)* → **Tambah Tahapan**.
- Edit tahapan juga mengubah **Perubahan** (riwayat).

### 4.4 Atur Syarat Tender (`/tender_admin/syarat/{id}`)
Form syarat: **Nama/Judul** *(wajib)*, **Izin** *(wajib)*, **Usaha** *(wajib)*, **Content/Keterangan** *(wajib)*.
Detail syarat: `/syarat_detail` (keterangan detail tiap syarat).

### 4.5 Detail / Lihat Tender (`/tender_admin/{id}`)
Halaman detail informasi tender.

---

## 5. Template & Persyaratan (Admin)

### 5.1 Tender File (`/tender_file`)
File wajib yang harus diunggah peserta saat registrasi (Dokumen Kualifikasi, Surat Penawaran, Akta, dll).
- Form: **Nama** *(wajib)*, **Keterangan** *(wajib)*, file.
- Rincian per file: `/tender_file_detail`.

### 5.2 Tender Persyaratan (`/tender_persyarat`, `/tender_persyaratan_file`)
Persyaratan teknis tender + file pendukungnya.
- Form: **Nama**, **Content/Keterangan** + file.
- Juga bisa diatur lewat `tender_home/{id}/edit`.

### 5.3 Administrasi (`/administrasi`, `/administrasi_list`)
- **Administrasi**: daftar administrasi yang akan diperiksa (form: nama, dsb).
- **Administrasi List/Detail**: detail administrasi per peserta (dipakai peserta untuk mengunggah berkas administrasi).

### 5.4 Penawaran Tender (`/penawaran`)
Data penawaran yang disiapkan admin per tender:
- Form: **Penawaran** (judul/penjelasan) + file wajib penawaran (untuk peserta).
- **PENTING**: jika `penawaran_files` belum disiapkan, peserta tidak bisa upload penawaran (akan ada pesan). Biasanya diisi via seeder — pastikan via halaman ini bila sudah tersedia.

---

## 6. Pemeriksaan & Penilaian

### 6.1 Pemeriksaan (`/dashboard`)
- Daftar tender → klik **Periksa** pada tender.
- Halaman **Daftar Peserta Tender**: kolom No, Nama PT (+ penawaran `@currency`), Cek Kelengkapan (email, NPWP, alamat, no HP, managemen, user/tender id), Aksi **Lihat File**.

### 6.2 File Peserta (`/peserta/{id}/file_tender/{pid}`)
Halaman detail berkas + penilaian per peserta, dengan tab:
1. **Persyaratan Kualifikasi** — berkas kualifikasi (modal preview + download), tabel Pengalaman, tabel Pekerjaan Berjalan + form **Penilaian Kualifikasi**.
2. **Administrasi** — file administrasi + form **Penilaian Administrasi**.
3. **Evaluasi Teknis** — File RKK (SMKK + Pakta Komitmen), Tenaga Ahli, Peralatan + form **Penilaian Teknis**.
4. **Harga** — penawaran peserta + file penawaran + form **Penilaian Penawaran**.
5. **Penilaian** — ringkasan 4 penilaian + **Kirim Email** hasil (form email + point tersembunyi).
- Tombol **Edit** di atas membuka form edit data perusahaan peserta.

### 6.3 Form Penilaian (pada tab halaman peserta)
Setiap form: select **Status** (Lulus / Tidak Lulus) + **Keterangan** → **Simpan** (store/update sesuai status).

### 6.4 Modul Penilaian Terpisah (resource CRUD)
Route admin lengkap untuk masing-masing tabel penilaian:
- `p_admin` (Penilaian Administrasi), `p_kualifikasi` (Kualifikasi), `p_teknis` (Teknis), `p_peserta` (Penawaran), `periksa` (Penilaian keseluruhan) — index/create/store/show/edit/update/destroy.
- Form penilaian sama: status Lulus/Tidak Lulus + keterangan.

### 6.5 Pemeriksaan Checklist (`/pemeriksaan`)
Checklist pemeriksaan per peserta: **Pengalaman, Tenaga Ahli, Peralatan, Pekerjaan Berjalan, Managemen, File** — masing-masing status **Ada/Tidak** + keterangan. Nilai otomatis: jumlah "Lulus" / 6 × 100; kesimpulan Lulus jika 100%.

### 6.6 Kirim Email Hasil (`POST /send_hasil`)
Dari tab Penilaian: isi email peserta → **Kirim Email** → sistem mengirim `hasil_penilaian` (status 4 tahap + kesimpulan).

### 6.7 Validasi File (`/validasi_file`)
Validasi berkas peserta (status valid/tidak) — diisi/dilihat untuk memastikan kelengkapan dokumen.

### 6.8 Koreksi (`/koreksi`)
Peserta mengajukan koreksi harga penawaran; admin mengelola koreksi. **Aturan**: koreksi hanya 1× per peserta.

---

## 7. Sanggahan (`/sanggahan`)

- **Index**: daftar tender → tombol **Sanggahan**.
- **Detail**: 
  - Modal **Berita Acara Evaluasi** (iframe dokumen).
  - Jika sudah ada sanggahan peserta: lihat keterangan & file sanggahan; tombol **Hapus** (untuk mengubah, hapus lalu kirim ulang).
  - Jika belum ada: form **Kirim Sanggahan** (keterangan + file) — form hanya tampil untuk peserta yang terdaftar.
- Admin melihat sanggahan yang masuk sebagai panitia.

---

## 8. Perubahan & Transparansi (`/perubahan`)

- **Index**: riwayat perubahan jadwal/tahapan (link dari tabel tahapan).
- **Show** (`/perubahan/{id}`): detail perubahan per tahapan — semua role dapat **membaca** (transparansi); hanya admin yang dapat membuat/mengubah (create/edit).

---

## 9. Modul Barang / e-Shop (Modul Terpisah)

### 9.1 Barang (`/barang`)
- **Index**: tabel No, Nama (link ke detail), Jumlah, Aksi (**Edit**, **Foto**).
- **Create/Edit**: Nama Barang *(wajib)*, Katagori *(select)*, Harga *(number)*, Jumlah *(number)*, Keterangan, Deskripsi.
- **Show**: galeri foto, detail (nama, keterangan, harga + ex tax), tombol Add to Cart/Wishlist (dekoratif), **Deskripsi**, **Komentar** (list + form komentar).
- **Foto**: `/foto/barang/{id}` (edit foto) & `POST /photoStore` (simpan foto).

### 9.2 Katagori (`/katagori`)
- Tabel No, Nama, Keterangan; **Tambah** form (`nama`, `keterangan`).

### 9.3 Komentar (`/komentar`)
Komentar pada barang (modul e-shop).

---

## 10. Ringkasan Route Admin (Dari `route:list`)

**CRUD lengkap (index/create/store/show/edit/update/destroy)**: `jenis_pengadaan`, `jenis_kontrak`, `metode_pengadaan`, `status_tender`, `tahapan`, `katagori`, `barang`, `syarat`, `syarat_detail`, `tender_file`, `tender_file_detail`, `tender_persyarat`, `tender_persyaratan_file`, `penawaran`, `p_admin`, `p_kualifikasi`, `p_teknis`, `p_peserta`, `periksa`, `pemeriksaan`, `dashboard`.

**Route spesial admin**:
| Method | URL | Nama | Fungsi |
|---|---|---|---|
| GET | `/tender_admin/syarat/{id}` | `tender_admin.syarat` | Kelola syarat per tender |
| GET | `/tender_admin/tahapan/{id}` | `tender_admin.tahapan` | Atur tahapan per tender |
| POST | `/send_hasil` | `send.hasil` | Kirim email hasil penilaian |
| GET | `/send` | `send` | Test kirim notifikasi (email contoh) |
| GET | `/test` | — | Route test |
| GET | `/CreatePhoto` | `photo.buat` | Upload foto barang |
| POST | `/photoStore` | `photo.simpan` | Simpan foto barang |
| GET/POST | `/perubahan/*` | `perubahan.*` | Mutasi perubahan (hanya admin; baca utk semua) |

---

## 11. Hal Penting

- **Tender default** (`default=1`) dipakai registrasi awal peserta — jangan dihapus.
- **Soft delete** hampir semua tabel — hapus = arsip.
- File peserta tersimpan di `public/Tender/...`; path di DB.
- Email via SMTP Resend (`.env`); pastikan API key valid (sudah diverifikasi berfungsi).
- Halaman yang masih memakai tampilan lama (AdminLTE) akan di-rewrite bertahap (proyek UI rewrite F6) — fungsi tetap sama.
