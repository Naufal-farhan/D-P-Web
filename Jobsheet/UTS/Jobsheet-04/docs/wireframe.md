# Jobsheet 04 — User Flow dan Wireframe

> Tahap ini berfokus pada dokumentasi perancangan UI/UX Sistem Manajemen Rental Mobil. Wireframe dibuat menggunakan karakter ASCII untuk menggambarkan tata letak halaman, sedangkan user flow menggambarkan alur navigasi pengguna. Tidak ada perubahan pada HTML, CSS, atau perilaku website dibandingkan Jobsheet 03.

## 1. Tujuan

- Mendokumentasikan alur perpindahan pengguna antarhalaman.
- Menggambarkan struktur visual halaman melalui wireframe teks.
- Merencanakan posisi navigasi, kartu ringkasan, tabel, dan formulir sebelum pengembangan fitur JavaScript.
- Menjaga konsistensi rancangan dengan website yang telah dibuat pada Jobsheet 01–03.

## 2. User Flow

### A. User Flow — Dashboard

```text
                  +-------------------+
                  |   Buka Website    |
                  |    index.html     |
                  +---------+---------+
                            |
                            v
                  +-------------------+
                  |     Dashboard     |
                  |  Dashboard Overview|
                  +---------+---------+
                            |
               +------------+------------+
               |                         |
               v                         v
      +------------------+      +------------------+
      |    Data Mobil    |      |  Data Pelanggan  |
      +--------+---------+      +--------+---------+
               |                         |
               v                         v
      +------------------+      +------------------+
      | Daftar Mobil     |      | Daftar Pelanggan |
      +------------------+      +------------------+
```

### B. User Flow — Penambahan Data Mobil

```text
    +------------------+
    |    Dashboard     |
    +--------+---------+
             |
             v
    +------------------+
    |    Data Mobil    |
    +--------+---------+
             |
             v
    +------------------+
    |  Daftar Mobil    |
    +--------+---------+
             |
             v
    +------------------+
    |  + Tambah Mobil  |
    +--------+---------+
             |
             v
    +------------------+
    |   Form Mobil     |
    |------------------|
    | ID Mobil         |
    | Merk / Model     |
    | Nomor Polisi     |
    | Tarif per Hari   |
    | Status Mobil     |
    +--------+---------+
             |
             v
    +------------------+
    | Isi Data Form    |
    +--------+---------+
             |
             v
    +------------------+
    |  Simpan Data     |
    +--------+---------+
             |
             v
    +------------------+
    | Rencana Kembali  |
    | ke Daftar Mobil  |
    +------------------+

    Catatan: penyimpanan permanen belum tersedia.
```

### C. User Flow — Penambahan Data Pelanggan

```text
    +---------------------+
    |      Dashboard      |
    +----------+----------+
               |
               v
    +---------------------+
    |   Data Pelanggan    |
    +----------+----------+
               |
               v
    +---------------------+
    | Daftar Pelanggan    |
    +----------+----------+
               |
               v
    +---------------------+
    | + Tambah Pelanggan  |
    +----------+----------+
               |
               v
    +---------------------+
    |   Form Pelanggan    |
    |---------------------|
    | ID Pelanggan        |
    | Nama Lengkap        |
    | Nomor Telepon       |
    | Email               |
    | Kota                |
    +----------+----------+
               |
               v
    +---------------------+
    |     Isi Form        |
    +----------+----------+
               |
               v
    +---------------------+
    |     Simpan Data     |
    +----------+----------+
               |
               v
    +---------------------+
    | Rencana Kembali ke  |
    | Daftar Pelanggan    |
    +---------------------+

    Catatan: data nyata belum disimpan ke database.
```

### D. User Flow — Navigasi Mobile

```text
       +----------------------+
       | Buka Website Mobile  |
       +----------+-----------+
                  |
                  v
       +----------------------+
       | Sidebar Tersembunyi  |
       +----------+-----------+
                  |
                  v
       +----------------------+
       | Tekan Ikon Hamburger |
       +----------+-----------+
                  |
                  v
       +----------------------+
       | Sidebar Muncul       |
       | + Overlay Gelap      |
       +----------+-----------+
                  |
                  v
       +----------------------+
       | Pilih Menu / Overlay |
       +----------+-----------+
                  |
                  v
       +----------------------+
       | Halaman Tujuan atau  |
       | Sidebar Tertutup     |
       +----------------------+

    Jobsheet 03: Checkbox + CSS
    Jobsheet 05: Pengembangan JavaScript
```

## 3. Wireframe Halaman

### A. Wireframe — Dashboard (`index.html`)

```text
+--------------------------------------------------------------------------+
|                                                                          |
|  [ ☰ ]  SISTEM MANAJEMEN RENTAL MOBIL           Selamat Datang, Admin    |
|                                                                          |
+----------------------+---------------------------------------------------+
|                      |                                                   |
|  RENTAL MOBIL ADMIN  |  Dashboard Overview                              |
|  ------------------  |  Ringkasan informasi rental mobil                |
|                      |                                                   |
|  [ Dashboard ]       |  +---------------+ +---------------+             |
|                      |  |   TOTAL MOBIL | |  MOBIL DISEWA |             |
|  [ Data Mobil ]      |  |      120      | |      35       |             |
|                      |  +---------------+ +---------------+             |
|  [ Data Pelanggan ]  |                                                   |
|                      |  +---------------+ +---------------+             |
|                      |  |  MAINTENANCE  | | SIAP DIRENTAL |             |
|                      |  |       8       | |      77       |             |
|                      |  +---------------+ +---------------+             |
|                      |                                                   |
|                      |  Transaksi Rental Terbaru                         |
|                      |  +---------------------------------------------+  |
|                      |  | ID Transaksi | Pelanggan | Mobil | Tanggal  |  |
|                      |  |--------------|-----------|-------|----------|  |
|                      |  | TR001        | Contoh A  | Avanza| 01/10    |  |
|                      |  | TR002        | Contoh B  | Xenia | 02/10    |  |
|                      |  | TR003        | Contoh C  | Brio  | 03/10    |  |
|                      |  +---------------------------------------------+  |
|                      |                                                   |
+----------------------+---------------------------------------------------+
```

Keterangan:
- Sidebar berada di sebelah kiri dan memuat navigasi utama.
- Topbar memuat tombol hamburger, judul sistem, dan informasi admin.
- Empat kartu menampilkan ringkasan kondisi mobil.
- Tabel menampilkan transaksi rental terbaru.

*Angka dan isi transaksi pada wireframe merupakan contoh ilustratif, bukan data aktual website.*

### B. Wireframe — Daftar Mobil (`buku/list.html`)

```text
+--------------------------------------------------------------------------+
| [ ☰ ]  SISTEM MANAJEMEN RENTAL MOBIL            Selamat Datang, Admin    |
+----------------------+---------------------------------------------------+
| RENTAL MOBIL ADMIN   |                                                   |
|                      |  Data Mobil                                      |
| [ Dashboard ]        |  Kelola informasi mobil yang tersedia            |
|                      |                                                   |
| [ Data Mobil * ]     |                     [ + Tambah Mobil ]            |
|                      |                                                   |
| [ Data Pelanggan ]   |  +---------------------------------------------+  |
|                      |  | ID   | Merk/Model | No. Polisi | Tarif/Hari |  |
|                      |  |------|------------|------------|-----------|  |
|                      |  | M001 | Toyota     | N 1234 AB  | Rp350.000 |  |
|                      |  | M002 | Honda      | N 5678 CD  | Rp300.000 |  |
|                      |  | M003 | Suzuki     | N 9012 EF  | Rp250.000 |  |
|                      |  +---------------------------------------------+  |
|                      |  | Status     | Aksi                           |  |
|                      |  |------------|--------------------------------|  |
|                      |  | Tersedia   | [ Edit ] [ Hapus ]             |  |
|                      |  | Disewa     | [ Edit ] [ Hapus ]             |  |
|                      |  | Maintenance| [ Edit ] [ Hapus ]             |  |
|                      |  +---------------------------------------------+  |
|                      |                                                   |
+----------------------+---------------------------------------------------+
```

Keterangan:
- Menu Data Mobil ditandai aktif.
- Tombol Tambah Mobil mengarah ke halaman form.
- Tabel dirancang untuk menampilkan identitas mobil, tarif, status, dan aksi.
- Tombol Edit dan Hapus merupakan elemen prototipe.

### C. Wireframe — Form Tambah Mobil (`buku/tambah.html`)

```text
+--------------------------------------------------------------------------+
| [ ☰ ]  SISTEM MANAJEMEN RENTAL MOBIL                                     |
+----------------------+---------------------------------------------------+
| RENTAL MOBIL ADMIN   |                                                   |
|                      |  Tambah Mobil                                    |
| [ Dashboard ]        |  Masukkan informasi mobil                        |
|                      |                                                   |
| [ Data Mobil * ]     |  +---------------------------------------------+  |
|                      |  |                                             |  |
| [ Data Pelanggan ]   |  |  ID Mobil                                   |  |
|                      |  |  [ M004_______________________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Merk / Model                               |  |
|                      |  |  [ Toyota Avanza______________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Nomor Polisi                               |  |
|                      |  |  [ N 1234 AB__________________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Tarif per Hari                             |  |
|                      |  |  [ Rp ________________________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Status Mobil                               |  |
|                      |  |  [ Pilih Status                  v ]        |  |
|                      |  |                                             |  |
|                      |  |  [ Simpan Data ]  [ Kembali ]               |  |
|                      |  |                                             |  |
|                      |  +---------------------------------------------+  |
|                      |                                                   |
+----------------------+---------------------------------------------------+
```

Keterangan:
- Form diletakkan dalam satu panel agar input mudah dibaca.
- Field meliputi ID Mobil, Merk/Model, Nomor Polisi, Tarif per Hari, dan Status Mobil.
- Tombol Simpan Data dan Kembali ditempatkan pada bagian bawah form.

### D. Wireframe — Daftar Pelanggan (`anggota/list.html`)

```text
+--------------------------------------------------------------------------+
| [ ☰ ]  SISTEM MANAJEMEN RENTAL MOBIL            Selamat Datang, Admin    |
+----------------------+---------------------------------------------------+
| RENTAL MOBIL ADMIN   |                                                   |
|                      |  Data Pelanggan                                  |
| [ Dashboard ]        |  Kelola informasi pelanggan                      |
|                      |                                                   |
| [ Data Mobil ]       |                 [ + Tambah Pelanggan ]            |
|                      |                                                   |
| [ Data Pelanggan * ] |  +---------------------------------------------+  |
|                      |  | ID   | Nama       | Telepon    | Email      |  |
|                      |  |------|------------|------------|------------|  |
|                      |  | P001 | Andi       | 0812xxxx   | andi@...   |  |
|                      |  | P002 | Budi       | 0813xxxx   | budi@...   |  |
|                      |  | P003 | Citra      | 0814xxxx   | citra@...  |  |
|                      |  +---------------------------------------------+  |
|                      |  | Kota       | Aksi                           |  |
|                      |  |------------|--------------------------------|  |
|                      |  | Malang     | [ Edit ] [ Hapus ]             |  |
|                      |  | Surabaya   | [ Edit ] [ Hapus ]             |  |
|                      |  | Batu       | [ Edit ] [ Hapus ]             |  |
|                      |  +---------------------------------------------+  |
|                      |                                                   |
+----------------------+---------------------------------------------------+
```

Keterangan:
- Menu Data Pelanggan ditandai aktif.
- Tabel memuat ID Pelanggan, Nama, Nomor Telepon, Email, Kota, dan Aksi.
- Tombol Tambah Pelanggan dirancang untuk membuka form pelanggan.

*Data pelanggan pada wireframe hanya contoh ilustratif.*

### E. Wireframe — Form Tambah Pelanggan (`anggota/tambah.html`)

```text
+--------------------------------------------------------------------------+
| [ ☰ ]  SISTEM MANAJEMEN RENTAL MOBIL                                     |
+----------------------+---------------------------------------------------+
| RENTAL MOBIL ADMIN   |                                                   |
|                      |  Tambah Pelanggan                                |
| [ Dashboard ]        |  Masukkan informasi pelanggan                    |
|                      |                                                   |
| [ Data Mobil ]       |  +---------------------------------------------+  |
|                      |  |                                             |  |
| [ Data Pelanggan * ] |  |  ID Pelanggan                               |  |
|                      |  |  [ P004_______________________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Nama Lengkap                               |  |
|                      |  |  [ Nama pelanggan_____________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Nomor Telepon                              |  |
|                      |  |  [ 08_______________________________ ]      |  |
|                      |  |                                             |  |
|                      |  |  Email                                      |  |
|                      |  |  [ email@example.com_________________ ]    |  |
|                      |  |                                             |  |
|                      |  |  Kota                                       |  |
|                      |  |  [ Kota tempat tinggal______________ ]     |  |
|                      |  |                                             |  |
|                      |  |  [ Simpan Data ]  [ Kembali ]               |  |
|                      |  |                                             |  |
|                      |  +---------------------------------------------+  |
|                      |                                                   |
+----------------------+---------------------------------------------------+
```

Keterangan:
- Form memuat lima field informasi pelanggan.
- Tombol Simpan Data dirancang untuk menyelesaikan pengisian form.
- Tombol Kembali dirancang untuk kembali ke daftar pelanggan.

## 4. Relasi Navigasi Antarhalaman

```text
                         +------------------+
                         |     Dashboard    |
                         |   index.html     |
                         +--------+---------+
                                  |
                    +-------------+-------------+
                    |                           |
                    v                           v
          +------------------+       +---------------------+
          |    Data Mobil    |       |   Data Pelanggan    |
          |   buku/list.html |       | anggota/list.html   |
          +--------+---------+       +----------+----------+
                   |                            |
                   v                            v
          +------------------+       +---------------------+
          |   Tambah Mobil   |       |  Tambah Pelanggan   |
          | buku/tambah.html|       | anggota/tambah.html |
          +--------+---------+       +----------+----------+
                   |                            |
                   v                            v
          +------------------+       +---------------------+
          | Kembali ke Daftar|       | Kembali ke Daftar   |
          | Mobil            |       | Pelanggan           |
          +------------------+       +---------------------+

    Semua halaman memiliki navigasi sidebar untuk kembali ke Dashboard.
```

## 5. Batasan dan Catatan

1. Jobsheet 04 hanya menghasilkan dokumentasi user flow dan wireframe; tidak ada perubahan pada file website dibandingkan Jobsheet 03.
2. Wireframe merupakan representasi konseptual menggunakan karakter ASCII, bukan tampilan visual final.
3. Tombol Edit, Hapus, dan Simpan Data belum menjamin adanya pemrosesan atau penyimpanan data nyata.
4. Penyimpanan permanen memerlukan backend dan database yang belum menjadi bagian dari tahap ini.
5. Perilaku sidebar pada layar mobile telah direncanakan menggunakan checkbox dan CSS pada Jobsheet 03. Pengembangan JavaScript direncanakan pada Jobsheet 05.
6. Nama file seperti `buku/list.html` dan `anggota/list.html` dipertahankan mengikuti struktur proyek yang digunakan.

## 6. Kesimpulan

Jobsheet 04 mendokumentasikan rancangan alur navigasi dan struktur antarmuka Sistem Manajemen Rental Mobil sebelum pengembangan fitur berikutnya. Wireframe berbasis ASCII membantu menggambarkan posisi elemen antarmuka secara lebih konkret, sedangkan user flow menjelaskan hubungan antarhalaman. Seluruh rancangan ini menjadi acuan untuk pengembangan pada jobsheet selanjutnya tanpa mengubah implementasi website yang sudah ada.
