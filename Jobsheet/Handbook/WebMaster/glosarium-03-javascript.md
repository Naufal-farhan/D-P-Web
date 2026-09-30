# GLOSARIUM JOBSHEET COVER
## Bagian 03 (Terakhir): Istilah JavaScript

> Lanjutan dari `glosarium-01-umum-html.md` dan `glosarium-02-css.md`.
> Bagian ini fokus pada istilah dan sintaks JavaScript yang dipakai di
> `main.js`.
>
> **Daftar glosarium:**
> - 01: Konsep umum dan istilah HTML
> - 02: Istilah CSS
> - 03: Istilah JavaScript (file ini)

---

## Bagian A: Variabel dan Tipe Data

### `const`, `let`, `var`
Tiga cara mendeklarasikan variabel di JavaScript.

| Kata kunci | Bisa diarahkan ulang? | Dipakai untuk |
|------------|------------------------|----------------|
| `const` | Tidak | Nilai yang tidak akan diganti total (dipakai project ini untuk `jobsheets`, `widthPattern`) |
| `let` | Ya | Nilai yang akan berubah seiring waktu |
| `var` | Ya (cara lama) | Jarang dipakai di kode modern, aturan cakupannya kurang ketat |

```javascript
const jobsheets = [ ... ];   // tidak akan diarahkan ke array lain
```
> *Rujukan: Handbook 02 bagian 2 (tabel penjelasan), soal 1.*

### String
Tipe data untuk teks, ditulis di antara tanda kutip.
```javascript
"01"          // string, bukan angka
```
> *Rujukan: Handbook 02 bagian 2, soal 3 (kenapa nomor ditulis string).*

### Number
Tipe data untuk angka (tanpa tanda kutip).
```javascript
16            // number
```

### Array
Struktur data berupa **daftar berurutan**, ditulis dengan kurung siku
`[ ]`. Setiap isinya bisa diakses lewat **index** (nomor urut, dimulai
dari 0).
```javascript
const widthPattern = ["w-short", "w-medium", "w-long", "w-medium2"];
widthPattern[0]   // "w-short" (index 0 = elemen pertama)
```
> *Rujukan: Handbook 02 bagian 2, soal 2.*

### Object
Struktur data berupa **kumpulan pasangan properti dan nilai**, ditulis
dengan kurung kurawal `{ }`.
```javascript
{ number: "01", title: "PENGENALAN HTML" }
//^properti      ^nilai
```
> *Rujukan: Handbook 02 bagian 2, soal 2.*

### Property (properti, pada object)
Satu pasang nama dan nilai di dalam sebuah object, diakses dengan titik
(`.`) atau kurung siku (`[ ]`).
```javascript
item.number       // mengakses properti "number"
item["number"]    // cara lain, jarang dipakai bila nama properti diketahui
```
> *Rujukan: Handbook 02 bagian 2.*

### `null` vs `undefined`
Dua cara JavaScript menyatakan "tidak ada nilai".

| Nilai | Kapan muncul |
|-------|--------------|
| `null` | Dikembalikan `document.getElementById(...)` bila elemen tidak ditemukan |
| `undefined` | Variabel dideklarasikan tapi belum diberi nilai, atau properti object yang tidak ada |

```javascript
const list = document.getElementById("tidakAda");   // list bernilai null
```
> *Rujukan: Handbook 02 bagian 4.1 (kaitan dengan guard clause).*

---

## Bagian B: Fungsi

### Function declaration (deklarasi fungsi)
Cara membuat fungsi dengan kata kunci `function` diikuti nama.
```javascript
function renderJobsheetButtons() {
  // isi fungsi
}
```
> *Rujukan: Handbook 02 bagian 4.1.*

### Arrow function
Cara **singkat** menulis fungsi memakai tanda panah `=>`, sering dipakai
untuk fungsi pendek atau sebagai callback.
```javascript
(item, index) => { ... }
```
> *Rujukan: Handbook 02 bagian 4.2.*

### Parameter dan argumen
**Parameter** adalah nama variabel yang dituliskan saat fungsi
**didefinisikan**. **Argumen** adalah nilai sebenarnya yang diberikan
saat fungsi **dipanggil**.
```javascript
function activate(btn) { ... }   // "btn" adalah parameter
activate(tombolSaya);            // "tombolSaya" adalah argumen
```

### `return`
Kata kunci yang **menghentikan** fungsi dan (opsional) mengembalikan
sebuah nilai. Tanpa nilai setelahnya, `return` hanya menghentikan
fungsi tanpa mengembalikan apa-apa.
```javascript
if (!list) return;   // menghentikan fungsi lebih awal
```
> *Rujukan: Handbook 02 bagian 4.1; Handbook 03 bagian 1.2 (guard clause).*

### Guard clause (klausa pengaman)
Pola pemrograman: memeriksa kondisi **tidak valid** di awal fungsi dan
langsung `return` bila kondisi itu terjadi, supaya kode di bawahnya
aman dijalankan tanpa perlu banyak `if-else` bertingkat.
```javascript
function setupHoverInteraction() {
  const list = document.getElementById("jobsheetList");
  if (!list) return;    // <- guard clause
  // kode di bawah ini aman, dijamin "list" bukan null
}
```
> *Rujukan: Handbook 02 bagian 4.1, soal 9; Handbook 03 bagian 1.2, soal 3, 5.*

### Closure
Kemampuan sebuah fungsi untuk **"mengingat"** variabel dari lingkup
(scope) tempat ia dibuat, meski fungsi itu dijalankan belakangan di
tempat lain. Di project ini, setiap tombol punya salinan `baseZIndex`,
`activate`, dan `deactivate` miliknya sendiri berkat closure di dalam
`forEach`.
```javascript
buttons.forEach((btn) => {
  const baseZIndex = btn.style.zIndex;   // "diingat" oleh activate/deactivate
  function activate() { btn.style.zIndex = 999; /* ... */ }
  function deactivate() { btn.style.zIndex = baseZIndex; /* ... */ }
});
```
> *Rujukan: Handbook 03 bagian 2.2, soal 15.*

### Callback function
Fungsi yang diberikan sebagai **argumen** ke fungsi lain untuk
dijalankan **nanti**, bukan langsung saat itu.
```javascript
btn.addEventListener("click", () => { ... });
//                            ^callback, dijalankan nanti saat diklik
```
> *Lihat juga Glosarium 01, Bagian A. Rujukan: Handbook 03 bagian 2.5.*

### Named function reference (memasang fungsi tanpa memanggilnya)
Menulis nama fungsi **tanpa** tanda kurung `()` saat dipasang sebagai
event handler, supaya yang terpasang adalah **fungsinya sendiri**
(untuk dijalankan nanti), bukan **hasil pemanggilannya** (yang langsung
dieksekusi saat itu juga).
```javascript
btn.addEventListener("focus", activate);     // BENAR: fungsi dipasang
btn.addEventListener("focus", activate());   // SALAH: langsung dijalankan
```
> *Rujukan: Handbook 03 bagian 2.5, soal 7.*

---

## Bagian C: Array Method

### `.forEach()`
Method array yang **menjalankan sebuah fungsi untuk setiap elemen**
array tersebut, secara berurutan.
```javascript
jobsheets.forEach((item, index) => {
  // dijalankan 16 kali, sekali untuk tiap elemen
});
```
Parameter pertama = elemen saat ini, parameter kedua (opsional) =
index (nomor urut, dimulai dari 0).
> *Rujukan: Handbook 02 bagian 4.2, soal 5.*

### Index (dalam array)
Nomor urut posisi elemen dalam array, **dimulai dari 0** (bukan 1).
Elemen pertama berindex 0, elemen kedua berindex 1, dan seterusnya.
```javascript
jobsheets[0]    // elemen PERTAMA (nomor "01"), bukan elemen ke-0
```
> *Rujukan: Handbook 02 bagian 4.2; Handbook 03 bagian 1.2.*

### `.length` (pada array)
Properti yang memberikan **jumlah elemen** dalam array.
```javascript
jobsheets.length   // 16
```
> *Rujukan: Handbook 02 bagian 4.7.*

---

## Bagian D: Operator

### Operator modulo (`%`)
Operator yang menghasilkan **sisa pembagian** antara dua angka. Dipakai
untuk membuat pola yang **berulang** dalam rentang tertentu.
```javascript
index % widthPattern.length
// 5 % 4 = 1  (5 dibagi 4 sisa 1)
```
> *Rujukan: Handbook 02 bagian 4.4 (penjelasan lengkap dengan tabel), soal 6.*

### Optional chaining (`?.`)
Operator yang memeriksa **secara aman** apakah suatu nilai ada sebelum
mengakses propertinya. Bila nilai di sebelah kiri `?.` adalah
`null`/`undefined`, seluruh ekspresi menghasilkan `undefined`
**tanpa error**, alih-alih menghentikan program.
```javascript
jobsheets[0]?.sound
// bila jobsheets[0] tidak ada, hasilnya undefined (bukan error)
```
> *Rujukan: Handbook 03 bagian 1.2, soal 3.*

### Logical OR sebagai nilai default (`||`)
Operator `||` ("atau") bisa dipakai untuk memberi **nilai cadangan**:
bila nilai di kiri "kosong" (falsy, seperti `undefined`, `""`, `null`,
`0`), yang dipakai adalah nilai di kanan.
```javascript
jobsheets[0]?.sound || ""
// bila hasil kiri undefined/kosong, pakai string kosong sebagai cadangan
```
> *Rujukan: Handbook 03 bagian 1.2, soal 3.*

### `!` (negasi/NOT)
Operator yang membalik nilai boolean: `true` menjadi `false` dan
sebaliknya. Sering dipakai untuk memeriksa "tidak ada" pada guard
clause.
```javascript
if (!list) return;
// jika "list" bernilai null/falsy, !list menjadi true, maka return dijalankan
```
> *Rujukan: Handbook 02 bagian 4.1, soal 9.*

### `!==` (strict not-equal, tidak sama persis)
Operator perbandingan yang memeriksa apakah dua nilai **tidak sama**,
termasuk memeriksa **tipe datanya** (berbeda dari `!=` yang mengizinkan
konversi tipe otomatis).
```javascript
if (other !== btn) { ... }
// hanya true bila "other" benar-benar BUKAN objek yang sama dengan "btn"
```
> *Rujukan: Handbook 03 bagian 2.3.*

### Template literal
Cara menulis string dengan tanda backtick (`` ` ``, bukan kutip biasa)
yang memungkinkan **menyisipkan variabel langsung** di dalam teks lewat
`${...}`.
```javascript
`jobsheet-btn ${widthClass}`
// bila widthClass = "w-short", hasilnya: "jobsheet-btn w-short"
```
> *Rujukan: Handbook 02 bagian 4.4, soal 13; Handbook 03 bagian 2.3.*

### Ternary operator (opsional, disinggung sebagai konsep terkait)
Bentuk singkat `if-else` dalam satu baris: `kondisi ? nilaiJikaBenar :
nilaiJikaSalah`. Tidak dipakai secara eksplisit di `main.js`, tapi baik
diketahui karena sering muncul di kode JavaScript lain.
```javascript
const status = aktif ? "on" : "off";
```

---

## Bagian E: DOM Manipulation

### `document`
Objek global bawaan browser yang mewakili **seluruh halaman HTML**
sebagai DOM. Titik masuk utama untuk mencari dan membuat elemen.
> *Rujukan: Handbook 00 bagian 5.1.*

### `document.getElementById()`
Method untuk mencari **satu** elemen berdasarkan atribut `id`-nya.
Mengembalikan elemen tersebut, atau `null` bila tidak ditemukan.
```javascript
document.getElementById("jobsheetList")
```
> *Rujukan: Handbook 02 bagian 4.1.*

### `document.querySelector()`
Method untuk mencari **satu** elemen **pertama** yang cocok dengan
selector CSS. Mengembalikan elemen tersebut, atau `null` bila tidak
ada yang cocok.
```javascript
list.querySelector(".jobsheet-btn.is-active")
// mencari SATU tombol yang sedang aktif
```
> *Rujukan: Handbook 03 bagian 2.4, soal 4.*

### `document.querySelectorAll()`
Method untuk mencari **semua** elemen yang cocok dengan selector CSS.
Mengembalikan **NodeList** (mirip array) berisi semua elemen yang
cocok.
```javascript
list.querySelectorAll(".jobsheet-btn")
// mencari SEMUA (16) tombol
```
> *Rujukan: Handbook 03 bagian 2.1, soal 4.*

### `document.createElement()`
Method untuk **membuat elemen HTML baru** secara terprogram (di
memori). Elemen ini belum tampil di halaman sampai dipasangkan dengan
`appendChild()` atau method serupa.
```javascript
const btn = document.createElement("button");
```
> *Rujukan: Handbook 02 bagian 4.3, soal 7.*

### `.appendChild()`
Method untuk **memasang** sebuah elemen sebagai **anak terakhir** dari
elemen lain, membuatnya benar-benar tampil di halaman.
```javascript
list.appendChild(btn);
```
> *Rujukan: Handbook 02 bagian 4.9, soal 12.*

### `.innerHTML`
Properti untuk membaca atau mengisi **bagian dalam** sebuah elemen
dengan teks yang diperlakukan sebagai **markup HTML** (tag-tag di
dalamnya akan diproses menjadi elemen sungguhan).
```javascript
btn.innerHTML = `<span class="jobsheet-btn__number">01</span>`;
```
> *Rujukan: Handbook 02 bagian 4.8, soal 12.*

### `.textContent`
Properti untuk membaca atau mengisi isi sebuah elemen sebagai **teks
biasa** (bukan markup HTML, sehingga lebih aman untuk menampilkan teks
apa adanya).
```javascript
activeTitle.textContent = "01-PENGENALAN HTML";
```
> *Rujukan: Handbook 03 bagian 2.3, soal 10.*

### `.classList`
Properti yang menyediakan method untuk mengelola **daftar class**
sebuah elemen.

| Method | Fungsi |
|--------|--------|
| `.add("nama")` | Menambah class |
| `.remove("nama")` | Menghapus class |
| `.contains("nama")` | Memeriksa apakah class ada (mengembalikan true/false) |

```javascript
btn.classList.add("is-active");
btn.classList.remove("is-active");
```
> *Rujukan: Handbook 03 bagian 1.3.*

### `.dataset`
Properti yang menyediakan akses ke semua atribut `data-*` sebuah
elemen, dipakai untuk menyimpan data kustom langsung pada elemen HTML.
```javascript
btn.dataset.title = "PENGENALAN HTML";
// menghasilkan atribut HTML: data-title="PENGENALAN HTML"

btn.dataset.title   // membaca kembali nilainya
```
> *Rujukan: Handbook 02 bagian 4.5, soal 8.*

### `.setAttribute()`
Method untuk mengatur **atribut HTML apa pun** pada sebuah elemen,
termasuk atribut yang tidak punya "properti pintasan" khusus seperti
`.dataset` (misal atribut ARIA).
```javascript
btn.setAttribute("aria-label", "Jobsheet 01: PENGENALAN HTML");
```
> *Rujukan: Handbook 02 bagian 4.6, soal 14.*

### `.style`
Properti yang memberi akses untuk mengatur **inline style** (gaya
langsung) sebuah elemen lewat JavaScript.
```javascript
btn.style.zIndex = 999;
// menghasilkan atribut HTML: style="z-index: 999"
```
> *Rujukan: Handbook 02 bagian 4.7.*

### `className`
Properti untuk membaca atau mengganti **seluruh** isi atribut `class`
sebuah elemen sekaligus (berbeda dari `.classList` yang menambah/
menghapus satu per satu).
```javascript
btn.className = "jobsheet-btn w-short";
```
> *Rujukan: Handbook 02 bagian 4.4.*

---

## Bagian F: Event

### `.addEventListener()`
Method untuk **memasang** sebuah fungsi (callback) agar dijalankan
setiap kali event tertentu terjadi pada suatu elemen.
```javascript
btn.addEventListener("click", fungsiYangDijalankan);
```
> *Rujukan: Handbook 00 bagian 5.2; Handbook 03 seluruh bagian.*

### `DOMContentLoaded`
Event bawaan browser yang terjadi saat **seluruh HTML selesai
dibaca/diproses**, tanpa perlu menunggu gambar atau sumber daya lain
selesai dimuat.
```javascript
document.addEventListener("DOMContentLoaded", () => { ... });
```
> *Rujukan: Handbook 03 bagian 4, soal 16.*

### `load` (event, sebagai pembanding)
Event bawaan browser yang terjadi setelah **seluruh sumber daya**
halaman (gambar, CSS, dll) selesai dimuat sepenuhnya, lebih lambat
dari `DOMContentLoaded`.
> *Rujukan: Handbook 03 bagian 4 (tabel perbandingan).*

### `mouseenter` / `mouseleave`
Event yang terjadi saat kursor mouse **masuk** ke dalam area elemen /
**keluar** dari area elemen.
> *Rujukan: Handbook 03 bagian 2.5.*

### `focus` / `blur`
Event yang terjadi saat elemen **menerima fokus** (misal lewat tombol
Tab pada keyboard) / **kehilangan fokus** (fokus pindah ke tempat
lain).
> *Rujukan: Handbook 03 bagian 2.5, soal 6.*

### `click`
Event yang terjadi saat elemen **diklik** mouse, atau (khusus untuk
elemen `<button>`) ditekan dengan tombol **Enter/Space** pada
keyboard.
> *Rujukan: Handbook 03 bagian 3, soal 13, 14.*

---

## Bagian G: Audio dan Promise

### `Audio` (objek bawaan browser)
Konstruktor bawaan JavaScript untuk membuat objek audio yang bisa
diputar secara terprogram.
```javascript
const sfx = new Audio("./assets/audio/hover.mp3");
sfx.play();
```
> *Rujukan: Handbook 03 bagian 2.3, soal 11.*

### `new` (kata kunci)
Kata kunci untuk **membuat objek baru** dari sebuah konstruktor/class,
seperti `Audio`.
```javascript
new Audio(sumberFile)
```

### Promise
Objek yang mewakili **hasil operasi asinkron** (yang selesainya di masa
depan, bukan seketika), yang pada akhirnya akan **berhasil** (fulfilled)
atau **gagal** (rejected). Method seperti `.play()` pada objek `Audio`
mengembalikan Promise.
> *Rujukan: Handbook 03 bagian 1.2, soal 2.*

### `.then()`
Method Promise yang menjalankan fungsi **bila Promise berhasil**
(fulfilled).
```javascript
primer.play().then(() => primer.pause());
// jika berhasil diputar, langsung jeda
```
> *Rujukan: Handbook 03 bagian 1.2, soal 2.*

### `.catch()`
Method Promise yang menjalankan fungsi **bila Promise gagal**
(rejected), dipakai untuk menangani error tanpa menghentikan program.
```javascript
sfx.play().catch(() => { /* diamkan error */ });
```
> *Rujukan: Handbook 03 bagian 2.3, soal 12, 19.*

---

## Bagian H: Navigasi dan Aksesibilitas (sisi JavaScript)

### `window`
Objek global bawaan browser yang mewakili **jendela/tab browser** itu
sendiri, menjadi wadah dari `document` dan API browser lainnya.

### `window.location.href`
Properti yang, bila **dibaca**, memberikan alamat URL halaman saat ini;
bila **diisi/diarahkan** ke nilai baru, membuat browser **berpindah**
ke alamat tersebut pada tab yang sama.
```javascript
window.location.href = "https://example.com";
```
> *Rujukan: Handbook 03 bagian 3, soal 13.*

### `window.open()` (sebagai pembanding)
Method untuk membuka URL di **tab atau jendela baru**, berpotensi
terblokir oleh popup blocker browser. Project ini **tidak** memakai
method ini (sesuai aturan tugas: dilarang popup).
> *Rujukan: Handbook 03 bagian 3 (tabel perbandingan), soal 13.*

### `aria-label`
Atribut HTML (bagian dari standar ARIA - Accessible Rich Internet
Applications) yang memberi **nama yang dibacakan pembaca layar** pada
suatu elemen, berguna saat teks visualnya tidak cukup menjelaskan
tujuan elemen tersebut.
```html
<button aria-label="Jobsheet 01: PENGENALAN HTML">01</button>
```
> *Lihat juga Glosarium 01, Bagian A (Screen reader). Rujukan: Handbook
> 02 bagian 4.6, soal 14; Handbook 06 bagian 4.*

### `alt` (pada `<img>`)
Atribut HTML yang memberi **teks alternatif** sebuah gambar, dibacakan
pembaca layar dan ditampilkan bila gambar gagal dimuat.
```html
<img src="bunga.jpg" alt="Foto untuk PENGENALAN HTML" />
```
> *Rujukan: Handbook 02 bagian 4.8; Handbook 06 bagian 4.*

---

## Penutup Glosarium

Glosarium ini bersama tujuh file Handbook (`00` sampai `06`) diharapkan
memberi bekal yang cukup untuk menjelaskan **setiap baris kode** dalam
project ini, baik konsepnya maupun alasan di balik setiap keputusan
teknis yang diambil. Selamat belajar untuk UTS.

---

*Sebelumnya: Bagian 02 (CSS)*
*Selesai — ini adalah bagian terakhir glosarium.*
