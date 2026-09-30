# HANDBOOK JOBSHEET COVER
## Bagian 02: `main.js` (Data dan Render Tombol)

Bagian ini menjelaskan baris 1 sampai 115 pada `js/main.js`:
komentar header, array data `jobsheets`, pola lebar `widthPattern`, dan
fungsi `renderJobsheetButtons()`.

---

## 1. Komentar header (baris 1 sampai 16)

```javascript
/* ==========================================================
   JOBSHEET - main.js
   ...
========================================================== */
```

`/* ... */` adalah **komentar blok** di JavaScript. Komentar diabaikan
browser dan hanya berguna bagi manusia yang membaca kode. Isinya
menjelaskan identitas file dan catatan penting tentang audio.

Perbedaan dua jenis komentar di JS:

| Jenis | Bentuk | Dipakai untuk |
|-------|--------|---------------|
| Komentar blok | `/* ... */` | Penjelasan panjang beberapa baris |
| Komentar baris | `// ...` | Penjelasan singkat satu baris |

---

## 2. Array data `jobsheets` (baris 32 sampai 49)

```javascript
const jobsheets = [
  { number: "01", title: "PENGENALAN HTML", link: "./Jobsheet/Jobsheet-01/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "02", title: "JUDUL JOBSHEET 02", ... },
  ...
  { number: "16", title: "JUDUL JOBSHEET 16", ... }
];
```

### Penjelasan bagian per bagian

| Bagian | Penjelasan |
|--------|-----------|
| `const` | Mendeklarasikan variabel **konstan**: nama `jobsheets` tidak boleh diarahkan ke nilai lain. Dipilih karena daftar ini tidak akan diganti total selama program berjalan. |
| `jobsheets` | Nama variabel. Bentuk jamak karena isinya banyak. |
| `[ ... ]` | Kurung siku menandakan **array** (daftar berurutan). |
| `{ ... }` | Kurung kurawal menandakan **object** (kumpulan pasangan nama dan nilai). |
| `number: "01"` | Pasangan **properti: nilai**. Nomor disimpan sebagai **string** (teks), bukan angka. |
| Koma antar object | Memisahkan satu elemen array dengan elemen berikutnya. Elemen terakhir (16) tidak diberi koma di belakangnya. |

### Kenapa nomor berbentuk string `"01"`, bukan angka `1`?

Karena angka `01` akan otomatis menjadi `1` dan angka nol di depan hilang.
Padahal tampilan tombol memerlukan format dua digit (`01`, `02`, dst).
Dengan string, `"01"` tampil apa adanya.

### Arti kelima properti

| Properti | Fungsi |
|----------|--------|
| `number` | Angka yang tampil di tombol |
| `title` | Judul yang tampil di kanan bawah saat hover |
| `link` | Tujuan halaman saat tombol diklik |
| `image` | Lokasi gambar bunga yang muncul di pill |
| `sound` | Lokasi file suara yang diputar saat hover |

### Kenapa data dipusatkan di sini?

Ini konsep **single source of truth** (satu sumber kebenaran). Seluruh
konten tombol ada di satu tempat. Untuk mengganti judul atau link,
pengguna cukup mengedit array ini tanpa perlu memahami sisa kode. Ini
memenuhi aturan tugas: "Data harus dipusatkan dalam JavaScript".

### Cara mengedit data

Contoh mengganti jobsheet 02:

```javascript
{ number: "02", title: "CSS DASAR", link: "./Jobsheet/Jobsheet-02/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
```

Contoh link ke domain lain (absolute URL):

```javascript
link: "https://www.example.com/jobsheet2"
```

Path yang diawali `./` adalah **relative path** (relatif terhadap
lokasi `index.html`). Yang diawali `https://` adalah **absolute URL**.

---

## 3. Pola lebar `widthPattern` (baris 62)

```javascript
const widthPattern = ["w-short", "w-medium", "w-long", "w-medium2"];
```

Array berisi empat **nama class CSS**. Nama-nama ini harus persis sama
dengan class di `style.css`:

```css
.jobsheet-btn.w-short   { width: var(--btn-width-short); }
.jobsheet-btn.w-medium  { width: var(--btn-width-medium); }
.jobsheet-btn.w-long    { width: var(--btn-width-long); }
.jobsheet-btn.w-medium2 { width: var(--btn-width-medium2); }
```

### Tujuan

Membuat lebar tombol **bervariasi** (pendek, sedang, panjang, sedang)
dan **berulang** setiap empat tombol, seperti pada gambar referensi.

### Hasil pola untuk 16 tombol

| Tombol | Index | Class |
|--------|-------|-------|
| 01 | 0 | w-short |
| 02 | 1 | w-medium |
| 03 | 2 | w-long |
| 04 | 3 | w-medium2 |
| 05 | 4 | w-short |
| 06 | 5 | w-medium |
| ... | ... | ... |
| 16 | 15 | w-medium2 |

Untuk mengubah pola, cukup ubah urutan isi array ini.

---

## 4. Fungsi `renderJobsheetButtons()` (baris 73 sampai 115)

Fungsi ini membuat 16 tombol dari array data dan memasangnya ke halaman.

### 4.1 Persiapan (baris 73 sampai 78)

```javascript
function renderJobsheetButtons() {
  const list = document.getElementById("jobsheetList");
  if (!list) return;

  list.innerHTML = "";
```

| Baris | Kode | Penjelasan |
|-------|------|-----------|
| 73 | `function renderJobsheetButtons() {` | Mendeklarasikan fungsi bernama `renderJobsheetButtons`. Fungsi adalah blok kode yang bisa dipanggil berulang. |
| 74 | `const list = document.getElementById("jobsheetList");` | Mencari elemen dengan `id="jobsheetList"` (wadah tombol di HTML) dan menyimpannya di variabel `list`. |
| 75 | `if (!list) return;` | **Pengaman (guard clause)**. Jika elemen tidak ditemukan (`list` bernilai `null`), fungsi langsung berhenti. Tanda `!` berarti "bukan/tidak". Mencegah error saat elemen tidak ada. |
| 78 | `list.innerHTML = "";` | Mengosongkan isi wadah. Supaya jika fungsi dipanggil dua kali, tombol tidak menjadi dobel. |

### 4.2 Perulangan (baris 80)

```javascript
jobsheets.forEach((item, index) => {
  ...
});
```

| Bagian | Penjelasan |
|--------|-----------|
| `jobsheets.forEach(...)` | Method array yang **menjalankan fungsi untuk setiap elemen**. Karena ada 16 elemen, blok di dalamnya berjalan 16 kali. |
| `(item, index)` | Dua parameter. `item` = object data saat ini (misal data tombol 03). `index` = nomor urut mulai dari 0. |
| `=>` | **Arrow function**, penulisan singkat fungsi tanpa kata `function`. |

Di iterasi pertama: `item` = data 01, `index` = 0.
Di iterasi ketiga: `item` = data 03, `index` = 2.

### 4.3 Membuat elemen tombol (baris 81 sampai 82)

```javascript
const btn = document.createElement("button");
btn.type = "button";
```

| Baris | Penjelasan |
|-------|-----------|
| 81 | `document.createElement("button")` membuat elemen `<button>` baru **di memori** (belum tampil di halaman). |
| 82 | Mengatur `type="button"` agar bukan tombol submit. |

**Kenapa memakai `<button>`, bukan `<div>`?** Karena `<button>` sudah
mendukung **keyboard secara bawaan**: bisa difokus dengan Tab dan
diaktifkan dengan Enter atau Space tanpa kode tambahan. `div` tidak.
Ini penting untuk aksesibilitas.

### 4.4 Menentukan class (baris 84 sampai 86)

```javascript
const widthClass = widthPattern[index % widthPattern.length];
btn.className = `jobsheet-btn ${widthClass}`;
```

**Baris 85: `index % widthPattern.length`**

`%` adalah operator **modulo** (sisa bagi). `widthPattern.length` = 4.

| index | index % 4 | Hasil |
|-------|-----------|-------|
| 0 | 0 | w-short |
| 1 | 1 | w-medium |
| 2 | 2 | w-long |
| 3 | 3 | w-medium2 |
| 4 | 0 | w-short (mulai lagi) |
| 5 | 1 | w-medium |

Sisa bagi selalu berada di antara 0 dan 3, sehingga index array tidak
pernah keluar batas dan polanya **berulang otomatis**.

**Baris 86:** Memakai **template literal** (tanda backtick `` ` ``). Bagian
`${widthClass}` diganti dengan nilai variabelnya. Hasilnya misal
`"jobsheet-btn w-short"`, yaitu dua class sekaligus (dipisah spasi).

### 4.5 Menyimpan data di atribut `data-*` (baris 88 sampai 93)

```javascript
btn.dataset.number = item.number;
btn.dataset.title = item.title;
btn.dataset.link = item.link;
btn.dataset.image = item.image;
btn.dataset.sound = item.sound;
```

`dataset` adalah cara menyimpan data kustom di elemen HTML. Hasilnya di
HTML:

```html
<button data-number="01" data-title="PENGENALAN HTML" data-link="..." ...>
```

**Kenapa disimpan di tombol?** Supaya saat hover atau klik, kode cukup
membaca `btn.dataset.title` tanpa perlu mencari kembali ke array. Data
"menempel" pada tombolnya sendiri.

### 4.6 Aksesibilitas (baris 95 sampai 98)

```javascript
btn.setAttribute("aria-label", `Jobsheet ${item.number}: ${item.title}`);
```

Tombol secara visual hanya menampilkan angka. Bagi pengguna pembaca
layar (screen reader), angka saja tidak informatif. `aria-label`
memberi nama yang dibacakan, misal "Jobsheet 01: PENGENALAN HTML".

### 4.7 Mengatur tumpukan (baris 100 sampai 103)

```javascript
btn.style.zIndex = jobsheets.length - index;
```

`z-index` menentukan elemen mana yang berada di atas saat saling
menumpuk. Nilai lebih besar berada di depan.

Perhitungannya (jobsheets.length = 16):

| Tombol | index | z-index |
|--------|-------|---------|
| 01 | 0 | 16 (paling depan) |
| 02 | 1 | 15 |
| 03 | 2 | 14 |
| ... | ... | ... |
| 16 | 15 | 1 (paling belakang) |

**Alasannya:** Tombol saling tumpang tindih (efek kartu bertumpuk).
Tombol yang di atas harus menutupi tombol di bawahnya. Dengan begitu,
bila tombol bawah lebih pendek, bayangan 3D miliknya tertutup tombol
atas yang lebih panjang, sesuai gambar referensi.

**Kenapa lewat `style.zIndex`, bukan CSS biasa?** Nilainya berbeda untuk
tiap tombol dan bergantung pada jumlah tombol. Menghitungnya otomatis di
JS lebih praktis daripada menulis 16 aturan CSS.

### 4.8 Mengisi isi tombol (baris 105 sampai 111)

```javascript
btn.innerHTML = `
  <span class="jobsheet-btn__pill">
    <span class="jobsheet-btn__pill-fill"></span>
    <img class="jobsheet-btn__image" src="${item.image}" alt="Foto untuk ${item.title}" />
  </span>
  <span class="jobsheet-btn__number">${item.number}</span>
`;
```

`innerHTML` mengisi bagian dalam elemen dengan teks HTML. Struktur yang
dihasilkan untuk satu tombol:

```
button.jobsheet-btn
├── span.jobsheet-btn__pill              <- pill (putih)
│   ├── span.jobsheet-btn__pill-fill     <- lapisan oren yang menyapu
│   └── img.jobsheet-btn__image          <- foto bunga
└── span.jobsheet-btn__number            <- angka
```

| Elemen | Peran |
|--------|-------|
| `__pill` | Pill putih. Dasarnya selalu putih. |
| `__pill-fill` | Lapisan yang melebar dari kiri ke kanan saat hover (efek "mengisi"). |
| `__image` | Foto bunga. Transparan saat normal, muncul saat hover. |
| `__number` | Angka rata kanan. |

`${item.image}` dan `${item.title}` adalah interpolasi dari data. `alt`
adalah teks alternatif gambar untuk aksesibilitas.

### 4.9 Memasang ke halaman (baris 113)

```javascript
list.appendChild(btn);
```

Baru pada baris ini tombol **benar-benar tampil**. `appendChild`
memasukkan tombol sebagai anak terakhir dari `list`. Dilakukan 16 kali,
sehingga muncul 16 tombol berurutan.

---

## 5. Ringkasan alur `renderJobsheetButtons()`

```
1. Cari wadah #jobsheetList
2. Kosongkan wadah
3. Untuk setiap data di array jobsheets:
     a. Buat elemen <button>
     b. Tentukan class (jobsheet-btn + w-short/medium/long/medium2)
     c. Simpan data di atribut data-*
     d. Pasang aria-label
     e. Atur z-index (tombol atas lebih depan)
     f. Isi bagian dalam (pill, fill, gambar, angka)
     g. Pasang ke halaman
```

---

## 6. Soal latihan UTS (Bagian 02)

**Soal 1.** Apa perbedaan `const`, `let`, dan `var`? Kenapa `jobsheets`
memakai `const`?

> **Jawaban:** `const` untuk variabel yang tidak boleh diarahkan ulang,
> `let` untuk variabel yang nilainya boleh diganti, `var` adalah cara
> lama dengan aturan cakupan (scope) yang kurang ketat. `jobsheets`
> memakai `const` karena daftar itu tidak akan diganti total selama
> program berjalan.

**Soal 2.** Apa itu array dan object? Tunjukkan contohnya di project.

> **Jawaban:** Array adalah daftar berurutan ditulis dengan `[ ]`. Object
> adalah kumpulan pasangan properti dan nilai ditulis dengan `{ }`.
> Di project, `jobsheets` adalah array, dan setiap isinya
> (`{ number: "01", title: ... }`) adalah object.

**Soal 3.** Kenapa nomor ditulis `"01"` (string), bukan `01`?

> **Jawaban:** Angka `01` akan menjadi `1` dan nol di depan hilang.
> Tampilan membutuhkan dua digit, jadi disimpan sebagai string.

**Soal 4.** Apa keuntungan menyimpan data dalam array dan membuat tombol
dengan perulangan, dibanding menulis 16 tombol di HTML?

> **Jawaban:** Data terpusat di satu tempat sehingga mudah diedit, kode
> lebih pendek, tidak ada pengulangan, dan penambahan tombol cukup
> menambah satu object tanpa mengubah HTML atau CSS.

**Soal 5.** Jelaskan fungsi `forEach` dan parameter `item`, `index`.

> **Jawaban:** `forEach` menjalankan fungsi untuk setiap elemen array.
> `item` adalah elemen saat ini (object data), `index` adalah nomor
> urutnya mulai dari 0.

**Soal 6.** Apa hasil `5 % 4`? Untuk apa operator `%` dipakai di project?

> **Jawaban:** Hasilnya 1 (sisa bagi 5 oleh 4). Di project, `index %
> widthPattern.length` membuat pola lebar tombol berulang setiap empat
> tombol tanpa keluar dari batas array.

**Soal 7.** Kenapa pakai `document.createElement("button")` dan bukan
`<div>`?

> **Jawaban:** `<button>` mendukung keyboard bawaan (Tab, Enter, Space)
> dan dikenali pembaca layar sebagai tombol. `<div>` tidak punya
> kemampuan itu tanpa kode tambahan.

**Soal 8.** Apa fungsi `dataset`? Sebutkan contoh di project.

> **Jawaban:** `dataset` menyimpan data kustom pada elemen HTML lewat
> atribut `data-*`. Contoh: `btn.dataset.title = item.title` sehingga
> saat hover judul bisa dibaca langsung dari tombol.

**Soal 9.** Kenapa ada baris `if (!list) return;`?

> **Jawaban:** Sebagai pengaman. Jika elemen `jobsheetList` tidak
> ditemukan (bernilai `null`), fungsi berhenti sehingga tidak terjadi
> error saat mencoba memakai elemen yang tidak ada.

**Soal 10.** Kenapa `list.innerHTML = ""` dijalankan sebelum membuat
tombol?

> **Jawaban:** Mengosongkan wadah supaya jika fungsi dipanggil lebih dari
> sekali, tombol tidak dobel.

**Soal 11.** Jelaskan cara kerja `btn.style.zIndex = jobsheets.length -
index` dan tujuannya.

> **Jawaban:** Tombol pertama mendapat z-index 16, terakhir 1. Karena
> tombol saling tumpang tindih, tombol yang lebih atas berada di depan
> sehingga menutupi bayangan tombol di bawahnya yang lebih pendek. Ini
> membuat efek kartu bertumpuk sesuai referensi.

**Soal 12.** Apa perbedaan `innerHTML` dan `appendChild`?

> **Jawaban:** `innerHTML` mengisi bagian **dalam** sebuah elemen dengan
> teks HTML. `appendChild` **memasang elemen** sebagai anak dari elemen
> lain sehingga tampil di halaman.

**Soal 13.** Apa itu template literal? Tunjukkan contohnya.

> **Jawaban:** String yang ditulis dengan backtick (`` ` ``) dan bisa
> menyisipkan variabel lewat `${...}`. Contoh:
> `` `jobsheet-btn ${widthClass}` ``.

**Soal 14.** Apa fungsi `aria-label` pada tombol?

> **Jawaban:** Memberi nama yang bisa dibaca pembaca layar. Tombol hanya
> menampilkan angka secara visual, jadi `aria-label` menjelaskan
> tujuannya, misal "Jobsheet 01: PENGENALAN HTML".

**Soal 15.** Bagaimana cara mengubah menjadi 20 tombol?

> **Jawaban:** Tambahkan 4 object baru ke array `jobsheets` (nomor 17
> sampai 20). Tombol otomatis bertambah karena dibuat dengan
> perulangan. Pola lebar dan z-index juga menyesuaikan otomatis.

---

*Sebelumnya: Bagian 01 (`index.html`)*
*Lanjut ke Bagian 03: `main.js` bagian interaksi (overlay, hover, klik)*
