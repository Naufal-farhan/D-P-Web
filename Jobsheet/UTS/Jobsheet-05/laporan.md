### NAMA : NAUFAL FARHAN NUR RAMADHAN
### NIM : 254107020077
### KELAS : TI-2D

# Laporan Jobsheet 05 — JavaScript untuk Tombol Hamburger

## Tujuan
Menambahkan JavaScript sederhana agar tombol hamburger pada layar mobile membuka dan menutup sidebar navigasi.

## Perubahan dibandingkan Jobsheet 03
- Mengganti kontrol checkbox/label menjadi elemen `<button>` dengan ID `menu-toggle`.
- Menambahkan `assets/js/app.js` dan menghubungkannya ke seluruh halaman.
- Menggunakan `addEventListener('click', ...)` untuk merespons klik.
- Menambah atau menghapus class `active` pada sidebar dan overlay.
- Menutup menu ketika overlay ditekan, ketika pengguna menekan tombol Escape, atau ketika salah satu tautan navigasi dipilih.
- Memperbarui atribut aksesibilitas `aria-expanded` dan `aria-label` sesuai kondisi menu.

## Konsep JavaScript yang dipelajari
`DOMContentLoaded`, `getElementById`, pemeriksaan elemen, fungsi, event listener, `classList.add/remove/contains`, `setAttribute`, dan event keyboard.

## Batasan tahap ini
JavaScript hanya digunakan untuk interaksi menu. Data mobil dan pelanggan masih ditulis langsung dalam HTML, tombol Edit/Hapus belum memproses data, dan form belum terhubung ke backend atau database. Pengolahan data lebih lanjut dapat menjadi materi tahap berikutnya.

## Cara menguji
Buka `index.html` melalui browser dengan lebar layar mobile. Klik hamburger untuk membuka sidebar; klik hamburger atau area overlay untuk menutupnya. Pastikan menu juga tertutup saat tombol Escape ditekan atau tautan navigasi dipilih.
