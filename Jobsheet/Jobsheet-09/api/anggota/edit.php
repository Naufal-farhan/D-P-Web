<?php
$page_title = "Edit Sopir / Anggota";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// Mengambil data sopir berdasarkan ID dari tabel anggota
$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$sopir = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sopir) {
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
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($sopir['id']); ?>">

        <p>
            <label for="nama">Nama Sopir</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($sopir['nama'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="alamat">Alamat</label><br>
            <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($sopir['alamat'] ?? ''); ?></textarea>
        </p>
        <p>
            <label for="no_hp">No. HP / WhatsApp</label><br>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($sopir['no_hp'] ?? ''); ?>" required>
        </p>
        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>