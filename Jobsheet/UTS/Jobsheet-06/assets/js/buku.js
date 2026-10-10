document.addEventListener('DOMContentLoaded', () => {
    const listBuku = document.getElementById('list-buku');
    const formTambahBuku = document.getElementById('form-tambah-buku');
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
    // Render Tabel Mobil
    if (listBuku) {
        fetch('../data/buku.json')
            .then(response => response.json())
            .then(data => {
                listBuku.innerHTML = data.map(item => `
          <tr>
            <td><strong>${item.id}</strong></td>
            <td>${item.merk}</td>
            <td>${item.plat}</td>
            <td>Rp ${Number(item.tarif).toLocaleString('id-ID')}</td>
            <td>
              <span class="badge ${item.status === 'Tersedia' ? 'badge-success' : (item.status === 'Disewa' ? 'badge-warning' : 'badge-danger')}">
                ${item.status}
              </span>
            </td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="alert('Edit ${item.id}')">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="alert('Hapus ${item.id}')">Hapus</button>
            </td>
          </tr>
        `).join('');
            })
            .catch(err => {
                console.error('Gagal mengambil data buku.json:', err);
                listBuku.innerHTML = '<tr><td colspan="6" style="text-align:center;">Gagal memuat data mobil.</td></tr>';
            });
    }

    // Handle Form Tambah Mobil
    if (formTambahBuku) {
        formTambahBuku.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('id_mobil').value;
            const merk = document.getElementById('merk').value;

            alert(`Mobil ${merk} (${id}) berhasil ditambahkan!`);
            window.location.href = 'list.html';
        });
    }
});
