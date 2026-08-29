# Panduan Penggunaan — Admin / Panitia PBJ

Sistem Pengadaan Barang/Jasa (PBJ) — Laravel 12 + Blade + Bootstrap 5 (tema orange)
Akses: `http://127.0.0.1:8000` (lokal) atau URL server produksi.

---

## 1. Masuk Sistem

1. Buka halaman **Login** (`/login`).
2. Masukkan **email** dan **password** akun admin/panitia.
3. Klik **Login**.
   - Akun harus sudah **verified email** (verifikasi otomatis saat pendaftaran).
   - Jika lupa password: gunakan **Lupa Password** (`/password/reset`).

Akun contoh (hasil seed):
| Peran | Email | Password |
|---|---|---|
| Admin | `admin@pbj.go.id` | `password` |

---

## 2. Menu Admin (Sidebar)

Setelah login, menu di sisi kiri (layout admin):

- **Peserta** — membuka profil/registrasi peserta (untuk pengelolaan data perusahaan).
- **Beranda Tender** (`/home`) — daftar tender yang sedang berjalan/publish.
- **Kelola Tender** (`/tender_admin`) — pusat pembuatan & pengelolaan tender.
- **Master** (submenu):
  - **Jenis Pengadaan** (`/jenis_pengadaan`) — CRUD jenis (Barang, Jasa, Konstruksi, dll).
  - **Jenis Kontrak** (`/jenis_kontrak`) — CRUD jenis kontrak (Lump Sum, Harga Satuan, dll).
  - **Metode Pengadaan** (`/metode_pengadaan`) — CRUD metode (Tender Umum, Terbatas, dll).
  - **Status Tender** (`/status_tender`) — CRUD status (Draft, Publish, Selesai, dll).
  - **Tahapan** (`/tahapan`) — daftar master tahapan (jadwal umum).
- **Pemeriksaan** (`/dashboard`) — daftar tender untuk diperiksa & dinilai.

Menu tambahan yang dapat diakses admin (tidak selalu di sidebar):
- **Barang / e-shop** (`/barang`, `/katagori`) — modul e-commerce lama.
- **Perubahan** (`/perubahan`) — transparansi jadwal/perubahan (baca untuk semua role).

---

## 3. Alur Kerja Admin (PBJ)

### 3.1 Persiapan Master Data
Lengkapi master data sebelum membuat tender:
1. **Jenis Pengadaan** — klik **Tambah**, isi nama, **Submit**. (Edit/hapus lewat tombol di tabel.)
2. **Jenis Kontrak** — sama seperti di atas.
3. **Metode Pengadaan** — sama.
4. **Status Tender** — sama (contoh: Draft, Publish, Selesai, Batal).

### 3.2 Membuat Tender
1. Menu **Kelola Tender** → **+ Tambah**.
2. Isi form:
   - **Nama** paket pengadaan *(wajib)*
   - **Paket** — kode paket *(wajib)*
   - **Jenis Pengadaan** (dropdown), **Jenis Kontrak** (dropdown), **Metode Pengadaan** (dropdown), **Status Tender** (dropdown)
   - **KLPD**, **Sumber Dana**, **Satuan Kerja**, **Tahun Anggaran** (tanggal), **Lokasi Pekerjaan**
   - **Nilai Pagu** dan **HPS** (angka)
3. Klik **Submit** → tender tersimpan.
4. Selanjutnya atur **Tahapan** dan **Syarat**.

### 3.3 Mengatur Tahapan Tender
Buka **Kelola Tender** → klik aksi pada tender → **Tahapan** (`/tender_admin/tahapan/{id}`).
1. Di halaman **Atur Tahapan Tender**, lihat daftar tahapan yang sudah ada (badge status berwarna).
2. **Tambah Tahapan Baru**:
   - **Nama Tahap** (mis. Pendaftaran, Upload File, Pengumuman Pemenang)
   - **Status Tahapan**: `0=Biasa`, `1=Masa Pendaftaran`, `2=Masa Pembukaan File`, `3=Pengumuman Pemenang`, `4=Upload File`
   - **Tanggal Mulai** dan **Tanggal Selesai**
   - Klik **Tambah Tahapan**.
3. **PENTING**: pastikan setiap tender punya minimal:
   - 1 tahapan berstatus **Masa Pendaftaran (1)** → menyalakan tombol "Daftar" untuk peserta
   - 1 tahapan berstatus **Upload File (4)** → menyalakan tombol "Masukkan File"
4. Edit/hapus tahapan lewat tombol di tabel.

### 3.4 Mengatur Syarat Tender
Buka **Kelola Tender** → aksi → **Syarat** (`/tender_admin/syarat/{id}`).
- Isi **judul**, **izin**, **usaha**, **content/keterangan**.
- Tambah **Detail Syarat** (`/syarat_detail`) bila perlu.

### 3.5 File Template & Persyaratan Teknis
- **Tender File** (`/tender_file`) — daftar file yang wajib diunggah peserta (Dokumen Kualifikasi, Surat Penawaran, Akta, dll).
- **Persyaratan Teknis** — atur lewat `tender_home/{id}/edit` (judul, penjelasan, file pendukung).
- **Administrasi** (`/administrasi`) — daftar administrasi yang akan diperiksa + detailnya.

### 3.6 Penawaran Tender
- **Penawaran** (`/penawaran`) — siapkan data penawaran: judul, penjelasan, anggaran, HPS.
- **Catatan**: `penawaran_files` (berkas wajib penawaran) biasanya diisi via seeder; pastikan sudah ada sebelum peserta upload (jika belum, halaman upload peserta akan menampilkan pesan "belum disiapkan").

### 3.7 Pemeriksaan & Penilaian (Inti)
1. Buka **Pemeriksaan** (`/dashboard`) → daftar tender.
2. Klik **Periksa** pada tender → halaman **Daftar Peserta Tender** — lihat nama PT, nilai penawaran, dan kelengkapan (email, NPWP, alamat, no HP).
3. Klik **Lihat File** pada peserta → halaman **File Peserta** dengan tab:
   - **Persyaratan Kualifikasi** — lihat berkas, pengalaman, pekerjaan berjalan + form penilaian kualifikasi (Lulus/Tidak Lulus + keterangan).
   - **Administrasi** — file administrasi + penilaian administrasi.
   - **Evaluasi Teknis** — file RKK, tenaga ahli, peralatan + penilaian teknis.
   - **Harga** — penawaran + file penawaran + penilaian penawaran.
   - **Penilaian** — ringkasan 4 penilaian + **Kirim Email** hasil ke peserta.
   - Tombol **Edit** membuka form data perusahaan peserta.
4. Penilaian: setiap item **Lulus** = 1 poin; total **4/4 = Lulus** semua tahap.
5. **Kirim Email**: isi email peserta, klik **Kirim Email** → sistem mengirim hasil penilaian (status per tahap + kesimpulan).

### 3.8 Sanggahan
- Menu **Sanggahan** (`/sanggahan`) → daftar tender yang memiliki masa sanggah.
- Klik **Sanggahan** pada tender → lihat **Berita Acara Evaluasi** (modal) dan **Sanggahan** peserta yang masuk (keterangan + file).
- Jika belum ada sanggahan, form pengiriman hanya tampil untuk peserta yang terdaftar.

### 3.9 Modul Lain
- **Barang / e-shop** (`/barang`) — kelola barang (nama, katagori, harga, jumlah, keterangan, deskripsi, foto). Lihat detail + komentar.
- **Perubahan** (`/perubahan`) — lihat riwayat perubahan jadwal (transparansi).
- **Komentar** — komentar pada barang (`/komentar`) & diskusi per peserta (`/komen`).

---

## 4. Data Penting yang Harus Diperhatikan
- Tender dengan `default=1` dipakai untuk **registrasi awal peserta** (jangan dihapus).
- **Soft delete** dipakai hampir semua tabel — hapus data berarti "arsip", tidak permanen.
- File peserta tersimpan di `public/Tender/...`; path disimpan di database.
- Email dikirim via SMTP Resend (konfigurasi di `.env`); pastikan API key valid.
