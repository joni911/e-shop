# HANDOFF — Update UI 2 Fix Kode (branch `update-ui-2-fix-kode`)

## Ringkasan
Perbaikan bug + peningkatan UX untuk **halaman peserta** dan **upload file**:

1. **Bug kritis (fix)**: `PenawaranFileController::show` dan `PenawaranPesertaController::store`
   memakai `$user->peserta->id` TANPA cek null → error 500 jika user belum punya profil peserta.
   Sekarang di-guard: user tanpa profil diarahkan lengkapi profil; user belum terdaftar ditolak upload.

2. **Bug duplikat (fix)**: `DaftarPesertaController::store` tidak cek duplikat (model SoftDeletes
   → bisa daftar ganda). Sekarang tolak jika sudah terdaftar (termasuk soft-deleted) + validasi
   kepemilikan `peserta_id`.

3. **Guard jalur upload lain (fix)**: `AdministrasiDetailController::store` dan
   `FileTeknisController::store` juga di-guard (harus terdaftar).

4. **UX upload file**:
   - Komponen `x-file` di-upgrade: badge status **"Sudah diisi"** (hijau) / **"Belum diisi"** (merah),
     preview instan gambar (thumbnail) & PDF (link lihat), preview + download untuk file existing,
     error state merah.
   - Validasi client-side: field required kosong → border merah + **toast/popup error** berisi
     daftar field yang wajib dilengkapi.
   - Halaman File Peserta: kartu **Kelengkapan Berkas Wajib** (progress bar + checklist hijau/merah).

5. **Upload best-practice (refactor)**:
   - Service baru `app/Services/FileUploadService.php`: nama file UUID (anti-tabrakan),
     sanitasi path, mkdir aman, helper delete.
   - Refactor controller ke service: PesertaController, PenawaranPesertaController,
     AdministrasiDetailController, FileTeknisController, PengalamanTenderController,
     PeralatanController, TenagaAhliController, ManagemenController (hapus 10 fungsi duplikat → 1 helper).
   - Validasi `mimes` + `max:10240` di FormRequest (`pesertaRequest`, `Storepenawaran_pesertaRequest`).
   - File tetap disimpan di `public/Tender/...` (path DB `Tender/...` kompatibel dgn view lama + data existing).

6. **UI home**: tombol "Masukkan File" hanya tampil jika sudah terdaftar; jika belum, alert warning.

## File diubah (26 + 2 baru)
- `app/Services/FileUploadService.php` (BARU)
- `tests/Feature/UploadGuardFixTest.php`, `tests/Feature/FileComponentRenderTest.php` (BARU)
- Controller: `PesertaController`, `PenawaranPesertaController`, `PenawaranFileController`,
  `DaftarPesertaController`, `AdministrasiDetailController`, `FileTeknisController`,
  `PengalamanTenderController`, `PeralatanController`, `TenagaAhliController`, `ManagemenController`
- Request: `pesertaRequest`, `Storepenawaran_pesertaRequest`
- View: `components/file.blade.php`, `tender_admin/penawaran/show`, `tender_user/home/show`,
  `peserta/edit`, `peserta/files/show`, `peserta/part/form`, `peserta/registrasi/form`,
  layouts (cache-buster `?v=2`)
- Aset: `public/ui/css/components.css`, `public/ui/js/ui.js`, `public/ui/js/app.js`

## Verifikasi
- `php artisan test` → **77 passed (326 assertions)** — termasuk 6 test baru.
- Halaman dicek via HTTP: `/penawaran_file/5`, `/peserta/1/edit`, `/peserta/1/file_tender/1` render
  badge status + preview + checklist dengan benar.

## Catatan penting
- **Storage tetap di `public/Tender/...`** (bukan `storage/app/public`) demi kompatibilitas
  data lama & view `href="/{{ $file }}"`. Jika ingin migrasi penuh ke Storage disk `public`,
  perlu: `php artisan storage:link`, update semua link view, migrasi data — di luar scope ini.
- Nama file baru memakai UUID → tidak lagi bentrok antar peserta seperti `time()`.
- File lama yang diganti saat update **dihapus** (tidak menumpuk).
- Cache browser: layout memakai `?v=2` untuk CSS/JS yang diubah.
