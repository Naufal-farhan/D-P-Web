<?php
// Paksa PHP tampilkan semua error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Cek apakah data POST benar-benar masuk
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses ditolak: Data harus dikirim melalui method POST.");
}

// Import koneksi database
require_once __DIR__ . '/../includes/koneksi.php';

// Tangkap input (mengantisipasi variasi nama input 'penyewa' dan 'Penyewa')
$jenis   = trim($_POST['jenis'] ?? '');
$penyewa = trim($_POST['penyewa'] ?? $_POST['Penyewa'] ?? '');
$sopir   = trim($_POST['sopir'] ?? '');
$masa    = $_POST['masa'] ?? '';

// Validasi
$errors = [];
if ($jenis === '')   $errors[] = "Jenis mobil wajib diisi.";
if ($penyewa === '') $errors[] = "Nama penyewa wajib diisi.";
if ($sopir === '')   $errors[] = "Nama sopir wajib diisi.";
if (!is_numeric($masa) || $masa < 1) $errors[] = "Masa sewa minimal 1 hari.";

if (!empty($errors)) {
    echo "<h3 style='color:red;'>Validasi Gagal:</h3><ul>";
    foreach ($errors as $err) {
        echo "<li>" . htmlspecialchars($err) . "</li>";
    }
    echo "</ul><a href='tambah.php'>Kembali ke form</a>";
    exit;
}

// Eksekusi Simpan ke PostgreSQL
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

    // Matikan redirect otomatis untuk memastikan status eksekusi
    echo "<h2 style='color: green;'>BERHASIL! Data berhasil masuk ke database.</h2>";
    echo "<p><a href='list.php'>Klik di sini untuk buka list.php secara manual</a></p>";

} catch (Throwable $e) {
    echo "<h2 style='color: red;'>Error Database / Query:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}