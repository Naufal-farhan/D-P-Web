# Handbook CSS Final Jobsheet 06 — Memahami Per Bagian, Bukan Menghafal Baris

> **Tujuan:** memahami stylesheet final proyek rental mobil dengan bahasa sederhana, memakai contoh elemen HTML yang benar-benar ada, serta mengetahui kapan JavaScript ikut bekerja. Penjelasan mengikuti urutan CSS sumber `Jobsheet-06/assets/css/style.css`.

## Cara belajar dengan handbook ini

Setiap bagian memakai pola yang sama:

1. **Kegunaan bagian:** masalah tampilan apa yang sedang diselesaikan.
2. **Kode CSS utuh untuk bagian tersebut:** dibaca sebagai satu kesatuan.
3. **Penjelasan tiap baris deklarasi:** apa yang diatur dan bagaimana efeknya terlihat.
4. **Hubungan dengan HTML/JavaScript:** elemen mana yang menerima aturan tersebut, dan apakah ada script yang mengubah kelasnya.
5. **Cara membuktikan:** hal yang bisa kamu ubah di browser untuk menguji pemahaman.

Satu prinsip penting: CSS tidak membuat elemen HTML muncul dengan sendirinya. HTML menyediakan elemennya, CSS mengatur tampilannya, sedangkan JavaScript dapat mengubah kelas atau isi elemen. Tiga hal ini saling bekerja sama.

---

# 0. Sebelum membaca CSS: bagaimana file ini dipakai?

Di halaman dashboard (`index.html`), CSS dihubungkan dengan:

```html
<link rel="stylesheet" href="assets/css/style.css">
```

Di halaman yang berada di dalam folder `buku/` atau `anggota/`, jalurnya:

```html
<link rel="stylesheet" href="../assets/css/style.css">
```

**Artinya:** browser diminta membaca `style.css` dan menerapkan aturan di dalamnya. Perbedaan `../` terjadi karena halaman daftar/tambah berada satu folder lebih dalam daripada `index.html`.

Contoh elemen nyata pada HTML:

```html
<aside class="sidebar">
  <div class="brand"><h2>Sumber Lancar</h2></div>
  <ul class="nav-links">
    <li class="active"><a href="index.html">Dashboard</a></li>
  </ul>
</aside>

<div class="main-wrapper">
  <header class="topbar">
    <button class="menu-toggle" id="menu-toggle">☰</button>
    <div class="title">Sistem Manajemen Rental Mobil</div>
    <div class="user-info">Selamat Datang, <strong>Admin Staff</strong></div>
  </header>
  <main class="content-body">
    <h1 class="page-title">Dashboard Overview</h1>
  </main>
</div>
```

Ini gambaran sederhana struktur HTML. Selector CSS mencari elemen dari atribut/tag di atas. Misalnya `.sidebar` mencari elemen yang memiliki `class="sidebar"`, sedangkan `header` akan mencari semua elemen HTML bertag `<header>`.

## Kamus mini untuk membaca kode CSS

| Bentuk | Cara membacanya | Contoh dari proyek |
|---|---|---|
| `body` | Elemen HTML bernama `body` | Area dokumen utama |
| `.sidebar` | Elemen dengan class `sidebar` | Panel navigasi kiri |
| `#menu-toggle` | Elemen dengan ID `menu-toggle` | Tombol hamburger |
| `.sidebar .brand` | Elemen `.brand` yang berada di dalam `.sidebar` | Area nama/brand di sidebar |
| `.btn:hover` | Tombol ber-class `btn` saat pointer mouse berada di atasnya | Warna tombol berubah ketika diarahkan |
| `.sidebar.active` | Satu elemen yang punya **dua class sekaligus**, `sidebar` dan `active` | Sidebar dalam keadaan terbuka pada mobile |
| `.form-group input, .form-group select` | Selector dipisahkan koma berarti semua selector tersebut menerima aturan yang sama | Input dan dropdown dalam form |
| `@media (...)` | Aturan di dalamnya hanya aktif jika kondisi layar terpenuhi | Tata letak layar sampai 768 px |

**Cara membaca satu aturan:**

```css
.page-title {
  margin-bottom: 20px;
  font-size: 22px;
  color: #0f172a;
}
```

- `.page-title` menentukan **elemen mana** yang diatur.
- `margin-bottom: 20px;` menentukan jarak luar di bawah judul.
- `font-size: 22px;` menentukan ukuran teks.
- `color: #0f172a;` menentukan warna teks.
- `{` membuka kumpulan aturan; `}` menutup kumpulan aturan.
- Tanda `:` memisahkan nama properti dan nilainya; `;` mengakhiri satu deklarasi.

---

# Sesi 1 — Reset dasar dan fondasi halaman

Bagian sumber: kira-kira baris 1–14.

## 1.1 Reset seluruh elemen dengan `*`

### Kode

```css
/* Reset & Styling Dasar */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
```

### Penjelasan per baris

- `/* Reset & Styling Dasar */` adalah komentar untuk manusia yang membaca file. Browser tidak menerapkannya sebagai gaya. Komentar hanya memberi tahu bahwa bagian ini menyiapkan dasar tampilan.
- `* {` memakai selector universal `*`, artinya aturan ini berlaku ke hampir semua elemen HTML pada halaman, misalnya `<body>`, `<h1>`, `<p>`, `<table>`, `<button>`, dan `<input>`. Ini cara menyamakan aturan dasar sebelum memberi desain khusus.
- `margin: 0;` menghapus margin bawaan browser. Tanpanya, misalnya `<h1>` dan `<body>` dapat memiliki jarak luar bawaan yang membuat susunan elemen tidak dimulai persis dari tepi yang diharapkan.
- `padding: 0;` menghapus padding bawaan. Padding adalah ruang di dalam kotak elemen, di antara isi dan tepinya. Nanti padding ditambahkan kembali secara sengaja pada `.card`, `.topbar`, tombol, dan elemen lainnya.
- `box-sizing: border-box;` mengubah cara menghitung ukuran kotak. Dengan aturan ini, ketika kita memberi `width: 240px`, lebar tersebut sudah mencakup padding dan border. Ini memudahkan perhitungan layout agar elemen tidak melebar tanpa diduga.
- `font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;` mengatur keluarga font seluruh halaman. Browser mencoba `Segoe UI` lebih dulu; jika tidak tersedia, ia mencoba `Tahoma`, lalu `Geneva`, `Verdana`, dan akhirnya font sans-serif bawaan. Ini daftar cadangan, bukan berarti semua font ditampilkan bersamaan.
- `}` menutup aturan universal. Setelah kurung ini, aturan selanjutnya tidak lagi dianggap bagian dari `*`.

### Contoh penerapan

Tombol HTML seperti `<button class="btn btn-primary">Simpan</button>` juga menerima `margin: 0`, `padding: 0`, `box-sizing`, dan `font-family` dari aturan universal. Namun padding tombol kemudian diisi lagi oleh `.btn`. CSS khusus yang muncul belakangan dapat mengatur ulang properti yang sama.

### Cara menguji

Ubah sementara `padding: 0` menjadi `padding: 20px` di aturan universal. Banyak elemen akan memiliki ruang dalam besar sekaligus, sehingga layout tampak berantakan. Kembalikan ke `0` setelah melihat efeknya.

## 1.2 Menata elemen `body`

### Kode

```css
body {
  display: flex;
  background-color: #f4f6f9;
  color: #333;
  min-height: 100vh;
}
```

### Penjelasan per baris

- `body {` memilih elemen `<body>`, yaitu wadah utama konten halaman.
- `display: flex;` membuat anak langsung dari `body` disusun memakai Flexbox. Dalam HTML dashboard ini, anak utama adalah `<aside class="sidebar">` dan `<div class="main-wrapper">`. Aturan Flexbox membantu mengatur hubungan dua area itu dalam satu halaman.
- `background-color: #f4f6f9;` memberi warna latar abu-abu sangat muda di belakang area konten. Kode hex adalah cara menuliskan warna; `#f4f6f9` bukan nama kelas, melainkan nilai warna.
- `color: #333;` menetapkan warna teks standar menjadi abu-abu gelap. Elemen anak dapat mengganti warna ini, misalnya sidebar menggunakan `color: #f8fafc` dan tombol mengatur teks putih.
- `min-height: 100vh;` berarti tinggi minimum `body` sama dengan 100% tinggi area tampilan browser. `vh` adalah *viewport height*; `100vh` kira-kira setinggi layar yang terlihat. Konten masih boleh lebih tinggi dan halaman tetap dapat di-scroll.
- `}` menutup aturan `body`.

### Hubungannya dengan layout

Sidebar memakai `position: fixed` di aturan berikutnya sehingga ditempel ke tepi layar. `main-wrapper` diberi margin kiri 240px untuk menyediakan ruang bagi sidebar tersebut. Warna latar `body` tampak pada sela-sela yang tidak ditutup kartu putih.

---

# Sesi 2 — Sidebar: navigasi utama di sebelah kiri

Sidebar adalah panel yang berisi nama aplikasi dan tautan berpindah halaman. Dalam HTML, komponen utamanya adalah `<aside class="sidebar">`.

## 2.1 Bentuk dan posisi sidebar

### Kode

```css
/* Sidebar Navigasi */
.sidebar {
  width: 240px;
  background-color: #1e293b;
  color: #f8fafc;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-direction: column;
}
```

### Penjelasan per baris

- Komentar `/* Sidebar Navigasi */` memberi nama pada kelompok aturan.
- `.sidebar {` memilih elemen apa pun yang memiliki class `sidebar`. Di halaman, ini adalah `<aside class="sidebar">`; titik `.` berarti class.
- `width: 240px;` memberi sidebar lebar 240 piksel pada tampilan desktop. `px` adalah satuan piksel CSS.
- `background-color: #1e293b;` memberi latar biru keabu-abuan gelap. Warna ini membuat sidebar terlihat berbeda dari area konten yang terang.
- `color: #f8fafc;` memberi warna teks default yang terang kepada konten di dalam sidebar. Beberapa anak, seperti tautan navigasi, mengatur warna sendiri sehingga aturan anak tersebut yang terlihat.
- `position: fixed;` mengeluarkan sidebar dari alur layout normal dan menempatkannya relatif terhadap viewport browser. Saat halaman digulir, sidebar tetap berada di tempatnya.
- `top: 0;` menempelkan sisi atas sidebar ke tepi atas viewport.
- `bottom: 0;` menempelkan sisi bawah sidebar ke tepi bawah viewport. Bersama `top: 0`, sidebar memenuhi tinggi layar.
- `left: 0;` menempelkan sidebar ke sisi kiri viewport.
- `display: flex;` membuat anak langsung sidebar menjadi item Flexbox. Anak itu mencakup area brand dan daftar tautan.
- `flex-direction: column;` menyusun anak Flexbox dari atas ke bawah. Jadi area brand berada di atas daftar menu, bukan berdampingan.
- `}` menutup aturan sidebar.

### Ilustrasi struktur

```html
<aside class="sidebar">
  <div class="brand">...</div>
  <ul class="nav-links">...</ul>
</aside>
```

`.sidebar` mengatur seluruh panel luar. Untuk memberi gaya yang berbeda kepada area brand atau daftar menu, stylesheet menggunakan selector yang lebih spesifik pada sesi berikutnya.

### Mengapa ada `margin-left: 240px` di bagian lain?

Karena sidebar `fixed` tidak mengambil tempat seperti elemen biasa dalam alur halaman. Tanpa ruang pengganti, konten utama dapat mulai dari sisi kiri dan berada di bawah sidebar. `main-wrapper` karena itu diberi margin kiri 240px, sama dengan lebar sidebar desktop.

## 2.2 Area nama aplikasi (`.brand`)

### Kode

```css
.sidebar .brand {
  padding: 20px;
  background-color: #0f172a;
  text-align: center;
}
```

### Penjelasan per baris

- `.sidebar .brand` berarti: pilih elemen dengan class `brand` yang berada di dalam elemen ber-class `sidebar`. Ini lebih khusus daripada `.brand` saja. Pada HTML, targetnya `<div class="brand">` di dalam `<aside class="sidebar">`.
- `padding: 20px;` memberi ruang 20px di semua sisi area brand. Teks nama aplikasi tidak menempel ke pinggir kotak.
- `background-color: #0f172a;` memberi brand latar yang lebih gelap daripada latar sidebar, sehingga bagian identitas terlihat terpisah.
- `text-align: center;` meratakan isi teks secara horizontal ke tengah. Ini bukan untuk memusatkan seluruh elemen sidebar, hanya teks/isi inline di area brand.
- `}` menutup aturan brand.

## 2.3 Judul di dalam brand

### Kode

```css
.sidebar .brand h2 {
  font-size: 18px;
  color: #38bdf8;
}
```

### Penjelasan per baris

- `.sidebar .brand h2` mencari elemen `<h2>` yang berada di dalam `.brand`, dan `.brand` itu berada di dalam `.sidebar`. Aturan tidak otomatis mengenai semua `<h2>` di bagian utama halaman.
- `font-size: 18px;` membuat tulisan nama/brand berukuran 18px.
- `color: #38bdf8;` memberi teks warna biru muda sehingga kontras dengan latar gelap.
- `}` menutup aturan judul brand.

Jika elemen `<h2>` tidak berada di dalam `.brand` dan `.sidebar`, aturan ini tidak cocok dengannya. Selector mempertimbangkan letak elemen, bukan hanya nama tag.

## 2.4 Daftar menu (`.nav-links`)

### Kode

```css
.sidebar .nav-links {
  list-style: none;
  margin-top: 15px;
}
```

### Penjelasan per baris

- `.sidebar .nav-links` memilih daftar, umumnya `<ul class="nav-links">`, yang berada di sidebar.
- `list-style: none;` menghilangkan bullet/titik standar dari item `<ul>`. Tanpa aturan ini, browser biasanya menampilkan bullet daftar.
- `margin-top: 15px;` memberi jarak luar 15px di atas daftar, sehingga menu tidak langsung menempel pada area brand.
- `}` menutup aturan daftar menu.

## 2.5 Bentuk setiap tautan navigasi

### Kode

```css
.sidebar .nav-links li a {
  display: block;
  padding: 14px 20px;
  color: #94a3b8;
  text-decoration: none;
  font-size: 15px;
  transition: all 0.2s;
}
```

### Penjelasan per baris

- `.sidebar .nav-links li a` memilih tautan `<a>` yang berada di dalam `<li>`, di dalam daftar `.nav-links`, di dalam `.sidebar`. Jadi tautan menu seperti Dashboard atau Data Mobil mendapat gaya ini.
- `display: block;` membuat tautan menjadi elemen blok. Area klik jadi mencakup lebar yang tersedia, bukan hanya lebar teksnya, sehingga pengguna lebih mudah mengklik baris menu.
- `padding: 14px 20px;` memberi ruang atas/bawah 14px dan kiri/kanan 20px. Dalam shorthand dua nilai, nilai pertama berlaku vertikal dan nilai kedua horizontal.
- `color: #94a3b8;` memberi warna abu-abu kebiruan pada tautan menu saat normal.
- `text-decoration: none;` menghilangkan garis bawah bawaan pada tautan `<a>`.
- `font-size: 15px;` menentukan ukuran teks menu.
- `transition: all 0.2s;` meminta perubahan properti yang mendukung animasi terjadi selama 0,2 detik. Di sini perubahan warna/latar saat hover terasa halus, bukan berganti mendadak. `all` berarti semua properti yang berubah dan dapat dianimasikan.
- `}` menutup aturan tautan.

## 2.6 Efek hover dan penanda halaman aktif

### Kode

```css
.sidebar .nav-links li a:hover,
.sidebar .nav-links li.active a {
  background-color: #334155;
  color: #fff;
  border-left: 4px solid #38bdf8;
}
```

### Penjelasan per baris

- Selector baris pertama, `.sidebar .nav-links li a:hover`, berlaku saat pointer mouse berada di atas tautan menu. `:hover` adalah *pseudo-class* CSS; bukan class yang perlu ditulis ke HTML.
- Koma `,` artinya selector setelahnya menerima kelompok aturan yang sama.
- Selector kedua, `.sidebar .nav-links li.active a`, mencari tautan di dalam `<li>` yang memiliki class `active`. Contoh HTML: `<li class="active"><a href="index.html">Dashboard</a></li>`. Di versi proyek ini, penanda aktif halaman ditulis lewat class HTML, bukan otomatis ditentukan oleh CSS.
- `background-color: #334155;` membuat latar item yang disentuh/aktif menjadi sedikit lebih terang daripada sidebar.
- `color: #fff;` membuat teks putih.
- `border-left: 4px solid #38bdf8;` memberi garis tebal 4px berwarna biru di sisi kiri untuk memperjelas item yang dipilih.
- `}` menutup kelompok aturan. Aturan ini berlaku untuk dua keadaan: tautan sedang di-hover **atau** berada dalam item `active`.

### Apakah JavaScript yang membuat menu aktif?

Pada versi ini, class `active` di item menu sudah terdapat di HTML untuk menandai halaman, misalnya Dashboard. JavaScript `app.js` terutama menambah/menghapus class `active` pada **sidebar itu sendiri** untuk membuka atau menutup menu mobile. Karena konteks elemennya berbeda, `.sidebar .nav-links li.active a` dan `.sidebar.active` memiliki fungsi berbeda.

---

# Sesi 3 — Area utama, topbar, dan konten

## 3.1 Pembungkus konten utama (`.main-wrapper`)

### Kode

```css
/* Main Area Wrapper */
.main-wrapper {
  margin-left: 240px;
  width: calc(100% - 240px);
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
```

### Penjelasan per baris

- Komentar menandai bahwa aturan selanjutnya membentuk pembungkus area utama.
- `.main-wrapper` memilih `<div class="main-wrapper">` yang menampung topbar dan konten halaman.
- `margin-left: 240px;` memberi jarak luar di sebelah kiri sebesar 240px. Ini menyediakan tempat bagi sidebar fixed yang juga selebar 240px pada desktop.
- `width: calc(100% - 240px);` menghitung lebar pembungkus: lebar induk (`100%`) dikurangi 240px untuk sidebar. `calc()` memungkinkan perhitungan dalam CSS. Tujuannya supaya area utama mengisi ruang selain sidebar.
- `display: flex;` membuat anak langsung `.main-wrapper` menjadi item Flexbox. Anak yang penting adalah `<header class="topbar">` dan `<main class="content-body">`.
- `flex-direction: column;` menyusun topbar di atas konten utama.
- `min-height: 100vh;` menjaga pembungkus setidaknya setinggi layar. Bila konten panjang, tinggi boleh bertambah.
- `}` menutup aturan wrapper.

## 3.2 Baris bagian atas (`.topbar`)

### Kode

```css
/* Header Topbar */
.topbar {
  background-color: #fff;
  height: 60px;
  padding: 0 30px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}
```

### Penjelasan per baris

- `.topbar` menargetkan `<header class="topbar">` yang berisi tombol menu, judul aplikasi, dan informasi pengguna.
- `background-color: #fff;` membuat latar putih. `#fff` adalah bentuk singkat dari warna putih `#ffffff`.
- `height: 60px;` menetapkan tinggi topbar 60px.
- `padding: 0 30px;` mengatur padding atas/bawah menjadi 0 dan kiri/kanan 30px. Isi header memiliki jarak dari pinggir kiri dan kanan.
- `display: flex;` menata anak header dalam satu baris Flexbox. Ini membantu tombol menu, judul, dan informasi admin berada berdampingan.
- `align-items: center;` memusatkan anak secara vertikal di dalam baris 60px.
- `justify-content: space-between;` menempatkan item pertama dekat sisi kiri dan item terakhir dekat sisi kanan, dengan ruang yang dibagikan di antaranya. Karena itu, judul dan informasi pengguna tidak menumpuk di satu sisi pada ruang yang cukup.
- `box-shadow: 0 1px 3px rgba(0,0,0,0.08);` memberi bayangan lembut di bawah/sekitar topbar. Urutan angka adalah pergeseran horizontal `0`, pergeseran vertikal `1px`, blur `3px`; `rgba(0,0,0,0.08)` berarti hitam dengan opasitas 8%, jadi bayangannya sangat ringan.
- `}` menutup aturan topbar.

## 3.3 Judul pada topbar

### Kode

```css
.topbar .title {
  font-size: 18px;
  font-weight: 600;
  color: #1e293b;
}
```

### Penjelasan per baris

- `.topbar .title` hanya memilih elemen `.title` yang berada di dalam `.topbar`. Ini terkait dengan `<div class="title">Sistem Manajemen Rental Mobil</div>`.
- `font-size: 18px;` menentukan ukuran teks judul.
- `font-weight: 600;` membuat teks lebih tebal dari normal. Skala umum CSS ialah 400 normal, 600 semi-bold, dan 700 bold, tergantung font yang tersedia.
- `color: #1e293b;` memberi warna gelap yang kontras dengan topbar putih.
- `}` menutup aturan judul.

## 3.4 Informasi pengguna

### Kode

```css
.topbar .user-info {
  font-size: 14px;
  color: #64748b;
}
```

### Penjelasan per baris

- `.topbar .user-info` memilih `<div class="user-info">` di dalam topbar, yang saat ini menampilkan teks sambutan dan nama contoh admin.
- `font-size: 14px;` membuatnya lebih kecil daripada judul 18px agar bukan fokus utama.
- `color: #64748b;` memberinya warna abu-abu kebiruan yang lembut.
- `}` menutup aturan tersebut. Pada ukuran mobile, bagian ini disembunyikan oleh media query yang dijelaskan nanti.

## 3.5 Ruang konten utama

### Kode

```css
/* Area Konten Utama */
.content-body {
  padding: 25px 30px;
  flex: 1;
}
```

### Penjelasan per baris

- `.content-body` memilih `<main class="content-body">`, tempat judul halaman, kartu statistik, tabel, atau form diletakkan.
- `padding: 25px 30px;` memberi ruang dalam 25px di atas/bawah dan 30px di kiri/kanan. Tujuannya membuat konten tidak menempel pada topbar dan tepi layar.
- `flex: 1;` membuat area konten mengambil ruang sisa dalam `.main-wrapper` yang memakai Flexbox kolom. Dengan begitu, wrapper dapat memenuhi tinggi layar meski konten sedikit.
- `}` menutup aturan area konten.

## 3.6 Judul halaman

### Kode

```css
.page-title {
  margin-bottom: 20px;
  font-size: 22px;
  color: #0f172a;
}
```

### Penjelasan per baris

- `.page-title` memilih elemen yang mempunyai class ini. Contoh ada `<h1 class="page-title">Dashboard Overview</h1>` dan judul daftar mobil/pelanggan.
- `margin-bottom: 20px;` memberi jarak luar 20px di bawah judul supaya tidak terlalu menempel ke komponen berikutnya.
- `font-size: 22px;` menjadikan judul halaman cukup menonjol dibanding teks tabel 14px.
- `color: #0f172a;` mengatur warna judul menjadi gelap.
- `}` menutup aturan judul.

**Catatan:** pada judul di halaman tabel, HTML memuat `style="margin: 0;"`. Gaya inline ini menimpa `margin-bottom: 20px` pada elemen tersebut, karena inline style memiliki prioritas lebih kuat pada properti yang sama. Karena itu judul tabel dapat tampil tanpa jarak bawah bawaan `.page-title`.

---

# Sesi 4 — Kartu dan header kartu

Kartu (`card`) adalah kotak putih untuk mengelompokkan konten, misalnya tabel daftar mobil atau form tambah data.

## 4.1 Kotak umum `.card`

### Kode

```css
/* Card Container */
.card {
  background-color: #fff;
  border-radius: 8px;
  padding: 24px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  margin-bottom: 25px;
}
```

### Penjelasan per baris

- `.card` memilih elemen yang memiliki class `card`. Di halaman daftar, tabel dibungkus oleh `<div class="card">`. Form tambah menggunakan `<div class="card form-container">`, sehingga elemen itu menerima aturan `.card` dan `.form-container` sekaligus.
- `background-color: #fff;` memberi kartu latar putih agar berbeda dari latar halaman abu-abu.
- `border-radius: 8px;` membulatkan sudut kartu dengan radius 8px. Ini bentuk visual, bukan mengubah data atau ukuran konten secara langsung.
- `padding: 24px;` memberikan ruang di dalam kartu agar tabel dan teks tidak menempel pada tepi.
- `box-shadow: 0 2px 6px rgba(0,0,0,0.04);` memberi bayangan sangat halus dengan pergeseran vertikal 2px, blur 6px, dan opasitas 4% hitam. Hasilnya kartu terasa terangkat dari latar.
- `margin-bottom: 25px;` memberi jarak luar bawah 25px apabila ada komponen setelah kartu.
- `}` menutup aturan kartu.

## 4.2 Baris kepala kartu `.card-header`

### Kode

```css
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 1px solid #f1f5f9;
}
```

### Penjelasan per baris

- `.card-header` memilih elemen kepala kartu, misalnya `<div class="card-header">` yang berisi judul daftar dan tombol “Tambah”.
- `display: flex;` membuat elemen anak tersusun dalam satu baris.
- `justify-content: space-between;` mendorong satu elemen ke sisi kiri dan elemen lain ke sisi kanan. Dalam halaman daftar, judul berada di kiri dan tautan tambah berada di kanan.
- `align-items: center;` membuat keduanya sejajar secara vertikal.
- `margin-bottom: 20px;` memberi jarak luar di bawah header sebelum tabel.
- `padding-bottom: 12px;` memberi ruang dalam antara isi header dan garis bawah.
- `border-bottom: 1px solid #f1f5f9;` menggambar garis pemisah setebal 1px di bawah header dengan warna sangat muda.
- `}` menutup aturan kepala kartu.

### Cara menguji

Pada halaman daftar mobil, lihat judul dan tombol tambah dalam satu baris. Jika `justify-content: space-between` diubah menjadi `flex-start`, keduanya akan berdempetan di sisi kiri kecuali ada aturan lain yang mengatur jaraknya.

---

# Sesi 5 — Sistem tombol: bentuk dasar dan variasi warna

HTML proyek memakai kombinasi beberapa class, misalnya:

```html
<a href="tambah.html" class="btn btn-primary">+ Tambah Mobil Baru</a>
<button class="btn btn-warning btn-sm">Edit</button>
<button class="btn btn-danger btn-sm">Hapus</button>
<a href="list.html" class="btn btn-secondary">Batal</a>
```

Satu elemen dapat memiliki beberapa class. `btn btn-primary` berarti tombol menerima aturan umum `.btn` **dan** aturan warna `.btn-primary`. Untuk tombol Edit, ada tiga kelas: `btn`, `btn-warning`, dan `btn-sm`.

## 5.1 Bentuk umum semua tombol (`.btn`)

### Kode

```css
/* Style Tombol */
.btn {
  display: inline-block;
  padding: 9px 18px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  border: none;
  transition: all 0.2s;
}
```

### Penjelasan per baris

- `.btn` memilih semua elemen yang memakai class `btn`, baik `<a>` maupun `<button>`.
- `display: inline-block;` membuat elemen dapat berada sejajar dengan teks/elemen lain tetapi tetap dapat diatur padding dan dimensinya layaknya blok kecil. Berguna untuk link yang dijadikan tombol.
- `padding: 9px 18px;` memberi ruang dalam 9px vertikal dan 18px horizontal, membuat area tombol lebih besar daripada teksnya.
- `border-radius: 6px;` membulatkan sudut tombol.
- `text-decoration: none;` menghapus garis bawah jika tombol dibentuk dari elemen tautan `<a>`.
- `font-size: 14px;` menetapkan ukuran teks standar tombol.
- `font-weight: 500;` membuat teks agak tebal agar label terlihat jelas.
- `cursor: pointer;` meminta kursor berubah menjadi tangan penunjuk ketika diarahkan ke elemen, memberi isyarat visual bahwa elemen bisa diklik. Properti ini **tidak membuat tombol berfungsi sendiri**.
- `border: none;` menghapus border bawaan browser.
- `transition: all 0.2s;` menghaluskan perubahan gaya, seperti perubahan warna saat hover.
- `}` menutup gaya dasar. Warna tidak ditetapkan di sini karena akan diberikan oleh kelas variasi.

## 5.2 Tombol utama (`.btn-primary`)

### Kode

```css
.btn-primary {
  background-color: #0284c7;
  color: #fff;
}
.btn-primary:hover {
  background-color: #0369a1;
}
```

### Penjelasan per baris

- `.btn-primary` memilih elemen yang memiliki class `btn-primary`, misalnya link “Tambah Mobil Baru” dan tombol “Simpan”. Biasanya elemen tersebut juga mempunyai class `btn` untuk menerima bentuk umum.
- `background-color: #0284c7;` memberi latar biru sebagai warna utama untuk aksi penting.
- `color: #fff;` membuat teksnya putih.
- Kurung penutup menutup gaya normal tombol utama.
- `.btn-primary:hover` memilih tombol utama saat mouse diarahkan di atasnya.
- `background-color: #0369a1;` menggelapkan warna biru saat hover sehingga pengguna mendapatkan tanda visual.
- Tidak ada JavaScript yang dibutuhkan hanya untuk efek warna hover ini; browser menerapkan pseudo-class CSS `:hover`.

## 5.3 Tombol sekunder (`.btn-secondary`)

### Kode

```css
.btn-secondary {
  background-color: #64748b;
  color: #fff;
}
.btn-secondary:hover {
  background-color: #475569;
}
```

### Penjelasan per baris

- `.btn-secondary` menargetkan tombol dengan class sekunder, seperti tautan “Batal”.
- `background-color: #64748b;` memberi latar abu-abu kebiruan.
- `color: #fff;` membuat teks putih.
- `.btn-secondary:hover` hanya aktif ketika pointer berada di atas tombol sekunder.
- `background-color: #475569;` menggelapkan latar saat hover.

## 5.4 Tombol peringatan (`.btn-warning`)

### Kode

```css
.btn-warning {
  background-color: #f59e0b;
  color: #fff;
}
.btn-warning:hover {
  background-color: #d97706;
}
```

### Penjelasan per baris

- `.btn-warning` dipakai pada tombol Edit di tabel contoh.
- `background-color: #f59e0b;` membuat warna latar oranye/kuning tua.
- `color: #fff;` menetapkan teks putih.
- `.btn-warning:hover` menentukan keadaan saat pointer berada di atas tombol tersebut.
- `background-color: #d97706;` memberi warna yang lebih gelap pada keadaan hover.

## 5.5 Tombol berbahaya (`.btn-danger`)

### Kode

```css
.btn-danger {
  background-color: #ef4444;
  color: #fff;
}
.btn-danger:hover {
  background-color: #dc2626;
}
```

### Penjelasan per baris

- `.btn-danger` dipakai pada tombol Hapus. Penamaan `danger` adalah konvensi desain untuk aksi berisiko/destruktif.
- `background-color: #ef4444;` membuat latar merah.
- `color: #fff;` membuat label Hapus berwarna putih.
- `.btn-danger:hover` berlaku ketika pointer diarahkan ke tombol Hapus.
- `background-color: #dc2626;` menggelapkan merah sebagai umpan balik visual.

**Penting:** warna merah tidak membuat tombol menghapus data. CSS hanya menata tampilan. Apakah tindakan hapus benar-benar terjadi ditentukan HTML/JavaScript/backend. Pada proyek ini tombol aksi masih menampilkan alert contoh, bukan menghapus data permanen.

## 5.6 Tombol kecil (`.btn-sm`)

### Kode

```css
.btn-sm {
  padding: 5px 10px;
  font-size: 12px;
}
```

### Penjelasan per baris

- `.btn-sm` dipakai bersama kelas lain untuk mengecilkan tombol tabel agar tombol Edit dan Hapus muat di dalam kolom Aksi.
- `padding: 5px 10px;` mengganti padding tombol umum menjadi 5px vertikal dan 10px horizontal.
- `font-size: 12px;` membuat teks lebih kecil daripada tombol biasa 14px.
- Karena `.btn-sm` tidak mendefinisikan warna, warna tetap datang dari `.btn-warning` atau `.btn-danger`.

---

# Sesi 6 — Tabel data mobil dan pelanggan

Contoh HTML:

```html
<table id="table-buku">
  <thead>
    <tr><th>ID</th><th>Nama/Merk</th><th>Status</th></tr>
  </thead>
  <tbody id="list-buku">
    <tr><td>MBL-001</td><td>Honda Brio</td><td>Tersedia</td></tr>
  </tbody>
</table>
```

Tabel pelanggan memiliki pola yang serupa. Pada Jobsheet 06, JavaScript mengisi `<tbody id="list-buku">` dan `<tbody id="list-anggota">` dari file JSON. CSS di bawah menata tabel yang sudah ada, tidak mengambil datanya.

## 6.1 Ukuran dan bentuk umum tabel

### Kode

```css
/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
```

### Penjelasan per baris

- `table` tanpa titik memilih semua tag `<table>` di halaman, termasuk tabel mobil, pelanggan, dan tabel ringkasan di dashboard.
- `width: 100%;` meminta tabel menggunakan seluruh lebar area induknya yang tersedia.
- `border-collapse: collapse;` menyatukan border sel yang bersebelahan agar tidak tampak sebagai dua garis terpisah. Hasilnya tabel terlihat lebih bersih.
- `margin-top: 10px;` memberi jarak luar 10px di atas tabel, sehingga tabel tidak langsung menempel pada bagian di atasnya.
- `}` menutup aturan umum tabel.

## 6.2 Sel judul (`th`) dan sel data (`td`)

### Kode

```css
table th, table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #f1f5f9;
  font-size: 14px;
}
```

### Penjelasan per baris

- `table th, table td` memiliki dua selector yang dipisahkan koma. Aturan berlaku bagi semua `<th>` (sel judul kolom) dan `<td>` (sel isi data) yang berada di dalam tabel.
- `padding: 12px 15px;` memberi ruang vertikal 12px dan horizontal 15px di setiap sel. Ini mencegah teks terlihat sesak.
- `text-align: left;` meratakan teks ke kiri. Ini membuat isi kolom mudah dibaca, meski angka tertentu kadang bisa lebih cocok diratakan ke kanan.
- `border-bottom: 1px solid #f1f5f9;` memberi garis pemisah tipis di bawah setiap sel, dengan warna sangat terang.
- `font-size: 14px;` mengatur ukuran teks isi dan judul sel pada ukuran 14px.
- `}` menutup aturan bersama untuk sel tabel.

## 6.3 Tampilan khusus judul kolom (`th`)

### Kode

```css
table th {
  background-color: #f8fafc;
  color: #475569;
  font-weight: 600;
}
```

### Penjelasan per baris

- `table th` hanya memilih `<th>` di dalam tabel; sel `<td>` tidak mendapat tiga aturan khusus ini.
- `background-color: #f8fafc;` memberi latar sangat terang pada kepala tabel.
- `color: #475569;` membuat teks kepala kolom abu-abu gelap.
- `font-weight: 600;` membuat label kolom lebih tebal agar dapat dibedakan dari data.
- `}` menutup aturan kepala tabel.

## 6.4 Sorotan baris ketika ditunjuk

### Kode

```css
table tr:hover {
  background-color: #f8fafc;
}
```

### Penjelasan per baris

- `table tr:hover` memilih baris `<tr>` di dalam tabel ketika pointer berada di atasnya.
- `background-color: #f8fafc;` mengubah latar baris menjadi abu-abu muda. Ini membantu mata mengikuti baris yang sedang dilihat.
- `}` menutup aturan hover tabel.

Efek ini hanya perubahan tampilan sementara. Ia tidak memilih atau mengubah data pada JSON.

---

# Sesi 7 — Badge/status kecil

Badge adalah label pendek, seperti “Tersedia”, “Disewa”, “Berjalan”, atau “Selesai”. Pada HTML, contoh pemakaiannya:

```html
<span class="badge badge-success">Tersedia</span>
<span class="badge badge-warning">Berjalan</span>
```

## 7.1 Bentuk semua badge

### Kode

```css
/* Badge Status */
.badge {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
}
```

### Penjelasan per baris

- Komentar `/* Badge Status */` menamai bagian ini.
- `.badge` memilih elemen yang memiliki class `badge`, misalnya `<span>` pada kolom Status tabel.
- `padding: 4px 8px;` menambahkan ruang di dalam label: 4px atas/bawah, 8px kiri/kanan.
- `border-radius: 4px;` membuat sudut label sedikit membulat.
- `font-size: 12px;` mengecilkan teks karena badge hanyalah penanda status, bukan judul utama.
- `font-weight: 600;` membuat teks tebal supaya label mudah terlihat.
- `}` menutup gaya dasar. Warna latar dan teks diberikan kelas tambahan.

## 7.2 Badge sukses

### Kode

```css
.badge-success {
  background-color: #dcfce7;
  color: #166534;
}
```

- `.badge-success` memilih elemen yang juga memiliki class tersebut, misalnya `class="badge badge-success"`.
- `background-color: #dcfce7;` memberi latar hijau pucat.
- `color: #166534;` memberi teks hijau gelap sehingga terbaca di atas latar terang.
- `}` menutup aturan variasi sukses.

## 7.3 Badge peringatan

### Kode

```css
.badge-warning {
  background-color: #fef3c7;
  color: #92400e;
}
```

- `.badge-warning` digunakan untuk status/peringatan seperti “Disewa” atau “Berjalan”, tergantung isi HTML/data.
- `background-color: #fef3c7;` memberi latar kuning lembut.
- `color: #92400e;` memberi teks cokelat tua.
- `}` menutup aturan.

### Temuan penting tentang `.badge-danger`

JavaScript Jobsheet 06 dapat membuat class `badge-danger` untuk status mobil selain `Tersedia` dan `Disewa`. Akan tetapi, stylesheet final ini **tidak mendefinisikan `.badge-danger`**. Akibatnya label tersebut masih mendapatkan ukuran/padding dari `.badge`, tetapi tidak mendapat warna merah khusus dari CSS ini. Jika ingin menambahkannya, contoh berikut adalah **saran perbaikan, bukan kode yang saat ini sudah ada**:

```css
.badge-danger {
  background-color: #fee2e2;
  color: #991b1b;
}
```

---

# Sesi 8 — Form tambah mobil dan pelanggan

Halaman tambah data memakai struktur seperti ini:

```html
<div class="card form-container">
  <h1 class="page-title">Tambah Data Mobil</h1>
  <form id="form-tambah-buku">
    <div class="form-group">
      <label for="merk">Merk Mobil</label>
      <input id="merk" name="merk" type="text" required>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Simpan Mobil</button>
      <a href="list.html" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
```

Form pelanggan menggunakan pola serupa, dengan input nama, NIK, telepon, dan alamat. Contoh di atas disederhanakan agar fokus pada kelas yang dicari CSS.

## 8.1 Lebar maksimal area form

### Kode

```css
/* Form Styles */
.form-container {
  max-width: 650px;
}
```

### Penjelasan

- Komentar menandai awal kelompok form.
- `.form-container` memilih elemen yang memiliki class `form-container`. Pada HTML, class ini digabung dengan `card`: `<div class="card form-container">`. Artinya kedua kelompok aturan diterapkan pada elemen yang sama.
- `max-width: 650px;` membatasi lebar maksimal wadah form menjadi 650px. Form tidak terus melebar di layar desktop yang sangat lebar, sehingga label dan input tetap nyaman dibaca. `max-width` bukan selalu membuat elemen selebar 650px; jika ruang induk lebih sempit, elemen tetap dibatasi oleh ruang yang tersedia.
- `}` menutup aturan.

## 8.2 Jarak antar kelompok input

### Kode

```css
.form-group {
  margin-bottom: 18px;
}
```

### Penjelasan

- `.form-group` memilih setiap pembungkus kelompok label dan input, misalnya `<div class="form-group">`.
- `margin-bottom: 18px;` memberi jarak di bawah satu kelompok form sebelum kelompok berikutnya. Tanpa jarak ini, kolom-kolom form terlihat bertumpuk.
- `}` menutup aturan.

## 8.3 Label form

### Kode

```css
.form-group label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
  font-weight: 500;
  color: #334155;
}
```

### Penjelasan per baris

- `.form-group label` memilih tag `<label>` yang berada di dalam `.form-group`. Selector ini tidak mengubah semua label di semua bagian website.
- `display: block;` membuat label mengambil satu baris sendiri, sehingga input biasanya muncul di bawahnya.
- `margin-bottom: 6px;` memberi jarak antara label dan kotak input yang mengikutinya.
- `font-size: 14px;` menetapkan ukuran teks label.
- `font-weight: 500;` memberi ketebalan sedang supaya label jelas tetapi tidak bersaing dengan judul halaman.
- `color: #334155;` memberi warna teks abu-abu gelap.
- `}` menutup aturan label.

## 8.4 Input, dropdown, dan textarea

### Kode

```css
.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  font-size: 14px;
  outline: none;
  background-color: #fff;
  transition: border-color 0.2s, box-shadow 0.2s;
}
```

### Penjelasan per baris

- `.form-group input,` memilih tag `<input>` di dalam kelompok form.
- `.form-group select,` memilih dropdown `<select>` di dalam kelompok form. Koma menyatukan beberapa selector supaya gaya tidak harus ditulis tiga kali.
- `.form-group textarea {` menambahkan `<textarea>` sebagai target ketiga, lalu membuka kumpulan deklarasi yang dipakai ketiganya.
- `width: 100%;` membuat kolom memakai seluruh lebar area induk `.form-group`. Inilah sebabnya input rata sejajar kiri dan kanannya.
- `padding: 10px 14px;` memberi ruang vertikal 10px dan horizontal 14px di dalam kotak, sehingga teks tidak menempel tepi.
- `border: 1px solid #cbd5e1;` menggambar garis tepi 1px utuh berwarna abu-abu muda.
- `border-radius: 6px;` membulatkan sudut kotak input.
- `font-size: 14px;` menetapkan ukuran teks yang diketik/dipilih.
- `outline: none;` menghilangkan outline standar browser. Karena outline membantu menandai fokus keyboard, stylesheet menggantinya dengan efek fokus yang terlihat pada aturan berikut. Jika aturan `:focus` dihapus tetapi `outline: none` dipertahankan, indikator fokus dapat menjadi kurang terlihat.
- `background-color: #fff;` memberi latar putih.
- `transition: border-color 0.2s, box-shadow 0.2s;` menghaluskan perubahan warna border dan bayangan selama 0,2 detik ketika fokus berubah. Hanya dua properti yang ditentukan pada daftar transisi ini.
- `}` menutup aturan untuk ketiga jenis kontrol tersebut.

## 8.5 Efek ketika input dipilih/fokus

### Kode

```css
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  border-color: #0284c7;
  box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
}
```

### Penjelasan per baris

- `.form-group input:focus,` memilih input ketika sedang fokus, misalnya setelah pengguna mengeklik kotak “Merk Mobil” atau masuk ke sana dengan tombol Tab.
- `.form-group select:focus,` melakukan hal sama ketika dropdown dipilih.
- `.form-group textarea:focus {` menargetkan textarea yang sedang fokus dan membuka aturan bersama untuk semua tiga jenis kontrol.
- `border-color: #0284c7;` mengubah garis tepi menjadi biru. Pengguna mendapat petunjuk kontrol mana yang sedang aktif.
- `box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);` menambah lingkaran/bayangan biru lembut setebal seolah 3px di sekitar kotak. Empat nilai awal `0 0 0 3px` berarti pergeseran horizontal 0, pergeseran vertikal 0, blur 0, dan spread 3px; warna rgba biru dengan opasitas 15%.
- `}` menutup aturan fokus.

CSS ini hanya memberi tanda visual fokus. CSS tidak memeriksa apakah NIK benar 16 digit atau apakah data wajib terisi. Validasi standar `required` berasal dari HTML, sedangkan validasi tambahan memerlukan JavaScript atau server.

## 8.6 Area tombol form

### Kode

```css
.form-actions {
  display: flex;
  gap: 10px;
  margin-top: 24px;
  padding-top: 15px;
  border-top: 1px solid #f1f5f9;
}
```

### Penjelasan per baris

- `.form-actions` memilih pembungkus tombol di akhir form.
- `display: flex;` menyusun tombol sebagai item Flexbox. Pada desktop, tombol Simpan dan Batal tampil berdampingan.
- `gap: 10px;` memberi jarak 10px di antara item Flexbox, tanpa perlu memberi margin pada masing-masing tombol.
- `margin-top: 24px;` memberi ruang luar di atas area tombol, memisahkannya dari input terakhir.
- `padding-top: 15px;` menambah ruang di dalam area tombol, setelah garis pemisah dan sebelum tombol.
- `border-top: 1px solid #f1f5f9;` menampilkan garis tipis di atas area tombol.
- `}` menutup aturan area aksi form.

Pada layar mobile, aturan media query mengubah arah Flexbox agar tombol menumpuk vertikal. Itu dibahas pada Sesi 10.

---

# Sesi 9 — Kartu statistik dashboard

Dashboard memiliki empat kartu ringkasan, misalnya Total Mobil, Mobil Disewa, Maintenance, dan Mobil Siap Rental. HTML kurang lebih memakai pola berikut:

```html
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-info">
      <h3>Total Mobil</h3>
      <p class="stat-value" id="total-mobil">15</p>
    </div>
  </div>
</div>
```

Pada dua kartu, HTML juga menambahkan class `border-danger` atau `border-success`; masalahnya, class ini belum memiliki aturan tersendiri dalam CSS final.

## 9.1 Wadah grid statistik

### Kode

```css
/* Styling Kartu Ringkasan Data (Stats Grid) */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-bottom: 25px;
}
```

### Penjelasan per baris

- Komentar menyebut bahwa bagian ini menata kumpulan kartu ringkasan statistik.
- `.stats-grid` memilih wadah yang memiliki class `stats-grid`.
- `display: grid;` menggunakan CSS Grid untuk mengatur anak-anak menjadi kisi baris dan kolom. Ini cocok untuk beberapa kartu statistik yang perlu tersusun sejajar.
- `grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));` adalah bagian paling penting:
  - `minmax(220px, 1fr)` mengatakan lebar setiap kolom minimal 220px dan boleh melebar sampai mengambil bagian ruang yang tersedia (`1fr`).
  - `repeat(...)` mengulang pola kolom tersebut.
  - `auto-fit` meminta browser menempatkan sebanyak mungkin kolom yang muat, lalu menyesuaikan kolomnya dengan ruang yang ada.
  - Hasilnya di layar lebar beberapa kartu bisa berjajar; saat ruang makin sempit jumlah kolom berkurang secara alami.
- `gap: 20px;` memberi celah 20px di antara kartu, baik horizontal maupun vertikal.
- `margin-bottom: 25px;` memberi jarak di bawah seluruh kelompok statistik.
- `}` menutup aturan grid.

## 9.2 Tampilan satu kartu statistik

### Kode

```css
.stat-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  border-left: 4px solid #0284c7;
}
```

### Penjelasan per baris

- `.stat-card` memilih setiap kartu statistik.
- `background-color: #fff;` membuat kartu putih.
- `padding: 20px;` memberi ruang 20px di dalam kartu, sehingga label dan angka tidak menempel tepi.
- `border-radius: 8px;` membulatkan sudut kartu.
- `box-shadow: 0 2px 6px rgba(0,0,0,0.04);` menambahkan bayangan halus sama seperti kartu umum.
- `border-left: 4px solid #0284c7;` membuat garis aksen biru 4px pada sisi kiri. Garis ini menonjolkan kartu dari latar.
- `}` menutup aturan kartu.

### Catatan kelas `border-danger` dan `border-success`

HTML dashboard saat ini menggunakan `class="stat-card border-danger"` dan `class="stat-card border-success"` untuk dua kartu. Namun, stylesheet ini tidak mendefinisikan selector `.border-danger` maupun `.border-success`. Maka kedua class tambahan tersebut **belum mengganti** garis biru dari `.stat-card`; keduanya tidak punya efek visual khusus sampai aturannya ditambahkan. Ini ketidaksesuaian nyata antara HTML dan CSS, bukan kesalahan cara membaca.

## 9.3 Judul di dalam kartu statistik

### Kode

```css
.stat-info h3 {
  font-size: 13px;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 8px;
}
```

### Penjelasan per baris

- `.stat-info h3` memilih tag `<h3>` yang berada di dalam elemen `.stat-info`, misalnya label “TOTAL MOBIL”.
- `font-size: 13px;` membuat label relatif kecil supaya angka statistik lebih dominan.
- `color: #64748b;` memberi warna abu-abu kebiruan.
- `text-transform: uppercase;` mengubah tampilan huruf menjadi kapital. Teks sumber HTML tidak harus ditulis kapital; CSS mengubah cara tampilnya.
- `letter-spacing: 0.5px;` menambahkan jarak 0,5px di antara karakter, sehingga label kapital lebih lapang.
- `margin-bottom: 8px;` memberi jarak antara label dan angka statistik.
- `}` menutup aturan label statistik.

## 9.4 Angka statistik

### Kode

```css
.stat-info .stat-value {
  font-size: 28px;
  font-weight: 700;
  color: #0f172a;
}
```

### Penjelasan per baris

- `.stat-info .stat-value` memilih elemen ber-class `stat-value` yang berada di dalam `.stat-info`. Contohnya `<p class="stat-value" id="total-mobil">15</p>`.
- `font-size: 28px;` menjadikan angka cukup besar agar mudah dipindai.
- `font-weight: 700;` membuat angka tebal.
- `color: #0f172a;` memberi warna gelap.
- `}` menutup aturan angka.

### Siapa yang memperbarui angka?

HTML memberi angka awal sebagai isi halaman. Dalam Jobsheet 06, JavaScript `app.js` mengambil data JSON, lalu mengisi sebagian angka dengan `textContent`. CSS hanya mengatur bagaimana angka itu terlihat; CSS tidak menghitung jumlah mobil.

Perhatikan juga bahwa JS mencoba memilih ID `rental-aktif`, tetapi ID tersebut tidak ada pada HTML dashboard revisi. Jadi bagian yang mengandalkan ID itu tidak menemukan elemen untuk diperbarui. Ini persoalan hubungan JS–HTML, bukan persoalan CSS.

---

# Sesi 10 — Responsive design dan menu hamburger

Bagian ini mengubah tampilan saat layar kecil. Desktop dan mobile tidak harus memakai susunan yang sama: pada desktop sidebar selalu terlihat di kiri; pada layar sampai 768px, tombol hamburger dimunculkan dan sidebar disembunyikan ke luar layar.

## 10.1 Tampilan awal tombol hamburger

### Kode

```css
/* Tombol Toggle Hamburger Sidebar */
.menu-toggle {
  display: none;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #1e293b;
  padding: 5px;
}
```

### Penjelasan per baris

- Komentar menjelaskan bahwa aturan ini untuk tombol pembuka sidebar.
- `.menu-toggle` memilih tombol dengan class tersebut, yang dalam HTML juga memiliki `id="menu-toggle"` dan berisi simbol `☰`.
- `display: none;` menyembunyikan tombol dari layout pada kondisi normal, yaitu desktop. Tombol tidak memakan ruang.
- `background: none;` menghilangkan latar tombol agar tidak terlihat seperti kotak tombol default.
- `border: none;` menghilangkan garis tepi tombol.
- `font-size: 24px;` membuat simbol hamburger cukup besar untuk dikenali.
- `cursor: pointer;` mengubah kursor menjadi tangan untuk memberi isyarat tombol dapat diklik.
- `color: #1e293b;` memberi simbol warna gelap.
- `padding: 5px;` memberi area dalam agar simbol tidak terlalu rapat pada tepi dan sedikit memudahkan sasaran klik.
- `}` menutup aturan tombol pada kondisi normal.

Mengapa `display: none` lalu nanti `display: block`? Agar di desktop pengguna tidak melihat tombol yang tidak dibutuhkan, sedangkan di mobile tombol diperlukan untuk menggantikan navigasi sidebar yang tidak lagi selalu terlihat.

## 10.2 Media query: aturan untuk layar kecil

### Kode

```css
/* Media Query untuk Layar < 768px (Smartphone) */
@media screen and (max-width: 768px) {
  /* aturan mobile berada di dalam blok ini */
}
```

Ini adalah kerangka yang membungkus sejumlah aturan di bawahnya; di stylesheet asli seluruh aturan mobile sampai akhir file berada di dalam media query tersebut.

- `@media` memulai kelompok aturan yang hanya aktif ketika kondisi tertentu cocok.
- `screen` berarti aturan ditujukan ke tampilan layar.
- `(max-width: 768px)` berarti viewport harus memiliki lebar maksimum 768px. Saat lebarnya 768px atau kurang, browser mengaktifkan aturan di dalam blok. Saat lebih lebar, aturan mobile ini tidak aktif.
- `{` membuka ruang untuk aturan mobile.
- `}` paling akhir menutup media query. Kurung penutup setiap selector di dalamnya tetap harus ada sebelum kurung penutup media query ini.

**Ingat:** media query bukan class dan tidak perlu ditambahkan ke HTML. Browser sendiri mengevaluasi lebar viewport.

## 10.3 Menampilkan tombol menu di mobile

### Kode asli di dalam media query

```css
.menu-toggle {
  display: block;
}
```

### Penjelasan

- `.menu-toggle` menargetkan tombol yang sama dari bagian 10.1.
- `display: block;` menampilkan tombol pada layar kecil. Karena aturan ini berada di media query dan ditulis setelah aturan awal `display: none`, maka pada viewport sampai 768px tombol tampil.
- `}` menutup aturan tombol dalam media query.

Ini cara CSS yang mengatur kapan tombol terlihat. JavaScript belum dibahas di sini; JavaScript yang nanti mengatur reaksinya ketika tombol diklik.

## 10.4 Menyembunyikan sidebar ke kiri

### Kode

```css
.sidebar {
  width: 250px;
  transform: translateX(-100%);
  transition: transform 0.3s ease-in-out;
  z-index: 1000;
  box-shadow: 4px 0 10px rgba(0,0,0,0.1);
}
```

### Penjelasan per baris

- `.sidebar` masih memilih sidebar yang sama. Di desktop ia berlebar 240px; di media query ini lebarnya menjadi 250px untuk mode mobile. Karena aturan mobile aktif pada layar kecil, nilai mobile menggantikan nilai desktop untuk properti yang sama.
- `width: 250px;` menetapkan lebar panel mobile 250px.
- `transform: translateX(-100%);` menggeser panel ke kiri sejauh 100% dari lebar elemen itu sendiri. Karena panel lebarnya 250px, ia berpindah sekitar 250px ke kiri sehingga berada di luar pandangan.
- `transition: transform 0.3s ease-in-out;` membuat perubahan properti `transform` berlangsung 0,3 detik dengan gerakan yang melambat/menjadi halus di awal dan akhir (`ease-in-out`). Ini yang memberi kesan sidebar meluncur, bukan muncul mendadak.
- `z-index: 1000;` memberi prioritas lapisan tinggi agar sidebar berada di atas konten lain saat terbuka. `z-index` paling mudah bekerja pada elemen yang diposisikan atau item layout tertentu; sidebar ini `position: fixed` dari aturan desktop sehingga cocok menggunakannya.
- `box-shadow: 4px 0 10px rgba(0,0,0,0.1);` menambahkan bayangan ke sisi panel agar tampak terangkat dari konten ketika muncul. Nilai 4px menggeser bayangan ke kanan, 0 tidak menggeser vertikal, blur 10px, hitam beropasitas 10%.
- `}` menutup aturan sidebar mobile.

### Mengapa menyembunyikan dengan `transform`, bukan `display: none`?

`display: none` langsung menghilangkan elemen dan biasanya tidak menghasilkan animasi masuk/keluar seperti ini. `transform` memindahkan panel secara visual; karena ada `transition`, perpindahannya bisa dianimasikan. Panel tetap ada di dokumen tetapi digeser ke luar layar.

## 10.5 Sidebar ketika aktif/terbuka

### Kode

```css
.sidebar.active {
  transform: translateX(0);
}
```

### Penjelasan per baris

- `.sidebar.active` memilih satu elemen yang memiliki kedua class: `sidebar` dan `active`. Ini berbeda dari `.sidebar .active` (yang akan mencari anak dengan class active).
- `transform: translateX(0);` menggeser elemen sebanyak 0 pada sumbu horizontal, yaitu kembali ke posisi normal. Karena keadaan normal mobile adalah `translateX(-100%)`, saat class `active` muncul panel kembali terlihat.
- `}` menutup aturan keadaan terbuka.

### Bagian JavaScript yang berhubungan langsung

Dalam `assets/js/app.js` (dan juga skrip daftar mobil/pelanggan) ada logika serupa dengan ini:

```js
menuToggle.addEventListener('click', () => {
  sidebar.classList.toggle('active');
});
```

Saat tombol hamburger diklik, JavaScript menambahkan class `active` jika belum ada, atau menghapusnya jika sudah ada. CSS tidak mendeteksi klik sendiri: JavaScript mengubah class, lalu CSS `.sidebar.active` merespons class itu.

Skrip juga mendengarkan klik di dokumen dan menghapus class `active` jika pengguna mengklik di luar sidebar maupun tombol menu. Itulah sebabnya menu dapat menutup setelah area lain diklik. `transform` dan `transition` tetap dikerjakan oleh CSS.

## 10.6 Mengatur wrapper pada mobile

### Kode

```css
.main-wrapper {
  margin-left: 0 !important;
  width: 100% !important;
}
```

### Penjelasan per baris

- `.main-wrapper` memilih pembungkus konten utama yang pada desktop memakai margin kiri 240px dan lebar `calc(100% - 240px)`.
- `margin-left: 0 !important;` menghapus margin kiri pada mobile agar konten mulai dari tepi kiri viewport. `!important` membuat deklarasi ini mengalahkan deklarasi biasa pada properti yang sama, termasuk aturan desktop sebelumnya.
- `width: 100% !important;` membuat wrapper selebar viewport/area induknya, bukan dikurangi 240px. `!important` dipakai karena aturan desktop sebelumnya menentukan width berbeda.
- `}` menutup aturan wrapper mobile.

Pada mobile, sidebar dikeluarkan dari sisi kiri ketika tertutup, sedangkan main-wrapper memakai seluruh lebar layar. Ini mencegah konten utama tetap menyisakan kolom kosong 240px.

**Catatan kode:** `!important` memang bekerja, tetapi sebaiknya tidak dipakai berlebihan karena dapat mempersulit pengaturan CSS berikutnya. Di proyek ini ia dipakai untuk menimpa pengaturan desktop saat mobile.

## 10.7 Mengurangi padding topbar

### Kode

```css
.topbar {
  padding: 0 15px;
}
```

### Penjelasan

- `.topbar` memilih header yang sama seperti Sesi 3.
- `padding: 0 15px;` membuat padding vertikal tetap 0 dan mengurangi padding kiri/kanan dari 30px menjadi 15px. Pada layar sempit ruang horizontal berharga, sehingga pengurangan ini memberi lebih banyak ruang untuk tombol dan judul.
- `}` menutup aturan mobile. Properti lain seperti tinggi, latar, dan Flexbox tetap mengikuti aturan `.topbar` dasar karena di sini hanya `padding` yang diganti.

## 10.8 Mengecilkan judul topbar

### Kode

```css
.topbar .title {
  font-size: 15px;
}
```

### Penjelasan

- `.topbar .title` tetap memilih judul sistem di topbar.
- `font-size: 15px;` mengecilkan judul dari 18px menjadi 15px pada layar kecil agar tidak terlalu memenuhi baris.
- `}` menutup aturan mobile. Warna dan ketebalan tetap mengikuti aturan dasar `.topbar .title`.

## 10.9 Menyembunyikan informasi pengguna di ponsel

### Kode

```css
.topbar .user-info {
  display: none; /* Sembunyikan pesan user info di HP */
}
```

### Penjelasan

- `.topbar .user-info` memilih bagian sambutan admin.
- `display: none;` menghapus bagian tersebut dari tampilan dan alur layout pada layar kecil. Tujuannya memberi ruang lebih bagi judul dan tombol menu.
- `/* Sembunyikan pesan user info di HP */` adalah komentar di samping baris; tidak memiliki efek tampilan.
- `}` menutup aturan.

Ini hanya menyembunyikan elemen dari layar mobile, bukan menghapus teks dari file HTML atau mengubah akun pengguna.

## 10.10 Mengurangi ruang konten

### Kode

```css
.content-body {
  padding: 15px;
}
```

### Penjelasan

- `.content-body` memilih area konten utama.
- `padding: 15px;` mengganti padding desktop yang semula 25px atas/bawah dan 30px kiri/kanan dengan 15px di semua sisi. Ruang menjadi lebih hemat pada layar kecil.
- `}` menutup aturan. Karena hanya padding yang ditulis ulang, `flex: 1` dari aturan dasar tetap berlaku.

## 10.11 Kartu statistik menjadi satu kolom

### Kode

```css
.stats-grid {
  grid-template-columns: 1fr; /* Jadi 1 kolom bertumpuk di HP */
  gap: 12px;
}
```

### Penjelasan per baris

- `.stats-grid` memilih wadah kartu statistik yang sudah memakai `display: grid` pada aturan desktop.
- `grid-template-columns: 1fr;` menentukan tepat satu kolom dengan satu bagian ruang fleksibel. Akibatnya kartu disusun vertikal satu di bawah lainnya, bukan mencoba berjajar pada layar sempit.
- Komentar setelah deklarasi menjelaskan hasil yang diharapkan, bukan aturan tambahan.
- `gap: 12px;` mengurangi jarak antarkartu dari 20px menjadi 12px agar susunan mobile lebih rapat.
- `}` menutup aturan. `display: grid` tetap berasal dari deklarasi `.stats-grid` dasar.

## 10.12 Kartu bisa digulir horizontal untuk tabel lebar

### Kode

```css
.card {
  padding: 15px;
  overflow-x: auto; /* Memungkinkan tabel di-scroll ke samping jika lebar */
}
```

### Penjelasan per baris

- `.card` memilih kartu umum, termasuk kartu yang membungkus tabel.
- `padding: 15px;` mengurangi padding kartu dari 24px menjadi 15px untuk menghemat ruang.
- `overflow-x: auto;` mengizinkan scroll horizontal ketika isi kartu lebih lebar daripada ruang yang tersedia. Jika tabel lebar, pengguna dapat menggeser bagian tabel ke samping alih-alih seluruh halaman melebar.
- Komentar menerangkan alasan deklarasi ini.
- `}` menutup aturan. Warna, border-radius, dan bayangan tetap mengikuti aturan `.card` dasar.

## 10.13 Menjaga tabel agar tidak terlalu gepeng

### Kode

```css
table {
  min-width: 550px; /* Menjaga ukuran minimum tabel agar tidak gepeng */
}
```

### Penjelasan

- `table` memilih seluruh tabel.
- `min-width: 550px;` menetapkan lebar minimum tabel 550px pada mobile. Jika layar ponsel hanya 360px, tabel tetap minimal 550px dan pembungkus `.card` memungkinkan pengguna melakukan scroll horizontal.
- Komentar menjelaskan tujuan supaya kolom tetap punya ruang cukup.
- `}` menutup aturan. Lebar 550px adalah minimum, bukan selalu ukuran akhir pada layar lebar.

Kombinasi `min-width` pada tabel dan `overflow-x: auto` pada kartu adalah pasangan penting. Jika hanya tabel diperlebar tanpa pembungkus yang bisa scroll, tampilan dapat meluap ke luar halaman.

## 10.14 Menumpuk tombol form pada mobile

### Kode

```css
.form-actions {
  flex-direction: column;
}
```

### Penjelasan

- `.form-actions` memilih wadah tombol di akhir form, yang pada desktop menggunakan `display: flex`.
- `flex-direction: column;` mengganti susunan Flexbox dari baris menjadi kolom. Tombol Simpan dan Batal menjadi satu di bawah yang lain.
- `}` menutup aturan mobile. `display: flex` dan `gap: 10px` dari aturan dasar tetap aktif.

## 10.15 Membuat tombol form selebar area

### Kode

```css
.form-actions .btn {
  width: 100%;
  text-align: center;
}
```

### Penjelasan

- `.form-actions .btn` memilih elemen ber-class `btn` yang berada di dalam `.form-actions`. Ini hanya memengaruhi tombol di area aksi form, bukan otomatis semua tombol website.
- `width: 100%;` membuat tombol menggunakan seluruh lebar wadahnya.
- `text-align: center;` menempatkan tulisan di tengah tombol. Ini juga bermanfaat bagi tautan Batal yang ditampilkan sebagai tombol.
- `}` menutup aturan. Karena aturan ini ada di media query, tombol penuh selebar wadah hanya pada layar kecil.

## 10.16 Penutup media query

Kurung kurawal terakhir `}` pada akhir file menutup `@media screen and (max-width: 768px)`. Semua aturan mobile di dalamnya selesai di situ. Bila kurung ini hilang atau ada kurung yang tidak berpasangan, browser bisa mengabaikan bagian CSS tertentu atau membaca susunannya tidak sesuai maksud.

---

# Sesi 11 — Peta hubungan CSS, HTML, dan JavaScript

Ini peta penting untuk membedakan tugas ketiga teknologi tersebut.

| Bagian visual | HTML yang menyediakan elemen | CSS yang mengatur | JavaScript yang berhubungan |
|---|---|---|---|
| Sidebar | `<aside class="sidebar">` | `.sidebar`, `.sidebar.active` | `querySelector('.sidebar')` memilihnya; `classList.toggle('active')` membuka/menutupnya |
| Tombol hamburger | `<button class="menu-toggle" id="menu-toggle">☰</button>` | `.menu-toggle`; dalam media query menjadi `display: block` | `getElementById('menu-toggle')` memilih tombol dan `addEventListener('click', ...)` mendengarkan klik |
| Brand sidebar | `<div class="brand"><h2>...</h2></div>` | `.sidebar .brand`, `.sidebar .brand h2` | Tidak perlu JS untuk gaya nama brand |
| Navigasi aktif | `<li class="active"><a ...>` | `.sidebar .nav-links li.active a` | Dalam HTML revisi, class aktif halaman ditulis langsung; bukan class menu mobile yang di-toggle |
| Topbar | `<header class="topbar">...` | `.topbar`, `.topbar .title`, `.topbar .user-info` | JS tidak diperlukan untuk tata letaknya |
| Kartu | `<div class="card">` | `.card`, `.card-header` | Isi kartu bisa statis di HTML atau dipenuhi JS |
| Tombol | `class="btn btn-primary"` dll. | `.btn`, `.btn-primary`, `.btn-secondary`, `.btn-warning`, `.btn-danger`, `.btn-sm` | Fungsi klik ditentukan `href`, `type`, atau JavaScript; CSS hanya menampilkan bentuknya |
| Tabel mobil | `<table>`, `<th>`, `<td>`, `<tbody id="list-buku">` | `table`, `table th`, `table td`, `table tr:hover` | `buku.js` memasukkan baris ke `list-buku` dari JSON |
| Badge status | `<span class="badge badge-success">...` | `.badge`, `.badge-success`, `.badge-warning` | `buku.js` memilih class badge berdasar status data; `.badge-danger` belum diberi styling |
| Form | `.form-container`, `.form-group`, `.form-actions` | aturan form pada Sesi 8 | JS mendengar submit, tetapi versi saat ini menampilkan alert dan navigasi; belum menyimpan data permanen |
| Statistik | `.stats-grid`, `.stat-card`, `.stat-value` | aturan grid dan statistik | `app.js` mengambil JSON lalu mengubah `textContent` pada elemen yang ID-nya cocok |

## Alur hamburger dalam bahasa sederhana

1. HTML membuat tombol hamburger dan sidebar.
2. Di desktop CSS menyembunyikan hamburger dan selalu menampilkan sidebar.
3. Saat viewport 768px atau lebih sempit, media query menampilkan hamburger dan menggeser sidebar ke kiri.
4. JavaScript mendengar klik pada tombol.
5. Ketika diklik, JavaScript menambahkan/menghapus class `active` ke elemen sidebar.
6. Jika sidebar memiliki class `active`, aturan `.sidebar.active` memindahkannya ke posisi `translateX(0)`.
7. `transition` membuat pergerakannya tampak meluncur.
8. Saat klik di luar sidebar/tombol, JavaScript menghapus class `active`; CSS kembali menyembunyikannya ke kiri.

Jadi kalimat yang tepat saat presentasi ialah: **“JavaScript mengubah class, sedangkan CSS menentukan tampilan untuk setiap keadaan class tersebut.”**

---

# Sesi 12 — Hal yang sudah benar dan hal yang perlu dicatat dari CSS final

Tujuan bagian ini bukan menyalahkan kode. Tujuannya supaya kamu memahami hasil yang benar-benar dihasilkan stylesheet.

## 12.1 Class tambahan di dashboard yang belum memiliki aturan

Di HTML dashboard, beberapa kartu menggunakan class `border-danger` dan `border-success`, tetapi file CSS tidak mendefinisikan selector tersebut. Karena `.stat-card` memberi garis kiri biru, kartu-kartu itu tetap memiliki garis kiri biru sampai class tambahan diberi aturan.

Contoh **opsi perbaikan** jika ingin merah/hijau dibedakan:

```css
.stat-card.border-danger {
  border-left-color: #ef4444;
}

.stat-card.border-success {
  border-left-color: #22c55e;
}
```

Di sini `.stat-card.border-danger` berarti elemen yang memiliki dua class sekaligus, dan hanya mengganti warna garis kiri, bukan latar/seluruh kartu. Ini contoh tambahan; bukan bagian dari CSS final saat ini.

## 12.2 `badge-danger` dipakai JS tetapi belum ditata

Script tabel membuat class `badge-danger` untuk status tertentu, tetapi CSS hanya punya `.badge`, `.badge-success`, dan `.badge-warning`. Akibatnya status alternatif mungkin tampil tanpa warna khusus. Contoh perbaikan tersedia di Sesi 7.

## 12.3 `!important` dalam mobile

`!important` pada `margin-left` dan `width` memaksa aturan mobile mengalahkan nilai desktop. Itu membantu perubahan layout bekerja, tetapi apabila aturan CSS bertambah banyak, penggunaan `!important` berulang dapat membuat perawatan stylesheet lebih sulit. Untuk proyek kecil ini, fokuslah memahami alasan pemakaiannya.

## 12.4 Selector `.sidebar.active` berbeda dari `.sidebar .nav-links li.active a`

- `.sidebar.active`: class `sidebar` dan `active` ada pada elemen yang sama; dipakai untuk membuka panel mobile.
- `.sidebar .nav-links li.active a`: mencari tautan di dalam item daftar yang aktif; dipakai untuk menandai halaman navigasi yang dipilih.

Perbedaan satu spasi dapat mengubah elemen yang dipilih oleh selector. Ini salah satu syntax CSS yang penting dipahami.

## 12.5 CSS tidak membuat fitur CRUD

Walau tombol Edit dan Hapus memiliki warna, radius, cursor, dan efek hover, itu tidak membuktikan tombol sudah mengedit/menghapus data. CSS adalah lapisan presentasi. Fungsi simpan, ubah, dan hapus harus diimplementasikan lewat logika JavaScript dan biasanya API/backend serta penyimpanan data.

---

# Sesi 13 — Latihan kecil agar konsep melekat

Coba ubah satu hal setiap kali, simpan file, lalu segarkan browser. Dengan begitu kamu tahu properti mana yang menyebabkan perubahan tertentu.

## Latihan 1: ubah warna sidebar

Temukan:

```css
.sidebar {
  background-color: #1e293b;
}
```

Ganti sementara `#1e293b` dengan `#14532d`. Amati bagian mana yang berubah. Area brand tetap lebih gelap karena mempunyai aturan `.sidebar .brand` sendiri.

## Latihan 2: perbesar jarak isi kartu

Ubah `padding: 24px;` pada `.card` menjadi `padding: 32px;`. Perhatikan isi kartu bergeser menjauh dari pinggir. Ini membuktikan padding berada di dalam elemen, sedangkan margin adalah jarak di luar elemen.

## Latihan 3: tombol utama tidak berubah saat hover?

Periksa dua hal: apakah elemen HTML benar memiliki class `btn-primary`, dan apakah rule `.btn-primary:hover` masih berada dalam stylesheet yang dimuat. Pastikan juga link stylesheet di HTML mengarah ke path yang benar.

## Latihan 4: kecilkan jendela browser

1. Buka halaman dashboard.
2. Perlahan kecilkan viewport ke 768px atau kurang.
3. Amati tombol hamburger yang awalnya disembunyikan.
4. Sidebar berpindah keluar layar.
5. Klik hamburger dan amati sidebar kembali terlihat.
6. Klik di luar sidebar dan lihat panel menutup.

Jika hamburger terlihat tetapi sidebar tidak bergerak, periksa apakah JavaScript dimuat dan apakah script menambahkan class `active`. Jika class berubah tetapi animasi tidak tampak, periksa `.sidebar.active` dan `transition: transform ...`.

## Latihan 5: tabel di ponsel

Di viewport sempit, lihat apakah tabel bisa digeser ke samping. CSS menggabungkan `min-width: 550px` pada tabel dengan `overflow-x: auto` pada `.card`. Coba sementara menghapus salah satunya dan amati perbedaan.

## Latihan 6: input fokus

Klik sebuah input. Garis tepinya berubah menjadi biru dan muncul bayangan lembut. Coba hapus aturan `:focus` sementara; indikator biru hilang. Kembalikan setelah eksperimen.

---

# Sesi 14 — Cara menjelaskan CSS ini kepada dosen

Berikut contoh jawaban yang menjelaskan penerapan, bukan hanya mengartikan syntax.

**“Bagaimana layout utama dibuat?”**

> `body` memakai Flexbox. Sidebar dibuat fixed di kiri, sedangkan `.main-wrapper` diberi margin kiri sebesar lebar sidebar supaya konten tidak bertumpuk dengannya. Pembungkus utama memakai Flexbox arah kolom sehingga topbar berada di atas area konten.

**“Bagaimana warna tombol diterapkan?”**

> `.btn` menyiapkan bentuk umum seperti padding, radius, cursor, dan transisi. Kelas tambahan seperti `.btn-primary`, `.btn-warning`, dan `.btn-danger` menentukan warna sesuai jenis aksinya. Pseudo-class `:hover` mengganti warna saat pointer berada di atas tombol.

**“Bagaimana form terlihat konsisten?”**

> Setiap label dan input dikelompokkan dengan `.form-group`. Selector turunannya memberi jarak dan warna yang sama. Input, select, serta textarea memakai satu kelompok aturan sehingga ukuran dan border konsisten. Pseudo-class `:focus` menunjukkan kolom yang sedang dipilih.

**“Bagaimana responsifnya bekerja?”**

> Media query aktif saat viewport maksimal 768px. Dalam kondisi itu hamburger ditampilkan, sidebar digeser ke luar layar, konten memakai lebar penuh, kartu statistik menjadi satu kolom, dan tabel diberi minimum width dengan pembungkus scroll horizontal. JavaScript toggle class `active`; CSS mengubah posisi sidebar berdasarkan class tersebut.

**“Apakah tombol Hapus benar-benar menghapus data?”**

> Tidak berdasarkan CSS. CSS hanya menata tombol. Di versi ini fungsi Edit/Hapus masih berupa alert contoh, jadi tampilannya sudah ada tetapi operasi CRUD belum tersambung ke penyimpanan permanen.

---

# Ringkasan akhir: urutan berpikir saat melihat CSS

Setiap kali melihat suatu aturan CSS, tanyakan empat hal berikut:

1. **Siapa targetnya?** Baca selector-nya: `body`, `.sidebar`, `.btn-primary`, atau `.sidebar.active`.
2. **Apa yang diubah?** Lihat properti seperti `display`, `width`, `padding`, `color`, atau `transform`.
3. **Bagaimana hasil yang terlihat?** Hubungkan properti dengan ruang, posisi, warna, ukuran, atau keadaan elemen.
4. **Siapa yang memicu perubahan?** Bisa selalu aktif, dipicu `:hover`/`:focus`, berlaku hanya pada media query, atau muncul karena JavaScript menambah class seperti `active`.

Jika empat pertanyaan ini bisa kamu jawab untuk tiap kelompok aturan, kamu tidak lagi sekadar menghafal CSS. Kamu memahami mengapa elemen tertentu tampak seperti itu, file HTML mana yang menggunakannya, serta kapan JavaScript ikut mengubah keadaannya.
