function initValidasiForm() {
    const form = document.getElementById("form-tambah");
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