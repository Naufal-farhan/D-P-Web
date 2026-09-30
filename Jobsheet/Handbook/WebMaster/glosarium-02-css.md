# GLOSARIUM JOBSHEET COVER
## Bagian 02: Istilah CSS

> Lanjutan dari `glosarium-01-umum-html.md`. Bagian ini fokus pada
> istilah dan sintaks CSS yang dipakai di `style.css`.
>
> **Daftar glosarium:**
> - 01: Konsep umum dan istilah HTML
> - 02: Istilah CSS (file ini)
> - 03: Istilah JavaScript

---

## Bagian A: Anatomi dan Selector CSS

### Selector
Bagian aturan CSS yang menentukan **elemen mana** yang ditata.
```css
.identity-title { ... }
^ selector
```
> *Rujukan: Handbook 04 bagian 1.1.*

### Properti dan nilai (property : value)
Satu aturan CSS terdiri dari pasangan properti (aspek yang diubah) dan
nilai (isi pengaturan), dipisah titik dua dan diakhiri titik koma.
```css
font-size: 32px;
^properti  ^nilai
```
> *Rujukan: Handbook 04 bagian 1.1.*

### Deklarasi dan blok deklarasi
Satu pasang properti-nilai disebut **deklarasi**. Kumpulan deklarasi di
dalam kurung kurawal `{ }` disebut **blok deklarasi**.
```css
.page {                 /* awal blok deklarasi */
  display: flex;        /* deklarasi 1 */
  flex-direction: row;  /* deklarasi 2 */
}                        /* akhir blok deklarasi */
```

### Class selector
Selector yang menunjuk elemen berdasarkan atribut `class`, ditulis
dengan titik di depan nama.
```css
.page { ... }        /* menunjuk semua elemen class="page" */
```
> *Rujukan: Handbook 04 bagian 1.2.*

### Universal selector
Selector `*` yang menunjuk **semua elemen** tanpa kecuali. Dipakai untuk
reset CSS di awal file.
```css
* { margin: 0; padding: 0; }
```
> *Rujukan: Handbook 04 bagian 3.*

### Selector gabungan (compound selector)
Dua atau lebih class ditulis **berdempetan tanpa spasi**, menunjuk
elemen yang memiliki **seluruh** class tersebut sekaligus.
```css
.jobsheet-btn.is-active { ... }
/* menunjuk elemen yang punya class "jobsheet-btn" DAN "is-active" */
```
> *Rujukan: Handbook 04 soal 23; Handbook 05 bagian 3.*

### Descendant selector (selector keturunan)
Dua selector dipisah **spasi**, menunjuk elemen kedua yang berada **di
dalam** elemen pertama, seberapa pun dalamnya.
```css
.jobsheet-btn.is-active .jobsheet-btn__image { opacity: 1; }
/* elemen __image di DALAM elemen yang sedang is-active */
```
> *Rujukan: Handbook 04 bagian 1.2; Handbook 05 bagian 8.*

### Pseudo-class
Selector yang menunjuk elemen dalam **keadaan tertentu**, ditulis
dengan titik dua tunggal.

| Pseudo-class | Arti |
|--------------|------|
| `:root` | Elemen akar dokumen (`<html>`) |
| `:hover` | Saat cursor berada di atas elemen |
| `:focus` | Saat elemen menerima fokus (termasuk klik) |
| `:focus-visible` | Saat elemen difokus dengan cara yang perlu penanda visual (umumnya keyboard) |
| `:first-child` | Elemen yang merupakan anak pertama dari induknya |

> *Rujukan: Handbook 04 bagian 2.1; Handbook 05 bagian 8, 2.4.*

### Pseudo-element
Menunjuk **bagian tertentu** dari sebuah elemen (bukan elemen HTML asli
yang bisa ditulis di markup), ditulis dengan titik dua ganda.
```css
.jobsheet-panel::-webkit-scrollbar { display: none; }
/* menunjuk bagian scrollbar dari panel, bukan elemen tersendiri */
```
> *Rujukan: Handbook 04 bagian 6.1.*

### Spesifisitas (specificity)
Sistem "bobot" yang menentukan aturan CSS mana yang **menang** bila dua
atau lebih aturan bentrok pada elemen yang sama. Semakin banyak/spesifik
selector (lebih banyak class, id, dst), semakin tinggi bobotnya. Bila
bobot sama, aturan yang **ditulis lebih akhir** dalam file yang menang.
```css
.jobsheet-btn.w-short             { width: 44%; }  /* bobot: 2 class */
.jobsheet-btn.w-short.is-active   { width: 47%; }  /* bobot: 3 class, MENANG */
```
> *Rujukan: Handbook 05 bagian 3 (kotak "Spesifisitas CSS").*

### Inline style
Gaya yang ditulis **langsung pada atribut `style`** sebuah elemen HTML,
alih-alih di file CSS terpisah. Inline style **selalu mengalahkan**
selector apa pun di stylesheet (kecuali ada `!important`).
```javascript
btn.style.zIndex = 999;   // menghasilkan style="z-index: 999" di HTML
```
> *Rujukan: Handbook 02 bagian 4.7; Handbook 05 bagian 8, soal 12.*

---

## Bagian B: CSS Variables

### CSS variable (custom property)
Nilai buatan sendiri yang bisa dipakai berulang di banyak tempat,
dideklarasikan dengan awalan `--` dan dipakai lewat fungsi `var()`.
```css
:root { --color-bg: #0a0808; }
body { background-color: var(--color-bg); }
```
> *Rujukan: Handbook 00 bagian 5.4; Handbook 04 bagian 2 (seluruh).*

### `:root`
Pseudo-class yang menunjuk elemen akar dokumen (`<html>`). Tempat paling
umum untuk mendeklarasikan CSS variable karena berlaku ke **seluruh**
halaman (variabel diwariskan ke semua elemen turunannya).
> *Rujukan: Handbook 04 bagian 2.1.*

### `var()`
Fungsi CSS untuk **memanggil/memakai** nilai dari sebuah CSS variable.
```css
color: var(--color-btn-accent);
```
> *Rujukan: Handbook 04, dipakai di hampir seluruh aturan.*

### `calc()`
Fungsi CSS untuk **menghitung** nilai, bisa mencampur satuan berbeda
(misal persen dikurangi piksel) yang tidak bisa ditulis langsung.
Operator (`+ - * /`) wajib diberi spasi di kedua sisi.
```css
height: calc(100% - (var(--pill-margin-y) * 2));
```
> *Rujukan: Handbook 05 bagian 4, soal 23.*

### `clamp(min, ideal, max)`
Fungsi CSS yang menghasilkan nilai fleksibel namun dibatasi rentang
minimum dan maksimum. Nilai "ideal" biasanya memakai satuan relatif
(`vw`, `vh`) supaya responsive otomatis tanpa media query.
```css
font-size: clamp(32px, 4vw, 56px);
/* minimal 32px, maksimal 56px, idealnya 4% lebar layar */
```
> *Rujukan: Handbook 04 bagian 2.4.*

---

## Bagian C: Satuan Ukuran (Units)

| Satuan | Kepanjangan | Relatif terhadap | Contoh |
|--------|-------------|-------------------|--------|
| `px` | pixel | Tetap, tidak relatif | `40px` |
| `%` | persen | Ukuran elemen induk | `66%` |
| `vw` | viewport width | 1% dari **lebar** layar | `4vw` |
| `vh` | viewport height | 1% dari **tinggi** layar | `15.5vh` |
| `em` | - | Ukuran font elemen saat ini | `0.08em` |
| `s` | detik (second) | Waktu, dipakai pada `transition` | `0.45s` |

> *Rujukan: Handbook 04 bagian 1.3.*

---

## Bagian D: Warna (Color)

### Hex (hexadecimal color)
Format warna dengan enam digit basis 16 (hexadecimal), dua digit untuk
tiap warna dasar: merah, hijau, biru.
```css
--color-bg: #0a0808;
/*            ^^ merah  ^^ hijau  ^^ biru */
```
> *Rujukan: Handbook 04 bagian 2.2.*

### RGBA
Format warna dengan empat nilai: merah, hijau, biru (0-255), dan
**alpha** (0-1) yaitu tingkat kepekatan/opasitas warna itu sendiri.
```css
rgba(232, 93, 52, 0.4)
/*    R    G   B   alpha (40% pekat) */
```
> *Rujukan: Handbook 04 bagian 2.2, soal 18.*

### `opacity`
Properti CSS yang mengatur transparansi **seluruh elemen** (termasuk
isinya), dengan nilai 0 (tak terlihat) sampai 1 (terlihat penuh).
Berbeda dari alpha pada RGBA yang hanya mempengaruhi satu warna
tertentu.
```css
opacity: 0;   /* elemen sepenuhnya transparan, tapi tetap ada di layout */
```
> *Rujukan: Handbook 04 bagian 7.4, soal 16.*

---

## Bagian E: Box Model dan Layout Dasar

### Box model
Konsep bahwa setiap elemen HTML adalah kotak berlapis empat: **content**
(isi), **padding** (jarak dalam), **border** (garis tepi), **margin**
(jarak luar).
> *Rujukan: Handbook 04 bagian 3 (subbagian "Box model").*

### `box-sizing`
Properti yang menentukan **cara menghitung** lebar/tinggi total elemen.

| Nilai | Perhitungan lebar total |
|-------|--------------------------|
| `content-box` (bawaan) | `width` + padding + border |
| `border-box` | Tetap `width`; padding & border dihitung di dalamnya |

> *Rujukan: Handbook 04 bagian 3 (subbagian "Box model").*

### `margin`
Jarak **di luar** elemen, memisahkannya dari elemen lain di sekitarnya.
Bisa bernilai **negatif** untuk menarik elemen lebih dekat/menumpuk
elemen lain.
```css
margin-top: -18px;   /* menarik elemen naik, menumpuki elemen sebelumnya */
```
> *Rujukan: Handbook 05 bagian 2.1.*

### `padding`
Jarak **di dalam** elemen, antara tepi elemen dan isinya.
```css
padding: 0 36px 0 0;   /* atas kanan bawah kiri (searah jarum jam) */
```
> *Rujukan: Handbook 04 bagian 5 (kotak "Mengingat urutan padding").*

### Urutan 4 nilai shorthand (atas kanan bawah kiri)
Saat properti seperti `margin`, `padding`, atau `border-radius` diberi
empat nilai sekaligus, urutannya selalu **searah jarum jam** mulai dari
atas: atas, kanan, bawah, kiri. Disingkat mudah diingat sebagai
"TRouBLe" (Top, Right, Bottom, Left).
```css
border-radius: 0 999px 999px 0;
/*             kiri-atas  kanan-atas  kanan-bawah  kiri-bawah
                (urutan border-radius sedikit beda, lihat entri sendiri) */
```
> *Rujukan: Handbook 04 bagian 5.*

### `border-radius`
Properti yang membulatkan sudut elemen. Diberi empat nilai berurutan:
kiri-atas, kanan-atas, kanan-bawah, kiri-bawah. Nilai sangat besar
(misal `999px`) melebihi setengah tinggi elemen otomatis dibatasi
menjadi bentuk pil/lingkaran sempurna.
```css
border-radius: 0 999px 999px 0;   /* kiri lurus, kanan bulat penuh */
```
> *Rujukan: Handbook 04 bagian 2.5, soal 19.*

### `display`
Properti yang menentukan **cara elemen ditampilkan/ditata**. Nilai
penting: `flex` (tata letak fleksibel), `none` (elemen dihilangkan
total dari tampilan dan layout).

| Nilai | Perilaku |
|-------|---------|
| `block` (bawaan div, p) | Memenuhi lebar, elemen berikutnya turun baris |
| `inline` (bawaan span) | Sebaris dengan teks di sekitarnya |
| `flex` | Mengaktifkan Flexbox pada elemen dan anak-anaknya |
| `none` | Elemen tidak ditampilkan sama sekali |

> *Rujukan: Handbook 04 bagian 5, 7.4.*

### `overflow`, `overflow-x`, `overflow-y`
Properti yang mengatur perilaku saat isi elemen **lebih besar** dari
kotaknya.

| Nilai | Perilaku |
|-------|---------|
| `visible` | Isi berlebih tetap tampil (meluber keluar kotak) |
| `hidden` | Isi berlebih dipotong, tidak bisa discroll |
| `scroll` | Selalu tampil scrollbar |
| `auto` | Scrollbar muncul hanya bila isi memang berlebih |

`overflow-x`/`overflow-y` mengatur arah horizontal/vertikal secara
terpisah.
```css
html, body { overflow: hidden; }              /* halaman tak bisa scroll */
.jobsheet-panel { overflow-y: auto; }          /* panel ini boleh scroll */
```
> *Rujukan: Handbook 04 bagian 4, 6.1, soal 10.*

---

## Bagian F: Flexbox

### Flexbox
Sistem tata letak CSS satu dimensi untuk menyusun elemen secara
fleksibel, baik mendatar maupun menurun.
> *Rujukan: Handbook 04 bagian 5 (subbagian "Flexbox singkat").*

### `display: flex`
Mengaktifkan Flexbox pada suatu elemen (disebut **flex container**);
anak-anak langsungnya menjadi **flex item** yang tersusun fleksibel.

### `flex-direction`
Menentukan arah penyusunan flex item.

| Nilai | Arah |
|-------|------|
| `row` (bawaan) | Mendatar, kiri ke kanan |
| `column` | Menurun, atas ke bawah |

```css
.page { display: flex; flex-direction: row; }       /* 2 kolom */
.jobsheet-list { display: flex; flex-direction: column; }  /* tombol menurun */
```
> *Rujukan: Handbook 04 bagian 5, 6.2.*

### `align-items`
Meratakan flex item pada **sumbu silang** (tegak lurus arah
`flex-direction`). Pada `flex-direction: row`, sumbu silang adalah
vertikal.
```css
.jobsheet-btn { align-items: center; }   /* isi tombol rata tengah vertikal */
```
> *Rujukan: Handbook 05 bagian 2.*

### `justify-content`
Meratakan flex item pada **sumbu utama** (searah `flex-direction`).
Pada `row`, sumbu utama adalah horizontal.
```css
.start-overlay { justify-content: center; }  /* memusatkan tombol horizontal */
```
> *Rujukan: Handbook 05 bagian 9.1.*

### `gap`
Jarak seragam antar flex item, tanpa perlu menambah margin manual di
tiap item.
```css
.jobsheet-list { gap: 0; }   /* tanpa jarak, tombol saling menumpuk/menempel */
```
> *Rujukan: Handbook 04 bagian 6.2, soal 4 (catatan variabel sisa).*

### `flex-shrink`
Menentukan apakah flex item **boleh menyusut** saat ruang kontainer
tidak cukup. `0` berarti dilarang menyusut sama sekali.
```css
.jobsheet-btn { flex-shrink: 0; }
/* tombol tidak dipaksa mengecil, sehingga panel butuh scroll */
```
> *Rujukan: Handbook 05 bagian 2, soal 6.*

### `margin-left: auto` (trik flexbox)
Di dalam flex container, margin bernilai `auto` **menyerap seluruh
ruang kosong** yang tersedia di sisi tersebut, secara efektif mendorong
elemen ke ujung yang berlawanan.
```css
.jobsheet-btn__number { margin-left: auto; }  /* angka terdorong ke kanan */
```
> *Rujukan: Handbook 05 bagian 6, soal 5.*

---

## Bagian G: Positioning

### `position`
Properti yang menentukan **metode penempatan** sebuah elemen.

| Nilai | Perilaku |
|-------|---------|
| `static` (bawaan) | Mengikuti alur dokumen normal |
| `relative` | Tetap di alur normal, tapi menjadi **acuan** bagi anak `absolute` |
| `absolute` | Keluar dari alur normal, posisi dihitung dari induk terdekat yang punya `position` |
| `fixed` | Menempel pada layar (viewport), tidak ikut scroll |

> *Rujukan: Handbook 04 bagian 7.1; Handbook 05 bagian 9.1, soal 19.*

### `top`, `right`, `bottom`, `left`
Empat properti yang menentukan **jarak** elemen `absolute`/`fixed` dari
tepi elemen acuannya (induk `relative`, atau layar untuk `fixed`).
```css
.identity { position: absolute; top: 0; right: 0; }  /* pojok kanan atas */
```
> *Rujukan: Handbook 04 bagian 7.2.*

### `inset`
Singkatan (shorthand) untuk menulis `top`, `right`, `bottom`, `left`
sekaligus dengan satu nilai yang sama untuk semuanya.
```css
.start-overlay { position: fixed; inset: 0; }
/* setara: top:0; right:0; bottom:0; left:0; -> menutupi seluruh layar */
```
> *Rujukan: Handbook 05 bagian 9.1, soal 16.*

### `z-index`
Properti yang menentukan **urutan tumpukan** (stacking order) elemen
yang saling bertumpang tindih. Nilai lebih besar berada **lebih
depan/atas**. Hanya berlaku pada elemen yang punya `position` selain
`static`.
```css
.start-overlay { z-index: 1000; }   /* selalu di atas semua konten */
```
> *Rujukan: Handbook 02 bagian 4.7; Handbook 05 bagian 9.1, soal 12.*

---

## Bagian H: Animasi dan Transisi

### `transition`
Properti yang membuat **perubahan nilai properti lain** terjadi secara
**halus/berangsur**, bukan seketika, selama durasi tertentu.
```css
transition: opacity 0.35s ease;
/*          properti  durasi  fungsi waktu */
```
Bisa mencantumkan beberapa properti sekaligus, dipisah koma.
> *Rujukan: Handbook 04 bagian 2.8; Handbook 05 bagian 10 (ringkasan).*

### Timing function (fungsi waktu)
Kurva yang menentukan **kecepatan** animasi dari awal sampai akhir,
bukan konstan.

| Nilai | Perilaku |
|-------|---------|
| `linear` | Kecepatan konstan |
| `ease` (bawaan) | Pelan di awal, cepat di tengah, pelan di akhir |
| `ease-in` | Pelan di awal, cepat di akhir |
| `ease-out` | Cepat di awal, pelan di akhir |
| `cubic-bezier(a,b,c,d)` | Kurva kustom didefinisikan 4 angka |

> *Rujukan: Handbook 04 bagian 2.8.*

### `cubic-bezier()`
Fungsi untuk mendefinisikan kurva percepatan **kustom** (bukan bawaan
seperti `ease`), memakai empat angka koordinat kontrol kurva Bezier.
```css
--transition-hover: 0.45s cubic-bezier(0.22, 1, 0.36, 1);
```
> *Rujukan: Handbook 04 bagian 2.8.*

### `transform`
Properti untuk **mengubah bentuk/posisi visual** elemen (geser, putar,
skala) **tanpa mempengaruhi elemen lain** di sekitarnya dalam alur tata
letak.

| Fungsi | Efek |
|--------|------|
| `translateX(8px)` | Menggeser elemen secara horizontal |
| `scaleX(1.02)` | Membesarkan elemen secara horizontal 2% |

> *Rujukan: Handbook 05 bagian 3 (perbandingan pendekatan lama vs baru).*

### `object-fit`
Properti pada elemen media (`<img>`, `<video>`) yang menentukan
bagaimana kontennya diskalakan **di dalam kotak** yang ukurannya sudah
ditentukan.

| Nilai | Perilaku |
|-------|---------|
| `fill` (bawaan) | Direnggangkan memenuhi kotak, bisa gepeng/melar |
| `contain` | Seluruh gambar terlihat, bisa menyisakan ruang kosong |
| `cover` | Menutupi seluruh kotak, sebagian gambar terpotong |

> *Rujukan: Handbook 05 bagian 7, soal 21.*

---

## Bagian I: Gradasi dan Bayangan

### `linear-gradient()`
Fungsi CSS yang menghasilkan gradasi warna **lurus** dari satu arah ke
arah lain.
```css
linear-gradient(to right, oren 0%, oren 50%, putih 50%, putih 100%)
```
> *Rujukan: disinggung di Handbook 05 bagian 4 (pendekatan gradient yang
> akhirnya digantikan overlay terpisah).*

### `radial-gradient()`
Fungsi CSS yang menghasilkan gradasi warna **melingkar**, menyebar dari
satu titik pusat.
```css
radial-gradient(circle at 88% 15%, oren, transparent 40%)
/* pusat lingkaran di 88% dari kiri, 15% dari atas */
```
> *Rujukan: Handbook 04 bagian 4 (subbagian "Glow sinematik"), soal 21;
> Handbook 05 bagian 9.1.*

### `box-shadow`
Properti yang menambahkan **bayangan** pada kotak elemen. Sintaks:
`offset-x offset-y blur spread warna`. Bisa berisi **beberapa bayangan**
sekaligus, dipisah koma.
```css
box-shadow: 0 -22px 30px -8px rgba(245, 240, 236, 0.6);
/*          x   y     blur  spread  warna */
```

| Bagian | Fungsi |
|--------|--------|
| offset-x | Geser bayangan ke samping (+ kanan, - kiri) |
| offset-y | Geser bayangan ke bawah (+ bawah, **- atas**) |
| blur | Tingkat kelembutan/pengaburan tepi bayangan |
| spread | Memperbesar (+) atau mengecilkan (-) ukuran bayangan |

> *Rujukan: Handbook 04 bagian 2.7, soal 17; Handbook 05 bagian 8, soal 13.*

### `outline` dan `outline-offset`
`outline` adalah garis tepi yang digambar **di luar** elemen, **tidak
menambah ukuran** atau mendorong elemen lain (berbeda dari `border`).
`outline-offset` menggeser jarak outline dari tepi elemen.
```css
.jobsheet-btn:focus-visible {
  outline: 3px solid var(--color-btn-accent);
  outline-offset: 4px;
}
```
> *Rujukan: Handbook 05 bagian 8, soal 14.*

---

## Bagian J: Tipografi

### `font-family`
Menentukan jenis huruf yang dipakai, bisa berisi **daftar cadangan**
(fallback) dipisah koma; browser mencoba dari kiri, jika tidak tersedia
lanjut ke berikutnya.
```css
font-family: 'Helvetica Neue', Arial, sans-serif;
```
> *Rujukan: Handbook 04 bagian 2.4; Handbook 05 bagian 9.3, soal 20.*

### `font-weight`
Ketebalan huruf, dengan nilai umum `400` (normal/regular) dan `700`
(bold/tebal).

### `letter-spacing`
Jarak antar huruf. Memakai satuan `em` agar proporsional terhadap
ukuran font.

### `line-height`
Tinggi baris teks. Nilai `1` berarti tinggi baris sama dengan ukuran
font (rapat, tanpa jarak ekstra).

### `text-transform`
Mengubah **tampilan** huruf (besar/kecil) tanpa mengubah teks aslinya
di kode.
```css
text-transform: uppercase;   /* tampil HURUF BESAR walau ditulis huruf kecil */
```

> *Rujukan (empat entri di atas): Handbook 04 bagian 7.3.*

### Pewarisan (inheritance)
Beberapa properti CSS (terutama terkait teks: `color`, `font-family`,
`font-size`) **otomatis diturunkan** dari elemen induk ke elemen anak,
kecuali ditimpa ulang secara eksplisit.
```css
body { color: white; font-family: sans-serif; }
/* semua elemen di dalam body ikut warna & font ini, kecuali ditimpa */
```
> *Rujukan: Handbook 04 bagian 4, soal 20; Handbook 05 bagian 9.3.*

---

## Bagian K: Media Query (Responsive)

### `@media`
Aturan CSS yang membungkus sekumpulan deklarasi agar **hanya berlaku**
pada kondisi tertentu, paling umum berdasarkan lebar layar.
```css
@media (max-width: 1024px) {
  /* hanya berlaku bila lebar layar <= 1024px */
}
```
> *Rujukan: Handbook 06 bagian 1.1.*

### Breakpoint
Nilai lebar layar tertentu yang menjadi **titik ambang** perubahan
tata letak, biasa dipakai sebagai nilai `max-width`/`min-width` pada
`@media`. Project ini memakai dua breakpoint: `1024px` (tablet) dan
`640px` (mobile).
> *Rujukan: Handbook 06 bagian 1.3.*

### Desktop-first vs Mobile-first
Dua strategi menulis media query.

| Strategi | Cara kerja | Dipakai project? |
|----------|-----------|--------------------|
| Desktop-first | Aturan dasar untuk desktop, lalu `max-width` menimpa untuk layar kecil | **Ya** |
| Mobile-first | Aturan dasar untuk mobile, lalu `min-width` menambah untuk layar besar | Tidak |

> *Rujukan: Handbook 06 bagian 1.2.*

### Cascading (aturan bertumpuk)
Sifat CSS di mana aturan yang **ditulis lebih akhir** dalam file
mengalahkan aturan sebelumnya bila keduanya punya spesifisitas yang
sama dan menunjuk properti yang sama. Ini asal kata "Cascading" pada
"CSS" (Cascading Style Sheets).
> *Rujukan: Handbook 06 bagian 1.3, soal 7.*

---

*Sebelumnya: Bagian 01 (Umum dan HTML)*
*Lanjut ke Bagian 03: Istilah JavaScript*
