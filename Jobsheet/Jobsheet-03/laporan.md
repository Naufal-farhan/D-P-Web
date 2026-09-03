# Laporan Jobsheet-03
### NAMA    : NAUFAL FARHAN NUR RAMADHAN
### NIM     : 254107020077
### KELAS   : TI-2D

Tampilan indeks (mobile)

<img width="923" height="455" alt="image" src="https://github.com/user-attachments/assets/84fd7ae5-67a6-4414-9085-d3d4403bd8b3" />

Tampilan List Buku (mobile)

<img width="914" height="448" alt="image" src="https://github.com/user-attachments/assets/6e0db50d-1a32-4cb7-afe5-bb3d6734f137" />

Tampilan form(mobile)

<img width="921" height="449" alt="image" src="https://github.com/user-attachments/assets/b3bb86f5-b28e-486b-8188-bb0fae2827af" />

## Rangkuman dan Laporan
  Pada Jobsheet kali ini kita membuat atau memodifikasi css agar bisa responsif menyesuaikan perangkat user dengan metode breakpoint dengan memfilterisasi resolusi layar pengguna, pada jobsheet kali ini terdapat dua break point yang pertama ada untuk desktop yaitu @media (max-width: 768px) dan untuk mobile @media (max-width: 480px){

<img width="272" height="176" alt="image" src="https://github.com/user-attachments/assets/2974bab4-a88d-4ddd-a7f8-fd4dcd42e7a9" />
<img width="344" height="178" alt="image" src="https://github.com/user-attachments/assets/69c2542d-fef0-4240-b182-f82fd91d535f" />

pada Jobsheet kali ini juga kita membuat tombol untuk mobile(di desktop tidak terlihat) agar kita bisa merampingkan menu navigasi, bisa dilihat di gambar, ketika kita menekan icon burger maka terbuka lah menu navigasi yang menjadi link untuk mengarah ke file lain.

## 6.4 Ide Latihan Tambahan (Opsional)

1. **Tambah breakpoint baru** — misalnya `@media (min-width: 1400px)`
   untuk layar monitor sangat lebar, ubah `main { max-width: 1000px; }`
   (dari [dokumentasi jobsheet-02](../../jobsheet-02/Dokumentasi/05-css-main-dan-section.md#52-membatasi-lebar--menengahkan-konten-main))menjadi lebih lebar khusus di breakpoint ini.

   Berikut adalah preview dua tampilan di resolusi yang sama dengan gambar pertama menggunakan breakpoint monitor besar
<img width="959" height="476" alt="image" src="https://github.com/user-attachments/assets/cf3e8540-7b9b-4fb8-a7c1-9ccce9e10c1b" /><img width="959" height="473" alt="image" src="https://github.com/user-attachments/assets/d7a4d12e-7433-4fc3-8242-1c84a486a98a" />

3. **Ubah breakpoint tablet** dari `768px` menjadi `900px`, lalu amati
   di lebar layar berapa susunan kartu berubah — buktikan bahwa breakpoint
   memang bisa disesuaikan bebas sesuai kebutuhan desain.
4. **Terapkan pola `table-responsive`** ke elemen lain yang berpotensi
   melebar di layar sempit, misalnya kalau suatu saat kamu menambahkan
   blok kode `<pre>` yang panjang di salah satu halaman.
5. **Ubah posisi ikon hamburger** — misalnya pindahkan `.nav-toggle-label`
   ke urutan terakhir di `<header>` (setelah `<nav>`) lalu amati apakah
   sibling combinator `.nav-toggle:checked ~ nav` di
   [bab 3 §3.5](03-css-hamburger-checkbox-hack.md#35-langkah-4--sibling-combinator-menghubungkan-status-ke-nav)
   masih bekerja — ingat catatan bahwa combinator `~` mensyaratkan
   target berada **setelah** elemen sumbernya di HTML.
6. **Bandingkan dengan pendekatan mobile-first** — coba tulis ulang
   `style.css` dari nol memakai `@media (min-width: ...)` alih-alih
   `max-width`, dan rasakan sendiri bedanya alur berpikirnya.



