<?php
session_start();

// Tangkap data dari form tambah.php
$nama = trim($_POST['nama'] ?? '');
$no_supir = trim($_POST['no_supir'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$tgl_gabung = $_POST['tgl_gabung'] ?? '';
$email = trim($_POST['email'] ?? '');

// Validasi server-side
$errors = [];
if ($nama === '') {
    $errors[] = "Nama sopir wajib diisi.";
}
if ($no_supir === '') {
    $errors[] = "No. Supir wajib diisi.";
}

// Jika ada error, simpan ke flash message lalu balikkan ke tambah.php
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// Inisialisasi session array jika belum ada
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

// Simpan data sopir baru ke dalam session
$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_supir' => $no_supir,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    'tgl_gabung' => $tgl_gabung,
    'email' => $email,
];

// Set pesan sukses dan redirect ke list.php
$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data sopir berhasil ditambahkan.'];
header('Location: list.php');
exit;