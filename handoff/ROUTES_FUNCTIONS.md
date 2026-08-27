# ROUTES & FUNGSI — Pemetaan Router → Controller → Fungsi

> Sumber: `routes/web.php` (+ `php artisan route:list`). Semua route ini berada di grup **auth + verified** kecuali dinyatakan lain. Controller menggunakan pola resource (index/create/store/show/edit/update/destroy).

## 1. Autentikasi (tanpa middleware grup)
| Route | Controller | Fungsi |
|---|---|---|
| `GET /` | — | redirect ke login |
| `/login`, `/logout`, `/register` | `Auth\*` | Laravel Auth + verifikasi email (`verify=true`) |
| `/email/verify/*`, `/email/resend` | `Auth\VerificationController` | verifikasi email |

## 2. Tender (Admin / PPK)
| Route | Controller → Method | Fungsi |
|---|---|---|
| `tender_admin` (resource) | `tenderController@index/create/store/edit/update/destroy` | CRUD tender. **`store`**: nama, paket, `jenis_pegadaan_id`(=jp), `jenis_kontrak_id`(=jk), `metode_pengadaan_id`(=mp), `status_tender_id`, KLPD, sumber dana, satuan kerja, tahun anggaran, lokasi, nilai_pagu, hps; `tahapan_id=0` & `syarat_id=0` hardcode; `default=0` |
| `GET /tender_admin/syarat/{id}` | `tenderController@show_syarat` | Kelola syarat tender |
| `GET /tender_admin/tahapan/{id}` | `tenderController@show_tahapan` | Kelola tahapan tender (form isi nama, awal, akhir, status 0-4) |

## 3. Tender Home (peserta)
| Route | Controller → Method | Fungsi |
|---|---|---|
| `GET /home` | `TenderHomeController@index` | Daftar tender **publish** (`default=0`) + info status |
| `tender_home` (resource) | `TenderHomeController@show` dkk | **`show`**: detail tender; jika user tak punya peserta → redirect `peserta.index`; ambil `$tahapan` (status=1, Masa Pendaftaran) & `$upfile` (status=4, Upload File) untuk menampilkan tombol daftar & tombol upload |
| `tender_home/{id}/edit` | `TenderHomeController@edit` | Set persyaratan tender (admin) |

## 4. Pendaftaran Peserta & Profil
| Route | Controller → Method | Fungsi |
|---|---|---|
| `peserta` (resource) | `PesertaController` | **`create`**: jika user sudah punya profil → redirect `peserta.edit`; jika belum → form registrasi profil + berkas (data tender default). **`store`**: validasi semua berkas wajib (`file_{tender_file.id}`) → simpan `pesertas` + `tender_file_details` (path `Tender/FILE/{tender_id}/{tender_file_id}/`) → redirect `pengalaman.show`. **`update`**: update profil + ganti berkas. **`show`/`getPeserta`**: tampil create jika belum daftar. **`point_tender`/`send_hasil`**: hitung poin 4 tahap & kirim email hasil |
| `GET peserta/tender/{id}` | `PesertaController@show_peserta` | Daftar peserta yang mengikuti suatu tender |
| `GET peserta/{id}/file_tender/{pid}` | `PesertaController@show_file_peserta` | Detail file & penilaian peserta (admin) |

## 5. Daftar ke Lelang
| Route | Controller → Method | Fungsi |
|---|---|---|
| `daftar_peserta` (resource) | `DaftarPesertaController@store` | **`store`**: insert `daftar_pesertas` (peserta_id, tender_id, user_id) + kirim notifikasi `NotifikasiDaftarTender` (mail). **Belum ada cek duplikat** |

## 6. Kelengkapan Kualifikasi Peserta
| Route | Controller → Method | Fungsi |
|---|---|---|
| `pengalaman` (resource) | `PengalamanTenderController` | CRUD pengalaman kerja: pekerjaan, lokasi, instansi, alamat, no_hp, no_kontrak, tgl_kontrak, presentasi, tgl_selesai, tgl_serah_terima, nilai_kontrak, file (`Tender/pengalaman/{peserta_id}`) |
| `tenagaahli` (resource) | `TenagaAhliController` | CRUD tenaga ahli: nama, tgl_lahir, jk, alamat, negara, jabatan, pengalaman, email, file |
| `peralatan` (resource) | `PeralatanController` | CRUD peralatan: nama, jumlah, kapasitas, merk, tahun, kondisi, lokasi, kepemilikan, bukti, file |
| `pekerjaan_berjalan` (resource) | `PekerjaanBerjalanController` | CRUD pekerjaan berjalan (mirip pengalaman + nilai_kontrak) |
| `managemen` (resource) | `ManagemenController` | CRUD pengurus: nama, tgl_menjabat/berakhir, ktp, alamat, npwp, status, file1-5+ket1-5 |

## 7. Penawaran
| Route | Controller → Method | Fungsi |
|---|---|---|
| `penawaran` (resource) | `PenawaranController` | Data penawaran tender (admin): judul, penjelasan, anggaran, hps |
| `penawaran_file` (resource) | `PenawaranFileController@show` | **`show`**: halaman upload penawaran peserta — tampil HPS + `penawaran_files` wajib (dari `penawarans`) |
| `penawaran_peserta` (resource) | `PenawaranPesertaController@store` | **`store`**: converge — jika `penawarans` belum ada → redirect error; validasi `file_{penawaran_file.id}`; **updateOrCreate per (peserta_id, tender_id)**; ganti `penawaran_peserta_files` (forceDelete lama); file → `Tender/penawaran/{tender}/{user}` |
| `penawaran_peserta_file` (resource) | `PenawaranPesertaFileController` | CRUD file penawaran peserta |

## 8. Pemeriksaan & Penilaian (admin)
| Route | Controller → Method | Fungsi |
|---|---|---|
| `dashboard` (resource) | `DashboardController@index/show` | **`show`**: daftar peserta tender + nilai penawaran |
| `periksa` (resource) | `PenilaianTenderController` | Penilaian keseluruhan (tabel `penilaian_pesertas`) |
| `p_admin` | `PenilaianAdministrasiController` | Penilaian administrasi (status Lulus/Tidak + keterangan) |
| `p_kualifikasi` | `PenilaianKualifikasiController` | Penilaian kualifikasi |
| `p_teknis` | `PenilaianTeknisController` | Penilaian teknis |
| `p_peserta` | `PenilaianPenawaranPesertaController` | Penilaian penawaran |
| `pemeriksaan` (resource) | `PemeriksaanController` | Checklist pemeriksaan: pengalaman, tenaga_ahli, peralatan, pekerjaan_berjalan, managemen, file (+ keterangan tiap item) |
| `administrasi` / `administrasi_list` | `AdministrasiController` / `AdministrasiDetailController` | Daftar administrasi + detail per peserta |
| `file_teknis` (resource) | `FileTeknisController` | Upload SMKK/komitmen teknis per peserta |
| `koreksi` (resource) | `KoreksiController` | Koreksi penawaran |
| `validasi_file` (resource) | `ValidasiFileController` | Validasi berkas `tender_file_details` (status valid/tidak) |
| `sanggahan` (resource) | `SanggahController` | Sanggahan peserta: keterangan + file |
| `komen` (resource) | `TenderKomenController` | Komentar/discussion per peserta |
| `POST send_hasil` | `PesertaController@send_hasil` | Kirim email hasil penilaian (status 4 tahap + kesimpulan lulus) |

## 9. Master Data
`jenis_pengadaan`, `jenis_kontrak`, `metode_pengadaan`, `status_tender`, `tahapan`, `katagori`, `syarat`, `syarat_detail`, `perubahan` — resource CRUD sederhana (nama + timestamps; soft deletes). `tahapan` dipakai `TahapanController` (store mengisi `status` dari dropdown 0-4).

## 10. Modul Barang / E-Commerce (terpisah dari tender)
`barang`, `katagori`, `komentar`, `shops` (user barang), `shops/add/{id}`, `CreatePhoto`, `photoStore` — manajemen barang & belanja (modul lama, tidak terkait alur PBJ utama).

## Logika Bisnis Kunci
- **Index home**: `tender::where('default',0)` — hanya tender non-default yang tampil.
- **Tombol daftar/halaman detail**: tergantung `tahapans.status` (1 = Masa Pendaftaran → tombol Daftar; 4 = Upload File → tombol Masukkan File), rentang `today >= mulai && today <= akhir`.
- **Penilaian**: 4 tabel penilaian; `point_tender` = jumlah status "Lulus" (≥4 = lulus semua); `send_hasil` mengirim email.
- **Pemenang**: `pemenang_tenders.lelang_id` = tender_id (perhatikan nama kolom).
- **File**: path relatif disimpan di DB; fisik di `public/Tender/...`; folder dibuat saat upload.