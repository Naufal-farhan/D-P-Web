<?php
$host = getenv('PGHOST') ?: 'localhost';
$port = getenv('PGPORT') ?: '5432';
$db   = getenv('PGDATABASE') ?: 'rentalMobil_db';
$user = getenv('PGUSER') ?: 'postgres';
$pass = getenv('PGPASSWORD') ?: '12345678';

try {
    // Parameter sslmode=require wajib ada agar diterima oleh Neon
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>