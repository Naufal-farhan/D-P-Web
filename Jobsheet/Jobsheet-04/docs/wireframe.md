# Jobsheet-04
## WireFrame & User Flow
Halaman yang sudah ada (Beranda, Daftar/Tambah Buku, Daftar/Tambah Anggota — Jobsheet 1-3) belum mencakup fitur Login, Dashboard Petugas, dan Peminjaman/Pengembalian. Dokumen ini merancang wireframe untuk halaman-halaman tersebut sebelum diimplementasikan mulai Jobsheet 5 dan seterusnya.

## Aktor
T amu: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
Petugas: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman.

## User Flow - Pinjam Buku
```
[petugas login] -> [Dashboard] -> [pilih menu "Tambah Peminjaman"]
    -> [Pilih Anggota] -> [pilih Buku (Stok > 0 )]
    -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]
```

## User Flow - Pengembalian Buku
```
[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
        -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
        -> [Kembali ke Dashboard]
```

## Wireframe : Halaman Login
```
+----------------------------------------------+
|             Sistem Perpus Digital            |
|----------------------------------------------|
|                                              |
|              [ Login Petugas ]               |
|      user : |_________________|              |
|  Password : |_________________|              |
|                                              |
|                  [ Masuk ]                   |
|                                              |
|    Belum Punya Akun ?, Daftar Disini         |
+----------------------------------------------+


## WireFrame Dashboard Petugas
+--------------------------------------------------------------------+
| Simpus Mini |       Beranda | Buku | Anggota | Peminjaman | Logout |
|--------------------------------------------------------------------|
|    [Total Buku]        [ Total Anggota ]       [ Total Dipinjam]   |
|                                                                    |
|      Aksi Cepat :                                                  |
|          [ +Peminjaman Baru ]   [ +Pengembalian ]                  |
|                                                                    |
|      Transaksi Terbaru                                             |
| ------------------------------------------------------------------ |
|    Anggota | Buku | Tgl Pinjam | Status                            |
+--------------------------------------------------------------------+
```
## WireFrame : Form Peminjaman
```
+--------------------------------------+
|         Form Peminjaman Buku         |
|--------------------------------------|
|  Anggota : [ dropdown pilih anggota ]|
|  Buku    : [ dropdown, hanya stok>0 ]|
|  Tanggal Pinjam : [ auto: hari ini ] |
|                                      |
|       [  Simpan Peminjaman  ]        |
+--------------------------------------+
```

## WireFrame : Form Pengembalian
```
+----------------------------------------------+
|              Pengembalian Buku               |
|----------------------------------------------|
|  Cari transaksi aktif:                       |
|  [ nama anggota / judul buku ______ ]        |
|                                              |
|  Anggota | Buku | Tgl Pinjam | [Kembalikan]  |
+----------------------------------------------+
```

## WireFrame : Riwayat Peminjaman per Anggota
```
+--------------------------------------------------------+
|  Riwayat Peminjaman — Siti Aminah                      |
|--------------------------------------------------------|
|  Buku              | Pinjam   | Kembali | Status       |
|  Laskar Pelangi    | 01/07    | 10/07   | Selesai      |
|  Bumi Manusia      | 15/07    | -       | Dipinjam     |
+--------------------------------------------------------+
```

