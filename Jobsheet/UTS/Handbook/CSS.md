# Handbook CSS Final — Jobsheet 06 Rental Mobil, Dijelaskan Baris demi Baris

## Cara menggunakan handbook ini

Dokumen ini membahas satu stylesheet final proyek revisi, yaitu `Jobsheet-06/assets/css/style.css` dari ZIP proyek rental mobil. File ini berisi **371 nomor baris saat ditampilkan editor yang menghitung baris terakhir tanpa newline akhir**. Jika editor milikmu menghitung berbeda satu baris, perbedaan itu biasanya karena karakter newline di akhir file; isi aturannya tetap sama.

Saya memilih stylesheet Jobsheet 06 karena itu versi terakhir proyek, bukan menggabungkan CSS Jobsheet 02, 03, 04, dan 05 menjadi satu file fiktif. CSS di jobsheet sebelumnya memiliki perbedaan. Handbook ini menjelaskan keseluruhan file final Jobsheet 06 saja.

Tujuan membaca bukan menghafal kode. Bayangkan HTML adalah rangka rumah, CSS adalah cat, jarak, susunan perabot, dan pencahayaan. CSS memilih elemen HTML, kemudian menentukan bagaimana elemen itu terlihat dan ditempatkan.

### Bentuk dasar aturan CSS

```css
.selector {
  property: value;
}
```

- `.selector` disebut **selector**: menentukan elemen mana yang akan diatur. Tanda titik (`.`) berarti nama class.
- `{` membuka sekumpulan aturan, dan `}` menutupnya.
- `property` adalah hal yang diatur, misalnya `color`, `padding`, atau `display`.
- `value` adalah nilai yang diberikan, misalnya `#fff`, `16px`, atau `flex`.
- Titik koma (`;`) memisahkan deklarasi agar browser tahu di mana satu pengaturan selesai.
- Komentar `/* ... */` hanya untuk manusia dan tidak mengubah tampilan.
- Baris kosong hanya memisahkan bagian agar mudah dibaca. Baris kosong tidak menghasilkan tampilan apa pun.

### Bagaimana CSS ini terhubung ke HTML?

HTML memakai class seperti `sidebar`, `main-wrapper`, `topbar`, `card`, `btn`, `stats-grid`, dan `form-group`. CSS mencari nama yang sama. Contoh: HTML `<aside class="sidebar">` cocok dengan selector `.sidebar`. Titik pada CSS tidak ditulis dalam atribut class HTML: di HTML tulis `class="sidebar"`, sedangkan di CSS tulis `.sidebar`.

File HTML memuat stylesheet melalui elemen seperti:

```html
<link rel="stylesheet" href="../assets/css/style.css">
```

Jalur `href` harus sesuai posisi file HTML. Bila CSS tidak muncul, periksa nama file, jalur link, dan apakah class di HTML cocok dengan selector CSS.

### Konvensi penjelasan nomor baris

Nomor baris di bawah mengacu pada `style.css` di dalam ZIP revisi yang dikirim. Setiap baris yang berisi kode atau komentar dijelaskan. Baris kosong sengaja tidak ditulis ulang satu per satu karena semuanya hanya pemisah visual; keberadaannya tidak memengaruhi browser.

---

## Peta besar stylesheet final

1. Baris 1–14: reset umum dan dasar `body`.
2. Baris 16–59: sidebar, brand, dan navigasi.
3. Baris 61–120: area utama, topbar, konten, kartu, dan tombol.
4. Baris 122–257: tabel, badge, dan formulir.
5. Baris 258–286: kartu statistik.
6. Baris 287–371: tombol hamburger dan penyesuaian mobile.

> **Penting:** CSS mengatur tampilan, bukan logika data. CSS dapat menyembunyikan sidebar, tetapi JavaScript yang menambahkan/menghapus class `active` ketika tombol menu digunakan. CSS juga tidak membuat tombol Edit/Hapus menyimpan data; itu memerlukan JavaScript dan biasanya backend/database.

---

## Penjelasan kode menurut urutan file


**Baris 1** — `/* Reset & Styling Dasar */`  
Komentar ini menandai bagian awal file: aturan reset dan gaya global. Tidak menghasilkan tampilan langsung.

### Baris 2 — `* {`

Selector universal. Semua elemen HTML dicocokkan oleh aturan ini, sehingga reset di dalamnya berlaku ke seluruh elemen kecuali ada aturan lain yang menimpa. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 3** — `margin: 0;`  
`margin` mengatur ruang di luar batas elemen, yaitu jarak dengan elemen lain. Nilai `0` menghapus margin bawaan di luar elemen.

**Baris 4** — `padding: 0;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai `0` menghapus padding bawaan di dalam elemen.

**Baris 5** — `box-sizing: border-box;`  
`box-sizing` menentukan cara browser menghitung ukuran elemen (width/height). Nilai `border-box` membuat total lebar/tinggi sudah memasukkan padding dan border, sehingga ukuran komponen lebih mudah dikontrol.

**Baris 6** — `font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;`  
`font-family` menentukan jenis huruf (font). Ini adalah daftar font cadangan. Browser memakai font pertama yang tersedia; `sans-serif` adalah keluarga cadangan terakhir.

**Baris 7** — `}`  
Kurung kurawal penutup rule `*`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 9 — `body {`

Memilih elemen <body>, yaitu wadah utama isi halaman yang tampak di browser. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 10** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`. Karena arah Flexbox default adalah `row`, anak langsung body ditata berjajar mendatar secara default. Pada halaman ini ini mendukung sidebar di samping area utama.

**Baris 11** — `background-color: #f4f6f9;`  
`background-color` menentukan warna latar belakang. Nilainya `#f4f6f9` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 12** — `color: #333;`  
`color` menentukan warna teks. Nilainya `#333` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 13** — `min-height: 100vh;`  
`min-height` menentukan tinggi minimum; elemen boleh lebih tinggi bila isinya membutuhkan. Menjamin area setidaknya setinggi layar browser.

**Baris 14** — `}`  
Kurung kurawal penutup rule `body`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 16** — `/* Sidebar Navigasi */`  
Komentar ini menandai aturan untuk panel navigasi samping.

### Baris 17 — `.sidebar {`

Memilih elemen yang mempunyai class="sidebar". Pada proyek ini itu adalah panel navigasi samping. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 18** — `width: 240px;`  
`width` menentukan lebar elemen. Nilai `240px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 19** — `background-color: #1e293b;`  
`background-color` menentukan warna latar belakang. Nilainya `#1e293b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 20** — `color: #f8fafc;`  
`color` menentukan warna teks. Nilainya `#f8fafc` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 21** — `position: fixed;`  
`position` menentukan metode penempatan elemen dalam layout. Elemen ditempatkan relatif terhadap viewport, tidak ikut bergeser mengikuti aliran konten. Cocok untuk sidebar tetap.

**Baris 22** — `top: 0;`  
`top` menentukan jarak dari sisi atas area acuan untuk elemen yang diposisikan. Nilai `0` berarti properti ini tidak menambahkan nilai/efek, sesuai jenis propertinya. Digabung dengan `position: fixed`, nilai ini menahan sisi sidebar pada tepi viewport.

**Baris 23** — `bottom: 0;`  
`bottom` menentukan jarak dari sisi bawah area acuan untuk elemen yang diposisikan. Nilai `0` berarti properti ini tidak menambahkan nilai/efek, sesuai jenis propertinya. Digabung dengan `position: fixed`, nilai ini menahan sisi sidebar pada tepi viewport.

**Baris 24** — `left: 0;`  
`left` menentukan jarak dari sisi kiri area acuan untuk elemen yang diposisikan. Nilai `0` berarti properti ini tidak menambahkan nilai/efek, sesuai jenis propertinya. Digabung dengan `position: fixed`, nilai ini menahan sisi sidebar pada tepi viewport.

**Baris 25** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`.

**Baris 26** — `flex-direction: column;`  
`flex-direction` mengatur arah susunan anak pada Flexbox. Nilai yang digunakan adalah `column`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 27** — `}`  
Kurung kurawal penutup rule `.sidebar`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 29 — `.sidebar .brand {`

Memilih elemen class brand yang berada di dalam sidebar. Spasi di antara dua selector berarti “keturunan di dalam”, tidak harus anak langsung. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 30** — `padding: 20px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `20px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 31** — `background-color: #0f172a;`  
`background-color` menentukan warna latar belakang. Nilainya `#0f172a` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 32** — `text-align: center;`  
`text-align` mengatur perataan teks secara horizontal di dalam wadah. Nilai yang digunakan adalah `center`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 33** — `}`  
Kurung kurawal penutup rule `.sidebar .brand`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 35 — `.sidebar .brand h2 {`

Memilih setiap elemen h2 di dalam elemen brand yang berada di dalam sidebar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 36** — `font-size: 18px;`  
`font-size` menentukan ukuran huruf. Nilai `18px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 37** — `color: #38bdf8;`  
`color` menentukan warna teks. Nilainya `#38bdf8` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 38** — `}`  
Kurung kurawal penutup rule `.sidebar .brand h2`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 40 — `.sidebar .nav-links {`

Memilih elemen class nav-links di dalam sidebar; biasanya elemen ul yang berisi daftar navigasi. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 41** — `list-style: none;`  
`list-style` mengatur penanda daftar, seperti bullet pada ul. Nilai `none` berarti properti ini tidak menambahkan nilai/efek, sesuai jenis propertinya.

**Baris 42** — `margin-top: 15px;`  
`margin-top` mengatur ruang di luar elemen pada sisi atas. Nilai `15px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 43** — `}`  
Kurung kurawal penutup rule `.sidebar .nav-links`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 45 — `.sidebar .nav-links li a {`

Memilih tautan a yang berada di dalam li, yang berada di dalam daftar nav-links di sidebar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 46** — `display: block;`  
`display` menentukan cara elemen ditata dalam layout. Elemen menjadi blok dan umumnya mengambil satu baris sendiri. Ini membuat tautan dapat memenuhi area klik yang lebar.

**Baris 47** — `padding: 14px 20px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `14px 20px` dibaca sebagai: `14px` untuk atas/bawah, dan `20px` untuk kiri/kanan.

**Baris 48** — `color: #94a3b8;`  
`color` menentukan warna teks. Nilainya `#94a3b8` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 49** — `text-decoration: none;`  
`text-decoration` mengatur dekorasi teks, misalnya garis bawah pada tautan. Menghilangkan garis bawah bawaan tautan.

**Baris 50** — `font-size: 15px;`  
`font-size` menentukan ukuran huruf. Nilai `15px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 51** — `transition: all 0.2s;`  
`transition` menghaluskan perubahan nilai CSS dari keadaan awal ke keadaan baru selama durasi tertentu. Nilai `all 0.2s` menjelaskan apa yang dianimasikan dan berapa lama. `all` berarti setiap properti yang dapat dianimasikan berubah dengan transisi; angka dalam `s` adalah durasi detik.

**Baris 52** — `}`  
Kurung kurawal penutup rule `.sidebar .nav-links li a`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 54** — `.sidebar .nav-links li a:hover,`  
Selector pertama dalam daftar: tautan navigasi ketika pointer berada di atasnya (`:hover`). Koma di akhir berarti selector berikutnya akan berbagi deklarasi warna dan latar yang sama.

### Baris 55 — `.sidebar .nav-links li.active a {`

Selector `.sidebar .nav-links li.active a` melengkapi daftar selector yang dimulai pada baris sebelumnya. Selector sebelumnya diakhiri koma, jadi deklarasi di dalam rule ini diterapkan juga ke selector yang tercantum sebelum `.sidebar .nav-links li.active a`. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 56** — `background-color: #334155;`  
`background-color` menentukan warna latar belakang. Nilainya `#334155` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 57** — `color: #fff;`  
`color` menentukan warna teks. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 58** — `border-left: 4px solid #38bdf8;`  
`border-left` mengatur garis tepi bagian kiri. Nilai `4px solid #38bdf8` mengatur garis sebelah kiri. Pada kartu statistik, garis warna ini menjadi aksen visual.

**Baris 59** — `}`  
Kurung kurawal penutup rule `.sidebar .nav-links li.active a`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 61** — `/* Main Area Wrapper */`  
Komentar ini menandai wadah konten utama yang berada di samping sidebar.

### Baris 62 — `.main-wrapper {`

Memilih wadah utama selain sidebar, yang membungkus topbar serta konten halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 63** — `margin-left: 240px;`  
`margin-left` mengatur ruang di luar elemen pada sisi kiri. Menyisakan ruang 240px di kiri agar konten utama tidak bertumpuk di bawah sidebar selebar 240px. Nilai ini harus sejalan dengan lebar sidebar; bila lebarnya berubah, jarak ini biasanya perlu diperbarui juga.

**Baris 64** — `width: calc(100% - 240px);`  
`width` menentukan lebar elemen. `calc()` menghitung lebar: 100% area induk dikurangi 240px untuk mengimbangi lebar sidebar desktop.

**Baris 65** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`.

**Baris 66** — `flex-direction: column;`  
`flex-direction` mengatur arah susunan anak pada Flexbox. Nilai yang digunakan adalah `column`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 67** — `min-height: 100vh;`  
`min-height` menentukan tinggi minimum; elemen boleh lebih tinggi bila isinya membutuhkan. Menjamin area setidaknya setinggi layar browser.

**Baris 68** — `}`  
Kurung kurawal penutup rule `.main-wrapper`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 70** — `/* Header Topbar */`  
Komentar ini menandai aturan untuk bar bagian atas halaman.

### Baris 71 — `.topbar {`

Memilih bar bagian atas halaman (topbar), tempat judul halaman dan informasi pengguna. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 72** — `background-color: #fff;`  
`background-color` menentukan warna latar belakang. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 73** — `height: 60px;`  
`height` menentukan tinggi elemen. Menentukan tinggi topbar menjadi 60 piksel.

**Baris 74** — `padding: 0 30px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `0 30px` dibaca sebagai: `0` untuk atas/bawah, dan `30px` untuk kiri/kanan.

**Baris 75** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`.

**Baris 76** — `align-items: center;`  
`align-items` mengatur perataan item pada sumbu silang layout Flexbox/Grid. Nilai yang digunakan adalah `center`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 77** — `justify-content: space-between;`  
`justify-content` mengatur distribusi/perataan item pada sumbu utama Flexbox. Nilai yang digunakan adalah `space-between`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 78** — `box-shadow: 0 1px 3px rgba(0,0,0,0.08);`  
`box-shadow` menambahkan bayangan di sekitar elemen. Nilai `0 1px 3px rgba(0,0,0,0.08)` mengatur bayangan. Secara umum urutannya adalah offset horizontal, offset vertikal, blur (kelembutan), lalu warna; nilai `rgba()` membuat bayangan transparan agar lembut.

**Baris 79** — `}`  
Kurung kurawal penutup rule `.topbar`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 81 — `.topbar .title {`

Memilih elemen class title yang berada di dalam topbar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 82** — `font-size: 18px;`  
`font-size` menentukan ukuran huruf. Nilai `18px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 83** — `font-weight: 600;`  
`font-weight` menentukan ketebalan huruf. Nilai `600` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 84** — `color: #1e293b;`  
`color` menentukan warna teks. Nilainya `#1e293b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 85** — `}`  
Kurung kurawal penutup rule `.topbar .title`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 87 — `.topbar .user-info {`

Memilih elemen class user-info di dalam topbar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 88** — `font-size: 14px;`  
`font-size` menentukan ukuran huruf. Nilai `14px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 89** — `color: #64748b;`  
`color` menentukan warna teks. Nilainya `#64748b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 90** — `}`  
Kurung kurawal penutup rule `.topbar .user-info`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 92** — `/* Area Konten Utama */`  
Komentar ini menandai area isi halaman, seperti judul dan kartu.

### Baris 93 — `.content-body {`

Memilih area yang menjadi wadah konten utama halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 94** — `padding: 25px 30px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `25px 30px` dibaca sebagai: `25px` untuk atas/bawah, dan `30px` untuk kiri/kanan.

**Baris 95** — `flex: 1;`  
`flex` mengatur bagaimana item Flexbox membesar atau berbagi ruang. Elemen boleh tumbuh untuk mengambil ruang kosong yang tersisa di wadah Flexbox.

**Baris 96** — `}`  
Kurung kurawal penutup rule `.content-body`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 98 — `.page-title {`

Memilih judul utama halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 99** — `margin-bottom: 20px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `20px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 100** — `font-size: 22px;`  
`font-size` menentukan ukuran huruf. Nilai `22px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 101** — `color: #0f172a;`  
`color` menentukan warna teks. Nilainya `#0f172a` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 102** — `}`  
Kurung kurawal penutup rule `.page-title`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 104** — `/* Card Container */`  
Komentar ini menandai tampilan dasar kartu putih yang membungkus konten.

### Baris 105 — `.card {`

Memilih komponen berbentuk kartu yang membungkus kumpulan konten. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 106** — `background-color: #fff;`  
`background-color` menentukan warna latar belakang. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 107** — `border-radius: 8px;`  
`border-radius` membulatkan sudut elemen. Nilai `8px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 108** — `padding: 24px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `24px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 109** — `box-shadow: 0 2px 6px rgba(0,0,0,0.04);`  
`box-shadow` menambahkan bayangan di sekitar elemen. Nilai `0 2px 6px rgba(0,0,0,0.04)` mengatur bayangan. Secara umum urutannya adalah offset horizontal, offset vertikal, blur (kelembutan), lalu warna; nilai `rgba()` membuat bayangan transparan agar lembut.

**Baris 110** — `margin-bottom: 25px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `25px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 111** — `}`  
Kurung kurawal penutup rule `.card`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 113 — `.card-header {`

Memilih bagian kepala/judul di dalam kartu. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 114** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`.

**Baris 115** — `justify-content: space-between;`  
`justify-content` mengatur distribusi/perataan item pada sumbu utama Flexbox. Nilai yang digunakan adalah `space-between`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 116** — `align-items: center;`  
`align-items` mengatur perataan item pada sumbu silang layout Flexbox/Grid. Nilai yang digunakan adalah `center`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 117** — `margin-bottom: 20px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `20px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 118** — `padding-bottom: 12px;`  
`padding-bottom` mengatur ruang di dalam elemen pada sisi bawah. Nilai `12px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 119** — `border-bottom: 1px solid #f1f5f9;`  
`border-bottom` mengatur garis tepi bagian bawah. Nilai `1px solid #f1f5f9` mengatur ketebalan, jenis, serta warna garis bawah elemen.

**Baris 120** — `}`  
Kurung kurawal penutup rule `.card-header`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 122** — `/* Style Tombol */`  
Komentar ini menjadi pembatas bagian yang mengatur tampilan tombol.

### Baris 123 — `.btn {`

Memilih elemen yang diberi class btn; class dasar bagi tombol atau tautan yang ditampilkan seperti tombol. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 124** — `display: inline-block;`  
`display` menentukan cara elemen ditata dalam layout. Elemen dapat berada sejajar dengan teks/elemen inline tetapi tetap menerima padding yang membuatnya tampak seperti tombol.

**Baris 125** — `padding: 9px 18px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `9px 18px` dibaca sebagai: `9px` untuk atas/bawah, dan `18px` untuk kiri/kanan.

**Baris 126** — `border-radius: 6px;`  
`border-radius` membulatkan sudut elemen. Nilai `6px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 127** — `text-decoration: none;`  
`text-decoration` mengatur dekorasi teks, misalnya garis bawah pada tautan. Menghilangkan garis bawah bawaan tautan.

**Baris 128** — `font-size: 14px;`  
`font-size` menentukan ukuran huruf. Nilai `14px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 129** — `font-weight: 500;`  
`font-weight` menentukan ketebalan huruf. Nilai `500` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 130** — `cursor: pointer;`  
`cursor` menentukan bentuk penunjuk mouse ketika berada di atas elemen. Mengubah kursor menjadi tangan untuk memberi isyarat bahwa item dapat diklik.

**Baris 131** — `border: none;`  
`border` mengatur garis tepi, termasuk ketebalan, jenis, dan warna. `none` menghapus garis tepi; tombol hamburger tidak diberi border bawaan sehingga tampil minimal.

**Baris 132** — `transition: all 0.2s;`  
`transition` menghaluskan perubahan nilai CSS dari keadaan awal ke keadaan baru selama durasi tertentu. Nilai `all 0.2s` menjelaskan apa yang dianimasikan dan berapa lama. `all` berarti setiap properti yang dapat dianimasikan berubah dengan transisi; angka dalam `s` adalah durasi detik.

**Baris 133** — `}`  
Kurung kurawal penutup rule `.btn`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 135 — `.btn-primary {`

Memilih tombol dengan gaya primary, biasanya aksi utama. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 136** — `background-color: #0284c7;`  
`background-color` menentukan warna latar belakang. Nilainya `#0284c7` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 137** — `color: #fff;`  
`color` menentukan warna teks. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 138** — `}`  
Kurung kurawal penutup rule `.btn-primary`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 139 — `.btn-primary:hover {`

Memilih tombol primary ketika pointer mouse berada di atasnya. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 140** — `background-color: #0369a1;`  
`background-color` menentukan warna latar belakang. Nilainya `#0369a1` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 141** — `}`  
Kurung kurawal penutup rule `.btn-primary:hover`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 143 — `.btn-secondary {`

Memilih tombol sekunder, untuk aksi pendamping seperti kembali atau batal. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 144** — `background-color: #64748b;`  
`background-color` menentukan warna latar belakang. Nilainya `#64748b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 145** — `color: #fff;`  
`color` menentukan warna teks. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 146** — `}`  
Kurung kurawal penutup rule `.btn-secondary`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 147 — `.btn-secondary:hover {`

Memilih tombol sekunder ketika pointer mouse berada di atasnya. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 148** — `background-color: #475569;`  
`background-color` menentukan warna latar belakang. Nilainya `#475569` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 149** — `}`  
Kurung kurawal penutup rule `.btn-secondary:hover`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 151 — `.btn-warning {`

Memilih tombol dengan nuansa peringatan, misalnya aksi edit/perubahan. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 152** — `background-color: #f59e0b;`  
`background-color` menentukan warna latar belakang. Nilainya `#f59e0b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 153** — `color: #fff;`  
`color` menentukan warna teks. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 154** — `}`  
Kurung kurawal penutup rule `.btn-warning`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 155 — `.btn-warning:hover {`

Memilih tombol warning ketika pointer mouse berada di atasnya. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 156** — `background-color: #d97706;`  
`background-color` menentukan warna latar belakang. Nilainya `#d97706` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 157** — `}`  
Kurung kurawal penutup rule `.btn-warning:hover`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 159 — `.btn-danger {`

Memilih tombol untuk aksi berisiko seperti hapus. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 160** — `background-color: #ef4444;`  
`background-color` menentukan warna latar belakang. Nilainya `#ef4444` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 161** — `color: #fff;`  
`color` menentukan warna teks. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 162** — `}`  
Kurung kurawal penutup rule `.btn-danger`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 163 — `.btn-danger:hover {`

Memilih tombol danger ketika pointer mouse berada di atasnya. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 164** — `background-color: #dc2626;`  
`background-color` menentukan warna latar belakang. Nilainya `#dc2626` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 165** — `}`  
Kurung kurawal penutup rule `.btn-danger:hover`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 167 — `.btn-sm {`

Memilih tombol versi kecil (small). Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 168** — `padding: 5px 10px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `5px 10px` dibaca sebagai: `5px` untuk atas/bawah, dan `10px` untuk kiri/kanan.

**Baris 169** — `font-size: 12px;`  
`font-size` menentukan ukuran huruf. Nilai `12px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 170** — `}`  
Kurung kurawal penutup rule `.btn-sm`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 172** — `/* Table Styling */`  
Komentar ini menjadi pembatas bagian styling tabel.

### Baris 173 — `table {`

Memilih semua elemen tabel pada halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 174** — `width: 100%;`  
`width` menentukan lebar elemen. Nilai yang digunakan adalah `100%`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 175** — `border-collapse: collapse;`  
`border-collapse` menentukan apakah garis batas antar-sel tabel dipisah atau digabung. Menggabungkan garis batas antar-sel tabel agar tabel tampak lebih bersih.

**Baris 176** — `margin-top: 10px;`  
`margin-top` mengatur ruang di luar elemen pada sisi atas. Nilai `10px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 177** — `}`  
Kurung kurawal penutup rule `table`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 179 — `table th, table td {`

Memilih semua sel header (th) dan sel data (td) di dalam tabel. Keduanya menerima gaya yang sama. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 180** — `padding: 12px 15px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `12px 15px` dibaca sebagai: `12px` untuk atas/bawah, dan `15px` untuk kiri/kanan.

**Baris 181** — `text-align: left;`  
`text-align` mengatur perataan teks secara horizontal di dalam wadah. Nilai yang digunakan adalah `left`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 182** — `border-bottom: 1px solid #f1f5f9;`  
`border-bottom` mengatur garis tepi bagian bawah. Nilai `1px solid #f1f5f9` mengatur ketebalan, jenis, serta warna garis bawah elemen.

**Baris 183** — `font-size: 14px;`  
`font-size` menentukan ukuran huruf. Nilai `14px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 184** — `}`  
Kurung kurawal penutup rule `table th, table td`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 186 — `table th {`

Memilih sel kepala tabel saja, yaitu judul kolom. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 187** — `background-color: #f8fafc;`  
`background-color` menentukan warna latar belakang. Nilainya `#f8fafc` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 188** — `color: #475569;`  
`color` menentukan warna teks. Nilainya `#475569` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 189** — `font-weight: 600;`  
`font-weight` menentukan ketebalan huruf. Nilai `600` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 190** — `}`  
Kurung kurawal penutup rule `table th`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 192 — `table tr:hover {`

Memilih satu baris tabel ketika pointer mouse berada di atas baris itu. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 193** — `background-color: #f8fafc;`  
`background-color` menentukan warna latar belakang. Nilainya `#f8fafc` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 194** — `}`  
Kurung kurawal penutup rule `table tr:hover`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 196** — `/* Badge Status */`  
Komentar ini menandai label status berwarna seperti tersedia atau peringatan.

### Baris 197 — `.badge {`

Memilih label kecil/badge yang biasanya menampilkan status. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 198** — `padding: 4px 8px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `4px 8px` dibaca sebagai: `4px` untuk atas/bawah, dan `8px` untuk kiri/kanan.

**Baris 199** — `border-radius: 4px;`  
`border-radius` membulatkan sudut elemen. Nilai `4px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 200** — `font-size: 12px;`  
`font-size` menentukan ukuran huruf. Nilai `12px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 201** — `font-weight: 600;`  
`font-weight` menentukan ketebalan huruf. Nilai `600` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 202** — `}`  
Kurung kurawal penutup rule `.badge`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 204 — `.badge-success {`

Memilih badge berstatus berhasil/baik, misalnya “Tersedia”. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 205** — `background-color: #dcfce7;`  
`background-color` menentukan warna latar belakang. Nilainya `#dcfce7` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 206** — `color: #166534;`  
`color` menentukan warna teks. Nilainya `#166534` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 207** — `}`  
Kurung kurawal penutup rule `.badge-success`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 209 — `.badge-warning {`

Memilih badge berstatus peringatan, misalnya kondisi yang perlu diperhatikan. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 210** — `background-color: #fef3c7;`  
`background-color` menentukan warna latar belakang. Nilainya `#fef3c7` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 211** — `color: #92400e;`  
`color` menentukan warna teks. Nilainya `#92400e` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 212** — `}`  
Kurung kurawal penutup rule `.badge-warning`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 214** — `/* Form Styles */`  
Komentar ini menandai aturan untuk pembungkus form, label, input, dan tombol form.

### Baris 215 — `.form-container {`

Memilih pembungkus form; aturan ini membatasi lebar maksimum form. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 216** — `max-width: 650px;`  
`max-width` menentukan lebar maksimum elemen. Nilai `650px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 217** — `}`  
Kurung kurawal penutup rule `.form-container`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 219 — `.form-group {`

Memilih satu kelompok kolom pada form, biasanya label bersama inputnya. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 220** — `margin-bottom: 18px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `18px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 221** — `}`  
Kurung kurawal penutup rule `.form-group`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 223 — `.form-group label {`

Memilih label yang berada dalam form-group. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 224** — `display: block;`  
`display` menentukan cara elemen ditata dalam layout. Elemen menjadi blok dan umumnya mengambil satu baris sendiri. Ini membuat tautan dapat memenuhi area klik yang lebar.

**Baris 225** — `margin-bottom: 6px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `6px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 226** — `font-size: 14px;`  
`font-size` menentukan ukuran huruf. Nilai `14px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 227** — `font-weight: 500;`  
`font-weight` menentukan ketebalan huruf. Nilai `500` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 228** — `color: #334155;`  
`color` menentukan warna teks. Nilainya `#334155` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 229** — `}`  
Kurung kurawal penutup rule `.form-group label`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 231** — `.form-group input,`  
Selector pertama dalam daftar elemen form yang akan diberi gaya dasar bersama. Koma menandai bahwa select dan textarea pada baris berikutnya ikut memakai deklarasi yang sama.

**Baris 232** — `.form-group select,`  
Selector kedua dalam daftar elemen form yang akan diberi gaya dasar bersama. Karena diakhiri koma, daftar selector belum selesai.

### Baris 233 — `.form-group textarea {`

Selector `.form-group textarea` melengkapi daftar selector yang dimulai pada baris sebelumnya. Selector sebelumnya diakhiri koma, jadi deklarasi di dalam rule ini diterapkan juga ke selector yang tercantum sebelum `.form-group textarea`. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 234** — `width: 100%;`  
`width` menentukan lebar elemen. Nilai yang digunakan adalah `100%`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 235** — `padding: 10px 14px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `10px 14px` dibaca sebagai: `10px` untuk atas/bawah, dan `14px` untuk kiri/kanan.

**Baris 236** — `border: 1px solid #cbd5e1;`  
`border` mengatur garis tepi, termasuk ketebalan, jenis, dan warna. Nilai `1px solid #cbd5e1` menggabungkan tiga bagian yang umum: ketebalan garis, jenis garis (`solid` berarti garis utuh), dan warna.

**Baris 237** — `border-radius: 6px;`  
`border-radius` membulatkan sudut elemen. Nilai `6px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 238** — `font-size: 14px;`  
`font-size` menentukan ukuran huruf. Nilai `14px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 239** — `outline: none;`  
`outline` mengatur garis fokus di luar border; outline tidak mengambil ruang layout seperti border. Menghapus outline fokus bawaan browser. Karena itu kode menambahkan indikator fokus sendiri melalui `box-shadow` pada aturan `:focus` agar fokus tetap terlihat.

**Baris 240** — `background-color: #fff;`  
`background-color` menentukan warna latar belakang. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 241** — `transition: border-color 0.2s, box-shadow 0.2s;`  
`transition` menghaluskan perubahan nilai CSS dari keadaan awal ke keadaan baru selama durasi tertentu. Nilai `border-color 0.2s, box-shadow 0.2s` menjelaskan apa yang dianimasikan dan berapa lama. `all` berarti setiap properti yang dapat dianimasikan berubah dengan transisi; angka dalam `s` adalah durasi detik.

**Baris 242** — `}`  
Kurung kurawal penutup rule `.form-group textarea`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 244** — `.form-group input:focus,`  
Selector pertama dari daftar kontrol form dalam keadaan fokus. Koma berarti aturan yang sama juga akan dipakai oleh select dan textarea ketika fokus.

**Baris 245** — `.form-group select:focus,`  
Selector kedua dari daftar kontrol form dalam keadaan fokus. Selector ini juga berbagi deklarasi dengan input dan textarea.

### Baris 246 — `.form-group textarea:focus {`

Selector `.form-group textarea:focus` melengkapi daftar selector yang dimulai pada baris sebelumnya. Selector sebelumnya diakhiri koma, jadi deklarasi di dalam rule ini diterapkan juga ke selector yang tercantum sebelum `.form-group textarea:focus`. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 247** — `border-color: #0284c7;`  
`border-color` menentukan warna garis tepi. Nilainya `#0284c7` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 248** — `box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);`  
`box-shadow` menambahkan bayangan di sekitar elemen. Nilai `0 0 0 3px rgba(2, 132, 199, 0.15)` mengatur bayangan. Secara umum urutannya adalah offset horizontal, offset vertikal, blur (kelembutan), lalu warna; nilai `rgba()` membuat bayangan transparan agar lembut.

**Baris 249** — `}`  
Kurung kurawal penutup rule `.form-group textarea:focus`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 251 — `.form-actions {`

Memilih wadah tombol-tombol tindakan yang biasanya diletakkan di bawah form. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 252** — `display: flex;`  
`display` menentukan cara elemen ditata dalam layout. Wadah menjadi Flexbox, sehingga anak langsungnya dapat disejajarkan dengan `align-items`, `justify-content`, dan arah dari `flex-direction`.

**Baris 253** — `gap: 10px;`  
`gap` mengatur jarak antar-item dalam layout Flexbox/Grid. Nilai `10px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 254** — `margin-top: 24px;`  
`margin-top` mengatur ruang di luar elemen pada sisi atas. Nilai `24px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 255** — `padding-top: 15px;`  
`padding-top` mengatur ruang di dalam elemen pada sisi atas. Nilai `15px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 256** — `border-top: 1px solid #f1f5f9;`  
`border-top` mengatur properti CSS `border-top` Nilai `1px solid #f1f5f9` menetapkan ketebalan, gaya garis, dan warna garis sekaligus.

**Baris 257** — `}`  
Kurung kurawal penutup rule `.form-actions`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 258** — `/* Styling Kartu Ringkasan Data (Stats Grid) */`  
Komentar ini menandai aturan layout dan tipografi kartu statistik dashboard.

### Baris 259 — `.stats-grid {`

Memilih wadah grid untuk kartu-kartu statistik. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 260** — `display: grid;`  
`display` menentukan cara elemen ditata dalam layout. Nilai yang digunakan adalah `grid`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 261** — `grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));`  
`grid-template-columns` menentukan pola dan jumlah/ukuran kolom pada CSS Grid. Browser membuat kolom dengan lebar minimum 220px. `auto-fit` mencoba menampung kolom sebanyak yang muat dan `1fr` membagi sisa ruang.

**Baris 262** — `gap: 20px;`  
`gap` mengatur jarak antar-item dalam layout Flexbox/Grid. Nilai `20px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 263** — `margin-bottom: 25px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `25px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 264** — `}`  
Kurung kurawal penutup rule `.stats-grid`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 266 — `.stat-card {`

Memilih sebuah kartu statistik. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 267** — `background-color: #fff;`  
`background-color` menentukan warna latar belakang. Nilainya `#fff` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 268** — `padding: 20px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `20px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 269** — `border-radius: 8px;`  
`border-radius` membulatkan sudut elemen. Nilai `8px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 270** — `box-shadow: 0 2px 6px rgba(0,0,0,0.04);`  
`box-shadow` menambahkan bayangan di sekitar elemen. Nilai `0 2px 6px rgba(0,0,0,0.04)` mengatur bayangan. Secara umum urutannya adalah offset horizontal, offset vertikal, blur (kelembutan), lalu warna; nilai `rgba()` membuat bayangan transparan agar lembut.

**Baris 271** — `border-left: 4px solid #0284c7;`  
`border-left` mengatur garis tepi bagian kiri. Nilai `4px solid #0284c7` mengatur garis sebelah kiri. Pada kartu statistik, garis warna ini menjadi aksen visual.

**Baris 272** — `}`  
Kurung kurawal penutup rule `.stat-card`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 274 — `.stat-info h3 {`

Memilih judul h3 di dalam wadah class stat-info. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 275** — `font-size: 13px;`  
`font-size` menentukan ukuran huruf. Nilai `13px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 276** — `color: #64748b;`  
`color` menentukan warna teks. Nilainya `#64748b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 277** — `text-transform: uppercase;`  
`text-transform` mengubah tampilan huruf, misalnya menjadi kapital; isi teks asli tidak berubah. Label ditampilkan sebagai huruf kapital; isi teks HTML aslinya tidak diubah.

**Baris 278** — `letter-spacing: 0.5px;`  
`letter-spacing` mengatur jarak antarhuruf. Nilai `0.5px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 279** — `margin-bottom: 8px;`  
`margin-bottom` mengatur ruang di luar elemen pada sisi bawah. Nilai `8px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 280** — `}`  
Kurung kurawal penutup rule `.stat-info h3`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 282 — `.stat-info .stat-value {`

Memilih nilai angka statistik di dalam stat-info. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 283** — `font-size: 28px;`  
`font-size` menentukan ukuran huruf. Nilai `28px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 284** — `font-weight: 700;`  
`font-weight` menentukan ketebalan huruf. Nilai `700` merupakan angka ketebalan font: 400 biasanya normal, 500 medium, 600 semi-bold, dan 700 bold jika keluarga font mendukung bobot tersebut.

**Baris 285** — `color: #0f172a;`  
`color` menentukan warna teks. Nilainya `#0f172a` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 286** — `}`  
Kurung kurawal penutup rule `.stat-info .stat-value`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 287** — `/* ==========================================`  
Komentar dekoratif ini membuka komentar multi-baris untuk memberi label bagian responsive mobile. Teks ini tidak dijalankan oleh browser.

**Baris 288** — `RESPONSIVE MOBILE STYLES (HP & TABLET)`  
Ini adalah teks judul di dalam komentar yang dibuka pada baris 287. Artinya bagian berikut membahas gaya mobile/ponsel dan tablet; teksnya bukan selector atau deklarasi CSS.

**Baris 289** — `========================================== */`  
Garis hias ini sekaligus menutup komentar multi-baris dengan `*/`; browser mengabaikan seluruh banner baris 287–289.

**Baris 291** — `/* Tombol Toggle Hamburger Sidebar */`  
Komentar ini menjelaskan bahwa rule berikutnya menyiapkan tombol hamburger untuk membuka/menutup sidebar.

### Baris 292 — `.menu-toggle {`

Memilih kontrol tombol untuk membuka/menutup sidebar pada tampilan kecil. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 293** — `display: none;`  
`display` menentukan cara elemen ditata dalam layout. Elemen tidak terlihat dan tidak mengambil ruang pada layout. Pada `.menu-toggle`, artinya tombol disembunyikan di desktop. Di luar media query tombol tidak tampil; aturan media query pada baris sekitar 306 mengubahnya menjadi `display: block` pada layar kecil.

**Baris 294** — `background: none;`  
`background` menentukan latar belakang; nilai dapat berupa warna atau gambar dan opsi latar lainnya. Nilai `none` berarti properti ini tidak menambahkan nilai/efek, sesuai jenis propertinya.

**Baris 295** — `border: none;`  
`border` mengatur garis tepi, termasuk ketebalan, jenis, dan warna. `none` menghapus garis tepi; tombol hamburger tidak diberi border bawaan sehingga tampil minimal.

**Baris 296** — `font-size: 24px;`  
`font-size` menentukan ukuran huruf. Nilai `24px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 297** — `cursor: pointer;`  
`cursor` menentukan bentuk penunjuk mouse ketika berada di atas elemen. Mengubah kursor menjadi tangan untuk memberi isyarat bahwa item dapat diklik.

**Baris 298** — `color: #1e293b;`  
`color` menentukan warna teks. Nilainya `#1e293b` adalah warna hexadecimal. Kode ini menentukan warna yang dipakai pada bagian tersebut.

**Baris 299** — `padding: 5px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `5px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 300** — `}`  
Kurung kurawal penutup rule `.menu-toggle`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 302** — `/* Media Query untuk Layar < 768px (Smartphone) */`  
Komentar ini menjelaskan bahwa aturan berikutnya berlaku pada layar dengan lebar maksimum 768px. Perhatikan, komentarnya menyebut smartphone, tetapi 768px dapat mencakup tablet kecil juga.

### Baris 303 — `@media screen and (max-width: 768px) {`

Aturan media query: blok di dalamnya hanya aktif saat kondisi media terpenuhi. `screen` berarti layar; `(max-width: 768px)` berarti lebar viewport 768 CSS px atau kurang. Kondisi berlaku untuk semua rule yang berada di dalam kurung kurawal media query ini.


**Baris 305** — `/* Show Toggle Button */`  
Komentar pengingat: pada ukuran layar kecil, tombol toggle harus ditampilkan.

### Baris 306 — `.menu-toggle {`

Memilih kontrol tombol untuk membuka/menutup sidebar pada tampilan kecil. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 307** — `display: block;`  
`display` menentukan cara elemen ditata dalam layout. Elemen menjadi blok dan umumnya mengambil satu baris sendiri. Ini membuat tautan dapat memenuhi area klik yang lebar. Di luar media query tombol tidak tampil; aturan media query pada baris sekitar 306 mengubahnya menjadi `display: block` pada layar kecil.

**Baris 308** — `}`  
Kurung kurawal penutup rule `.menu-toggle`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 310** — `/* Sidebar disembunyikan ke kiri luar layar */`  
Komentar ini menjelaskan teknik menyembunyikan sidebar dengan menggesernya keluar layar, bukan menghapusnya dari DOM.

### Baris 311 — `.sidebar {`

Memilih elemen yang mempunyai class="sidebar". Pada proyek ini itu adalah panel navigasi samping. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 312** — `width: 250px;`  
`width` menentukan lebar elemen. Nilai `250px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 313** — `transform: translateX(-100%);`  
`transform` menerapkan transformasi visual seperti pergeseran, rotasi, atau skala tanpa mengubah alur normal dokumen. Sidebar digeser ke kiri sejauh 100% lebar sidebar sendiri, sehingga berada di luar layar.

**Baris 314** — `transition: transform 0.3s ease-in-out;`  
`transition` menghaluskan perubahan nilai CSS dari keadaan awal ke keadaan baru selama durasi tertentu. Nilai `transform 0.3s ease-in-out` menjelaskan apa yang dianimasikan dan berapa lama. `all` berarti setiap properti yang dapat dianimasikan berubah dengan transisi; angka dalam `s` adalah durasi detik.

**Baris 315** — `z-index: 1000;`  
`z-index` mengatur urutan tumpukan elemen yang diposisikan; angka lebih besar umumnya tampil di depan angka lebih kecil. Memberi urutan tumpukan tinggi agar sidebar mobile berada di depan konten lain. Efektivitasnya juga dipengaruhi positioning dan konteks tumpukan.

**Baris 316** — `box-shadow: 4px 0 10px rgba(0,0,0,0.1);`  
`box-shadow` menambahkan bayangan di sekitar elemen. Nilai `4px 0 10px rgba(0,0,0,0.1)` mengatur bayangan. Secara umum urutannya adalah offset horizontal, offset vertikal, blur (kelembutan), lalu warna; nilai `rgba()` membuat bayangan transparan agar lembut.

**Baris 317** — `}`  
Kurung kurawal penutup rule `.sidebar`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 319** — `/* Class aktif saat tombol menu ditekan */`  
Komentar ini menerangkan bahwa class `active` adalah penanda keadaan sidebar terbuka; JavaScript harus mengubah class tersebut.

### Baris 320 — `.sidebar.active {`

Memilih sidebar yang mempunyai dua class sekaligus: sidebar dan active. Class active ditambahkan/dihapus oleh JavaScript untuk memindah sidebar masuk/keluar layar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 321** — `transform: translateX(0);`  
`transform` menerapkan transformasi visual seperti pergeseran, rotasi, atau skala tanpa mengubah alur normal dokumen. Tidak ada pergeseran horizontal; sidebar kembali ke posisi normal yang terlihat. Aturan ini hanya berlaku setelah JavaScript menambahkan class `active` ke sidebar.

**Baris 322** — `}`  
Kurung kurawal penutup rule `.sidebar.active`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 324** — `/* Topbar & Main Wrapper penyesuaian margin */`  
Komentar ini menandai perbaikan layout topbar/wadah utama di layar kecil agar tidak menyisakan ruang sidebar di kiri.

### Baris 325 — `.main-wrapper {`

Memilih wadah utama selain sidebar, yang membungkus topbar serta konten halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 326** — `margin-left: 0 !important;`  
`margin-left` mengatur ruang di luar elemen pada sisi kiri. Nilai yang digunakan adalah `0 !important`; artinya mengikuti jenis properti CSS yang dijelaskan di atas. Nilai ini harus sejalan dengan lebar sidebar; bila lebarnya berubah, jarak ini biasanya perlu diperbarui juga.

**Baris 327** — `width: 100% !important;`  
`width` menentukan lebar elemen. Nilai yang digunakan adalah `100% !important`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 328** — `}`  
Kurung kurawal penutup rule `.main-wrapper`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 330 — `.topbar {`

Memilih bar bagian atas halaman (topbar), tempat judul halaman dan informasi pengguna. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 331** — `padding: 0 15px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai dua bagian `0 15px` dibaca sebagai: `0` untuk atas/bawah, dan `15px` untuk kiri/kanan.

**Baris 332** — `}`  
Kurung kurawal penutup rule `.topbar`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 334 — `.topbar .title {`

Memilih elemen class title yang berada di dalam topbar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 335** — `font-size: 15px;`  
`font-size` menentukan ukuran huruf. Nilai `15px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 336** — `}`  
Kurung kurawal penutup rule `.topbar .title`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 338 — `.topbar .user-info {`

Memilih elemen class user-info di dalam topbar. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 339** — `display: none; /* Sembunyikan pesan user info di HP */`  
`display` menentukan cara elemen ditata dalam layout. Elemen tidak terlihat dan tidak mengambil ruang pada layout. Pada `.menu-toggle`, artinya tombol disembunyikan di desktop. Komentar pada baris yang sama menjelaskan: Sembunyikan pesan user info di HP

**Baris 340** — `}`  
Kurung kurawal penutup rule `.topbar .user-info`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 342 — `.content-body {`

Memilih area yang menjadi wadah konten utama halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 343** — `padding: 15px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `15px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 344** — `}`  
Kurung kurawal penutup rule `.content-body`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 346** — `/* Responsive Cards Grid */`  
Komentar ini menandai perubahan susunan kartu statistik di mobile.

### Baris 347 — `.stats-grid {`

Memilih wadah grid untuk kartu-kartu statistik. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 348** — `grid-template-columns: 1fr; /* Jadi 1 kolom bertumpuk di HP */`  
`grid-template-columns` menentukan pola dan jumlah/ukuran kolom pada CSS Grid. Grid diubah menjadi satu kolom selebar ruang yang tersedia; kartu akan tersusun vertikal. Komentar pada baris yang sama menjelaskan: Jadi 1 kolom bertumpuk di HP

**Baris 349** — `gap: 12px;`  
`gap` mengatur jarak antar-item dalam layout Flexbox/Grid. Nilai `12px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS.

**Baris 350** — `}`  
Kurung kurawal penutup rule `.stats-grid`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 352** — `/* Responsive Table Scroll Horizontal */`  
Komentar ini menandai strategi menjaga tabel lebar dengan scroll horizontal.

### Baris 353 — `.card {`

Memilih komponen berbentuk kartu yang membungkus kumpulan konten. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 354** — `padding: 15px;`  
`padding` mengatur ruang di dalam batas elemen, yaitu jarak antara isi dan tepi elemen. Nilai satu bagian `15px` berlaku untuk keempat sisi: atas, kanan, bawah, dan kiri.

**Baris 355** — `overflow-x: auto; /* Memungkinkan tabel di-scroll ke samping jika lebar */`  
`overflow-x` mengatur apa yang terjadi bila isi elemen melampaui lebar horizontalnya. Jika isi lebih lebar dari kartu, browser memungkinkan scroll horizontal. Ini membantu tabel lebar pada layar kecil. Komentar pada baris yang sama menjelaskan: Memungkinkan tabel di-scroll ke samping jika lebar

**Baris 356** — `}`  
Kurung kurawal penutup rule `.card`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 358 — `table {`

Memilih semua elemen tabel pada halaman. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 359** — `min-width: 550px; /* Menjaga ukuran minimum tabel agar tidak gepeng */`  
`min-width` mengatur properti CSS `min-width` Nilai `550px` memakai satuan piksel CSS: nilai angka menentukan ukuran/jarak dalam piksel CSS. Komentar pada baris yang sama menjelaskan: Menjaga ukuran minimum tabel agar tidak gepeng

**Baris 360** — `}`  
Kurung kurawal penutup rule `table`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 362** — `/* Responsive Form */`  
Komentar ini menandai aturan untuk tombol-tombol aksi pada form saat ruang layar sempit.

### Baris 363 — `.form-actions {`

Memilih wadah tombol-tombol tindakan yang biasanya diletakkan di bawah form. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 364** — `flex-direction: column;`  
`flex-direction` mengatur arah susunan anak pada Flexbox. Nilai yang digunakan adalah `column`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 365** — `}`  
Kurung kurawal penutup rule `.form-actions`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

### Baris 367 — `.form-actions .btn {`

Memilih tombol (class btn) yang berada di dalam wadah form-actions. Kurung kurawal `{` membuka rule; seluruh deklarasi berikutnya berlaku pada selector ini sampai `}`.


**Baris 368** — `width: 100%;`  
`width` menentukan lebar elemen. Nilai yang digunakan adalah `100%`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 369** — `text-align: center;`  
`text-align` mengatur perataan teks secara horizontal di dalam wadah. Nilai yang digunakan adalah `center`; artinya mengikuti jenis properti CSS yang dijelaskan di atas.

**Baris 370** — `}`  
Kurung kurawal penutup rule `.form-actions .btn`. Deklarasi sesudahnya tidak lagi menjadi bagian dari selector tersebut.

**Baris 371** — `}`  
Kurung kurawal ini menutup blok `@media`. Setelah titik ini, aturan kembali berlaku normal di luar kondisi media tersebut.



---

## Pelajaran penting setelah membaca seluruh baris

### A. Selector: bagaimana CSS memilih elemen

| Bentuk | Arti | Contoh dari file |
|---|---|---|
| `*` | Semua elemen | Reset global pada baris 2 |
| `body` / `table` | Nama tag HTML | Baris 9 dan 173 |
| `.sidebar` | Elemen yang memiliki class `sidebar` | Baris 17 |
| `.sidebar .brand h2` | `h2` keturunan di dalam `.brand` di dalam `.sidebar` | Baris 35 |
| `.btn-primary:hover` | Tombol primary saat pointer berada di atasnya | Baris 139 |
| `.sidebar.active` | Satu elemen yang memiliki kedua class: `sidebar` dan `active` | Baris 320 |
| `input, select, textarea` | Beberapa selector mendapat aturan yang sama | Baris 231–233 dan 244–246 |
| `:focus` | Keadaan elemen ketika menerima fokus | Baris 244–249 |
| `:hover` | Keadaan saat pointer berada di atas elemen | Baris 54 dan 192 |
| `@media ...` | Aturan yang hanya aktif ketika kondisi layar terpenuhi | Baris 303–371 |

**Perbedaan penting:** `.sidebar.active` bukan berarti “sidebar di dalam active”. Tanpa spasi, dua class tersebut harus berada pada elemen yang sama. Sebaliknya, `.sidebar .brand` memakai spasi, sehingga `brand` adalah keturunan dari `sidebar`.

### B. Satuan CSS yang digunakan

- `px`: piksel CSS. Dipakai untuk padding, lebar sidebar, ukuran teks, dan border.
- `%`: ukuran relatif terhadap area induk yang relevan. Misalnya `width: 100%` membuat komponen mengambil lebar penuh wadahnya.
- `vh`: persentase tinggi viewport. `100vh` berarti satu tinggi layar browser.
- `fr`: satu bagian dari ruang tersisa pada Grid. `1fr 1fr` membagi ruang menjadi dua bagian sama besar.
- `s`: detik, digunakan untuk durasi transisi seperti `0.2s`.
- `rgba(r, g, b, a)`: warna dengan transparansi. `a`/alpha bernilai antara 0 (transparan penuh) dan 1 (opak penuh).
- `calc(...)`: memungkinkan browser menghitung kombinasi ukuran, contohnya `100% - 240px`.
- `minmax(min, max)`: fungsi Grid untuk mendefinisikan rentang ukuran track.
- `auto-fit`: Grid mencoba menyesuaikan jumlah kolom yang muat dengan lebar wadah.

### C. Mengapa reset di baris 2–7 penting?

Browser mempunyai gaya bawaan, misalnya margin pada body dan heading. Reset membuat awal tampilan lebih mudah diprediksi. `box-sizing: border-box` juga membantu: jika sebuah elemen memiliki lebar 240px dengan padding 20px dan border, ukuran totalnya tetap dihitung di dalam 240px, bukan melebar menjadi 280px atau lebih.

Reset universal ini turut menetapkan `font-family` untuk semua elemen. Karena itu, aturan tersebut berlaku pada heading, tombol, input, tabel, dan lainnya, kecuali diubah oleh deklarasi yang lebih spesifik atau berada lebih akhir dalam cascade.

### D. Mengapa sidebar perlu diimbangi `margin-left`?

Pada desktop, `.sidebar` memakai `position: fixed` sehingga keluar dari alur normal halaman dan menempel di sisi kiri layar. Karena sidebar tidak otomatis memakan tempat di alur konten, `.main-wrapper` diberi margin kiri 240px dan lebar `calc(100% - 240px)`. Tanpa kompensasi itu, konten bisa dimulai dari x=0 dan tertutup oleh sidebar.

Pada mobile, media query mengubah margin kiri menjadi `0 !important` dan lebar menjadi `100% !important`. Ini membuat konten menggunakan seluruh lebar layar karena sidebar akan disembunyikan ke sisi kiri.

### E. Alur buka/tutup sidebar mobile

1. Di luar media query, `.menu-toggle { display: none; }` menyembunyikan tombol menu di desktop.
2. Ketika lebar viewport 768px atau kurang, media query mengubahnya menjadi `display: block`.
3. Pada ukuran itu sidebar menerima `transform: translateX(-100%)`, artinya digeser ke kiri sejauh lebar sidebar dan tidak terlihat.
4. JavaScript menambahkan class `active` ketika tombol diklik.
5. Selector `.sidebar.active` menerapkan `transform: translateX(0)`, sehingga sidebar kembali ke posisi terlihat.
6. `transition: transform 0.3s ease-in-out` menghaluskan perpindahan itu.

Jika tombol hamburger terlihat tetapi sidebar tidak muncul, periksa apakah JavaScript betul-betul menambahkan class `active` ke elemen sidebar. CSS sendirian tidak mendeteksi klik tombol pada file ini.

### F. Aturan responsif hanya mengalahkan aturan lama dalam kondisi tertentu

CSS tidak menghapus aturan desktop; media query menambahkan/menimpa aturan saat viewport memenuhi kondisi. Misalnya `.stats-grid` di luar media query punya pola `repeat(auto-fit, minmax(220px, 1fr))`; di dalam media query menjadi `1fr`, sehingga pada ponsel semua kartu bertumpuk satu kolom.

Deklarasi `!important` pada `margin-left` dan `width` di `.main-wrapper` memberi prioritas lebih tinggi dibanding deklarasi biasa. Biasanya lebih baik memakai selector/cascade yang rapi, tetapi pada stylesheet ini `!important` memastikan override mobile menang terhadap gaya sebelumnya.

### G. Strategi tabel responsif

Tabel tetap memiliki `min-width: 550px` pada mobile. Ini bukan berarti halaman gagal responsif. Tujuannya mencegah kolom dipaksa terlalu kecil. `.card` diberi `overflow-x: auto` sehingga wadah kartu bisa digeser mendatar ketika isi tabel lebih lebar daripada layar.

Satu hal yang perlu dipahami: `overflow-x: auto` ditempel pada `.card`, bukan `.table-responsive`. Artinya scroll horizontal ditangani oleh kartu. Ini bekerja untuk struktur HTML yang tabelnya berada di dalam kartu, seperti pada halaman daftar. Jika struktur HTML berubah, aturan ini perlu diuji lagi.

### H. Aksesibilitas dan detail kualitas kode

- Efek hover bagus sebagai petunjuk visual, tetapi jangan menjadikan hover sebagai satu-satunya cara menandai kontrol penting karena layar sentuh tidak mempunyai hover yang sama seperti mouse.
- Rule `.form-group ...:focus` memberi sorotan fokus agar pengguna tahu kolom yang sedang dipilih. `outline: none` dipakai di kontrol form, tetapi adanya `box-shadow` pengganti penting agar petunjuk fokus tetap terlihat.
- Rule `.badge` belum menyetel `display: inline-block`; bentuk badge bergantung pada elemen HTML yang digunakan. Bila badge berada pada elemen inline seperti `span`, padding vertikal kadang tidak memengaruhi tinggi baris seperti pada blok; pilihan ini tidak serta merta salah, tetapi bisa disempurnakan jika tampilannya perlu konsisten.
- Transisi `all` pada tombol mudah ditulis, tetapi dapat menganimasikan lebih banyak properti daripada yang dibutuhkan. Dalam kode yang lebih ketat, transisikan hanya properti yang benar-benar berubah, misalnya `background-color`.
- Teks status pada badge tetap perlu ditulis, jangan hanya membedakan status melalui warna saja.

### I. Mengapa CSS desktop dan mobile harus dibaca bersama?

Aturan desktop memberi bentuk default. Media query mengubah beberapa properti saat layar sempit, bukan membuat website mobile secara terpisah. Untuk memahami hasil akhir, bayangkan browser menerapkan semua aturan yang cocok sekaligus, lalu memilih aturan yang menang berdasarkan cascade, spesifisitas selector, urutan deklarasi, dan `!important`.

### J. Cara menguji setiap bagian

1. Buka proyek melalui server lokal jika juga hendak menguji JavaScript; untuk CSS saja, halaman tetap dapat dilihat dari browser tetapi server lokal lebih konsisten.
2. Periksa desktop sekitar 1366px: sidebar tetap di kiri, topbar di sampingnya, konten memiliki ruang 240px untuk sidebar, kartu statistik dapat berjajar sesuai ruang.
3. Ubah viewport menjadi 768px atau lebih kecil: tombol menu terlihat, sidebar bergeser keluar layar, dan main wrapper melebar.
4. Klik tombol hamburger: pastikan JS menambah/menghapus `active` dan transisi terlihat.
5. Ubah viewport ke sekitar 390px: kartu statistik menjadi satu kolom, topbar menyusut, info user tersembunyi, dan aksi form menjadi vertikal.
6. Pada tabel mobil/pelanggan, geser kartu ke kiri-kanan dan pastikan kolom tidak menimpa satu sama lain.
7. Pada halaman tambah, klik ke setiap input dan perhatikan border/box-shadow saat fokus.
8. Hover tombol dan item navigasi dengan mouse untuk melihat perubahan warna.

### K. Jika tampilan tidak sesuai, cari berdasarkan gejala

| Gejala | Periksa |
|---|---|
| Semua elemen tampak tanpa styling | Jalur `<link rel="stylesheet">`, nama `style.css`, dan lokasi folder `assets/css/`. |
| Konten utama tertutup sidebar desktop | `width` sidebar (240px) dan `margin-left` main-wrapper (240px). |
| Sidebar tidak muncul di mobile | JavaScript, class `active`, selector `.sidebar.active`, dan kondisi media query. |
| Tombol hamburger tidak terlihat di desktop/mobile sesuai harapan | `display: none` di rule awal dan `display: block` dalam media query. |
| Kartu statistik masih berdampingan di layar kecil | Pastikan viewport <= 768px dan `.stats-grid` menerima `grid-template-columns: 1fr`. |
| Tabel tampak kepotong | Coba scroll horizontal; pastikan tabel berada di dalam `.card` yang mempunyai `overflow-x: auto`. |
| Form melebar melebihi area | Periksa `width: 100%`, `box-sizing: border-box`, dan pembungkus `.form-container`. |
| Focus input tidak tampak | Pastikan rule `:focus` tidak ditimpa CSS lain. |
| Warna hover tidak berubah | Pastikan class tombol cocok, pointer diarahkan ke elemen, dan deklarasi tidak ditimpa selector lebih spesifik. |

## Kosakata CSS yang perlu diingat

- **Selector:** memilih elemen.
- **Deklarasi:** satu pasangan properti dan nilai, seperti `color: #fff;`.
- **Rule/rule set:** selector beserta semua deklarasinya di dalam `{}`.
- **Class:** label yang dapat dipakai oleh banyak elemen HTML.
- **Pseudo-class:** keadaan khusus elemen, misalnya `:hover` dan `:focus`.
- **Cascade:** cara browser memutuskan aturan yang menang jika beberapa aturan cocok ke elemen yang sama.
- **Spesifisitas:** tingkat kekhususan selector. Umumnya ID lebih spesifik daripada class, dan class lebih spesifik daripada nama tag.
- **Media query:** aturan kondisional, misalnya hanya pada viewport <= 768px.
- **Flexbox:** layout untuk menata anak dalam satu arah utama.
- **Grid:** layout berbasis baris dan kolom.
- **Viewport:** area tampilan halaman di jendela browser.
- **Responsive:** layout menyesuaikan ruang tersedia tanpa perlu membuat halaman berbeda untuk tiap perangkat.
- **Transition:** efek perubahan CSS yang berlangsung halus selama waktu tertentu.
- **Transform:** perubahan posisi/bentuk visual tanpa mengubah alur layout normal.
- **Overflow:** apa yang dilakukan browser ketika isi melebihi kotak elemen.

## Tes pemahaman singkat

1. Mengapa `.sidebar.active` memakai tanda titik dua kali dan tanpa spasi?  
   **Jawaban:** karena elemen yang sama harus mempunyai dua class sekaligus, yaitu `sidebar` dan `active`.

2. Apa fungsi `box-sizing: border-box`?  
   **Jawaban:** menghitung padding dan border sebagai bagian dari lebar/tinggi yang ditentukan.

3. Mengapa `.main-wrapper` memiliki `margin-left: 240px` di desktop?  
   **Jawaban:** memberi ruang untuk sidebar fixed yang lebar 240px.

4. Apa makna `translateX(-100%)` di sidebar mobile?  
   **Jawaban:** menggeser sidebar ke kiri sebesar 100% dari lebar sidebar.

5. Apa yang mengubah sidebar dari tersembunyi ke terlihat?  
   **Jawaban:** JavaScript menambah class `active`; CSS `.sidebar.active` mengubah transform menjadi `translateX(0)`.

6. Mengapa tabel masih mempunyai `min-width: 550px` pada mobile?  
   **Jawaban:** menjaga agar kolom tetap terbaca. Wadah kartu dapat digeser secara horizontal.

7. Apa efek `@media screen and (max-width: 768px)`?  
   **Jawaban:** aturan di dalamnya aktif ketika layar berukuran 768 CSS px atau lebih sempit.

8. Apakah CSS bisa menyimpan data mobil ke JSON?  
   **Jawaban:** tidak. CSS mengatur presentasi. Penyimpanan data membutuhkan JavaScript dan biasanya server/database.

## Ringkasan akhir

File CSS final ini melakukan empat pekerjaan besar: **(1)** memberi dasar tampilan global, **(2)** menyusun sidebar dan area konten desktop, **(3)** memberi gaya untuk kartu, tombol, tabel, badge, dan form, serta **(4)** mengadaptasi menu dan konten untuk layar kecil melalui media query. Pola pikir paling penting adalah menghubungkan selector dengan class di HTML, lalu memahami properti dan nilainya sebagai instruksi visual. Setelah itu, pahami bagaimana media query menimpa aturan dasar untuk perangkat yang lebih kecil.
