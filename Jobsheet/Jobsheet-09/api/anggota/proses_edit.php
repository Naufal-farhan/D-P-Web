<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id     = $_POST['id'] ?? null;
$nama   = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp  = trim($_POST['no_hp'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

// Validasi input
if (empty($nama) || empty($alamat) || empty($no_hp)) {
    $_SESSION['flash'] = "Semua field (Nama, Alamat, No. HP) wajib diisi!";
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE anggota 
         SET nama = :nama, alamat = :alamat, no_hp = :no_hp 
         WHERE id = :id"
    );
    $stmt->execute([
        'nama'   => $nama,
        'alamat' => $alamat,
        'no_hp'  => $no_hp,
        'id'     => $id,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data sopir berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = "Gagal memperbarui data sopir: " . $e->getMessage();
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}