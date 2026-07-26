# Handoff: Code Review & Perbaikan Project Pengadaan2

> **Tanggal review**: 2026-05-21  
> **Project**: `pengadaan2` (E-Procurement / Sistem Pengadaan Tender)  
> **Lokasi**: `D:/laragon06/www/pengadaan2`  
> **Status**: Belum dikerjakan — semua item di bawah perlu ditindaklanjuti  

---

## 0. Environment & Versi

| Komponen | Versi Saat Ini | Catatan |
|---|---|---|
| Laravel Framework | **8.83.29** | `composer.json`: `^8.75` |
| PHP | **8.4.17** (CLI) | Terlalu baru untuk Laravel 8 |
| Package utama | `fruitcake/laravel-cors ^2.0`, `laravel/sanctum ^2.11`, `laravel/ui ^3.4`, `jeroennoten/laravel-adminlte ^3.7`, `jenssegers/agent ^2.6`, `simplesoftwareio/simple-qrcode ~4` | Sebagian besar deprecated/usang |
| PHP constraint | `^7.3|^8.0` (composer.json) | Tidak sesuai dengan PHP 8.4 yang terinstal |

---

## Ringkasan Temuan per Prioritas

| # | Prioritas | Masalah | Estimasi Effort |
|---|---|---|---|
| 1 | SANGAT KRITIS | Mass Assignment: 46 model tanpa `$fillable` | Besar |
| 2 | KRITIS | PHP 8.4 vs Laravel 8 — kompatibilitas rusak | Besar |
| 3 | TINGGI | Validasi request lemah (`authorize()` selalu `true`, rule hanya `required`) | Sedang |
| 4 | TINGGI | Tidak ada Policy/authorization layer (admin vs peserta) | Sedang-Besar |
| 5 | SEDANG | N+1 query di beberapa controller | Sedang |
| 6 | SEDANG | Debug code tertinggal (`echo $tfs;`) | Kecil |
| 7 | SEDANG | Sintaks middleware route salah | Kecil |
| 8 | SEDANG | File upload tanpa validasi MIME/path traversal | Sedang |
| 9 | RENDAH | Penamaan controller tidak konsisten + duplikat | Sedang |
| 10 | RENDAH | Typo di nama field/kolom (`pegadaan`, `katagori`) | Kecil |

---

## Detail Per Masalah

### MASALAH 1 — Mass Assignment Vulnerability (SANGAT KRITIS)

**Deskripsi**: 46 dari 55 model Eloquent tidak memiliki properti `$fillable` maupun `$guarded`. Ini berarti semua kolom bisa diisi massal via `Model::create($request->all())` atau `$model->fill()`, membuka peluang serangan mass-assignment.

**Model yang SUDAH punya `$fillable` (11 — tidak perlu diubah)**:
```
barang.php, deal_barang.php, detail_order.php, detail_pembayaran.php,
inventory_barang.php, katagori_barang.php, keranjang.php, order.php,
pembayaran_user.php, sesi_belanja.php, User.php
```

**Model yang BELUM punya `$fillable` (46 — perlu ditambah)**:
```
administrasi.php, administrasi_detail.php, alamat_user.php, barang_photo.php,
daftar_peserta.php, detail_syarat.php, file_teknis.php, jenis_kontrak.php,
jenis_pengadaan.php, keranjang_user.php, komentar.php, koreksi.php,
managemen.php, metode_pengadaan.php, pekerjaan_berjalan.php,
pemenang_tender.php, pemeriksaan.php, penawaran.php, penawaran_file.php,
penawaran_peserta.php, penawaran_peserta_file.php, pengalaman_tender.php,
penilaian_administrasi.php, penilaian_kualifikasi.php,
penilaian_penawaran_peserta.php, penilaian_peserta.php,
penilaian_teknis.php, penilaian_tender.php, peralatan.php, perubahan.php,
peserta.php, proses_tender.php, sanggah.php, status_tender.php,
syarat.php, syarat_detail.php, tahapan.php, tenaga_ahli.php, tender.php,
tender_file.php, tender_file_detail.php, tender_komen.php,
tender_persyaratan.php, tender_persyaratan_file.php,
tender_status_files.php, total_belanja_user.php, validasi_file.php
```

**Cara perbaikan**:
1. Buka setiap model di atas
2. Cek migration / database schema untuk mengetahui kolom yang boleh diisi
3. Tambahkan:
   ```php
   protected $fillable = [
       'kolom1', 'kolom2', 'kolom3', ...
   ];
   ```
4. Jika terlalu banyak kolom dan yakin aman, alternatif sementara:
   ```php
   protected $guarded = []; // HATI-HATI: membuka semua kolom
   ```
   **Tidak disarankan** untuk model yang menangani data sensitif (peserta, penawaran, penilaian).

**Contoh untuk `app/Models/peserta.php`** (berdasarkan field yang digunakan di `PesertaController::update`):
```php
protected $fillable = [
    'tender_id', 'user_id', 'nama_pt', 'no_hp', 'email', 'alamat',
    'izin', 'nomor_izin', 'izin_berlaku', 'instansi_pemberi',
    'kualifikasi', 'klasifikasi', 'no_akta', 'tgl_akta', 'notaris',
    'no_aktab', 'tgl_aktab', 'notaris_b', 'kswp_npwp', 'kswp_nama',
    'harga_koreksi',
];
```

---

### MASALAH 2 — Kompatibilitas PHP 8.4 vs Laravel 8 (KRITIS)

**Deskripsi**: Server menjalankan PHP 8.4.17, tetapi Laravel 8.83 secara resmi hanya mendukung PHP 7.3 – 8.1. Saat `php artisan` dijalankan, muncul deprecation warning:
```
Deprecated: voku\helper\ASCII::to_ascii(): Implicitly marking parameter
$replace_single_chars_only as nullable is deprecated...
```

**Dua opsi perbaikan** (pilih salah satu):

**Opsi A — Turunkan PHP ke 8.1 (Lebih Cepat, Risiko Rendah)**:
1. Install PHP 8.1 via Laragon
2. Switch PHP version di Laragon ke 8.1
3. Jalankan `composer install` ulang
4. Test aplikasi

**Opsi B — Upgrade Laravel ke 10+ (Lebih Tepat untuk Jangka Panjang)**:
1. `composer require laravel/framework:^10.0`
2. Update `fruitcake/laravel-cors` → gunakan built-in CORS middleware Laravel 10
3. Update `laravel/sanctum` ke `^3.2`
4. Update `laravel/ui` ke `^4.0`
5. Jalankan `php artisan view:clear && php artisan cache:clear`
6. Ikuti upgrade guide: https://laravel.com/docs/10.x/upgrade
7. Test seluruh flow

---

### MASALAH 3 — Validasi Request Lemah (TINGGI)

**Deskripsi**: Semua FormRequest di `app/Http/Requests/` memiliki dua masalah:
1. `authorize()` selalu `return true;` — tidak ada authorization check
2. Rule validasi hanya `required` tanpa validasi tipe data

**Contoh masalah di `app/Http/Requests/pesertaRequest.php`** (baris 14-17, 26-50):
```php
public function authorize()
{
    return true;  // <-- TIDAK ADA CEK ROLE/OWNER
}

public function rules()
{
    return [
        'email' => 'required',        // <-- harus: 'required|email'
        'tgl_akta' => 'required',     // <-- harus: 'required|date'
        'izin_berlaku' => 'required', // <-- harus: 'required|date'
        // ...
    ];
}
```

**Daftar FormRequest yang perlu diperbaiki** (semua di `app/Http/Requests/`):
```
pesertaRequest.php, Storefile_teknisRequest.php, Storedaftar_pesertaRequest.php,
StoreadministrasiRequest.php, StoremanagemenRequest.php,
Storepekerjaan_berjalanRequest.php, StorekoreksiRequest.php,
Storepemenang_tenderRequest.php, Storeadministrasi_detailRequest.php,
StorepemeriksaanRequest.php, StorepenawaranRequest.php,
Storepenawaran_fileRequest.php, Storepenawaran_pesertaRequest.php,
Storepenawaran_peserta_fileRequest.php, Storepenilaian_administrasiRequest.php,
Storepengalaman_tenderRequest.php, Storepenilaian_penawaran_pesertaRequest.php,
Storepenilaian_kualifikasiRequest.php, Storepenilaian_tenderRequest.php,
Storepenilaian_teknisRequest.php, Storepenilaian_pesertaRequest.php,
StoresanggahRequest.php, Storeproses_tenderRequest.php,
StoreperalatanRequest.php, Storetender_persyaratanRequest.php,
... (total ~25+ file)
```

**Cara perbaikan per file**:
1. Buka setiap file di `app/Http/Requests/`
2. Untuk `authorize()`: tambahkan logic cek role/owner, contoh:
   ```php
   public function authorize()
   {
       $peserta = $this->route('peserta');
       return $peserta && $peserta->user_id === Auth::id();
   }
   ```
3. Untuk `rules()`: tambahkan rule tipe data:
   ```php
   'email' => 'required|email|max:255',
   'tgl_akta' => 'required|date',
   'no_hp' => 'required|string|max:20',
   'kualifikasi' => 'required|in:kecil,menengah,besar',
   ```

---

### MASALAH 4 — Tidak Ada Policy / Authorization Layer (TINGGI)

**Deskripsi**: Folder `app/Policies/` **tidak ada**. Tidak ada differentiation antara admin dan peserta di controller level. Semua route hanya dilindungi middleware `auth` + `verified`.

**Yang perlu dibuat**:
1. Buat folder `app/Policies/`
2. Generate policy per model:
   ```
   php artisan make:policy PesertaPolicy --model=Peserta
   php artisan make:policy TenderPolicy --model=Tender
   php artisan make:policy PenawaranPolicy --model=Penawaran
   // dst untuk model yang butuh role-based access
   ```
3. Contoh `app/Policies/PesertaPolicy.php`:
   ```php
   public function view(User $user, Peserta $peserta)
   {
       return $user->id === $peserta->user_id || $user->hak_akses === 'admin';
   }

   public function update(User $user, Peserta $peserta)
   {
       return $user->id === $peserta->user_id;
   }

   public function delete(User $user, Peserta $peserta)
   {
       return $user->hak_akses === 'admin';
   }
   ```
4. Daftarkan di `app/Providers/AuthServiceProvider.php`:
   ```php
   protected $policies = [
       Peserta::class => PesertaPolicy::class,
       Tender::class => TenderPolicy::class,
       // dst
   ];
   ```
5. Di controller, gunakan:
   ```php
   $this->authorize('update', $peserta);
   ```

---

### MASALAH 5 — N+1 Query di Beberapa Controller (SEDANG)

**Lokasi 1**: `app/Http/Controllers/SanggahController.php` — method `show()` (baris ~82-108)
```php
$daftar = daftar_peserta::where('daftar_pesertas.tender_id',$id)
    ->join('pesertas','pesertas.id','daftar_pesertas.peserta_id')
    ->join('penawaran_pesertas','penawaran_pesertas.peserta_id','pesertas.id')
    ->join('tenders','tenders.id','pesertas.tender_id')
    ->select('pesertas.*','penawaran_pesertas.penawaran as penawaran_peserta')
    ->paginate(10);

foreach ($daftar as $key => $value) {
    if ($value->user_id == $user->id) {
        $peserta = peserta::where('user_id',$user->id)->first();       // QUERY DI LOOP
        $sanggah = sanggah::where('user_id',$user->id)
            ->where('peserta_id',$peserta->id)
            ->where('tender_id',$data->id)->first();                  // QUERY DI LOOP
    }
}
```
**Perbaikan**: Keluarkan query dari loop, atau gunakan eager loading:
```php
$peserta = peserta::with(['sanggah' => function($q) use ($id) {
    $q->where('tender_id', $id);
}])->where('user_id', $user->id)->first();
```

---

**Lokasi 2**: `app/Http/Controllers/PesertaController.php` — method `update()` (baris ~361-447)
```php
foreach ($file as $key => $ts) {
    if ($request->$x) {
        // ...
        $tfs = tender_file_detail::findorfail($x);  // QUERY DI LOOP
        $tfs->files = $nama_file;
        $tfs->save();                              // SAVE DI LOOP
    }
}
```
**Perbaikan**: Kumpulkan ID, lakukan batch update:
```php
$ids = [];
foreach ($file as $ts) {
    if ($request->{$ts->id}) {
        $ids[$ts->id] = $nama_file;
    }
}
if (!empty($ids)) {
    foreach ($ids as $id => $path) {
        tender_file_detail::where('id', $id)->update(['files' => $path]);
    }
}
```

---

**Lokasi 3**: `app/Http/Controllers/PesertaController.php` — method `show_file_peserta()` (baris ~198-256)
```php
$p_admin = penilaian_administrasi::where('peserta_id',$pid)->where('tender_id',...)->first();
$p_kualifikasi = penilaian_kualifikasi::where('peserta_id',$pid)->where('tender_id',...)->first();
$p_teknis = penilaian_teknis::where('peserta_id',$pid)->where('tender_id',...)->first();
$p_peserta = penilaian_penawaran_peserta::where('peserta_id',$pid)->where('tender_id',...)->first();
$admin = administrasi_detail::where('peserta_id',$pid)->where('tender_id',...)->get();
$file_rkk = file_teknis::where('peserta_id',$pid)->where('tender_id',...)->get();
```
**Perbaikan**: 7 query terpisah untuk data yang berhubungan — pertimbangkan untuk:
- Buat method di model dengan scope `byTenderAndPeserta($tenderId, $pesertaId)`
- Atau gabungkan ke satu query dengan join

---

### MASALAH 6 — Debug Code Tertinggal (SEDANG)

**Lokasi**: `app/Http/Controllers/PesertaController.php` baris 435
```php
$tfs = tender_file_detail::findorfail($x);
echo $tfs;          // <-- HAPUS BARIS INI
$tfs->files = $nama_file;
```

**Perbaikan**: Hapus baris `echo $tfs;`

---

**Lokasi tambahan**: `app/Http/Controllers/AdministrasiDetailController.php` baris 75
```php
// echo $tfs;    // <-- Sudah dikomentari, tapi sebaiknya hapus saja
```

---

### MASALAH 7 — Sintaks Middleware Route Salah (SEDANG)

**Lokasi**: `routes/web.php` baris 70
```php
Route::middleware(['middleware' => 'auth','verified' ])->group(function () {
```

**Masalah**: Sintaks `['middleware' => 'auth','verified']` salah. Cara benar adalah array list tanpa key `middleware`.

**Perbaikan**:
```php
Route::middleware(['auth', 'verified'])->group(function () {
    // ...
});
```

---

### MASALAH 8 — File Upload Tanpa Validasi (SEDANG)

**Lokasi**: `app/Http/Controllers/PesertaController.php` — method `update()` (baris ~420-430)
```php
$tmp_file = $request->file($x);
$file = time().".".$tmp_file->getClientOriginalExtension();   // <-- tidak validasi extension
$tujuan_upload = 'Tender/FILE/'.$request->id.'/'.$ts->id;     // <-- $request->id dari user input
$tmp_file->move($tujuan_upload,$file);
```

**Masalah**:
1. Tidak ada validasi MIME type — user bisa upload file `.php`, `.exe`, dll
2. `$request->id` digunakan untuk path upload tanpa validasi — potensi path traversal
3. `getClientOriginalExtension()` tidak aman — gunakan `guessExtension()` atau validasi extension manual

**Perbaikan**:
```php
$request->validate([
    $x => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:10240',
]);

$tmp_file = $request->file($x);
$safeId = intval($request->id);   // sanitize
$safeTsId = intval($ts->id);
$extension = $tmp_file->guessExtension();
$filename = time() . '_' . Str::random(10) . '.' . $extension;
$tujuan_upload = 'Tender/FILE/' . $safeId . '/' . $safeTsId;
$tmp_file->storeAs($tujuan_upload, $filename, 'public');
$nama_file = $tujuan_upload . '/' . $filename;
```

---

### MASALAH 9 — Penamaan Controller Tidak Konsisten + Duplikat (RENDAH)

**Duplikat controller** (hapus salah satu, pertahankan yang PascalCase):
| Hapus | Pertahankan |
|---|---|
| `jenis_kontrakController.php` | `JenisKontrakController.php` |
| `jenis_pengadaanController.php` | `JenisPengadaanController.php` |
| `metode_pengadaanController.php` | `MetodePengadaanController.php` |
| `PemeriksaanControll.php` | `PemeriksaanController.php` |

**Controller dengan lowercase pertama** (rename ke PascalCase):
```
barangController.php        -> BarangController.php
katagori_barangController.php-> KatagoriBarangController.php (atau KategoriBarangController.php)
komentarController.php      -> KomentarController.php
tenderController.php        -> TenderController.php
```

**Yang sudah benar** (PascalCase — tidak perlu diubah):
```
AdministrasiController, DaftarPesertaController, DashboardController,
DetailSyaratController, FileTeknisController, HomeController,
JenisKontrakController, JenisPengadaanController, KoreksiController,
ManagemenController, MetodePengadaanController, PekerjaanBerjalanController,
PemenangTenderController, PemeriksaanController, PenawaranController,
...
```

**Langkah perbaikan**:
1. Pindahkan logic dari controller duplikat ke controller PascalCase
2. Rename file + class name
3. Update `use` statements di `routes/web.php`
4. Jalankan `composer dump-autoload`
5. Test route

---

### MASALAH 10 — Typo di Nama Field/Kolom (RENDAH)

**Ditemukan typo** (di model dan kemungkinan migration):
- `jenis_pegadaan_id` — seharusnya `jenis_pengadaan_id` (typo: "pegadaan" → "pengadaan")
- `katagori_barang` — seharusnya `kategori_barang` (typo: "katagori" → "kategori")
- `PemeriksaanControll.php` — seharusnya `PemeriksaanController.php` (lihat Masalah 9)

**Catatan**: Mengubah nama kolom database berarti migration + update seluruh reference. Hanya lakukan jika berani migrate ulang atau siap membuat migration rename.

---

## Checklist Eksekusi

Urutan rekomendasi pengerjaan (dari yang paling berdampak ke paling cepat):

### Fase 1 — Quick Wins (Bisa langsung, < 1 jam)
- [ ] Hapus `echo $tfs;` di `PesertaController.php` baris 435
- [ ] Hapus commented `// echo $tfs;` di `AdministrasiDetailController.php` baris 75
- [ ] Perbaiki sintaks middleware di `routes/web.php` baris 70:
  - Dari: `['middleware' => 'auth','verified' ]`
  - Ke: `['auth', 'verified']`

### Fase 2 — Keamanan Dasar (Setengah hari)
- [ ] Tambah `$fillable` ke 46 model (daftar di Masalah 1)
- [ ] Perbaiki validasi di `pesertaRequest.php` (tambah `email`, `date`, `numeric` rules)
- [ ] Audit FormRequest lainnya satu per satu

### Fase 3 — Keamanan Lanjut (1-2 hari)
- [ ] Buat `app/Policies/` dan generate policy untuk model utama
- [ ] Implementasi `authorize()` di setiap FormRequest
- [ ] Tambah validasi file upload (MIME type, max size, sanitize path)

### Fase 4 — Performa & Kualitas (1-2 hari)
- [ ] Perbaiki N+1 query di `SanggahController::show()`
- [ ] Perbaiki N+1 query di `PesertaController::update()`
- [ ] Refaktor `PesertaController::show_file_peserta()` (7 query → fewer dengan join/eager loading)

### Fase 5 — Kompatibilitas (Besar, butuh keputusan)
- [ ] **Pilih**: Turunkan PHP ke 8.1 ATAU upgrade Laravel ke 10+
- [ ] Test seluruh flow setelah perubahan

### Fase 6 — Konsistensi (Opsional, bisa bertahap)
- [ ] Hapus controller duplikat (4 pasang, lihat Masalah 9)
- [ ] Rename controller lowercase ke PascalCase
- [ ] Update route references
- [ ] Pertimbangkan perbaiki typo `pegadaan` → `pengadaan` dan `katagori` → `kategori` (butuh migration)

---

## Catatan Tambahan

### Struktur Folder Saat Ini
```
app/
├── Console/
├── Exceptions/
├── Http/
│   ├── Controllers/      (52 file, ada duplikat & inkonsistensi nama)
│   ├── Requests/         (~25+ FormRequest, semua authorize() return true)
│   └── Middleware/
├── Mail/                 (VMail.php — untuk email notification)
├── Models/               (55 model, 46 tanpa $fillable)
├── Notifications/        (EmailNotification.php)
└── Providers/
```

### Yang TIDAK Ada (sebaiknya dipertimbangkan)
- `app/Policies/` — belum ada sama sekali
- `app/Services/` — logic bisnis tertanam di controller (sebaiknya dipindah ke Service layer)
- `app/Helpers/` — tidak ada helper function
- `app/Traits/` — tidak ada reusable trait
- Test coverage minim (hanya 2 Feature test + 2 Unit test terdeteksi)

### Statistik Codebase (dari Codebase MCP)
- **2.803 nodes** terindeks, **4.362 edges**
- **848 file PHP**, 4 JS, 3 CSS, 1 YAML, 1 HTML
- Hotspot terbesar: `alamat_user.user` (fan-in 55)
- Cluster utama terdiri dari: pengelolaan file tender, penilaian, penawaran peserta

---

## Referensi Cepat

| File penting | Lokasi |
|---|---|
| Routes | `routes/web.php` (159 baris) |
| Composer | `composer.json` |
| Environment | `.env` |
| Auth config | `config/auth.php` |
| Middleware utama | `app/Http/Kernel.php` |
| Base controller | `app/Http/Controllers/Controller.php` |
| User model | `app/Models/User.php` |
| Sample FormRequest | `app/Http/Requests/pesertaRequest.php` |
| Sample model | `app/Models/peserta.php` (78 baris, 10 relationship) |

---

## Selesai mengerjakan? Checklist verifikasi akhir

- [ ] `php artisan route:list` — tidak ada error
- [ ] `php artisan config:clear && php artisan cache:clear` — sukses
- [ ] `composer dump-autoload` — sukses
- [ ] Test login sebagai admin — bisa akses semua route
- [ ] Test login sebagai peserta — tidak bisa akses route admin
- [ ] Test upload file — hanya menerima PDF/JPG/PNG/DOC
- [ ] Test form submit tanpa field required — ditolak validasi
- [ ] Cek `php artisan --version` dan `php -v` — kompatibel
- [ ] Cek log: `tail -f storage/logs/laravel.log` — tidak ada warning
