# Laporan Jobsheet 0-1
### NAMA    : NAUFAL FARHAN NUR RAMADHAN
### NIM     : 254107020077
### KELAS   : TI-2D

preview tampilan web : 

<img width="586" height="441" alt="image" src="https://github.com/user-attachments/assets/49b9a0e5-9c26-4575-b2b6-a1ee751e1939" />

index

<img width="511" height="376" alt="image" src="https://github.com/user-attachments/assets/8e6ab7f9-a52d-4292-bb30-a56a257727be" />

daftar buku

<img width="556" height="293" alt="image" src="https://github.com/user-attachments/assets/dd404231-b9bf-4201-92e5-3b9b2a42e97a" />

daftar anggota

<img width="481" height="457" alt="image" src="https://github.com/user-attachments/assets/6c740f32-3042-46ab-b6f6-cdc4016ffbde" />

tambah anggota

## Rangkuman dan Penjelasan

<img width="259" height="164" alt="image" src="https://github.com/user-attachments/assets/e6fe6eed-5de9-4df4-b55a-02ee0c464187" />

  pada jobsheet pertama ini kita diperkenalkan dengan html, yang mana Html diperlukan untuk membuat web, semua file html pada jobsheet kali ini ditulis dengan kerangka yang sama, yakni diawali dengan doctype html, yang mana untuk menunjukan bahwa file ini adalah html, lalu menuliskan tag default atau standar kerangka seperti html, head, body

  ```html
<header>
        <h1>SIMPUS-MINI</h1>
        <nav>
            <ul>
                <li><a href="index.html">Beranda</a></li>
                <li><a href="buku/list.html">Daftar Buku</a></li>
                <li><a href="buku/tambah.html">Tambah Buku</a></li>
                <li><a href="anggota/list.html">Daftar Anggota</a></li>
                <li><a href="anggota/tambah.html">Tambah Anggota</a></li>
            </ul>
        </nav>
    </header>
```

lalu kita membuat tag header dan mengisi nya dengan navigasi yang mengarah ke halaman yang lain (ini ditulis di tiap file), jika diperhatikan di tiap baris navigasi, terdapat kode yang mengarah ke directory file yang berbeda, sesuai dengan file yang ingin di tuju.

```html
<section>
    <h2>Ringkasan</h2>
    <article>
        <h3>Total Buku</h3>
        <p>12</p>
    </article>
    <article>
        <h3>Total Anggota</h3>
        <p>8</p>
    </article>
    <article>
        <h3>Sedang Dipinjam</h3>
        <p>3</p>
    </article>
</section>
```
lalu disini ada section yang berisi konten dari file index ini, yang mana berisi ringkasan seperti total buku, total anggota, buku yang sedang dipinjam

```html
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Laskar Pelangi</td>
            <td>Andrea Hirata</td>
            <td>2005</td>
            <td>4</td>
            <td>
                <button type="button">Edit</button>
                <button type="button">Hapus</button>
            </td>
        </tr>
        <!-- ... 4 baris lain dengan pola yang sama ... -->
    </tbody>
</table>
```
lalu kita membuat table pada file list buku untuk menampilkan list buku yang ada di sistem perpustakaan digital ini, dengan thead yang berada di baris paling atas, dengan kolom kolom berbeda, lalu selanjutnya pada tbody berisikan baris baris tabel yang mengandung informasi buku seperti contoh nya judul, tahun terbit, stok dll
  
## Ide Latihan Tambahan (Opsional)
### Untuk memperdalam pemahaman, coba lakukan sendiri (tidak wajib, tapi sangat disarankan untuk latihan):

### 1.Lengkapi konsistensi menu — tambahkan tautan "Daftar Anggota" dan "Tambah Anggota" ke menu <nav> di index.html, buku/list.html, dan buku/tambah.html (lihat catatan di dokumentasi anggota/list.html §5.4).
<img width="225" height="134" alt="image" src="https://github.com/user-attachments/assets/c7520c6b-8a52-4bd4-85cf-6973856a3f35" />
berikut tampilan menu navigasi di tiap file


### 2.Tambah 2 baris data buku baru di buku/list.html dengan meng-copy satu blok <tr>...</tr> lalu mengganti isinya.
<img width="427" height="173" alt="image" src="https://github.com/user-attachments/assets/7bdcff9d-2237-40bf-a7ba-85f6202b27bd" />


### 3.Tambah kolom baru di tabel anggota, misalnya "Tanggal Bergabung", lengkap dengan <th> dan <td>-nya di setiap baris.
<img width="542" height="92" alt="image" src="https://github.com/user-attachments/assets/e0c4eb73-2632-46fc-ae99-b021f5964beb" />

### 4.Tambah field baru di form tambah anggota, misalnya "Email" memakai <input type="email"> (type="email" otomatis memvalidasi format alamat email tanpa perlu JavaScript tambahan).
<img width="542" height="92" alt="image" src="https://github.com/user-attachments/assets/dce092c5-5bae-4613-8b5f-19ebab4db8bd" />
