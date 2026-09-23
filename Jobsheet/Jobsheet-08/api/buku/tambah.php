<?php 
// Memanggil header.php dari folder includes (naik 1 level)
include '../includes/header.php'; 
?>

<main>
    <form id="form-tambah" action="proses_tambah.php" method="POST">
        <p>
            <label for="jenis">Jenis</label><br>
            <input type="text" id="jenis" name="jenis" required>
        </p>
        <p>
            <label for="Penyewa">Penyewa</label><br>
            <input type="text" id="Penyewa" name="Penyewa" required>
        </p>
        <p>
            <label for="sopir">Sopir</label><br>
            <input type="text" id="sopir" name="sopir" required>
        </p>
        <p>
            <label for="masa">Masa (Hari)</label><br>
            <input type="number" id="masa" name="masa" min="1" placeholder="Contoh: 2" required>
        </p>
        <p>
            <button type="submit">Submit</button>
        </p>
    </form>
</main>

<?php 
// Memanggil footer.php dari folder includes (naik 1 level)
include '../includes/footer.php'; 
?>