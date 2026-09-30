# HANDBOOK JOBSHEET COVER
## Bagian 04: `style.css` (Variabel, Reset, dan Layout)

Bagian ini menjelaskan baris 1 sampai 259 pada `css/style.css`:

1. CSS Variables di `:root` (baris 18 sampai 123)
2. Reset dasar (baris 128 sampai 132)
3. `html` dan `body` (baris 138 sampai 153)
4. Pembungkus halaman `.page` (baris 159 sampai 165)
5. Panel kiri `.jobsheet-panel` dan `.jobsheet-list` (baris 171 sampai 197)
6. Area kanan `.right-area`, `.identity`, `.active-title` (baris 203 sampai 259)

---

## 1. Dasar-dasar CSS yang perlu dipahami dulu

### 1.1 Anatomi aturan CSS

```css
.identity-title {          /* selector: elemen mana yang dipilih */
  font-size: 32px;         /* properti: nilai */
  font-weight: 400;
}
```

| Istilah | Arti |
|---------|------|
| **Selector** | Penunjuk elemen yang mau ditata (`.identity-title`) |
| **Properti** | Aspek yang diubah (`font-size`) |
| **Nilai** | Isi pengaturannya (`32px`) |
| **Deklarasi** | Satu pasang properti dan nilai, diakhiri titik koma |

### 1.2 Jenis selector yang dipakai di project

| Selector | Contoh | Arti |
|----------|--------|------|
| Elemen | `html, body` | Semua elemen `html` dan `body` |
| Class | `.page` | Elemen dengan `class="page"` (titik di depan) |
| Universal | `*` | Semua elemen |
| Gabungan class | `.jobsheet-btn.is-active` | Elemen yang punya **kedua** class sekaligus |
| Keturunan | `.jobsheet-btn.is-active .jobsheet-btn__image` | `.jobsheet-btn__image` **di dalam** `.jobsheet-btn.is-active` |
| Pseudo-element | `.jobsheet-panel::-webkit-scrollbar` | Bagian khusus dari elemen (scrollbar) |
| Pseudo-class | `.jobsheet-btn:first-child` | Elemen dalam keadaan tertentu |

### 1.3 Satuan ukuran

| Satuan | Arti | Contoh pemakaian di project |
|--------|------|----------------------------|
| `px` | Piksel, ukuran tetap | `--page-padding-y: 40px` |
| `%` | Persen dari elemen induk | `--left-panel-width: 66%` |
| `vw` | 1% dari **lebar** layar | `clamp(32px, 4vw, 56px)` |
| `vh` | 1% dari **tinggi** layar | `--btn-height: 15.5vh` |
| `em` | Relatif terhadap ukuran font | `letter-spacing: 0.08em` |

---

## 2. CSS Variables di `:root` (baris 18 sampai 123)

### 2.1 Apa itu `:root`?

```css
:root {
  --color-bg: #0a0808;
}
```

`:root` adalah pseudo-class yang menunjuk **elemen akar** dokumen
(`<html>`). Variabel yang dideklarasikan di sini berlaku untuk
**seluruh halaman**. Awalan `--` menandakan **custom property**
(variabel buatan sendiri). Dipakai dengan `var(--nama)`.

### 2.2 Palet warna (baris 29 sampai 53)

| Variabel | Nilai | Dipakai untuk |
|----------|-------|---------------|
| `--color-bg` | `#0a0808` | Warna latar halaman (hitam hangat) |
| `--color-text` | `#f5f0ec` | Warna teks (putih hangat) |
| `--color-btn-bg` | `#2b2624` | Badan tombol (abu arang hangat) |
| `--color-btn-inner` | `#f2ece4` | Warna dasar pill (putih hangat) |
| `--color-btn-accent` | `#e85d34` | Warna oren saat hover, teks kelas, outline fokus |
| `--color-image-bg` | `#3d1f14` | Latar gelap di belakang foto saat hover |
| `--glow-color-1` | `rgba(232, 93, 52, 0.4)` | Cahaya oren |
| `--glow-color-2` | `rgba(120, 40, 70, 0.28)` | Cahaya ungu tua |

**Format warna:**
- `#0a0808` disebut **hex**: tiga pasang digit (merah, hijau, biru) dalam
  basis 16. `0a` = merah, `08` = hijau, `08` = biru.
- `rgba(232, 93, 52, 0.4)` adalah **RGBA**: merah 232, hijau 93,
  biru 52, dan **alpha** 0.4 (tingkat kepekatan; 0 = transparan total,
  1 = padat penuh).

**Kenapa bukan hitam murni `#000000`?** Undertone hangat membuat tampilan
lebih "sinematik" dan menyatu dengan cahaya oren. Palet dirancang agar
semua elemen terasa satu keluarga warna.

### 2.3 Layout (baris 56 sampai 59)

```css
--right-area-width: 34%;
--left-panel-width: 66%;
--page-padding-y: 40px;
--page-padding-right: 40px;
```

`34% + 66% = 100%`. Layar dibagi dua kolom: kiri 66% untuk tombol,
kanan 34% untuk identitas. Padding vertikal (atas dan bawah) serta
kanan masing-masing 40px.

### 2.4 Tipografi (baris 62 sampai 66)

```css
--font-main: 'Helvetica Neue', Arial, sans-serif;
--identity-title-size: clamp(32px, 4vw, 56px);
```

**`font-family` dengan cadangan (fallback):** Browser mencoba font
pertama; jika tidak tersedia, mencoba berikutnya. `sans-serif` adalah
keluarga generik yang selalu ada sebagai pengaman terakhir.

**Fungsi `clamp(min, ideal, max)`:** menghasilkan nilai yang **fleksibel
tetapi dibatasi**.

```
clamp(32px, 4vw, 56px)
       ^min  ^ideal ^max
```

- Nilai ideal `4vw` (4% lebar layar) mengikuti ukuran layar.
- Tidak akan **lebih kecil dari 32px** dan **lebih besar dari 56px**.
- Layar 1000px: 4vw = 40px -> dipakai 40px.
- Layar 500px: 4vw = 20px -> di bawah min, jadi dipakai 32px.
- Layar 1600px: 4vw = 64px -> di atas max, jadi dipakai 56px.

Ini membuat teks **responsive** tanpa media query tambahan.

### 2.5 Ukuran tombol (baris 75 sampai 85)

| Variabel | Nilai | Penjelasan |
|----------|-------|-----------|
| `--btn-height` | `15.5vh` | Tinggi tombol = 15,5% tinggi layar. Membuat sekitar 5-6 tombol terlihat sekaligus. |
| `--btn-min-height` | `110px` | Batas tinggi minimum |
| `--btn-max-height` | `170px` | Batas tinggi maksimum |
| `--btn-gap` | `20px` | Dideklarasikan tetapi tidak dipakai di aturan CSS mana pun (variabel sisa, lihat catatan di bawah tabel) |
| `--btn-radius` | `999px` | Radius sudut sangat besar sehingga ujung tombol **bulat penuh** (bentuk pil) |
| `--btn-number-size` | `clamp(40px, 5vh, 60px)` | Ukuran angka |
| `--btn-overlap` | `-18px` | Margin atas **negatif** agar tombol menumpuk |

**Kenapa `999px` untuk membuat bulat?** Radius yang lebih besar dari
setengah tinggi elemen akan otomatis dibatasi browser menjadi setengah
tinggi, menghasilkan ujung setengah lingkaran sempurna berapa pun
tingginya.

**Catatan `--btn-gap`:** Variabel ini dideklarasikan (baris 78) dan
diubah nilainya di media query mobile (baris 566), tetapi **tidak pernah
dipakai** lewat `var(--btn-gap)` di aturan CSS mana pun. `.jobsheet-list`
memakai `gap: 0` tertulis langsung. Jadi variabel ini tidak berpengaruh
apa-apa; ia sisa dari tahap desain awal sebelum tombol dibuat
bertumpuk. Bila ditanya di UTS, jawab jujur bahwa itu variabel sisa
yang aman dihapus.

### 2.6 Lebar tombol bervariasi (baris 94 sampai 101)

Delapan variabel: empat lebar normal dan empat lebar saat hover.

| Kelas | Normal | Saat hover |
|-------|--------|-----------|
| short | 44% | 47% |
| medium | 64% | 67% |
| long | 88% | 91% |
| medium2 | 72% | 75% |

Setiap versi hover **3% lebih lebar** sehingga tombol terasa
"memanjang ke kanan" saat disentuh. Ini menggantikan cara lama
(`translateX`) yang membuat tombol lepas dari tepi kiri layar.

### 2.7 Pill dan bayangan 3D (baris 107 sampai 116)

```css
--pill-width: 78%;
--pill-margin-y: 14px;
--pill-border: none;
--btn-shadow-3d: 0 -22px 30px -8px rgba(245, 240, 236, 0.6);
```

Sintaks `box-shadow`:

```
box-shadow: offset-x  offset-y  blur  spread  warna;
             0        -22px     30px  -8px    rgba(...)
```

| Bagian | Nilai | Efek |
|--------|-------|------|
| offset-x | `0` | Tidak bergeser ke samping |
| offset-y | `-22px` | **Negatif = ke atas**. Bayangan muncul di atas tombol |
| blur | `30px` | Tingkat pengaburan; makin besar makin lembut |
| spread | `-8px` | **Negatif** = mengecilkan bayangan agar tidak melebar ke samping |
| warna | putih hangat 60% | Warna bayangan |

Bayangan yang mengarah **ke atas** membuat efek "lapisan kedua yang
menjorok ke atas" seperti pada gambar referensi.

### 2.8 Animasi (baris 119 sampai 122)

```css
--transition-fast: 0.2s ease;
--transition-medium: 0.35s ease;
--transition-hover: 0.45s cubic-bezier(0.22, 1, 0.36, 1);
--transition-fill: 0.5s cubic-bezier(0.65, 0, 0.35, 1);
```

| Bagian | Arti |
|--------|------|
| `0.45s` | Durasi 0,45 detik |
| `ease` | Fungsi waktu bawaan: mulai pelan, cepat di tengah, pelan di akhir |
| `cubic-bezier(a, b, c, d)` | Kurva percepatan **buatan sendiri** dengan empat angka |

**Kenapa memakai `cubic-bezier` khusus?** Kurva bawaan terasa kaku.
Kurva `0.22, 1, 0.36, 1` (mirip "ease-out-quint") bergerak cepat di awal
lalu melambat halus, sehingga terasa alami dan "hidup". Kurva
`0.65, 0, 0.35, 1` (mirip "ease-in-out-cubic") halus di awal dan akhir,
cocok untuk efek pill yang terisi.

---

## 3. Reset dasar (baris 128 sampai 132)

```css
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
```

| Kode | Penjelasan |
|------|-----------|
| `*` | Selector universal: **semua elemen** |
| `margin: 0; padding: 0;` | Menghapus jarak bawaan browser. Setiap browser punya margin/padding bawaan berbeda-beda (misal `h1`, `p`, `body`). Mereset menyamakan titik awal. |
| `box-sizing: border-box;` | Mengubah cara hitung ukuran elemen (lihat di bawah). |

### Box model dan `box-sizing`

Setiap elemen adalah kotak berlapis: **content, padding, border, margin**.

| Mode | Lebar total elemen |
|------|--------------------|
| `content-box` (bawaan) | `width` + padding + border (lebih besar dari `width`) |
| `border-box` | Tepat `width`; padding dan border **dihitung di dalamnya** |

Contoh: `width: 200px; padding: 20px`.
- `content-box` -> total 240px (tidak terduga).
- `border-box` -> total tetap 200px (mudah diprediksi).

`border-box` membuat penghitungan layout jauh lebih mudah.

---

## 4. `html` dan `body` (baris 138 sampai 153)

```css
html, body {
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: var(--color-bg);
  color: var(--color-text);
  font-family: var(--font-main);
}
```

| Properti | Penjelasan |
|----------|-----------|
| `html, body` | Koma berarti selector **ganda**: aturan berlaku untuk keduanya |
| `width: 100%; height: 100%;` | Memenuhi seluruh layar |
| **`overflow: hidden;`** | **Kunci syarat tugas.** Memotong isi yang melebihi layar dan **menghilangkan scrollbar halaman**. Karena itu seluruh halaman tidak bisa discroll. |
| `background-color` | Warna latar dari variabel |
| `color` | Warna teks bawaan (diwariskan ke elemen di dalamnya) |
| `font-family` | Font bawaan (juga diwariskan) |

**Konsep pewarisan (inheritance):** Properti seperti `color` dan
`font-family` **diwariskan** ke elemen anak. Cukup diatur di `body`,
seluruh isi halaman ikut.

**Kenapa `height: 100%` di `html` dan `body`?** Persen tinggi mengacu ke
tinggi induk. Agar `.page` bisa `height: 100%` (penuh layar), rantai
induknya (`html` lalu `body`) juga harus 100%.

### Glow sinematik (baris 148 sampai 153)

```css
body {
  background-image:
    radial-gradient(circle at 88% 15%, var(--glow-color-1), transparent 40%),
    radial-gradient(circle at 95% 55%, var(--glow-color-2), transparent 45%);
  background-repeat: no-repeat;
}
```

| Kode | Penjelasan |
|------|-----------|
| `radial-gradient(...)` | Gradasi warna berbentuk **lingkaran** yang menyebar dari satu titik |
| `circle at 88% 15%` | Pusat lingkaran di 88% dari kiri dan 15% dari atas (pojok kanan atas) |
| `var(--glow-color-1), transparent 40%` | Dari warna oren di pusat, memudar sampai transparan pada jarak 40% |
| Dua gradasi dipisah koma | Dua lapisan latar ditumpuk: oren di kanan atas, ungu tua di kanan tengah |
| `background-repeat: no-repeat` | Gradasi tidak diulang-ulang |

Inilah cahaya halus di pojok kanan yang memberi kesan sinematik.

**Kenapa `body` dipisah dari aturan `html, body`?** Karena `background-image`
hanya diinginkan di `body`, sedangkan `overflow` dan ukuran perlu untuk
keduanya.

---

## 5. Pembungkus halaman `.page` (baris 159 sampai 165)

```css
.page {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: row;
  padding: var(--page-padding-y) var(--page-padding-right) var(--page-padding-y) 0;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `display: flex` | Mengaktifkan **Flexbox** pada `.page`: anak-anaknya tersusun fleksibel |
| `flex-direction: row` | Anak tersusun **mendatar** (kiri ke kanan). Ini nilai bawaan, ditulis eksplisit agar jelas. |
| `padding` (4 nilai) | Urutan: **atas, kanan, bawah, kiri** (searah jarum jam) |

Nilai padding: `40px 40px 40px 0`. Sisi **kiri = 0** supaya tombol
**menempel di tepi kiri layar** seperti gambar referensi.

**Mengingat urutan padding:** "TRouBLe" = Top, Right, Bottom, Left.

### Flexbox singkat

Flexbox adalah sistem tata letak satu dimensi.

| Properti | Fungsi |
|----------|--------|
| `display: flex` | Membuat kontainer fleksibel (induk) |
| `flex-direction: row` | Arah susunan mendatar |
| `flex-direction: column` | Arah susunan menurun |

Di `.page`, dua anak (`.jobsheet-panel` dan `.right-area`) tersusun
berdampingan: kiri dan kanan.

---

## 6. Panel kiri (baris 171 sampai 197)

### 6.1 `.jobsheet-panel`

```css
.jobsheet-panel {
  width: var(--left-panel-width);
  height: 100%;
  overflow-y: auto;
  overflow-x: hidden;

  scrollbar-width: none;
  -ms-overflow-style: none;
}

.jobsheet-panel::-webkit-scrollbar {
  display: none;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `width: 66%` | Lebar panel kiri |
| `height: 100%` | Setinggi area di dalam `.page` |
| **`overflow-y: auto;`** | **Kunci syarat tugas.** Jika isi lebih tinggi dari panel, **muncul kemampuan scroll vertikal**. Hanya panel ini yang boleh discroll. |
| `overflow-x: hidden;` | Tidak boleh scroll ke samping; isi yang melebar dipotong |
| `scrollbar-width: none;` | Menyembunyikan scrollbar di **Firefox** |
| `-ms-overflow-style: none;` | Menyembunyikan scrollbar di IE/Edge lama |
| `::-webkit-scrollbar { display: none; }` | Menyembunyikan scrollbar di **Chrome, Safari, Edge modern** |

Tiga baris terakhir dibutuhkan karena tiap browser punya cara berbeda.
Hasilnya: scrollbar tidak terlihat tetapi **scroll dengan mouse wheel
tetap berfungsi**, sesuai syarat "scrollbar invisible/minimal".

**Perbedaan nilai `overflow`:**

| Nilai | Perilaku |
|-------|----------|
| `visible` | Isi berlebih tetap tampil (meluber) |
| `hidden` | Isi berlebih dipotong, tidak bisa discroll |
| `scroll` | Selalu tampil scrollbar |
| `auto` | Scrollbar/scroll hanya aktif bila isi berlebih |

### 6.2 `.jobsheet-list`

```css
.jobsheet-list {
  display: flex;
  flex-direction: column;
  gap: 0;
  padding: 56px 24px 40px 0;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `display: flex; flex-direction: column;` | Tombol tersusun **menurun** (atas ke bawah) |
| `gap: 0` | Tanpa jarak antar tombol (tombol ditumpuk) |
| `padding: 56px 24px 40px 0` | Atas 56px, kanan 24px, bawah 40px, kiri 0 |

**Alasan padding:**
- **Atas 56px:** bayangan 3D tombol pertama mengarah ke atas
  (`-22px` ditambah blur `30px`). Tanpa ruang cukup, bayangan terpotong
  batas panel.
- **Kanan 24px:** ruang aman untuk cahaya (glow) saat hover.
- **Bawah 40px:** napas visual di akhir daftar.
- **Kiri 0:** tombol menempel di tepi kiri.

---

## 7. Area kanan (baris 203 sampai 259)

### 7.1 `.right-area`

```css
.right-area {
  width: var(--right-area-width);
  height: 100%;
  position: relative;
}
```

`position: relative` di sini bertujuan menjadikan `.right-area`
**titik acuan** bagi anak-anaknya yang memakai `position: absolute`.

### Konsep `position`

| Nilai | Perilaku |
|-------|----------|
| `static` | Bawaan; mengikuti alur normal |
| `relative` | Tetap di alur normal, tetapi menjadi **acuan** bagi anak `absolute` |
| `absolute` | Keluar dari alur normal; posisi dihitung dari **induk terdekat yang punya position** |
| `fixed` | Menempel pada layar, tidak ikut scroll |

### 7.2 `.identity` (pojok kanan atas)

```css
.identity {
  position: absolute;
  top: 0;
  right: 0;
  text-align: right;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `position: absolute` | Diposisikan bebas terhadap `.right-area` |
| `top: 0; right: 0;` | Menempel di **sudut kanan atas** area tersebut |
| `text-align: right` | Teks rata kanan |

Karena `.right-area` tidak ikut scroll, identitas **tetap tampil di
layar** sesuai syarat.

### 7.3 Tipografi identitas

```css
.identity-title {
  font-size: var(--identity-title-size);
  font-weight: 400;
  letter-spacing: 0.08em;
  line-height: 1;
  text-transform: uppercase;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `font-weight: 400` | Ketebalan normal (400 = regular, 700 = bold) |
| `letter-spacing: 0.08em` | Jarak antar huruf; `em` relatif terhadap ukuran font sehingga proporsional |
| `line-height: 1` | Tinggi baris sama dengan ukuran font (rapat) |
| `text-transform: uppercase` | Mengubah tampilan menjadi HURUF BESAR tanpa mengubah teks aslinya |

```css
.identity-name {
  margin-top: 10px;
  font-size: var(--identity-name-size);
  font-weight: 700;
  line-height: 1.25;
}

.identity-class {
  margin-top: 4px;
  font-size: var(--identity-class-size);
  font-weight: 700;
  letter-spacing: 0.05em;
  color: var(--color-btn-accent);
}
```

`margin-top` memberi jarak dari elemen di atasnya. Teks kelas "TI-2D"
diberi warna oren dari variabel accent agar serasi.

### 7.4 `.active-title` (pojok kanan bawah)

```css
.active-title {
  position: absolute;
  bottom: 0;
  right: 0;
  font-size: var(--active-title-size);
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  text-align: right;

  opacity: 0;
  transition: opacity var(--transition-medium);
}

.active-title.is-visible {
  opacity: 1;
}
```

| Properti | Penjelasan |
|----------|-----------|
| `bottom: 0; right: 0;` | Menempel di sudut **kanan bawah** |
| `opacity: 0` | Sepenuhnya **transparan** (tidak terlihat) |
| `transition: opacity 0.35s ease` | Perubahan `opacity` terjadi **halus** selama 0,35 detik, bukan mendadak |
| `.is-visible { opacity: 1 }` | Saat class ditambah JS, menjadi terlihat penuh |

**Mekanisme fade in dan out:** JS menambah atau menghapus class
`is-visible`. Karena ada `transition`, perubahan `opacity` dianimasikan
otomatis oleh browser. **JS tidak menganimasikan apa pun; ia hanya
mengganti class.**

**Perbedaan `opacity: 0` dan `display: none`:**

| | `opacity: 0` | `display: none` |
|---|--------------|-----------------|
| Terlihat | Tidak | Tidak |
| Menempati ruang | Ya | Tidak |
| Bisa dianimasikan halus | **Ya** | Tidak |

Karena butuh animasi halus, dipilih `opacity`.

---

## 8. Soal latihan UTS (Bagian 04)

**Soal 1.** Apa itu CSS variable? Bagaimana cara mendeklarasikan dan
memakainya?

> **Jawaban:** CSS variable (custom property) adalah nilai buatan
> sendiri yang bisa dipakai ulang. Dideklarasikan dengan awalan `--`,
> biasanya di `:root`, misal `--color-bg: #0a0808;`, lalu dipakai dengan
> `var(--color-bg)`. Perubahan di satu tempat otomatis berlaku di semua
> pemakaian.

**Soal 2.** Apa fungsi `:root`?

> **Jawaban:** `:root` menunjuk elemen akar dokumen (`<html>`). Variabel
> yang dideklarasikan di sini berlaku untuk seluruh halaman.

**Soal 3.** Jelaskan fungsi `clamp(32px, 4vw, 56px)`.

> **Jawaban:** Menghasilkan nilai fleksibel yang dibatasi. Nilai ideal
> `4vw` mengikuti lebar layar, tetapi tidak akan kurang dari 32px dan
> tidak lebih dari 56px. Membuat ukuran teks responsive tanpa media
> query.

**Soal 4.** Apa perbedaan satuan `px`, `%`, `vw`, `vh`, dan `em`?

> **Jawaban:** `px` ukuran tetap dalam piksel. `%` persen dari elemen
> induk. `vw` 1% dari lebar layar. `vh` 1% dari tinggi layar. `em`
> relatif terhadap ukuran font elemen.

**Soal 5.** Apa gunanya reset `* { margin: 0; padding: 0; box-sizing:
border-box; }`?

> **Jawaban:** Menghapus margin dan padding bawaan browser yang berbeda
> antar browser, dan memakai `border-box` sehingga padding dan border
> dihitung di dalam lebar elemen. Hasilnya layout lebih mudah diprediksi.

**Soal 6.** Jelaskan perbedaan `content-box` dan `border-box`.

> **Jawaban:** Pada `content-box`, lebar total = `width` + padding +
> border. Pada `border-box`, lebar total tetap sama dengan `width`
> karena padding dan border dihitung di dalamnya. Contoh: `width: 200px;
> padding: 20px` menjadi 240px pada `content-box` tetapi tetap 200px pada
> `border-box`.

**Soal 7.** Bagaimana caranya membuat seluruh halaman tidak bisa
discroll? Tunjukkan kodenya.

> **Jawaban:** Pada `html` dan `body` dipasang `width: 100%; height:
> 100%; overflow: hidden;`. `overflow: hidden` memotong isi yang
> melebihi layar dan menghilangkan scrollbar halaman.

**Soal 8.** Bagaimana caranya hanya panel kiri yang bisa discroll?

> **Jawaban:** Pada `.jobsheet-panel` dipasang `height: 100%;
> overflow-y: auto; overflow-x: hidden;`. Jika isi lebih tinggi dari
> panel, scroll vertikal aktif hanya di panel itu.

**Soal 9.** Bagaimana cara menyembunyikan scrollbar tetapi tetap bisa
scroll? Kenapa butuh tiga baris kode?

> **Jawaban:** Dengan `scrollbar-width: none` (Firefox),
> `-ms-overflow-style: none` (IE/Edge lama), dan `::-webkit-scrollbar {
> display: none; }` (Chrome/Safari/Edge modern). Butuh tiga karena tiap
> browser punya cara berbeda. Scroll dengan mouse wheel tetap berfungsi.

**Soal 10.** Jelaskan perbedaan nilai `overflow`: `visible`, `hidden`,
`scroll`, `auto`.

> **Jawaban:** `visible` isi berlebih tetap tampil. `hidden` dipotong
> dan tidak bisa discroll. `scroll` selalu menampilkan scrollbar. `auto`
> scroll hanya aktif jika isi melebihi ukuran kotak.

**Soal 11.** Apa itu Flexbox? Properti apa yang dipakai di `.page` dan
`.jobsheet-list`?

> **Jawaban:** Flexbox adalah sistem tata letak satu dimensi. `.page`
> memakai `display: flex; flex-direction: row` sehingga panel kiri dan
> area kanan berdampingan. `.jobsheet-list` memakai `flex-direction:
> column` sehingga tombol tersusun menurun.

**Soal 12.** Apa urutan nilai pada `padding: 40px 40px 40px 0`?

> **Jawaban:** Atas, kanan, bawah, kiri (searah jarum jam). Jadi atas
> 40px, kanan 40px, bawah 40px, kiri 0. Kiri 0 membuat tombol menempel
> di tepi kiri layar.

**Soal 13.** Jelaskan perbedaan `position: relative` dan `absolute`.

> **Jawaban:** `relative` tetap berada di alur normal tetapi menjadi
> acuan bagi anak `absolute`. `absolute` keluar dari alur normal dan
> posisinya dihitung dari induk terdekat yang memiliki `position`. Di
> project, `.right-area` (`relative`) menjadi acuan bagi `.identity` dan
> `.active-title` (`absolute`).

**Soal 14.** Kenapa identitas tetap tampil dan tidak ikut scroll?

> **Jawaban:** Karena `.identity` berada di `.right-area` yang tidak
> memiliki scroll, sedangkan yang boleh discroll hanya
> `.jobsheet-panel`. Halaman keseluruhan juga `overflow: hidden`.

**Soal 15.** Bagaimana judul di kanan bawah bisa memudar halus (fade)?
Apakah JS yang menganimasikan?

> **Jawaban:** Bukan JS. CSS mengatur `opacity: 0` dan `transition:
> opacity 0.35s`. JS hanya menambah atau menghapus class `is-visible`
> yang membuat `opacity: 1`. Perubahan opacity dianimasikan otomatis
> oleh browser karena ada `transition`.

**Soal 16.** Apa perbedaan `opacity: 0` dan `display: none`?

> **Jawaban:** Keduanya membuat elemen tak terlihat. `opacity: 0` masih
> menempati ruang dan bisa dianimasikan halus. `display: none`
> menghilangkan elemen dari tata letak dan tidak bisa dianimasikan.

**Soal 17.** Jelaskan sintaks `box-shadow: 0 -22px 30px -8px
rgba(245,240,236,0.6)`.

> **Jawaban:** offset-x 0 (tidak ke samping), offset-y -22px (negatif =
> ke atas), blur 30px (kelembutan), spread -8px (mengecilkan bayangan
> agar tidak melebar ke samping), lalu warna putih hangat 60% opak.
> Hasilnya bayangan lembut di atas tombol.

**Soal 18.** Apa arti `rgba(232, 93, 52, 0.4)`?

> **Jawaban:** Warna merah 232, hijau 93, biru 52, dengan alpha 0,4
> (kepekatan 40%; 0 transparan penuh, 1 padat penuh).

**Soal 19.** Kenapa `--btn-radius: 999px` membuat ujung tombol bulat
penuh?

> **Jawaban:** Radius yang lebih besar dari setengah tinggi elemen
> otomatis dibatasi browser menjadi setengah tinggi, sehingga ujung
> menjadi setengah lingkaran sempurna berapa pun tingginya.

**Soal 20.** Jelaskan konsep pewarisan (inheritance) pada CSS dengan
contoh dari project.

> **Jawaban:** Sebagian properti (misal `color`, `font-family`)
> diwariskan dari induk ke anak. Di project, `color` dan `font-family`
> cukup diatur di `html, body` dan seluruh elemen di dalamnya otomatis
> memakainya.

**Soal 21.** Apa itu `radial-gradient` dan bagaimana dipakai untuk
membuat cahaya di pojok kanan?

> **Jawaban:** Gradasi warna berbentuk lingkaran yang menyebar dari satu
> titik. `radial-gradient(circle at 88% 15%, oren, transparent 40%)`
> menaruh pusat lingkaran di pojok kanan atas dan memudarkannya sampai
> transparan, menghasilkan cahaya halus.

**Soal 22.** Kenapa padding atas `.jobsheet-list` dibuat besar (56px)?

> **Jawaban:** Karena bayangan 3D tombol pertama mengarah ke atas (offset
> 22px ditambah blur 30px). Tanpa ruang cukup, bayangan terpotong oleh
> batas panel.

**Soal 23.** Apa itu selector `.jobsheet-btn.is-active`?

> **Jawaban:** Selector gabungan tanpa spasi yang memilih elemen yang
> memiliki **kedua class sekaligus** (`jobsheet-btn` dan `is-active`).
> Berbeda dengan `.jobsheet-btn .is-active` (dengan spasi) yang berarti
> elemen `.is-active` di **dalam** `.jobsheet-btn`.

**Soal 24.** Kenapa dipakai `cubic-bezier` dan bukan `ease` biasa?

> **Jawaban:** `cubic-bezier` memungkinkan kurva percepatan khusus.
> Kurva `0.22, 1, 0.36, 1` bergerak cepat di awal lalu melambat halus
> sehingga animasi terasa alami, tidak kaku seperti kurva bawaan.

**Soal 25.** Bagaimana mengganti warna oren menjadi biru di seluruh
website?

> **Jawaban:** Ubah satu nilai `--color-btn-accent` di `:root` (dan
> `--glow-color-1` untuk cahayanya). Karena semua elemen memakai
> `var(--color-btn-accent)`, seluruh website ikut berubah.

---

*Sebelumnya: Bagian 03 (`main.js` interaksi)*
*Lanjut ke Bagian 05: `style.css` bagian tombol, animasi, dan overlay*
