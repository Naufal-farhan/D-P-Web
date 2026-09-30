# HANDBOOK JOBSHEET COVER
## Bagian 03: `main.js` (Interaksi: Overlay, Hover, Klik, Init)

Bagian ini menjelaskan baris 117 sampai 273 pada `js/main.js`, yaitu
empat unit kode:

1. `setupStartOverlay()`: layar "KLIK UNTUK MULAI"
2. `setupHoverInteraction()`: efek hover dan fokus keyboard
3. `setupClickNavigation()`: pindah halaman saat diklik
4. Blok `DOMContentLoaded`: penjalan semua fungsi di atas

> **Catatan nomor baris:** Nomor baris pada handbook mengikuti file
> `main.js` asli. Blok komentar panjang di atas tiap fungsi tidak
> dijelaskan ulang karena isinya sudah diterangkan di teks.

---

## 1. `setupStartOverlay()` (baris 134 sampai 155)

### 1.1 Tujuan

Browser modern **memblokir audio otomatis** sampai pengguna berinteraksi.
Fungsi ini memasang aksi pada tombol "KLIK UNTUK MULAI". Klik pada tombol
itu menjadi interaksi pertama, sehingga suara hover bisa bekerja setelahnya.

### 1.2 Kode dan penjelasan

```javascript
function setupStartOverlay() {
  const overlay = document.getElementById("startOverlay");
  const startBtn = document.getElementById("startOverlayBtn");
  if (!overlay || !startBtn) return;
```

| Kode | Penjelasan |
|------|-----------|
| `function setupStartOverlay() {` | Mendeklarasikan fungsi. Awalan `setup` menandakan fungsi yang **memasang** sesuatu (event listener). |
| `document.getElementById("startOverlay")` | Mengambil elemen lapisan penutup layar (`div.start-overlay`). |
| `document.getElementById("startOverlayBtn")` | Mengambil tombol di tengah overlay. |
| `if (!overlay \|\| !startBtn) return;` | **Guard clause**. Tanda `\|\|` berarti "atau". Artinya: jika overlay **atau** tombolnya tidak ditemukan, hentikan fungsi. Mencegah error di baris-baris berikutnya. |

```javascript
  startBtn.addEventListener("click", () => {
```

Memasang **event listener**: saat tombol diklik, jalankan fungsi panah
(arrow function) di dalamnya.

```javascript
    const primer = new Audio(jobsheets[0]?.sound || "");
    primer.volume = 0;
    primer.play()
      .then(() => primer.pause())
      .catch(() => {
        // Diamkan ...
      });
```

Ini bagian paling menarik. Uraiannya:

| Kode | Penjelasan |
|------|-----------|
| `new Audio(...)` | Membuat objek audio dari sebuah file suara. |
| `jobsheets[0]?.sound` | Mengambil properti `sound` dari **elemen pertama** array. Tanda `?.` disebut **optional chaining**: jika `jobsheets[0]` tidak ada, hasilnya `undefined` (tidak error). |
| `\|\| ""` | Jika hasil sebelumnya kosong (`undefined`), pakai string kosong sebagai cadangan. Operator `\|\|` di sini berperan sebagai **nilai default**. |
| `primer.volume = 0;` | Membisukan suara (0 = senyap, 1 = penuh) agar pengguna tidak mendengar apa-apa. |
| `primer.play()` | Memutar audio. Mengembalikan **Promise**, yaitu janji hasil yang akan datang (berhasil atau gagal). |
| `.then(() => primer.pause())` | Jika **berhasil** diputar, langsung **jeda**. Tujuannya hanya "memancing" izin dari browser. |
| `.catch(() => {})` | Jika **gagal** (misal file belum ada), tangkap error itu dan diamkan supaya tidak muncul pesan error merah di konsol. |

**Kenapa audio dibisukan lalu dijeda?** Tujuannya hanya membuat browser
menganggap halaman ini "sudah diizinkan memutar audio" berkat interaksi
pengguna. Suaranya sendiri tidak perlu terdengar.

### 1.3 Menyembunyikan overlay

```javascript
    overlay.classList.add("is-hidden");
  });
}
```

`classList.add("is-hidden")` menambahkan class `is-hidden` pada overlay.
Di CSS, class ini membuat overlay memudar (`opacity: 0`) dan tidak bisa
diklik (`pointer-events: none`). **JS hanya menambah class, CSS yang
mengatur tampilannya.**

---

## 2. `setupHoverInteraction()` (baris 177 sampai 236)

Ini fungsi paling penting di project. Ia mengurus semua efek saat tombol
di-hover atau difokus.

### 2.1 Persiapan

```javascript
function setupHoverInteraction() {
  const list = document.getElementById("jobsheetList");
  const activeTitle = document.getElementById("activeTitle");
  if (!list || !activeTitle) return;

  const buttons = list.querySelectorAll(".jobsheet-btn");
```

| Kode | Penjelasan |
|------|-----------|
| `getElementById("jobsheetList")` | Wadah 16 tombol. |
| `getElementById("activeTitle")` | Elemen judul di kanan bawah. |
| `if (!list \|\| !activeTitle) return;` | Pengaman bila salah satu tidak ada. |
| `list.querySelectorAll(".jobsheet-btn")` | Mengambil **semua** elemen berclass `jobsheet-btn` **di dalam** `list`. Hasilnya berupa daftar (NodeList) berisi 16 tombol. Titik `.` di depan nama menandakan pemilihan berdasarkan class. |

**Kenapa dijalankan setelah `renderJobsheetButtons()`?** Karena tombol
baru ada setelah render. Kalau `querySelectorAll` dijalankan sebelum
render, hasilnya daftar kosong. Itulah alasan urutan di bagian init
(bagian 4) sangat penting.

### 2.2 Perulangan untuk setiap tombol

```javascript
  buttons.forEach((btn) => {
    const baseZIndex = btn.style.zIndex;
```

Untuk **setiap tombol**, ambil nilai z-index awalnya dan simpan di
`baseZIndex`. Perlu disimpan karena saat aktif, z-index dinaikkan
sementara, lalu harus **dikembalikan** ke nilai semula saat tidak aktif.

**Konsep penting: closure.** Variabel `baseZIndex`, `activate`, dan
`deactivate` dibuat **terpisah untuk masing-masing tombol**. Setiap
tombol punya salinan `baseZIndex`-nya sendiri. Fungsi di dalam
`forEach` "mengingat" variabel di sekitarnya, disebut closure.

### 2.3 Fungsi `activate()`

```javascript
    function activate() {
      buttons.forEach((other) => {
        if (other !== btn) other.classList.remove("is-active");
      });

      btn.classList.add("is-active");
      btn.style.zIndex = 999;

      activeTitle.textContent = `${btn.dataset.number}-${btn.dataset.title}`;
      activeTitle.classList.add("is-visible");

      if (btn.dataset.sound) {
        const sfx = new Audio(btn.dataset.sound);
        sfx.play().catch(() => {});
      }
    }
```

Diuraikan langkah demi langkah:

**Langkah 1: matikan tombol lain**

```javascript
buttons.forEach((other) => {
  if (other !== btn) other.classList.remove("is-active");
});
```

Melewati semua tombol. Untuk tombol yang **bukan** tombol ini
(`!==` berarti "tidak sama persis dengan"), hapus class `is-active`.
Tujuannya supaya hanya **satu** tombol yang aktif pada satu waktu.
Berguna bila mouse dan keyboard menyorot tombol berbeda.

**Langkah 2: aktifkan tombol ini**

```javascript
btn.classList.add("is-active");
```

Menambah class `is-active`. Efek visualnya (pill jadi oren, foto muncul,
tombol memanjang) semua diatur CSS berdasarkan class ini.

**Langkah 3: naikkan ke depan**

```javascript
btn.style.zIndex = 999;
```

Tombol yang aktif dinaikkan ke z-index tertinggi supaya tampil utuh
walau tadinya sebagian tertutup tombol lain (efek tumpuk).

**Langkah 4: tampilkan judul**

```javascript
activeTitle.textContent = `${btn.dataset.number}-${btn.dataset.title}`;
activeTitle.classList.add("is-visible");
```

| Kode | Penjelasan |
|------|-----------|
| `textContent = ...` | Mengubah **teks** elemen. Hasil misal `01-PENGENALAN HTML`. |
| `btn.dataset.number` | Membaca data `data-number` yang disimpan saat render (Bagian 02). |
| `classList.add("is-visible")` | Membuat judul tampil (di CSS: `opacity: 1`). |

**Perbedaan `textContent` dan `innerHTML`:** `textContent` memperlakukan
isi sebagai **teks biasa** (lebih aman), sedangkan `innerHTML`
memperlakukannya sebagai HTML. Karena hanya butuh teks, dipilih
`textContent`.

**Langkah 5: putar suara**

```javascript
if (btn.dataset.sound) {
  const sfx = new Audio(btn.dataset.sound);
  sfx.play().catch(() => {});
}
```

| Kode | Penjelasan |
|------|-----------|
| `if (btn.dataset.sound)` | Hanya memutar jika tombol punya data suara (tidak kosong). |
| `new Audio(...)` | Membuat objek audio **baru setiap hover**. |
| `.play()` | Memutar suara satu kali. |
| `.catch(() => {})` | Mengabaikan error (file belum ada atau audio diblokir). |

**Kenapa membuat `new Audio` baru tiap hover, bukan memakai satu objek?**
Agar bila pengguna menggerakkan mouse cepat, suara bisa **bertumpuk dan
tetap berbunyi setiap kali**. Kalau satu objek dipakai berulang, suara
yang sedang berjalan bisa terpotong atau tidak berbunyi ulang. Efek
sampingnya: objek Audio menumpuk di memori, namun dibersihkan otomatis
oleh browser setelah selesai diputar.

### 2.4 Fungsi `deactivate()`

```javascript
    function deactivate() {
      btn.classList.remove("is-active");
      btn.style.zIndex = baseZIndex;

      const stillActive = list.querySelector(".jobsheet-btn.is-active");
      if (!stillActive) {
        activeTitle.classList.remove("is-visible");
      }
    }
```

| Kode | Penjelasan |
|------|-----------|
| `classList.remove("is-active")` | Mematikan efek aktif pada tombol ini. |
| `style.zIndex = baseZIndex` | Mengembalikan tumpukan ke nilai awal (yang tadi disimpan). |
| `list.querySelector(".jobsheet-btn.is-active")` | Mencari **satu** tombol yang masih aktif. `querySelector` (tanpa "All") mengembalikan elemen pertama yang cocok, atau `null` bila tidak ada. Selector `.jobsheet-btn.is-active` berarti elemen yang **memiliki kedua class sekaligus**. |
| `if (!stillActive)` | Jika **tidak ada** tombol lain yang aktif, baru sembunyikan judul. |

**Kenapa dicek dulu sebelum menyembunyikan judul?** Bayangkan cursor
berpindah dari tombol 01 ke tombol 02. Urutannya: `mouseleave` di 01
dulu, lalu `mouseenter` di 02. Tanpa pengecekan, judul akan sempat
berkedip hilang lalu muncul lagi. Dengan pengecekan, judul hanya hilang
bila cursor benar-benar keluar dari semua tombol.

### 2.5 Memasang event listener

```javascript
    btn.addEventListener("mouseenter", activate);
    btn.addEventListener("mouseleave", deactivate);

    btn.addEventListener("focus", activate);
    btn.addEventListener("blur", deactivate);
```

| Event | Pemicu | Fungsi |
|-------|--------|--------|
| `mouseenter` | Cursor masuk tombol | `activate` |
| `mouseleave` | Cursor keluar tombol | `deactivate` |
| `focus` | Tombol menerima fokus keyboard (Tab) | `activate` |
| `blur` | Fokus pindah dari tombol | `deactivate` |

**Poin penting:** Nama fungsi ditulis **tanpa tanda kurung** (`activate`,
bukan `activate()`). Kalau memakai kurung, fungsi langsung dijalankan
saat itu juga dan hasilnya yang dipasang. Tanpa kurung, yang dipasang
adalah **fungsinya**, untuk dijalankan nanti saat event terjadi.

**Kenapa mouse dan keyboard memakai fungsi yang sama?** Supaya pengalaman
identik. Pengguna keyboard (Tab) melihat efek yang sama persis dengan
pengguna mouse. Ini prinsip **aksesibilitas**. Kode juga tidak
duplikat.

---

## 3. `setupClickNavigation()` (baris 249 sampai 263)

```javascript
function setupClickNavigation() {
  const list = document.getElementById("jobsheetList");
  if (!list) return;

  const buttons = list.querySelectorAll(".jobsheet-btn");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const target = btn.dataset.link;
      if (target) {
        window.location.href = target;
      }
    });
  });
}
```

| Kode | Penjelasan |
|------|-----------|
| `getElementById` dan `querySelectorAll` | Sama seperti fungsi sebelumnya: mengambil 16 tombol. |
| `addEventListener("click", ...)` | Pasang aksi klik pada tiap tombol. |
| `const target = btn.dataset.link;` | Membaca tujuan link yang disimpan di tombol. |
| `if (target)` | Hanya berpindah bila link ada (tidak kosong). Mencegah pindah ke halaman "undefined". |
| `window.location.href = target;` | **Mengarahkan browser ke alamat baru** di tab yang sama. |

### Tentang `window.location.href`

| Sifat | Penjelasan |
|-------|-----------|
| Bisa relative URL | `"./Jobsheet/Jobsheet-01/index.html"` |
| Bisa absolute URL | `"https://www.example.com"` |
| Membuka di tab yang sama | Sesuai aturan tugas: tidak memakai popup |
| Bisa kembali | Tombol Back browser tetap berfungsi |

**Perbandingan dengan alternatif:**

| Cara | Perilaku |
|------|---------|
| `window.location.href = url` | Pindah di tab yang sama (dipakai project ini) |
| `window.open(url)` | Membuka tab/jendela baru (bisa terblokir popup blocker) |
| `<a href="url">` | Tautan HTML biasa |

### Dukungan keyboard tanpa kode tambahan

Karena elemennya `<button>`, tombol keyboard **Enter** dan **Space**
otomatis memicu event `click`. Jadi pengguna keyboard bisa memilih
jobsheet tanpa perlu kode tambahan.

---

## 4. Inisialisasi `DOMContentLoaded` (baris 268 sampai 273)

```javascript
document.addEventListener("DOMContentLoaded", () => {
  renderJobsheetButtons();
  setupStartOverlay();
  setupHoverInteraction();
  setupClickNavigation();
});
```

| Kode | Penjelasan |
|------|-----------|
| `document.addEventListener("DOMContentLoaded", ...)` | Menunggu sampai seluruh HTML selesai dibaca browser, baru menjalankan isinya. |
| Empat pemanggilan fungsi | Dijalankan **berurutan** dari atas ke bawah. |

### Kenapa urutannya harus seperti itu?

```
1. renderJobsheetButtons()   -> membuat 16 tombol
2. setupStartOverlay()       -> pasang aksi overlay
3. setupHoverInteraction()   -> pasang hover ke 16 tombol
4. setupClickNavigation()    -> pasang klik ke 16 tombol
```

Fungsi nomor 3 dan 4 memakai `querySelectorAll(".jobsheet-btn")`. Kalau
tombol belum dibuat (nomor 1 belum jalan), hasilnya kosong dan
**tidak ada event yang terpasang**. Maka `renderJobsheetButtons()`
**wajib berada paling atas**.

### Kenapa memakai `DOMContentLoaded`?

Sebagai pengaman: kode baru jalan setelah semua elemen HTML siap. Untuk
project ini sebenarnya sudah aman karena script berada di paling bawah
body, tetapi `DOMContentLoaded` tetap praktik yang baik.

**Perbedaan `DOMContentLoaded` dan `load`:**

| Event | Terjadi saat |
|-------|-------------|
| `DOMContentLoaded` | HTML selesai dibaca (tanpa menunggu gambar/CSS selesai) |
| `load` | Semua sumber daya (gambar, CSS, dll.) selesai dimuat |

`DOMContentLoaded` lebih cepat sehingga tombol terpasang lebih awal.

---

## 5. Alur lengkap saat pengguna hover lalu klik

```
Pengguna menggerakkan cursor ke tombol 03
   |
   v
event mouseenter -> activate()
   |-- tombol lain dilepas dari is-active
   |-- tombol 03 diberi class is-active   -> CSS: pill oren, foto muncul
   |-- z-index tombol 03 = 999             -> tampil di depan
   |-- judul "03-JUDUL JOBSHEET 03" tampil
   |-- suara diputar sekali
   |
Pengguna menggeser cursor ke tombol 04
   |
   v
event mouseleave di 03 -> deactivate()
   |-- is-active dilepas, z-index dikembalikan
   |-- masih ada yang aktif? (belum, 04 belum masuk) -> judul disembunyikan
event mouseenter di 04 -> activate()
   |-- judul tampil lagi dengan teks 04
   |
Pengguna mengklik tombol 04
   |
   v
event click -> window.location.href = link tombol 04 -> pindah halaman
```

---

## 6. Soal latihan UTS (Bagian 03)

**Soal 1.** Jelaskan kenapa halaman butuh layar "KLIK UNTUK MULAI" dan
bagaimana kode di `setupStartOverlay` bekerja.

> **Jawaban:** Browser memblokir audio otomatis sampai ada interaksi
> pengguna. Saat tombol diklik, kode membuat objek `Audio` berbisu
> (volume 0), memutarnya lalu langsung menjedanya. Ini membuat browser
> mengizinkan audio untuk sisa sesi. Setelah itu class `is-hidden`
> ditambahkan sehingga overlay memudar.

**Soal 2.** Apa itu Promise? Bagaimana `.then()` dan `.catch()` dipakai
pada `primer.play()`?

> **Jawaban:** Promise adalah objek yang mewakili hasil operasi yang
> selesai di masa depan (berhasil atau gagal). `.then()` dijalankan jika
> berhasil (di sini: menjeda audio), `.catch()` dijalankan jika gagal
> (di sini: mengabaikan error).

**Soal 3.** Apa arti `jobsheets[0]?.sound || ""`?

> **Jawaban:** Mengambil properti `sound` dari elemen pertama array.
> Tanda `?.` (optional chaining) mencegah error bila elemennya tidak
> ada. `|| ""` memberi nilai cadangan berupa string kosong bila hasilnya
> kosong.

**Soal 4.** Apa perbedaan `querySelector` dan `querySelectorAll`?

> **Jawaban:** `querySelector` mengembalikan **satu** elemen pertama yang
> cocok (atau `null`). `querySelectorAll` mengembalikan **semua** elemen
> yang cocok dalam bentuk daftar (NodeList).

**Soal 5.** Kenapa `setupHoverInteraction()` harus dipanggil setelah
`renderJobsheetButtons()`?

> **Jawaban:** Karena tombol baru ada setelah render. Jika hover
> dipasang lebih dulu, `querySelectorAll(".jobsheet-btn")` mengembalikan
> daftar kosong sehingga tidak ada event yang terpasang.

**Soal 6.** Jelaskan perbedaan `mouseenter`/`mouseleave` dengan
`focus`/`blur`. Kenapa keduanya dipasang ke fungsi yang sama?

> **Jawaban:** `mouseenter`/`mouseleave` dipicu pergerakan cursor mouse,
> `focus`/`blur` dipicu fokus keyboard (misal tombol Tab). Keduanya
> memakai `activate` dan `deactivate` yang sama supaya pengguna mouse dan
> keyboard mendapat pengalaman identik (aksesibilitas) tanpa duplikasi
> kode.

**Soal 7.** Kenapa `activate` dipasang tanpa tanda kurung
(`addEventListener("focus", activate)`)?

> **Jawaban:** Karena yang dipasang adalah **fungsinya** untuk
> dijalankan nanti saat event terjadi. Jika ditulis `activate()`, fungsi
> langsung dijalankan saat itu juga dan yang dipasang adalah hasilnya.

**Soal 8.** Untuk apa `baseZIndex` disimpan?

> **Jawaban:** Saat aktif, z-index tombol dinaikkan ke 999 agar tampil di
> depan. Nilai awalnya disimpan di `baseZIndex` supaya bisa
> dikembalikan saat tombol tidak lagi aktif.

**Soal 9.** Kenapa `deactivate` mengecek `stillActive` sebelum
menyembunyikan judul?

> **Jawaban:** Saat cursor berpindah dari satu tombol ke tombol lain,
> `mouseleave` terjadi lebih dulu daripada `mouseenter`. Tanpa
> pengecekan, judul akan sempat hilang lalu muncul lagi (berkedip).
> Dengan pengecekan, judul hanya disembunyikan bila tidak ada tombol
> aktif sama sekali.

**Soal 10.** Apa perbedaan `textContent` dan `innerHTML`?

> **Jawaban:** `textContent` mengubah isi sebagai **teks biasa**
> (lebih aman), sedangkan `innerHTML` memperlakukan isi sebagai
> **markup HTML** yang di-parse menjadi elemen.

**Soal 11.** Kenapa dibuat `new Audio(...)` baru setiap hover?

> **Jawaban:** Agar suara tetap berbunyi setiap kali hover, walau
> pengguna menggerakkan mouse cepat dan suara sebelumnya belum selesai.
> Jika satu objek dipakai berulang, suara bisa terpotong atau tidak
> berbunyi ulang.

**Soal 12.** Apa fungsi `.catch(() => {})` pada `sfx.play()`?

> **Jawaban:** Menangkap dan mengabaikan error saat pemutaran gagal,
> misalnya file suara belum ada atau audio masih diblokir browser, agar
> tidak muncul error di konsol dan program tetap berjalan.

**Soal 13.** Apa itu `window.location.href`? Apa bedanya dengan
`window.open()`?

> **Jawaban:** `window.location.href = url` mengarahkan browser ke alamat
> baru **di tab yang sama**. `window.open(url)` membuka **tab atau
> jendela baru** dan dapat terblokir popup blocker. Project ini memakai
> `location.href` karena aturan tugas melarang popup.

**Soal 14.** Bagaimana pengguna keyboard bisa memilih jobsheet tanpa
mouse?

> **Jawaban:** Menekan Tab untuk berpindah antar tombol (memicu `focus`
> sehingga efek hover muncul), lalu menekan Enter atau Space. Elemen
> `<button>` otomatis memicu event `click` untuk kedua tombol tersebut.

**Soal 15.** Apa itu closure? Di mana muncul dalam kode ini?

> **Jawaban:** Closure adalah fungsi yang "mengingat" variabel di
> lingkup tempat ia dibuat. Di `setupHoverInteraction`, fungsi
> `activate` dan `deactivate` mengingat `btn` dan `baseZIndex` milik
> tombolnya masing-masing, sehingga tiap tombol punya salinan sendiri.

**Soal 16.** Jelaskan perbedaan `DOMContentLoaded` dan `load`.

> **Jawaban:** `DOMContentLoaded` terjadi saat HTML selesai dibaca
> (tanpa menunggu gambar atau CSS). `load` terjadi setelah semua sumber
> daya selesai dimuat. `DOMContentLoaded` lebih cepat sehingga tombol
> terpasang lebih awal.

**Soal 17.** Jelaskan urutan kejadian dari saat cursor masuk tombol 03
sampai halaman berpindah.

> **Jawaban:** `mouseenter` memicu `activate`: tombol lain dilepas dari
> `is-active`, tombol 03 diberi `is-active` (CSS menampilkan pill oren
> dan foto), z-index dinaikkan, judul tampil, suara diputar. Saat klik,
> event `click` memicu `window.location.href` ke `data-link` tombol 03
> sehingga browser pindah halaman.

**Soal 18.** Bagaimana cara menonaktifkan suara hover?

> **Jawaban:** Kosongkan properti `sound` pada data (`sound: ""`).
> Karena ada pengecekan `if (btn.dataset.sound)`, suara tidak diputar
> untuk tombol itu.

**Soal 19.** Apa yang terjadi jika file suara tidak ditemukan?

> **Jawaban:** `sfx.play()` gagal dan menghasilkan Promise ditolak.
> Karena ada `.catch(() => {})`, error diabaikan sehingga halaman tetap
> berjalan normal, hanya tanpa suara.

**Soal 20.** Jika ingin menambah efek suara berbeda untuk tiap tombol,
apa yang diubah?

> **Jawaban:** Cukup ubah properti `sound` di masing-masing object pada
> array `jobsheets` ke file suara berbeda. Kode `activate` sudah membaca
> `btn.dataset.sound` sehingga tidak perlu diubah.

---

*Sebelumnya: Bagian 02 (`main.js` data dan render)*
*Lanjut ke Bagian 04: `style.css` bagian variabel, reset, dan layout*
