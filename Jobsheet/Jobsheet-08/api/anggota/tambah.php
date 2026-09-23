<?php 
// Memanggil header.php dari folder includes (naik 1 level)
include '../includes/header.php'; 
?>

<main>
    <!-- Tampilkan Pesan Flash Error jika Ada -->
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert" style="padding: 10px; margin-bottom: 15px; border: 1px solid red; color: red;">
            <?= htmlspecialchars($_SESSION['flash']['pesan']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form id="form-tambah" action="proses_tambah.php" method="POST">
        <p>
            <label for="nama">Nama</label><br>
            <input type="text" id="nama" name="nama" required>
        </p>
        <p>
            <label for="no_supir">No. Supir</label><br>
            <input type="text" id="no_supir" name="no_supir" required>
        </p>
        <p>
            <label for="alamat">Alamat</label><br>
            <input type="text" id="alamat" name="alamat">
        </p>
        <p>
            <label for="no_hp">No. HP</label><br>
            <input type="text" id="no_hp" name="no_hp">
        </p>
        <p>
            <label for="tgl_gabung">Tgl. Bergabung</label><br>
            <input type="date" id="tgl_gabung" name="tgl_gabung">
        </p>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email">
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</main>

<?php 
// Memanggil footer.php dari folder includes (naik 1 level)
include '../includes/footer.php'; 
?>