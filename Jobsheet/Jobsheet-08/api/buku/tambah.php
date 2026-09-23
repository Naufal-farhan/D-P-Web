<?php 
// Naik 2 level: dari api/buku/ ke root project
include '../includes/header.php'; 
?>

<main>
    <form id="form-tambah" action="proses_tambah.php" method="POST">
        <p>
            <label for="jenis">Jenis</label><br>
            <input type="text" id="jenis" name="jenis" required>
        </p>
        <p>
            <label for="penyewa">Penyewa</label><br>
            <input type="text" id="penyewa" name="penyewa" required>
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
include '../includes/footer.php'; 
?>