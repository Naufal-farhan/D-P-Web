# HANDBOOK JOBSHEET COVER
## Bagian 06 (Terakhir): Responsive, Accessibility, dan Soal UTS Gabungan

Bagian ini menjelaskan baris 509 sampai 592 pada `css/style.css` (dua
media query responsive), merangkum seluruh fitur accessibility yang
tersebar di beberapa file, lalu ditutup dengan **soal UTS gabungan**
yang menguji pemahaman lintas seluruh project.

---

## 1. Media Query: dasar-dasarnya dulu

### 1.1 Apa itu media query?

Media query adalah aturan CSS yang **hanya berlaku pada kondisi
tertentu**, paling sering berdasarkan lebar layar.

```css
@media (max-width: 1024px) {
  /* aturan di sini HANYA berlaku bila lebar layar <= 1024px */
}
```

### 1.2 Kenapa memakai `max-width` (bukan `min-width`)?

| Pendekatan | Cara berpikir |
|------------|---------------|
| **Mobile-first** (`min-width`) | Tulis aturan dasar untuk mobile, lalu tambah aturan untuk layar besar |
| **Desktop-first** (`max-width`) | Tulis aturan dasar untuk desktop, lalu **timpa** untuk layar kecil |

Project ini memakai **desktop-first** karena sesuai instruksi tugas:
"Prioritas: desktop/laptop". Aturan dasar (di luar media query) adalah
tampilan desktop. Media query hanya **mengubah sebagian nilai** saat
layar menyempit.

### 1.3 Kenapa dua breakpoint (1024px dan 640px)?

| Breakpoint | Mewakili | Baris |
|------------|----------|-------|
| `max-width: 1024px` | Tablet (dan laptop kecil) | 525 |
| `max-width: 640px` | Ponsel (mobile) | 556 |

**Kedua breakpoint berlaku menumpuk.** Saat layar 400px lebar, **kedua**
media query aktif sekaligus: aturan tablet (1024px) diterapkan dulu,
lalu aturan mobile (640px) **menimpanya lagi** karena ditulis lebih
akhir. Inilah **cascading** (aturan belakangan menang bila bentrok pada
selector yang sama).

```
Urutan penerapan pada layar 400px:
1. Aturan dasar (desktop)     <- diterapkan duluan
2. @media max-width: 1024px   <- menimpa sebagian nilai
3. @media max-width: 640px    <- menimpa lagi sebagian nilai
```

### 1.4 Trik penting: CSS variable di dalam media query

```css
@media (max-width: 1024px) {
  :root {
    --btn-height: 13vh;
  }
}
```

Alih-alih menulis ulang seluruh aturan `.jobsheet-btn` di dalam media
query, project ini **hanya mengubah nilai variabelnya**. Karena hampir
semua aturan asli sudah memakai `var(--btn-height)`, dsb., perubahan
variabel ini otomatis menyebar ke semua tempat yang memakainya **tanpa
menulis ulang selector apa pun**.

Ini adalah keuntungan besar dari CSS variables yang sudah dibangun sejak
Bagian 04: perubahan responsive menjadi sangat ringkas.

---

## 2. Tablet: `@media (max-width: 1024px)` (baris 525 sampai 545)

```css
@media (max-width: 1024px) {
  :root {
    --left-panel-width: 60%;
    --right-area-width: 40%;
    --page-padding-y: 28px;
    --page-padding-right: 28px;

    --btn-height: 13vh;
    --btn-min-height: 90px;
    --btn-max-height: 140px;
    --btn-number-size: clamp(32px, 4.5vh, 48px);
    --pill-width: 72%;

    --identity-title-size: clamp(26px, 4.5vw, 44px);
    --active-title-size: clamp(15px, 2.2vw, 22px);
  }

  .jobsheet-btn {
    padding-right: 24px;
  }
}
```

### Perbandingan nilai desktop vs tablet

| Variabel | Desktop | Tablet | Alasan |
|----------|---------|--------|--------|
| `--left-panel-width` | 66% | 60% | Kolom kanan diberi ruang lebih (teks identitas butuh lebih banyak tempat relatif di layar sempit) |
| `--right-area-width` | 34% | 40% | Pasangan dari baris di atas (66+34=100, 60+40=100) |
| `--page-padding-y/right` | 40px | 28px | Padding dikurangi supaya ruang konten lebih luas |
| `--btn-height` | 15.5vh | 13vh | Tombol sedikit lebih pendek |
| `--btn-min/max-height` | 110/170px | 90/140px | Batas ukuran diturunkan proporsional |
| `--btn-number-size` | clamp(40,5vh,60) | clamp(32,4.5vh,48) | Angka mengecil |
| `--pill-width` | 78% | 72% | Pill sedikit menyempit |
| `--identity-title-size` | clamp(32,4vw,56) | clamp(26,4.5vw,44) | Judul "JOBSHEET" mengecil, tapi persentase `vw` dinaikkan sedikit (4vw -> 4.5vw) supaya tetap terbaca di layar sempit |

**Kenapa `padding-right` tombol ditulis langsung** (`24px`), bukan lewat
variabel? Karena tidak ada variabel khusus untuk itu di desain aslinya;
nilai `36px` di aturan dasar ditimpa langsung di sini menjadi `24px`
agar proporsional dengan tombol yang mengecil.

---

## 3. Mobile: `@media (max-width: 640px)` (baris 556 sampai 591)

```css
@media (max-width: 640px) {
  :root {
    --left-panel-width: 58%;
    --right-area-width: 42%;
    --page-padding-y: 16px;
    --page-padding-right: 16px;

    --btn-height: 11vh;
    --btn-min-height: 64px;
    --btn-max-height: 100px;
    --btn-gap: 0;
    --btn-overlap: -10px;
    --btn-number-size: clamp(20px, 5vh, 32px);
    --pill-width: 68%;
    --pill-margin-y: 8px;

    --identity-title-size: clamp(18px, 6vw, 30px);
    --identity-name-size: clamp(10px, 2.8vw, 14px);
    --identity-class-size: 9px;
    --active-title-size: clamp(11px, 3.5vw, 16px);

    --btn-shadow-3d: 0 -10px 14px -4px rgba(245, 240, 236, 0.55);
  }

  .jobsheet-btn {
    padding-right: 16px;
  }

  .jobsheet-list {
    padding: 28px 12px 20px 0;
  }

  .start-overlay__btn {
    padding: 14px 28px;
  }
}
```

### Poin-poin penting

**1. Struktur 2 kolom tetap dipertahankan.** Tidak ada perubahan
`flex-direction` dari `row` menjadi `column`. Ini sesuai komentar di
baris 552-554: struktur visual "jobsheet cover" harus tetap konsisten,
hanya ukurannya yang menyusut. Ini keputusan desain, bukan keterbatasan
teknis — bisa saja dibuat tersusun ke bawah, tetapi dipilih tetap
2 kolom agar identitas selalu terlihat berdampingan dengan tombol.

**2. `--btn-overlap` diperkecil (dari -18px ke -10px).** Karena tombol
mobile jauh lebih pendek (`min-height: 64px` dibanding 110px di
desktop), overlap sebesar -18px akan **memakan proporsi tombol terlalu
banyak** (hampir sepertiga tinggi tombol). Nilai -10px menjaga efek
tumpuk tetap proporsional.

**3. `--btn-shadow-3d` ditulis ulang penuh** (bukan cuma sebagian
angka), karena seluruh nilainya (`offset -22px blur 30px spread -8px`)
terlalu besar untuk tombol sekecil ini — bayangan bisa terlihat tidak
proporsional atau bahkan terpotong. Nilai baru (`-10px 14px -4px`) jauh
lebih kecil, sepadan dengan tombol mobile.

**4. `.jobsheet-list` padding ditulis ulang penuh**, bukan lewat
variabel, karena kombinasi nilainya (`28px 12px 20px 0`) spesifik untuk
breakpoint ini dan tidak memakai pola variabel yang sama dengan bagian
lain.

**5. `.start-overlay__btn` padding diperkecil** dari `20px 48px` ke
`14px 28px` supaya tombol "KLIK UNTUK MULAI" tidak terlalu besar di
layar sempit.

### Kenapa `--identity-title-size` di mobile memakai `6vw` (naik dari
`4vw` di desktop dan `4.5vw` di tablet)?

Di layar sangat sempit (misal 375px lebar HP), `4vw` hanya menghasilkan
15px — terlalu kecil untuk judul utama. Dengan `6vw`, hasilnya 22.5px,
lebih terbaca. Persentase `vw` dinaikkan secara bertahap di tiap
breakpoint untuk mengompensasi lebar layar yang makin sempit.

---

## 4. Ringkasan fitur Accessibility (lintas seluruh project)

Fitur aksesibilitas tersebar di beberapa file. Tabel ini merangkumnya
agar mudah dipelajari sebagai satu topik utuh saat UTS.

| Fitur | Lokasi | Fungsi |
|-------|--------|--------|
| `lang="id"` | `index.html` baris 2 | Bahasa halaman untuk pembaca layar |
| `<meta viewport>` | `index.html` baris 5 | Dasar tampilan responsive |
| Elemen `<button>` (bukan `<div>`) | `main.js`, fungsi render | Dukungan keyboard bawaan (Tab, Enter, Space) |
| `aria-label` | `main.js`, fungsi render | Nama tombol yang dibacakan screen reader |
| `alt` pada `<img>` | `main.js`, fungsi render | Teks alternatif gambar |
| Event `focus`/`blur` disatukan dengan `mouseenter`/`mouseleave` | `main.js`, `setupHoverInteraction` | Pengguna keyboard mendapat efek sama dengan pengguna mouse |
| `:focus-visible` pada tombol jobsheet | `style.css` baris 445-448 | Outline hanya muncul untuk navigasi keyboard |
| `:focus-visible` pada tombol overlay | `style.css` baris 504-507 | Outline juga di tombol "KLIK UNTUK MULAI" |
| `<h1>` untuk judul utama | `index.html` baris 46 | Struktur dokumen yang benar bagi pembaca layar |
| `<title>` deskriptif | `index.html` baris 6 | Identitas halaman di tab dan bookmark |

### Kenapa aksesibilitas dianggap penting di project statis sederhana?

Tiga alasan utama:

1. **Inklusivitas.** Tidak semua pengguna memakai mouse; sebagian memakai
   keyboard atau pembaca layar (screen reader) karena keterbatasan
   penglihatan atau motorik.
2. **Praktik industri.** Standar web modern (WCAG - Web Content
   Accessibility Guidelines) menjadikan ini bagian dari kualitas kode,
   bukan fitur tambahan opsional.
3. **Biaya rendah, manfaat besar.** Di project ini, menambah `aria-label`
   dan menyatukan `focus`/`blur` dengan logika hover yang sudah ada
   hanya butuh sedikit kode tambahan (lihat Bagian 03), tapi manfaatnya
   signifikan.

---

## 5. Peta lengkap seluruh project (untuk dihafal sebagai satu kesatuan)

```
index.html
├── <head>: meta, title, link ke style.css
└── <body>
    ├── div.start-overlay          --> style.css baris 459-478
    │   └── button                 --> style.css baris 480-507
    ├── div.page                   --> style.css baris 159-165
    │   ├── section.jobsheet-panel --> style.css baris 171-184
    │   │   └── div.jobsheet-list  --> style.css baris 186-197
    │   │       └── [16x button.jobsheet-btn, dibuat main.js]
    │   │                          --> style.css baris 274-448
    │   └── section.right-area     --> style.css baris 203-207
    │       ├── div.identity       --> style.css baris 210-239
    │       └── div.active-title   --> style.css baris 241-259
    └── script main.js
        ├── jobsheets[]             (data 16 tombol)
        ├── widthPattern[]          (pola lebar)
        ├── renderJobsheetButtons() (membuat 16 tombol)
        ├── setupStartOverlay()     (aksi klik overlay)
        ├── setupHoverInteraction() (aksi hover + fokus)
        ├── setupClickNavigation()  (aksi klik pindah halaman)
        └── DOMContentLoaded        (menjalankan 4 fungsi di atas)

Semua warna, ukuran, dan durasi animasi diatur lewat
CSS variables di :root (style.css baris 18-123),
dan diubah ulang sebagiannya di dua media query
(style.css baris 525-591) untuk tablet dan mobile.
```

---

## 6. Soal UTS Gabungan (menguji hubungan antar bagian)

Soal-soal berikut sengaja menghubungkan HTML, CSS, dan JS sekaligus,
karena soal UTS sering menguji pemahaman **alur**, bukan hanya hafalan
satu file.

**Soal 1.** Jelaskan alur lengkap dari saat file `index.html` dibuka
sampai 16 tombol siap dipakai. Sebutkan file dan fungsi yang terlibat di
tiap langkah.

> **Jawaban:** Browser membaca `index.html`, memuat `css/style.css` dari
> `<head>`. Browser membuat elemen di `<body>`, termasuk `div#jobsheetList`
> yang masih kosong. Browser memuat `js/main.js` di baris terakhir body.
> Setelah event `DOMContentLoaded`, dijalankan berurutan:
> `renderJobsheetButtons()` (membuat 16 tombol dari array `jobsheets` dan
> memasangnya ke `#jobsheetList`), `setupStartOverlay()`,
> `setupHoverInteraction()`, dan `setupClickNavigation()` (keduanya
> memerlukan tombol sudah ada, makanya dipanggil setelah render).

**Soal 2.** Mengapa lebar tombol diatur lewat **kombinasi** JavaScript
dan CSS, bukan salah satunya saja?

> **Jawaban:** JavaScript (`widthPattern` dan operator modulo)
> menentukan **class mana** yang dipasang ke tiap tombol berdasarkan
> urutannya. CSS (`--btn-width-short`, dst di `:root`, dan aturan
> `.jobsheet-btn.w-short`) menentukan **nilai lebar sebenarnya** untuk
> tiap class. Pembagian ini memisahkan "logika pola" (JS) dari
> "nilai visual" (CSS), sesuai prinsip pemisahan tanggung jawab.

**Soal 3.** Saat pengguna menekan Tab untuk berpindah ke tombol 05, apa
saja yang terjadi, dan di file/fungsi mana masing-masing diatur?

> **Jawaban:** Browser memindahkan fokus ke tombol 05, memicu event
> `focus` yang dipasang `setupHoverInteraction()` di `main.js`,
> menjalankan `activate()`: tombol lain dilepas dari `is-active`
> (`main.js`), tombol 05 diberi class `is-active` (`main.js`) yang
> membuat CSS di `style.css` menjalankan animasi (pill terisi oren,
> foto muncul, tombol memanjang, glow, outline `:focus-visible`),
> `z-index` dinaikkan (`main.js`), judul diisi dan ditampilkan
> (`main.js` mengubah `textContent` dan class `is-visible`, `style.css`
> menganimasikan `opacity`), dan suara diputar (`main.js`).

**Soal 4.** Apa yang akan terjadi bila `renderJobsheetButtons()`
sengaja dipanggil **setelah** `setupHoverInteraction()` di bagian init?
Jelaskan sebabnya secara teknis.

> **Jawaban:** Hover dan fokus tidak akan berfungsi sama sekali pada
> semua tombol. Sebab: `setupHoverInteraction()` mengambil daftar tombol
> dengan `list.querySelectorAll(".jobsheet-btn")` pada saat ia
> dijalankan. Bila belum ada tombol di HTML (karena render belum
> terjadi), hasilnya daftar kosong, dan `forEach` pada daftar kosong
> tidak memasang event apa pun ke tombol yang baru dibuat setelahnya.

**Soal 5.** Bagaimana caranya mengganti seluruh skema warna (misal dari
oren menjadi biru), dan berapa baris kode yang perlu diubah minimal?

> **Jawaban:** Minimal 2 baris: `--color-btn-accent` dan
> `--glow-color-1` di `:root` (`style.css`). Karena seluruh bagian lain
> (pill saat hover, outline fokus, tombol overlay, cahaya) memakai
> `var(--color-btn-accent)` dan `var(--glow-color-1)`, perubahan di dua
> variabel ini otomatis menyebar ke semua tempat tanpa menyentuh HTML
> atau JS sama sekali.

**Soal 6.** Jelaskan mengapa struktur folder (`css/`, `js/`, `assets/`)
dan struktur kode (data terpisah dari render, style terpisah dari
HTML) sama-sama menerapkan prinsip yang sama. Sebutkan nama prinsip
tersebut.

> **Jawaban:** Prinsipnya adalah **separation of concerns** (pemisahan
> tanggung jawab). Pada level folder: struktur (HTML), tampilan (CSS),
> perilaku (JS), dan aset (gambar/suara) dipisah. Pada level kode di
> `main.js`: data (`jobsheets`) dipisah dari logika pembuatan tombol
> (`renderJobsheetButtons`), dan logika itu dipisah lagi dari logika
> interaksi (`setupHoverInteraction`, dst). Tujuannya sama: setiap
> bagian mudah dipahami, diubah, dan diuji secara independen.

**Soal 7.** Dua breakpoint responsive (1024px dan 640px) sama-sama
mengubah variabel `:root`. Jika lebar layar adalah 500px, urutan aturan
mana saja yang berlaku dan mana yang menang jika ada nilai yang
tumpang tindih?

> **Jawaban:** Pada lebar 500px, ketiganya berpotensi relevan: aturan
> dasar (desktop, di luar media query), lalu `@media max-width: 1024px`
> (karena 500 <= 1024), lalu `@media max-width: 640px` (karena
> 500 <= 640). Ketiganya diterapkan berurutan sesuai letaknya di file
> (cascading), dan karena media query 640px ditulis **paling akhir**,
> nilai-nilai di dalamnya yang **menang** untuk variabel yang sama-sama
> diubah oleh kedua breakpoint.

**Soal 8.** Sebutkan satu contoh di project ini di mana JavaScript
"menitipkan" tampilan sepenuhnya ke CSS, dan jelaskan keuntungannya
dibanding JS mengatur tampilan secara langsung (misal lewat
`btn.style.backgroundColor = "orange"`).

> **Jawaban:** Contohnya seluruh efek `is-active` (pill oren, foto
> muncul, tombol memanjang, glow). JS hanya menjalankan
> `btn.classList.add("is-active")`. Keuntungannya: styling tetap
> terpusat di satu file (`style.css`) dan mudah diubah tanpa
> menyentuh logika JS; CSS juga lebih efisien mengelola animasi
> (`transition`) dibanding mengatur ulang gaya lewat JavaScript
> berulang kali.

**Soal 9.** Mengapa project ini disebut memenuhi prinsip "mudah diedit
tanpa memahami seluruh kode" (salah satu syarat tugas)? Berikan tiga
contoh konkret dari file berbeda.

> **Jawaban:** (1) Di `main.js`, mengganti judul atau link jobsheet
> cukup mengedit array `jobsheets` tanpa memahami fungsi render atau
> event. (2) Di `style.css`, mengganti warna aksen cukup mengedit
> `--color-btn-accent` di `:root` tanpa memahami seluruh aturan CSS
> lain. (3) Di `index.html`, mengganti nama atau kelas cukup mengedit
> teks di dalam `<p class="identity-name">` tanpa memahami struktur
> HTML lainnya.

**Soal 10.** Jika kamu diminta menambahkan tombol ke-17, langkah apa
saja yang perlu dilakukan, dan apakah perlu mengubah `style.css`?

> **Jawaban:** Cukup menambahkan satu object baru ke array `jobsheets`
> di `main.js` (nomor "17", judul, link, gambar, suara). Tidak perlu
> mengubah `style.css` maupun `index.html`, karena: lebar tombol
> otomatis mengikuti pola berulang (modulo 4), z-index otomatis
> dihitung ulang berdasarkan `jobsheets.length`, dan seluruh styling
> tombol sudah berupa aturan class generik (`.jobsheet-btn`, dst) yang
> berlaku untuk tombol apa pun tanpa perlu aturan baru per tombol.

---

## 7. Penutup

Seluruh 6 phase pembangunan project dan 6 bagian handbook ini saling
berkaitan sebagai berikut:

| Phase pembangunan | Bagian handbook |
|--------------------|------------------|
| Phase 1: struktur dasar | Bagian 00, 01 |
| Phase 2: styling tombol, identitas, background | Bagian 04 (sebagian) |
| Phase 3: 16 tombol dan scroll | Bagian 02 |
| Phase 4: hover, animasi, judul dinamis | Bagian 03, 05 |
| Phase 5: image, sound, navigasi | Bagian 02, 03 |
| Phase 6: polishing, responsive, accessibility | Bagian 06 (bagian ini) |

Untuk persiapan UTS, disarankan membaca ulang **Bagian 00** (gambaran
umum dan konsep dasar) sebagai fondasi, lalu **soal UTS gabungan** di
bagian ini untuk menguji pemahaman menyeluruh, sebelum meninjau detail
tiap file bila masih ada yang kurang yakin.

---

*Sebelumnya: Bagian 05 (`style.css` tombol, animasi, overlay)*
*Selesai — ini adalah bagian terakhir handbook.*
