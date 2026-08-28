# HANDOFF — UI Rewrite v3 (Branch `update-ui-2`)

> Dokumen untuk melanjutkan pekerjaan besok.
> **Branch aktif**: `update-ui-2` (dibuat dari `7e1dc57` = snapshot bersih sebelum migrasi UI).
> **PRD acuan**: `handoff/PRD_UI_REWRITE_v3.md`.
> **Status**: Migrasi UI **BERJALAN** — F0–F4 (bagian inti) selesai. F4 sisa + F5 + F6 belum.

---

## 1. Ringkasan Proyek

- **Stack**: Laravel 12 (PHP 8.4), Blade + Bootstrap 5.3, CSS custom (`public/ui/`). **Tidak ada React/Redux.**
- **Domain**: Tender/lelang pengadaan PBJ (Perpres 16/2018).
- **Branch backup**: `update-ui` (M1–M7, pendekatan lama yang ditolak) & `update-ui-backup` (salinan `update-ui`).
- **Branch kerja**: `update-ui-2` — pendekatan BARU: **hapus total UI AdminLTE, rebuild halaman dari template** `template_to_use/` (Bootstrap 5.3 tema orange).

---

## 2. KEPUTUSAN PENTING (hasil grill-me v3 — 9 poin)

| # | Topik | Keputusan |
|---|-------|-----------|
| Q1 | Strategi | **Template-Driven Page Mapping** — tiap halaman yang punya template di-copy strukturnya; tanpa template → pakai komponen reusable |
| Q2 | Data tetap | **Inventaris data dulu + diff-test** — data yang tampil HARUS SAMA (tidak berkurang) |
| Q3 | Urutan | **Bertahap per fitur** (1 milestone = 1 commit) |
| Q4 | Layout | **3 layout per role**: `guest` / `peserta` / `admin` |
| Q5 | Tanpa template | **Komponen reusable** (x-card/table/input/select/file/textarea/button/alert/modal) |
| Q6 | AdminLTE | Ganti `@extends('adminlte::page')` bertahap; **hapus package AdminLTE di F6** |
| Q7 | Fondasi | Komponen & layout dibangun DULU (F0), lalu halaman |
| Q8 | Scope | Semua fitur + e-shop legacy |
| Q9 | Aset | Salin template → `public/ui/`, load `asset('ui/...')` |

---

## 3. STATUS MILESTONE

| Milestone | Status | Catatan |
|-----------|--------|---------|
| **F0** Foundation | ✅ SELESAI | Aset `public/ui/`, 3 layout, 9 komponen, `UiFoundationTest` |
| **F1** Auth | ✅ SELESAI | login/register/verify/password → layout guest + komponen |
| **F2** Beranda & Detail | ✅ SELESAI | home (tender-card grid) + show (detail header + tahapan timeline + modal) + `Perubahan` + `PublicTenderRewriteTest` |
| **F3** Registrasi & Upload | ✅ SELESAI | registrasi (form-section + steps) + upload penawaran (HPS + form) + `RegistrasiUploadTestSeeder` + guard zona |
| **F4** Admin (bagian inti) | ✅ DONE | kelola tender (index/create/edit) + dashboard pemeriksaan + fix relasi tender + `AdminRewriteTest` (+ fix role menu) |
| **F4** sisa (dashboard/show & tahapan) | ⏳ BELUM | Halaman pemeriksaan detail & atur tahapan masih AdminLTE |
| **F5** Master data + e-shop | ⏳ BELUM | jenis_kontrak, jenis_pengadaan, metode, status, tahapan, katagori, perubahan, e-shop (Barang/shops/user_barang) |
| **F6** Cleanup AdminLTE | ⏳ BELUM | Hapus semua `@extends('adminlte::page')`, `x-adminlte-*`, package AdminLTE, aset vendor |

**Test**: `php artisan test` → **49 passed / 164 assertions** (sqlite :memory:).

---

## 4. KEPUTUSAN TEKNIS PENTING (yang sudah diterapkan)

### 4.1 Modal — PAKAI CLASS UNIK (jangan pakai Bootstrap `.modal`)
Template `components.css` mendefinisikan `.modal` CUSTOM yang **bentrok dengan Bootstrap `.modal`**. Solusi:
- Komponen `x-modal` menghasilkan `.x-modal-overlay` + `.x-modal-box` (class unik) + CSS inline via `@push('css')`.
- Trigger buka: `data-modal="id"`; tutup: `data-modal-close="id"` (bukan `data-bs-toggle`/`data-bs-dismiss`).
- `ui.js` menangani `.x-modal-overlay` untuk buka/tutup/klik-overlay/Escape.
- **JANGAN gunakan `data-bs-toggle="modal"`** — itu memicu Bootstrap modal, bukan custom.

### 4.2 Bug Blade: `@php` di dalam `@foreach` → gunakan `<?php ?>`
Blade compiler error `unexpected token endforeach` jika ada `@php ... @endphp` di dalam `@foreach` yang punya nested inline `@if`. Ganti dengan `<?php ... ?>`.

### 4.3 Relasi Model `tender` — SUDAH FIX (belongsTo)
- `status()`, `status_tender()`, `metode()`, `jenis_kontrak()`, `jenis_pengadaan()` → **`belongsTo`** (bukan `hasOne`).
- Karena `hasOne` mencari `jenis_pengadaans.tender_id` (tidak ada) → error di halaman admin.

### 4.4 Layout Dinamis berdasarkan role
- `tender_user/home/home.blade.php` & `show.blade.php`:
  ```blade
  @extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')
  ```
- Ini agar admin tidak mendapat menu peserta.

### 4.5 Guard Zona (bisnis)
- **Hanya boleh upload penawaran jika SUDAH terdaftar** (`daftar_peserta`) utk tender tsb.
- Di `PenawaranPesertaController@store` & `PenawaranFileController@show` + view (pesan "Belum Terdaftar" bila belum daftar).
- Model `daftar_peserta` ditambah `$fillable`.

---

## 5. KOMPONEN REUSABLE (di `resources/views/components/`)
`x-card`, `x-table`, `x-input`, `x-select`, `x-file`, `x-textarea`, `x-button`, `x-alert`, `x-modal` (custom).

### API singkat
- `x-card :title="..."` + slot `actions`, `header`, `footer`
- `x-table :head="[...]"` — slot = `<tr>` rows, empty state otomatis
- `x-input label name type value required hint`
- `x-select label name :options value placeholder` (options = Collection model `id`/`nama`, atau array `[k=>v]`)
- `x-file label name required accept hint`
- `x-textarea label name rows value`
- `x-button label variant href type icon` — meneruskan semua atribut `data-*`
- `x-alert type dismissible title` — type: success/warning/danger/info/primary
- `x-modal id title size` — slot body + `footer`; trigger `data-modal`/`data-modal-close`

---

## 6. LAYOUT PER ROLE (di `resources/views/layouts/`)
- `guest.blade.php` — auth & publik, tanpa sidebar (`.auth-page`)
- `peserta.blade.php` — sidebar menu terbatas (Peserta, Beranda, Sanggahan)
- `admin.blade.php` — sidebar menu penuh (Peserta, Beranda, Kelola Tender, Master, Pemeriksaan)

Semua load: Bootstrap 5.3 CDN, jQuery 3.7, FontAwesome 6, `public/ui/css/*`, `public/ui/js/*`, body class `ui-shell`.

---

## 7. ASET & TEMPLATE
- **Aset** sudah disalin ke `public/ui/` (css/js/img).
- **Template** di `template_to_use/` — **jangan di-deploy**, hanya referensi desain. Punya halaman per fitur:
  `login, register, home, tender-detail, peserta-registrasi, penawaran-upload, tender-admin-index, tender-admin-form, tender-admin-tahapan, admin-dashboard, admin-pemeriksaan, public-tenders`.

---

## 8. HALAMAN YANG MASIH PERLU DI-REWRITE (pekerjaan besok)

### F4 sisa (prioritas)
- `resources/views/dashboard/peserta/show` — pemeriksaan peserta **detail** (kompleks: tabel penilaian 4 tahap, file) → template `admin-pemeriksaan.html`
- `resources/views/tender_admin/tahapan/*` — atur tahapan → template `tender-admin-tahapan.html`

### F5 Master data & e-shop (semua masih `@extends('adminlte::page')`)
- `jenis_kontrak`, `jenis_pengadaan`, `metode_pengadaan`, `status_tender`, `tahapan`, `katagori`, `perubahan` (index/create/edit → pakai komponen `x-card`/`x-table`/`x-form`)
- e-shop legacy: `Barang`, `user_barang`, `shops`

### F6 Cleanup AdminLTE (terakhir)
- Semua `@extends('adminlte::page')` tersisa → ganti `@extends('layouts.*')`
- Semua `x-adminlte-*` tersisa di blade → ganti komponen
- Hapus package `jeroennoten/laravel-adminlte` dari composer
- Hapus aset `public/vendor/adminlte`, `public/vendor/bootstrap` dll
- `php artisan view:clear` + smoke test semua route

---

## 9. TEMPLATE → HALAMAN MAPPING (untuk lanjut)

| Template `template_to_use/` | Fitur | View target |
|-----|-----|-----|
| `login.html`/`register.html` | Auth | `auth/*` ✅ |
| `home.html` | Beranda | `tender_user.home.home` ✅ |
| `tender-detail.html` | Detail | `tender_user.home.show` ✅ |
| `peserta-registrasi.html` | Registrasi | `tender_user.peserta.registrasi.*` ✅ |
| `penawaran-upload.html` | Upload | `tender_admin.penawaran.show` ✅ |
| `tender-admin-index.html` | Kelola | `tender_admin.index` ✅ |
| `tender-admin-form.html` | Form | `tender_admin.create/edit` ✅ |
| `tender-admin-tahapan.html` | Tahapan | `tender_admin.tahapan` ⏳ |
| `admin-dashboard.html` | Dashboard | `dashboard.index` ✅ (belum pakai stats card template) |
| `admin-pemeriksaan.html` | Pemeriksaan | `dashboard.peserta.show` ⏳ |
| `public-tenders.html` | Publik | (belum ada route/controller) |

---

## 10. TEST SUITE (49 hijau)
- `UiFoundationTest` (4) — layout & komponen
- `AuthRewriteTest` (5) — auth
- `PublicTenderRewriteTest` (7) — beranda/detail + perubahan
- `RegistrasiUploadTest` (2) — registrasi/upload
- `PenawaranPesertaTest` (7) — upload + guard zona
- `AdminRewriteTest` (6) — kelola tender + menu role
- `PendaftaranTest`, `PenawaranPesertaTest` lama (sudah diupdate sesuai aturan baru)
- `HakAksesTest` (6), `ExampleTest`, dll

---

## 11. CARA JALANKAN

```bash
# Reset + seed penuh
php artisan migrate:fresh --seed

# Seeder test registrasi & upload (opsional)
php artisan db:seed --class="Database\Seeders\RegistrasiUploadTestSeeder"

# Test suite
php artisan test

# Server lokal
php artisan serve --port=8000
```

Kredensial:
- Admin: `admin@pbj.go.id` / `password`
- Peserta: `peserta1@maju-jaya.co.id` / `password` .. `peserta4@...`
- Registrasi test: `registrasi-test-*@pengadaan.test` / `password` (dibuat oleh seeder)

---

## 12. VERIFIKASI VISUAL (sudah OK per user)
- F0–F1 (auth) ✅
- F2 (beranda/detail) ✅ + fix status badge & modal ✅
- F3 (registrasi/upload) ✅ + guard zona ✅
- F4 (kelola tender/dashboard) — perlu verifikasi visual lanjutan

---

## 13. PERLU DICEK / RISIKO BESOK
1. **`dashboard.show` (pemeriksaan detail)** — paling kompleks, banyak tabel penilaian & file; hati-hati data field.
2. **Form admin**: pastikan relasi `jenis_pengadaan`/`metode`/`status_tender` menampilkan nama benar (sudah fix belongsTo).
3. **e-shop legacy** (`Barang`/`shops`/`user_barang`) — mungkin tidak dipakai domain pengadaan; konfirmasi apakah perlu di-rewrite.
4. **Router `/`** masih `redirect()->route('login')` — OK.
5. **`@php` di loop** — ingat pakai `<?php ?>` bila error blade.

---

## 14. REFERENSI FILE
- `handoff/PRD_UI_REWRITE_v3.md` — PRD & milestone (baca dulu).
- `handoff/PRD_UI_MIGRATION.md` — PRD lama (M1–M7, ditolak).
- `template_to_use/README.md` — deskripsi design system & tiap template.
- `TESTING_README.md`, `ALUR_PENGADAAN.md` — alur bisnis & testing.

---

*Sesi UI rewrite v3 selesai sampai F4 (bagian inti). Lanjut besok: F4 sisa → F5 → F6 (cleanup AdminLTE). Semua keputusan & patch penting sudah didokumentasikan di atas.*
