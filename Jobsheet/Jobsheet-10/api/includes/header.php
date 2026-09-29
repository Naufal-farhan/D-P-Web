<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Penanganan base path untuk Vercel vs Lokal
if (getenv('VERCEL')) {
    $base = '/';
    $assetBase = '/assets/';
} else {
    $__jobsheetRoot = dirname(__DIR__);
    $__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
    $__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
    $base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
    $assetBase = $base . 'public/assets/';
}

// Cek status login (Mendukung $_SESSION['user_id'] atau $_SESSION['user'])
$sudahLogin = isset($_SESSION['user_id']) || isset($_SESSION['user']);
$namaUser = $_SESSION['nama'] ?? $_SESSION['user']['nama'] ?? $_SESSION['username'] ?? 'Petugas';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL MOBIL<?php echo isset($page_title) ? ' | ' . htmlspecialchars($page_title) : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $assetBase; ?>css/style.css">
</head>
<body>
    <header>
        <h1>RENTAL MOBIL</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li><a href="<?php echo $base; ?>buku/list.php">List Mobil</a></li>
                <?php if ($sudahLogin): ?>
                    <li><a href="<?php echo $base; ?>buku/tambah.php">Tambah Order</a></li>
                    <li><a href="<?php echo $base; ?>anggota/list.php">Daftar Sopir</a></li>
                    <li><a href="<?php echo $base; ?>anggota/tambah.php">Tambah Sopir</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span>Selamat datang, <strong><?php echo htmlspecialchars($namaUser); ?></strong></span>
                <a href="<?php echo $base; ?>auth/logout.php" class="btn-logout">Logout</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <main>