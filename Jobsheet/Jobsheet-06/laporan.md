# Laporan Jobsheet-06 JavaScript, AJAX, & JSON
### NAMA    : NAUFAL FARHAN NUR RAMADHAN
### NIM     : 254107020077
### KELAS   : TI-2D

<!-- [CATATAN UNTUK SCREENSHOT: Silakan letakkan link/path screenshot tampilan halaman Daftar Buku saat data berhasil dimuat via fetch] -->
<img width="959" height="470" alt="image" src="https://github.com/user-attachments/assets/3178fc9a-36a8-4f93-9a72-e7c736e347e3" />


<!-- [CATATAN UNTUK SCREENSHOT: Silakan letakkan link/path screenshot tampilan halaman Daftar Anggota] -->
<img width="959" height="473" alt="image" src="https://github.com/user-attachments/assets/72035e86-d72a-4cf8-bbe9-1197afe429d8" />


<!-- [CATATAN UNTUK SCREENSHOT: Silakan letakkan link/path screenshot fitur pencarian real-time pada tabel] -->
<img width="959" height="204" alt="image" src="https://github.com/user-attachments/assets/ea0ec979-3aa5-447b-ab56-12f7b878a5c5" />


## Rangkuman dan Penjelasan

Pada Jobsheet-06 ini, sistem SIMPUS-Mini dikembangkan lebih lanjut dari sisi fungsionalitas JavaScript-nya. Jika pada jobsheet sebelumnya data masih bersifat statis di dalam markup HTML, pada jobsheet ini data buku dan anggota dipisahkan ke dalam format data eksternal JSON (`buku.json` dan `anggota.json`) dan dimuat secara asinkron (asynchronous) menggunakan Fetch API, Promise, serta Async/Await.

Berikut adalah penjelasan detail mengenai komponen-komponen utama yang diimplementasikan:

### 1. Pengambilan Data Asinkron Menggunakan fetch dan async/await

Untuk mengambil data dari file JSON tanpa memuat ulang (reload) seluruh halaman, digunakan fungsi asinkron di dalam file `assets/js/buku.js` dan `assets/js/anggota.js`:

    async function muatDaftarBuku() {
        const tbody = document.querySelector(".table-responsive table tbody");
        const loading = document.getElementById("loading-indicator");
        if (!tbody) return;

        loading.style.display = "block";
        tbody.innerHTML = "";

        try {
            // Simulasi delay jaringan agar indikator loading terlihat
            await new Promise((resolve) => setTimeout(resolve, 600));

            const res = await fetch("../data/buku.json");
            if (!res.ok) {
                throw new Error("Gagal mengambil data (status " + res.status + ")");
            }
            const daftarBuku = await res.json();
            ...

Penjelasan:
- async/await: Membuat kode asinkron terbaca secara sekuensial (seperti kode sinkron). Keyword `await` menghentikan eksekusi baris berikutnya hingga Promise dari `fetch()` atau `setTimeout()` selesai diproses (resolved).
- fetch(): Melakukan permintaan HTTP untuk mengambil file sumber data JSON (`buku.json` atau `anggota.json`).
- try...catch...finally: Blok `try` menangani proses sukses, `catch` menangkap error jika terjadi kegagalan jaringan atau file, dan `finally` memastikan indikator loading (`loading-indicator`) disembunyikan kembali dalam kondisi apapun.

### 2. Struktur Data JSON

Data aplikasi kini terpusat dalam format JSON (JavaScript Object Notation). Contoh isi dari file `data/buku.json`:

    [
        { "judul": "Laskar Pelangi", "pengarang": "Andrea Hirata", "tahun": 2005, "stok": 4 },
        { "judul": "Bumi Manusia", "pengarang": "Pramoedya Ananta Toer", "tahun": 1980, "stok": 2 }
    ]

Serta file `data/anggota.json`:

    [
        { "no_anggota": "A001", "nama": "Siti Aminah", "alamat": "Malang", "no_hp": "0812xxxx" },
        { "no_anggota": "A002", "nama": "Budi Santoso", "alamat": "Batu", "no_hp": "0813xxxx" }
    ]

Pemisahan ini membuat arsitektur aplikasi lebih modular karena struktur tampilan (HTML) terpisah dari sumber data (JSON).

### 3. Render DOM Secara Dinamis

Setelah data JSON berhasil diurai menjadi objek JavaScript melalui `.json()`, program melakukan iterasi menggunakan `.forEach()` untuk merender elemen baris tabel (`<tr>`) secara dinamis dan memasukkannya ke dalam `<tbody>`:

    daftarBuku.forEach(function (buku) {
        const tr = document.createElement("tr");
        tr.innerHTML =
            "<td>" + buku.judul + "</td>" +
            "<td>" + buku.pengarang + "</td>" +
            "<td>" + buku.tahun + "</td>" +
            "<td>" + buku.stok + "</td>" +
            "<td>" +
            "<button type=\"button\">Edit</button> " +
            "<button type=\"button\" class=\"btn-hapus\">Hapus</button>" +
            "</td>";
        tbody.appendChild(tr);
    });

Cara ini membuat baris tabel otomatis terbangkitkan sesuai jumlah data yang tersimpan di dalam file JSON.

### 4. Fitur Pencarian Real-Time (Table Filter)

Pada file `assets/js/app.js`, fungsi `initTableFilter()` digunakan untuk memfilter baris tabel secara instan berdasarkan input ketikan pengguna:

    function initTableFilter() {
        const input = document.getElementById("search-input");
        const table = document.querySelector(".table-responsive table");
        if (!input || !table) return;

        input.addEventListener("keyup", function () {
            const keyword = input.value.toLowerCase();
            const rows = table.querySelectorAll("tbody tr");
            rows.forEach(function (row) {
                const teks = row.textContent.toLowerCase();
                row.style.display = teks.includes(keyword) ? "" : "none";
            });
        });
    }

Setiap kali tombol pada keyboard dilepas (`keyup`), nilai input dibandingkan dengan teks pada setiap baris tabel. Jika teks cocok dengan kata kunci, baris akan ditampilkan, dan jika tidak, baris disembunyikan menggunakan `style.display = "none"`.

### 5. Event Delegation untuk Tombol Hapus

Karena baris tabel digenerate secara dinamis oleh JavaScript, tombol `.btn-hapus` belum ada di dalam DOM saat halaman pertama kali dimuat (`DOMContentLoaded`). Untuk mengatasinya, digunakan teknik Event Delegation pada tingkat `document`:

    function initHapusConfirm() {
        document.addEventListener("click", function (e) {
            const btn = e.target.closest(".btn-hapus");
            if (!btn) return;

            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
            }
        });
    }

Pendekatan ini memantau seluruh klik yang terjadi di dokumen, lalu memeriksa apakah target klik (atau elemen induk terdekatnya) memiliki class `.btn-hapus`. Jika benar, kotak dialog konfirmasi akan muncul, dan baris tabel terkait akan dihapus dari DOM apabila pengguna menyetujuinya.

### 6. Validasi Form Sisi Klien (Client-Side Validation)

Fungsi `initValidasiForm()` memastikan integritas data input sebelum form dikirimkan. Validasi memeriksa apakah field judul/nama kosong, tahun berada pada rentang yang valid (1900-2026), serta memastikan stok tidak bernilai negatif. Jika ditemukan kesalahan, proses submit dicegah melalui `e.preventDefault()` dan pesan error disisipkan secara dinamis.
