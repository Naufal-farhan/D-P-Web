document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Tutup sidebar jika area di luar sidebar diklik
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    }
    // Hitung Statistik Mobil
    fetch('data/buku.json')
        .then(response => response.json())
        .then(dataMobil => {
            const totalMobilEl = document.getElementById('total-mobil');
            const mobilDisewaEl = document.getElementById('mobil-disewa');
            const rentalAktifEl = document.getElementById('rental-aktif');

            if (totalMobilEl) totalMobilEl.textContent = dataMobil.length;

            const disewaCount = dataMobil.filter(m => m.status === 'Disewa').length;
            if (mobilDisewaEl) mobilDisewaEl.textContent = disewaCount;
            if (rentalAktifEl) rentalAktifEl.textContent = disewaCount;
        })
        .catch(err => console.error('Gagal memuat data mobil:', err));

    // Hitung Statistik Pelanggan
    fetch('data/anggota.json')
        .then(response => response.json())
        .then(dataPelanggan => {
            const totalPelangganEl = document.getElementById('total-pelanggan');
            if (totalPelangganEl) totalPelangganEl.textContent = dataPelanggan.length;
        })
        .catch(err => console.error('Gagal memuat data pelanggan:', err));
});
