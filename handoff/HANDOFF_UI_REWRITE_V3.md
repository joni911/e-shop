# HANDOFF — UI Rewrite v3 (Branch `update-ui-2`)

> Dokumen untuk melanjutkan pekerjaan besok.
> **Branch aktif**: `update-ui-2` (dibuat dari `7e1dc57` = snapshot bersih sebelum migrasi UI).
> **PRD acuan**: `handoff/PRD_UI_REWRITE_v3.md`.
> **Status**: Migrasi UI **BERJALAN** — F0–F4 (semua) selesai. F5 + F6 belum.

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
| **F4** sisa (dashboard/show & tahapan) | ✅ SELESAI | `dashboard/peserta/show` (Daftar Peserta Tender, layout admin, data kelengkapan + penawaran currency) + `tender_admin/tahapan` (Atur Tahapan dari template: alert info + tabel badge status + form tambah; aksi Edit/Hapus dipertahankan) + `AdminF4SisaTest` |
| **F5** Master data + e-shop | ✅ (bagian fungsional) | `tahapan` ✅, `jenis_kontrak` ✅, `jenis_pengadaan` ✅, `metode_pengadaan` ✅, `status_tender` ✅ (+fix route update), `katagori` ✅, `Barang` (admin e-shop) ✅. Bukan fungsional (controller kosong): `perubahan` create/edit, `shops`/`user_barang` |
| **F6** Cleanup AdminLTE | ⏳ BELUM | Hapus semua `@extends('adminlte::page')`, `x-adminlte-*`, package AdminLTE, aset vendor |

**Test**: `php artisan test` → **67 passed / 287 assertions** (sqlite :memory:).

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

### 4.6 Bug route master `status_tender` edit
- View lama pakai `route('status_tender_admin.update')` — **route tidak terdaftar** → submit edit pasti 404.
- Sudah diganti `route('status_tender.update', [$data->id])` (route resource asli).

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

### F4 sisa ✅ (sudah dikerjakan)
- `dashboard/peserta/show` → layout admin + x-card/x-table, semua field kelengkapan (email/NPWP/alamat/no_hp/managemen/user_id/tender_id) + penawaran `@currency` + aksi Lihat File + pagination
- `tender_admin/tahapan/create` → dari template `tender-admin-tahapan.html`: alert info tender, tabel (badge status 0-4, keterangan + link Periksa Perubahan, aksi Edit/Hapus), form tambah (x-input/x-select, submit `tahapan.store`)
- Part lama `dashboard/peserta/part/{admintable,table}.blade.php` jadi tidak terpakai (bisa dirapikan saat F6)

### F5 Master data & e-shop — SELESAI (bagian fungsional)
✅ **Sudah di-rewrite ke layout admin + komponen** (`x-card`/`x-table`/`x-input`/`x-select`/`x-textarea`):
- `jenis_kontrak`, `jenis_pengadaan`, `metode_pengadaan`, `status_tender` (index/create/edit; field `nama` saja) — pola seragam
- `katagori` (index/create; field `nama` + `keterangan`; variable `$katagori` collection)
- `Barang` e-shop admin (index/create/edit/show): index bersihkan markup dummy e-shop → tabel data asli (Nama link show, Jumlah, Aksi Edit+Foto); form nama/katagori/harga/jumlah/keterangan/deskripsi; show galeri foto + info + deskripsi + komentar
- Part lama (`part/form`, `part/table`, `part/alert`) jadi orphan (rapikan saat F6)
⏳ **Tidak bisa di-rewrite (controller kosong / tidak berfungsi)**:
- `perubahan` create/edit — `PerubahanController@create()/edit()` KOSONG (render blank 200, tidak ada view aktif); butuh implementasi controller dulu
- `shops`/`user_barang` — `shops/index.blade.php` kosong (hanya @extends), `user_barang/index` render widget dummy `Barang.part.table`; `UserBarangController@show/add` kosong. Storefront e-shop non-fungsional — rewrite = menambah fitur (di luar PRD non-goal). Konfirmasi ke pemilik sebelum dikerjakan.

### F5 EXTRA — halaman berkas peserta `peserta.file` ✅
- **`peserta.file`** (`peserta/{id}/file_tender/{pid}` → `tender_user/peserta/files/show`) — rewrite ke layout DINAMIS (admin→layouts.admin, peserta→layouts.peserta): card data peserta (perusahaan/user/email/alamat/no_hp/peringkat+nilai/file), status kesimpulan pemeriksaan (x-alert info/danger/success + tombol Edit), card penawaran, tab BS5 (Kualifikasi/Administrasi/Teknis/Harga/Penilaian)
- Partial `admin/file*` & tabel (pengalaman/pekerjaan_berjalan/tenaga_ahli/peralatan) di-rewrite: semua `x-adminlte-modal` → partial baru `files/part/preview` (x-modal custom preview img/pdf/arsip + tombol Download + Tutup) — id modal unik per-record
- Fix null-safety: `$pp` (penawaran_peserta) bisa null → `(($pp->penawaran ?? 0))` — parens PENTING: `(float) $pp->x ?? 0` tetap error (precedence cast > null-coalesce)
- `peserta/2/file_tender/1` (dan sembarang pid/tid) render 200 + ui-shell, zero x-adminlte

### F5 EXTRA 2 — edit peserta & sanggahan ✅
- **`peserta.edit`** (`/peserta/{id}/edit` → `tender_user/peserta/edit`) — rewrite ke layout dinamis per role + komponen; form SELF-CONTAINED (tidak lagi include `part/form`): Identitas Perusahaan, Izin, Akta, Akta Perubahan, Bukti KSWP, Data Perusahaan, File Pendukung (x-file per tender_file_detail + link download existing). Submit PUT `/peserta/{id}`; tombol Berikutnya → `administrasi_list.show`. `part/form` masih dipakai create/dashboard (belum di-rewrite).
- **`sanggahan.index`** (`/sanggahan` → `dashboard/sanggahan/index`) — rewrite layout dinamis + x-card/x-table (No/Nama/Aksi Sanggahan) + pagination.
- **`sanggahan.show`** (`dashboard/sanggahan/pengumuman`) — rewrite: modal Berita Acara (iframe Google Drive) via x-modal, jika sudah ada sanggah → tampil keterangan {!! !!} + modal file + tombol hapus (confirm); jika belum → form store (textarea keterangan + x-file + hidden peserta/tender). Catatan: editor rich-text Summernote diganti textarea biasa (fungsi kirim tetap sama, tanpa toolbar).
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
| `tender-admin-tahapan.html` | Tahapan | `tender_admin.tahapan` ✅ |
| `admin-dashboard.html` | Dashboard | `dashboard.index` ✅ (belum pakai stats card template) |
| `admin-pemeriksaan.html` | Pemeriksaan | `dashboard.peserta.show` ✅ (daftar peserta; template checklist per-peserta belum dipakai — belum ada route form pemeriksaan) |
| `public-tenders.html` | Publik | (belum ada route/controller) |

---

## 10. TEST SUITE (49 hijau)
- `UiFoundationTest` (4) — layout & komponen
- `AuthRewriteTest` (5) — auth
- `PublicTenderRewriteTest` (7) — beranda/detail + perubahan
- `RegistrasiUploadTest` (2) — registrasi/upload
- `PenawaranPesertaTest` (7) — upload + guard zona
- `AdminRewriteTest` (6) — kelola tender + menu role
- `AdminF4SisaTest` (4) — atur tahapan (render + store) + daftar peserta
- `TahapanMasterTest` (3) — master tahapan index/create (regression crash)/edit
- `MasterDataRewriteTest` (6) — 4 master index/create/edit + status_tender fix route update + katagori store + Barang CRUD render
- `PesertaFileRewriteTest` (2) — halaman berkas peserta (admin + peserta) render shell + tabs + zero x-adminlte
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
1. **Form admin**: pastikan relasi `jenis_pengadaan`/`metode`/`status_tender` menampilkan nama benar (sudah fix belongsTo).
2. **e-shop legacy** (`Barang`/`shops`/`user_barang`) — `Barang` admin sudah di-rewrite; `shops`/`user_barang` storefront **non-fungsional** (controller & view kosong) — perlu keputusan pemilik: diimplementasikan atau dihapus.
3. **`perubahan` create/edit** — `PerubahanController@create()/edit()` kosong; kalau fitur benar-benar dipakai, implementasikan form (tahapan_id + nama) — perlu konfirmasi.
3. **Router `/`** masih `redirect()->route('login')` — OK.
4. **`@php` di loop** — ingat pakai `<?php ?>` bila error blade.
5. **Part lama** `dashboard/peserta/part/*` sekarang orphan (tidak di-include) — hapus saat F6 bila aman.
6. **`tender_admin/tahapan/tahapan.blade.php`** (dipakai `TahapanController@show` → `/tahapan/{id}`) masih AdminLTE — masuk scope F5 master.

## 15. CEK FUNGSI EMAIL (2026-08-29) — BERMASALAH
- **Gejala**: `Mail::raw()` / `hasil_penilaian` / `EmailNotification` → `535 Authentication credentials invalid`.
- **Akar**: API key Resend di `.env` (`MAIL_PASSWORD=sk-...`) **TIDAK VALID** — verifikasi langsung `GET api.resend.com/api-keys` → `"API key is invalid"`. Perlu key baru dari pemilik (format `re_...`), lalu set `MAIL_PASSWORD`.
- **Fix yang sudah dilakukan**: `MAIL_ENCRYPTION` `tls` → `ssl` (port 465 = SMTP-SSL; `tls`/STARTTLS salah untuk port 465).
- **Alur email yang dipakai (semua kode OK)**: `RegisterController` (EmailNotification), `DaftarPesertaController` (NotifikasiDaftarTender), `PemeriksaanController@send` (hasil Lulus/Tidak), `PesertaController@send_hasil` (hasil_penilaian markdown), `komentarController`/`TenderKomenController`, `StatusTenderController@send` (test).
- **Langkah**: minta pemilik key Resend baru → set `.env` → verifikasi `Mail::raw` via tinker.

---

## 14. REFERENSI FILE
- `handoff/PRD_UI_REWRITE_v3.md` — PRD & milestone (baca dulu).
- `handoff/PRD_UI_MIGRATION.md` — PRD lama (M1–M7, ditolak).
- `template_to_use/README.md` — deskripsi design system & tiap template.
- `TESTING_README.md`, `ALUR_PENGADAAN.md` — alur bisnis & testing.

---

*Sesi UI rewrite v3 selesai sampai F4 (semua). Lanjut besok: F5 → F6 (cleanup AdminLTE). Semua keputusan & patch penting sudah didokumentasikan di atas.*
