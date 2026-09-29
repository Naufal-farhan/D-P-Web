<?php
// ==========================================
// ROUTER UTAMA VERCEL (1 Serverless Function)
// ==========================================
require __DIR__ . '/includes/auth.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. Tampilkan Dashboard Utama jika mengakses URL Akar ( / ) atau /index.php
if ($uri === '/' || $uri === '/index.php') {
    include __DIR__ . '/includes/header.php'; 
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
    include __DIR__ . '/includes/footer.php'; 
    exit;
}

// 2. Jalur Navigasi ke File PHP Lainnya (/buku/list.php, /anggota/edit.php, dll)
$file = __DIR__ . $uri;

// Jika mengakses direktori/folder (misal: /buku/ atau /anggota/), arahkan otomatis ke list.php
if (is_dir($file)) {
    $file = rtrim($file, '/') . '/list.php';
}

// Jika file .php yang diminta ada, panggil filenya secara langsung
if (file_exists($file) && is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require $file;
    exit;
}

// 3. Tampilan jika Halaman/File Tidak Ditemukan (404)
http_response_code(404);
echo "<div style='text-align:center; padding:50px; color:#e3bd8d; background:#1e1a2d; font-family:sans-serif;'>
        <h1>404 - Halaman Tidak Ditemukan</h1>
        <p>Halaman yang Anda cari tidak tersedia.</p>
        <a href='/' style='color:#e3bd8d;'>Kembali ke Dashboard</a>
      </div>";