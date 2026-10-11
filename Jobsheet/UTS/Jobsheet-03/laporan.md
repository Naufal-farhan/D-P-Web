### NAMA : NAUFAL FARHAN NUR RAMADHAN
### NIM : 254107020077
### KELAS : TI-2D

# Laporan Jobsheet 03 — Responsive Web Design

## Tujuan
Meningkatkan tampilan Jobsheet 02 supaya lebih nyaman digunakan di desktop, tablet, dan ponsel.

## Perubahan yang dilakukan
- Menambahkan media query untuk beberapa ukuran layar.
- Mengubah sidebar menjadi menu off-canvas pada layar kecil.
- Menampilkan ikon hamburger hanya ketika layar masuk ke breakpoint mobile.
- Membuat kartu statistik berubah dari empat kolom menjadi dua kolom, lalu satu kolom pada layar yang sangat sempit.
- Membungkus tabel dalam `.table-responsive` agar dapat digeser horizontal di ponsel.
- Menyusun form menjadi satu kolom di layar sempit.

## Hamburger tanpa JavaScript
Pada tahap ini, kontrol menu memakai checkbox tersembunyi dan `<label>` yang terhubung melalui atribut `for`. Selector CSS `:checked` menampilkan sidebar ketika checkbox dicentang. Dengan begitu, interaksi menu dasar dapat dipelajari sebelum menggunakan JavaScript.

## Konsep yang dipelajari
Responsive design, viewport meta tag, media query (`max-width`), breakpoint, `transform`, `transition`, Grid responsif, dan overflow horizontal.

## Cara menguji
Uji halaman pada lebar desktop, tablet, dan ponsel melalui Developer Tools browser. Pada layar kecil, tekan ikon hamburger untuk membuka menu, tekan area gelap untuk menutupnya, dan geser tabel ke samping bila kolom tidak muat.
