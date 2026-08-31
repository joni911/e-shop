# Report — Uji Alur Pembuatan Tender (UI/UX & Fungsi)

> Tanggal: 31-08-2026 · Branch: `update-ui-2-fix-kode` · Pengujian manual via HTTP (login admin)
> Tender uji: **"Tender Uji UI Test 2026"** (ID 6) — dibuat utuh sampai tahap penawaran.

---

## Ringkasan Eksekutif

| Aspek | Hasil |
|---|---|
| Halaman alur awal (index → create → edit → tahapan) | ✅ Layout **BARU** (`ui-shell`, konsisten template) |
| Halaman alur akhir (syarat → file → persyaratan → penawaran) | ⚠️ Layout **LEGACY** (`adminlte::page`) |
| Fungsi store/update | 🐛 2 bug fungsional ditemukan & **sudah diperbaiki** |
| Test suite | ✅ 80 passed (340 assertions) |

---

## Tahap 1 — Daftar Tender (`GET /tender_admin`)

**Layout**: ✅ Baru (`ui-shell`, `table-wrap`)
**UI/UX**: `x-card` + `x-table` + tombol "Tambah Tender" + search client-side (`data-table-search`).
**Konsistensi**: Sejalan dengan template.
**Fungsi**: OK.
**Catatan**: Kolom `paket` ditampilkan sebagai sub-judul (`$b->paket ?? ''`) — tapi form tidak punya input `paket` (lihat Tahap 2).

---

## Tahap 2 — Form Tambah Tender (`GET /tender_admin/create`)

**Layout**: ✅ Baru
**UI/UX**: Form 12 field via `x-input` / `x-select`. Select memakai `optionLabel=nama` — semua master (jenis_kontrak, jenis_pengadaan, metode_pengadaan, status_tender) punya kolom `nama` → berfungsi.
**Konsistensi**: Sejalan dengan template.

**Kelemahan UI/UX**:
1. Hanya 2 field yang punya atribut `required` di HTML (`nama` + select jk/jp/mp), padahal server mewajibkan **12 field** → user bisa submit, browser tidak blokir, lalu dapat error server.
2. `nilai` & `hps` type=number **tanpa `min`** → bisa diisi 0/negatif (server juga tidak validasi `min`).
3. `enctype="multipart/form-data"` padahal tidak ada upload file (tidak berbahaya, hanya tidak perlu).

**Fungsi store — 🐛 BUG DITEMUKAN**:
- **Bug #1**: `tenderController::store` tidak mengisi kolom `paket` (NOT NULL, tanpa default di DB) → **error 500** `Field 'paket' doesn't have a default value`.
- Akar masalah: migration `2022_03_20_141055_drop_paket` di `up()` **tidak menghapus** kolom `paket` (hanya menambah `nilai_pagu` & `hps`), jadi kolom `paket` masih ada di DB.
- **Perbaikan**: `store()` & `update()` kini mengisi `$data->paket = $request->nama`.
- ✅ Setelah diperbaiki: POST `/tender_admin` → 302 ke index, data tersimpan (ID 6).

---

## Tahap 3 — Edit Tender (`GET /tender_admin/6/edit` + PUT)

**Layout**: ✅ Baru
**UI/UX**: Prefill benar (`value="Tender Uji UI Test 2026"`, `nilai=500000000`, `hps=450000000`).
**Konsistensi**: Sejalan.
**Fungsi**: `update()` memakai `tenderRequest` yang sama + perbaikan `paket` → OK (302 ke `tender_admin.tahapan`).

---

## Tahap 4 — Atur Tahapan (`GET /tender_admin/tahapan/6` + POST `/tahapan`)

**Layout**: ✅ Baru
**UI/UX**: Alert info "minimal 1 tahapan Masa Pendaftaran + 1 Upload File", tabel daftar tahapan + badge status warna, form tambah tahapan dengan `x-select` status.
**Konsistensi**: Sejalan dengan template.
**Fungsi**: POST tahapan (status 1 = Masa Pendaftaran, status 4 = Upload File) → 302, tersimpan & tampil dengan badge `badge-primary` / `badge-warning` yang benar.

**Catatan**: Peringatan "minimal tahapan" hanya teks — tidak ada validasi otomatis bahwa tender harus punya tahapan sebelum dipublikasikan.

---

## Tahap 5 — Atur Syarat (`GET /tender_admin/syarat/6` + POST `/syarat`)

**Layout**: ⚠️ **LEGACY** — `adminlte::page`, `x-adminlte-text-editor` (Summernote), `card card-primary`, `btn btn-primary` polos.
**Konsistensi**: ❌ Tidak sejalan dengan template baru (halaman lain sudah `ui-shell`).
**Fungsi store — 🐛 BUG DITEMUKAN**:
- **Bug #2**: `syarats` punya kolom `izin` & `usaha` (NOT NULL, tanpa default) tapi `SyaratController::store` tidak mengisinya → **error 500** `Field 'izin' doesn't have a default value`.
- **Perbaikan**: `store()` & `update()` kini mengisi `izin` (default dari nama) & `usaha`.
- ✅ Setelah diperbaiki: POST `/syarat` → 302, data "Persyaratan Umum" tampil di tabel.
- **Catatan**: Form tidak punya input untuk `izin`/`usaha` — perlu ditambahkan saat halaman di-rewrite ke layout baru.

---

## Tahap 6 — Atur File Tender (`GET /tender_file/6` + POST `/tender_file`)

**Layout**: ⚠️ **LEGACY** (`adminlte::page`)
**Konsistensi**: ❌ Tidak sejalan.
**Fungsi**: `TenderFileController::store` → 302, file "Surat Penawaran" tampil di tabel. OK.
**Catatan**: Tombol "Selesai" → `tender_persyarat.show`. Tidak ada validasi FormRequest (pakai `Request` polos).

---

## Tahap 7 — Persyaratan & File Persyaratan (`GET /tender_persyarat/6` + POST `/tender_persyarat`)

**Layout**: ⚠️ **LEGACY** (`adminlte::page`, Summernote)
**Konsistensi**: ❌ Tidak sejalan.
**Fungsi**: `TenderPersyaratanController::store` → 302, judul "Spesifikasi Teknis" tampil. File persyaratan (upload via `tender_persyaratan_file.store`) masih memakai `$tmp_file->move()` legacy — **belum** pakai `FileUploadService`.
**Catatan**: Tombol "Selesai" → `penawaran.show`.

---

## Tahap 8 — Persiapan Penawaran (`GET /penawaran/6` + POST `/penawaran`)

**Layout**: ⚠️ **LEGACY** (`adminlte::page`)
**Konsistensi**: ❌ Tidak sejalan.
**Fungsi**: `PenawaranController::store` → 302, record penawaran tersimpan (ID 3). OK.
**Catatan**: Form `penawaran_file` (tambah file wajib) memakai `store` sederhana; halaman `/penawaran_file/{id}` (sisi peserta) **sudah** pakai layout baru (`layouts.app`) — hasil kerjaan sebelumnya.

---

## Temuan Khusus UI/UX yang Tidak Sejalan Template

1. **4 halaman legacy** (syarat, file tender, persyaratan, penawaran) masih `adminlte::page` + Summernote → perlu di-rewrite ke `layouts.admin` + komponen `x-*`.
2. **Missing required di blade** (Tahap 2) — blade hanya mewajibkan 4 field, server 12.
3. **Tidak ada validasi `min` untuk nilai/HPS** — nilai 0/negatif bisa masuk.
4. **Input `paket` tidak ada di form** tapi kolom wajib — sekarang diisi otomatis dari `nama`.
5. **Upload file persyaratan** (`tender_persyaratan_file`) masih pakai `move()` manual — belum best-practice.

## Fungsi yang Tidak Berfungsi (ditemukan & diperbaiki)

| # | Halaman | Error | Akar Masalah | Status |
|---|---|---|---|---|
| 1 | Create/Edit Tender | 500 `Field 'paket' doesn't have a default value` | Migration `drop_paket` tidak benar-benar drop kolom; controller tidak isi `paket` | ✅ Diperbaiki |
| 2 | Atur Syarat | 500 `Field 'izin' doesn't have a default value` | Kolom `izin`/`usaha` wajib, controller tidak isi | ✅ Diperbaiki |

## Rekomendasi Lanjutan (belum dikerjakan — di luar scope pengujian ini)
- Rewrite 4 halaman legacy ke template baru.
- Tambahkan validasi `numeric|min:1` untuk `nilai`/`hps` di `tenderRequest`.
- Tambahkan input `paket`/`izin`/`usaha` ke form agar eksplisit.
- Tambahkan `exists` untuk foreign key (jk/jp/mp/status).
- Refactor `tender_persyaratan_file` ke `FileUploadService`.
- Validasi minimal tahapan (Masa Pendaftaran + Upload File) sebelum tender dipublikasikan.
