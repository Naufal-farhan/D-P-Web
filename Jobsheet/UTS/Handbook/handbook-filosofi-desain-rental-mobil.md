# Handbook Tambahan — Filosofi Desain dan Alasan Adaptasi Jobsheet Rental Mobil

Dokumen ini membantu menjawab pertanyaan “mengapa desainnya seperti ini?” dan “mengapa tidak mengikuti contoh dosen secara persis?”. Penjelasan di bawah memisahkan **fakta yang terlihat di proyek** dari **alasan desain yang dapat kamu gunakan jika memang sesuai dengan niatmu**. Jangan mengaku bahwa suatu keputusan merupakan niat awal jika kamu tidak benar-benar memilihnya dengan alasan tersebut.

## 1. Prinsip utama: tujuan belajar tetap, konteks boleh diadaptasi

Referensi dosen menggunakan SIMPUS-Mini untuk mengajarkan konsep web. Proyek revisi menggunakan domain rental mobil. Dalam pembelajaran web, satu konsep dapat diterapkan pada domain yang berbeda: tabel buku dapat menjadi tabel mobil; formulir anggota dapat menjadi formulir pelanggan; statistik perpustakaan dapat menjadi statistik armada.

Yang harus dipertahankan adalah konsep yang sedang dinilai, bukan harus menyalin semua teks dan warna contoh. Tetapi instruksi eksplisit dosen tetap lebih tinggi daripada preferensi desain pribadi. Jika tugas meminta fitur tertentu, fitur itu tetap perlu dibuat meskipun tampilannya berbeda.

## 2. Filosofi tema Sistem Manajemen Rental Mobil

### 2.1 Dashboard admin sebagai pusat kendali

Dashboard admin dirancang sebagai tempat untuk melihat ringkasan dan berpindah ke bagian pengelolaan. Statistik memberi gambaran cepat; daftar mobil dan pelanggan menyediakan akses ke data yang dikelola.

Alasan yang bisa dijelaskan:
- Admin biasanya perlu berpindah antarbagian secara berulang.
- Navigasi yang konsisten membantu pengguna mengenali lokasi fitur.
- Ringkasan statistik dapat memperlihatkan kondisi umum tanpa membuka setiap tabel.
- Tata letak dashboard cocok untuk aplikasi yang memiliki beberapa area administrasi.

Hindari klaim bahwa statistik mencerminkan data operasional nyata: pada prototipe, angka berasal dari data contoh JSON dan perhitungan sederhana.

### 2.2 Sidebar dan topbar

Sidebar menampung navigasi utama yang relatif tetap. Topbar menampilkan konteks halaman, identitas pengguna contoh, atau kontrol menu.

Filosofi yang bisa dipakai:
- **Pengelompokan:** menu yang berkaitan ditempatkan pada area navigasi yang sama.
- **Konsistensi:** posisi navigasi tetap sehingga pengguna tidak harus mempelajari ulang setiap halaman.
- **Pemanfaatan ruang:** pada layar desktop, sidebar menyediakan jalur navigasi vertikal dan konten utama memperoleh area sendiri.
- **Adaptasi mobile:** sidebar dapat disembunyikan saat ruang sempit dan dibuka melalui hamburger.

Trade-off:
- Sidebar tetap memerlukan ruang horizontal.
- Pada ponsel, sidebar harus benar-benar bisa dibuka/ditutup tanpa menutupi konten secara membingungkan.
- Tombol menu perlu label aksesibel dan indikator keadaan bila sesuai.

## 3. Filosofi warna, tipografi, dan komponen

Style CSS revisi memakai palet, tipografi, jarak, kartu, badge, tombol, dan tabel yang berbeda dari contoh dosen. Alasan yang dapat dipertanggungjawabkan bukan “warna ini pasti paling bagus”, melainkan konsistensi dan keterbacaan.

### 3.1 Hierarki visual
Judul halaman, ringkasan, tabel, dan tombol memiliki fungsi berbeda. Perbedaan ukuran, ketebalan, jarak, dan warna membantu pengguna mengenali prioritas informasi.

### 3.2 Warna status
Badge status seperti “Tersedia” dan “Disewa” memberi petunjuk visual singkat. Warna sebaiknya tidak menjadi satu-satunya pembawa informasi; teks status tetap diperlukan agar makna tidak hilang bagi pengguna yang kesulitan membedakan warna.

### 3.3 Konsistensi komponen
Tombol, form, tabel, badge, dan kartu sebaiknya mengikuti pola visual yang seragam di semua halaman. Konsistensi membantu mengurangi beban belajar dan mempermudah pemeliharaan CSS.

### 3.4 Ruang dan keterbacaan
Margin, padding, line-height, dan jarak antarkomponen membuat konten tidak terasa bertumpuk. Tabel harus mempertahankan keterbacaan, bukan dipaksa mengecil sampai kolom sulit dibaca.

Catatan: filosofi di atas adalah penjelasan desain yang masuk akal untuk sistem seperti ini. Pilih hanya alasan yang benar-benar sesuai dengan CSS dan tampilan yang kamu buat.

## 4. Mengapa memakai pendekatan berbeda dari materi dosen?

### 4.1 Adaptasi domain
Saya mengubah domain dari perpustakaan ke rental mobil agar proyek mempunyai konteks yang berbeda. Konsepnya masih bisa dipetakan:
- Buku → mobil/armada.
- Anggota → pelanggan.
- Stok buku → ketersediaan/status mobil (konsepnya mirip, tetapi bukan data yang identik).
- Transaksi peminjaman → penyewaan (hanya analogi domain; alur bisnisnya tidak otomatis sama).

Penting: “mirip secara konsep” tidak berarti skema bisnisnya identik. Rental mobil dapat membutuhkan tanggal sewa, tanggal kembali, tarif, deposit, dan transaksi, yang belum tentu ada di prototipe ini.

### 4.2 Adaptasi layout
Saya memakai dashboard admin dengan sidebar, bukan navbar horizontal seperti referensi. Pilihan ini cocok untuk antarmuka yang memiliki beberapa bagian pengelolaan dan ringkasan statistik. Konsep CSS yang diuji tetap mencakup styling komponen dan layout.

### 4.3 Adaptasi interaksi responsif
Pada desktop sidebar terlihat sebagai navigasi utama. Pada mobile, sidebar menjadi off-canvas dan dikendalikan oleh tombol hamburger. Pada Jobsheet 03 pemicu menu menggunakan checkbox/CSS; pada Jobsheet 05 interaksi dipindahkan ke JavaScript agar dapat merespons event dan mengubah class DOM.

Ini memberi alur belajar yang logis: pertama mengenal interaksi dasar CSS, lalu mengenal event dan DOM melalui JavaScript.

### 4.4 Adaptasi sumber data
JSON berisi objek mobil/pelanggan, bukan buku/anggota. JavaScript mengambil file tersebut dan membangun tabel. Dengan begitu, pembelajaran pemisahan data dan tampilan tetap relevan walau nama properti berubah.

## 5. Perubahan yang merupakan pilihan desain vs perubahan yang memengaruhi cakupan tugas

| Jenis perubahan | Contoh pada proyek | Cara menilainya |
|---|---|---|
| Presentasi | Warna, font, radius, shadow, jarak | Umumnya bebas selama terbaca dan tidak ada desain wajib |
| Layout | Navbar menjadi sidebar/topbar | Bisa diterima jika tujuan layout tetap tercapai |
| Konten/domain | Buku/anggota menjadi mobil/pelanggan | Perlu sesuai ruang lingkup yang diizinkan dosen |
| Teknik implementasi | Selector, pola class, `.then()` dibanding `async/await` | Bisa berbeda jika teknik yang dinilai tetap ditunjukkan; jika materi mensyaratkan teknik tertentu, gunakan teknik itu |
| Fitur | Validasi form/filter/hapus tidak ikut dibuat | Ini bukan sekadar desain; dapat membuat persyaratan fitur belum terpenuhi |
| Persistensi | Data JSON statis, tidak ada backend/database | Harus dijelaskan sebagai batasan prototipe, bukan fitur CRUD penuh |

## 6. Bagian yang perlu diakui dengan jujur

### Jobsheet 05
Referensi memuat hamburger JavaScript, validasi form, filter tabel, dan konfirmasi hapus. Revisi berfokus pada hamburger. Karena itu, jelaskan bahwa implementasi DOM/event telah dicoba melalui navigasi, tetapi fitur lainnya belum semuanya dibawa.

### Jobsheet 06
Revisi memakai JSON dan Fetch API, tetapi bukan backend. Tombol Edit/Hapus masih berupa alert, dan submit form belum menyimpan data ke JSON secara permanen. Statistik rental aktif juga dihitung dari jumlah mobil berstatus `Disewa`, bukan dari tabel transaksi rental yang sesungguhnya.

### Jobsheet 04
Rancangan harus sesuai proyek aktual. Jika dokumen wireframe masih menyebut login petugas, buku, atau peminjaman buku, ubah istilah dan alurnya atau jelaskan bahwa wireframe tersebut merupakan referensi awal yang belum diadaptasi.

### Urutan Jobsheet
Revisi menambahkan `meta viewport` lebih awal daripada referensi. Itu boleh menjadi keputusan implementasi, tetapi jika dosen menilai urutan tahapan secara ketat, jelaskan bahwa fitur tersebut sudah dipersiapkan sejak awal dan dikembangkan pada tahap responsif.

## 7. Contoh jawaban presentasi yang aman

> “Saya menggunakan materi dosen sebagai landasan konsep, bukan menyalin identitas visualnya secara mentah. Saya mengubah konteks menjadi sistem rental mobil, sehingga entitas, label, dan data menyesuaikan proyek. Untuk desain, saya menggunakan sidebar dan topbar karena aplikasi diposisikan sebagai dashboard admin dengan beberapa bagian pengelolaan. CSS tetap mengatur layout dan komponen, media query menangani responsivitas, dan JavaScript mengelola interaksi menu. Pada tahap Fetch API, data mobil dan pelanggan dipisahkan ke JSON lalu dirender ke tabel. Saya juga menyadari bahwa beberapa fitur referensi, terutama validasi form, filter tabel, dan CRUD persisten, belum saya implementasikan penuh. Jadi saya membedakan adaptasi desain dari fitur yang memang masih menjadi kekurangan.”

## 8. Jika dosen bertanya “apakah pendekatan berbeda ini diperbolehkan?”

Jawaban yang aman:
> “Secara teknis, konsep yang sama dapat diterapkan pada konteks dan desain berbeda. Namun saya tetap menjadikan instruksi capaian dan fitur wajib dari dosen sebagai acuan. Jika ada bagian yang wajib sama persis, saya siap menyesuaikan. Perbedaan visual saya buat untuk menyesuaikan domain rental mobil, bukan untuk menghindari konsep materi.”

Jawaban ini tidak mengasumsikan kebijakan dosen. Keputusan akhir tentang kebebasan domain dan desain tetap bergantung pada instruksi tugas.

## 9. Saran sebelum presentasi

1. Buka setiap jobsheet dan tunjukkan satu bukti kode untuk konsep yang dibahas.
2. Pada CSS, tunjukkan selector/layout atau media query, bukan hanya screenshot.
3. Pada JavaScript, tunjukkan event listener dan class yang berubah.
4. Pada JSON, tunjukkan satu objek dan jelaskan bagaimana propertinya menjadi kolom tabel.
5. Demonstrasikan Jobsheet 06 melalui server lokal.
6. Jangan menyebut alert sebagai CRUD nyata atau JSON statis sebagai database.
7. Jika ada fitur wajib yang belum ada, akui dan sebutkan rencana perbaikannya.

## Kesimpulan

Pendekatan visual dan domain yang berbeda dapat tetap selaras dengan materi jika konsep yang dinilai diterapkan. Untuk proyek ini, fondasi HTML, CSS, responsivitas, interaksi DOM, serta pengambilan JSON memang terlihat dalam kode. Akan tetapi, ada kesenjangan fitur pada Jobsheet 05 dan batasan prototipe pada Jobsheet 06. Menjelaskan kedua hal itu secara terbuka adalah cara yang paling kuat untuk mempertanggungjawabkan pekerjaan di depan dosen.
