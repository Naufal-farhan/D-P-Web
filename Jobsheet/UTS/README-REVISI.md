# Revisi Jobsheet 01–05 — Sistem Manajemen Rental Mobil

ZIP ini menyelaraskan konten Jobsheet 01–05 dengan konteks dashboard Rental Mobil pada Jobsheet 06. Folder dan nama file `buku/` serta `anggota/` dipertahankan agar struktur rujukan tetap kompatibel, tetapi isi halaman, tabel, form, dan label navigasi telah diubah menjadi Data Mobil dan Data Pelanggan.

## Pembagian dua fase

### Fase 1 — Fondasi halaman dan responsivitas (Jobsheet 01–03)
- **Jobsheet 01:** HTML saja; tidak ada file CSS atau JavaScript yang dihubungkan.
- **Jobsheet 02:** CSS eksternal untuk styling desktop, sidebar, statistik, tabel, tombol, dan form.
- **Jobsheet 03:** media query, layout responsive, tabel yang dapat digeser horizontal, dan hamburger menu berbasis checkbox + CSS tanpa JavaScript.

### Fase 2 — Dokumentasi dan interaksi (Jobsheet 04–05)
- **Jobsheet 04:** hanya dokumentasi user flow dan wireframe teks. Seluruh file website identik dengan Jobsheet 03.
- **Jobsheet 05:** tombol hamburger dikendalikan oleh JavaScript murni melalui event listener dan class `active`.

## Catatan
- Jobsheet 06 disertakan tanpa perubahan sebagai referensi.
- Proyek masih berupa prototipe frontend statis. Data di HTML hanyalah contoh; form, Edit, dan Hapus belum tersambung ke backend/database.
- Tautan deployment lama di tiap `linkVercel.md` tidak otomatis memuat hasil revisi lokal; deploy ulang setelah mengunggah perubahan.
