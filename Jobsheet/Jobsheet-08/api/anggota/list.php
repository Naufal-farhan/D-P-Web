<?php 
// Memanggil header.php dari folder includes (naik 1 level)
include __DIR__ . '../includes/header.php'; 
?>

<main>
    <section>
        <h2>Daftar Sopir</h2>

        <!-- Tampilkan Pesan Flash jika Ada Error / Sukses -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="alert" style="padding: 10px; margin-bottom: 15px; border: 1px solid #ccc;">
                <?= htmlspecialchars($_SESSION['flash']['pesan']); ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="search-box">
            <label for="search-input">Cari Nama Sopir</label>
            <input type="text" id="search-input" placeholder="Ketik nama Sopir...">
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No. Sopir</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['anggota'])): ?>
                        <?php foreach ($_SESSION['anggota'] as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['no_supir']); ?></td>
                                <td><?= htmlspecialchars($item['nama']); ?></td>
                                <td><?= htmlspecialchars($item['alamat'] ?: '-'); ?></td>
                                <td><?= htmlspecialchars($item['no_hp'] ?: '-'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Belum ada data sopir.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php 
// Memanggil footer.php dari folder includes (naik 1 level)
include __DIR__ . '../includes/footer.php'; 
?>