# 🎨 Handbook 3: Bedah Teknikal CSS3, Layouting & Responsive Design

Handbook ini mengulas **seluruh aturan CSS, konsep Box Model, kalkulasi layout, serta penggunaan Flexbox dan CSS Grid**.

---

## 1. CSS Reset & Global Box Model

Setiap browser memiliki margin/padding default yang berbeda. Oleh karena itu, kita wajib melakukan penyesuaian dasar di bagian paling atas `assets/css/style.css`:

```css
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
```

### Penjelasan Matematika `box-sizing: border-box`:
Secara default (`content-box`), perhitungan total lebar elemen adalah:
$$\text{Total Width} = \text{width} + \text{padding-left} + \text{padding-right} + \text{border-left} + \text{border-right}$$

Dengan `box-sizing: border-box`, `padding` dan `border` diserap ke dalam ukuran `width` elemen:
$$\text{Total Width} = \text{width (tetap sesuai deklarasi)}$$
Hal ini mencegah kontainer pecah atau bergeser keluar layar saat ditambahi padding.

---

## 2. Penguasaan Layout: Flexbox vs CSS Grid

Website ini memadukan **Flexbox** (untuk layout 1-dimensi) dan **CSS Grid** (untuk layout 2-dimensi).

### A. CSS Flexbox (1-Dimension)
Digunakan untuk menyejajarkan elemen dalam satu baris atau satu kolom (misal: `.topbar`, `.form-actions`, `.nav-menu`).

```css
.topbar {
  display: flex;
  justify-content: space-between; /* Komponen kiri dan kanan saling terpisah jauh */
  align-items: center;            /* Menyejajarkan posisi komponen secara vertikal */
  height: 60px;
  padding: 0 20px;
  background-color: #ffffff;
  border-bottom: 1px solid #e2e8f0;
}
```

### B. CSS Grid (2-Dimension)
Digunakan untuk mengatur susunan kartu statistik pada Dashboard (`index.html`).

```css
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  margin-bottom: 25px;
}
```

#### Bedah Fungsi `repeat(auto-fit, minmax(220px, 1fr))`:
- **`220px`**: Ukuran lebar minimum sebuah kartu.
- **`1fr` (Fractional Unit)**: Kartu akan membesar secara proporsional mengisi sisa ruang yang ada.
- **`auto-fit`**: Browser secara otomatis menghitung berapa jumlah kolom yang muat dalam layar. Jika layar menyempit, kolom berkurang secara otomatis.

---

## 3. Position, Z-Index & Dimension Offset

Pengaturan tata letak fixed sidebar dan main wrapper menggunakan perhitungan matematika CSS:

```css
/* Sidebar menetap di kiri */
.sidebar {
  width: 240px;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  background-color: #1e293b;
  z-index: 100;
}

/* Wrapper utama tergeser sejauh lebar sidebar */
.main-wrapper {
  margin-left: 240px;
  width: calc(100% - 240px);
  min-height: 100vh;
  background-color: #f4f6f9;
}
```

- **`position: fixed`**: Elemen dilepas dari alur normal dokumen dan dikunci pada koordinat viewport (`top: 0`, `left: 0`).
- **`margin-left: 240px`**: Memberikan jarak kosong di sebelah kiri agar konten utama tidak tertutup oleh sidebar.
- **`calc(100% - 240px)`**: Mengkalkulasi lebar sisa area utama secara tepat.

---

## 4. Media Query & Responsif Mobile

Potongan kode CSS responsif untuk menangani perangkat smartphone ($\le 768\text{px}$):

```css
@media screen and (max-width: 768px) {
  /* Sembunyikan sidebar ke luar layar kiri */
  .sidebar {
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
  }

  /* Munculkan sidebar saat diberi class active via JS */
  .sidebar.active {
    transform: translateX(0);
  }

  /* Content wrapper mengambil 100% layar HP */
  .main-wrapper {
    margin-left: 0 !important;
    width: 100% !important;
  }

  /* Munculkan tombol Hamburger */
  .menu-toggle {
    display: block;
  }
}
```

### Mengapa Memakai `transform: translateX()` Bukan `left: -240px`?
Penggunaan `transform` diproses oleh **GPU (Graphics Processing Unit)** browser, sehingga animasi pergeseran sidebar terasa sangat mulus ($60\text{ fps}$) dibanding mengubah properti `left` yang memicu pemprosesan ulang layout (*reflow*) oleh CPU.

---

## ❓ Simulasi Pertanyaan Dosen & Cara Menjawabnya

### Q1: "Kapan kita harus memakai CSS Flexbox dan kapan memakai CSS Grid?"
> **Jawaban:** "CSS Flexbox digunakan untuk layout satu dimensi (sejajar secara baris ATAU kolom saja), seperti merapikan baris Topbar atau tombol Form. Sedangkan CSS Grid digunakan untuk layout dua dimensi (baris DAN kolom sekaligus), seperti susunan kartu statistik pada Dashboard."

### Q2: "Apa kegunaan fungsi `calc()` dalam CSS kamu?"
> **Jawaban:** "Fungsi `calc()` digunakan untuk melakukan perhitungan matematis dinamis. Pada project ini, `width: calc(100% - 240px)` memastikan area konten selalu berukuran $100\%$ dikurangi $240\text{px}$ (lebar sidebar), sehingga tidak terjadi overflow horizontal pada layar PC."

### Q3: "Bagaimana cara kerja kelas `.sidebar.active` saat tampilan mobile?"
> **Jawaban:** "Secara default di layar mobile ($\le 768\text{px}$), sidebar memiliki `transform: translateX(-100%)` yang menggesernya ke luar layar kiri. Saat tombol hamburger diklik, JavaScript menambahkan class `.active` yang mengubahnya menjadi `transform: translateX(0)`, sehingga sidebar bergeser masuk kembali ke dalam layar."