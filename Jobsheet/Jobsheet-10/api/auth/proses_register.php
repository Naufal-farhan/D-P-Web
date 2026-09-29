<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// Pastikan request melalui method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama     = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi input kosong
if (empty($nama) || empty($username) || empty($password)) {
    $_SESSION['flash'] = 'Semua kolom wajib diisi!';
    header('Location: register.php');
    exit;
}

try {
    // Cek apakah username sudah terdaftar di database
    $stmtCheck = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmtCheck->execute(['username' => $username]);

    if ($stmtCheck->fetch()) {
        $_SESSION['flash'] = 'Username sudah digunakan, silakan pakai username lain.';
        header('Location: register.php');
        exit;
    }

    // Hash password menggunakan algoritma BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan akun baru ke database dengan role default 'petugas'
    $stmtInsert = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
    $stmtInsert->execute([
        'nama'     => $nama,
        'username' => $username,
        'password' => $hashedPassword
    ]);

    $_SESSION['flash'] = 'Registrasi berhasil! Silakan login dengan akun baru Anda.';
    header('Location: login.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = 'Terjadi kesalahan sistem: ' . $e->getMessage();
    header('Location: register.php');
    exit;
}