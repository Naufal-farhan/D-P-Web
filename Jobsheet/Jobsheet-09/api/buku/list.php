<?php 
require __DIR__ . '/../includes/koneksi.php';

// ==========================================
// 1. PENGATURAN PAGINATION & PENCARIAN
// ==========================================
$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    // Hitung total data berdasarkan pencarian (ILIKE = Case-insensitive PostgreSQL)
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM order_rental WHERE jenis ILIKE :kw OR penyewa ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    // Query data hasil pencarian dengan LIMIT & OFFSET
    $stmt = $pdo->prepare("SELECT * FROM order_rental WHERE jenis ILIKE :kw OR penyewa ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    // Hitung total seluruh data
    $totalRows = $pdo->query("SELECT COUNT(*) FROM order_rental")->fetchColumn();

    // Query semua data dengan LIMIT & OFFSET
    $stmt = $pdo->prepare("SELECT * FROM order_rental ORDER BY id DESC LIMIT :limit OFFSET :offset");
}

// Bind parameter LIMIT dan OFFSET secara eksplisit sebagai Integer
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$rentalMobil_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));

include __DIR__ . '/../includes/header.php'; 
?>

<main>
    <section>
        <h2>Daftar Mobil / Order</h2>

        <!-- Tampilkan Pesan Flash jika Ada Error / Sukses -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert" style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
                <?= is_array($_SESSION['flash']) ? htmlspecialchars($_SESSION['flash']['pesan']) : htmlspecialchars($_SESSION['flash']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <!-- Form Pencarian Server-Side (method="get") -->
        <form method="get" action="list.php" class="search-box" style="margin-bottom: 20px;">
            <label for="search-input">Cari Jenis Mobil / Penyewa</label>
            <div style="display: flex; gap: 8px; margin-top: 5px;">
                <input type="text" id="search-input" name="q" value="<?= htmlspecialchars($keyword); ?>" placeholder="Ketik kata kunci...">
                <button type="submit">Cari</button>
                <?php if ($keyword !== ''): ?>
                    <a href="list.php" style="padding: 6px 12px; background: #6c757d; color: #fff; text-decoration: none; border-radius: 4px;">Reset</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Penyewa</th>
                        <th>Sopir</th>
                        <th>Masa (Hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rentalMobil_db)): ?>
                        <?php foreach ($rentalMobil_db as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['jenis']); ?></td>
                                <td><?= htmlspecialchars($item['penyewa']); ?></td>
                                <td><?= htmlspecialchars($item['sopir']); ?></td>
                                <td><?= htmlspecialchars($item['masa']); ?> Hari</td>
                                <td>
                                    <a href="edit.php?id=<?= $item['id']; ?>">Edit</a> | 
                                    <form action="hapus.php" method="POST" class="form-hapus" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                        <button type="submit" class="btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data order.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Navigasi Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav class="pagination" style="margin-top: 20px; text-align: center;">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="list.php?page=<?= $i; ?><?= $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                       class="<?= $i === $page ? 'active' : ''; ?>"
                       style="padding: 6px 12px; margin: 0 2px; border: 1px solid #ccc; text-decoration: none; <?= $i === $page ? 'background-color: #007bff; color: white;' : 'color: #333;'; ?>">
                       <?= $i; ?>
                    </a>
                <?php endfor; ?>
            </nav>
        <?php endif; ?>
    </section>
</main>

<?php 
include __DIR__ . '/../includes/footer.php'; 
?>