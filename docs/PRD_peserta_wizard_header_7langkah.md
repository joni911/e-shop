# PRD — Header Wizard Peserta 7 Langkah (Data Perusahaan → Administrasi) di atas semua halaman langkah

- **Cabang:** `feat/tender-saya-hub`
- **Status:** ✅ Dieksekusi (commit di cabang `feat/tender-saya-hub`). Keputusan user: (1) langkah aktif bisa diklik, (2) bebas lompat tanpa gating, (3) stepper 7 langkah termasuk Administrasi. 111 test hijau (668 assertions).
- **Pola rujukan:** `docs/PRD_tender_setup_steps_header.md` (versi admin, sudah dieksekusi)

---

## 1. Latar belakang & masalah

Wizard kelengkapan peserta (Tender Saya → pilih tender → isi langkah) menampilkan *stepper*
hanya di **1 tempat**: hub `peserta/tenders` (`tender_user/peserta/tenders/index.blade.php`,
blok `.steps` di card "Status Kelengkapan"). Akibatnya:

1. Halaman langkah itu sendiri — `peserta/{id}/edit`, `/pengalaman/{id}`,
   `/tenagaahli/{id}`, `/peralatan/{id}`, `/pekerjaan_berjalan/{id}`, `/managemen/{id}`,
   dan halaman Administrasi berkas — **tidak punya penanda posisi**; user mudah "nyasar"
   di tengah alur 6–7 langkah.
2. Blok stepper **terduplikasi inline** hanya di hub → tidak ada *single source of truth*;
   saat langkah ditambah (mis. step 7 Administrasi) hanya hub yang berubah, halaman lain tetap tanpa header.
3. Kelas state di markup hub (`step done`) **tidak cocok** dengan CSS yang tersedia
   (`public/ui/css/components.css`: `.step.active` & `.step.completed` ada, `.done` tidak punya rule)
   → state visual (warna hijau sukses / aksen langkah aktif) tidak pernah terpakai.

## 2. Tujuan

- Satu partial stepper (`peserta-steps`) + satu service data langkah → **satu sumber kebenaran**.
- Stepper muncul di **atas setiap halaman langkah** peserta (7 langkah), identik dengan
  tampilan hub `peserta/tenders` (`.steps > .step > a.step-link > .step-number ✓/n + label`).
- Langkah **aktif** (halaman yang sedang dibuka): angka di lingkaran aksen + **tetap bisa diklik**
  (keputusan #1) → boleh lompat balik ke langkah mana pun yang sudah diisi.
- **Bebas lompat** (keputusan #2): semua langkah berupa tautan, tidak ada penguncian berurutan.
- **7 langkah** (keputusan #3): 1 Data Perusahaan, 2 Pengalaman, 3 Tenaga Ahli, 4 Peralatan,
  5 Pekerjaan Berjalan, 6 Managemen, 7 Administrasi (Upload Berkas).
- URL 100% via `route()` dinamis (tidak ada URL absolut).
- Semua perilaku dibuktikan test (TDD), bukan manual.

## 3. Non-lingkup (explicit out of scope)

- Tidak mengubah wizard admin tender (`tender_admin/part/tender-setup-steps.blade.php`).
- Tidak menambah tombol navigasi "Lanjut/Kembali" antar langkah.
- Tidak mengubah logika CRUD/store tiap langkah.
- Tidak merombak halaman hub "Tender Saya" selain menyuntik partial yang sama (tampilan hub
  dipertahankan: tanpa penanda aktif — karena hub = ringkasan global, bukan satu langkah).
- Tidak menambah state `completed` hijau bila itu mengubah tampilan hub (dicek saat render; bila
  ingin seragam, dilakukan sebagai commit visual terpisah setelah PRD ini).

## 4. Keputusan (dikonfirmasi user)

| # | Pertanyaan | Keputusan |
|---|-----------|-----------|
| 1 | Langkah aktif boleh diklik? | **Ya** — tetap `<a class="step-link">`, hanya diberi penanda `.active` |
| 2 | Lompat antar langkah bebas / gating? | **Bebas lompat** — semua langkah tautan, tanpa gating |
| 3 | Jumlah langkah stepper | **7** — tambah "Administrasi" setelah Managemen |

## 5. Rincian teknis

### 5.1 Sumber data langkah — service `PesertaWizardService`

**File baru:** `app/Services/PesertaWizardService.php`

```php
PesertaWizardService::steps(peserta $profil, ?string $activeKey = null): Collection
```

Keluaran tiap item: `[key, label, url, done(mixed), active(bool)]`.

Urutan & deteksi `done` (identik `PesertaController::pesertaSteps()` saat ini + step 7 baru):

| n | key | label | url (`route(...)`) | done = |
|---|-----|-------|--------------------|--------|
| 1 | perusahaan | Data Perusahaan | `peserta.edit [$profil->id]` | `true` |
| 2 | pengalaman | Pengalaman | `pengalaman.show [$profil->id]` | `(int)$profil->pengalaman()->count() > 0` |
| 3 | tenaga | Tenaga Ahli | `tenagaahli.show [$profil->id]` | `$profil->tenaga_ahli()->count() > 0` |
| 4 | peralatan | Peralatan | `peralatan.show [$profil->id]` | `$profil->peralatan()->count() > 0` |
| 5 | pekerjaan | Pekerjaan Berjalan | `pekerjaan_berjalan.show [$profil->id]` | `$profil->pekerjaan()->count() > 0` |
| 6 | managemen | Managemen | `managemen.show [$profil->id]` | `$profil->managemen()->count() > 0` |
| 7 | administrasi | Administrasi | `administrasi_list.show [$profil->id]` | ada baris `administrasi_detail` utk peserta & tender aktif |

Step 7 bersifat **per-tender**; deteksi done memakai tender aktif:
`$tenderId = TenderContext::tenderId(null) ?? $profil->tender_id` (fallback sama persis dengan
`AdministrasiDetailController::show`) lalu `administrasi_detail::where('peserta_id',$id)->where('tender_id',$tenderId)->exists()`.

`active = ($activeKey !== null && $key === $activeKey)`.

**Refactor:** `PesertaController::pesertaSteps()` dihapus → panggil service (hub index memakai
`steps($profil)` tanpa activeKey).

### 5.2 Partial stepper

**File baru:** `resources/views/tender_user/peserta/part/peserta-steps.blade.php`

Input: `$steps` (Collection item di atas), `$activeKey` (nullable — bila null, tidak ada penanda aktif).

Markup **identik hub saat ini**:

```blade
<div class="steps mb-2">
    @foreach ($steps as $i => $s)
        @if($i > 0)<div class="step-divider"></div>@endif
        <div class="step {{ !empty($s['done']) ? 'done' : '' }} {{ !empty($s['active']) ? 'active' : '' }}">
            <a class="step-link" href="{{ $s['url'] }}">
                <div class="step-number">@if(!empty($s['done'])) ✓ @else {{ $i + 1 }} @endif</div>
                <span>{{ $s['label'] }}</span>
            </a>
        </div>
    @endforeach
</div>
```

Catatan:
- `done` + `✓` dipertahankan agar hub **tidak berubah** (regresi visual = 0).
- `.active` (kelas baru di halaman langkah) memakai CSS yang **sudah ada**
  (`components.css` baris 697–704: lingkaran aksen primary). Bila warna link `<a>` menimpa
  warna `.step.active`, tambahkan rule kecil scoped di `components.css`:
  `.step.active .step-link { color: inherit; text-decoration: none; }`.
- Tidak ada kelas `disabled`/gating (keputusan #2).

### 5.3 Integrasi — daftar halaman langkah

Setiap halaman: `@include('tender_user.peserta.part.peserta-steps', ['steps'=>$steps, 'activeKey'=>'X'])`
ditempatkan **tepat di bawah `page-header`** (dan di atas card konten / tender-context-bar).

| n | `activeKey` | View | Controller (tambah `$steps`) |
|---|-------------|------|------------------------------|
| 1 | perusahaan | `tender_user.peserta.edit` | `PesertaController::edit` |
| 2 | pengalaman | `tender_user.peserta.pengalaman.show` (+ `.edit`) | `PengalamanTenderController::show/edit` |
| 3 | tenaga | `tender_user.peserta.tenaga_ahli.create` | `TenagaAhliController::show/edit` (create = halaman kosong, stepper boleh juga, `activeKey` sama) |
| 4 | peralatan | `tender_user.peserta.peralatan.create` | `PeralatanController::show/edit` |
| 5 | pekerjaan | `tender_user.peserta.pekerjaan_berjalan.create` | `PekerjaanBerjalanController::show/edit` |
| 6 | managemen | `tender_user.peserta.managemen.create` | `ManagemenController::show/edit` |
| 7 | administrasi | `tender_user.peserta.administrasi.detail.index` | `AdministrasiDetailController::show` |

Tiap controller sudah punya objek `$peserta`/`$profil` → panggil service & `compact('steps')`.

### 5.4 Refactor hub

`tenders/index.blade.php`: ganti blok `.steps ... @endforeach` inline dengan include partial
(`$steps` sudah dikirim controller; tanpa `$activeKey`). Perilaku & tampilan hub tidak berubah.

## 6. Rencana TDD (skill test-driven-development)

Siklus **RED → GREEN → REFACTOR** per slice. Test ditulis **lebih dulu**, diverifikasi **fail**,
baru implementasi minimal, lalu refactor. Setiap slice diakhiri `php artisan test --filter=...`.

**File test:** `tests/Feature/PesertaWizardHeaderTest.php` (RefreshDatabase + `DatabaseSeeder`,
helper `pesertaUser()` meniru `ManagemenRewriteTest`).

### Slice A — service & partial (RED)
1. `test_service_mengembalikan_7_langkah_urut_dan_benar` — service `steps(profil)` → 7 item;
   label urut Data Perusahaan…Administrasi; `url` = route dinamis (tanpa substring
   `127.0.0.1`); step 1 `done`, step 6/7 mengikuti isi DB.
2. `test_service_menandai_active_key` — `steps(profil,'managemen')` → item managemen `active=true`, lain `false`; tanpa `activeKey` → semua `false`.

### Slice B — hub 7 langkah (RED)
3. `test_hub_tender_saya_menampilkan_7_langkah` — GET `/peserta/tenders` → ok; html memuat
   label ke-7 `Administrasi` & link `administrasi_list` (route dinamis); jumlah `.step` = 7.
4. `test_hub_tetap_tanpa_adminlte` — `assertStringNotContainsString('adminlte')` + `ui-shell`.

### Slice C — stepper di halaman langkah (RED, parameterized)
5. `test_tiap_halaman_langkah_menampilkan_stepper_dengan_active_sesuai` — data provider 7 baris
   `[url, activeKey, expectedActiveLabel]`; GET tiap halaman → ok; ada `class="steps"`;
   ada label semua langkah; langkah aktif memuat kelas `active`; `assertStringNotContainsString('adminlte')`.
6. `test_langkah_aktif_tetap_tautan_dan_lompat_bebas` — pada satu halaman (mis. `/pengalaman/{id}`):
   langkah aktif adalah `<a class="step-link"` (bisa diklik) & href `peserta.edit` ada
   (buktikan bebas lompat tanpa tombol gating/disabled).

### Slice D — GREEN + refactor
Implementasi per 5.1–5.4 sampai seluruh test hijau; jalankan **suite penuh**
`php artisan test` — tidak boleh ada regresi (baseline saat ini 99 passed / 529 assertions + test wizard lain).

### Slice E — verifikasi runtime (opsional, bila server dev aktif)
Cek visual 1–2 halaman di browser (hub + `/managemen/{id}`): stepper tampil, langkah aktif
beredar aksen, ✓ langkah selesai, console bersih. Sesuaikan CSS kecil bila link menimpa warna active.

## 7. Validasi / penerimaan

- [ ] `php artisan test --filter=PesertaWizardHeaderTest` hijau (semua test di atas fail dulu di RED).
- [ ] `php artisan test` — suite penuh hijau, tanpa regresi.
- [ ] Hub `peserta/tenders` tetap tampil seperti sekarang + kini 7 langkah (Administrasi).
- [ ] 7 halaman langkah menampilkan stepper di bawah page-header, langkah aktif beredar aksen, semua tautan dinamis.
- [ ] Tidak ada URL absolut (`127.0.0.1`) pada stepper; tidak ada sisa `adminlte` di halaman peserta.

## 8. Tugas eksekusi (urutan)

1. `docs:` PRD ini (commit + push).
2. `test:` tulis `PesertaWizardHeaderTest` Slice A–C → jalankan → pastikan **RED**.
3. `feat:` service `PesertaWizardService` + refactor `pesertaSteps()` → GREEN Slice A/B.
4. `feat:` partial `peserta-steps` + wiring 7 halaman/controller + refactor hub → GREEN Slice C.
5. `refactor:` bersihkan duplikasi, jalankan suite penuh.
6. `test:` (opsional) verifikasi browser; `fix:` CSS kecil bila perlu.
7. Update status PRD → commit akhir + push.

## 9. Risiko / catatan

- Step 7 `done` bergantung konteks tender (session); di luar wizard (URL langsung) memakai
  `$profil->tender_id` — konsisten dengan perilaku halaman administrasi yang ada.
- Kelas `done` vs CSS `completed`: dibiarkan apa adanya agar hub tidak berubah visual; usulan
  penyatuan state hijau = PR/commit terpisah.
- Beberapa halaman (mis. tenaga/peralatan) memakai view `create` untuk mode show & edit —
  cukup 1 sisipan per view, controller menambah `$steps`.
