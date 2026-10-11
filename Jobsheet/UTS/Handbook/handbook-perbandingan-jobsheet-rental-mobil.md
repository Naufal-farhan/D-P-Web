# Handbook Belajar UTS — Perbandingan Jobsheet Rental Mobil dengan Referensi Dosen

> Tujuan dokumen: membantu memahami proyek revisi, menjelaskan perubahan dari tiap jobsheet, dan menilai keselarasan konsepnya dengan referensi dosen. Ditulis berdasarkan pemeriksaan dua ZIP yang diberikan: `jobsheet-01-05-revisi-rental-mobil.zip` (yang juga memuat Jobsheet 06) dan `referensi-materi(js 01-06).zip`.

## Ringkasan untuk presentasi

Proyek revisi mengubah konteks aplikasi dari **SIMPUS-Mini (perpustakaan: buku dan anggota)** menjadi **Sistem Manajemen Rental Mobil (mobil dan pelanggan)**. Nama folder `buku/` dan `anggota/` tetap dipertahankan agar struktur proyek tidak banyak berubah, tetapi isi halaman dan labelnya disesuaikan dengan domain rental mobil.

Perubahan konten dan visual merupakan keputusan desain yang dapat diterima jika capaian pembelajaran tetap diterapkan. Namun, keselarasan tidak berarti setiap fitur referensi sudah terpenuhi. Ada perbedaan fitur yang harus dijelaskan dengan jujur, khususnya Jobsheet 05 dan 06.

### Kesimpulan cepat

- **Jobsheet 01:** konsep struktur HTML tetap relevan; halaman dan kontennya diganti.
- **Jobsheet 02:** konsep styling CSS tetap relevan; stylesheet dan tata letak dibuat berbeda.
- **Jobsheet 03:** konsep responsif tetap relevan; pola sidebar/off-canvas menggantikan pola navbar referensi.
- **Jobsheet 04:** materi rancangan UI/UX tetap relevan; pastikan wireframe yang diserahkan memang menggambarkan rental mobil, bukan rancangan SIMPUS.
- **Jobsheet 05:** memenuhi sebagian tujuan JavaScript DOM/event melalui hamburger menu. Fitur validasi form, filter tabel, dan konfirmasi hapus yang ada di referensi belum semuanya dibawa ke revisi.
- **Jobsheet 06:** data JSON dan Fetch API digunakan untuk mobil/pelanggan, tetapi detail implementasinya berbeda dari referensi. Ada hal yang perlu diakui: tombol Edit/Hapus pada versi revisi masih berupa contoh/alert dan form tambah hanya memberi notifikasi lalu berpindah halaman; tidak menyimpan data permanen.

## 1. Cara membandingkan jobsheet

Bandingkan tiga hal secara terpisah:

1. **Capaian pembelajaran:** konsep yang harus dikuasai (misalnya CSS3, responsive design, DOM, Fetch API).
2. **Implementasi:** bagaimana konsep itu diterapkan pada kode.
3. **Konteks dan desain:** nama aplikasi, isi data, warna, tipografi, susunan layout, dan identitas visual.

Konteks dan desain boleh berbeda jika tidak bertentangan dengan instruksi tugas. Sebaliknya, fitur yang disebut eksplisit sebagai persyaratan tugas tidak sebaiknya dianggap terpenuhi hanya karena halaman terlihat bagus.

## 2. Jobsheet 01 — HTML5 dan struktur halaman

### Tujuan materi
Membangun kerangka halaman menggunakan HTML: struktur dokumen, elemen semantik, tautan antarhalaman, tabel, serta formulir.

### Apa yang dibuat pada revisi
- `index.html`: dashboard admin rental mobil dengan ringkasan/statistik dan tabel aktivitas.
- `buku/list.html`: halaman daftar armada mobil.
- `buku/tambah.html`: form tambah mobil.
- `anggota/list.html`: halaman daftar pelanggan.
- `anggota/tambah.html`: form tambah pelanggan.

### Perubahan dari referensi
- Domain perpustakaan diganti menjadi rental mobil.
- Label seperti buku/anggota secara visual diganti menjadi mobil/pelanggan.
- Susunan halaman memakai sidebar dan area dashboard, berbeda dari header/navbar SIMPUS-Mini.
- Pada revisi sudah ada `meta viewport` di HTML Jobsheet 01. Referensi menekankan fondasi HTML dan baru menambahkan viewport pada Jobsheet 03. Ini bukan masalah fungsional, tetapi berarti perubahan responsif tertentu dimajukan lebih awal.
- Konten dan tabel contoh disesuaikan dengan atribut rental, seperti model/merk, plat nomor, tarif, dan status.

### Konsep yang harus bisa dijelaskan
- `<!DOCTYPE html>` memberi tahu browser bahwa dokumen memakai HTML modern.
- `head` memuat metadata dan judul; `body` memuat konten yang terlihat.
- Elemen semantik seperti `header`, `aside`, `nav`, `main`, `section`, `article`, `table`, dan `form` memberi struktur yang lebih bermakna.
- `a` menghubungkan halaman; `label`, `input`, `select`, dan `required` membantu membuat formulir.
- HTML menentukan **struktur dan makna**, bukan desain visual utama.

### Batasan
Pada tahap ini tombol aksi dan formulir masih prototipe. HTML form tidak otomatis menyimpan data ke database. Tombol yang terlihat seperti Edit/Hapus belum tentu menjalankan operasi CRUD.

### Jawaban lisan yang bisa digunakan
> “Saya mempertahankan tujuan Jobsheet 01, yaitu menyusun struktur halaman dengan HTML. Yang saya ubah adalah domain datanya: dari perpustakaan menjadi rental mobil. Elemen dan pola halaman tetap digunakan untuk membangun dashboard, tabel, navigasi, dan form. Saya juga menambahkan viewport lebih awal agar halaman siap untuk tahap responsif berikutnya.”

## 3. Jobsheet 02 — CSS3 styling dasar

### Tujuan materi
Menerapkan CSS eksternal, selector, warna, tipografi, box model, layout, dan styling komponen agar halaman lebih teratur.

### Apa yang dibuat pada revisi
- Menambahkan `assets/css/style.css`.
- Menghubungkan stylesheet dari halaman HTML.
- Membuat gaya dashboard dengan sidebar, topbar, area konten, kartu statistik, tabel, badge status, tombol, dan form.
- Menggunakan Flexbox/Grid serta pengaturan jarak, warna, border, dan tipografi.

### Perubahan dari referensi
- Referensi memakai tampilan SIMPUS-Mini dengan header/nav; revisi menggunakan pola dashboard admin dengan sidebar.
- Warna, font, ukuran, jarak, dan dekorasi dibuat berbeda.
- CSS ditulis sesuai struktur dan kelas yang dipakai proyek rental mobil; karena HTML-nya juga berbeda, stylesheet tidak sekadar salinan stylesheet referensi.
- Tujuan styling tetap sama: meningkatkan keterbacaan, hierarki visual, dan konsistensi ant halaman.

### Konsep yang harus bisa dijelaskan
- **CSS eksternal** memisahkan aturan visual dari struktur HTML.
- **Selector** memilih elemen yang akan diberi gaya.
- **Box model** terdiri dari content, padding, border, dan margin.
- **Flexbox** cocok untuk susunan satu dimensi, misalnya baris topbar atau navigasi.
- **CSS Grid** cocok untuk layout dua dimensi, misalnya kartu statistik.
- **Position fixed** dapat dipakai untuk sidebar yang tetap berada di sisi layar; perlu diimbangi ruang untuk konten utama.
- Satu stylesheet bersama membantu menjaga konsistensi lintas halaman.

### Mengapa desain berbeda tidak otomatis salah?
CSS mengajarkan cara mengatur presentasi, bukan mengharuskan semua proyek memiliki palet warna dan layout identik. Selama properti CSS dan teknik layout yang dipelajari benar-benar digunakan, desain alternatif dapat menjadi penerapan konsep yang sama. Namun, bila dosen menetapkan tampilan tertentu sebagai syarat eksplisit, syarat itu tetap harus diikuti.

### Jawaban lisan
> “Saya menggunakan stylesheet eksternal seperti tujuan materi. Saya memilih sidebar dan topbar karena aplikasi rental mobil berperan sebagai dashboard admin yang memiliki beberapa area pengelolaan data. Perbedaan warna dan komponen adalah keputusan visual; konsep CSS seperti selector, box model, Flexbox, dan Grid tetap menjadi dasar implementasinya.”

## 4. Jobsheet 03 — Responsive Web Design

### Tujuan materi
Membuat halaman menyesuaikan ukuran layar dengan viewport, media query, breakpoint, layout fleksibel, dan penanganan tabel pada layar sempit.

### Apa yang dibuat pada revisi
- Menambahkan kontrol checkbox tersembunyi dan label/tombol untuk memicu menu mobile melalui CSS.
- Sidebar menjadi off-canvas pada layar kecil.
- Media query mengubah layout dan jumlah kolom kartu statistik.
- Tabel diletakkan dalam pembungkus yang memungkinkan scroll horizontal.
- Form dan area konten disesuaikan untuk layar yang lebih kecil.

### Perubahan dari referensi
- Referensi menggunakan navbar yang berubah menjadi hamburger pada breakpoint kecil; revisi memakai sidebar dashboard.
- Teknik checkbox + CSS tetap dipakai sebagai pendekatan menu tanpa JavaScript pada tahap ini.
- Breakpoint dan detail styling mengikuti struktur dashboard rental mobil, bukan harus meniru nilai dan selector referensi secara persis.
- Revisi sudah memiliki viewport sejak Jobsheet 01, sedangkan referensi memperkenalkannya pada Jobsheet 03.

### Konsep yang harus bisa dijelaskan
- **Responsive design** berarti satu situs menyesuaikan diri dengan berbagai ukuran layar.
- `meta viewport` membantu browser mobile menggunakan lebar viewport perangkat.
- `@media` menerapkan aturan CSS berdasarkan kondisi seperti lebar layar.
- **Breakpoint** adalah titik ketika layout perlu berubah karena ruang tidak lagi cukup.
- `overflow-x: auto` pada pembungkus tabel menjaga kolom tetap terbaca dengan scroll horizontal.
- Checkbox hack memakai status `:checked` sebagai pemicu CSS; ini dapat membuat interaksi dasar tanpa JavaScript, tetapi kurang fleksibel dibanding kontrol berbasis JS untuk perilaku kompleks.

### Cara menguji
Uji lebar desktop, tablet, dan mobile melalui Developer Tools. Pastikan sidebar dapat dibuka, konten tidak tertutup, tabel dapat digeser, dan form tetap terbaca.

### Jawaban lisan
> “Saya mempertahankan prinsip responsive design, tetapi menyesuaikan pola navigasinya dengan dashboard admin. Pada desktop sidebar selalu menjadi navigasi utama; pada layar sempit sidebar disembunyikan dan dapat dibuka melalui kontrol hamburger. Tabel tidak dipaksa mengecil sampai sulit dibaca, tetapi dapat digeser horizontal.”

## 5. Jobsheet 04 — UI/UX, wireframe, dan user flow

### Tujuan materi
Merancang antarmuka sebelum implementasi: menentukan komponen halaman, urutan tindakan, aktor, dan alur pengguna.

### Apa yang perlu ada pada proyek rental mobil
Dokumentasi sebaiknya membahas alur yang relevan, misalnya:
- Admin membuka dashboard.
- Admin melihat daftar mobil.
- Admin membuka form tambah mobil.
- Admin melihat daftar pelanggan.
- Admin membuka form tambah pelanggan.
- (Jika termasuk ruang lingkup proyek) admin mengelola transaksi penyewaan dan pengembalian.

Wireframe menjawab “komponen apa yang ada dan di mana letaknya?”; user flow menjawab “langkah apa yang ditempuh pengguna untuk menyelesaikan tugas?”.

### Perubahan dari referensi
Referensi `docs/wireframe.md` membahas Login Petugas, Dashboard Petugas, Peminjaman, Pengembalian, dan Riwayat untuk aplikasi perpustakaan. Itu tidak otomatis cocok dengan proyek rental mobil. Jika wireframe revisi sudah diganti ke alur rental mobil, itu merupakan adaptasi konteks yang tepat. Jika masih berisi istilah SIMPUS, buku, anggota, atau peminjaman buku, dokumentasinya perlu diperbarui agar konsisten dengan implementasi.

### Catatan penting
README revisi menyebut Jobsheet 04 sebagai dokumentasi user flow/wireframe. Pemeriksaan ZIP menunjukkan file `docs/wireframe.md` ada pada Jobsheet 04; pastikan isinya benar-benar menyebut aktor, langkah, dan halaman rental mobil, bukan hanya deskripsi desain. Jobsheet 04 sebaiknya dipahami sebagai tahap perancangan, bukan penambahan fitur yang sudah berjalan.

### Jawaban lisan
> “Wireframe membantu saya merencanakan komponen dan alur sebelum mengimplementasikan halaman. Saya menyesuaikan aktor serta istilah dari petugas perpustakaan menjadi admin rental mobil agar rancangan menggambarkan pengguna dan tugas dalam domain proyek saya.”

## 6. Jobsheet 05 — JavaScript, DOM, dan event

### Tujuan materi
Menggunakan JavaScript untuk merespons interaksi pengguna, memilih elemen DOM, mengelola event, dan mengubah class/atribut elemen.

### Apa yang dibuat pada revisi
- Menambahkan `assets/js/app.js`.
- Menggunakan `DOMContentLoaded` agar inisialisasi dilakukan setelah struktur dokumen siap.
- Memilih tombol menu dan sidebar melalui ID/selector.
- Menggunakan `addEventListener('click', ...)`.
- Mengubah class `active` pada sidebar/overlay untuk membuka atau menutup menu.
- Menambahkan perilaku penutupan menu, seperti klik area luar/overlay, tombol Escape, atau pemilihan tautan, sesuai implementasi pada file yang bersangkutan.
- Menggunakan atribut aksesibilitas pada kontrol menu di revisi Jobsheet 05.

### Perbedaan penting dari referensi
Referensi Jobsheet 05 tidak hanya mengganti hamburger CSS menjadi JavaScript. Referensi juga menambahkan:
1. validasi client-side pada form tambah buku/anggota;
2. filter pencarian real-time pada tabel;
3. konfirmasi hapus dan penghilangan baris dari tampilan.

Versi revisi Jobsheet 05 terutama berfokus pada hamburger menu. Karena itu, **tujuan DOM/event tercakup sebagian, tetapi kumpulan fitur referensi tidak lengkap pada revisi ini**. Jangan mengatakan validasi form dan filter tabel sudah dibuat jika memang tidak ada dalam kode.

### Konsep yang harus bisa dijelaskan
- **DOM:** representasi dokumen HTML yang bisa dipilih dan dimodifikasi oleh JavaScript.
- `getElementById()` memilih elemen berdasarkan ID.
- `querySelector()` memilih elemen pertama yang cocok dengan selector CSS.
- `addEventListener()` mendaftarkan fungsi yang dijalankan ketika event terjadi.
- `classList.toggle()` berganti antara menambahkan dan menghapus class.
- `classList.add()`/`remove()` menambahkan atau menghapus class secara eksplisit.
- `DOMContentLoaded` menandai saat dokumen selesai diparsing.
- `aria-expanded` dapat menyatakan apakah kontrol terkait sedang terbuka; `aria-label` memberi nama aksesibel bagi kontrol.

### Batasan
JavaScript pada tahap ini mengatur menu, bukan backend. Ia belum menyimpan mobil/pelanggan secara permanen. Manipulasi tampilan tidak sama dengan menyimpan perubahan ke server atau database.

### Jawaban lisan
> “Pada Jobsheet 05 saya menerapkan DOM dan event melalui tombol hamburger. Saat tombol diklik, event listener mengubah class pada sidebar sehingga CSS menampilkan atau menyembunyikannya. Fokus revisi ini adalah navigasi. Saya memahami bahwa fitur validasi, filter tabel, dan konfirmasi hapus yang ada pada referensi belum seluruhnya saya implementasikan.”

## 7. Jobsheet 06 — Fetch API, JSON, dan rendering data

### Tujuan materi
Memisahkan data dari HTML, mengambil data secara asinkron menggunakan Fetch API, mengurai JSON, lalu menampilkan data pada DOM.

### Apa yang dibuat pada revisi
- Menambahkan `data/buku.json` dan `data/anggota.json` yang isinya disesuaikan menjadi data mobil dan pelanggan.
- `assets/js/buku.js` mengambil `../data/buku.json` lalu membangkitkan baris tabel mobil.
- `assets/js/anggota.js` mengambil `../data/anggota.json` lalu membangkitkan baris tabel pelanggan.
- `assets/js/app.js` mengambil kedua file JSON untuk menghitung statistik dashboard.
- Menggunakan `.then()` dan `.catch()` untuk alur sukses/kegagalan.
- Menampilkan pesan kegagalan pada tabel atau console ketika pengambilan data gagal, sesuai skripnya.

### Perubahan dari referensi
- Entitas buku/anggota diubah menjadi mobil/pelanggan.
- Properti JSON berubah mengikuti domain, misalnya merk, plat, tarif, status, nama, NIK, telepon, dan alamat.
- Revisi memecah kode menjadi `app.js`, `buku.js`, dan `anggota.js`.
- Referensi banyak membahas `async/await`, indikator loading, `try/catch/finally`, render dinamis, serta event delegation untuk tombol hapus. Revisi memakai pola `.then()`/`.catch()` untuk fetch dan rendering dinamis, sehingga konsep asinkron tetap digunakan tetapi tidak identik dengan semua pola referensi.
- Revisi belum memiliki backend atau database. File JSON adalah sumber data statis.

### Hal teknis yang perlu diperhatikan
- `fetch()` ke file JSON sebaiknya dijalankan melalui server lokal, bukan membuka HTML dengan `file://`, karena kebijakan browser dapat memblokir permintaan tersebut.
- `.json()` juga bersifat asinkron dan menghasilkan Promise.
- `fetch()` tidak selalu masuk ke `.catch()` hanya karena server memberi status HTTP seperti 404; praktik yang lebih kuat adalah memeriksa `response.ok` sebelum membaca JSON.
- Pada kode revisi, tombol Edit/Hapus yang dibuat di baris tabel masih memakai `alert(...)` sebagai contoh, bukan CRUD nyata.
- Form tambah pada Jobsheet 06 menampilkan alert dan mengarahkan pengguna ke halaman daftar; tidak menambahkan objek ke file JSON secara permanen.
- Data statistik dashboard menggunakan hasil fetch JSON. Perhatikan bahwa `rental-aktif` dihitung dari jumlah mobil berstatus `Disewa`; ini merupakan asumsi penyederhanaan, bukan hitungan transaksi rental yang sesungguhnya.

### Konsep yang harus bisa dijelaskan
- **JSON** adalah format teks untuk merepresentasikan data terstruktur.
- **Fetch API** membuat permintaan untuk mengambil resource.
- **Promise** mewakili hasil operasi asinkron yang belum tentu selesai saat itu juga.
- `.then()` menangani hasil Promise; `.catch()` menangani kegagalan Promise.
- `response.json()` mengurai isi respons menjadi data JavaScript.
- `map()` dapat mengubah setiap objek data menjadi potongan HTML; hasilnya dapat dipasang ke `innerHTML`.
- Rendering dinamis berarti baris tabel dibuat dari data, bukan semuanya ditulis manual di HTML.

### Jawaban lisan
> “Pada Jobsheet 06 saya memisahkan data mobil dan pelanggan ke file JSON, lalu mengambilnya dengan Fetch API. Setelah JSON diurai, JavaScript membangkitkan baris tabel dan memperbarui statistik dashboard. Ini memisahkan sumber data dari struktur HTML, tetapi belum merupakan backend: data JSON masih statis dan aksi tambah/edit/hapus belum menyimpan perubahan permanen.”

## 8. Apa yang sama dan apa yang berbeda?

| Aspek | Tetap dipertahankan | Diadaptasi/berbeda |
|---|---|---|
| Domain aplikasi | Struktur halaman pengelolaan data | Perpustakaan → rental mobil |
| HTML | Dokumen, navigasi, tabel, form, struktur semantik | Label, data, hierarki layout |
| CSS | Selector, box model, Flexbox/Grid, styling komponen | Palet, font, sidebar, topbar, komposisi |
| Responsive | Viewport, media query, breakpoint, tabel mobile | Bentuk sidebar/off-canvas dan detail breakpoint |
| UI/UX | Wireframe dan user flow sebagai alat desain | Aktor dan alur harus sesuai rental mobil |
| JavaScript | DOM, event listener, class/atribut | Fokus revisi J05 terutama pada menu |
| Data | JSON, Fetch API, parsing dan rendering dinamis | Skema data dan entitas mobil/pelanggan |
| Persistensi | Belum ada | Belum ada backend/database pada prototipe |

## 9. Hal yang jangan diklaim saat presentasi

Jangan mengatakan:
- “Semua fitur Jobsheet 05 referensi sudah saya implementasikan,” jika validasi form, filter, dan konfirmasi hapus belum ada.
- “Data tersimpan ke database,” karena versi ini masih frontend statis dengan JSON.
- “Tombol Edit/Hapus sudah berfungsi penuh,” jika yang terjadi hanya alert.
- “Jobsheet 06 sama persis dengan referensi,” karena domain, struktur file, skema data, dan pola implementasinya telah disesuaikan.
- “Desain berbeda pasti diperbolehkan dosen.” Lebih aman menjelaskan alasan teknis dan tetap mengakui bahwa ketentuan eksplisit dari dosen menjadi acuan utama.

## 10. Pertanyaan yang mungkin ditanyakan dosen

**Mengapa memilih rental mobil, bukan perpustakaan?**  
Karena saya mengadaptasi konteks data agar menjadi proyek yang konsisten dengan tema rental mobil. Konsep teknis yang dipelajari tetap diterapkan, tetapi saya tetap perlu mengikuti ketentuan domain jika tugas dosen menetapkannya secara eksplisit.

**Mengapa CSS dan layout berbeda?**  
Karena saya memilih pola dashboard admin: sidebar untuk navigasi antarbagian, topbar untuk konteks halaman, dan kartu statistik untuk ringkasan. Ini keputusan desain, bukan penggantian konsep CSS.

**Mengapa menggunakan JavaScript untuk hamburger?**  
JavaScript dapat merespons klik dan mengubah class DOM. CSS tetap bertanggung jawab atas tampilan ketika class berubah.

**Apa bedanya data statis HTML dengan JSON?**  
Pada HTML statis, baris tabel ditulis langsung di markup. Dengan JSON, data disimpan terpisah dan JavaScript membangun baris tabel berdasarkan isi data.

**Apakah Fetch API berarti sudah menggunakan API backend?**  
Belum. Pada proyek ini Fetch mengambil file JSON lokal melalui server lokal. Ini mempelajari pola asinkron yang mirip, tetapi belum menghubungi API backend atau database.

**Apa kekurangan proyek saat ini?**  
Belum ada autentikasi, backend, database, dan persistensi CRUD. Tombol aksi dan form masih berupa prototipe. Pada Jobsheet 05, fitur interaktif juga belum selengkap referensi.

## 11. Checklist belajar malam sebelum UTS

- [ ] Bisa menjelaskan perbedaan HTML, CSS, dan JavaScript.
- [ ] Bisa menunjukkan satu elemen semantik dan menjelaskan fungsinya.
- [ ] Bisa menjelaskan box model, Flexbox, dan Grid.
- [ ] Bisa menunjukkan media query dan menjelaskan breakpoint-nya.
- [ ] Bisa menerangkan bagaimana hamburger mengubah class sidebar.
- [ ] Bisa menjelaskan peran `DOMContentLoaded`, `addEventListener`, dan `classList`.
- [ ] Bisa menunjukkan satu objek dalam JSON dan menjelaskan propertinya.
- [ ] Bisa menjelaskan alur `fetch → response.json() → render DOM`.
- [ ] Bisa membedakan prototipe frontend dari backend/database.
- [ ] Bisa menyebutkan fitur referensi yang belum dibawa ke revisi tanpa menutup-nutupi.
- [ ] Bisa menjelaskan alasan desain sebagai keputusan yang masuk akal, bukan mengklaim bahwa desain berbeda otomatis benar.

## Penutup

Cara paling kuat untuk mempertanggungjawabkan proyek ini adalah mengatakan: **“Saya mengadaptasi domain dan desain, tetapi berusaha mempertahankan konsep teknis yang menjadi tujuan setiap jobsheet. Saya juga memahami bagian yang belum identik dengan referensi dan batasan prototipe yang saya buat.”** Ini lebih akurat dan lebih meyakinkan daripada mengklaim seluruh implementasi sama persis.
