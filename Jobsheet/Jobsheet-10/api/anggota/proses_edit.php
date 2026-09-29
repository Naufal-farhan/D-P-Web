<?php
require __DIR__ . '/../includes/auth.php';
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id         = $_POST['id'] ?? null;
$no_supir   = trim($_POST['no_supir'] ?? '');
$nama       = trim($_POST['nama'] ?? '');
$alamat     = trim($_POST['alamat'] ?? '');
$no_hp      = trim($_POST['no_hp'] ?? '');
$tgl_gabung = $_POST['tgl_gabung'] !== '' ? $_POST['tgl_gabung'] : null;
$email      = trim($_POST['email'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

if (empty($nama) || empty($no_supir)) {
    $_SESSION['flash'] = "Nama dan No. Sopir wajib diisi!";
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE sopir 
         SET no_supir = :no_supir, nama = :nama, alamat = :alamat, no_hp = :no_hp, tgl_gabung = :tgl_gabung, email = :email 
         WHERE id = :id"
    );
    $stmt->execute([
        'no_supir'   => $no_supir,
        'nama'       => $nama,
        'alamat'     => $alamat,
        'no_hp'      => $no_hp,
        'tgl_gabung' => $tgl_gabung,
        'email'      => $email,
        'id'         => $id,
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data sopir berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = "Gagal memperbarui data sopir: " . $e->getMessage();
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}