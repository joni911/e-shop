# Panduan Penggunaan — Peserta / User

Sistem Pengadaan Barang/Jasa (PBJ) — Laravel 12 + Blade + Bootstrap 5 (tema orange)
Akses: `http://127.0.0.1:8000` (lokal) atau URL server produksi.

---

## 1. Mendaftar & Masuk

### Registrasi Akun (`/register`)
1. Buka halaman **Register**.
2. Isi **Nama**, **Email**, **Password**, dan konfirmasi password.
3. Klik **Register**.
4. Buka email dan klik tombol **Verifikasi Email** (email dari sistem).
   - Semua fitur baru bisa dipakai setelah email **terverifikasi**.

### Login (`/login`)
1. Masukkan email + password.
2. Klik **Login**.
3. Jika lupa password, klik **Lupa Password**.

Akun contoh (hasil seed):
| Peran | Email | Password |
|---|---|---|
| Peserta | `peserta1@maju-jaya.co.id` .. `peserta4@...` | `password` |

---

## 2. Menu Peserta (Sidebar)

- **Peserta** — profil / data perusahaan Anda.
- **Beranda Tender** (`/home`) — daftar tender yang sedang dibuka.
- **Sanggahan** (`/sanggahan`) — ajukan atau lihat sanggahan Anda.

---

## 3. Alur Kerja Peserta

### 3.1 Lihat & Daftar Tender
1. Buka **Beranda Tender** → daftar kartu tender (nama, jenis, metode, status, HPS/pagu).
2. Klik kartu tender untuk melihat **detail**:
   - Info lengkap tender (jenis, kontrak, metode, status, KLPD, dana, satker, lokasi, pagu, HPS).
   - **Tahapan / jadwal** (timeline).
3. Jika tahapan **Masa Pendaftaran** sedang berjalan → klik tombol **Daftar**.
   - Sistem memeriksa profil Anda: belum punya profil → diarahkan registrasi; sudah punya → terdaftar ke tender tersebut.

### 3.2 Registrasi / Edit Profil Perusahaan
Menu **Peserta** (`/peserta/create`, jika sudah ada profil → `/peserta/{id}/edit`).

Form berisi beberapa bagian (semua di satu halaman):
- **Identitas Perusahaan**: Nama PT, Kualifikasi, Klasifikasi.
- **Izin Perusahaan**: Izin (NIB/IUJK), Nomor Izin, Berlaku Sampai, Instansi Pemberi.
- **Akta**: Nomor, Tanggal Surat, Notaris.
- **Akta Perubahan Terakhir**: Nomor, Tanggal Surat, Notaris.
- **Bukti KSWP**: NPWP, Nama Pemilik NPWP.
- **Data Perusahaan**: No HP (WhatsApp), Alamat, Email.
- **File Pendukung**: unggah/perbarui berkas wajib (format: jpg, jpeg, png, pdf, zip, rar, 7z).

Klik **Submit** untuk menyimpan.

### 3.3 Isi Kelengkapan Kualifikasi
Setelah profil tersimpan, isi kelengkapan (masing-masing lewat menu/halaman sendiri):
- **Pengalaman** (`/pengalaman`) — riwayat pekerjaan: pekerjaan, lokasi, instansi, alamat, kontak, nomor & tanggal kontrak, persentase pelaksanaan, tanggal selesai/serah terima, nilai kontrak, + file bukti.
- **Tenaga Ahli** (`/tenagaahli`) — nama, tanggal lahir, jenis kelamin, alamat, jabatan, pengalaman, + file.
- **Peralatan** (`/peralatan`) — nama, jumlah, kapasitas, merk, tahun, kondisi, lokasi, kepemilikan, bukti, + file.
- **Pekerjaan Berjalan** (`/pekerjaan_berjalan`) — pekerjaan yang sedang berjalan.
- **Managemen / Pengurus** (`/managemen`) — data direksi/komisaris: nama, masa menjabat, KTP, alamat, NPWP, status, + file.

### 3.4 Upload Penawaran
Ketika tahapan **Upload File (status 4)** berjalan, dari detail tender tersedia tombol **Masukkan File** (`/penawaran_file/{id}`):
1. Halaman menampilkan **HPS** dan daftar **berkas penawaran wajib**.
2. Unggah semua file yang diminta.
3. Klik **Submit**.
- **PENTING**: hanya bisa upload jika Anda **sudah terdaftar** di tender tersebut (jika belum, muncul pesan "Belum Terdaftar").
- Jika ada koreksi penawaran (harga), ajukan lewat halaman file Anda (tombol koreksi).

### 3.5 Lihat Hasil Penilaian
- Dari halaman **File Peserta** (`/peserta/{id}/file_tender/{pid}`) Anda dapat melihat status penilaian:
  - **Persyaratan Kualifikasi**, **Administrasi**, **Evaluasi Teknis**, **Harga** → status Lulus/Tidak Lulus + keterangan.
  - **Penilaian** → ringkasan + kesimpulan (Lulus / Dalam Proses / Belum Lulus).
- Hasil juga dikirim via **email** oleh admin (status per tahap + kesimpulan).

### 3.6 Sanggahan
1. Menu **Sanggahan** (`/sanggahan`) → pilih tender.
2. Buka **Berita Acara Evaluasi** (tombol → modal).
3. Jika **belum** ada sanggahan: isi **Keterangan** dan unggah **File Sanggahan**, klik **Submit**.
4. Jika **sudah** ada: lihat keterangan & file sanggahan Anda; untuk mengubah, **Hapus** lalu kirim ulang.

### 3.7 Komentar / Diskusi
- **Komentar** pada barang (modul e-shop) dan diskusi per peserta (`/komen`).

---

## 4. Hal yang Perlu Diperhatikan
- **Verifikasi email** wajib sebelum mengikuti tender.
- **Profil = 1 per user**; pendaftaran ke banyak tender diperbolehkan.
- Pastikan mengunggah **semua berkas wajib** — penawaran tanpa daftar peserta akan ditolak.
- File yang diunggah tersimpan di server (`public/Tender/...`); simpan salinan lokal Anda.
- Jika email hasil tidak masuk, cek spam atau hubungi panitia (admin dapat mengirim ulang dari halaman pemeriksaan).
