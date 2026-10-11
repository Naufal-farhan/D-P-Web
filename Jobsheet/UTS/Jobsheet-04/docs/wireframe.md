# Jobsheet 04 — User Flow dan Wireframe Teks

> Tahap ini adalah dokumentasi perancangan. Tidak ada perubahan pada HTML, CSS, atau perilaku website dibandingkan Jobsheet 03. Seluruh wireframe ditulis sebagai daftar struktur teks, bukan gambar.

## 1. Tujuan
Mendokumentasikan cara pengguna berpindah antarhalaman Sistem Manajemen Rental Mobil dan menyusun komponen utama setiap halaman sebelum fungsionalitas JavaScript dikembangkan.

## 2. User Flow

### A. Melihat dashboard
1. Pengguna membuka `index.html`.
2. Sistem menampilkan Dashboard Overview.
3. Pengguna membaca ringkasan Total Mobil, Mobil Disewa, Mobil Maintenance, dan Siap Dirental.
4. Pengguna melihat tabel Transaksi Rental Terbaru.
5. Pengguna memilih Data Mobil atau Data Pelanggan melalui navigasi.

### B. Melihat dan merencanakan penambahan data mobil
1. Dari dashboard, pengguna memilih menu Data Mobil.
2. Sistem menampilkan tabel daftar mobil: ID, model, nomor polisi, tarif per hari, status, dan aksi.
3. Pengguna memilih tombol Tambah Mobil.
4. Sistem menampilkan form berisi ID Mobil, Merk/Model, Nomor Polisi, Tarif per Hari, dan Status Mobil.
5. Pengguna mengisi field yang wajib diisi.
6. Pengguna memilih Simpan Data untuk menyelesaikan alur yang direncanakan.
7. Catatan: pada Jobsheet 01–05, penyimpanan permanen belum tersedia karena belum ada backend/database. Langkah simpan pada flow ini menggambarkan rancangan, bukan klaim fitur yang sudah berjalan.

### C. Melihat dan merencanakan penambahan data pelanggan
1. Pengguna memilih menu Data Pelanggan.
2. Sistem menampilkan tabel ID Pelanggan, Nama, Nomor Telepon, Email, Kota, dan Aksi.
3. Pengguna memilih Tambah Pelanggan.
4. Sistem menampilkan form ID Pelanggan, Nama Lengkap, Nomor Telepon, Email, dan Kota.
5. Pengguna mengisi field yang wajib diisi.
6. Pengguna memilih Simpan Data untuk menyelesaikan alur yang direncanakan.
7. Penyimpanan data nyata masih di luar cakupan jobsheet ini.

### D. Navigasi pada layar mobile
1. Pengguna membuka website melalui layar ponsel.
2. Sidebar tidak terlihat di awal.
3. Pengguna menekan ikon hamburger.
4. Sidebar muncul di sisi kiri dan overlay gelap muncul di belakangnya.
5. Pengguna memilih salah satu menu atau menekan overlay untuk menutup sidebar.
6. Pada Jobsheet 03, perilaku ini menggunakan checkbox dan CSS; JavaScript baru diterapkan pada Jobsheet 05.

## 3. Wireframe Teks

### Halaman Dashboard — `index.html`
- Sidebar: nama “Rental Mobil Admin”; menu Dashboard, Data Mobil, Data Pelanggan.
- Topbar: tombol hamburger pada layar kecil; judul “Sistem Manajemen Rental Mobil”; informasi “Selamat Datang, Admin Staff”.
- Area konten: judul “Dashboard Overview”; deskripsi ringkas.
- Ringkasan: empat kartu, yaitu Total Mobil, Mobil Disewa, Mobil Maintenance, dan Siap Dirental.
- Transaksi terbaru: tabel dengan kolom ID Transaksi, Pelanggan, Mobil, Tanggal Sewa, dan Status.

### Halaman Daftar Mobil — `buku/list.html`
- Sidebar yang sama, menu Data Mobil ditandai aktif.
- Topbar: judul sistem dan informasi admin.
- Area konten: judul “Data Mobil” dan deskripsi singkat.
- Aksi utama: tombol “Tambah Mobil”.
- Tabel: ID Mobil, Merk/Model, Nomor Polisi, Tarif per Hari, Status, Aksi.
- Isi aksi setiap baris: tombol Edit dan Hapus sebagai elemen prototipe.

### Halaman Form Mobil — `buku/tambah.html`
- Sidebar yang sama, menu Data Mobil ditandai aktif.
- Area konten: judul “Tambah Mobil”.
- Panel form: ID Mobil, Merk/Model, Nomor Polisi, Tarif per Hari, Status Mobil.
- Aksi bawah form: tombol Simpan Data dan Kembali.

### Halaman Daftar Pelanggan — `anggota/list.html`
- Sidebar yang sama, menu Data Pelanggan ditandai aktif.
- Area konten: judul “Data Pelanggan” dan deskripsi singkat.
- Aksi utama: tombol “Tambah Pelanggan”.
- Tabel: ID Pelanggan, Nama, Nomor Telepon, Email, Kota, Aksi.
- Isi aksi setiap baris: tombol Edit dan Hapus sebagai elemen prototipe.

### Halaman Form Pelanggan — `anggota/tambah.html`
- Sidebar yang sama, menu Data Pelanggan ditandai aktif.
- Area konten: judul “Tambah Pelanggan”.
- Panel form: ID Pelanggan, Nama Lengkap, Nomor Telepon, Email, Kota.
- Aksi bawah form: tombol Simpan Data dan Kembali.

## 4. Relasi Navigasi Antarhalaman
- Dashboard → Data Mobil.
- Dashboard → Data Pelanggan.
- Data Mobil → Tambah Mobil → kembali ke Daftar Mobil.
- Data Pelanggan → Tambah Pelanggan → kembali ke Daftar Pelanggan.
- Semua halaman dapat kembali ke Dashboard melalui sidebar.

## 5. Batasan dan Catatan
- Dokumen ini merupakan perencanaan, bukan implementasi backend.
- Tombol Edit/Hapus dan penyimpanan form belum mengolah data nyata.
- File website Jobsheet 04 harus identik dengan Jobsheet 03; seluruh perubahan tahap ini berada pada dokumentasi.
