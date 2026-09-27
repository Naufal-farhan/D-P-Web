$id = $_POST['id'] ?? null;
// ...ambil field lain dari $_POST, validasi (identik dengan proses_tambah.php)...

if (!$id) {
    header('Location: list.php');
    exit;
}

// ...kalau ada error validasi, redirect ke edit.php?id=... (bukan tambah.php)...

$stmt = $pdo->prepare(
    "UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun,
     isbn = :isbn, stok = :stok, kategori = :kategori WHERE id = :id"
);
$stmt->execute([
    'jenis' => $jenis,
    'penyewa' => $penyewa,
    'sopir' => $sopir,
    'masa' => (int) $masa,
    'id' => $id,
]);