# Sistem Pengadaan Tender — UI Kit

UI multi-file untuk aplikasi pengadaan tender berbasis **Hermes Design** dengan design system **Ant Design** (enterprise, light theme, biru `#1677FF`).

## Struktur File

```
ui/
├── index.html                  # Redirect ke login
├── public-tenders.html         # 🆕 HALAMAN PUBLIK — tender terbuka (orange theme)
├── login.html                  # Halaman login (standalone)
├── register.html               # Halaman registrasi (standalone)
├── home.html                   # Beranda tender (peserta)
├── tender-detail.html          # Detail tender + zona pendaftaran/upload
├── peserta-registrasi.html     # Registrasi profil peserta
├── penawaran-upload.html       # Upload penawaran file
├── tender-admin-index.html     # Admin: daftar tender (tabel)
├── tender-admin-form.html      # Admin: form create/edit tender
├── tender-admin-tahapan.html   # Admin: atur tahapan tender
├── admin-dashboard.html        # Admin: dashboard peserta & tender
├── admin-pemeriksaan.html      # Admin: checklist pemeriksaan peserta
├── css/
│   ├── base.css               # Tokens, reset, layout, sidebar, topbar, buttons
│   ├── components.css         # Cards, tables, forms, modals, alerts, tabs, dropdown
│   ├── pages.css              # Page-specific styles (auth, tender, dashboard)
│   └── theme-public.css       # 🆕 Tema orange Anthropic untuk halaman publik
├── js/
│   ├── sidebar.js             # Sidebar toggle, active link, overlay
│   ├── ui.js                  # Modals, tabs, dropdowns, alerts, form validation
│   └── app.js                 # Init, table search, file inputs, toast, utilities
└── data/
    ├── tenders.json           # Data dummy tender (6 items)
    └── masters.json           # Data master (jenis, kontrak, metode, status)
```

## Halaman & Flow

### Auth
- **Login** → `login.html`
- **Register** → `register.html`

### 🌐 Publik (Tanpa Login)
- **Tender Terbuka** → `public-tenders.html` — daftar tender aktif dengan tema orange Anthropic

### Peserta (User)
- **Beranda** → `home.html` — grid tender publish
- **Detail Tender** → `tender-detail.html?id={id}` — info + zona pendaftaran + zona upload
- **Registrasi Profil** → `peserta-registrasi.html` — form profil perusahaan lengkap
- **Upload Penawaran** → `penawaran-upload.html?tender_id={id}` — input nilai + file

### Admin
- **Kelola Tender** → `tender-admin-index.html` — tabel CRUD tender
- **Form Tender** → `tender-admin-form.html` — create/edit tender
- **Tahapan Tender** → `tender-admin-tahapan.html` — atur jadwal tahapan
- **Dashboard** → `admin-dashboard.html` — statistik + tabel peserta per tender
- **Pemeriksaan** → `admin-pemeriksaan.html` — checklist administrasi per peserta

## Teknologi

- **Framework**: Bootstrap 5.3.2 (CDN)
- **Design System**: Ant Design inspired (tokens biru, light theme)
- **CSS**: Custom properties (CSS variables), mobile-first
- **JS**: Vanilla JS, modular (sidebar, ui, app)
- **Data**: JSON files fetched via `fetch()`

## 🎨 Tema

Semua halaman menggunakan tema **Orange Anthropic** dengan warna dominan:

| Token | Warna | Penggunaan |
|-------|-------|------------|
| **Primary** | `#E57035` | Button, badge, border, accent |
| **Primary Hover** | `#F08045` | Hover state |
| **Primary Active** | `#C56030` | Active/pressed state |
| **Primary Light** | `#FFF0E6` | Light background (badge, alert) |
| **Background** | `#FFF8F0` | Page background (warm cream) |
| **Surface** | `#FFFFFF` | Card, modal, form background |
| **Text** | `#1A1A1A` | Headings, body text |
| **Text Muted** | `#78716C` | Secondary text, labels |
| **Text Inverse** | `#FFFFFF` | Text on orange background |
| **Border** | `#F0DFD0` | Card border, divider |

| File CSS | Penggunaan |
|----------|------------|
| `base.css` + `components.css` + `pages.css` | Admin & Peserta (sidebar layout) |
| `theme-public.css` | Halaman publik (tanpa sidebar) |

## Fitur Interaktif

- ✅ Sidebar responsive dengan overlay (mobile)
- ✅ Modal konfirmasi pendaftaran
- ✅ Dropdown user menu
- ✅ Form validation real-time
- ✅ Table search/filter
- ✅ File input dengan label dinamis
- ✅ Toast notification
- ✅ Confirm action (hapus, dsb)
- ✅ **Public page** dengan live search & filter (JS vanilla)

## Verifikasi

- ✅ Viewport meta + theme-color di semua HTML
- ✅ Overflow-x: hidden di html/body
- ✅ Touch targets ≥40px
- ✅ Input font-size 16px (iOS zoom prevention)
- ✅ Cache buster `?v=N` pada CSS/JS
- ✅ No raw hex outside `:root`
- ✅ Data in JSON, not inline JS
- ✅ Zero TODO/placeholder

---

*Dibangun dengan Hermes Design skill untuk pengadaan tender.*
