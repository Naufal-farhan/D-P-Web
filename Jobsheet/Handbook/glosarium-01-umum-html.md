# GLOSARIUM JOBSHEET COVER
## Bagian 01: Konsep Umum dan Istilah HTML

> Glosarium ini adalah pelengkap Handbook (file `00` sampai `06`).
> Setiap istilah dijelaskan lebih dalam, disertai contoh kode singkat
> dan rujukan ke bagian handbook mana istilah itu dibahas. Susunan
> mengikuti urutan bahasa: **Umum -> HTML -> CSS -> JavaScript**.
>
> **Daftar glosarium:**
> - 01: Konsep umum dan istilah HTML (file ini)
> - 02: Istilah CSS
> - 03: Istilah JavaScript

---

## Bagian A: Konsep Umum (lintas bahasa)

### Website statis
Website yang file HTML, CSS, dan JS-nya dikirim ke browser **apa
adanya**, tanpa diproses server (tanpa PHP, database, atau logika
sisi server). Lawannya adalah website dinamis, yang isinya dihasilkan
server saat diminta (misal WordPress).
> *Rujukan: Handbook 00, bagian 1.*

### Vanilla JavaScript
JavaScript murni tanpa framework (React, Vue, Angular) dan tanpa
library (jQuery). Nama "vanilla" adalah kiasan dari "rasa polos", sama
seperti es krim vanila sebagai rasa dasar sebelum ditambah rasa lain.
```javascript
// Vanilla JS - langsung API browser
document.getElementById("judul");

// Bukan vanilla (contoh jQuery, TIDAK dipakai di project ini)
// $("#judul");
```
> *Rujukan: Handbook 00, bagian 2.*

### Separation of concerns (pemisahan tanggung jawab)
Prinsip desain perangkat lunak: setiap bagian kode hanya mengurus **satu
tanggung jawab**. Di project ini diterapkan lewat pemisahan HTML
(struktur), CSS (tampilan), dan JS (perilaku) ke file berbeda, dan juga
di dalam `main.js` sendiri (data terpisah dari fungsi render, fungsi
render terpisah dari fungsi interaksi).
> *Rujukan: Handbook 00 bagian 3; Handbook 06 soal gabungan nomor 6.*

### Single source of truth (satu sumber kebenaran)
Prinsip bahwa satu data seharusnya hanya disimpan di **satu tempat**,
supaya tidak ada dua salinan yang bisa berbeda/tidak sinkron. Di
project ini diterapkan lewat array `jobsheets` di `main.js`: seluruh
konten 16 tombol (nomor, judul, link, gambar, suara) hanya disimpan di
sana, tidak diulang di HTML.
> *Rujukan: Handbook 02, bagian 2.*

### DOM (Document Object Model)
Representasi halaman HTML sebagai **pohon objek** yang bisa dibaca dan
diubah JavaScript. Setiap tag HTML (`<div>`, `<button>`, dst) menjadi
sebuah objek/node dalam pohon ini. Istilah "DOM tree" merujuk pada
bentuk pohonnya (elemen induk punya elemen anak, dst).
```javascript
document.getElementById("jobsheetList")   // mengambil satu node DOM
```
> *Rujukan: Handbook 00 bagian 5.1; Handbook 01 bagian 8 (diagram pohon).*

### Event
Kejadian yang terjadi di halaman web, seperti klik, hover, tekan
tombol, atau selesai memuat halaman. Event adalah dasar dari
"interaktivitas" sebuah halaman.
> *Rujukan: Handbook 00 bagian 5.2.*

### Event listener
Kode yang "menunggu" sebuah event terjadi pada elemen tertentu, lalu
menjalankan fungsi sebagai responsnya. Dipasang dengan method
`addEventListener`.
```javascript
elemen.addEventListener("click", fungsiYangDijalankan);
```
> *Rujukan: Handbook 00 bagian 5.2; Handbook 03 seluruh bagian.*

### Callback function
Fungsi yang diberikan sebagai **argumen** ke fungsi lain, untuk
dijalankan nanti (bukan langsung). Fungsi kedua parameter
`addEventListener` adalah contoh callback: ia tidak dijalankan saat itu
juga, melainkan disimpan dan dijalankan **nanti** saat event terjadi.
```javascript
btn.addEventListener("click", () => { /* ini callback */ });
```
> *Rujukan: Handbook 03 bagian 2.5 (penjelasan kenapa `activate` ditulis
> tanpa kurung).*

### State (keadaan)
Kondisi suatu elemen pada satu waktu tertentu, misalnya "aktif" atau
"tidak aktif". Di project ini, state dikelola lewat class CSS
(`is-active`, `is-visible`, `is-hidden`) yang ditambah/dihapus oleh JS.
> *Rujukan: Handbook 00 bagian 5.3.*

### Class-based state management
Teknik: JavaScript **hanya** menambah/menghapus class pada elemen,
sedangkan **CSS** yang menentukan bagaimana tampilan elemen berubah
berdasarkan class itu. Keuntungannya, logika (JS) dan tampilan (CSS)
tetap terpisah.
```javascript
btn.classList.add("is-active");      // JS: hanya ubah class
```
```css
.jobsheet-btn.is-active { ... }      /* CSS: yang atur tampilannya */
```
> *Rujukan: Handbook 00 bagian 5.3; Handbook 05 bagian pembuka.*

### Data-driven rendering
Teknik membuat tampilan (misal 16 tombol) secara **otomatis** dari
data (array/object), memakai perulangan, alih-alih menuliskan tiap
elemen satu per satu secara manual.
> *Rujukan: Handbook 00 bagian 5.5; Handbook 02 seluruh bagian.*

### Autoplay policy (kebijakan autoplay browser)
Aturan keamanan pada browser modern yang **memblokir** audio/video
diputar otomatis sebelum pengguna melakukan interaksi (klik/tap/tekan
tombol) di halaman. Ini alasan project butuh layar "KLIK UNTUK MULAI".
> *Rujukan: Handbook 00 bagian 5.6; Handbook 03 bagian 1.*

### Responsive (design)
Pendekatan desain web agar tampilan menyesuaikan diri dengan berbagai
ukuran layar (desktop, tablet, ponsel), biasanya lewat kombinasi satuan
fleksibel (`%`, `vw`, `vh`) dan media query.
> *Rujukan: Handbook 06 bagian 1-3.*

### Accessibility (aksesibilitas), sering disingkat a11y
Praktik membuat website bisa dipakai oleh pengguna dengan berbagai
kebutuhan, termasuk yang memakai keyboard saja atau pembaca layar
(screen reader), bukan hanya mouse. Angka "11" pada "a11y" menghitung
jumlah huruf yang dihilangkan antara "a" dan "y" pada kata
*accessibility*.
> *Rujukan: Handbook 06 bagian 4.*

### Screen reader (pembaca layar)
Perangkat lunak yang membacakan isi halaman secara lisan bagi pengguna
dengan keterbatasan penglihatan. Screen reader mengandalkan struktur
HTML yang benar dan atribut seperti `aria-label` dan `alt` untuk
memberi konteks pada elemen yang tidak sepenuhnya jelas secara visual.
> *Rujukan: Handbook 02 bagian 4.6; Handbook 06 bagian 4.*

---

## Bagian B: Istilah HTML

### Tag
Penanda awal dan akhir suatu elemen HTML, ditulis dengan kurung siku.
```html
<p>...</p>
   ^tag pembuka   ^tag penutup (dengan garis miring)
```

### Elemen
Satu kesatuan tag pembuka, isi, dan tag penutup (atau tag tunggal untuk
elemen yang tidak berisi apa-apa).
```html
<p>Ini satu elemen</p>
<br />                    <!-- elemen tunggal, tidak butuh penutup -->
```

### Atribut
Informasi tambahan yang ditempelkan pada tag pembuka, ditulis sebagai
pasangan `nama="nilai"`.
```html
<link rel="stylesheet" href="css/style.css" />
      ^atribut          ^atribut
```
> *Rujukan: Handbook 01 bagian 1 (tabel penjelasan tag head).*

### DOCTYPE
Deklarasi di baris paling atas dokumen HTML yang memberi tahu browser
versi HTML yang dipakai. `<!DOCTYPE html>` berarti HTML5, versi modern
saat ini.
> *Rujukan: Handbook 01 bagian 1; soal 1.*

### Elemen root (akar)
Elemen paling atas yang membungkus seluruh isi dokumen, yaitu `<html>`.
Selector CSS `:root` menunjuk elemen ini.
> *Rujukan: Handbook 01 bagian 1; Handbook 04 bagian 2.1.*

### `<head>` dan `<body>`
Dua bagian utama dokumen HTML. `<head>` berisi **metadata** (informasi
tentang halaman yang tidak tampil langsung: judul tab, link CSS, dsb).
`<body>` berisi **semua yang tampil di layar**.
> *Rujukan: Handbook 01 bagian 1, 2.*

### Metadata
Informasi tentang suatu dokumen, bukan isi dokumen itu sendiri. Contoh:
`<meta charset="UTF-8" />` adalah metadata tentang pengodean karakter
halaman.
> *Rujukan: Handbook 01 bagian 1.*

### Character encoding (pengodean karakter), contoh UTF-8
Sistem yang menentukan bagaimana karakter (huruf, angka, simbol)
diubah menjadi kode digital agar bisa ditampilkan dengan benar. UTF-8
adalah standar paling umum saat ini, mendukung hampir semua huruf di
dunia.
> *Rujukan: Handbook 01 bagian 1.*

### Viewport
Area tampilan yang terlihat oleh pengguna pada layar perangkat. Tag
`<meta name="viewport">` mengatur bagaimana halaman diskalakan pada
perangkat berbeda, kunci utama untuk membuat halaman responsive.
```html
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
```
> *Rujukan: Handbook 01 bagian 1.*

### Elemen semantik
Elemen HTML yang **namanya menjelaskan makna/isinya**, bukan sekadar
wadah generik. Contoh: `<section>`, `<h1>`, `<button>` adalah semantik;
`<div>` dan `<span>` adalah generik (tanpa makna khusus).
```html
<section class="jobsheet-panel">...</section>   <!-- semantik -->
<div class="page">...</div>                     <!-- generik -->
```
> *Rujukan: Handbook 01 bagian 5, soal 7.*

### Heading (`<h1>` sampai `<h6>`)
Elemen judul/kepala tulisan, bertingkat dari `<h1>` (paling penting)
sampai `<h6>`. Hanya boleh ada **satu** `<h1>` per halaman sebagai judul
utama.
> *Rujukan: Handbook 01 bagian 6, soal 10.*

### `id` vs `class`
Dua cara memberi nama pada elemen HTML untuk keperluan CSS/JS. `id`
harus **unik** (hanya satu elemen boleh memakainya dalam satu halaman);
dipakai untuk menunjuk **satu** elemen spesifik (misal oleh
`document.getElementById`). `class` boleh dipakai **berulang** oleh
banyak elemen; dipakai untuk mengelompokkan elemen yang gayanya sama.
```html
<div class="jobsheet-list" id="jobsheetList">
```
> *Rujukan: Handbook 01 bagian 5, soal 6.*

### Komentar HTML
Teks di dalam kode yang **diabaikan browser**, hanya untuk catatan bagi
pembaca kode manusia.
```html
<!-- Ini komentar, tidak tampil di halaman -->
```
> *Rujukan: Handbook 01, muncul di berbagai contoh kode.*

### Path relatif (relative path) vs absolut (absolute URL)
Dua cara menulis lokasi/alamat sebuah file atau halaman.

| Jenis | Contoh | Arti |
|-------|--------|------|
| Relative | `./css/style.css` | Lokasi dihitung dari posisi file saat ini |
| Absolute | `https://example.com/page` | Alamat lengkap, tidak bergantung posisi file |

`./` berarti "folder yang sama dengan file ini berada". Path relatif
dipakai di project untuk menghubungkan `index.html` ke `css/style.css`
dan untuk link antar halaman jobsheet di dalam proyek yang sama.
> *Rujukan: Handbook 01 bagian 1; Handbook 02 bagian 2 (contoh link).*

### BEM (Block, Element, Modifier)
Konvensi/gaya penamaan class CSS yang menunjukkan **hubungan** antar
elemen lewat namanya. Pola: `block__element--modifier` (project ini
memakai variasi tanpa modifier bergaris ganda, cukup class terpisah
seperti `is-active`).

| Bagian | Contoh di project | Arti |
|--------|--------------------|------|
| Block | `jobsheet-btn` | Komponen utama |
| Element | `jobsheet-btn__pill` | Bagian dari block itu (garis bawah ganda `__`) |
| Modifier/state | `is-active` | Variasi keadaan block/element itu |

> *Rujukan: Handbook 01 bagian 3.*

### FOUC (Flash of Unstyled Content)
Kilatan singkat halaman tampil **tanpa gaya CSS** sebelum CSS selesai
dimuat, biasanya karena CSS dimuat terlalu belakangan. Dihindari dengan
menaruh `<link rel="stylesheet">` di `<head>`, sebelum konten `<body>`
dibaca browser.
> *Rujukan: Handbook 01 bagian 1 (catatan setelah tabel).*

### Self-closing tag (tag tertutup sendiri)
Tag yang tidak memiliki isi maupun tag penutup terpisah, ditulis dengan
garis miring sebelum kurung tutup.
```html
<br />
<meta charset="UTF-8" />
<img src="foto.jpg" alt="..." />
```
> *Rujukan: Handbook 01 bagian 1, 6.*

---

*Lanjut ke Bagian 02: Istilah CSS*
