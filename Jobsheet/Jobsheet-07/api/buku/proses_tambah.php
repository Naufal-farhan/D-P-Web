<?php
session_start();

// Tangkap data dari form tambah.php
$jenis = trim($_POST['jenis'] ?? '');
$penyewa = trim($_POST['Penyewa'] ?? '');
$sopir = trim($_POST['sopir'] ?? '');
$masa = $_POST['masa'] ?? '';

// Validasi server-side
$errors = [];
if ($jenis === '') {
    $errors[] = "Jenis mobil wajib diisi.";
}
if ($penyewa === '') {
    $errors[] = "Nama penyewa wajib diisi.";
}
if ($sopir === '') {
    $errors[] = "Nama sopir wajib diisi.";
}
if (!is_numeric($masa) || $masa < 1) {
    $errors[] = "Masa sewa minimal 1 hari.";
}

// Jika ada error, kirim pesan error lewat session lalu kembalikan ke tambah.php
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// Inisialisasi session array jika belum ada
if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}

// Simpan data order baru ke dalam session
$_SESSION['buku'][] = [
    'jenis' => $jenis,
    'penyewa' => $penyewa,
    'sopir' => $sopir,
    'masa' => (int) $masa,
];

// Set pesan sukses dan redirect ke list.php
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data order rental berhasil ditambahkan.'];
header('Location: list.php');
exit;