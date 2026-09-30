# HANDBOOK JOBSHEET COVER
## Bagian 01: `index.html` (Penjelasan Baris per Baris)

File ini adalah **kerangka** halaman. Isinya hanya struktur elemen.
Tampilan diatur `style.css`, perilaku diatur `main.js`.

---

## 1. Bagian kepala dokumen (baris 1 sampai 8)

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JOBSHEET - Naufal Farhan Nur Ramadhan</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
```

| Baris | Kode | Penjelasan |
|-------|------|-----------|
| 1 | `<!DOCTYPE html>` | Memberi tahu browser bahwa ini dokumen **HTML5**. Tanpa ini, browser bisa masuk "quirks mode" dan menampilkan halaman dengan aturan kuno yang tidak konsisten. |
| 2 | `<html lang="id">` | Elemen akar (root) semua isi halaman. Atribut `lang="id"` menyatakan bahasa halaman adalah **Indonesia**. Berguna untuk pembaca layar (agar melafalkan dengan benar) dan mesin pencari. |
| 3 | `<head>` | Bagian **metadata**: informasi tentang halaman yang tidak tampil langsung di layar. |
| 4 | `<meta charset="UTF-8" />` | Menetapkan pengodean karakter **UTF-8** supaya huruf khusus tampil benar. |
| 5 | `<meta name="viewport" ...>` | Wajib untuk **responsive**. `width=device-width` membuat lebar halaman mengikuti lebar layar perangkat. `initial-scale=1.0` membuat zoom awal 100%. Tanpa ini, HP akan menampilkan halaman seperti layar desktop yang diperkecil. |
| 6 | `<title>` | Teks yang tampil di **tab browser**. Juga dipakai saat halaman disimpan sebagai bookmark. |
| 7 | `<link rel="stylesheet" href="css/style.css" />` | Menghubungkan file CSS. `rel="stylesheet"` = jenis hubungan (lembar gaya), `href` = lokasi file. Path `css/style.css` bersifat **relatif** terhadap `index.html`. |
| 8 | `</head>` | Penutup bagian head. |

**Kenapa CSS ditaruh di head?** Supaya CSS dimuat **sebelum** halaman
digambar. Kalau CSS dimuat belakangan, pengguna akan sempat melihat
halaman polos tanpa gaya lalu tiba-tiba berubah (disebut FOUC, Flash of
Unstyled Content).

---

## 2. Pembuka body (baris 9)

```html
<body>
```

Bagian `<body>` berisi semua yang **tampil di layar**.

---

## 3. Start Overlay (baris 11 sampai 23)

```html
<div class="start-overlay" id="startOverlay">
  <button class="start-overlay__btn" id="startOverlayBtn" type="button">
    KLIK UNTUK MULAI
  </button>
</div>
```

| Bagian | Penjelasan |
|--------|-----------|
| `<div class="start-overlay" id="startOverlay">` | `div` adalah wadah generik tanpa makna khusus. Ini adalah **lapisan penutup layar penuh**. `class` dipakai CSS untuk styling. `id` dipakai JS untuk mencari elemen ini. |
| `<button ... type="button">` | Tombol yang bisa diklik. `type="button"` menegaskan bahwa tombol ini **bukan tombol submit form**. Praktik baik agar tidak salah perilaku bila suatu saat berada di dalam form. |
| `id="startOverlayBtn"` | Pengenal unik agar JS bisa memasang aksi klik. |
| `KLIK UNTUK MULAI` | Teks yang tampil di tombol. |

**Kenapa overlay ditaruh paling atas di body?** Posisi di HTML tidak
menentukan seberapa "di atas" tampilannya (itu diatur `z-index` di CSS).
Namun menaruhnya di awal memudahkan dibaca sebagai "hal pertama yang
dilihat pengguna".

**Catatan komentar lama:** Komentar di baris 16 menyebut
`setupAudioUnlock`. Nama itu adalah versi lama. Fungsi yang sekarang
dipakai bernama `setupStartOverlay` (di `main.js`). Fungsinya sama:
membuka izin audio lewat interaksi pertama pengguna.

### Konvensi penamaan class: BEM

Nama seperti `start-overlay__btn` mengikuti gaya **BEM** (Block, Element,
Modifier):

- `start-overlay` = **Block** (komponen utama)
- `__btn` = **Element** (bagian dari komponen itu)
- `is-hidden`, `is-active` = **Modifier/state** (keadaan)

Kegunaannya: nama class langsung menunjukkan hubungan antar elemen.
`jobsheet-btn__pill` jelas milik `jobsheet-btn`.

---

## 4. Pembungkus utama (baris 25 sampai 29)

```html
<div class="page">
```

Wadah yang membungkus **seluruh isi halaman** selain overlay. Di CSS,
elemen ini akan dibagi menjadi dua kolom (kiri: tombol, kanan: identitas).
Perhatikan penutupnya di baris 63: `</div>`.

---

## 5. Panel kiri (baris 31 sampai 41)

```html
<section class="jobsheet-panel" id="jobsheetPanel">
  <div class="jobsheet-list" id="jobsheetList">
    <!-- Tombol jobsheet dirender secara dinamis ... -->
  </div>
</section>
```

| Bagian | Penjelasan |
|--------|-----------|
| `<section>` | Elemen **semantik** untuk mengelompokkan bagian konten. Lebih bermakna daripada `div` karena memberi tahu browser dan pembaca layar bahwa ini bagian tersendiri. |
| `class="jobsheet-panel"` | Panel yang **boleh discroll** (diatur di CSS dengan `overflow-y: auto`). |
| `<div class="jobsheet-list" id="jobsheetList">` | Wadah **tempat 16 tombol akan dimasukkan**. |
| Komentar di dalamnya | Wadah ini sengaja **kosong** di HTML. Isinya dibuat oleh JavaScript. |

**Kenapa dua lapis (panel lalu list)?**
- `jobsheet-panel` bertugas **membatasi tinggi dan mengatur scroll**.
- `jobsheet-list` bertugas **menyusun tombol** (flexbox kolom dan padding).

Memisahkan dua tugas ini membuat CSS lebih rapi.

**Kenapa `id="jobsheetList"`?** Karena JS memakainya:
`document.getElementById("jobsheetList")`. Elemen dengan `id` mudah dan
cepat dicari.

---

## 6. Area kanan (baris 43 sampai 61)

```html
<section class="right-area">

  <div class="identity">
    <h1 class="identity-title">JOBSHEET</h1>
    <p class="identity-name">Naufal Farhan Nur<br />Ramadhan</p>
    <p class="identity-class">TI-2D</p>
  </div>

  <div class="active-title" id="activeTitle">
    <!-- Contoh: 01-PENGENALAN HTML -->
  </div>

</section>
```

### Blok identitas

| Elemen | Penjelasan |
|--------|-----------|
| `<h1>` | **Heading level 1**, judul utama halaman. Hanya boleh ada satu `h1` per halaman. Penting untuk struktur dan SEO. |
| `<p class="identity-name">` | Paragraf berisi nama. |
| `<br />` | **Line break** (pindah baris). Dipakai supaya "Ramadhan" turun ke baris kedua sesuai gambar referensi. |
| `<p class="identity-class">` | Paragraf berisi kelas "TI-2D". |

**Untuk mengganti nama atau kelas:** cukup edit teks di dalam tag `<p>` ini.
Ini memenuhi aturan tugas bahwa nama dan kelas mudah diubah.

### Blok judul dinamis

```html
<div class="active-title" id="activeTitle"></div>
```

Elemen ini **kosong dan tersembunyi** (opacity 0 lewat CSS). Saat tombol
di-hover, JS mengisi teksnya, misal `01-PENGENALAN HTML`, dan
menampilkannya. Ini yang tampil di kanan bawah.

---

## 7. Pemuatan JavaScript (baris 65)

```html
<script src="js/main.js"></script>
</body>
</html>
```

| Bagian | Penjelasan |
|--------|-----------|
| `<script src="js/main.js">` | Memuat file JavaScript dari luar. |
| Ditaruh **di paling bawah body** | Penting! JS mencari elemen seperti `jobsheetList`. Kalau script dimuat di head (sebelum elemen dibuat), elemen itu belum ada dan pencarian gagal (hasilnya `null`). Dengan menaruhnya di bawah, semua elemen sudah ada saat JS berjalan. |
| `</body></html>` | Penutup body dan dokumen. |

Selain itu, `main.js` juga membungkus kode inisialisasi di dalam event
`DOMContentLoaded` sebagai pengaman tambahan.

---

## 8. Ringkasan struktur (pohon DOM)

```
html
├── head
│   ├── meta charset
│   ├── meta viewport
│   ├── title
│   └── link (style.css)
└── body
    ├── div.start-overlay
    │   └── button.start-overlay__btn
    ├── div.page
    │   ├── section.jobsheet-panel
    │   │   └── div.jobsheet-list        <- 16 tombol dimasukkan JS di sini
    │   └── section.right-area
    │       ├── div.identity
    │       │   ├── h1
    │       │   ├── p.identity-name
    │       │   └── p.identity-class
    │       └── div.active-title
    └── script (main.js)
```

Bentuk pohon ini yang disebut **DOM tree**.

---

## 9. Soal latihan UTS (Bagian 01)

**Soal 1.** Apa fungsi `<!DOCTYPE html>`?

> **Jawaban:** Memberi tahu browser bahwa dokumen adalah HTML5 sehingga
> ditampilkan dengan mode standar. Tanpa itu browser bisa memakai
> "quirks mode" yang tampilannya tidak konsisten.

**Soal 2.** Apa fungsi `<meta name="viewport" ...>` dan kenapa penting?

> **Jawaban:** Mengatur lebar halaman mengikuti lebar layar perangkat
> (`width=device-width`) dan zoom awal 100%. Penting untuk tampilan
> responsive di HP. Tanpa ini HP menampilkan halaman seperti desktop
> yang diperkecil.

**Soal 3.** Apa arti `lang="id"` pada tag `<html>`?

> **Jawaban:** Menyatakan bahasa halaman adalah bahasa Indonesia.
> Berguna bagi pembaca layar dan mesin pencari.

**Soal 4.** Kenapa tag `<script>` ditaruh di paling bawah body?

> **Jawaban:** Supaya semua elemen HTML sudah dibuat sebelum JavaScript
> berjalan. Jika dimuat di head, `getElementById` bisa mengembalikan
> `null` karena elemennya belum ada.

**Soal 5.** Kenapa `<div id="jobsheetList">` dibiarkan kosong di HTML?

> **Jawaban:** Karena isinya (16 tombol) dibuat otomatis oleh JavaScript
> dari array `jobsheets`. Dengan begitu data cukup diedit di satu tempat
> dan HTML tidak perlu diubah.

**Soal 6.** Apa perbedaan `class` dan `id`?

> **Jawaban:** `id` harus **unik** (hanya satu elemen per id), dipakai
> untuk menunjuk satu elemen tertentu (misal oleh JS). `class` boleh
> dipakai **banyak elemen**, dipakai untuk styling kelompok elemen.

**Soal 7.** Kenapa memakai `<section>` dan bukan `<div>` semua?

> **Jawaban:** `<section>` adalah elemen semantik yang memberi makna
> bahwa itu bagian tersendiri dari konten. Lebih baik bagi aksesibilitas
> dan keterbacaan struktur dibanding `div` generik.

**Soal 8.** Apa fungsi atribut `type="button"` pada `<button>`?

> **Jawaban:** Menegaskan bahwa tombol tidak berperan sebagai tombol
> submit form. Tanpa atribut ini, tombol di dalam form bisa otomatis
> mengirim form saat diklik.

**Soal 9.** Apa itu penamaan BEM? Berikan contoh dari project.

> **Jawaban:** BEM (Block, Element, Modifier) adalah gaya penamaan class
> yang menunjukkan hubungan elemen. Contoh: `jobsheet-btn` (block),
> `jobsheet-btn__pill` (element milik block itu), `is-active` (modifier
> atau keadaan).

**Soal 10.** Mengapa tag `<h1>` dipakai untuk tulisan "JOBSHEET"?

> **Jawaban:** `<h1>` adalah heading tingkat tertinggi yang menandai
> judul utama halaman. Penting untuk struktur dokumen, aksesibilitas,
> dan SEO. Hanya boleh ada satu `h1` per halaman.

**Soal 11.** Bagaimana cara mengganti nama dan kelas yang tampil?

> **Jawaban:** Edit teks di dalam elemen `<p class="identity-name">` dan
> `<p class="identity-class">` pada `index.html`.

**Soal 12.** Apa fungsi `<br />` pada nama?

> **Jawaban:** Membuat pindah baris sehingga "Ramadhan" tampil di baris
> kedua, sesuai gambar referensi.

---

*Sebelumnya: Bagian 00 (Gambaran Umum)*
*Lanjut ke Bagian 02: `main.js` bagian data dan render tombol*
