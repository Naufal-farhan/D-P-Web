<?php 
// Memanggil header.php dari folder includes
include 'includes/header.php'; 
?>

<main>
    <section>
        <h1>SISTEM ADMINISTRASI RENTAL MOBIL</h1>
        <h3>Dashboard Pengelolaan Data & Monitoring Rental Mobil</h3>
        <p>Selamat datang di halaman utama Admin Rental Mobil. Melalui halaman ini, Anda dapat memantau ringkasan
            data penting seperti total ketersediaan armada, status mobil yang sedang disewa, status perawatan, serta
            informasi peminjaman secara cepat dan mudah.</p>
    </section>

    <section>
        <!-- Kolom Kiri: Judul dan Keterangan Singkat -->
        <div class="ringkasan-info">
            <h2>RINGKASAN</h2>
            <p>Ringkasan statistik operasional rental mobil secara real-time.</p>
        </div>

        <!-- Kolom Kanan: 4 Kartu Statistik disusun 2x2 -->
        <div class="ringkasan-cards">
            <article>
                <h3>TOTAL MOBIL</h3>
                <p>9</p>
            </article>
            <article>
                <h3>TOTAL DI-RENTAL</h3>
                <p>6</p>
            </article>
            <article>
                <h3>MOBIL MAINTENANCE</h3>
                <p>1</p>
            </article>
            <article>
                <h3>MOBIL TERLAMBAT</h3>
                <p>0</p>
            </article>
        </div>
    </section>

    <section>
        <h3>Informasi & Petunjuk Sistem</h3>
        <p>Halaman dashboard ini menampilkan rekapitulasi data dari keseluruhan sistem rental. Untuk melakukan
            penambahan order baru, silakan gunakan menu 'TAMBAH ORDER' pada navigasi atas. Jika ingin melihat data
            penyewaan secara lengkap, Anda dapat mengakses menu 'LIST ORDER', sedangkan untuk pengelolaan sopir
            tersedia pada menu 'DAFTAR SOPIR' dan 'TAMBAH SOPIR'.</p>
    </section>
</main>

<?php 
// Memanggil footer.php dari folder includes
include 'includes/footer.php'; 
?>