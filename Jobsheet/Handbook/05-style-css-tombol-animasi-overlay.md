# HANDBOOK JOBSHEET COVER
## Bagian 05: `style.css` (Tombol, Animasi, Fokus, dan Overlay)

Bagian ini menjelaskan baris 261 sampai 507 pada `css/style.css`:

1. `.jobsheet-btn`: badan tombol (baris 274 sampai 309)
2. Lebar bervariasi dan lebar saat hover (baris 321 sampai 332)
3. `.jobsheet-btn__pill`: pill putih (baris 345 sampai 362)
4. `.jobsheet-btn__pill-fill`: lapisan oren yang menyapu (baris 371 sampai 386)
5. `.jobsheet-btn__number`: angka (baris 389 sampai 395)
6. `.jobsheet-btn__image`: foto (baris 404 sampai 419)
7. State `.is-active` dan `:focus-visible` (baris 430 sampai 448)
8. `.start-overlay`: layar "KLIK UNTUK MULAI" (baris 459 sampai 507)

> **Kunci memahami bagian ini:** JavaScript hanya menambah atau menghapus
> class `is-active`. **Seluruh animasi dikerjakan CSS** lewat `transition`.

---

## 1. Struktur satu tombol (ingat kembali dari Bagian 02)

```
button.jobsheet-btn                       <- badan abu-abu, ada bayangan 3D
├── span.jobsheet-btn__pill               <- pill, dasar putih
│   ├── span.jobsheet-btn__pill-fill      <- lapisan yang melebar 0% -> 100%
│   └── img.jobsheet-btn__image           <- foto, transparan -> terlihat
└── span.jobsheet-btn__number             <- angka, rata kanan
```

Tumpukan lapisan di dalam pill, dari **bawah ke atas**:

| Urutan | Lapisan | Keterangan |
|--------|---------|-----------|
| 1 (paling bawah) | Latar pill | Putih, tidak pernah berubah |
| 2 | `__pill-fill` | Oren yang melebar, lalu berganti warna gelap |
| 3 (paling atas) | `__image` | Foto, `z-index: 1` |

---

## 2. Badan tombol `.jobsheet-btn` (baris 274 sampai 309)

```css
.jobsheet-btn {
  display: flex;
  align-items: center;
  width: var(--btn-width-medium);
  height: clamp(var(--btn-min-height), var(--btn-height), var(--btn-max-height));
  border: none;
  border-radius: 0 var(--btn-radius) var(--btn-radius) 0;
  background-color: var(--color-btn-bg);
  cursor: pointer;
  padding: 0 36px 0 0;
  flex-shrink: 0;
  position: relative;
  box-sizing: border-box;
  margin-top: var(--btn-overlap);
  box-shadow: var(--btn-shadow-3d);
  transition: box-shadow var(--transition-hover),
              width var(--transition-hover);
}
```

| Baris | Kode | Penjelasan |
|-------|------|-----------|
| 275 | `display: flex` | Isi tombol (pill dan angka) tersusun **mendatar** berdampingan. |
| 276 | `align-items: center` | Isi diratakan ke **tengah secara vertikal**. Pada flexbox baris, sumbu utama = mendatar, sumbu silang = vertikal; `align-items` mengatur sumbu silang. |
| 277 | `width: var(--btn-width-medium)` | Lebar cadangan (fallback) bila class lebar tidak terpasang. Nanti ditimpa aturan `.w-short` dan kawan-kawan. |
| 278 | `height: clamp(min, ideal, max)` | Tinggi fleksibel: `15.5vh` tetapi dibatasi 110px sampai 170px. Menjaga tombol tidak terlalu kecil di layar pendek dan tidak terlalu besar di layar tinggi. |
| 279 | `border: none` | Menghapus border bawaan elemen `<button>`. |
| 282 | `border-radius: 0 999px 999px 0` | Sudut **kiri lurus** (0), sudut **kanan bulat**. Urutan: kiri-atas, kanan-atas, kanan-bawah, kiri-bawah. Sisi kiri lurus karena menempel di tepi layar. |
| 283 | `background-color` | Warna abu arang hangat. |
| 284 | `cursor: pointer` | Kursor berubah jadi ikon tangan, tanda bisa diklik. |
| 285 | `padding: 0 36px 0 0` | Hanya padding **kanan** 36px, supaya angka tidak mepet ujung bulat tombol. |
| 286 | `flex-shrink: 0` | **Melarang tombol menyusut.** Tanpa ini, 16 tombol dalam kolom flex akan dipaksa mengecil agar muat di panel, sehingga panel tidak pernah perlu scroll. Dengan `0`, tombol mempertahankan tingginya dan isi meluber sehingga scroll aktif. |
| 287 | `position: relative` | Membuat tombol punya konteks penumpukan dan bisa dipengaruhi `z-index` (JS mengatur `z-index` per tombol). |
| 288 | `box-sizing: border-box` | Padding dihitung di dalam lebar. |

### 2.1 Efek tumpuk: `margin-top` negatif (baris 294)

```css
margin-top: var(--btn-overlap);   /* -18px */
```

Margin atas **negatif** menarik tombol **naik** ke atas sehingga
menumpuk di atas tombol sebelumnya sebesar 18px.

```
Tanpa overlap:            Dengan overlap -18px:
+---------+               +---------+
| tombol 1|               | tombol 1|
+---------+               |  +---------+   <- tombol 2 naik
   (celah)                +--|tombol 2 |      menutupi bagian
+---------+                  +---------+      bawah tombol 1
| tombol 2|
+---------+
```

Inilah yang menciptakan kesan **"kartu bertumpuk"** dan menghilangkan
celah antar tombol.

### 2.2 Kenapa bayangan 3D tombol pendek tersembunyi?

Bayangan tiap tombol mengarah **ke atas** dan jatuh pada area tombol
di atasnya. Karena tombol atas punya `z-index` lebih tinggi (diatur JS,
Bagian 02) dan menumpuk, tombol atas **menutupi** bayangan itu.

- Bila tombol bawah **lebih pendek** dari tombol atas: bayangannya jatuh
  di area yang tertutup tombol atas, sehingga **tidak terlihat**.
- Bila tombol bawah **lebih panjang**: sebagian bayangannya menjulur
  keluar dari sisi kanan tombol atas dan **terlihat**.

Ini persis perilaku pada gambar referensi.

### 2.3 Transisi (baris 301 sampai 302)

```css
transition: box-shadow var(--transition-hover),
            width var(--transition-hover);
```

Dua properti dianimasikan, dipisah koma: `box-shadow` (glow) dan
`width` (tombol memanjang). Durasi 0,45 detik dengan kurva halus.

**Aturan penting `transition`:** hanya properti yang **tercantum** yang
dianimasikan. Perubahan properti lain terjadi seketika.

### 2.4 Tombol pertama (baris 307 sampai 309)

```css
.jobsheet-btn:first-child {
  margin-top: 0;
}
```

`:first-child` adalah pseudo-class yang memilih elemen yang merupakan
**anak pertama** dari induknya. Tombol pertama tidak punya tombol
sebelumnya untuk ditumpuki, jadi `margin-top` negatif dibatalkan
(kembali 0). Kalau tidak, tombol pertama akan tertarik naik keluar dari
awal panel.

> **Catatan:** Aturan ini bekerja karena tombol dibuat lewat
> `appendChild` sehingga tombol 01 selalu anak pertama di
> `.jobsheet-list`.

---

## 3. Lebar bervariasi dan saat hover (baris 321 sampai 332)

```css
.jobsheet-btn.w-short   { width: var(--btn-width-short); }
.jobsheet-btn.w-medium  { width: var(--btn-width-medium); }
.jobsheet-btn.w-long    { width: var(--btn-width-long); }
.jobsheet-btn.w-medium2 { width: var(--btn-width-medium2); }

.jobsheet-btn.w-short.is-active   { width: var(--btn-width-short-hover); }
.jobsheet-btn.w-medium.is-active  { width: var(--btn-width-medium-hover); }
.jobsheet-btn.w-long.is-active    { width: var(--btn-width-long-hover); }
.jobsheet-btn.w-medium2.is-active { width: var(--btn-width-medium2-hover); }
```

### Cara kerja

JS memasang class lebar (`w-short`, dst.) saat render. Saat hover, JS
menambah `is-active`. Selector dengan **tiga class** (misal
`.jobsheet-btn.w-short.is-active`) lebih spesifik daripada dua class,
jadi menang dan lebarnya berganti ke versi hover (3% lebih lebar).

Karena `width` ada di daftar `transition`, perubahan lebar terjadi
**halus** sehingga tombol tampak **memanjang ke kanan**.

### Spesifisitas CSS (penting untuk UTS)

Bila dua aturan bentrok, browser memilih yang **lebih spesifik**.

| Selector | Bobot (perkiraan) |
|----------|-------------------|
| `.jobsheet-btn` | 1 class |
| `.jobsheet-btn.w-short` | 2 class |
| `.jobsheet-btn.w-short.is-active` | 3 class (**menang**) |

Bila bobot sama, aturan yang **ditulis lebih akhir** yang menang.
Style inline (`style="..."`) mengalahkan semua selector di stylesheet.

### Kenapa memanjang, bukan bergeser?

Awalnya tombol digeser dengan `transform: translateX`. Itu melepas sisi
kiri tombol dari tepi layar dan meninggalkan celah kotak. Dengan
memperlebar `width` dari titik kiri yang tetap, tombol **tidak pernah
lepas dari tepi kiri**.

---

## 4. Pill putih `.jobsheet-btn__pill` (baris 345 sampai 362)

```css
.jobsheet-btn__pill {
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  flex-shrink: 0;
  position: relative;

  width: var(--pill-width);
  height: calc(100% - (var(--pill-margin-y) * 2));
  margin: var(--pill-margin-y) 0;

  border: var(--pill-border);
  border-radius: 0 var(--btn-radius) var(--btn-radius) 0;
  background-color: var(--color-btn-inner);
}
```

| Kode | Penjelasan |
|------|-----------|
| `overflow: hidden` | **Sangat penting.** Memotong isi yang keluar dari bentuk pill, sehingga lapisan oren dan foto (yang berbentuk persegi panjang) ikut **terpotong mengikuti sudut bulat pill**. |
| `position: relative` | Menjadi **acuan** bagi anak yang `position: absolute` (`__pill-fill` dan `__image`). |
| `width: 78%` | Pill mengisi 78% lebar tombol; sisanya untuk angka. |
| `height: calc(100% - (14px * 2))` | **`calc()`** menghitung nilai. Tinggi pill = tinggi tombol dikurangi dua kali margin (atas dan bawah) = 100% dikurangi 28px. |
| `margin: 14px 0` | Dua nilai: atas-bawah 14px, kiri-kanan 0. Ini yang membuat jarak pill dari tepi atas dan bawah tombol abu. |
| `border: none` | Diambil dari variabel `--pill-border`. |
| `border-radius: 0 999px 999px 0` | Kiri lurus, kanan bulat. |
| `background-color` | **Dasar pill selalu putih.** |

**Tentang `calc()`:** Bisa mencampur satuan berbeda (persen dan piksel)
yang tidak bisa ditulis biasa. Operator `+ - * /` harus diberi spasi di
kedua sisinya: `calc(100% - 28px)`.

**Kenapa dasar pill tidak pernah berubah warna?** Efek "terisi oren"
dibuat oleh lapisan terpisah di atasnya (bagian 5), bukan dengan mengubah
warna pill. Pendekatan ini lebih mudah diprediksi dan mudah dianimasikan
dari kiri ke kanan.

---

## 5. Lapisan pengisi `.jobsheet-btn__pill-fill` (baris 371 sampai 386)

```css
.jobsheet-btn__pill-fill {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 0%;
  background-color: var(--color-btn-accent);

  transition: width var(--transition-fill),
              background-color var(--transition-fill);
}

.jobsheet-btn.is-active .jobsheet-btn__pill-fill {
  width: 100%;
  background-color: var(--color-image-bg);
}
```

### Cara kerja efek "mengisi dari kiri ke kanan"

| Keadaan | `width` | Hasil |
|---------|---------|-------|
| Normal | `0%` | Lapisan tak terlihat; pill tampak putih polos |
| Hover (`is-active`) | `100%` | Lapisan melebar dari kiri sampai menutupi seluruh pill |

Kenapa melebar **dari kiri**? Karena `left: 0` menetapkan sisi kiri
lapisan tetap di kiri pill. Saat `width` bertambah, **sisi kanan yang
bergerak** ke kanan. Karena ada `transition`, gerakannya halus.

### Perubahan warna sambil melebar

`transition` mencantumkan `width` dan `background-color`. Selama
melebar, warna berubah dari **oren** (`--color-btn-accent`) menjadi
**cokelat gelap** (`--color-image-bg`). Jadi yang tampak: oren menyapu
masuk lalu perlahan menjadi latar gelap untuk foto.

### Konsep `position: absolute` di dalam `relative`

| Properti | Arti |
|----------|-----|
| `position: absolute` | Lapisan keluar dari alur normal |
| `top: 0; left: 0` | Menempel di pojok kiri atas **pill** (induk `relative`-nya) |
| `height: 100%` | Setinggi pill |

Karena `position: absolute`, lapisan **menumpuk di atas** latar putih
tanpa mendorong elemen lain.

---

## 6. Angka `.jobsheet-btn__number` (baris 389 sampai 395)

```css
.jobsheet-btn__number {
  margin-left: auto;
  font-size: var(--btn-number-size);
  font-weight: 700;
  color: var(--color-text);
  letter-spacing: 0.02em;
}
```

### Trik `margin-left: auto`

Di dalam kontainer **flex**, margin bernilai `auto` akan **menyerap
seluruh ruang kosong** di sisi itu. Karena `margin-left: auto`, semua
ruang kosong berada di kiri angka sehingga angka **terdorong ke ujung
kanan** tombol.

```
[ pill ............ ][      angka ]
                     <-- margin-left: auto menyerap ruang di sini
```

Ini cara paling ringkas meratakan satu elemen ke kanan dalam flexbox.

---

## 7. Foto `.jobsheet-btn__image` (baris 404 sampai 419)

```css
.jobsheet-btn__image {
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  opacity: 0;

  transition: opacity var(--transition-fill);
}

.jobsheet-btn.is-active .jobsheet-btn__image {
  opacity: 1;
}
```

| Kode | Penjelasan |
|------|-----------|
| `position: absolute; top: 0; left: 0;` | Foto menempel di pojok kiri atas pill dan menumpuk di atas lapisan lain. |
| `width: 100%; height: 100%;` | Foto **memenuhi seluruh pill**. |
| `z-index: 1` | Foto berada di **atas** `__pill-fill`. |
| `object-fit: cover` | Foto diskalakan agar **menutupi seluruh area tanpa distorsi**; bagian yang berlebih dipotong. |
| `opacity: 0` | Tersembunyi saat normal. |
| `transition: opacity 0.5s` | Kemunculan halus (fade in). |

### Perbandingan `object-fit`

| Nilai | Perilaku |
|-------|----------|
| `fill` (bawaan) | Direnggangkan memenuhi kotak (bisa **gepeng/melar**) |
| `contain` | Seluruh gambar terlihat, bisa menyisakan ruang kosong |
| `cover` | Menutupi seluruh kotak, sebagian gambar terpotong (**dipakai**) |

### Foto PNG transparan

Bila foto berupa PNG tanpa latar, area transparannya menampakkan lapisan
di bawahnya, yaitu `__pill-fill` yang sudah berwarna cokelat gelap
(`--color-image-bg`). Jadi bunga tampil di atas latar gelap yang serasi.

### Timing bersamaan

Foto dan lapisan pengisi sama-sama memakai `--transition-fill` (0,5
detik), jadi **foto memudar masuk bersamaan dengan lapisan yang
melebar**, tidak berurutan.

---

## 8. State aktif dan fokus keyboard (baris 430 sampai 448)

```css
.jobsheet-btn.is-active {
  box-shadow: var(--btn-shadow-3d), 0 0 32px var(--glow-color-1);
}
```

### Dua bayangan sekaligus

`box-shadow` boleh berisi **beberapa bayangan** dipisah koma:

1. `var(--btn-shadow-3d)`: bayangan 3D putih ke atas (tetap ada).
2. `0 0 32px var(--glow-color-1)`: cahaya oren **di sekeliling** tombol
   (offset 0, blur 32px).

Bayangan 3D **harus ditulis ulang** di sini. Kalau hanya menulis glow,
nilai `box-shadow` menggantikan seluruhnya dan bayangan 3D hilang saat
hover.

### Ringkasan semua efek saat hover

| Efek | Diatur oleh |
|------|-------------|
| Tombol memanjang | `.w-xxx.is-active { width }` |
| Glow oren | `.is-active { box-shadow }` |
| Lapisan oren melebar | `.is-active .__pill-fill { width }` |
| Lapisan berubah gelap | `.is-active .__pill-fill { background-color }` |
| Foto muncul | `.is-active .__image { opacity }` |
| Naik ke depan (z-index) | **JS** (`btn.style.zIndex = 999`) |

Seluruhnya dipicu **satu hal**: class `is-active`.

**Kenapa z-index diatur JS, bukan CSS?** Setiap tombol sudah punya
`z-index` sebagai **style inline** (dipasang JS saat render). Style
inline mengalahkan selector CSS mana pun (kecuali `!important`), sehingga
mengubah `z-index` lewat CSS class tidak akan berhasil. Karena itu JS
mengubahnya langsung.

### `:focus-visible` (baris 445 sampai 448)

```css
.jobsheet-btn:focus-visible {
  outline: 3px solid var(--color-btn-accent);
  outline-offset: 4px;
}
```

| Kode | Penjelasan |
|------|-----------|
| `:focus-visible` | Pseudo-class yang aktif saat elemen difokus **dengan cara yang membutuhkan penanda**, terutama **keyboard (Tab)**. Tidak muncul saat diklik mouse. |
| `outline: 3px solid ...` | Garis tepi 3px berwarna oren. |
| `outline-offset: 4px` | Menggeser garis 4px **keluar** dari tepi tombol. |

**Perbedaan `outline` dan `border`:** `outline` digambar **di luar**
elemen dan **tidak menambah ukuran** atau menggeser tata letak.
`border` menjadi bagian dari kotak elemen.

**Perbedaan `:focus` dan `:focus-visible`:** `:focus` aktif pada
**semua** fokus (termasuk klik mouse), sehingga outline sering muncul
mengganggu setelah klik. `:focus-visible` hanya menampilkannya bila
memang perlu (keyboard), nyaman bagi pengguna mouse dan tetap jelas
bagi pengguna keyboard.

---

## 9. Start Overlay (baris 459 sampai 507)

### 9.1 `.start-overlay`

```css
.start-overlay {
  position: fixed;
  inset: 0;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;

  background-color: var(--color-bg);
  background-image:
    radial-gradient(circle at 50% 50%, var(--glow-color-1), transparent 55%);

  opacity: 1;
  transition: opacity var(--transition-hover);
}
```

| Kode | Penjelasan |
|------|-----------|
| `position: fixed` | Menempel pada **layar (viewport)**, tidak terpengaruh scroll. |
| `inset: 0` | **Singkatan** untuk `top: 0; right: 0; bottom: 0; left: 0`. Membuat elemen **menutupi seluruh layar**. |
| `z-index: 1000` | Berada **di atas semua konten**. Tombol jobsheet paling tinggi bernilai 999 (saat hover), jadi 1000 tetap di atasnya. |
| `display: flex; align-items: center; justify-content: center;` | **Trik memusatkan** isi di tengah layar secara **vertikal dan horizontal**. |
| `background-color` | Latar gelap penuh yang menutupi halaman di belakangnya. |
| `radial-gradient(circle at 50% 50%, ...)` | Cahaya oren di **tengah** layar yang memudar ke tepi. |
| `opacity: 1` + `transition` | Terlihat penuh, dan perubahan opacity akan halus. |

**Memusatkan dengan flexbox:**

| Properti | Sumbu |
|----------|-------|
| `justify-content: center` | Sumbu utama (mendatar untuk `row`) |
| `align-items: center` | Sumbu silang (vertikal untuk `row`) |

### 9.2 Menyembunyikan overlay

```css
.start-overlay.is-hidden {
  opacity: 0;
  pointer-events: none;
}
```

| Kode | Penjelasan |
|------|-----------|
| `opacity: 0` | Overlay memudar sampai transparan (dianimasikan `transition`). |
| `pointer-events: none` | Elemen **tidak menerima klik/hover sama sekali**. Klik "tembus" ke konten di bawahnya. |

**Kenapa `pointer-events: none` wajib?** Overlay yang transparan
(`opacity: 0`) **masih ada di layar** dan masih menutupi halaman. Tanpa
`pointer-events: none`, ia tetap **menangkap semua klik dan hover**
sehingga tombol jobsheet di bawahnya tidak bisa disentuh sama sekali.

> **Catatan jujur (perlu diketahui untuk UTS):** Komentar di CSS
> baris 456-457 menyebut overlay "fade out lalu `display:none`". Itu
> **tidak sesuai kode**: tidak ada aturan `display: none` untuk overlay.
> Yang terjadi hanya `opacity: 0` dan `pointer-events: none`; overlay
> **tetap ada di DOM**, hanya tak terlihat dan tak bisa disentuh.
> Komentar di baris 454 juga menyebut `setupAudioUnlock`, padahal
> fungsi yang dipakai sekarang bernama `setupStartOverlay`. Keduanya
> hanya komentar usang, bukan bug fungsi.

### 9.3 Tombol di overlay `.start-overlay__btn`

```css
.start-overlay__btn {
  padding: 20px 48px;
  border: 2px solid var(--color-btn-accent);
  border-radius: var(--btn-radius);
  background-color: transparent;
  color: var(--color-text);
  font-family: var(--font-main);
  font-size: clamp(16px, 2vw, 22px);
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  cursor: pointer;

  transition: background-color var(--transition-hover),
              color var(--transition-hover),
              box-shadow var(--transition-hover);
}
```

| Kode | Penjelasan |
|------|-----------|
| `padding: 20px 48px` | Dua nilai: atas-bawah 20px, kiri-kanan 48px. |
| `border: 2px solid oren` | Garis tepi oren (gaya "outline button"). |
| `background-color: transparent` | Isi tombol bening; latar overlay terlihat. |
| `font-family: var(--font-main)` | **Dituliskan ulang** karena elemen `<button>` **tidak mewarisi** font dari `body` secara bawaan; browser memberinya font sistem sendiri. Tanpa baris ini, font tombol berbeda dari halaman. |
| `transition` (tiga properti) | Warna latar, warna teks, dan bayangan berubah halus saat hover. |

**Catatan:** `.jobsheet-btn__number` tidak butuh `font-family` karena ia
berupa `<span>` di dalam tombol; teks tombol jobsheet diatur lewat
elemen anak yang mewarisi dari... (lihat catatan di soal 22).

```css
.start-overlay__btn:hover {
  background-color: var(--color-btn-accent);
  color: var(--color-bg);
  box-shadow: 0 0 40px var(--glow-color-1);
}

.start-overlay__btn:focus-visible {
  outline: 3px solid var(--color-text);
  outline-offset: 4px;
}
```

Saat hover: latar menjadi oren, teks menjadi gelap (agar tetap terbaca di
atas oren), dan muncul cahaya. Saat difokus keyboard: outline putih.

---

## 10. Konsep transition dan animasi (ringkasan)

```css
transition: property duration timing-function;
```

| Bagian | Contoh | Arti |
|--------|--------|------|
| `property` | `opacity` | Properti yang dianimasikan |
| `duration` | `0.5s` | Lama animasi |
| `timing-function` | `cubic-bezier(...)` | Kurva percepatan |

**Hal yang perlu diingat:**

1. `transition` ditulis pada **keadaan awal** (elemen dasar), bukan pada
   keadaan `:hover`/`.is-active`. Dengan begitu animasi berlaku **baik
   saat masuk maupun saat keluar**.
2. Hanya properti yang **bisa dianimasikan** (memiliki nilai numerik atau
   warna) yang berfungsi: `opacity`, `width`, `background-color`,
   `box-shadow`, `transform`. Properti seperti `display` tidak.
3. Karena `transition` ada di keadaan dasar, saat kursor **keluar**,
   semua efek **berbalik halus** ke keadaan awal. Itu yang membuat
   animasi masuk dan keluar sama-sama mulus.

---

## 11. Soal latihan UTS (Bagian 05)

**Soal 1.** Jelaskan bagaimana efek pill "terisi oren dari kiri ke
kanan" dibuat.

> **Jawaban:** Pill punya dasar putih tetap. Di atasnya ada elemen
> `__pill-fill` dengan `position: absolute; left: 0` dan `width: 0%`.
> Saat class `is-active` ditambahkan, `width` menjadi `100%`. Karena
> sisi kiri tetap dan ada `transition: width`, sisi kanan bergerak ke
> kanan secara halus sehingga tampak mengisi dari kiri ke kanan.

**Soal 2.** Siapa yang menganimasikan efek hover, JavaScript atau CSS?

> **Jawaban:** CSS, lewat `transition`. JavaScript hanya menambah dan
> menghapus class `is-active`. Perubahan nilai properti akibat class itu
> dianimasikan otomatis oleh browser.

**Soal 3.** Apa fungsi `overflow: hidden` pada `.jobsheet-btn__pill`?

> **Jawaban:** Memotong isi yang keluar dari bentuk pill. Lapisan oren
> dan foto berbentuk persegi panjang, sehingga dengan `overflow: hidden`
> mereka ikut terpotong mengikuti sudut bulat pill.

**Soal 4.** Kenapa `position: relative` dipasang pada pill dan
`position: absolute` pada `__pill-fill` dan `__image`?

> **Jawaban:** Elemen `absolute` diposisikan relatif terhadap induk
> terdekat yang punya `position`. Dengan pill `relative`,
> `top: 0; left: 0` pada anaknya berarti pojok kiri atas pill, bukan
> pojok layar. Anak `absolute` juga menumpuk tanpa mendorong elemen lain.

**Soal 5.** Jelaskan trik `margin-left: auto` pada angka.

> **Jawaban:** Dalam kontainer flex, margin `auto` menyerap seluruh ruang
> kosong di sisi tersebut. Dengan `margin-left: auto`, ruang kosong
> berada di kiri angka sehingga angka terdorong ke ujung kanan tombol.

**Soal 6.** Apa fungsi `flex-shrink: 0` pada `.jobsheet-btn`?

> **Jawaban:** Melarang tombol menyusut. Tanpa itu, 16 tombol dalam
> kolom flex dipaksa mengecil agar muat di panel sehingga panel tidak
> perlu scroll. Dengan `0`, tombol tetap setinggi aslinya, isi meluber,
> dan scroll panel aktif.

**Soal 7.** Bagaimana efek tombol bertumpuk dibuat?

> **Jawaban:** Dengan `margin-top` negatif (`--btn-overlap: -18px`) yang
> menarik tiap tombol naik menutupi bagian bawah tombol sebelumnya, ditambah
> `z-index` bertingkat dari JS (tombol atas lebih depan). Tombol pertama
> dikecualikan lewat `:first-child { margin-top: 0 }`.

**Soal 8.** Kenapa bayangan 3D tombol yang lebih pendek tidak terlihat?

> **Jawaban:** Bayangan mengarah ke atas dan jatuh di area tombol di
> atasnya. Tombol atas menumpuk dengan `z-index` lebih tinggi sehingga
> menutupi bayangan itu. Jika tombol atas lebih panjang, bayangan tombol
> pendek sepenuhnya tertutup; jika tombol bawah lebih panjang, sebagian
> bayangannya menjulur keluar dan terlihat.

**Soal 9.** Apa itu `:first-child`?

> **Jawaban:** Pseudo-class yang memilih elemen yang merupakan anak
> pertama dari induknya. Dipakai agar tombol pertama tidak ikut
> `margin-top` negatif.

**Soal 10.** Kenapa tombol memanjang saat hover, tidak digeser dengan
`translateX`?

> **Jawaban:** `translateX` menggeser seluruh tombol sehingga sisi
> kirinya lepas dari tepi layar dan meninggalkan celah. Dengan
> memperbesar `width` dari titik kiri yang tetap, tombol tidak pernah
> lepas dari tepi kiri.

**Soal 11.** Jelaskan spesifisitas CSS dengan contoh dari
`.jobsheet-btn.w-short.is-active`.

> **Jawaban:** Bila dua aturan bentrok, browser memilih yang lebih
> spesifik. `.jobsheet-btn.w-short.is-active` (3 class) lebih spesifik
> daripada `.jobsheet-btn.w-short` (2 class), jadi lebarnya versi hover
> yang dipakai saat class `is-active` ada.

**Soal 12.** Kenapa `z-index` tombol aktif dinaikkan lewat JS, bukan CSS?

> **Jawaban:** Setiap tombol sudah punya `z-index` sebagai style inline
> dari JS. Style inline mengalahkan selector CSS biasa, sehingga
> `z-index` di class `.is-active` tidak akan berlaku. Maka JS mengubahnya
> langsung.

**Soal 13.** Kenapa `.is-active` menulis ulang `var(--btn-shadow-3d)`
padahal sudah ada di aturan dasar?

> **Jawaban:** Nilai `box-shadow` pada aturan yang menang **menggantikan
> seluruhnya**, tidak digabung. Kalau hanya ditulis glow, bayangan 3D
> hilang saat hover. Maka keduanya ditulis, dipisah koma.

**Soal 14.** Apa perbedaan `outline` dan `border`?

> **Jawaban:** `border` menjadi bagian dari kotak elemen dan menambah
> ukurannya. `outline` digambar di luar elemen dan tidak menambah ukuran
> atau menggeser tata letak.

**Soal 15.** Apa perbedaan `:focus` dan `:focus-visible`?

> **Jawaban:** `:focus` aktif pada semua fokus, termasuk klik mouse.
> `:focus-visible` hanya aktif bila penanda fokus memang dibutuhkan,
> terutama navigasi keyboard. Pengguna mouse tidak melihat outline yang
> mengganggu, pengguna keyboard tetap punya penanda jelas.

**Soal 16.** Apa arti `inset: 0`?

> **Jawaban:** Singkatan untuk `top: 0; right: 0; bottom: 0; left: 0`.
> Dengan `position: fixed`, membuat elemen menutupi seluruh layar.

**Soal 17.** Bagaimana memusatkan tombol di tengah layar pada overlay?

> **Jawaban:** Kontainer diberi `display: flex; align-items: center;
> justify-content: center`. `justify-content` memusatkan pada sumbu utama
> (mendatar), `align-items` pada sumbu silang (vertikal).

**Soal 18.** Kenapa overlay yang sudah transparan tetap butuh
`pointer-events: none`?

> **Jawaban:** `opacity: 0` hanya membuat elemen tak terlihat; elemen
> masih ada dan menangkap klik serta hover. Tanpa `pointer-events: none`,
> tombol jobsheet di bawahnya tidak bisa disentuh.

**Soal 19.** Apa perbedaan `position: fixed` dan `absolute`?

> **Jawaban:** `fixed` diposisikan relatif terhadap layar (viewport) dan
> tidak ikut scroll. `absolute` diposisikan relatif terhadap induk
> terdekat yang punya `position`.

**Soal 20.** Kenapa `.start-overlay__btn` menulis ulang
`font-family: var(--font-main)`?

> **Jawaban:** Elemen `<button>` tidak mewarisi font dari `body` secara
> bawaan; browser memberinya font sistem sendiri. Menulis ulang
> `font-family` memastikan tombol memakai font yang sama dengan halaman.

**Soal 21.** Apa itu `object-fit: cover` dan apa bedanya dengan
`contain`?

> **Jawaban:** `cover` membuat gambar menutupi seluruh kotak tanpa
> distorsi, bagian berlebih dipotong. `contain` menampilkan seluruh
> gambar dan bisa menyisakan ruang kosong. Project memakai `cover`
> supaya foto memenuhi pill.

**Soal 22.** Kenapa `transition` ditulis pada elemen dasar, bukan pada
`.is-active`?

> **Jawaban:** Supaya animasi berlaku baik saat masuk maupun saat
> keluar. Bila `transition` hanya di `.is-active`, animasi hanya terjadi
> saat class ditambah; saat class dihapus, perubahan kembali terjadi
> seketika.

**Soal 23.** Apa fungsi `calc()` pada
`height: calc(100% - (var(--pill-margin-y) * 2))`?

> **Jawaban:** Menghitung nilai dengan mencampur satuan berbeda. Tinggi
> pill = 100% tinggi tombol dikurangi dua kali margin (atas dan bawah),
> sehingga pill tetap punya jarak dari tepi tombol abu.

**Soal 24.** Bagaimana foto PNG transparan tetap terlihat menyatu dengan
tema?

> **Jawaban:** Area transparan PNG menampakkan lapisan di bawahnya, yaitu
> `__pill-fill` yang saat aktif berwarna cokelat gelap
> (`--color-image-bg`). Jadi bunga tampil di atas latar gelap yang
> serasi.

**Soal 25.** Sebutkan semua efek yang terjadi saat tombol di-hover dan
siapa yang mengaturnya.

> **Jawaban:** Tombol memanjang (CSS `.w-xxx.is-active`), glow oren (CSS
> `.is-active`), lapisan oren melebar dan berubah gelap (CSS
> `.is-active .__pill-fill`), foto muncul (CSS `.is-active .__image`),
> naik ke depan (JS `zIndex = 999`), judul kanan bawah muncul (JS +
> CSS `.is-visible`), suara diputar (JS). Semua dipicu class
> `is-active`.

---

*Sebelumnya: Bagian 04 (`style.css` variabel dan layout)*
*Lanjut ke Bagian 06: `style.css` responsive dan accessibility, plus soal UTS gabungan*
