# HANDOFF — Sistem Pengadaan Barang/Jasa (PBJ) — Laravel

> Dibuat dari sesi analisis, seeding, dan pengujian TDD. Untuk agent/sesi berikutnya melanjutkan pekerjaan.

## Ringkasan Proyek
- **Stack**: Laravel 12 (PHP 8.4), MySQL (port 3307, db `pengadaan2`), Blade + AdminLTE (`jeroennoten/laravel-adminlte`), Bootstrap/jQuery. **Tidak ada React/Redux (RTK)** — semua Blade.
- **Domain**: Tender/lelang pengadaan sesuai alur PBJ (Perpres 16/2018): admin (PPK/panitia) membuat tender → peserta mendaftar → upload berkas & penawaran → penilaian 4 tahap → pemenang.
- **Auth**: Laravel `Auth::routes(['verify'=>true])`; seluruh route bisnis di grup `middleware auth + verified`.

## Status Pekerjaan Sesi Ini
1. **Analisis alur** lengkap → lihat `ALUR_PENGADAAN.md` (root proyek).
2. **Seeder** dibuat & jalan (`php artisan migrate:fresh --seed`): Master, User, Tender, Peserta, Penilaian, + **TenderTestingSeeder** (tender uji coba id=5, *tanpa peserta*, jadwal auto-reset ke hari ini).
3. **Test suite hijau**: `php artisan test` → **17 passed / 51 assertions** (sqlite :memory: — tidak menyentuh DB MySQL).
4. **Server lokal** berjalan di `http://127.0.0.1:8000` (artisan serve, auto-reload kode per request). **Catatan**: browser remote (kitesurf/Cloudflare) tidak bisa akses localhost → pengujian E2E dilakukan via curl HTTP (CSRF + session cookie + multipart).

## Perbaikan Bug yang Sudah Diterapkan (semua divalidasi test)
0. **PEMISAHAN HAK AKSES (admin vs user/peserta)** — sebelum ini semua route hanya `auth+verified` (tidak ada role), dan menu switch cuma kenal `'user'` sehingga peserta dapat menu admin. Sekarang:
   - **Middleware baru** `app/Http/Middleware/CheckRole.php` (alias `role`) — daftar di `bootstrap/app.php`; `'user'` dinormalisasi setara `'peserta'`; `->middleware('role:admin')` → 403 utk non-admin.
   - **routes/web.php**: seluruh route admin dibungkus `Route::middleware('role:admin')->group(...)` (master, tender_admin, syarat/tender_file, penawaran, penilaian p_*/dashboard/periksa, pemeriksaan, send_hasil). Route **peserta-face TETAP shared**: `peserta`, `pengalaman`,`tenagaahli`,`peralatan`,`pekerjaan_berjalan`,`managemen`, `daftar_peserta`, `sanggahan`, `komen`, `koreksi`, `penawaran_peserta(_file)`, serta **`administrasi`, `administrasi_list`, `file_teknis`, `validasi_file`, `penawaran_file`** (ternyata diisi/dilihat peserta, divalidasi test lama).
   - **Menu** `app/Providers/AppServiceProvider.php`: `case 'admin'` = menu penuh; `default` (user/peserta) = menu terbatas (Peserta, Tender User, Sanggahan).
   - **View**: `tender_user/home/home.blade.php` & `tender_admin/tahapan/tahapan.blade.php` ubah `hak_akses != 'user'` → `== 'admin'` (tombol +Tambah hanya admin).
   - **DB default**: kolom `users.hak_akses` kini `DEFAULT 'user'` (migration `2026_08_27_163134_add_default_hak_akses_to_users_table`) — sebelumnya default hanya hardcode di `RegisterController@create` (`'user'`). Nilai: seeder `admin`/`peserta`; register publik `user` (setara peserta di aturan role).
   - Test baru `tests/Feature/HakAksesTest.php` (6 test). Total suite **23 passed / 64 assertions**.

1. **Kolom `tahapans.status` hilang** → migration `2026_08_27_123208_add_status_to_tahapans_table` (0=Biasa,1=Pendaftaran,2=Buka File,3=Pemenang,4=Upload File). Seeder isi status per tahapan.
2. **Upload berkas pendaftaran file ke-4+ selalu ditolak** → input file di-rename `file_{id}`, controller pakai `hasFile('file_'.$x)`/`file('file_'.$x)` (magic property `$request->$x` gagal karena `array_merge` me-reindex key numerik).
3. **Error 500 upload** → `tender_file_details.status_id` NOT NULL tidak diisi → `$tfs->status_id = 0`.
4. **Path upload update rusak** (update pakai `$request->id` tak ada) → ganti `$data->tender_id`; hapus `echo $tfs` debug.
5. **UserSeeder tidak verified** (email_verified_at bukan fillable) → `forceFill`.
6. **TypeError number_format** di `/penawaran_file/{id}` → directive `@currency` kini `is_numeric ? (float) : 0`; view null-safe (`optional($data)` + `?? []`).
7. **Error submit penawaran** (`Attempt to read property "penawaran_file" on null`) → `PenawaranPesertaController@store` guard kalau `penawarans` belum disiapkan; input file `file_{id}`; mkdir folder upload.
8. **`penawaran_pesertas.peserta_id` UNIQUE global** → migration `2026_08_27_144625_fix_unique_penawaran_pesertas_per_peserta_tender` menjadi unique composite `(peserta_id, tender_id)`; `store()` pakai `updateOrCreate` (submit ulang = update + ganti file); model diberi `$fillable`. **Peserta boleh ikut banyak tender**.
9. **TenderTestingSeeder** kini **reset jadwal ke hari ini** setiap dijalankan (bukan skip), + `ensurePenawaran()` membuat `penawarans`+`penawaran_files` (HPS 1.45M + 2 file wajib) utk tender 5.

## Cara Menjalankan
```bash
php artisan migrate:fresh --seed                # reset penuh + seed (termasuk tender uji coba id=5)
php artisan db:seed --class='Database\Seeders\TenderTestingSeeder'  # reset jadwal tender 5 ke hari ini
php artisan test                                # suite (sqlite memory)
php artisan serve --port=8000                   # server lokal
```
Kredensial (testing): `admin@pbj.go.id`, `peserta1@maju-jaya.co.id` .. `peserta4@...` (password `password`, verified).

## Hal Penting / Catatan Desain
- **Peserta = 1 profil per user** (`pesertas.user_id` UNIQUE); profil terhubung ke **tender default** (`tenders.default=1`, id=1) yang berisi berkas wajib registrasi.
- **Pendaftaran ke lelang** = `daftar_pesertas` (per peserta per tender) — **belum ada cek duplikat** (potensi record ganda) — TODO.
- **Validasi pendaftaran/penawaran hanya di controller & tampilan** (belum cek rentang tahapan di server).
- `penawaran_pesertas` poin di atas (multi tender OK).
- File disimpan di `public/Tender/...` (path relatif DB), folder dibuat otomatis (mkdir) saat upload.
- Notifikasi `NotifikasiDaftarTender` memakai channel **mail**; `.env` masih `MAIL_MAILER=smtp` (niagahoster) — untuk development lebih aman `array`.

## File Referensi
- `ALUR_PENGADAAN.md` — alur lengkap PBJ (baca pertama).
- `TESTING_README.md` — kredensial, data seed, tabel bug & hasil pengujian.
- `handoff/HANDOFF.md` — dokumen ini.
- `handoff/ROUTES_FUNCTIONS_FULL.md` — **DAFTAR LENGKAP**: seluruh 334 route (`route:list`) + semua 405 public method dari 56 controller (beserta baris sumber).
- `handoff/ROUTES_FUNCTIONS.md` — ringkasan pemetaan route → controller → fungsi per domain.
- `handoff/UI_REQUIREMENTS.md` — kebutuhan UI per halaman.
- Tests: `tests/Feature/PendaftaranTest.php`, `tests/Feature/PenawaranPesertaTest.php`.
- Seeder: `database/seeders/*` (Master, User, Tender, Peserta, Penilaian, TenderTesting).

## Suggested Skills (untuk sesi berikut)
- `test-driven-development` — setiap perbaikan/feature baru wajib test dulu (README+suite siap).
- `browser-testing-with-devtools` — saat UI/perilaku browser; ingat browser remote tidak bisa akses localhost → gunakan curl HTTP/CSRF atau minta user buka browser lokal.
- `debugging-and-error-recovery` — kalau muncul error baru (banyak jebakan NOT NULL & key numerik).
- `documentation-and-adrs` — catat keputusan desain berikutnya (mis. aturan duplikat daftar_peserta, guard rentang waktu di server).

## TODO / Kemungkinan Lanjutan
- Guard duplikat `daftar_pesertas` (updateOrCreate) + cek kepemilikan peserta_id milik user.
- Validasi server untuk rentang tahapan (status 1/4) saat POST daftar & penawaran.
- Panel admin: input data `penawarans`/`penawaran_files` belum lengkap di UI (hanya via seeder) — verifikasi menu PenawaranController.
- Menambang `pemenang_tenders.lelang_id` (kolom = lelang_id, bukan tender_id).