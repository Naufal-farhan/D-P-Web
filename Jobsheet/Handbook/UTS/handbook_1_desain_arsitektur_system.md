# 📘 Handbook 1: Arsitektur Sistem, Desain UI/UX & Responsiivitas

Handbook ini dirancang khusus untuk membantumu menjelaskan **alasan teknis, filosofi desain, tata letak, dan arsitektur aplikasi** saat presentasi UTS.

---

## 1. Analisis Struktur Project Jobsheet-06

Aplikasi ini menggunakan struktur modular berbasis direktori fungsional:

```text
Jobsheet-06/
├── index.html              # Dashboard Utama (Overview & Ringkasan Statistik)
├── anggota/
│   ├── list.html           # Halaman Tabel Daftar Anggota / Pelanggan
│   └── tambah.html         # Form Input Tambah Anggota Baru
├── buku/
│   ├── list.html           # Halaman Tabel Daftar Mobil / Unit
│   └── tambah.html         # Form Input Tambah Unit Baru
├── assets/
│   ├── css/
│   │   └── style.css       # Stylesheet Terpusat (Global Style & Responsive)
│   └── js/
│       ├── app.js          # Logika Dashboard, Hitung Stat, & Toggle Sidebar
│       ├── anggota.js      # Logika Render Data & Handling Form Anggota
│       └── buku.js         # Logika Render Data & Handling Form Buku/Mobil
└── data/
    ├── anggota.json        # Single Source of Truth Data Pelanggan (JSON)
    └── buku.json           # Single Source of Truth Data Unit/Mobil (JSON)
```

### Mengapa Struktur Ini Dipilih?
1. **Separation of Concerns (Pemisahan Tanggung Jawab):** Data (`data/`), Tampilan (`HTML`), Gaya (`assets/css`), dan Logika (`assets/js`) dipisah secara tegas.
2. **Skalabilitas Mudah:** Jika di masa depan ada modul baru (misal: `transaksi/`), kita tinggal membuat folder baru tanpa mengacak-acak kode yang sudah ada.

---

## 2. Filosofi Layout & UI Pattern

Website ini mengadopsi pola **App Shell Architecture** yang umum digunakan pada aplikasi berbasis Dashboard Admin.

### Visual Wireframe Layout:
```text
+-----------------------------------------------------------------------+
|  [Sidebar Fixed - 240px]  |  [Topbar Fixed - Height: 60px]            |
|                           +-------------------------------------------+
|  - Logo / Brand           |  [Content Body - Scrollable Area]         |
|  - Nav Dashboard          |                                           |
|  - Nav Data Mobil         |  +-------------------------------------+  |
|  - Nav Data Pelanggan     |  | Cards / Tables / Form Controls      |  |
|                           |  +-------------------------------------+  |
+-----------------------------------------------------------------------+
```

### Komponen Layout:
1. **Sidebar (`<aside class="sidebar">`):**
   - Terletak di sisi kiri layar karena mata manusia membaca dengan pola **F-Pattern** (dari kiri ke kanan, atas ke bawah).
   - Menggunakan `position: fixed` agar menu navigasi tidak hilang saat pengguna melakukan scroll pada data tabel yang panjang.
2. **Topbar (`<header class="topbar">`):**
   - Menampilkan judul aplikasi, tombol Hamburger menu (di tampilan mobile), serta indikator profil pengguna aktif.
3. **Content Body (`<main class="content-body">`):**
   - Menggunakan kontainer berupa **Card (`.card`)** berlatar putih dengan sedikit bayangan (*box-shadow*) di atas background abu-abu terang (`#f4f6f9`). Ini bertujuan untuk mengurangi beban kognitif visual pengakses (*cognitive load*).

---

## 3. Palet Warna (Color Scheme) & Psikologi Warna

Sistem warna dikelompokkan berdasarkan peran informasi pada interface:

| Elemen / Komponen | Kode Warna | Nama Warna | Alasan & Psikologi Warna |
| :--- | :--- | :--- | :--- |
| **Sidebar Background** | `#1e293b` | Dark Slate Blue | Memberikan kesan kokoh, stabil, profesional, dan nyaman di mata (kontras tinggi terhadap teks putih). |
| **Primary / Brand** | `#0284c7` | Sky Blue | Melambangkan kepercayaan (*trust*), efisiensi, dan kejelasan status navigasi aktif. |
| **Main Background** | `#f4f6f9` | Off-White / Soft Gray | Mencegah kelelahan mata (*eye strain*) dibanding warna putih murni (`#ffffff`). |
| **Status Ready / Sukses** | `#22c55e` | Emerald Green | Menandakan kondisi positif (Mobil Tersedia / Siap Dirental). |
| **Status Warning / Pending** | `#f59e0b` | Amber Yellow | Menandakan kondisi perhatian / dalam proses (Mobil Sedang Disewa). |
| **Status Perbaikan / Danger**| `#ef4444` | Rose Red | Menandakan kondisi kritis (Mobil dalam Perbaikan / Maintenance). |

---

## 4. Arsitektur Responsif (Mobile Adaptive)

Aplikasi ini dirancang menggunakan pendekatan **Desktop-First dengan Progressive Collapse**:

1. **Aturan Breakpoint (768px):**
   Standard lebar tablet/smartphone dipatok pada $768\text{px}$.
2. **Off-Canvas Sidebar:**
   Pada layar $\le 768\text{px}$, sidebar disembunyikan ke luar batas viewport sebelah kiri dengan CSS `transform: translateX(-100%)`. Saat tombol hamburger diklik, class `.active` ditambahkan via JavaScript untuk mengembalikan posisi ke `transform: translateX(0)`.
3. **Adaptive Grid (Stat Cards):**
   Menggunakan CSS Grid dengan properti `repeat(auto-fit, minmax(220px, 1fr))`. Di layar PC, kartu berjajar 4 kolom; di layar smartphone, kartu otomatis bertumpuk menjadi 1 kolom secara fleksibel.
4. **Table Horizontal Scrolling:**
   Tabel dibungkus di dalam kontainer `.card` yang memiliki aturan `overflow-x: auto` agar tabel tidak gepeng atau keluar dari layar HP.

---

## ❓ Simulasi Pertanyaan Dosen & Cara Menjawabnya

### Q1: "Mengapa kamu memisahkan file HTML ke dalam subfolder `buku/` dan `anggota/` daripada menumpuk semuanya di root?"
> **Jawaban:** "Penataan ini menerapkan prinsip *Separation of Concerns* dan keteraturan struktur file. Dengan memisahkan setiap modul ke foldernya masing-masing, pengelolaan kode menjadi lebih rapi, terstruktur, dan memudahkan tim developer jika aplikasi ini dikembangkan lebih besar di kemudian hari."

### Q2: "Kenapa aplikasi ini tidak menggunakan framework CSS seperti Bootstrap atau Tailwind?"
> **Jawaban:** "Aplikasi ini sengaja dibuat menggunakan *Native CSS3* untuk membuktikan pemahaman dasar yang kuat mengenai Box Model, CSS Flexbox, CSS Grid, Positioning, dan Kueri Media (`@media`). Selain itu, tanpa framework, ukuran file menjadi sangat kecil sehingga proses pemuatan halaman (*load time*) jauh lebih cepat."

### Q3: "Bagaimana sistem warna membantu operasional admin pada aplikasi ini?"
> **Jawaban:** "Warna pada aplikasi ini berfungsi sebagai *Visual Feedback*. Admin dapat langsung mengenali status ketersediaan unit tanpa harus membaca teks secara detail: warna hijau untuk unit siap rental, kuning untuk unit yang sedang berjalan disewa, dan merah untuk unit yang rusak/maintenance."