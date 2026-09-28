<?php
$page_title = "Edit Data Sopir";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}
?>

<section>
    <h2>Edit Data Sopir</h2>

    <?php if ($flash): ?>
        <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($flash); ?></p>
    <?php endif; ?>

    <form id="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($anggota['id']); ?>">

        <p>
            <label for="nama">Nama Sopir</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($anggota['nama'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="alamat">Alamat</label><br>
            <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($anggota['alamat'] ?? ''); ?></textarea>
        </p>
        <p>
            <label for="no_hp">No. HP / Telepon</label><br>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp'] ?? ''); ?>" required>
        </p>
        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>