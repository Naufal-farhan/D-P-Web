<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id      = $_POST['id'] ?? null;
$jenis   = trim($_POST['jenis'] ?? '');
$penyewa = trim($_POST['penyewa'] ?? '');
$sopir   = trim($_POST['sopir'] ?? '');
$masa    = $_POST['masa'] ?? '';

if (!$id) {
    header('Location: list.php');
    exit;
}

// Validasi input
if (empty($jenis) || empty($penyewa) || empty($sopir) || $masa === '' || (int)$masa < 1) {
    $_SESSION['flash'] = "Semua field wajib diisi dan masa sewa minimal 1 hari!";
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE order_rental 
         SET jenis = :jenis, penyewa = :penyewa, sopir = :sopir, masa = :masa 
         WHERE id = :id"
    );
    $stmt->execute([
        'jenis'   => $jenis,
        'penyewa' => $penyewa,
        'sopir'   => $sopir,
        'masa'    => (int) $masa,
        'id'      => $id,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data order berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = "Gagal memperbarui data order: " . $e->getMessage();
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}