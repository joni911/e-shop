# PRD — Migrasi UI: `template_to_use` sebagai Shell Baru (Branch `update-ui`)

> Dokumen hasil sesi grill-me (interview keputusan 1-per-1) bersama pemilik proyek.
> Berlaku untuk branch `update-ui` yang dibuat dari `testing/laravel-12-upgrade`.

---

## 1. Tujuan

Mengganti **kulit/tampilan (shell)** seluruh aplikasi pengadaan dari AdminLTE ke UI baru berbasis
`template_to_use/` (Bootstrap 5.3, tema orange Anthropic), **tanpa mengubah isi/logika blade lama**.
Hasil akhir: semua halaman tampil dengan UI baru, fitur lama tetap berfungsi, dan rollback mudah.

## 2. Non-Goals (di luar lingkup)

- ❌ Merombak isi/konten tiap blade (konten tetap seperti sekarang).
- ❌ Menghapus package AdminLTE dari composer (lihat keputusan Q9).
- ❌ Melakukan refactor script jQuery ke vanilla JS (fase terpisah, opsional).
- ❌ Tampilan publik "tanpa login" (`public-tenders.html` orange theme) — bukan bagian shell app?

  > *Catatan terbuka: template punya halaman publik tanpa login. Diputuskan tidak termasuk M1–M7;
  > dievaluasi sebagai fase terpisah.*

## 3. Keputusan Hasil Grill-me (13 poin)

| # | Topik | Keputusan |
|---|---|---|
| Q1 | Lokasi aset | Salin `template_to_use/*` → `public/ui/`, load via `asset()`; Bootstrap 5 tetap CDN, siap fallback lokal |
| Q2 | Versi Bootstrap | Migrasi **penuh ke Bootstrap 5.3** (satu-satunya framework) |
| Q3 | Modal | Komponen baru `x-modal` (Boot5) + **shim JS** untuk pemicu `data-toggle`/`data-target`/`data-dismiss`; **setiap modal = 1 blade partial** (folder `partials/modals/`), tidak ada blok modal inline besar |
| Q4 | Komponen lain | **Audit per jenis**: pasif HTML (`x-adminlte-button/alert/card`) tetap pakai package; yang bawa plugin JS (`text-editor`, `datatable`, `input-date`, `select2`) diganti komponen Boot5 baru |
| Q5 | jQuery | **jQuery 3.7 dimuat global** di shell (30+ blade pakai `$()`) |
| Q6 | Mekanisme swap layout | **Override vendor `adminlte::page`** (`resources/views/vendor/adminlte/page.blade.php` = shell baru). 77 blade TANPA edit; rollback = hapus 1 file |
| Q7 | Auth | `resources/views/auth/*` (login, register, verify, passwords×3) **ditulis ulang dari `login.html`/`register.html`** |
| Q8 | Menu | Sumber menu tetap `AppServiceProvider` (role-based: admin penuh / user-peserta terbatas), output markup disesuaikan struktur shell baru |
| Q9 | Package AdminLTE | **Tetap terpasang** (komponen yang dipertahankan; CSS/JS AdminLTE tidak pernah dimuat shell baru) |
| Q10 | Ikon | **FontAwesome 6 CDN dimuat di shell** (blade lama `fas fa-*` tetap jalan) |
| Q11 | Kelas BS4 | **Compat CSS layer** (`public/ui/css/compat-bs4.css`) memetakan kelas BS4 → BS5 untuk **44 file** (`ml-*`→`ms-*`, `float-right`→`float-end`, `form-inline`, dll) |
| Q12 | Verifikasi | **Berlapis**: `php artisan test` hijau → smoke curl (marker shell + 200) → checklist visual manual user |
| Q13 | PRD & commit | PRD di `handoff/PRD_UI_MIGRATION.md`; eksekusi **per milestone (1 commit per milestone)** di branch `update-ui` |

## 4. Arsitektur Target

```
Layout (override vendor):
  resources/views/vendor/adminlte/page.blade.php  → shell baru (Bootstrap 5)
    + memuat: public/ui/css/{base,components,pages,theme-public?}.css
              public/ui/css/compat-bs4.css
              Bootstrap 5.3 (CDN/lokal), jQuery 3.7, FontAwesome 6
              public/ui/js/{sidebar,ui,app,shim}.js
    + section tetap kompatibel: title, content_header, content, css, js

Komponen baru (folder "fix"):
  resources/views/components/modal.blade.php        → x-modal (Boot5)
  resources/views/partials/modals/*.blade.php        → 1 modal = 1 partial (32 pemakaian dipindah)
  resources/views/components/{text-editor,datatable,input-date,select2}.blade.php → pengganti plugin JS

Auth baru:
  resources/views/auth/{login,register,verify}.blade.php + passwords/{email,reset,confirm}.blade.php

Asset:
  public/ui/css/*.css, public/ui/js/*.js, public/ui/img/*.png   (dari template_to_use, disalin + cache-bust ?v=)
  demo data/*.json & fitur demo TIDAK dipakai produksi
```

## 5. Milestone & Acceptance (masing-masing 1 commit)

### M1 — Aset & Shell Layout
- [x] Salin `template_to_use/css,js,img` → `public/ui/` (cache-bust `?v=1`); EXCLUDE demo `data/*.json` dari pemakaian produksi.
- [x] Buat `resources/views/vendor/adminlte/page.blade.php` = shell baru: sidebar + topbar + `@yield/section` kompatibel (`title`,`content_header`,`content`,`css`,`js`).
- [x] Load: Bootstrap 5.3, jQuery 3.7, FontAwesome 6, CSS template + compat (M4), JS template (M4).
- **Accept**: `/` redirect login; login halaman render shell (belum rapi penuh), curl `tender_admin` (admin) mengembalikan 200 + marker `class="ui-shell"`; `php artisan test` hijau. ✅ PASS

### M2 — Auth Pages
- [x] Tulis ulang `auth/login`, `auth/register` dari `login.html`/`register.html` (Boot5 + tema orange).
- [x] `auth/verify`, `passwords/email|reset|confirm` senada.
- [x] Route Auth::routes() tidak berubah; hook CSRF/errors tetap.
- **Accept**: login sukses (curl dengan CSRF), register sukses, verify/password page render 200; test hijau. ✅ PASS

### M3 — Modal & Komponen Plugin
- [x] Komponen `resources/views/components/modal.blade.php` (`x-modal`) — markup Boot5, slot: default, footer.
- [x] **DEViasi**: `x-adminlte-modal` (16 pemakaian/13 file) TIDAK dipindah ke `partials/modals/*` — diganti override view `resources/views/vendor/adminlte/components/tool/modal.blade.php` (Boot5). Alasan: 0-edit pada 13 blade, zero-risk, tetap memenuhi accept. File lama tetap inline (bukan 1-modal-1-partial).
- [x] Komponen pengganti plugin JS: text-editor (→ textarea Boot5), datatable (→ tabel Boot5) — override view vendor. `input-date` & `select2` 0 pemakaian → tidak perlu.
- **Accept**: halaman ber-modal (mis. `tender_user/peserta/admin/file.blade.php`) render Boot5 modal; tombol buka/tutup modal jalan (dengan shim M4); test hijau. ✅ PASS

### M4 — Shim JS & Compat CSS
- [x] `public/ui/js/shim.js`: konversi otomatis `data-toggle="modal"`→`data-bs-toggle`, `data-target`→`data-bs-target`, `data-dismiss`→`data-bs-dismiss`; init modal Boot5.
- [x] `public/ui/css/compat-bs4.css`: map kelas BS4→BS5 untuk 44 file (`ml-*`, `mr-*`, `float-right`, `form-inline`, `text-left/right`, `pull-*`) + warna tema modal (bg-teal dll).
- **Accept**: halaman yang memakai modal trigger lama bisa buka/tutup; tata letak halaman yang pakai kelas BS4 tidak berantakan. ✅ PASS

### M5 — Menu Sidebar
- [x] Susun markup menu shell (sidebar template) dari output `AppServiceProvider`.
- [x] Menu role-based tetap: admin = penuh (Tender, Master, Pemeriksaan), user/peserta = terbatas (Peserta, Tender User, Sanggahan).
- [x] Navbar: user dropdown (profil/logout), active-link, overlay mobile (`sidebar.js`).
- **Accept**: login sebagai `admin@pbj.go.id` vs `peserta1@...` → sidebar berbeda sesuai role; menu klik menuju route benar. ✅ PASS

### M6 — Komponen maintenance & penyempurnaan
- [x] Verifikasi komponen pasif (`x-adminlte-button/alert/card`) tetap tampil benar di tema baru.
- [x] `x-adminlte-button` pemicu modal tetap berfungsi via shim.
- [x] Touch-up styling yang tersisa (form, tabel, alert) agar konsisten tema.
- **Accept**: halaman utama (home, tender detail, admin index, dashboard) tampil konsisten; tidak ada elemen rusak terlihat. ✅ PASS

### M7 — Verifikasi Final
- [x] `php artisan test` → 23+ test hijau.
- [x] Smoke curl: `/` , `/login`, `/home` (user), `/tender_admin` (admin) → 200 + marker shell.
- [ ] Checklist visual manual user (daftar URL + akun disediakan) — menunggu user.
- [x] Update `handoff/HANDOFF.md` status migrasi.
- **Accept**: semua item checklist PASS; PRD update status. ⏳ checklist visual user menunggu.

## 6. Verifikasi & Checklist Visual (untuk user)

Setelah M7, berikan ke user untuk dicek di browser lokal (akun: `admin@pbj.go.id` / `peserta1@maju-jaya.co.id`, password `password`):
1. `http://127.0.0.1:8000/login` → halaman login tema baru.
2. Login admin → sidebar menu penuh, home tender.
3. `/tender_admin` → tabel + tombol modal hapus/tambah berfungsi.
4. `/tender_home` + detail tender → zona pendaftaran/upload.
5. `/peserta/create` (sebagai peserta) → form registrasi profil.
6. Halaman modal (mis. `tender_user/peserta/admin/file.blade.php`) → modal buka/tutup OK.
7. Responsif mobile (sidebar overlay).

## 7. Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Konflik CSS BS4/BS5 | Compat CSS (M4) + tidak load CSS AdminLTE (Q9) |
| Modal Boot4 tidak terbuka di Boot5 | Shim JS (M4) + komponen x-modal (M3) |
| Script jQuery lama gagal tanpa jQuery | jQuery 3.7 dimuat global (Q5) |
| 77 blade rusak karena layout baru | Override vendor (Q6) — section tetap kompatibel |
| Ikon hilang | FontAwesome 6 (Q10) |
| Regresi fungsional | `php artisan test` tiap milestone (M-accept) |
| Rollback | Commit per milestone; shell = hapus 1 file override; auth/modal = revert commit |

## 8. Definisi Selesai (DoD)

- [ ] Semua M1–M7 selesai & acceptance terpenuhi.
- [ ] 23 test hijau + smoke curl PASS.
- [ ] Checklist visual user di atas PASS.
- [ ] `handoff/HANDOFF.md` & PRD ini diperbarui.
- [ ] Branch `update-ui` di-push dengan commit per milestone.

---

*Dokumen disusun dari sesi grill-me 30/08. Revisi berikutnya = pembaruan status milestone.*