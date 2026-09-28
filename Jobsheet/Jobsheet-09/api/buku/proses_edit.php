<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id        = $_POST['id'] ?? null;
$judul     = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun     = $_POST['tahun'] ?? '';
$isbn      = trim($_POST['isbn'] ?? '');
$stok       = $_POST['stok'] ?? '';
$kategori  = trim($_POST['kategori'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

// Validasi input
if (empty($judul) || empty($pengarang) || empty($tahun) || empty($isbn) || $stok === '' || empty($kategori)) {
    $_SESSION['flash'] = "Semua field wajib diisi!";
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE buku 
         SET judul = :judul, pengarang = :pengarang, tahun = :tahun, 
             isbn = :isbn, stok = :stok, kategori = :kategori 
         WHERE id = :id"
    );
    $stmt->execute([
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => (int) $tahun,
        'isbn'      => $isbn,
        'stok'      => (int) $stok,
        'kategori'  => $kategori,
        'id'        => $id,
    ]);

    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = "Gagal memperbarui data: " . $e->getMessage();
    header("Location: edit.php?id=" . urlencode($id));
    exit;
}