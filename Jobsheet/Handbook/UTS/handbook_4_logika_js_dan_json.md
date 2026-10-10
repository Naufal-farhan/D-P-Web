# ⚡ Handbook 4: Bedah JavaScript Asynchronous, Fetch API & JSON Data

Handbook ini menjelaskan **pemrosesan data JSON, manipulasi DOM, pemanggilan Fetch API, dan penanganan event listeners**.

---

## 1. Konsep Data JSON (JavaScript Object Notation)

Data diletakkan terpisah di dalam file `data/buku.json` dan `data/anggota.json`.

Contoh struktur `data/buku.json`:
```json
[
  {
    "id": "MBL-001",
    "merk": "Toyota Avanza Veloz",
    "plat": "N 1234 AB",
    "tarif": 350000,
    "status": "Tersedia"
  },
  {
    "id": "MBL-002",
    "merk": "Mitsubishi Xpander Ultimate",
    "plat": "N 5678 CD",
    "tarif": 400000,
    "status": "Disewa"
  }
]
```

---

## 2. Bedah Kode `assets/js/app.js` (Dashboard & Statistik)

File ini bertugas menghitung statistik secara otomatis dari data JSON dan mengontrol tombol sidebar mobile.

```javascript
document.addEventListener('DOMContentLoaded', () => {
  
  // 1. Logika Toggle Hamburger Menu Mobile
  const menuToggle = document.getElementById('menu-toggle');
  const sidebar = document.querySelector('.sidebar');

  if (menuToggle && sidebar) {
    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
  }

  // 2. Fetch Data Mobil & Hitung Statistik
  fetch('data/buku.json')
    .then(response => {
      if (!response.ok) throw new Error('Gagal mengambil data mobil');
      return response.json(); // Mengonversi response stream menjadi Objek JavaScript
    })
    .then(dataMobil => {
      // Ambil elemen DOM
      const totalEl = document.getElementById('total-mobil');
      const disewaEl = document.getElementById('mobil-disewa');
      const maintenanceEl = document.getElementById('mobil-maintenance');
      const siapEl = document.getElementById('mobil-siap');

      // Manipulasi TextContent
      if (totalEl) totalEl.textContent = dataMobil.length;

      // Hitung berdasarkan kriteria status dengan .filter()
      if (disewaEl) {
        disewaEl.textContent = dataMobil.filter(m => m.status === 'Disewa').length;
      }
      if (maintenanceEl) {
        maintenanceEl.textContent = dataMobil.filter(m => m.status === 'Perbaikan' || m.status === 'Maintenance').length;
      }
      if (siapEl) {
        siapEl.textContent = dataMobil.filter(m => m.status === 'Tersedia').length;
      }
    })
    .catch(error => console.error('Error statistik:', error));
});
```

---

## 3. Bedah Kode `assets/js/buku.js` (Render Tabel & Template Literals)

File ini bertugas membaca `data/buku.json` dan menyuntikkan baris tabel secara dinamis:

```javascript
document.addEventListener('DOMContentLoaded', () => {
  const listBuku = document.getElementById('list-buku');

  if (listBuku) {
    fetch('../data/buku.json')
      .then(response => response.json())
      .then(data => {
        // Melakukan iterasi array menggunakan .map()
        listBuku.innerHTML = data.map(item => {
          // Menentukan badge warna status
          let badgeClass = 'badge-success';
          if (item.status === 'Disewa') badgeClass = 'badge-warning';
          if (item.status === 'Perbaikan') badgeClass = 'badge-danger';

          return `
            <tr>
              <td><strong>${item.id}</strong></td>
              <td>${item.merk}</td>
              <td>${item.plat}</td>
              <td>Rp ${Number(item.tarif).toLocaleString('id-ID')}</td>
              <td><span class="badge ${badgeClass}">${item.status}</span></td>
              <td>
                <button class="btn btn-warning btn-sm" onclick="alert('Edit ${item.id}')">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="alert('Hapus ${item.id}')">Hapus</button>
              </td>
            </tr>
          `;
        }).join(''); // Menggabungkan array string menjadi 1 string utuh
      })
      .catch(err => {
        listBuku.innerHTML = '<tr><td colspan="6" style="text-align:center;">Gagal memuat data.</td></tr>';
      });
  }
});
```

---

## 4. Alur Kerja Asynchronous JavaScript (Fetch API)

Alur pemrosesan data pada JavaScript diilustrasikan sebagai berikut:

```text
[ Browser Request ] 
       │
       ▼
[ fetch('data/buku.json') ]  ──( Asynchronous Pending )──>  [ Server / Storage ]
       │                                                            │
       │ <───────────────── Response Header OK (200) ───────────────┘
       ▼
[ .then(res => res.json()) ] ──( Parsing String JSON ke JS Array )
       │
       ▼
[ .then(data => { ... }) ]   ──( Iterasi .map() & Inject DOM ke <tbody> )
       │
       ▼
[ .catch(err => { ... }) ]   ──( Penanganan Error jika File Hilang/Rusak )
```

### Penjelasan Metode Penting JavaScript:
1. **`document.addEventListener('DOMContentLoaded', ...)`**: Menjamin kode JS baru dieksekusi setelah seluruh struktur dokumen HTML selesai dimuat oleh browser.
2. **`fetch()`**: Fungsi bawaan JS untuk mengambil resource data dari server/file lokal secara *asynchronous* (tanpa memuat ulang/refresh seluruh halaman).
3. **`.map()`**: Fungsi array untuk mengubah sekumpulan data objek menjadi sekumpulan string tag HTML (`<tr>...</tr>`).
4. **`.toLocaleString('id-ID')`**: Mengubah format angka mentah (misal: `350000`) menjadi format mata uang Rupiah Indonesia (`350.000`).

---

## ❓ Simulasi Pertanyaan Dosen & Cara Menjawabnya

### Q1: "Mengapa kamu menggunakan `fetch()` daripada menuliskan data langsung di HTML?"
> **Jawaban:** "Penggunaan `fetch()` memisahkan antara layer tampilan (HTML) dan layer data (JSON). Dengan metode ini, jika ada perubahan data unit mobil atau pelanggan, kita cukup memperbarui file JSON-nya saja tanpa perlu menyunting kode HTML-nya."

### Q2: "Apa fungsi dari `.then()` dan `.catch()` pada panggilan Fetch API?"
> **Jawaban:** "`fetch()` mengembalikan objek `Promise`. Properti `.then()` digunakan untuk menangani hasil kondisi *fulfilled* (berhasil mengambil data), sedangkan `.catch()` berfungsi untuk menangani kondisi *rejected* (terjadi kesalahan jaringan atau file tidak ditemukan) agar aplikasi tidak *crash*."

### Q3: "Mengapa ada fungsi `.join('')` di akhir `.map()` saat merender tabel?"
> **Jawaban:** "Fungsi `.map()` mengembalikan hasil berupa Array. Jika tidak diberi `.join('')`, JavaScript akan mengubah array tersebut menjadi string dengan pemisah tanda koma (`,`), yang nantinya akan muncul secara acak di dalam tabel. `.join('')` menggabungkan seluruh elemen array menjadi satu string HTML murni yang bersih."