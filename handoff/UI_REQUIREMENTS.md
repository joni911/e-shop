# KEBUTUHAN UI PER HALAMAN

> Data kebutuhan UI tiap halaman: elemen input (name, tipe, wajib), aksi/tombol, validasi, sumber data, dan catatan penting. Format: `field (name) [tipe, wajib] — keterangan`.

## A. AUTH
### Login (`/login`)
- `email` [email, wajib] — alamat email
- `password` [password, wajib]
- Tombol: **Login** (`POST /login`), link Register, link Lupa Password
- Catatan: email harus verified (middleware verified).

### Register (`/register`)
- `name` [text, wajib] — nama/PT
- `email` [email, wajib]
- `password`, `password_confirmation` [wajib]
- Tombol: **Register** → verifikasi email dulu sebelum masuk.

## B. TENDER (ADMIN)
### Index Tender (`/tender_admin`) — `tender_admin/index.blade.php`
- Tabel daftar tender: nama, jenis pengadaan, metode, status, pagu, HPS, aksi (edit/hapus).
- Tombol: **Tambah Tender** (→ create), Edit, Hapus.

### Create/Edit Tender (`/tender_admin/create`, `/edit/{id}`)
- `nama` [text, wajib] — nama paket pengadaan
- `paket` [text, wajib] — kode paket (kolom wajib di DB)
- `jp` [select, wajib] — jenis pengadaan (dari `jenis_pengadaans`)
- `jk` [select, wajib] — jenis kontrak (dari `jenis_kontraks`)
- `mp` [select, wajib] — metode pengadaan (dari `metode_pengadaans`)
- `status` [select, wajib] — status tender (dari `status_tenders`)
- `klpd`, `dana` (sumber dana), `satuan_kerja` [text, wajib]
- `tanggal` (tahun anggaran) [date, wajib]
- `lokasi` [text, wajib]
- `nilai` (nilai pagu) [number, wajib] → `nilai_pagu` double
- `hps` [number, wajib] → `hps` double
- Tombol: **Submit** → redirect `tender_admin.index`; **Edit** → redirect `tender_admin.tahapan/{id}`.
- Catatan: `tahapan_id` & `syarat_id` = 0 di controller; setelah submit admin lanjut atur tahapan.

### Tahapan Tender (`/tender_admin/tahapan/{id}`) — `tender_admin/tahapan/form.blade.php`
Satu form per tahapan (diulang):
- `nama` [text, wajib] — nama tahap
- `awal` [date, wajib] — mulai
- `akhir` [date, wajib] — selesai
- `status` [select, wajib] — **0=Biasa, 1=Masa Pendaftaran, 2=Masa Pembukaan File, 3=Pengumuman Pemenang, 4=Upload File**
- `id` [hidden] — tender_id
- Tombol: **Submit** → `TahapanController@store`.
- ⚠️ Pastikan tiap tender punya minimal 1 tahapan status=1 dan 1 status=4 (dipakai tombol peserta).

### Syarat Tender (`/tender_admin/syarat/{id}`)
- Form syarat: `judul`, `izin`, `usaha`, `content` [text/longtext, wajib].
- Detail syarat: `keterangan` [longtext].

## C. HOME & DETAIL TENDER (PESERTA)
### Home (`/home`) — `tender_user/home/home.blade.php`
- Grid/list tender **publish** (default=0): nama, jenis, metode, status, pagu/HPS, jadwal.
- Setiap item → link detail `tender_home/{id}`.

### Detail Tender (`/tender_home/{id}`) — `tender_user/home/show.blade.php`
- Info tender (nama, jenis, kontrak, metode, status, KLPD, dana, satker, lokasi, pagu, HPS).
- Daftar tahapan (loop `$data->tahapan`).
- **Zona Masa Pendaftaran** (jika `today` di dalam tahapan status=1):
  - Jika sudah daftar → teks **"Sudah Terdaftar"**
  - Jika punya profil & belum daftar → tombol **"Daftar Sebagai Peserta"** (modal konfirmasi → POST `/daftar_peserta` dgn `id`=peserta_id, `tender_id`)
  - Jika belum punya profil → teks **"Belum mendaftarkan perusahaan"**
- **Zona Upload** (tahapan status=4): tombol **"Masukkan File" / "Lihat File"** → `/penawaran_file/{id}`.
- Catatan: `$tahapan`/`$upfile` jangan null (seeder wajib isi status 1 & 4).

## D. REGISTRASI & PROFIL PESERTA
### Registrasi Profil (`/peserta/create`) — `tender_user/peserta/registrasi/form.blade.php`
Semua wajib (`*`), POST `/peserta`:
- Izin: `izin` [text, NIB/IUJK], `nomor_izin` [text], `izin_berlaku` [date], `instansi_pemberi` [text], `kualifikasi` [text], `klasifikasi` [textarea]
- Perusahaan: `nama_pt` [text], `no_hp` [text], `alamat` [textarea], `email` [email]
- Akta pendirian: `no_akta` [number], `tgl_akta` [date], `notaris` [text]
- Akta terbaru: `no_aktab` [number], `tgl_aktab` [date], `notaris_b` [text]
- KSWP: `kswp_npwp` [text], `kswp_nama` [text]
- Berkas (loop `$file` = tender_file default): input **`file_{{$tf->id}}`** [file, wajib] — accept jpg/jpeg/png/pdf/zip/rar/7z; key = id tender_file.
- `id` [hidden] — tender_id (default).
- Tombol: **Submit** → redirect `pengalaman.show/{peserta_id}`.
- Catatan: kalau user sudah punya profil, `/peserta/create` redirect ke edit.

### Edit Profil (`/peserta/{id}/edit`) — `tender_user/peserta/part/form.blade.php`
- Field sama seperti registrasi + `PUT /peserta/{id}` (`@method PUT`).
- Berkas lama: link download; input ganti **`file_{{$tf->id}}`** (id = tender_file_detail).
- Tombol: **Submit**, **Berikutnya** (→ `administrasi_list.show`).

### Pengalaman (`/pengalaman`) — `tender_user/peserta/pengalaman/create.blade.php`
- `pekerjaan`, `lokasi`, `instansi`, `alamat`, `no_hp`, `no_kontrak` [text]
- `tgl_kontrak` [date], `presentasi` [number/%, wajib], `tgl_selesai_kontrak` [date], `tgl_serah_terima` [date]
- `nilai_kontrak` [text], `keterangan` [longtext]
- `file1` [file] → `Tender/pengalaman/{peserta_id}`, `nama_file` [text]
- `id` [hidden] => peserta_id, `tender_id` [hidden]

### Tenaga Ahli (`/tenagaahli`)
- `nama` [text wajib], `tgl_lahir` [date], `jk` [select L/P], `alamat` [textarea], `negara` [text], `jabatan` [text], `pengalaman` [text], `email` [email], `keterangan` [longtext], `file` (+ `nama_file`), `id`/`tender_id` [hidden]

### Peralatan (`/peralatan`)
- `nama` [text], `jumlah` [text], `kapasitas` [text], `merk` [text], `tahun` [text], `kondisi` [text], `lokasi` [text], `kepemilikan` [text], `bukti` [text], `file` [+`nama_file`], `id`/`tender_id` [hidden]

### Pekerjaan Berjalan (`/pekerjaan_berjalan`)
- Mirip pengalaman + `nilai_kontrak` [text]; semua field kerja lapangan.

### Managemen/Pengurus (`/managemen`)
- `nama` [text], `tgl_menjabat`/`tgl_berakhir` [date], `ktp` [text], `alamat` [textarea], `npwp` [text], `status` [text — jabatan]
- Lampiran: `file1..file5` + `ket1..ket5`

## E. PENAWARAN
### Halaman Upload Penawaran (`/penawaran_file/{tender_id}`) — `tender_admin/penawaran/show.blade.php`
- Menampilkan **HPS** (`@currency(hps)` — Rp. 1.450.000.000) & penjelasan penawaran.
- Jika peserta **belum** punya penawaran (`penawaran_peserta` null):
  - `penawaran` [number, wajib] — nominal penawaran
  - Loop `penawaran_files` (dari `penawarans.penawaran_file`): input **`file_{{$pf->id}}`** [file, wajib] — accept pdf/jpg/zip
  - `id` [hidden] = tender_id → **POST `/penawaran_peserta`**
- Jika **sudah** punya penawaran: tampilkan nilai penawaran + daftar file (link download).
- ⚠️ Data `penawarans`+`penawaran_files` harus disiapkan (panitia/admin) dulu; jika tidak, controller menolak dengan pesan "belum disiapkan".

## F. ADMIN: PEMERIKSAAN & PENILAIAN
### Dashboard (`/dashboard`) & `/dashboard/{id}`
- Tabel peserta per tender + kolom penawaran.
### Pemeriksaan (`/pemeriksaan`)
- Checklist per peserta: `pengalaman`, `tenaga_ahli`, `peralatan`, `pekerjaan_berjalan`, `managemen`, `file` — masing-masing radio Ada/Tidak + `k_*` keterangan.
### Penilaian (`p_admin`, `p_kualifikasi`, `p_teknis`, `p_peserta`)
- `status` [select Lulus / Tidak Lulus], `keterangan` [longtext]; `peserta_id`/`tender_id` [hidden].
- `periksa` → ringkasan `penilaian_pesertas` (administrasi/kualifikasi/teknis/penawaran/kesimpulan).
### Kirim hasil (`POST /send_hasil`)
- `peserta_id`, `tender_id`, `point`, `email` [hidden] → kirim email hasil + status tiap tahap.

## G. LAIN-LAIN
- **Sanggahan** (`/sanggahan`): `keterangan` [longtext], `file` [file], `tender_id`/`peserta_id` [hidden].
- **Komentar** (`/komen`): komentar per peserta (`tender_komens`).
- **Koreksi** (`/koreksi`): koreksi item.
- **Validasi File** (`/validasi_file`): per `tender_file_detail` — `status` [valid/tidak] + `keterangan`.
- **Master** (`jenis_pengadaan`, `jenis_kontrak`, `metode_pengadaan`, `status_tender`, `tahapan`, `katagori`): form `nama` (+ `keterangan` dsb), tabel list, edit/hapus.

## H. ATURAN UMUM FORM (kesimpulan dari bug yang sudah diperbaiki)
1. **File input harus `name="file_{id}"`** (jangan numerik saja) — mencegah reindex `array_merge`.
2. Semua kolom NOT NULL di DB harus diisi form (lihat `TESTING_README.md`); hindari error 500 "Field xxx doesn't have a default value".
3. `@currency(...)` aman dipanggil dgn string/null (directive sudah is_numeric guard).
4. Form dengan file wajib `enctype="multipart/form-data"` — sudah dipakai semua.
5. Gunakan `@csrf` (dan `@method` utk PUT/PATCH/DELETE).