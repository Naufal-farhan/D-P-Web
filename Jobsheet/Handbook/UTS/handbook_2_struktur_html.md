# 📄 Handbook 2: Bedah Struktur & Semantik HTML5

Handbook ini membahas secara detail **penggunaan elemen semantik HTML5, hirarki dokumen, bentuk form, serta teknik relative pathing** yang digunakan dalam project.

---

## 1. Penggunaan Elemen Semantik HTML5

Menggunakan elemen semantik memberikan makna struktural pada dokumen web, bukan sekadar menggunakan tag `<div>` untuk semua hal.

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Rental Mobil</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Semantic <aside>: Menandakan area navigasi samping (Sidebar) -->
  <aside class="sidebar">
    <div class="brand">
      <h2>RentalMobil</h2>
    </div>
    <!-- Semantic <nav>: Menandakan kumpulan link navigasi utama -->
    <nav class="nav-menu">
      <a href="index.html" class="nav-item active">Dashboard</a>
      <a href="buku/list.html" class="nav-item">Data Mobil</a>
      <a href="anggota/list.html" class="nav-item">Data Pelanggan</a>
    </nav>
  </aside>

  <div class="main-wrapper">
    <!-- Semantic <header>: Bagian atas halaman yang berisi bar informasi & toggle -->
    <header class="topbar">
      <button class="menu-toggle" id="menu-toggle">☰</button>
      <div class="title">Sistem Manajemen Rental Mobil</div>
      <div class="user-info">Selamat Datang, <strong>Admin Staff</strong></div>
    </header>

    <!-- Semantic <main>: Konten utama yang unik untuk halaman ini -->
    <main class="content-body">
      <!-- Isi Konten Spesifik Halaman -->
    </main>
  </div>
</body>
</html>
```

---

## 2. Bedah Komponen Tabel Data (`buku/list.html` & `anggota/list.html`)

Tabel digunakan untuk menampilkan data terstruktur. Berikut adalah potongan kode tabel pada `buku/list.html`:

```html
<div class="card">
  <div class="card-header">
    <h3>Daftar Armada Mobil</h3>
    <a href="tambah.html" class="btn btn-primary">+ Tambah Mobil</a>
  </div>
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>ID Mobil</th>
          <th>Merk / Type</th>
          <th>Plat Nomor</th>
          <th>Tarif / Hari</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <!-- Element <tbody> dikosongkan sengaja! -->
      <tbody id="list-buku">
        <!-- Baris data <tr>...</tr> akan dimasukkan oleh JS via Fetch API -->
      </tbody>
    </table>
  </div>
</div>
```

### Poin Penting untuk Dijelaskan:
- **`<tbody>` Kosong:** Dikosongkan karena data di-generate secara dinamis menggunakan JavaScript yang membaca data dari `data/buku.json`.
- **Atribut `id="list-buku"`:** Berfungsi sebagai *target injection point* bagi JavaScript DOM Manipulation.

---

## 3. Bedah Form Input Data (`buku/tambah.html` & `anggota/tambah.html`)

Form dirancang dengan standar aksesibilitas dan validasi bawaan HTML5:

```html
<form id="form-tambah-buku">
  <div class="form-group">
    <label for="id_mobil">ID Mobil</label>
    <input type="text" id="id_mobil" name="id_mobil" placeholder="Contoh: MBL-016" required>
  </div>

  <div class="form-group">
    <label for="tarif">Tarif Per Hari (Rp)</label>
    <input type="number" id="tarif" name="tarif" placeholder="350000" min="0" required>
  </div>

  <div class="form-group">
    <label for="status">Status Awal</label>
    <select id="status" name="status" required>
      <option value="Tersedia">Tersedia</option>
      <option value="Disewa">Disewa</option>
      <option value="Perbaikan">Perbaikan</option>
    </select>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <a href="list.html" class="btn btn-secondary">Batal</a>
  </div>
</form>
```

### Elemen Penting pada Form:
1. **Atribut `for` pada `<label>` & `id` pada `<input>`:** Menghubungkan label dengan field input. Jika label diklik, kursor otomatis fokus ke dalam field input tersebut.
2. **Atribut `required`:** Melakukan validasi langsung di browser. Form tidak bisa di-submit jika field ini kosong.
3. **`type="number"` & `min="0"`:** Mencegah input berupa karakter teks atau nilai minus pada kolom harga/tarif.

---

## 4. Konsep Relative Pathing (Jalur Berkas)

Pemahaman terhadap lokasi file sangat krusial saat berpindah antar halaman:

- **Halaman `index.html` (Di folder utama/root):**
  - Mengakses CSS: `href="assets/css/style.css"`
  - Mengakses JS: `src="assets/js/app.js"`
- **Halaman `buku/list.html` (Di dalam subfolder `buku/`):**
  - Mengakses CSS: `href="../assets/css/style.css"`
  - Mengakses JS: `src="../assets/js/buku.js"`
  - **Penjelasan Notasi `../`:** Berarti "naik satu tingkat keluar dari folder saat ini (`buku/`)" sebelum masuk ke folder `assets/`.

---

## ❓ Simulasi Pertanyaan Dosen & Cara Menjawabnya

### Q1: "Mengapa kamu menggunakan tag `<aside>` dan `<main>`, kenapa tidak pakai `<div>` saja?"
> **Jawaban:** "Tag `<aside>` dan `<main>` adalah tag semantik HTML5. Menggunakannya memberikan informasi struktur yang bermakna bagi *search engine* (SEO) dan alat pembaca layar (*screen reader* bagi penderita disabilitas netra), dibanding tag `<div>` yang tidak memiliki makna semantik."

### Q2: "Apa bedanya elemen `<thead>` dan `<tbody>` pada tabel?"
> **Jawaban:** "`<thead>` digunakan untuk membungkus baris judul kolom (*header*) tabel yang bersifat statis, sedangkan `<tbody>` membungkus baris data utama. Pada project ini, `<tbody>` kita biarkan kosong di HTML karena isinya akan disuntikkan secara dinamis dari file JSON oleh JavaScript."

### Q3: "Mengapa pada input nomor telepon di form pelanggan digunakan `type="tel"` bukannya `type="text"`?"
> **Jawaban:** "Penggunaan `type="tel"` memberikan *user experience* yang lebih baik pada pengguna smartphone, karena browser akan otomatis memunculkan keyboard khusus angka (numpad) saat kolom tersebut diklik."