<?php
session_start();

// Prefix relatif ke root proyek ini (bukan root domain) — supaya
// /assets, /index.php, dst tetap benar walau proyek diakses lewat
// subfolder (mis. dp2026.test/kode-praktikum/jobsheet-07/), bukan cuma
// lewat vhost yang document root-nya langsung folder ini.

if (getenv('VERCEL')) {
    $base = '/';
} else {
    $__jobsheetRoot = dirname(__DIR__);
    $__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
    $__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
    $base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENTAL MOBIL<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>../public/assets/css/style.css">
</head>
<body>
    <header>
        <h1>RENTAL MOBIL</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li><a href="<?php echo $base; ?>buku/list.php">List Mobil</a></li>
                <li><a href="<?php echo $base; ?>buku/tambah.php">Tambah Order</a></li>
                <li><a href="<?php echo $base; ?>anggota/list.php">Daftar Sopir</a></li>
                <li><a href="<?php echo $base; ?>anggota/tambah.php">Tambah Sopir</a></li>
            </ul>
        </nav>
    </header>

    <main>