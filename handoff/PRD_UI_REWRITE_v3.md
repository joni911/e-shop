# PRD — UI Rewrite v3: Hapus AdminLTE, Rebuild dari Template (Branch `update-ui-2`)

> Dokumen hasil sesi grill-me ke-3 (keputusan 1-per-1) bersama pemilik proyek.
> **REAKSI terhadap hasil M1–M7 di branch `update-ui`** yang "tidak bagus" karena
> pendekatan *shell-override AdminLTE + shim + compat CSS* menghasilkan UI campuran (legacy + baru).
> Pendekatan baru: **hapus total UI lama, rebuild halaman langsung dari template**.

---

## 1. Problem Statement

### Kenapa M1–M7 Tidak Memuaskan
Pendekatan lama:
- Override `adminlte::page` → shell baru, TAPI isi blade TETAP markup AdminLTE.
- `x-adminlte-*` komponen tetap dipakai di blade.
- `compat-bs4.css` hanya *menambal* kelas, tidak membuat UI asli.
- Hasil: **halaman campuran** — sidebar/topbar baru tapi tabel/card/form masih gaya AdminLTE→tidak nyambung & tidak rapi.

### Solusi Baru
**Hapus total UI lama (AdminLTE) & rebuild setiap halaman langsung dari template**
`template_to_use/` (Bootstrap 5.3, tema orange Anthropic), dengan data real dari controller.
**Data yang ditampilkan HARUS SAMA PERSIS** — hanya tampilan & penyusunan yang disesuaikan.

---

## 2. Keputusan Hasil Grill-me v3 (9 Poin)

| # | Topik | Keputusan |
|---|---|---|
| Q1 | Strategi | **Template-Driven Page Mapping** — tiap halaman yang punya template di-copy strukturnya; halaman tanpa template dibangun dengan komponen reusable |
| Q2 | Menjamin data tetap | **Inventaris data dulu** (baseline field per halaman) + **diff-test permanen** (field yang muncul di blade lama wajib muncul di baru) |
| Q3 | Urutan eksekusi | **Bertahap per Fitur / milestone** — 1 fitur = 1 commit + test |
| Q4 | Layout | **Per role**: `layouts/guest.blade.php` (auth/publik, tanpa sidebar), `layouts/peserta.blade.php`, `layouts/admin.blade.php` |
| Q5 | Halaman tanpa template | **Komponen Reusable** (`x-card`, `x-table`, `x-input`, `x-select`, `x-file`, `x-textarea`, `x-button`, `x-alert`, `x-modal`) |
| Q6 | AdminLTE | **Ganti `@extends('adminlte::page')` bertahap**, hapus package AdminLTE di milestone TERAKHIR |
| Q7 | Fondasi | **Komponen & layout dibangun DULU (foundation)**, lalu rewrite halaman |
| Q8 | Scope | **Semua fitur + e-shop legacy** (`Barang`, `user_barang`, `shops`, `katagori`) |
| Q9 | Aset template | **Salin → `public/ui/`** (load `asset('ui/...')`, cache-bust `?v=N`) |

---

## 3. Non-Goals (tetap berlaku)

- ❌ **Merubah data yang ditampilkan** — data blade lama = data blade baru (Q2).
- ❌ Menambah fitur baru di luar yang sudah ada.
- ❌ Refactor PHP/controller/logika bisnis (hanya view).
- ❌ Migrasi JS jQuery → vanilla (di luar scope; jQuery tetap dipakai bila blade pakai `$()`).

---

## 4. Arsitektur Target

### 4.1 Aset
```
public/ui/
  ├── css/{base,components,pages,theme-public,compat-bs4}.css   (dari template_to_use/css)
  ├── js/{sidebar,ui,app,shim}.js                                (dari template_to_use/js)
  └── img/{logo,favicon,apple-touch-icon}.png                    (dari template_to_use/)
```
- Bootstrap 5.3 (CDN), jQuery 3.7 (CDN), FontAwesome 6 (CDN) dimuat di layout.
- `template_to_use/` TETAP di source sebagai referensi desain (tidak di-deploy).

### 4.2 Layout (per role)
```
resources/views/layouts/
  ├── guest.blade.php      → auth & publik (tanpa sidebar). Dari login.html struktur.
  ├── peserta.blade.php    → sidebar peserta (menu: Peserta, Tender User, Sanggahan). Dari home.html structure.
  └── admin.blade.php      → sidebar admin (menu lengkap + Master + Pemeriksaan). Dari admin-dashboard.html.

Semua memuat: Bootstrap 5.3, jQuery 3.7, FontAwesome 6, public/ui/css/*, public/ui/js/*.
Section: title, content, css, js (+ stack).
Body class: ui-shell (marker), menyimpan role.
```

### 4.3 Komponen Reusable (foundation, dibuat duluan)
```
resources/views/components/
  ├── card.blade.php       → x-card (header/body/footer/actions)
  ├── table.blade.php      → x-table (head/body, empty state, pagination)
  ├── input.blade.php      → x-input (text/email/number/date/password)
  ├── select.blade.php     → x-select (options model/array)
  ├── file.blade.php       → x-file (upload)
  ├── textarea.blade.php   → x-textarea
  ├── button.blade.php     → x-button (variant/size/href/download)
  ├── alert.blade.php      → x-alert (type/dismissible)
  └── modal.blade.php      → x-modal (id/title/size/centered/scrollable/footer)
```

### 4.4 Alur Data (Q2)
- **Inventaris data** per halaman di `handoff/DATA_INVENTORY.md` (baseline).
- **Diff-test** (`tests/Feature/DataPreservationTest.php`) memastikan field data blade lama
  muncul di blade baru. Test permanen.

---

## 5. Milestone (masing-masing 1 commit, bertahap per fitur)

> Urutan mengikuti alur pengguna. Setiap milestone: inventaris data → rewrite → diff-test → commit.

### F0 — Foundation (Komponen + Layout)
- [ ] Salin aset template → `public/ui/` (cache-bust `?v=1`).
- [ ] Buat 3 layout: `layouts/{guest,peserta,admin}.blade.php`.
- [ ] Buat 9 komponen reusable (`x-card/table/input/select/file/textarea/button/alert/modal`).
- [ ] Buat `handoff/DATA_INVENTORY.md` template + baris uji.
- **Accept**: layout & komponen render via route test `/ui-preview`; `php artisan test` hijau.

### F1 — Auth (guest layout)
- [ ] Rewrite `auth/login`, `auth/register`, `auth/verify`, `auth/passwords/*` dari `login.html`/`register.html`.
- [ ] Inventaris data: CSRF, errors, remember, old().
- **Accept**: login/register/verify render 200; test hijau; diff-test.

### F2 — Publik & Beranda Peserta (guest/peserta layout)
- [ ] `public-tenders` (tanpa login) dari `public-tenders.html`.
- [ ] `home.html` (beranda peserta) → `tender_user.home.home`.
- [ ] `tender-detail.html` → `tender_user.home.show` (detail + zona pendaftaran/upload).
- **Accept**: semua render 200; test hijau; diff-test.

### F3 — Registrasi & Upload Peserta (peserta layout)
- [ ] `peserta-registrasi.html` → `peserta.*` (profil peserta).
- [ ] `penawaran-upload.html` → `penawaran_file.*` (upload penawaran).
- **Accept**: form registrasi & upload render 200; test hijau; diff-test.

### F4 — Admin: Kelola Tender (admin layout)
- [ ] `tender-admin-index.html` → `tender_admin.index`.
- [ ] `tender-admin-form.html` → `tender_admin.create/edit`.
- [ ] `tender-admin-tahapan.html` → `tender_admin.tahapan.*`.
- [ ] `admin-dashboard.html` → `dashboard.index`.
- [ ] `admin-pemeriksaan.html` → `dashboard.peserta.show`.
- **Accept**: semua render 200; test hijau; diff-test.

### F5 — Master Data & Halaman Lain (admin, komponen reusable)
- [ ] `jenis_kontrak`, `jenis_pengadaan`, `metode_pengadaan`, `status_tender`, `tahapan`, `katagori`, `perubahan`.
- [ ] Sanggahan, komentar, penilaian, pemeriksaan detail.
- [ ] E-shop legacy: `Barang`, `user_barang`, `shops`.
- **Accept**: semua render 200; test hijau; diff-test.

### F6 — Pembersihan AdminLTE + Verifikasi Final
- [ ] Hapus semua `@extends('adminlte::page')` → ganti `@extends('layouts.*')`.
- [ ] Hapus `x-adminlte-*` yang tersisa di blade.
- [ ] Hapus package `jeroennoten/laravel-adminlte` dari composer.
- [ ] Hapus aset `public/vendor/adminlte`, `public/vendor/bootstrap` dll (bila tak dipakai).
- [ ] `php artisan test` → semua hijau (termasuk DataPreservationTest).
- [ ] Smoke curl semua route → 200 + marker `ui-shell`.
- [ ] Update `handoff/HANDOFF.md`.
- **Accept**: semua checklist PASS; branch `update-ui-2` di-push.

---

## 6. Prinsip "Data Tidak Berkurang" (Q2 — PENTING)

- **Inventaris**: buat daftar semua variabel/field yang dirender tiap halaman (`$data->nama`, `$data->hps`, loop `$data->tahapan`, dsb).
- **Rewrite**: SETIAP `{{ }}` / `{!! !!}` / loop yang menampilkan data WAJIB dipertahankan. Hanya tag HTML & class di sekitar yang boleh berubah.
- **Diff-test**: `DataPreservationTest` memeriksa bahwa token data dari blade lama muncul di blade baru. Test dijalankan tiap milestone.

---

## 7. Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Data berkurang saat rewrite | Inventaris (A) + diff-test (C) per milestone |
| AdminLTE masih terpakai di tengah | Ganti `@extends` bertahap; hapus package hanya di F6 |
| Halaman kompleks tanpa template | Komponen reusable + konsistensi |
| jQuery/JS lama gagal | jQuery 3.7 dimuat global; shim untuk data-toggle |
| Script blade `$()` hilang | jQuery tetap dimuat di semua layout |
| Regresi fungsional | `php artisan test` tiap milestone |
| Effort besar | Bertahap per fitur, commit per milestone |

---

## 8. Definisi Selesai (DoD)

- [ ] F0–F6 selesai & acceptance terpenuhi.
- [ ] Semua data blade lama muncul di blade baru (diff-test PASS).
- [ ] Zero `@extends('adminlte::page')` tersisa.
- [ ] Zero `x-adminlte-*` tersisa di blade.
- [ ] Package `jeroennoten/laravel-adminlte` dihapus.
- [ ] Semua halaman render 200 + marker `ui-shell`.
- [ ] `php artisan test` hijau.
- [ ] `handoff/HANDOFF.md` & PRD ini diperbarui.
- [ ] Branch `update-ui-2` di-push dengan commit per milestone.

---

*Dokumen disusun dari sesi grill-me ke-3. Revisi berikutnya = pembaruan status milestone F0–F6.*
