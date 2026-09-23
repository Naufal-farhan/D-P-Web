<?php
// 1. Paksa PHP untuk menampilkan seluruh error di layar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// 2. Hubungkan ke database
require __DIR__ . '/../includes/koneksi.php';

// 3. Tangkap data dari form
$jenis   = trim($_POST['jenis'] ?? '');
$penyewa = trim($_POST['penyewa'] ?? '');
$sopir   = trim($_POST['sopir'] ?? '');
$masa    = $_POST['masa'] ?? '';

// 4. Validasi input
$errors = [];
if ($jenis === '')   $errors[] = "Jenis mobil wajib diisi.";
if ($penyewa === '') $errors[] = "Nama penyewa wajib diisi.";
if ($sopir === '')   $errors[] = "Nama sopir wajib diisi.";
if (!is_numeric($masa) || $masa < 1) $errors[] = "Masa sewa minimal 1 hari.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// 5. Eksekusi query
try {
    $stmt = $pdo->prepare(
        "INSERT INTO order_rental (jenis, penyewa, sopir, masa)
         VALUES (:jenis, :penyewa, :sopir, :masa)"
    );
    
    $stmt->execute([
        'jenis'   => $jenis,
        'penyewa' => $penyewa,
        'sopir'   => $sopir,
        'masa'    => (int) $masa,
    ]);

    // Hentikan redirect sementara untuk memastikan proses simpan berhasil
    echo "<h2 style='color: green;'>BERHASIL! Data telah tersimpan di database PostgreSQL.</h2>";
    echo "<p><a href='list.php'>Klik di sini untuk melihat daftar order</a></p>";
    exit;

} catch (Throwable $e) {
    // Tangkap semua jenis error (PDO Exception maupun Error System)
    echo "<h2 style='color: red;'>Gagal menyimpan ke database:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    exit;
}