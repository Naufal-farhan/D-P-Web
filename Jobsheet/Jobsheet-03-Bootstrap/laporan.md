# Laporan Jobsheet-03 Bootstrap
### NAMA    : NAUFAL FARHAN NUR RAMADHAN
### NIM     : 254107020077
### KELAS   : TI-2D

<!-- SCREENSHOT 1: Tampilan indeks (desktop) — tampilkan halaman index.html versi Bootstrap di browser desktop, pastikan navbar melebar dan kartu statistik tampil berjajar -->
<!-- SCREENSHOT 2: Tampilan List Buku (desktop) — tampilkan halaman buku/list.html versi Bootstrap di browser desktop, pastikan tabel terlihat dengan styling Bootstrap -->
<!-- SCREENSHOT 3: Tampilan form tambah buku (desktop) — tampilkan halaman buku/tambah.html versi Bootstrap di browser desktop, pastikan form controls terlihat rapi -->
<!-- SCREENSHOT 4 (OPSIONAL): Tampilan navbar hamburger (mobile) — perkecil browser di bawah 992px, klik tombol hamburger, tampilkan menu navigasi yang terbuka -->
<!-- <img width="XXX" height="XXX" alt="image" src="URL_GITHUB_SCREENSHOT_HAMBURGER" /> -->

<!-- SCREENSHOT 5 (OPSIONAL): Tampilan tabel di mobile — perkecil browser di bawah 576px, tampilkan tabel dengan scroll horizontal aktif -->
<!-- <img width="XXX" height="XXX" alt="image" src="URL_GITHUB_SCREENSHOT_TABEL_MOBILE" /> -->

## Rangkuman dan Penjelasan

Pada Jobsheet-03 Bootstrap ini, kita membangun ulang seluruh halaman SIMPUS-Mini yang sebelumnya dibuat dengan CSS murni di Jobsheet-02 dan Jobsheet-03, tetapi kali ini memakai framework CSS **Bootstrap 5.3** yang dimuat dari CDN. Tujuannya adalah membandingkan seberapa cepat pengembangan dan seberapa ringkas kode ketika kita memakai class-class siap pakai dibanding menulis CSS sendiri dari nol.

### 1. Pemuatan Bootstrap dari CDN

Bootstrap dimuat langsung dari CDN jsDelivr dengan meletakkan tag berikut di dalam `<head>` pada setiap file HTML:

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
```

Cara ini berarti kita tidak perlu mengunduh file Bootstrap ke project lokal — browser pengunjung yang mengambil file CSS dari server CDN. Keuntungannya: tidak ada file framework yang perlu kita kelola, dan browser yang sudah pernah mengunjungi situs lain memakai CDN yang sama akan punya file Bootstrap di cache sehingga tidak perlu mengunduh ulang.

### 2. Navbar dengan class `navbar-expand-lg`

Header navigasi kini memakai komponen navbar Bootstrap:

```html
<header class="navbar navbar-expand-lg navbar-dark" style="background-color:#1d5b8a;">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="index.html">SIMPUS-Mini</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                ...
            </ul>
        </nav>
    </div>
</header>
```

Class `navbar-expand-lg` membuat navbar otomatis "terlipat" menjadi tombol hamburger di layar lebih kecil dari `992px`, dan kembali melebar di layar yang lebih besar. Ini menggantikan seluruh kode CSS hamburger checkbox hack manual dari Jobsheet-03 — cukup satu nama class, tanpa CSS tambahan sama sekali.

### 3. Grid kartu statistik dengan `col-12 col-md-4`

Kartu statistik di halaman indeks memakai sistem grid Bootstrap:

```html
<div class="row g-3 text-center">
    <div class="col-12 col-md-4">
        <div class="p-3 rounded-3" style="background-color:#eef4fa;">
            <h3 class="h6 text-secondary">Total Buku</h3>
            <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;">12</p>
        </div>
    </div>
    ...
</div>
```

`col-12` berarti setiap kartu mengisi seluruh lebar (12 kolom) di layar paling kecil, lalu `col-md-4` membuatnya berubah menjadi 4 kolom (sepertiga lebar) mulai breakpoint `768px`. Ini menggantikan `grid-template-columns: repeat(4, 1fr)` dan media query manual di style.css versi CSS murni — Bootstrap sudah mengatur responsivitasnya secara bawaan.

### 4. Tabel dengan `table table-striped table-hover`

Tabel daftar buku dan anggota memakai class Bootstrap:

```html
<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead style="background-color:#1d5b8a;">
            <tr class="text-white">
                <th>Judul</th>
                <th>Pengarang</th>
                ...
            </tr>
        </thead>
        ...
    </table>
</div>
```

`table-striped` memberikan warna selang-seling otomatis, `table-hover` menyorot baris saat kursor di atasnya, dan `table-responsive` menambahkan scroll horizontal di layar sempit. Semua efek ini sebelumnya ditulis manual dengan `tbody tr:nth-child(even)` dan `tbody tr:hover` di CSS murni.

### 5. Form dengan `form-control` dan `btn btn-primary`

Form tambah buku dan anggota memakai class form Bootstrap:

```html
<div class="mb-3">
    <label for="judul" class="form-label fw-semibold">Judul</label>
    <input type="text" class="form-control" id="judul" name="judul" required>
</div>
...
<button type="Submit" class="btn btn-primary">Submit</button>
```

Class `form-control` langsung memberikan styling input yang rapi (padding, border, radius, fokus), `form-label` mengatur label, dan `btn btn-primary` membuat tombol submit dengan warna tema Bootstrap. Tidak perlu menulis CSS form sama sekali.

### 6. Utility classes

Bootstrap menyediakan banyak utility class singkat yang menggantikan property CSS individual:

- `fw-semibold` — font-weight: 600
- `text-secondary` — warna teks abu-abu
- `text-white` — warna teks putih
- `fs-2` — ukuran font besar
- `mb-0`, `mb-3`, `mb-4` — margin bottom dengan skala
- `p-3` — padding
- `rounded-3` — border-radius
- `shadow-sm` — bayangan halus
- `ms-auto` — margin kiri otomatis (mendorong nav ke kanan)
- `text-center` — teks rata tengah
- `align-middle` — vertikal align tengah pada sel tabel

Semua ini ditulis langsung di HTML sebagai atribut `class`, tanpa perlu membuka file CSS terpisah.

### 7. Perbandingan dengan CSS murni

| Aspek | CSS Murni (Jobsheet-02/03) | Bootstrap (Jobsheet-03 Bootstrap) |
|---|---|---|
| Jumlah file CSS | 1 file `style.css` (~120 baris) | `style.css` hanya untuk override kecil + CDN |
| Navbar responsif | Checkbox hack + media query manual | 1 nama class `navbar-expand-lg` |
| Grid responsif | `grid-template-columns` + `@media` | `col-12 col-md-4` |
| Tabel zebra & hover | `:nth-child(even)` + `:hover` di CSS | `table-striped table-hover` |
| Form styling | ~25 baris CSS untuk form | `form-control` + `btn` class |
| Warna tema | Nilai hex manual di setiap selector | Utility class + override inline |
| Kecepatan开发 | Lambat (tulis CSS satu per satu) | Cepat (class siap pakai) |
| Ukuran unduhan | Kecil (1 file CSS) | Besar (CSS+JS Bootstrap dari CDN) |

Inti perbandingannya: Bootstrap menukar ukuran file yang lebih besar dengan kecepatan pengembangan yang jauh lebih cepat dan konsistensi visual yang lebih mudah dijaga.

---

## 4 Ide Latihan Tambahan (Opsional)

### 1. Ganti warna brand ke tema bawaan Bootstrap

Hapus semua `style="background-color:#1d5b8a;"` dan `style="color:#1d5b8a;"`, ganti dengan class bawaan Bootstrap seperti `.bg-primary` / `.text-primary`, lalu bandingkan seberapa banyak baris `style.css` yang jadi tidak diperlukan lagi.

**Lokasi yang perlu diubah:**

Di **`index.html`** — pada `<header>`:

```html
<!-- Sebelum -->
<header class="navbar navbar-expand-lg navbar-dark" style="background-color:#1d5b8a;">

<!-- Sesudah -->
<header class="navbar navbar-expand-lg navbar-dark bg-primary">
```

Di **`index.html`** — pada judul section:

```html
<!-- Sebelum -->
<h2 class="card-title mb-3" style="color:#1d5b8a;">Selamat Datang...</h2>

<!-- Sesudah -->
<h2 class="card-title mb-3 text-primary">Selamat Datang...</h2>
```

Di **`index.html`** — pada setiap kartu statistik (4 kartu), angka di dalam `<p>`:

```html
<!-- Sebelum -->
<p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;">12</p>

<!-- Sesudah -->
<p class="fs-2 fw-bold mb-0 text-primary">12</p>
```

Di **`buku/list.html`** dan **`anggota/list.html`** — pada `<thead>`:

```html
<!-- Sebelum -->
<thead style="background-color:#1d5b8a;">

<!-- Sesudah -->
<thead class="bg-primary">
```

Ulangi penggantian yang sama di **`buku/tambah.html`** dan **`anggota/tambah.html`** pada tag `<header>`.

Setelah penggantian, baris-baris berikut di `assets/css/style.css` menjadi tidak diperlukan lagi dan bisa dihapus:
- `section h2 { color: #1d5b8a; }` — warna judul section sudah ditangani `text-primary`
- Aturan `background-color` pada `header` — sudah ditangani `bg-primary`

### 2. Tambah breakpoint ketiga di grid kartu statistik

Sisipkan `col-sm-6` di antara `col-12` dan `col-md-4` supaya ada tampilan 2 kolom di breakpoint `sm`.

**Lokasi:** `index.html` — pada setiap `<div>` kartu statistik (4 kartu):

```html
<!-- Sebelum -->
<div class="col-12 col-md-4">

<!-- Sesudah -->
<div class="col-12 col-sm-6 col-md-4">
```

Hasilnya ada 3 tingkat progresi:
- `col-12` — 1 kolom (layar < 576px)
- `col-sm-6` — 2 kolom (layar 576px–767px)
- `col-md-4` — 3 kolom (layar ≥ 768px)

Ini meniru progresi 3 tingkat dari versi CSS murni Jobsheet-03 yang punya breakpoint 480px / 768px / 1800px.

### 3. Ganti breakpoint navbar dari `navbar-expand-lg` ke `navbar-expand-md`

**Lokasi:** semua file HTML — pada tag `<header>`:

```html
<!-- Sebelum -->
<header class="navbar navbar-expand-lg navbar-dark bg-primary">

<!-- Sesudah -->
<header class="navbar navbar-expand-md navbar-dark bg-primary">
```

Perbedaannya:
- `navbar-expand-lg` — navbar terlipat di **< 992px**
- `navbar-expand-md` — navbar terlipat di **< 768px**

Jadi dengan `navbar-expand-md`, navbar akan tetap melebar lebih lama sampai layar sekecil 768px baru berubah jadi hamburger. Ini membuktikan bahwa breakpoint Bootstrap bisa diganti hanya lewat nama class, tanpa CSS tambahan sama sekali.

### 4. Tambahkan komponen Bootstrap baru: `.badge` dan `.alert`

#### 4a. `.badge` untuk status stok di `buku/list.html`

Tambahkan kolom "Status" pada tabel dan pakai `.badge` untuk menandai "Tersedia"/"Kosong".

**Lokasi:** `buku/list.html` — pada `<thead>`, tambahkan satu `<th>`:

```html
<!-- Sebelum -->
<th>Aksi</th>

<!-- Sesudah -->
<th>Status</th>
<th>Aksi</th>
```

Lalu pada setiap baris `<tr>` di `<tbody>`, tambahkan `<td>` status sebelum `<td>` Aksi. Untuk buku dengan stok > 0:

```html
<!-- Tambahkan sebelum <td> Aksi -->
<td><span class="badge bg-success">Tersedia</span></td>
```

Untuk buku dengan stok = 0 (jika ada):

```html
<td><span class="badge bg-danger">Kosong</span></td>
```

Contoh penempatan lengkap pada satu baris:

```html
<tr>
    <td>Laskar Pelangi</td>
    <td>Andrea Hirata</td>
    <td>2005</td>
    <td>4</td>
    <td><span class="badge bg-success">Tersedia</span></td>
    <td>
        <button type="button" class="btn btn-warning btn-sm text-white">Edit</button>
        <button type="button" class="btn btn-info btn-sm text-white">Detail</button>
        <button type="button" class="btn btn-danger btn-sm text-white">Hapus</button>
    </td>
</tr>
```

#### 4b. `.alert` untuk pesan sukses setelah form disimpan

**Lokasi:** `buku/tambah.html` — tambahkan alert di atas `<form>`, di dalam `<main>`:

```html
<main>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data buku berhasil disimpan!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <form>
        ...
    </form>
</main>
```

Class `alert-success` memberikan kotak hijau dengan ikon centang, `alert-dismissible` + `btn-close` menambahkan tombol tutup (X), dan `fade show` memberikan animasi muncul/hilang. Ulangi pola yang sama di `anggota/tambah.html` jika ingin menambahkan pesan sukses di form anggota juga.

### 5. Bandingkan ukuran file (DevTools Network)

Buka DevTools (F12) → tab **Network** → refresh halaman `index.html` versi Bootstrap, lalu bandingkan dengan versi Jobsheet-03 CSS murni.

**Yang akan terlihat di versi Bootstrap:**
- `bootstrap.min.css` dari CDN — sekitar **~230 KB** (atau ~30 KB gzip)
- `bootstrap.bundle.min.js` dari CDN — sekitar **~80 KB** (jika dimuat)
- `style.css` lokal — sangat kecil, hanya override
- Total unduhan: **~310 KB+**

**Yang akan terlihat di versi CSS murni (Jobsheet-03):**
- `style.css` — sekitar **~3–5 KB**
- Total unduhan: **~3–5 KB**

**Diskusi trade-off:**

Bootstrap menambah sekitar 300 KB ukuran unduhan dibanding CSS murni. Namun pertukaran ini memberikan: pengembangan jauh lebih cepat (class siap pakai vs tulis CSS manual), responsivitas otomatis (navbar, grid, tabel), konsistensi visual (semua komponen mengikuti tema yang sama), dan komponen siap pakai (badge, alert, modal, dropdown, dll). Untuk project kecil seperti SIMPUS-Mini, CSS murni lebih hemat. Untuk project besar dengan banyak halaman dan komponen, Bootstrap menghemat waktu pengembangan yang jauh lebih bernilai daripada ukuran unduhan.
