# PRD — Header Wizard "Langkah Pengaturan Tender" (konsisten di semua halaman setup tender)

- **Cabang:** `feat/tender-saya-hub`
- **Tanggal:** lihat commit (dokumen dibuat untuk pengerjaan lanjutan)
- **Status:** Rencana disetujui (belum seluruhnya dieksekusi; dieksekusi bertahap berikutnya)
- **Pelaku:** Developer (pi)

---

## 1. Latar belakang & masalah

Halaman pengaturan tender (admin) menampilkan baris langkah *wizard* "Langkah Pengaturan
Tender" yang **di-hardcode/duplikat inline** di tiap halaman. Akibatnya:

1. Tautan memakai **URL absolut** (mis. `http://127.0.0.1:8000/...`), sehingga:
   - rawan rusak saat domain berubah (dev → produksi);
   - jika definisi *route* berubah, semua tautan harus diedit manual;
   - rentan typo.
2. Header wizard **tidak tampil di semua halaman setup** (mis. halaman "Data Tender"
   `tender_admin/{id}/edit` tidak punya baris ini).
3. Duplikasi inline = potensi **tidak konsisten** antar halaman saat satu tautan berubah.

## 2. Tujuan

- Satu sumber (partial) untuk baris wizard 7 langkah setup tender.
- Muncul konsisten di **setiap** halaman setup dari langkah **Data Tender → Administrasi**.
- Langkah aktif ditampilkan sebagai **badge aktif (non-klik)**, langkah lain sebagai **tautan**.
- Semua URL memakai **`route()` dinamis** (best practice), bukan tautan absolut.

## 3. Non-lingkup (explicit out of scope)
- **TIDAK** menyentuh wizard peserta (langkah sisi peserta; misal badge Data Perusahaan → Peralatan).
- **TIDAK** mengubah isi konten/form setiap step (hanya navigasi header).
- **TIDAK** mengubah data/route lain di luar 7 langkah setup tender.

---

## 4. Kronologi/definisi langkah setup tender (nomor = indeks aktif)

| # | Label | Route yang dipakai untuk tautan |
|---|---|---|
| 1 | Data Tender | `tender_admin.edit` `{tender}` |
| 2 | Tahapan | `tender_admin.tahapan` `{tender}` |
| 3 | Syarat | `tender_admin.syarat` `{tender}` |
| 4 | File Tender | route show file tender per tender (cek nama aktual; umumnya `tender_file` show/`tender_file` dengan `{tender}`) |
| 5 | Persyaratan & Penawaran | `tender_persyarat.tender` `{tender}` |
| 6 | Penawaran | `penawaran.tender` `{tender}` |
| 7 | Administrasi | `administrasi.tender` `{tender}` |

> Keterangan: definisi route aktual per langkah dikonfirmasi saat implementasi di mana tiap
> halaman menampilkan baris yang benar. Ikon & label mengikuti yang ada sekarang.

---

## 5. Spesifikasi fungsional

### 5.1 Partial shared baru
Buat file:
`resources/views/tender_admin/part/tender-setup-steps.blade.php`

**Input (variabel blade):**
- `$tender` (objek Model `tender` / minimal `->id`) → dipakai sebagai param route `{tender}`.
- `$active` (int 1–7) → langkah yang sedang dibuka sebagai **badge aktif non-klik**.

**Cara kerja / output:**
- Mendefinisikan daftar `$steps` berisi: `label`, `icon`, dan `url` dihitung **via `route(...)`** (dinamis) memakai `$tender->id`.
- Looping 1..7:
  - jika `index === $active` → `<span class="badge badge-primary ...">` (info, tidak <a>);
  - jika tidak → `<a class="badge badge-default ..." href="{{ $url }}">` (teks + ikon).
- Area tidak pakai URL absolut. Tidak menampilkan tautan ke langkah yang belum ber-id bila `$tender` kosong (lihat 5.3).

Contoh bentuk HTML (setelah dirender) ialah seperti pada halaman `administrasi/tender/6` saat ini
namun URL-nya dibuat via `route()`.

### 5.2 Integrasi di banyak halaman (ganti duplikat inline)
Ganti blok inline "Langkah Pengaturan Tender" di halaman-halaman berikut dengan
`@include('tender_admin.part.tender-setup-steps', ['tender'=>$tender, 'active'=>X])`:

| Halaman/file | `$active` |
|---|---|
| `tender_admin/tahapan/create.blade.php` | 2 |
| `tender_admin/syarat/create.blade.php` | 3 |
| `tender_admin/files/create.blade.php` | 4 |
| `tender_admin/tender_syarat/create.blade.php` | 5 |
| `tender_admin/penawaran/create.blade.php` | 6 |
| `tender_user/peserta/administrasi/index.blade.php` | 7 |

Catatan:
- Setiap halaman perlu memiliki/melewati `$tender` ke include (pastikan controller/view sudah
  menyediakan objek tender; bila belum, tambahkan).
- Bila terdapat nama `route name` yang berbeda, dipetakan satu sumber di partial.

### 5.3 Halaman Data Tender (`tender_admin/{id}/edit`)
- Sisipkan partial di `tender_admin/edit.blade.php` dengan `$active = 1`.
- **Data Tender** tampil hanya sebagai **badge aktif non-klik** (sesuai keputusan #2 – informasi saja).
- Untuk halaman **create baru (tanpa id tender)**: partial TIDAK ditampilkan (belum ada `$tender`),
  atau alternatif hanya menampilkan teks "1. Data Tender (aktif)" tanpa tautan lain.

---

## 6. Implementasi (contoh penyusunan partial)

```blade
{{-- resources/views/tender_admin/part/tender-setup-steps.blade.php --}}
@php
    $steps = [ '1' => ['label'=>'Data Tender','icon'=>'fas fa-file-alt','url'=>route('tender_admin.edit',[$tender->id])],
               '2' => ['label'=>'Tahapan','icon'=>'fas fa-calendar-alt','url'=>route('tender_admin.tahapan',[$tender->id])],
               '3' => ['label'=>'Syarat','icon'=>'fas fa-list-check','url'=>route('tender_admin.syarat',[$tender->id])],
               '4' => ['label'=>'File Tender','icon'=>'fas fa-folder-open','url'=>//route file tender ...],
               '5' => ['label'=>'Persyaratan & Penawaran','icon'=>'fas fa-file-signature','url'=>route('tender_persyarat.tender',[$tender->id])],
               '6' => ['label'=>'Penawaran','icon'=>'fas fa-hand-holding-usd','url'=>route('penawaran.tender',[$tender->id])],
               '7' => ['label'=>'Administrasi','icon'=>'fas fa-clipboard-check','url'=>route('administrasi.tender',[$tender->id])],
             ];
    $active = $active ?? 1;
@endphp
@if(isset($tender) && $tender->id)
<div class="d-flex flex-wrap gap-2">
    @foreach($steps as $n => $s)
        @if((int)$n === (int)$active)
            <span class="badge badge-primary px-3 py-2">
                <i class="{{ $s['icon'] }}"></i> {{ $n }}. {{ $s['label'] }}
            </span>
        @else
            <a href="{{ $s['url'] }}" class="badge badge-default px-3 py-2 text-decoration-none">
                <i class="{{ $s['icon'] }}"></i> {{ $n }}. {{ $s['label'] }}
            </a>
        @endif
    @endforeach
</div>
@endif
```

---

## 7. Validasi / penerimaan

1. Semantic tidak berubah: baris wizard tampil di tahapan/syarat/file/persyaratan/penawaran/administrasi (sama seperti sebelumnya).
2. Halaman **Data Tender** (`tender_admin/6/edit`) kini menampilkan baris wizard dengan Data Tender sebagai **badge aktif non-klik**, langkah lain bisa diklik menuju URL benar.
3. Tidak ada URL absolut `http://127.0.0.1:...` di HTML hasil render header.
4. Tautan antar langkah benar bila domain berubah (pakai `route()`).
5. `php artisan view:cache` sukses; test Feature yang ada tetap hijau (86–87 test, plus test menyesuaikan bila ada snapshot yang mengecek string).

---

## 8. Backlog / langkah selanjutnya (restant)
- [ ] Buat partial `tender_setup-steps`.
- [ ] Ganti 6 file duplikat → include (aktif 2..7).
- [ ] Tambah partial pada `tender_admin/edit.blade.php` (aktif=1).
- [ ] Putuskan perlakuan halaman `create` (new tender tanpa id) — default tak tampil.
- [ ] Konfirmasi nama route aktual langkah "File Tender".
- [ ] Jalankan suite test + push.

*(Catatan: dokumen ini disimpan di cabang fitur untuk melanjutkan esok; belum mengeksekusi kode di atas kecuali setujukan lebih dulu.)*
