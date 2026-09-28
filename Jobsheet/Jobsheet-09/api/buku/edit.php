<?php
$page_title = "Edit Order / Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>

<section>
    <h2>Edit Order / Buku</h2>

    <?php if ($flash): ?>
        <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($flash); ?></p>
    <?php endif; ?>

    <form id="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($buku['id']); ?>">

        <p>
            <label for="judul">Judul</label><br>
            <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="pengarang">Pengarang / Pemesan</label><br>
            <input type="text" id="pengarang" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="tahun">Tahun</label><br>
            <input type="number" id="tahun" name="tahun" value="<?php echo htmlspecialchars($buku['tahun'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="isbn">ISBN / Kode</label><br>
            <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($buku['isbn'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="stok">Stok / Jumlah</label><br>
            <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($buku['stok'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($buku['kategori'] ?? ''); ?>" required>
        </p>
        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>