<?php
session_start();

// Naik 2 level dari api/buku/ ke root project
require __DIR__ . '/../includes/koneksi.php';

// Tangkap data dari form
$jenis   = trim($_POST['jenis'] ?? '');
$penyewa = trim($_POST['penyewa'] ?? '');
$sopir   = trim($_POST['sopir'] ?? '');
$masa    = $_POST['masa'] ?? '';

// Validasi server-side
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

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data order rental berhasil ditambahkan.'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    die("Gagal menyimpan data ke database: " . $e->getMessage());
}   