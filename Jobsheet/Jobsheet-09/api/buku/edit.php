<?php
$page_title = "Edit Order Rental Mobil";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// Mengambil data order berdasarkan ID dari tabel order_rental
$stmt = $pdo->prepare("SELECT * FROM order_rental WHERE id = :id");
$stmt->execute(['id' => $id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    header('Location: list.php');
    exit;
}
?>

<section>
    <h2>Edit Order Rental Mobil</h2>

    <?php if ($flash): ?>
        <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($flash); ?></p>
    <?php endif; ?>

    <form id="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($order['id']); ?>">

        <p>
            <label for="jenis">Jenis Mobil</label><br>
            <input type="text" id="jenis" name="jenis" value="<?php echo htmlspecialchars($order['jenis'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="penyewa">Nama Penyewa</label><br>
            <input type="text" id="penyewa" name="penyewa" value="<?php echo htmlspecialchars($order['penyewa'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="sopir">Nama Sopir</label><br>
            <input type="text" id="sopir" name="sopir" value="<?php echo htmlspecialchars($order['sopir'] ?? ''); ?>" required>
        </p>
        <p>
            <label for="masa">Masa Sewa (Hari)</label><br>
            <input type="number" id="masa" name="masa" min="1" value="<?php echo htmlspecialchars($order['masa'] ?? ''); ?>" required>
        </p>
        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="list.php">Batal</a>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>