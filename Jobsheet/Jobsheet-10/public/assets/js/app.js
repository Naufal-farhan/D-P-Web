// 1. Konfirmasi Hapus via Event 'submit' (Jobsheet-09)
function initHapusConfirm() {
    document.addEventListener("submit", function (e) {
        const form = e.target;

        // Hanya proses jika form yang di-submit memiliki class "form-hapus"
        if (!form.classList.contains("form-hapus")) return;

        const row = form.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent.trim() : "data ini";
        const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');

        // Jika pengguna menekan "Cancel", batalkan pengiriman form ke server
        if (!yakin) {
            e.preventDefault();
        }
    });
}

// 2. Validasi Form Tambah / Edit Data
function initValidasiForm() {
    const form = document.getElementById("form-tambah") || document.getElementById("form-edit");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const jenis = form.querySelector("[name='jenis']");
        if (jenis && jenis.value.trim() === "") {
            tampilkanError(jenis, "Jenis mobil wajib diisi.");
            valid = false;
        } else if (jenis) {
            hapusError(jenis);
        }

        const penyewa = form.querySelector("[name='penyewa'], [name='Penyewa']");
        if (penyewa && penyewa.value.trim() === "") {
            tampilkanError(penyewa, "Nama penyewa wajib diisi.");
            valid = false;
        } else if (penyewa) {
            hapusError(penyewa);
        }

        const sopir = form.querySelector("[name='sopir']");
        if (sopir && sopir.value.trim() === "") {
            tampilkanError(sopir, "Nama sopir wajib diisi.");
            valid = false;
        } else if (sopir) {
            hapusError(sopir);
        }

        const masa = form.querySelector("[name='masa']");
        if (masa) {
            const nilai = parseInt(masa.value, 10);
            if (isNaN(nilai) || nilai < 1) {
                tampilkanError(masa, "Masa sewa minimal 1 hari.");
                valid = false;
            } else {
                hapusError(masa);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

// Inisialisasi saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
    initValidasiForm();
    initHapusConfirm();
});