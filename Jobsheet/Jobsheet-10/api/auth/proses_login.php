<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// Pastikan request melalui method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi input kosong
if (empty($username) || empty($password)) {
    $_SESSION['flash'] = 'Username dan password wajib diisi!';
    header('Location: login.php');
    exit;
}

try {
    // Cari user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi password hash (BCrypt)
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role'];

        header('Location: /');
        exit;
    } else {
        $_SESSION['flash'] = 'Username atau password salah.';
        header('Location: login.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Terjadi kesalahan sistem: ' . $e->getMessage();
    header('Location: login.php');
    exit;
}