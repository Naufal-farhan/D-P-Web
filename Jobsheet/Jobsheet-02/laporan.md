# Laporan Jobsheet 0-2
### NAMA    : NAUFAL FARHAN NUR RAMADHAN
### NIM     : 254107020077
### KELAS   : TI-2D

<img width="959" height="272" alt="image" src="https://github.com/user-attachments/assets/97bb9f82-87c2-4fe5-b38a-47be7c629e14" />
tampilan index
<img width="959" height="319" alt="image" src="https://github.com/user-attachments/assets/53dcbf1a-2d6b-4b47-a75d-83d8ceef6b81" />
tampilan list buku
<img width="959" height="473" alt="image" src="https://github.com/user-attachments/assets/bcf9de8d-7d5d-499b-9892-e4b680f1615f" />
tampilan daftar buku

## Penjelasan dan Rangkuman
  Di jobsheet ke dua kali ini kita diajarkan menggunakan css untuk memperindah dan memberikan ui sederhana ke file html yang sudah kita buat di jobsheet 1 dengan mengatur tampilan, font, warna, ukuran jarak, tata letak dll.
  <img width="197" height="80" alt="image" src="https://github.com/user-attachments/assets/7f12c18a-99e2-43df-835d-b419d18b6724" />

  pertama kita akan mereset seluruh elemen dengan symbol "*" yang berisikan syntax  "box-sizing: border-box;" yang mana adalah default atau template untuk mengatur widgth, lalu ada margin dan padding yang diatur menjadi 0 agar menghapus jarak untuk menyamakan semua elemen.

  <img width="356" height="100" alt="image" src="https://github.com/user-attachments/assets/0dab8da8-1a93-4483-b0a4-3f3d4d76f6b2" />

  disini kita ingin merubah tampilan pada seluruh elemen body dengan mengisi kurung nya dengan sesuatu yang ingin kita rubah atau tambahkan, misal pada foto tersebut saya merubah font nya dan memberikan jarak antar baris dengan line height, lalu kita juga merubah background color nya menjadi putih dengan syntax "background-color: #f5f6f8;".

  <img width="278" height="131" alt="image" src="https://github.com/user-attachments/assets/012f2736-597c-49e1-a19e-d77ceed78cb7" />

  dan pada elemen header juga, kita memberikan warna hijau dengan padding atau margin yang memberikan jarak ke arah horizontal dan vertikal, lalu syntax "align-items: center;" untuk menyejajarkan flex item secara vertikal di tengah supaya h1 dan nav sama sama center secara vertikal meski tingginya berbeda.

  <img width="224" height="176" alt="image" src="https://github.com/user-attachments/assets/786abae5-741f-4c59-826b-2fa683a6642e" />

  lalu disini kita mengatur table, dengan memaksimalkan lebar nya dan membuat garis antar kolom/table menyatu dengan syntax "border-collapse: collapse;".
  lalu ada sel untuk td,th yang mengatur text align nya untuk merapat ke kiri, memberikan padding dan memberikan garis tipis abu abu dibawahnya untuk memisahkan garis satu dengan garis yanng lain.
  dan thead untuk memberikan warna pada baris paling atas

  <img width="214" height="111" alt="image" src="https://github.com/user-attachments/assets/248bec66-0192-4f10-a811-fa77658942fc" />

  lalu pada elemen button yang mengandung tulisan hapus edit dan detail juga, kita mengatur agar menghilangkan border nya, lalu dengan syntax "cursor: pointer;" kita membuat agar ketika kursor berada tepat diatas tombolnya maka kursor akan berubah menjadi gambar tunjuk
  
## Ide Latihan Tambahan (Opsional)
#### 1.Ubah skema warna — ganti nilai #1d5b8a (warna biru tema) di seluruh file style.css dengan warna lain, misalnya hijau tua, lalu amati bagaimana warna itu konsisten muncul di header, judul section, tombol submit, dan header tabel — karena semuanya memakai nilai hex yang sama.
  <img width="959" height="358" alt="image" src="https://github.com/user-attachments/assets/b5d2071f-fbfc-43c5-b171-1de7cda7886f" />

### 2.Tambah kolom keempat di grid kartu statistik — tambahkan satu <article> baru di HTML (misalnya "Buku Terlambat"), lalu ubah repeat(3, 1fr) menjadi repeat(4, 1fr) di CSS.
<img width="728" height="234" alt="image" src="https://github.com/user-attachments/assets/f81fe192-79b0-44ef-88ea-49b98800f62b" />

    
### 3.Buat tombol ketiga di tabel — tambahkan tombol "Detail" di antara Edit dan Hapus pada buku/list.html, lalu amati apakah warnanya sesuai harapan (ingat catatan di bab 7 §7.6 tentang :first-of-type/:last-of-type yang berbasis posisi, bukan makna). Coba perbaiki dengan memberi class khusus jika warnanya tidak sesuai.
<img width="832" height="256" alt="image" src="https://github.com/user-attachments/assets/36792ad6-4306-453d-896c-85052571e679" />

### 4.Uji responsivitas sederhana — perkecil lebar jendela browser secara bertahap sampai sangat sempit (seperti lebar HP), amati kapan flex-wrap: wrap pada navbar mulai memindahkan menu ke baris baru.
<img width="959" height="478" alt="image" src="https://github.com/user-attachments/assets/ef6cb01c-bde3-4453-ae13-73e50cf8e81a" />
<img width="959" height="470" alt="image" src="https://github.com/user-attachments/assets/4132e715-919c-48ee-aeec-e85175cf4bcc" />
100% dan 150% zoom


