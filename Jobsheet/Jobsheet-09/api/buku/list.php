<?php 
require __DIR__ . '/../includes/koneksi.php';

// Ambil data dari database (disesuaikan nama variabelnya)
$rentalMobil_db = $pdo->query("SELECT * FROM order_rental ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ .'/../includes/header.php'; 
?>

<main>
    <section>
        <h2>Daftar Mobil / Order</h2>

        <!-- Tampilkan Pesan Flash jika Ada Error / Sukses -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert" style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
                <?= htmlspecialchars($_SESSION['flash']['pesan']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="search-box">
            <label for="search-input">Cari Jenis Mobil</label>
            <input type="text" id="search-input" placeholder="Ketik Jenis Mobil...">
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Penyewa</th>
                        <th>Sopir</th>
                        <th>Masa (Hari)</th>
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
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Belum ada data order.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php 
include __DIR__ .'/../includes/footer.php'; 
?>