# Handbook Lengkap Syntax Jobsheet 01–06
## Belajar dari Nol sampai Memahami Proyek Rental Mobil

**Sasaran:** pemula yang baru belajar HTML, CSS, JavaScript, JSON, dan dokumentasi UI/UX.  
**Proyek yang dibahas:** revisi Jobsheet 01–06 Sistem Manajemen Rental Mobil, dibandingkan dengan susunan pembelajaran pada referensi dosen SIMPUS-Mini.

> **Cara belajar:** ikuti urutan bab. Jangan hanya menghafal nama syntax. Untuk setiap potongan kode, tanyakan: (1) file apa yang menjalankannya, (2) elemen/data mana yang disentuh, dan (3) perubahan apa yang terlihat di browser.

---

## Daftar isi

1. Peta besar website dan cara menjalankan proyek
2. Jobsheet 01 — HTML: membangun struktur website
3. Jobsheet 02 — CSS: membuat website terlihat rapi
4. Jobsheet 03 — Responsive design dan menu mobile dengan CSS
5. Jobsheet 04 — UI/UX, user flow, wireframe, dan Markdown
6. Jobsheet 05 — JavaScript, DOM, event, dan hamburger menu
7. Jobsheet 06 — JSON, Fetch API, Promise, dan rendering tabel
8. Merakit ulang website dari folder kosong
9. Kesalahan umum dan cara mencari sumber masalah
10. Kamus syntax cepat
11. Latihan mandiri dan pertanyaan latihan UTS

---

# 0. Peta besar: website itu terdiri dari apa?

Bayangkan website seperti sebuah rumah.

- **HTML** adalah kerangka dan ruangan rumah: pintu, jendela, kamar, meja.
- **CSS** adalah tampilan rumah: warna cat, posisi meja, ukuran pintu, dan jarak antarperabot.
- **JavaScript (JS)** adalah tindakan: tombol membuka pintu, lampu menyala saat sakelar ditekan, atau daftar diperbarui.
- **JSON** adalah lemari arsip data: daftar mobil dan pelanggan disimpan dengan bentuk yang teratur.
- **Fetch API** adalah cara program meminta data dari arsip tersebut.
- **Markdown (`.md`)** adalah format catatan/dokumentasi, bukan bahasa untuk mengatur tampilan website di browser.

Pada proyek ini, pembagiannya seperti berikut:

| Jobsheet | Fokus utama | Hasil belajar |
|---|---|---|
| 01 | HTML5 | Dashboard, tabel data, form, dan tautan antarhalaman |
| 02 | CSS3 dasar | Warna, spasi, tombol, kartu, tabel, dan layout desktop |
| 03 | Responsive design | Layout desktop/tablet/ponsel dan sidebar mobile berbasis CSS |
| 04 | UI/UX | Menjelaskan user flow dan wireframe dalam dokumen teks |
| 05 | JavaScript DOM | Tombol hamburger membuka/menutup sidebar lewat event |
| 06 | JSON dan Fetch API | Mengambil data JSON, merender tabel, dan menghitung ringkasan |

## 0.1 Jenis file yang akan kamu lihat

| Ekstensi | Fungsi | Contoh proyek |
|---|---|---|
| `.html` | Struktur halaman | `index.html`, `buku/list.html`, `anggota/tambah.html` |
| `.css` | Aturan tampilan | `assets/css/style.css` |
| `.js` | Logika/interaksi browser | `assets/js/app.js`, `buku.js`, `anggota.js` |
| `.json` | Data terstruktur | `data/buku.json`, `data/anggota.json` |
| `.md` | Dokumentasi teks dengan heading/list/kode | `laporan.md`, `docs/wireframe.md` |

## 0.2 Struktur direktori versi revisi

```text
Jobsheet-06/
├── index.html
├── buku/
│   ├── list.html
│   └── tambah.html
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── app.js
│       ├── buku.js
│       └── anggota.js
└── data/
    ├── buku.json
    └── anggota.json
```

Nama folder `buku` dan `anggota` dipertahankan dari struktur materi awal, tetapi **isi tampilan** Jobsheet revisi sudah menggunakan istilah rental mobil. Ini bisa membingungkan: nama file boleh tetap lama, sementara data yang dibaca dan ditampilkan adalah mobil/pelanggan.

### Cara membaca alamat file relatif

Alamat file pada `href`, `src`, dan `fetch()` dihitung dari lokasi file HTML atau URL yang menjadi titik awalnya.

- `assets/css/style.css` dari `index.html` di folder utama berarti masuk ke `assets/css/`.
- `../assets/css/style.css` dari `buku/list.html` berarti `..` naik satu folder dari `buku/` ke folder utama, kemudian masuk ke `assets/css/`.
- `../data/buku.json` dari `buku/list.html` naik ke folder utama lalu membuka `data/buku.json`.

**Aturan cepat:** `./` artinya folder saat ini, `../` artinya naik satu tingkat, dan nama folder berikutnya artinya masuk ke folder tersebut.

## 0.3 Cara menjalankan proyek

Jobsheet 01–05 sebagian besar dapat dibuka langsung di browser, tetapi Jobsheet 06 memakai `fetch()` untuk mengambil berkas JSON. Jalankan melalui **server lokal**, misalnya fitur Live Server pada editor kode. Jika hanya membuka HTML sebagai alamat `file://`, browser mungkin menolak pengambilan JSON karena aturan keamanan origin.

Langkah umum:
1. Ekstrak ZIP ke sebuah folder.
2. Buka folder proyek dengan editor, misalnya Visual Studio Code.
3. Jalankan `Jobsheet-06/index.html` melalui server lokal.
4. Buka menu Data Mobil dan Data Pelanggan.
5. Buka Developer Tools browser (`F12`) → tab **Console** untuk melihat error JavaScript dan **Network** untuk melihat file yang gagal dimuat.

---

# 1. Jobsheet 01 — HTML: membangun struktur website

## 1.1 Apa tugas HTML?

HTML adalah singkatan dari *HyperText Markup Language*. HTML memberi tahu browser bahwa suatu bagian adalah judul, paragraf, daftar menu, tabel, tombol, atau isian form. HTML **bukan** bahasa untuk menghitung atau mengambil data.

Contoh paling kecil:

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Website Pertamaku</title>
</head>
<body>
    <h1>Halo!</h1>
    <p>Ini halaman pertamaku.</p>
</body>
</html>
```

## 1.2 Membaca kerangka dokumen

| Syntax | Makna |
|---|---|
| `<!DOCTYPE html>` | Menyatakan dokumen menggunakan mode HTML modern. Ini deklarasi, bukan elemen biasa. |
| `<html lang="id">` | Elemen akar dokumen. `lang="id"` menyatakan bahasa utama Indonesia. |
| `<head>` | Informasi untuk browser dan metadata halaman. Umumnya tidak tampil sebagai isi utama. |
| `<meta charset="UTF-8">` | Membantu menampilkan huruf/simbol dengan encoding yang sesuai. |
| `<meta name="viewport" content="width=device-width, initial-scale=1.0">` | Membantu layout menggunakan lebar viewport perangkat dan skala awal normal pada ponsel. |
| `<title>...</title>` | Judul di tab browser dan judul yang dibaca banyak alat/browser. |
| `<body>` | Konten halaman yang ditampilkan kepada pengguna. |
| `<!-- komentar -->` | Catatan untuk manusia; tidak tampil sebagai konten halaman. |

**Pola tag berpasangan:** `<p>Isi paragraf</p>`. Tag pembuka adalah `<p>`, isi ada di tengah, dan `</p>` menutup elemen. Ada juga elemen tanpa tag penutup terpisah, seperti `<meta>` dan `<input>`.

### Tag, elemen, dan atribut

Dalam `<h1 class="page-title">Dashboard</h1>`:
- `h1` adalah nama tag.
- Seluruh rangkaian pembuka sampai penutup beserta isi merupakan elemen.
- `class="page-title"` adalah atribut.
- `Dashboard` adalah isi teks.

Atribut memberi informasi tambahan. Nilai atribut biasanya ditulis di antara tanda kutip.

## 1.3 Elemen-elemen utama pada proyek

### Heading dan paragraf

```html
<h1 class="page-title">Data Mobil</h1>
<p class="page-description">Daftar kendaraan pada sistem rental.</p>
```

- `h1` adalah judul utama halaman. Gunakan sesuai hierarki, bukan hanya untuk membuat teks besar.
- `h2` cocok untuk judul bagian; `h3` untuk subbagian yang lebih kecil.
- `p` membungkus paragraf.
- `class` memberi nama kelompok yang dapat di-styling dengan CSS.

### Elemen semantik

Proyek menggunakan beberapa elemen yang namanya menjelaskan perannya:

```html
<aside class="sidebar">...</aside>
<header class="topbar">...</header>
<main class="content-body">...</main>
<section class="card">...</section>
<article class="stat-card">...</article>
```

- `header`: kepala halaman atau bagian.
- `nav`: bagian navigasi (bila dipakai untuk membungkus menu).
- `aside`: konten samping, pada proyek menjadi sidebar.
- `main`: konten utama halaman; idealnya satu area utama per halaman.
- `section`: satu bagian bertema.
- `article`: konten mandiri; pada proyek dipakai sebagai satu kartu statistik.
- `div`: wadah umum tanpa makna semantik khusus.

Elemen semantik membantu struktur dokumen dan aksesibilitas. `div` tetap berguna saat tidak ada elemen semantik yang lebih tepat.

### Daftar menu

```html
<ul class="nav-links">
    <li class="active"><a href="index.html">Dashboard</a></li>
    <li><a href="buku/list.html">Data Mobil</a></li>
    <li><a href="anggota/list.html">Data Pelanggan</a></li>
</ul>
```

- `ul` berarti unordered list (daftar tanpa nomor).
- `li` berarti satu item daftar.
- `a` membuat tautan yang dapat diklik.
- `href` adalah alamat tujuan.
- `class="active"` menandai item menu yang sedang aktif, lalu CSS memberi tampilan khusus.

Jangan tertukar antara **`href`** dan **`src`**: `href` sering dipakai untuk alamat tujuan tautan atau stylesheet, sedangkan `src` menunjuk sumber file yang disisipkan/dijalankan, seperti JavaScript atau gambar.

### Tabel HTML

```html
<table>
    <thead>
        <tr>
            <th>ID Mobil</th>
            <th>Merk / Model</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>MBL-001</td>
            <td>Toyota Avanza</td>
            <td><span class="badge badge-success">Tersedia</span></td>
        </tr>
    </tbody>
</table>
```

- `table`: seluruh tabel.
- `thead`: bagian kepala tabel.
- `tbody`: bagian data.
- `tr`: *table row*, satu baris.
- `th`: sel judul kolom.
- `td`: sel data.
- `span`: pembungkus teks kecil yang tetap berada dalam aliran baris; di sini dipakai untuk badge status.

Jumlah kolom pada setiap baris sebaiknya sesuai jumlah header. Pada Jobsheet 06, jika gagal memuat tabel mobil, skrip menampilkan satu sel dengan `colspan="6"`; `colspan` membuat sel melebar sebanyak enam kolom.

### Form input

Contoh dari proyek rental mobil:

```html
<form action="#" method="get">
    <div class="form-group">
        <label for="id-mobil">ID Mobil</label>
        <input id="id-mobil" name="id-mobil" type="text"
               placeholder="Contoh: MBL-006" required>
    </div>

    <div class="form-group">
        <label for="tarif">Tarif per Hari (Rp)</label>
        <input id="tarif" name="tarif" type="number" min="0" required>
    </div>

    <div class="form-group">
        <label for="status">Status Mobil</label>
        <select id="status" name="status" required>
            <option value="">Pilih status</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Disewa">Disewa</option>
            <option value="Maintenance">Maintenance</option>
        </select>
    </div>

    <button type="submit">Simpan Data</button>
</form>
```

Arti atribut dan elemen:

- `form`: menampung kontrol input yang dikirim sebagai satu formulir.
- `action`: alamat tujuan pengiriman form. Pada revisi Jobsheet 01 ada `action="#"`, yang bukan backend penyimpanan sungguhan.
- `method="get"`: browser dapat mengirim nilai form melalui URL query string. Itu bukan cara yang cocok untuk menyimpan data sensitif.
- `label`: label yang menjelaskan input.
- `for="id-mobil"`: menghubungkan label dengan elemen yang memiliki `id="id-mobil"`. Saat label ditekan, fokus dapat berpindah ke input tersebut.
- `input`: kontrol untuk memasukkan data.
- `type="text"`: teks biasa.
- `type="number"`: angka; `min="0"` mencegah nilai angka di bawah nol melalui validasi bawaan browser.
- `type="tel"`: input telepon (membantu keyboard ponsel, bukan otomatis memvalidasi format nomor).
- `type="email"`: browser memeriksa pola email dasar.
- `placeholder`: contoh/petunjuk di dalam kolom, bukan nilai permanen.
- `name`: nama properti yang ikut saat form disubmit secara tradisional.
- `required`: field wajib diisi menurut validasi HTML bawaan.
- `select` dan `option`: pilihan dropdown.
- `textarea`: area teks yang dapat menampung beberapa baris; `rows="3"` memberi tinggi awal sekitar tiga baris.
- `button type="submit"`: mengirim form.
- `button type="button"`: tombol biasa, tidak otomatis mengirim form.

**Penting:** `required` memvalidasi sebagian input, tetapi tidak menyimpan data. Penyimpanan membutuhkan backend/API atau mekanisme penyimpanan lain. Pada proyek ini form masih contoh antarmuka.

### `id` dibanding `class`

```html
<aside id="sidebar" class="sidebar">...</aside>
```

- `id="sidebar"` adalah penanda unik untuk satu elemen pada satu halaman. JavaScript Jobsheet 05 mengambil elemen berdasarkan ID ini.
- `class="sidebar"` boleh dipakai oleh banyak elemen dan biasa digunakan untuk gaya CSS.
- CSS memilih ID dengan `#sidebar`; memilih class dengan `.sidebar`.

### Atribut aksesibilitas yang tampak di Jobsheet

- `aria-label="..."` memberi nama yang dapat dibaca teknologi bantu ketika teks visual tidak cukup menjelaskan kontrol.
- `aria-expanded="false"` memberi informasi apakah menu dalam keadaan tertutup (`false`) atau terbuka (`true`). JavaScript Jobsheet 05 memperbarui nilai ini.
- `aria-controls="sidebar"` menghubungkan tombol dengan elemen yang dikendalikannya.
- `aria-label` bukan pengganti teks petunjuk visual yang jelas; ia melengkapi aksesibilitas.

## 1.4 Tautan CSS dan JavaScript

Pada halaman Jobsheet 02 ke atas, di dalam `<head>` ada:

```html
<link rel="stylesheet" href="assets/css/style.css">
```

- `link` menghubungkan dokumen dengan resource eksternal.
- `rel="stylesheet"` memberitahu browser bahwa resource tersebut adalah stylesheet.
- `href` menunjukkan lokasi CSS.

Pada akhir HTML Jobsheet 05:

```html
<script src="assets/js/app.js" defer></script>
```

- `script` menyisipkan atau menghubungkan kode JavaScript.
- `src` menunjuk file JS.
- `defer` membuat skrip eksternal dijalankan setelah HTML selesai diparsing dan sebelum event `DOMContentLoaded` terjadi. Pada Jobsheet 06 beberapa skrip ditaruh tepat sebelum `</body>` tanpa `defer`; itu juga merupakan pola umum karena elemen HTML di atasnya sudah diparsing lebih dulu.

### CSS inline dan JavaScript inline

Selain class dan file eksternal, kadang terlihat atribut seperti: 

```html
<h1 class="page-title" style="margin: 0;">Daftar Armada Mobil</h1>
<button onclick="alert('Contoh aksi')">Coba</button>
```

- `style="margin: 0;"` adalah **CSS inline**, yaitu aturan CSS langsung pada elemen. Ia berguna untuk contoh kecil tetapi jika terlalu banyak, gaya tersebar dan lebih sulit dirawat. Lebih rapi memakai class dalam file CSS bila aturan digunakan berulang.
- `onclick="..."` adalah **event handler inline**. Browser menjalankan JavaScript di atribut saat elemen diklik. Dalam proyek Jobsheet 06, tombol hasil render memakai pola `onclick` untuk menampilkan `alert('Edit ...')` dan `alert('Hapus ...')`; itu hanya contoh aksi, bukan pengeditan/penghapusan data. Dalam aplikasi yang lebih besar, `addEventListener()` biasanya lebih mudah dipisahkan dan dipelihara.

## 1.5 Jalur tautan untuk halaman dalam folder

Dashboard di folder utama menggunakan:

```html
<a href="buku/list.html">Data Mobil</a>
```

Namun `buku/list.html` harus naik folder untuk kembali ke dashboard:

```html
<a href="../index.html">Dashboard</a>
```

Kalau CSS/JS tidak ditemukan, paling sering penyebabnya adalah alamat relatif salah. Selalu hitung dari folder file HTML yang sedang dibuka.

## 1.6 Apa yang diselesaikan Jobsheet 01?

- Membuat lima halaman prototipe: dashboard, daftar mobil, tambah mobil, daftar pelanggan, dan tambah pelanggan.
- Membuat navigasi antarhalaman.
- Membuat tabel dan form statis.
- Belum menggunakan stylesheet eksternal atau JavaScript pada tahap fondasi ini.
- Nilai tabel ditulis langsung di HTML, sehingga mengubah datanya berarti mengubah HTML secara manual.

### Latihan Jobsheet 01

1. Tambahkan kolom “Warna” di tabel mobil. Elemen apa yang ditambah di `<thead>` dan setiap `<tr>` pada `<tbody>`?
2. Tambahkan field “Warna Mobil” ke form. Buat `label for` sama dengan `input id`.
3. Buat link dari daftar pelanggan ke form pelanggan. Mengapa alamatnya cukup `tambah.html`?
4. Jelaskan mengapa `<title>` bukan pengganti `<h1>`.

---

# 2. Jobsheet 02 — CSS: membuat struktur menjadi antarmuka

## 2.1 Apa tugas CSS?

CSS (*Cascading Style Sheets*) menentukan bagaimana HTML tampak: warna, ukuran, ruang, garis, posisi, dan susunan. Satu HTML bisa mempunyai tampilan yang berbeda dengan mengganti CSS saja.

Bentuk dasar aturan CSS:

```css
.page-title {
    color: #1e293b;
    font-size: 1.65rem;
    margin-bottom: 6px;
}
```

- `.page-title` adalah **selector**: memilih elemen yang memiliki class `page-title`.
- `{ ... }` berisi deklarasi gaya.
- `color` dan `font-size` adalah **property**.
- `#1e293b` dan `1.65rem` adalah **value**.
- Titik koma `;` memisahkan deklarasi.

Jika kurung kurawal atau titik koma hilang pada tempat yang diperlukan, aturan bisa gagal dibaca dengan benar.

## 2.2 Reset dan box model

Bagian awal `style.css` Jobsheet 02:

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```

- `*` adalah universal selector, memilih semua elemen.
- `margin: 0` menghapus margin bawaan browser.
- `padding: 0` menghapus padding bawaan.
- `box-sizing: border-box` membuat pengukuran `width` mencakup isi + padding + border sehingga ukuran komponen lebih mudah dikendalikan.

Bayangkan elemen sebagai kotak:

- **Content:** isi, misalnya teks.
- **Padding:** ruang di dalam kotak, antara isi dan border.
- **Border:** garis tepi kotak.
- **Margin:** ruang di luar kotak, menjauhkan kotak dari elemen lain.

Contoh:

```css
.card {
    width: 300px;
    padding: 20px;
    border: 1px solid #e2e8f0;
    margin-bottom: 24px;
}
```

Dengan `border-box`, lebar total yang ditentukan adalah 300px; padding dan border masuk dalam hitungan itu. Tanpa `border-box`, ukuran luar bisa bertambah.

## 2.3 Gaya dasar `body`, tautan, dan form control

```css
body {
    font-family: Arial, Helvetica, sans-serif;
    color: #1e293b;
    background: #f1f5f9;
    line-height: 1.5;
}

a { color: inherit; text-decoration: none; }
button, input, select, textarea { font: inherit; }
```

- `font-family`: daftar font; browser memakai font pertama yang tersedia.
- `color`: warna teks.
- `background`/`background-color`: latar belakang.
- `line-height: 1.5`: jarak baris sekitar 1,5 kali ukuran teks.
- `inherit`: mewarisi nilai dari elemen induk.
- `text-decoration: none`: menghilangkan garis bawah default tautan.
- Selector dipisah koma berarti beberapa kelompok elemen menerima aturan yang sama.
- `font: inherit` membuat tombol, input, dropdown, dan textarea mengikuti font halaman daripada mempertahankan font default berbeda.

Warna hex seperti `#1e293b` berisi enam digit heksadesimal: dua digit merah, dua hijau, dua biru. `rgba(15, 23, 42, .04)` berarti warna RGB dengan alpha/transparansi sekitar 4%.

## 2.4 Selector CSS yang dipakai

| Selector | Contoh | Arti |
|---|---|---|
| Universal | `*` | Semua elemen |
| Elemen | `body`, `table`, `th` | Semua elemen dengan nama tag itu |
| Class | `.sidebar`, `.card` | Semua elemen yang memiliki class itu |
| ID | `#sidebar` | Elemen dengan ID itu |
| Keturunan | `.topbar .title` | Elemen `.title` yang berada di dalam `.topbar` |
| Gabungan kondisi | `.nav-links a:hover` | Tautan di `.nav-links` ketika pointer sedang berada di atasnya |
| Beberapa selector | `th, td` | Semua `th` dan `td` |
| Pseudo-class | `:hover`, `:focus`, `:last-child` | Keadaan atau posisi tertentu suatu elemen |

Contoh `.nav-links li.active a` dibaca: cari tautan `a` yang berada di dalam `li` berkelas `active`, yang berada di dalam elemen `.nav-links`.

Pseudo-class yang muncul pada proyek:
- `:hover`: saat pointer berada di atas elemen.
- `:focus`: saat elemen input/tombol menerima fokus, misalnya dengan klik atau keyboard.
- `:last-child`: elemen yang menjadi anak terakhir dari induknya.

## 2.5 Layout sidebar, topbar, dan main content

```css
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    padding: 24px 16px;
    color: #f8fafc;
    background: #1e293b;
}

.main-wrapper {
    min-height: 100vh;
    margin-left: 250px;
}
```

- `position: fixed`: sidebar diposisikan relatif ke viewport dan tetap berada di tempat ketika halaman digulir.
- `top`, `left`, `bottom`: jarak sisi posisi elemen.
- `width`: lebar.
- `padding: 24px 16px`: atas/bawah 24px dan kiri/kanan 16px.
- `min-height: 100vh`: minimal setinggi viewport; `vh` merupakan persentase tinggi viewport (`100vh` = setinggi layar yang tersedia).
- `margin-left: 250px`: memberi ruang untuk sidebar agar konten utama tidak berada tepat di bawahnya.

Jika lebar sidebar diganti menjadi 260px, jangan lupa mengecek margin kiri `main-wrapper`; bila tidak cocok, layout dapat bergeser atau bertumpuk.

## 2.6 Flexbox: menyusun elemen dalam satu arah

```css
.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 16px 28px;
}
```

- `display: flex`: membuat anak langsung menjadi item Flexbox.
- `align-items: center`: meratakan item pada sumbu silang, biasanya secara vertikal saat arah utama horizontal.
- `justify-content: space-between`: mendorong item pertama dan terakhir berjauhan dengan ruang di antaranya.
- `gap`: jarak antaritem.
- `flex-direction: column`: bila dipakai, susunan menjadi vertikal.
- `flex-wrap: wrap`: mengizinkan item pindah baris jika tidak muat.

Pada `.card-header`, Flexbox membuat judul bagian dan tombol aksi dapat ditempatkan pada satu baris. Pada layar kecil, Jobsheet 03 mengubahnya menjadi kolom agar tidak sempit.

## 2.7 CSS Grid: susunan baris dan kolom

```css
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
}
```

- `display: grid`: mengaktifkan CSS Grid.
- `grid-template-columns`: menentukan pola kolom.
- `repeat(4, ...)`: mengulang pola empat kali.
- `1fr`: satu bagian dari ruang yang tersedia.
- `minmax(0, 1fr)`: menentukan batas minimal dan maksimal jalur kolom agar isi tidak memaksa kolom melebar berlebihan.
- `gap`: jarak baris/kolom.

Untuk form dua kolom, `.form-grid` memakai `repeat(2, minmax(0, 1fr))`. Pada mobile Jobsheet 03, form diubah menjadi satu kolom.

## 2.8 Menghias kartu, tabel, badge, tombol, dan form

Contoh kartu:

```css
.card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 2px 5px rgba(15, 23, 42, .04);
    padding: 22px;
}
```

- `border`: ketebalan, jenis garis, dan warna.
- `border-radius`: membuat sudut membulat.
- `box-shadow`: bayangan.

Contoh tabel:

```css
table { width: 100%; border-collapse: collapse; }
th, td { padding: 13px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
tbody tr:hover { background: #f8fafc; }
```

- `width: 100%`: lebar mengikuti wadah.
- `border-collapse: collapse`: border antar-sel digabung.
- `text-align: left`: teks rata kiri.
- `tbody tr:hover`: memberi sorotan pada baris saat pointer melintas.

Contoh badge dan tombol dibuat dengan gabungan class:

```html
<span class="badge badge-success">Tersedia</span>
<button class="btn btn-primary">Simpan Data</button>
```

```css
.badge { display: inline-block; padding: 4px 9px; border-radius: 999px; }
.badge-success { color: #166534; background: #dcfce7; }
.btn { display: inline-block; padding: 9px 13px; cursor: pointer; }
.btn-primary { color: #fff; background: #2563eb; }
.btn-primary:hover { background: #1d4ed8; }
```

Elemen dengan dua class, misalnya `class="btn btn-primary"`, menerima aturan umum `.btn` dan aturan khusus `.btn-primary`. Aturan khusus menambahkan atau mengubah property tertentu.

Form pada CSS memakai selector seperti `.form-group input` untuk memilih input yang ada di dalam `.form-group`, `width: 100%` untuk memenuhi wadah, `border-radius` untuk sudut membulat, dan `:focus` untuk menampilkan tanda saat input dipilih.

## 2.9 Satuan CSS yang perlu dikenal

- `px`: ukuran piksel CSS, mudah dipahami sebagai satuan jarak dasar.
- `rem`: relatif terhadap ukuran font elemen root; sering dipakai untuk ukuran font/spasi yang lebih konsisten.
- `%`: persentase dari acuan tertentu, misalnya lebar parent.
- `fr`: bagian ruang pada CSS Grid.
- `vh`: persentase tinggi viewport.
- Angka tanpa satuan diperbolehkan pada properti tertentu, misalnya `font-weight: 700`, `line-height: 1.5`, atau `flex: 1`.
- `0` biasanya tidak membutuhkan satuan.

### Beberapa property CSS tambahan yang ada di file aktual

| Property/pola | Makna | Contoh penggunaan di proyek |
|---|---|---|
| `min-height` / `min-width` | Ukuran minimum yang harus dipertahankan | Area utama minimal setinggi layar; tabel tidak terlalu sempit |
| `max-width` | Batas lebar maksimum | Konten tidak melebar tanpa batas |
| `width: calc(100% - 240px)` | Menghitung nilai ukuran dari rumus CSS | Area utama mengambil lebar layar dikurangi lebar sidebar 240px |
| `flex: 1` | Meminta item fleksibel mengambil sisa ruang yang tersedia | Judul topbar dapat mengisi area kosong |
| `text-transform: uppercase` | Mengubah tampilan huruf menjadi kapital | Label statistik tampil seragam |
| `letter-spacing: .5px` | Mengatur jarak antarhuruf | Label kecil lebih terbuka |
| `white-space: nowrap` | Menahan teks agar tidak pindah baris | Badge status tetap satu baris |
| `cursor: pointer` | Menampilkan pointer tangan ketika diarahkan ke elemen | Tombol memberi petunjuk bisa diklik |
| `outline: none` | Menghilangkan garis outline browser | Perlu hati-hati: jangan menghilangkan indikator fokus keyboard tanpa pengganti |
| `border-left` / `border-bottom` | Memberi garis pada sisi tertentu | Garis warna kartu statistik dan garis antarbaris tabel |
| `transition: all .2s` | Menganimasikan perubahan property yang didukung selama 0,2 detik | Efek hover tombol |
| `box-shadow: 0 2px 6px rgba(...)` | Bayangan dengan pergeseran, blur, dan warna transparan | Membuat kartu sedikit terangkat secara visual |

`calc()` harus ditulis dengan tanda kurung dan operator yang jelas. Contoh `calc(100% - 240px)` berarti browser menghitung seratus persen lebar acuan, kemudian mengurangi 240 piksel. Pada desain responsif, hitungan ini harus ditinjau lagi ketika margin sidebar berubah.

## 2.10 Apa yang belum dilakukan Jobsheet 02?

Pada Jobsheet 02 belum ada media query khusus mobile. Fokusnya tampilan desktop: sidebar fixed, topbar Flexbox, kartu statistik Grid, tabel, tombol, dan form. Jika layar kecil belum nyaman pada tahap ini, itu memang menjadi pekerjaan Jobsheet 03.

### Latihan Jobsheet 02

1. Ubah `width` sidebar dan sesuaikan `margin-left` wrapper.
2. Ubah statistik dari empat kolom menjadi dua kolom.
3. Beri semua `.btn` transisi warna dengan `transition: background-color .2s;`.
4. Jelaskan perbedaan `padding` dengan `margin` tanpa melihat catatan.

---

# 3. Jobsheet 03 — Responsive design dan menu mobile menggunakan CSS

## 3.1 Apa arti responsive design?

Website responsif adalah website yang menyesuaikan layout dengan ukuran area tampilan. Tidak berarti semua elemen harus selalu mengecil; kadang layout perlu berubah, informasi tertentu disembunyikan, atau tabel diberi scroll horizontal.

Jobsheet 03 mempertahankan dasar CSS dari Jobsheet 02, lalu menambahkan:
- beberapa breakpoint melalui `@media`;
- statistik menjadi dua kolom pada layar menengah dan satu kolom pada layar sempit;
- tabel dapat digulir horizontal;
- sidebar berubah menjadi off-canvas pada mobile;
- menu hamburger versi CSS-only melalui checkbox.

## 3.2 Viewport meta tag

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0">
```

`width=device-width` meminta viewport mengikuti lebar perangkat. `initial-scale=1.0` berarti skala awal normal. Revisi sudah memasang tag ini sejak Jobsheet 01, jadi pada Jobsheet 03 tag tersebut sudah tersedia dan dipertahankan.

## 3.3 Apa itu media query?

```css
@media (max-width: 1024px) {
    .content-body { padding: 22px; }
    .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
```

`@media` berarti aturan di dalamnya hanya aktif bila kondisi media cocok. `max-width: 1024px` berarti lebar viewport 1024px atau lebih kecil.

Pada stylesheet revisi:
- sampai `1024px`, padding konten dikurangi dan statistik menjadi dua kolom;
- sampai `768px`, sidebar menjadi menu off-canvas, tombol hamburger muncul, user info disembunyikan, dan tabel bisa digeser horizontal;
- sampai `480px`, statistik satu kolom, form satu kolom, tombol form ditumpuk, dan padding makin kecil.

Nilai breakpoint bukan aturan alam yang wajib sama untuk semua website. Breakpoint dipilih saat layout mulai tidak cukup ruang.

## 3.4 Tabel pada ponsel

```css
@media (max-width: 768px) {
    .table-responsive { overflow-x: auto; }
    table { min-width: 650px; }
}
```

- `overflow-x: auto`: bila isi lebih lebar daripada wadah, browser menyediakan scroll mendatar.
- `min-width: 650px`: tabel tidak dipaksa mengecil di bawah lebar itu.

Ini adalah kompromi yang berguna untuk tabel: isi kolom tetap terbaca, tetapi pengguna menggeser tabel ke samping. Wadah HTML harus benar-benar membungkus tabel:

```html
<div class="table-responsive">
    <table>...</table>
</div>
```

## 3.5 Hamburger CSS-only: checkbox + label

Jobsheet 03 sengaja memperlihatkan interaksi sederhana tanpa JavaScript. HTML berisi pola seperti ini:

```html
<input type="checkbox" id="sidebar-toggle" class="sidebar-toggle-checkbox"
       aria-label="Tampilkan navigasi">

<aside class="sidebar" id="sidebar">...</aside>

<label class="sidebar-overlay" for="sidebar-toggle"
       aria-label="Tutup navigasi"></label>

<header class="topbar">
    <label for="sidebar-toggle" class="menu-toggle"
           aria-label="Buka menu navigasi">☰</label>
</header>
```

Cara kerjanya:
1. Checkbox menyimpan keadaan: tidak dicentang atau dicentang.
2. Kedua `label` terhubung dengan checkbox melalui `for="sidebar-toggle"`.
3. Menekan label mengubah status checkbox.
4. CSS melihat keadaan checkbox melalui pseudo-class `:checked`.
5. Ketika dicentang, sidebar digeser masuk dan overlay ditampilkan.

CSS terkait:

```css
.sidebar-toggle-checkbox { display: none; }

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform .25s ease;
    }

    .sidebar-toggle-checkbox:checked ~ .sidebar {
        transform: translateX(0);
    }

    .sidebar-toggle-checkbox:checked ~ .sidebar-overlay {
        display: block;
    }
}
```

Jabaran syntax:
- `display: none` membuat checkbox tidak ditampilkan secara visual. Ini adalah demo teknik, tetapi dalam desain produksi perlu dipastikan kontrol tetap dapat diakses dengan keyboard/teknologi bantu.
- `:checked` memilih checkbox saat aktif.
- `~` adalah **general sibling combinator**: memilih saudara setelah checkbox yang berada di induk yang sama, tidak harus tepat setelahnya. Karena itu urutan elemen di HTML penting.
- `transform: translateX(-100%)` menggeser elemen ke kiri sejauh lebar elemen itu sendiri.
- `translateX(0)` berarti tidak ada pergeseran horizontal.
- `transition: transform .25s ease` menganimasikan perubahan transform selama 0,25 detik.
- `z-index` menentukan lapisan tampilan saat elemen bertumpuk; elemen dengan nilai lebih tinggi biasanya berada di depan jika aturan stacking-nya memungkinkan.
- `position: fixed` membuat overlay memenuhi viewport saat ditata dengan `inset: 0` (jarak atas, kanan, bawah, dan kiri semuanya nol).
- `rgba(...)` memberi latar semi-transparan agar konten di belakangnya meredup.

**Mengapa perlu menu berbeda di mobile?** Sidebar selebar 250–260px menyita banyak ruang pada layar sempit. Menyembunyikannya sampai pengguna meminta membuat area konten lebih lega.

## 3.6 CSS-only dibanding JavaScript

Checkbox cocok untuk mendemonstrasikan perubahan tampilan berbasis state HTML. JavaScript lebih fleksibel bila menu juga harus bereaksi pada tombol Escape, menutup saat tautan dipilih, memperbarui `aria-expanded`, atau mengikuti kondisi aplikasi. Inilah jembatan konsep menuju Jobsheet 05.

### Latihan Jobsheet 03

1. Ubah breakpoint 768px menjadi 700px. Uji lagi pada lebar 720px.
2. Jelaskan mengapa selector `:checked ~ .sidebar` bergantung pada urutan HTML.
3. Cobalah menghapus `overflow-x: auto`; apa yang terjadi pada tabel di ponsel?
4. Jelaskan perbedaan `transform: translateX(-100%)` dengan `display: none`.

---

# 4. Jobsheet 04 — UI/UX, user flow, wireframe, dan Markdown

## 4.1 Mengapa Jobsheet 04 hampir tidak mengubah kode website?

Pada ZIP revisi, berkas website Jobsheet 04 **identik dengan Jobsheet 03**. Perubahan Jobsheet 04 ada di dokumentasi `docs/wireframe.md`, bukan penambahan CSS/HTML/JS. Tahap ini melatih perencanaan dan dokumentasi sebelum interaksi lebih lanjut dikembangkan.

## 4.2 Perbedaan UI dan UX

- **UI (User Interface):** hal yang dilihat dan digunakan pengguna, seperti menu, tabel, kartu statistik, label form, warna, dan tombol.
- **UX (User Experience):** pengalaman pengguna saat menyelesaikan tujuan, misalnya apakah admin mudah menemukan Data Mobil, paham field yang harus diisi, dan tahu bagaimana kembali ke daftar.

UI membahas antarmuka; UX membahas pengalaman keseluruhan. Keduanya berhubungan, tetapi bukan istilah yang sama.

## 4.3 User flow

User flow adalah urutan langkah pengguna untuk mencapai satu tujuan. Contoh rencana flow tambah mobil:

```text
Dashboard
   ↓ pilih Data Mobil
Daftar Mobil
   ↓ pilih Tambah Mobil
Form Tambah Mobil
   ↓ isi field wajib
Klik Simpan Data
   ↓
Kembali ke Daftar Mobil (rancangan alur)
```

Pada proyek revisi, langkah simpan belum menyimpan data ke backend. Maka dokumen menyebut langkah itu sebagai **rancangan**, bukan fitur yang sudah bekerja.

Pertanyaan yang perlu dijawab user flow:
- Siapa aktornya? Di proyek ini aktor yang terlihat adalah admin/staff.
- Apa tujuannya?
- Dari halaman mana ia memulai?
- Langkah dan keputusan apa yang diambil?
- Hasil akhir apa yang diharapkan?

## 4.4 Wireframe

Wireframe adalah kerangka kasar untuk menjelaskan komponen dan posisi/urutannya, bukan desain visual final. Wireframe teks revisi menjelaskan bagian seperti:

- sidebar: dashboard, data mobil, data pelanggan;
- topbar: judul sistem dan informasi pengguna;
- area konten: judul halaman, statistik, kartu, tabel, atau form;
- aksi: tombol tambah, edit, hapus, simpan, dan kembali.

Wireframe menjawab **“bagian apa saja yang diperlukan?”**. User flow menjawab **“dalam urutan apa pengguna melalui bagian-bagian tersebut?”**.

## 4.5 Membaca Markdown (`.md`)

Markdown adalah format teks dengan penanda sederhana. Contoh:

```md
# Jobsheet 04 — User Flow dan Wireframe

## 1. Tujuan
Mendokumentasikan alur admin.

### A. Melihat dashboard
1. Pengguna membuka `index.html`.
2. Sistem menampilkan dashboard.

- Sidebar
- Topbar
- Tabel transaksi

> Catatan: penyimpanan permanen belum tersedia.
```

Syntax Markdown:
- `# ` untuk heading tingkat 1.
- `## ` untuk subheading.
- `### ` untuk sub-subheading.
- `1. ` untuk daftar bernomor.
- `- ` untuk daftar bullet.
- `> ` untuk kutipan/catatan yang ditonjolkan.
- `` `kode` `` untuk nama file/syntax pendek dalam teks.
- Tiga backtick untuk membuka dan menutup blok kode.
- Baris kosong memisahkan paragraf.

File `.md` tidak sama dengan HTML. Browser tidak otomatis menjalankan isi kode yang diletakkan dalam blok kode Markdown; blok tersebut hanya menampilkan contoh.

## 4.6 Cara menghubungkan rancangan dengan kode

| Ide pada wireframe | Bukti implementasi |
|---|---|
| Sidebar | `<aside class="sidebar">` |
| Judul halaman | `<h1 class="page-title">` |
| Kartu statistik | `.stats-grid` dan `.stat-card` |
| Tabel daftar | `<table>`, `<thead>`, `<tbody>` |
| Form | `<form>`, `<label>`, `<input>`, `<select>` |
| Menu mobile | checkbox + CSS pada Jobsheet 03; event listener JS pada Jobsheet 05 |

### Latihan Jobsheet 04

1. Buat user flow untuk melihat daftar pelanggan.
2. Tulis wireframe singkat untuk halaman tambah pelanggan.
3. Tandai setiap langkah flow yang sudah bekerja dan yang masih berupa rencana.
4. Terangkan mengapa wireframe tidak harus berisi detail warna dan bayangan.

---

# 5. Jobsheet 05 — JavaScript, DOM, event, dan hamburger menu

## 5.1 Apa tugas JavaScript?

JavaScript adalah bahasa pemrograman yang bisa mengubah halaman setelah HTML dibuka. CSS menentukan gaya, sedangkan JavaScript dapat mengubah class/atribut, membaca input, menangani klik, meminta data, dan sebagainya.

Pada Jobsheet 05 revisi, JavaScript terutama mengendalikan sidebar mobile. Fitur validasi form, filter tabel, dan konfirmasi hapus yang ada di contoh referensi dosen tidak semuanya dibawa ke revisi ini. Pelajari konsepnya, tetapi jangan mengaku fitur yang tidak ada sebagai fitur yang sudah bekerja.

## 5.2 Menghubungkan JS ke HTML

```html
<script src="assets/js/app.js" defer></script>
```

Halaman Jobsheet 05 memakai `defer`. Skrip diberi alamat melalui `src`, dan browser mengatur agar skrip berjalan setelah dokumen diparsing. Pada Jobsheet 06 skrip juga sering ditaruh tepat sebelum `</body>`.

Path dari halaman di subfolder berbeda:

```html
<!-- dari index.html -->
<script src="assets/js/app.js" defer></script>

<!-- dari buku/list.html -->
<script src="../assets/js/buku.js"></script>
```

## 5.3 DOM: jembatan antara HTML dengan JavaScript

DOM (*Document Object Model*) adalah representasi HTML dalam bentuk objek yang dapat dipilih dan dimodifikasi. Contoh HTML:

```html
<button id="menu-toggle">☰</button>
<aside id="sidebar" class="sidebar">...</aside>
```

JavaScript dapat mencari dua elemen ini lalu mengubah class sidebar ketika tombol ditekan.

### Cara memilih elemen

| Syntax | Kegunaan |
|---|---|
| `document.getElementById('sidebar')` | Mencari elemen dengan ID `sidebar` |
| `document.querySelector('.sidebar')` | Mencari elemen pertama yang cocok dengan selector CSS `.sidebar` |
| `element.querySelectorAll('a')` | Mencari semua tautan `a` di dalam elemen tersebut |

`document` berarti dokumen halaman. `getElementById` memakai nama ID tanpa `#`; `querySelector` menggunakan pola selector CSS sehingga class ditulis dengan titik dan ID dengan `#`.

### `const`, variabel, dan `null`

```js
const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');
```

- `const` membuat binding yang tidak dapat diarahkan ulang ke nilai lain. Jika nilainya objek DOM, properti objek masih dapat diubah.
- Nama variabel seperti `menuToggle` adalah nama pilihan pengembang; JavaScript membedakan huruf besar/kecil.
- Jika elemen tidak ditemukan, hasil pencarian biasanya `null`.
- Tanda `=` dipakai untuk memberi nilai atau melakukan assignment; `===` membandingkan nilai dan tipe secara ketat.

## 5.4 Membaca alur utama `app.js` Jobsheet 05

Berikut bentuk kode inti yang benar-benar digunakan dalam revisi:

```js
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!menuToggle || !sidebar || !overlay) return;

    function bukaMenu() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        menuToggle.setAttribute('aria-expanded', 'true');
        menuToggle.setAttribute('aria-label', 'Tutup menu navigasi');
    }

    function tutupMenu() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Buka menu navigasi');
    }

    menuToggle.addEventListener('click', function () {
        const menuSedangTerbuka = sidebar.classList.contains('active');
        if (menuSedangTerbuka) {
            tutupMenu();
        } else {
            bukaMenu();
        }
    });

    overlay.addEventListener('click', tutupMenu);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') tutupMenu();
    });

    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', tutupMenu);
    });
});
```

Sekarang baca satu per satu.

### Baris pertama: menunggu dokumen siap

```js
document.addEventListener('DOMContentLoaded', function () {
    // kode yang berjalan setelah HTML selesai diparsing
});
```

- `addEventListener` mendaftarkan fungsi untuk dijalankan saat event terjadi.
- `'DOMContentLoaded'` adalah nama event yang menandai HTML sudah diparsing menjadi DOM.
- `function () { ... }` adalah fungsi tanpa nama yang diberikan sebagai callback.
- `()` setelah nama fungsi menandai daftar parameter; karena kosong, tidak ada parameter pada callback ini.
- `{ ... }` membatasi isi fungsi.

Dengan menunggu DOM, kode lebih aman saat mengambil tombol dan sidebar karena elemen HTML sudah tersedia.

### Mengambil elemen

```js
const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
```

ID ini harus cocok dengan HTML. Jika HTML menggunakan `id="menu-toggle"`, JS juga harus mencari `'menu-toggle'`, bukan `'menuToggle'`.

### Penjaga kondisi

```js
if (!menuToggle || !sidebar || !overlay) return;
```

- `if (...)` menjalankan blok hanya bila kondisi benar.
- `!menuToggle` artinya elemen tidak ditemukan/bernilai falsy.
- `||` berarti OR (atau): kondisi terpenuhi jika salah satu pemeriksaan benar.
- `return` menghentikan fungsi saat ini lebih awal.

Mengapa ada penjaga? Karena file `app.js` digunakan di beberapa halaman. Jika satu halaman tidak memiliki elemen tertentu, kode tidak akan mencoba memanggil method pada `null`.

### Membuat fungsi buka dan tutup

```js
function bukaMenu() {
    sidebar.classList.add('active');
}
```

`function bukaMenu()` mendefinisikan fungsi bernama `bukaMenu`. Saat dipanggil, `classList.add('active')` menambahkan class `active` pada elemen sidebar.

CSS mempunyai aturan:

```css
.sidebar.active { transform: translateX(0); }
```

Jadi JavaScript tidak mengatur `transform` secara langsung; ia menambahkan class dan **CSS mengubah tampilannya**. Inilah kerja sama JS dan CSS.

Pada `tutupMenu()`, `.classList.remove('active')` menghapus class itu agar CSS mengembalikan sidebar ke posisi tertutup.

### `classList.contains`, `if`, dan `else`

```js
const menuSedangTerbuka = sidebar.classList.contains('active');
if (menuSedangTerbuka) {
    tutupMenu();
} else {
    bukaMenu();
}
```

- `contains('active')` mengecek apakah class ada; hasilnya `true` atau `false`.
- `if` menjalankan blok ketika kondisi benar.
- `else` menjalankan blok alternatif ketika kondisi salah.
- `true` berarti benar/aktif; `false` berarti salah/tidak aktif.

Ini membuat tombol berperilaku toggle: kalau sudah buka, klik berikutnya menutup; kalau tertutup, klik membuka.

### Event click, overlay, Escape

```js
menuToggle.addEventListener('click', function () {
    // aksi ketika tombol diklik
});

overlay.addEventListener('click', tutupMenu);
```

- `'click'` adalah event klik.
- Fungsi yang diserahkan ke `addEventListener` tidak perlu dipanggil saat didaftarkan.
- `tutupMenu` ditulis tanpa tanda kurung karena yang diberikan adalah **referensi fungsi**. Kalau ditulis `tutupMenu()`, fungsi akan dipanggil langsung saat baris itu dieksekusi, bukan menunggu klik.

Event keyboard:

```js
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') tutupMenu();
});
```

- `'keydown'` terjadi ketika tombol keyboard ditekan.
- `event` adalah objek informasi event yang dikirim browser.
- `event.key` menyatakan tombol yang ditekan.
- `=== 'Escape'` memeriksa apakah tombolnya Escape.
- Penulisan `if` satu baris tanpa kurung kurawal sah jika hanya ada satu statement, tetapi untuk pemula, blok dengan `{}` sering lebih mudah dibaca.

### `querySelectorAll()` dan `forEach()`

```js
sidebar.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', tutupMenu);
});
```

- `querySelectorAll('a')` mencari semua tautan di dalam sidebar.
- `forEach(...)` menjalankan callback sekali untuk setiap elemen dalam kumpulan hasil.
- Setiap tautan diberi listener agar menu menutup setelah pengguna memilih tujuan navigasi.
- `link` adalah nama parameter yang mewakili satu tautan saat callback berjalan.

### Mengubah atribut ARIA

```js
menuToggle.setAttribute('aria-expanded', 'true');
menuToggle.setAttribute('aria-label', 'Tutup menu navigasi');
```

`setAttribute(nama, nilai)` mengubah atribut HTML. Pada saat menu terbuka, `aria-expanded` menjadi teks `'true'`; pada saat tertutup, nilainya menjadi teks `'false'`. Nilai atribut HTML disimpan sebagai teks. Ini memberi informasi keadaan kontrol kepada teknologi bantu.

## 5.5 Syntax JavaScript yang perlu dikenali

| Syntax | Arti mudah |
|---|---|
| `const x = ...;` | Membuat variabel yang referensinya tidak bisa ditugaskan ulang |
| `function nama() {}` | Mendefinisikan fungsi bernama |
| `() => {}` | Bentuk singkat fungsi panah (*arrow function*) |
| `if (kondisi) {}` | Menjalankan kode saat kondisi benar |
| `else {}` | Alternatif jika kondisi sebelumnya salah |
| `!x` | Negasi/not; membalik nilai logika atau memeriksa nilai falsy |
| `a || b` | OR/logika “atau” |
| `a && b` | AND/logika “dan” |
| `===` | Membandingkan nilai dan tipe |
| `.` | Mengakses properti atau method dari objek, misalnya `sidebar.classList` |
| `()` | Memanggil fungsi atau membungkus parameter/ekspresi |
| `{}` | Membungkus blok pernyataan; dalam konteks lain dapat menjadi objek |
| `// komentar` | Komentar satu baris |
| `/* komentar */` | Komentar beberapa baris |
| `return` | Keluar dari fungsi, dapat sekaligus mengembalikan nilai |

## 5.6 Apa yang sudah dan belum dilakukan Jobsheet 05?

Yang sudah: menu hamburger dapat dibuka/ditutup, overlay dapat menutup menu, tombol Escape menutup menu, tautan sidebar menutup menu, class dan atribut aksesibilitas diperbarui.

Yang belum menjadi fitur revisi ini: rangkaian validasi form, filter pencarian tabel, dan konfirmasi hapus seperti materi referensi dosen. Itu adalah contoh tambahan yang dapat kamu pelajari untuk memahami kemungkinan penggunaan event lain (`submit`, `input`/`keyup`, dan `click`).

### Latihan Jobsheet 05

1. Ubah teks `aria-label` ketika menu terbuka/tertutup. Bagian fungsi mana yang harus diubah?
2. Apa yang terjadi jika `id="sidebar-overlay"` tidak ada tetapi pengecekan penjaga dihapus?
3. Jelaskan mengapa `tutupMenu` pada `addEventListener('click', tutupMenu)` tidak ditulis `tutupMenu()`.
4. Tambahkan `console.log('Menu dibuka')` di fungsi `bukaMenu()` untuk mengamati alur kode.

---

# 6. Jobsheet 06 — JSON, Fetch API, Promise, dan pembuatan tabel dinamis

## 6.1 Perbedaan HTML statis dan data dinamis

Pada Jobsheet 01–05, baris tabel ditulis langsung pada HTML. Contohnya:

```html
<tbody>
    <tr><td>MBL-001</td><td>Toyota Avanza</td><td>Tersedia</td></tr>
</tbody>
```

Pada Jobsheet 06, data disimpan terpisah di JSON dan JavaScript membuat barisnya. Keuntungan utamanya adalah data dan tampilan dipisahkan; mengubah isi sumber data tidak memerlukan penulisan ulang setiap baris HTML.

## 6.2 Mengenal JSON

Contoh bentuk data mobil dalam `data/buku.json`:

```json
[
  {
    "id": "MBL-001",
    "merk": "Toyota Avanza Veloz",
    "plat": "N 1234 AB",
    "tarif": 350000,
    "status": "Tersedia"
  },
  {
    "id": "MBL-002",
    "merk": "Mitsubishi Xpander",
    "plat": "N 5678 CD",
    "tarif": 400000,
    "status": "Disewa"
  }
]
```

Cara membaca:
- `[` dan `]` mengapit **array**, yaitu daftar berisi beberapa item.
- `{` dan `}` mengapit satu **object**.
- `"id"` adalah key/properti, sedangkan `"MBL-001"` adalah nilainya.
- `:` memisahkan key dan value.
- `,` memisahkan pasangan properti atau item.
- String/teks ditulis dengan tanda kutip dua.
- Angka seperti `350000` tidak memakai tanda kutip jika ingin diperlakukan sebagai number.
- `true`, `false`, dan `null` adalah nilai JSON yang sah; `undefined` bukan nilai JSON yang sah.

JSON lebih ketat dari JavaScript:
- nama properti harus menggunakan tanda kutip dua;
- string harus memakai tanda kutip dua;
- JSON tidak boleh berisi komentar;
- koma terakhir sebelum `}` atau `]` tidak diperbolehkan.

Contoh JSON pelanggan menggunakan properti `id`, `nama`, `nik`, `telepon`, dan `alamat`. Nama key harus sesuai dengan yang dibaca oleh JS. Jika JSON berisi `"merk"`, kode perlu membaca `item.merk`; `item.model` akan menghasilkan `undefined` jika properti `model` tidak ada.

## 6.3 `fetch()` mengambil data

Contoh pola aktual pada `assets/js/buku.js`:

```js
fetch('../data/buku.json')
    .then(response => response.json())
    .then(data => {
        // gunakan data yang sudah diubah menjadi array/object JavaScript
    })
    .catch(err => {
        console.error('Gagal mengambil data buku.json:', err);
    });
```

Penjelasan urutannya:

1. `fetch('../data/buku.json')` meminta browser mengambil file JSON.
2. Hasil `fetch()` berupa **Promise**: objek yang mewakili pekerjaan asinkron yang belum selesai.
3. `.then(response => response.json())` berjalan ketika respons tersedia dan membaca isi respons sebagai JSON.
4. `.then(data => { ... })` menerima hasil JSON yang sudah menjadi data JavaScript.
5. `.catch(err => { ... })` menangani penolakan Promise/kegagalan jaringan atau parsing dalam rantai ini.

Tanda panah `=>` disebut **arrow function**. Misalnya:

```js
response => response.json()
```

Artinya fungsi menerima satu parameter bernama `response`, lalu mengembalikan hasil `response.json()`. Bentuk panjangnya:

```js
function (response) {
    return response.json();
}
```

Bentuk panah dengan beberapa statement memakai kurung kurawal:

```js
.then(data => {
    console.log(data);
    // perintah lainnya
})
```

## 6.4 Mengurai respons dengan `.json()`

`response.json()` tidak mengembalikan objek secara langsung saat itu juga; ia menghasilkan Promise yang nantinya berisi data JavaScript hasil parsing. Karena itu ia berada di `.then()` pada contoh di atas.

Contoh:

```js
fetch('../data/buku.json')
    .then(response => response.json())
    .then(data => console.log(data));
```

Setelah berhasil, `data` merupakan array. Maka:
- `data.length` adalah jumlah elemen array;
- `data[0]` adalah objek pertama;
- `data[0].merk` adalah properti `merk` milik objek pertama.

## 6.5 Array: `length`, `filter()`, `map()`, `join()`

### `length`

```js
const totalMobil = dataMobil.length;
```

`length` membaca banyak elemen dalam array. Jika array mempunyai 12 object mobil, hasilnya `12`.

### `filter()`

```js
const mobilDisewa = dataMobil.filter(m => m.status === 'Disewa');
const jumlahDisewa = mobilDisewa.length;
```

- `filter()` membuat array baru hanya berisi item yang lolos syarat.
- `m` adalah satu item saat diperiksa.
- `m.status === 'Disewa'` adalah syaratnya.
- `.length` menghitung item yang lolos.

Pada dashboard revisi, pola ini digunakan untuk menghitung mobil dengan status `Disewa`. Variabel `rental-aktif` juga diisi angka ini, sehingga itu adalah penyederhanaan berdasarkan status mobil, bukan jumlah transaksi dari data transaksi nyata.

### `map()`

`map()` mengubah setiap item menjadi sesuatu yang baru. Pada proyek ini, setiap object mobil diubah menjadi potongan HTML berupa `<tr>...</tr>`:

```js
const barisHTML = data.map(item => `
    <tr>
        <td><strong>${item.id}</strong></td>
        <td>${item.merk}</td>
        <td>${item.plat}</td>
        <td>Rp ${Number(item.tarif).toLocaleString('id-ID')}</td>
        <td>${item.status}</td>
    </tr>
`);
```

### Template literal dan `${...}`

String dengan backtick (`` `...` ``) disebut **template literal**. Ia dapat berisi baris baru dan menyisipkan nilai melalui `${...}`.

Contoh:

```js
const nama = 'Rina';
const pesan = `Halo, ${nama}!`;
```

Nilai `pesan` menjadi `Halo, Rina!`. Di kode render, `${item.merk}` diganti dengan nilai `merk` dari object saat itu.

### `join('')`

`map()` menghasilkan array berisi potongan string. `.join('')` menyatukan potongan itu tanpa menyisipkan karakter pemisah:

```js
listBuku.innerHTML = data.map(item => `...`).join('');
```

Tanpa `join('')`, hasil array jika langsung dikonversi ke string dapat menyisipkan koma di antara potongan.

## 6.6 `innerHTML` dan `textContent`

- `innerHTML` membaca/menetapkan isi HTML di dalam sebuah elemen. Ini digunakan untuk memasukkan baris tabel `<tr>` hasil render.
- `textContent` membaca/menetapkan teks biasa dari suatu elemen. Jobsheet 06 menggunakannya untuk memperbarui angka statistik tanpa membuat HTML baru.

Contoh statistik pada `app.js`:

```js
const totalMobilEl = document.getElementById('total-mobil');
if (totalMobilEl) totalMobilEl.textContent = dataMobil.length;
```

JavaScript mencari elemen yang ID-nya `total-mobil`, lalu mengganti tulisan di dalamnya dengan panjang array mobil.

**Keamanan:** `innerHTML` menafsirkan string sebagai HTML. Dalam prototipe ini isinya berasal dari file JSON contoh lokal. Untuk aplikasi nyata, hindari menyisipkan teks yang berasal dari pengguna tanpa pengamanan; gunakan `textContent`/`createElement` bila sesuai agar teks tidak dianggap markup atau skrip berbahaya.

## 6.7 Memformat tarif dengan `Number()` dan `toLocaleString()`

```js
`Rp ${Number(item.tarif).toLocaleString('id-ID')}`
```

- `Number(item.tarif)` mengubah nilai menjadi tipe Number jika memungkinkan.
- `.toLocaleString('id-ID')` memformat angka mengikuti kebiasaan lokal Indonesia, misalnya menggunakan titik sebagai pemisah ribuan pada browser dengan locale tersebut.
- Teks `Rp ` adalah string biasa yang ditambahkan sebelum angka.

Jika nilai tarif tidak bisa menjadi angka, hasil konversinya bisa `NaN` (*Not a Number*). Karena itu data JSON perlu dijaga valid.

## 6.8 Memilih badge berdasarkan status: ternary operator

Kode revisi menggunakan pola seperti:

```js
item.status === 'Tersedia'
    ? 'badge-success'
    : (item.status === 'Disewa' ? 'badge-warning' : 'badge-danger')
```

Operator ternary memiliki bentuk:

```js
kondisi ? nilaiJikaBenar : nilaiJikaSalah
```

Pada contoh:
- jika status `Tersedia`, pakai `badge-success`;
- jika tidak tersedia tetapi status `Disewa`, pakai `badge-warning`;
- jika kedua kondisi salah, pakai `badge-danger`.

Karena ternary kedua berada di bagian “salah” ternary pertama, ada tanda kurung untuk mempermudah pembacaan. Status apa pun selain `Tersedia` atau `Disewa` akan memperoleh `badge-danger` pada kode tersebut, termasuk `Perbaikan`.

## 6.9 Menangani error dengan `.catch()`

```js
.catch(err => {
    console.error('Gagal mengambil data buku.json:', err);
    listBuku.innerHTML = '<tr><td colspan="6">Gagal memuat data mobil.</td></tr>';
});
```

- `err` berisi informasi error.
- `console.error()` menulis pesan pada Console Developer Tools.
- Kode mengganti isi tabel dengan pesan kegagalan.
- `colspan="6"` membuat pesan mengisi lebar enam kolom.

**Catatan teknis:** `fetch()` tidak otomatis menolak Promise hanya karena server mengembalikan HTTP 404 atau 500. Praktik yang lebih tangguh adalah memeriksa `response.ok` sebelum parsing JSON, misalnya:

```js
fetch('../data/buku.json')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // render data
    })
    .catch(err => {
        console.error(err);
    });
```

Snippet `response.ok` ini adalah **saran pengayaan**, bukan bentuk yang saat ini dipakai dalam file revisi.

## 6.10 Memahami file `buku.js` dengan urutan logis

Kode revisi melakukan beberapa tugas dalam satu file:

1. Menunggu `DOMContentLoaded`.
2. Mencari `tbody#list-buku`, form `#form-tambah-buku`, tombol menu, dan sidebar.
3. Jika tombol menu dan sidebar ada, pasang event click untuk membuka/menutup class `active`.
4. Jika `listBuku` ada, jalankan `fetch('../data/buku.json')`.
5. Setelah data berhasil dibaca, `map()` membuat satu baris HTML untuk tiap object.
6. `.join('')` menggabungkan semua baris.
7. `listBuku.innerHTML = ...` mengganti isi tabel.
8. Jika pengambilan gagal, tampilkan error di Console dan pesan pada tabel.
9. Jika form tambah ada, daftarkan event `submit`.

Pola `if (listBuku) { ... }` membuat file yang sama aman dipakai pada halaman daftar maupun halaman tambah. Pada halaman tambah, elemen daftar tidak ada sehingga blok rendering dilewati; sebaliknya, elemen form tidak ada di halaman daftar sehingga handler submit dilewati.

`anggota.js` memiliki struktur mirip, tetapi membaca `anggota.json` dan menampilkan properti `id`, `nama`, `nik`, `telepon`, dan `alamat`.

**Catatan pemeriksaan khusus dashboard revisi:** pada HTML, kartu “Mobil Maintenance” dan “Siap Dirental” memiliki ID `mobil-maintenance` dan `mobil-siap`, tetapi `app.js` saat ini tidak menghitung/memperbarui kedua elemen tersebut. Sebaliknya, `app.js` mencoba mencari ID `rental-aktif`, sementara HTML dashboard yang diperiksa tidak memiliki ID itu. Pemeriksaan `if (rentalAktifEl)` mencegah error, tetapi berarti pembaruan “rental aktif” dilewati. Jadi sebagian angka pada dashboard masih angka awal/statistik statis. Ini layak diperbaiki atau dijelaskan sebagai batasan prototipe.

## 6.11 Membaca event submit pada form Jobsheet 06

Potongan aktual:

```js
formTambahBuku.addEventListener('submit', (e) => {
    e.preventDefault();
    const id = document.getElementById('id_mobil').value;
    const merk = document.getElementById('merk').value;

    alert(`Mobil ${merk} (${id}) berhasil ditambahkan!`);
    window.location.href = 'list.html';
});
```

- `'submit'` terjadi saat pengguna mencoba mengirim form.
- `(e) => { ... }` adalah arrow function yang menerima objek event `e`.
- `e.preventDefault()` membatalkan perilaku default event; pada form ini, mencegah browser melakukan pengiriman tradisional/refresh halaman.
- `.value` mengambil nilai input saat ini.
- `alert(...)` menampilkan dialog pesan sederhana.
- `window.location.href = 'list.html'` mengarahkan browser ke halaman daftar.

**Yang perlu diingat:** kode ini tidak memasukkan object baru ke `buku.json`, tidak memanggil API simpan, dan tidak menulis database. Jadi alert “berhasil ditambahkan” adalah simulasi alur UI, bukan bukti bahwa data telah tersimpan. Ketika berpindah ke halaman list, tabel kembali dibangun dari JSON semula.

Tombol Edit/Hapus pada tabel juga masih menggunakan `alert(...)` sebagai contoh. Belum ada update/delete data yang persisten.

## 6.12 `fetch()` memakai path yang berbeda menurut halaman

Dashboard di folder utama:

```js
fetch('data/buku.json')
```

Halaman daftar mobil di folder `buku/`:

```js
fetch('../data/buku.json')
```

Kedua alamat menuju file data yang sama dari posisi awal berbeda. Ini salah satu sumber bug paling umum. Jika alamat salah, lihat tab Network: apakah `buku.json` berhasil diminta dan statusnya sukses?

## 6.12.1 Menu pada Jobsheet 06 dan event klik di luar

Di file `app.js`, pola sidebar Jobsheet 06 lebih sederhana daripada versi Jobsheet 05:

```js
menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
        sidebar.classList.remove('active');
    }
});
```

- `() => { ... }` adalah arrow function tanpa parameter.
- `classList.toggle('active')` menambahkan class jika belum ada, dan menghapus jika sudah ada.
- `e.target` adalah elemen aktual yang menjadi target klik.
- `sidebar.contains(e.target)` memeriksa apakah target klik berada di dalam sidebar. Ini adalah method DOM `contains()`, bukan `classList.contains()` meskipun namanya sama.
- `&&` artinya kedua kondisi harus benar. Jadi sidebar ditutup jika target klik **bukan di dalam sidebar** dan **bukan tombol menu**.
- `!` membalik hasil pemeriksaan, sehingga `!sidebar.contains(e.target)` berarti klik terjadi di luar sidebar.

Perbedaan dengan Jobsheet 05: pada Jobsheet 05 ada overlay khusus, tombol Escape, penutupan saat tautan dipilih, dan pembaruan atribut ARIA. Jobsheet 06 punya pola toggle dan penanganan klik di luar yang lebih sederhana.

## 6.13 `async/await` yang ada pada referensi dosen

Implementasi revisi memakai `.then()` dan `.catch()`. Materi referensi juga menjelaskan pola `async/await`, `try/catch/finally`. Kedua gaya berikut punya tujuan serupa—menjalankan kode yang bergantung pada operasi asinkron—tetapi syntax berbeda.

Versi `.then()`:

```js
fetch('../data/buku.json')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error(error);
    });
```

Versi `async/await` sebagai pengayaan:

```js
async function muatMobil() {
    try {
        const response = await fetch('../data/buku.json');
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error(error);
    } finally {
        console.log('Proses selesai');
    }
}

muatMobil();
```

Penjelasan:
- `async function` mendefinisikan fungsi asinkron.
- `await` menunggu hasil Promise di dalam fungsi `async`, tanpa menghentikan keseluruhan browser untuk melakukan hal lain.
- `try` membungkus kode yang mungkin gagal.
- `catch` menangani error.
- `finally` berjalan pada akhir proses, baik berhasil maupun gagal; cocok untuk menyembunyikan indikator loading.
- `throw new Error(...)` sengaja membuat error agar ditangani `catch` jika respons tidak sukses.

Versi kedua ini **contoh pembelajaran tambahan**, bukan klaim bahwa file proyek saat ini ditulis dengan `async/await`.

## 6.14 AJAX itu apa?

AJAX adalah istilah historis untuk pola mengambil/mengirim data di latar belakang tanpa harus memuat ulang seluruh halaman. `fetch()` adalah API browser modern yang dapat digunakan untuk melakukan permintaan tersebut. Pada proyek ini, browser mengambil file JSON statis dan mengubah tabel/angka pada halaman setelah respons tersedia.

Tetapi proyek belum menjadi sistem backend penuh:
- JSON adalah file statis, bukan database.
- Tidak ada autentikasi/login nyata.
- Tombol tambah/edit/hapus belum mengubah sumber data secara permanen.
- Data dashboard sebagian adalah data contoh, dan statistik penyewaan menggunakan asumsi sederhana dari status mobil.

### Latihan Jobsheet 06

1. Tambahkan objek mobil baru ke JSON dengan lima key yang sama.
2. Jalankan lewat server lokal lalu refresh daftar mobil. Berapa perubahan pada tabel dan statistik?
3. Ubah status satu mobil menjadi `Disewa`, lalu perhatikan perhitungan mobil disewa.
4. Sengaja ubah path `../data/buku.json` menjadi `../data/file-salah.json`. Di mana error terlihat?
5. Mengapa `response.json()` perlu ditangani sebagai Promise?
6. Mengapa alert “berhasil ditambahkan” tidak berarti data telah tersimpan secara permanen?

---

# 7. Merakit ulang proyek dari folder kosong

Bagian ini memberikan urutan praktis membangun proyek. Jangan langsung menyalin seluruh kode; buat satu tahap, jalankan, lalu lanjutkan setelah tahap sebelumnya benar.

## Tahap A — Buat struktur folder

```text
rental-mobil/
├── index.html
├── buku/
│   ├── list.html
│   └── tambah.html
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
│   ├── css/style.css
│   └── js/
│       ├── app.js
│       ├── buku.js
│       └── anggota.js
└── data/
    ├── buku.json
    └── anggota.json
```

## Tahap B — Buat HTML minimal

Mulai `index.html` dengan kerangka HTML. Tambahkan sidebar, topbar, main, dan kartu/tabel. Untuk halaman lain, salin kerangka bersama lalu sesuaikan isi dan path relatif. Pada tahap ini cukup pastikan semua link bekerja.

## Tahap C — Tambahkan CSS dasar

Buat reset, gaya `body`, sidebar, wrapper, topbar, content, card, tabel, tombol, badge, dan form. Terapkan `box-sizing: border-box`. Jangan langsung masuk media query sebelum layout desktop dapat dipahami.

## Tahap D — Tambahkan responsive design

Buat media query pada `1024px`, `768px`, dan `480px` sebagaimana contoh revisi. Pastikan:
- statistik berubah dari empat kolom → dua kolom → satu kolom;
- sidebar keluar dari layar pada ponsel;
- tombol hamburger muncul hanya pada lebar yang cocok;
- overlay tidak menutupi sidebar;
- tabel dapat digulir horizontal;
- form satu kolom dan tombol cukup lebar pada ponsel.

## Tahap E — Tulis wireframe

Buat `docs/wireframe.md` dan dokumentasikan aktor, tujuan, urutan langkah, komponen tiap halaman, serta batasan fitur. Tandai mana flow yang sudah dilaksanakan dan mana yang baru rancangan.

## Tahap F — Sambungkan JavaScript untuk menu

1. Tambahkan ID pada tombol, sidebar, dan overlay.
2. Hubungkan `assets/js/app.js` dengan HTML pada Jobsheet 05.
3. Tunggu `DOMContentLoaded`.
4. Cari elemen dengan `getElementById`.
5. Daftarkan event listener.
6. Tambahkan/hapus class `active`.
7. Uji klik tombol, overlay, link menu, dan Escape.

## Tahap G — Siapkan data JSON

Pastikan setiap object memiliki key yang konsisten. Untuk mobil, data memakai `id`, `merk`, `plat`, `tarif`, dan `status`. Untuk pelanggan, data memakai `id`, `nama`, `nik`, `telepon`, dan `alamat`.

## Tahap H — Fetch dan render

1. Jalankan proyek lewat server lokal.
2. Di `buku.js`, ambil `tbody#list-buku`.
3. Fetch data yang sesuai path.
4. Parse respons dengan `.json()`.
5. Gunakan `map()` untuk membangun string baris.
6. Gunakan `join('')` lalu `innerHTML` untuk memasang hasil.
7. Tambahkan `.catch()` untuk menampilkan error.
8. Ulangi alur serupa untuk pelanggan dan statistik dashboard.

## Tahap I — Uji dari sudut pandang pengguna

- Semua link mengarah ke halaman yang ada.
- CSS dan JS tidak 404.
- Tampilan tidak berantakan di desktop/tablet/mobile.
- Hamburger dapat digunakan dengan klik.
- JSON berhasil di-fetch.
- Jumlah baris di tabel sesuai jumlah objek data.
- Nilai statistik masuk akal.
- Error memunculkan pesan yang dapat diketahui.
- Form dan tombol aksi tidak disebut CRUD penuh jika belum benar-benar menyimpan, mengedit, atau menghapus data.

---

# 8. Kesalahan umum dan cara mengatasinya

## 8.1 CSS tidak berubah

Penyebab umum:
- `href` stylesheet salah.
- Selector CSS tidak cocok dengan `class`/`id` di HTML.
- Ada syntax error seperti kurung kurawal kurang.
- Aturan lain lebih spesifik atau muncul belakangan.
- Browser masih menampilkan cache lama.

Cara mengecek: klik kanan → Inspect → pilih elemen → tab Styles. Lihat apakah stylesheet dimuat dan aturan mana yang menang.

## 8.2 Tombol menu tidak berfungsi

Periksa:
- apakah ID HTML cocok persis dengan string pada JS;
- apakah file JS berhasil di-load;
- apakah console menunjukkan error;
- apakah elemen `sidebar-overlay` ada pada Jobsheet 05;
- apakah aturan `.sidebar.active` memang tersedia di CSS;
- apakah script berjalan setelah DOM siap.

## 8.3 JSON gagal dimuat

Periksa:
- apakah dibuka melalui server lokal;
- apakah path dari halaman saat ini benar (`data/...` atau `../data/...`);
- apakah file JSON valid dan tidak ada koma berlebih;
- tab Network menunjukkan status dan URL yang dipanggil;
- tab Console menunjukkan error parsing atau jaringan.

## 8.4 `Cannot read properties of null`

Artinya kode mencoba membaca properti/memanggil method pada elemen yang tidak ditemukan. Umumnya ID salah atau skrip mencoba mencari elemen yang tidak ada di halaman itu. Gunakan pengecekan:

```js
const target = document.getElementById('target');
if (target) {
    target.textContent = 'Siap';
}
```

Pada proyek, penjaga seperti `if (listBuku) { ... }` menghindari upaya render pada halaman yang tidak punya tabel tersebut.

## 8.5 Data tidak muncul walaupun tidak ada pesan jelas

- Pastikan key pada JSON sama persis dengan properti yang dibaca JS.
- Pastikan selector `tbody` tepat.
- Pastikan hasil akhir disetel ke elemen, misalnya `listBuku.innerHTML = ...`.
- Pastikan elemen memiliki ID yang dicari.
- Pastikan `fetch()` berhasil sebelum render.

## 8.6 Klik simpan tetapi data kembali seperti semula

Ini sesuai batasan proyek saat ini. Handler form hanya mengambil beberapa nilai, menampilkan `alert`, dan berpindah ke daftar. Data sumber JSON tidak diubah oleh browser. Agar data benar-benar tersimpan dibutuhkan API/backend, atau metode penyimpanan lokal yang dirancang khusus untuk latihan; JSON statis yang diambil lewat Fetch tidak menjadi dapat ditulis otomatis.

---

# 9. Kamus syntax cepat

## HTML

| Syntax | Makna |
|---|---|
| `<!DOCTYPE html>` | Mode HTML modern |
| `<tag>isi</tag>` | Elemen dengan tag pembuka dan penutup |
| `class="x"` | Nama kelompok untuk CSS/JS |
| `id="x"` | Penanda unik pada halaman |
| `href="..."` | Alamat tujuan/link/resource stylesheet |
| `src="..."` | Lokasi file sumber, misalnya skrip |
| `type="..."` | Menentukan jenis input/tombol/resource |
| `required` | Field wajib menurut browser |
| `for="x"` | Menghubungkan label dengan ID input |
| `<!-- ... -->` | Komentar HTML |

## CSS

| Syntax | Makna |
|---|---|
| `selector { property: value; }` | Bentuk aturan CSS |
| `*` | Universal selector |
| `.class` | Selector class |
| `#id` | Selector ID |
| `:hover`, `:focus`, `:checked` | Pseudo-class keadaan tertentu |
| `display: flex` | Layout Flexbox |
| `display: grid` | Layout Grid |
| `position: fixed` | Posisi melekat pada viewport |
| `margin` | Ruang luar |
| `padding` | Ruang dalam |
| `border` | Garis tepi |
| `gap` | Jarak ant item Grid/Flexbox |
| `@media (...)` | Aturan bersyarat berdasarkan media/viewport |
| `transform: translateX(...)` | Pergeseran horizontal |
| `transition` | Animasi perubahan property |
| `overflow-x: auto` | Scroll horizontal ketika diperlukan |
| `z-index` | Urutan lapisan pada konteks stacking |

## JavaScript

| Syntax | Makna |
|---|---|
| `const` | Binding variabel yang tidak bisa di-assign ulang |
| `document` | Dokumen halaman aktif |
| `getElementById()` | Ambil elemen berdasarkan ID |
| `querySelector()` | Ambil elemen pertama yang cocok selector CSS |
| `querySelectorAll()` | Ambil semua yang cocok selector CSS |
| `addEventListener()` | Mendaftarkan penangan event |
| `classList.add/remove/toggle/contains()` | Mengelola/memeriksa class |
| `setAttribute()` | Mengatur atribut elemen |
| `if / else` | Percabangan kondisi |
| `return` | Keluar dari fungsi |
| `fetch()` | Mengambil resource secara asinkron |
| `.then()` | Menangani hasil Promise yang berhasil |
| `.catch()` | Menangani Promise yang ditolak/error dalam rantai |
| `.json()` | Membaca body respons sebagai JSON |
| `.map()` | Mengubah setiap item array menjadi item baru |
| `.filter()` | Memilih item array berdasarkan syarat |
| `.length` | Jumlah item atau panjang string |
| `.join('')` | Menyatukan array string tanpa pemisah |
| `.innerHTML` | Mengatur isi sebagai HTML |
| `.textContent` | Mengatur/membaca isi teks |
| `.value` | Membaca nilai input |
| `.preventDefault()` | Membatalkan aksi default event |
| `alert()` | Dialog sederhana |
| `console.error()` | Mencatat error ke Console |
| `window.location.href` | Mengarahkan halaman ke URL lain |
| `` `teks ${nilai}` `` | Template literal untuk menyisipkan nilai |
| `===` | Perbandingan ketat |
| `=>` | Arrow function |

## JSON dan Markdown

| Syntax | Makna |
|---|---|
| `[ ... ]` | Array JSON |
| `{ ... }` | Object JSON |
| `"key": value` | Pasangan key-value |
| `,` | Pemisah item/properti JSON |
| `# Judul` | Heading Markdown tingkat 1 |
| `## Subjudul` | Heading tingkat 2 |
| `- item` | Bullet list |
| `1. item` | Daftar bernomor |
| `` `kode` `` | Kode inline Markdown |
| ` ``` ` | Pembuka/penutup code block |
| `> catatan` | Blockquote Markdown |

---

# 10. Latihan mandiri untuk memastikan benar-benar paham

Cobalah menjawab tanpa melihat catatan terlebih dahulu, lalu cek jawaban ringkas di bawah.

1. Apa bedanya HTML, CSS, JavaScript, dan JSON?
2. Apa perbedaan class dan ID?
3. Mengapa `../assets/css/style.css` dipakai dari `buku/list.html`, tetapi `assets/css/style.css` dipakai dari `index.html`?
4. Apa peran `display: flex` dan `display: grid` di proyek?
5. Mengapa tabel dibungkus `.table-responsive`?
6. Bagaimana checkbox dapat membuka sidebar pada Jobsheet 03 tanpa JavaScript?
7. Apa fungsi `DOMContentLoaded` di Jobsheet 05?
8. Apa beda `.classList.add('active')` dengan `.classList.contains('active')`?
9. Mengapa `fetch()` diikuti `.then(response => response.json())`?
10. Apa beda `map()` dan `filter()`?
11. Mengapa `join('')` digunakan setelah `map()` membuat baris HTML?
12. Mengapa `alert('berhasil ditambahkan')` belum membuktikan data tersimpan?
13. Apa yang berbeda antara `.then/.catch` dan `async/await`?
14. Apa yang harus diperiksa ketika data JSON tidak muncul di tabel?
15. Mengapa Jobsheet 04 termasuk dokumentasi rancangan meski hampir tidak mengubah kode?

## Jawaban ringkas

1. HTML membentuk struktur, CSS mengatur tampilan, JS mengatur perilaku, JSON menyimpan data terstruktur.
2. ID unik untuk satu elemen; class dapat dipakai banyak elemen.
3. Karena alamat relatif dihitung dari lokasi dokumen yang sedang dibuka.
4. Flexbox menyusun item terutama pada satu arah; Grid mengatur baris dan kolom.
5. Agar tabel yang lebar dapat digulir ke samping tanpa merusak seluruh layout mobile.
6. Label mengubah status checkbox; selector `:checked ~ ...` membuat CSS menampilkan sidebar/overlay.
7. Menunggu HTML diparsing sebelum mengambil elemen DOM.
8. `add` menambahkan class; `contains` hanya memeriksa apakah class ada.
9. `fetch()` mengambil respons; `.json()` membaca dan mengurai body respons secara asinkron.
10. `map` mengubah setiap item; `filter` memilih item yang lolos kondisi.
11. Untuk menggabungkan string setiap baris tanpa koma di antaranya.
12. Karena alert hanya pesan; kode tidak mengubah JSON atau menyimpan ke database.
13. Keduanya bisa menangani operasi asinkron, tetapi struktur penulisan dan error handling-nya berbeda.
14. Path, server lokal, JSON valid, nama key, ID/selector, dan error Console/Network.
15. Fokus tahap itu adalah user flow/wireframe; file web dinyatakan identik dengan Jobsheet 03.

---

# Penutup: cara berpikir seorang pembuat website

Ketika melihat satu baris kode, jangan hanya bertanya “syntax ini artinya apa?”. Tanyakan juga:

1. **Siapa yang menggunakannya?** Browser membaca HTML/CSS/JS; JavaScript juga membaca data JSON.
2. **Elemen atau data apa yang dipengaruhi?** Selector, ID, property, dan key JSON harus cocok.
3. **Kapan ia dijalankan?** Saat halaman dimuat, saat klik, saat form dikirim, atau setelah respons fetch diterima?
4. **Apa bukti hasilnya?** Lihat browser, DOM, Console, dan Network.
5. **Apakah benar-benar tersimpan?** Perubahan tampilan tidak otomatis menjadi penyimpanan permanen.

Bila kamu dapat mengikuti alur **HTML membuat tempat → CSS menyusun tampilan → responsive CSS menyesuaikan layar → wireframe merencanakan pengalaman → JavaScript merespons tindakan → Fetch mengambil JSON → JavaScript merender data**, berarti kamu sudah memahami tulang punggung Jobsheet 01–06 dan dapat mulai membangun ulang proyek dari nol.
