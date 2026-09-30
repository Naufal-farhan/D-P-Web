# HANDBOOK JOBSHEET COVER
## Bagian 00: Gambaran Umum, Struktur Folder, dan Konsep Dasar

> Handbook ini dibuat untuk persiapan UTS. Setiap bagian menjelaskan kode
> baris per baris, alasan kenapa ditulis begitu, dan ditutup dengan contoh
> pertanyaan dosen beserta jawabannya.
>
> **Daftar bagian handbook:**
> - 00: Gambaran umum (file ini)
> - 01: `index.html`
> - 02: `main.js` bagian data dan render tombol
> - 03: `main.js` bagian interaksi (overlay, hover, klik)
> - 04: `style.css` bagian variabel, reset, dan layout
> - 05: `style.css` bagian tombol, animasi, overlay
> - 06: `style.css` bagian responsive dan accessibility, plus soal UTS gabungan

---

## 1. Apa itu project ini?

Project ini adalah **website statis interaktif** berupa "cover jobsheet".
Ciri-cirinya:

- Hanya **satu halaman** (`index.html`).
- Ada **16 tombol** bernomor 01 sampai 16 di sisi kiri.
- Saat cursor masuk ke sebuah tombol: pill di dalam tombol berubah oren,
  foto muncul, suara diputar, dan judul jobsheet tampil di kanan bawah.
- Saat tombol diklik: browser pindah ke halaman jobsheet yang bersangkutan.
- Seluruh halaman **tidak bisa discroll**. Hanya daftar tombol di kiri
  yang boleh discroll.

### Kenapa disebut "statis"?

Website statis adalah website yang **tidak butuh server untuk memproses
data**. File HTML, CSS, dan JS langsung dikirim ke browser apa adanya.
Tidak ada PHP, database, atau Node.js di sisi server. Cukup dibuka lewat
file, atau di-upload ke hosting statis seperti GitHub Pages.

### Kenapa "interaktif"?

Karena halaman merespons aksi pengguna (hover, klik, keyboard) lewat
JavaScript. Halaman statis biasa hanya menampilkan konten tanpa merespons.

---

## 2. Teknologi yang dipakai

| Teknologi | Fungsi di project ini |
|-----------|----------------------|
| **HTML** | Kerangka/struktur halaman (apa saja elemennya) |
| **CSS** | Tampilan (warna, ukuran, posisi, animasi) |
| **Vanilla JavaScript** | Perilaku (render tombol, hover, klik, suara) |

**Vanilla JavaScript** artinya JavaScript murni tanpa framework seperti
React atau Vue, dan tanpa library seperti jQuery. Alasan dipilih:

1. Sederhana dan mudah dipahami.
2. Tidak perlu install apa pun (tanpa npm, tanpa build).
3. Ringan, karena tidak ada dependency yang harus diunduh.
4. Sesuai aturan tugas: "Jangan menggunakan framework".

---

## 3. Struktur folder

```
jobsheet-site/
├── index.html              <- halaman utama (kerangka)
├── css/
│   └── style.css           <- semua styling
├── js/
│   └── main.js             <- semua logika
└── assets/
    ├── images/
    │   ├── BACA-INI.txt    <- petunjuk mengisi gambar
    │   └── flower.jpg      <- (diisi sendiri)
    └── audio/
        ├── BACA-INI.txt    <- petunjuk mengisi suara
        └── hover.mp3       <- (diisi sendiri)
```

### Kenapa dipisah per folder?

Prinsip yang dipakai disebut **separation of concerns** (pemisahan
tanggung jawab): struktur, tampilan, dan perilaku dipisah ke file yang
berbeda.

- Mau ubah warna? Buka `style.css` saja.
- Mau ubah judul jobsheet? Buka `main.js` saja.
- Mau ubah teks halaman? Buka `index.html` saja.

Kalau semua digabung dalam satu file, file akan sangat panjang dan
sulit dicari.

### Kenapa gambar dan audio tidak ditulis langsung di kode (base64)?

Sesuai aturan tugas, gambar tidak boleh disimpan sebagai base64. Base64
mengubah gambar menjadi teks sangat panjang yang ditempel di kode. Itu
membuat file kode membengkak dan sulit dibaca. Dengan file terpisah di
folder `assets/`, kode tetap bersih dan gambar mudah diganti.

---

## 4. Alur kerja website (dari buka sampai klik)

Urutan kejadian saat website dipakai:

```
1. Browser membuka index.html
2. Browser membaca <head>, lalu memuat css/style.css
3. Browser membaca <body>, membuat elemen-elemen halaman
4. Browser memuat js/main.js (di paling bawah body)
5. Event DOMContentLoaded terjadi -> JS mulai bekerja:
      a. renderJobsheetButtons()  -> membuat 16 tombol
      b. setupStartOverlay()      -> memasang aksi tombol "KLIK UNTUK MULAI"
      c. setupHoverInteraction()  -> memasang aksi hover/fokus
      d. setupClickNavigation()   -> memasang aksi klik
6. Pengguna klik "KLIK UNTUK MULAI" -> overlay hilang, audio "terbuka"
7. Pengguna hover tombol -> pill oren, foto, suara, judul muncul
8. Pengguna klik tombol -> pindah halaman (window.location.href)
```

Alur ini penting dihafal karena sering ditanyakan sebagai
"jelaskan cara kerja program".

---

## 5. Konsep dasar yang dipakai di project

### 5.1 DOM (Document Object Model)

DOM adalah representasi halaman HTML sebagai **pohon objek** yang bisa
dimanipulasi oleh JavaScript. Setiap elemen HTML (seperti `<div>`,
`<button>`) menjadi objek. JavaScript bisa mencari, membuat, mengubah,
dan menghapus objek tersebut.

Contoh di project ini:
- `document.getElementById("jobsheetList")` -> mencari elemen
- `document.createElement("button")` -> membuat elemen baru
- `list.appendChild(btn)` -> memasang elemen ke halaman
- `btn.classList.add("is-active")` -> menambah class

### 5.2 Event dan Event Listener

**Event** adalah kejadian di halaman (klik, hover, tekan tombol).
**Event listener** adalah kode yang "mendengarkan" dan menjalankan fungsi
saat event itu terjadi.

```javascript
btn.addEventListener("mouseenter", activate);
//   ^elemen          ^jenis event   ^fungsi yang dijalankan
```

Event yang dipakai di project:

| Event | Kapan terjadi |
|-------|--------------|
| `DOMContentLoaded` | HTML selesai dibaca browser |
| `click` | Diklik mouse, atau Enter/Space pada tombol |
| `mouseenter` | Cursor masuk ke elemen |
| `mouseleave` | Cursor keluar dari elemen |
| `focus` | Elemen menerima fokus keyboard (Tab) |
| `blur` | Fokus keyboard pindah dari elemen |

### 5.3 Class dan state (keadaan)

Project ini memakai teknik: **JavaScript hanya menambah/menghapus class,
CSS yang mengatur tampilannya**.

```
JS:   btn.classList.add("is-active")
CSS:  .jobsheet-btn.is-active { ... tampilan saat aktif ... }
```

Kelebihannya: logika (JS) dan tampilan (CSS) tetap terpisah. Untuk
mengubah tampilan saat aktif, cukup edit CSS tanpa menyentuh JS.

### 5.4 CSS Variables (custom properties)

Variabel CSS dideklarasikan dengan awalan `--` dan dipakai dengan
`var()`.

```css
:root {
  --color-btn-accent: #e85d34;     /* deklarasi */
}
.identity-class {
  color: var(--color-btn-accent);  /* pemakaian */
}
```

Manfaatnya: warna/ukuran penting cukup diubah di **satu tempat** dan
otomatis berlaku di seluruh CSS. Ini memenuhi aturan tugas: "Gunakan CSS
variables untuk parameter visual penting".

### 5.5 Data-driven rendering

Tombol tidak ditulis satu-satu di HTML. Sebagai gantinya, data disimpan
dalam **array of objects** di JavaScript, lalu tombol dibuat otomatis
dengan perulangan.

Keuntungan: untuk mengubah judul atau link, cukup edit array. Tidak perlu
menyentuh HTML atau CSS.

### 5.6 Kebijakan autoplay browser

Browser modern **memblokir suara otomatis** sampai pengguna berinteraksi
(klik/tap/tekan tombol). Ini kebijakan keamanan untuk mencegah situs
tiba-tiba mengeluarkan suara. Karena itu ada layar "KLIK UNTUK MULAI":
klik itu menjadi interaksi pertama yang membuka izin suara.

---

## 6. Soal latihan UTS (Bagian 00)

**Soal 1.** Apa yang dimaksud website statis? Apakah project ini termasuk?

> **Jawaban:** Website statis adalah website yang file-nya (HTML, CSS, JS)
> dikirim ke browser apa adanya tanpa diproses server (tanpa PHP atau
> database). Project ini termasuk website statis karena hanya berisi
> HTML, CSS, dan JavaScript yang berjalan di browser.

**Soal 2.** Apa perbedaan peran HTML, CSS, dan JavaScript?

> **Jawaban:** HTML membentuk struktur (elemen apa saja yang ada). CSS
> mengatur tampilan (warna, ukuran, posisi, animasi). JavaScript
> mengatur perilaku (merespons aksi pengguna dan mengubah halaman).

**Soal 3.** Kenapa memakai Vanilla JavaScript, bukan React atau Vue?

> **Jawaban:** Karena project ini sederhana, tidak butuh framework.
> Vanilla JS tidak perlu install atau build, lebih ringan, mudah dipahami,
> dan sesuai aturan tugas yang melarang framework.

**Soal 4.** Kenapa file dipisah menjadi `index.html`, `style.css`, dan
`main.js`?

> **Jawaban:** Untuk pemisahan tanggung jawab (separation of concerns).
> Struktur, tampilan, dan perilaku berada di file berbeda sehingga mudah
> dicari, dipahami, dan diedit tanpa mengganggu bagian lain.

**Soal 5.** Jelaskan urutan kejadian sejak halaman dibuka sampai tombol
bisa dipakai.

> **Jawaban:** Browser membaca `index.html`, memuat `style.css`, membuat
> elemen di body, lalu memuat `main.js`. Setelah event `DOMContentLoaded`,
> JS menjalankan `renderJobsheetButtons()` untuk membuat 16 tombol, lalu
> memasang event untuk overlay, hover, dan klik.

**Soal 6.** Apa itu DOM?

> **Jawaban:** DOM (Document Object Model) adalah representasi halaman
> HTML dalam bentuk pohon objek. Lewat DOM, JavaScript bisa mencari,
> membuat, mengubah, dan menghapus elemen halaman.

**Soal 7.** Apa yang dimaksud event listener? Berikan contoh dari project.

> **Jawaban:** Event listener adalah kode yang menunggu suatu kejadian
> (event) lalu menjalankan fungsi. Contoh:
> `btn.addEventListener("click", ...)` menjalankan perpindahan halaman
> saat tombol diklik.

**Soal 8.** Apa keuntungan JS hanya menambah class, sedangkan CSS yang
mengatur tampilan?

> **Jawaban:** Logika dan tampilan tetap terpisah. Untuk mengubah tampilan
> saat aktif, cukup edit CSS tanpa mengubah JS, sehingga lebih aman dan
> mudah dirawat.

**Soal 9.** Apa itu CSS variable dan apa manfaatnya?

> **Jawaban:** CSS variable adalah nilai yang dideklarasikan dengan awalan
> `--` (misal `--color-btn-accent`) dan dipakai dengan `var()`. Manfaatnya:
> nilai penting cukup diubah di satu tempat dan otomatis berlaku di
> seluruh CSS.

**Soal 10.** Kenapa perlu layar "KLIK UNTUK MULAI"?

> **Jawaban:** Browser memblokir audio otomatis sampai pengguna
> berinteraksi. Klik pada layar itu menjadi interaksi pertama sehingga
> browser mengizinkan sound effect hover diputar selanjutnya.

---

*Lanjut ke Bagian 01: `index.html`*
