document.addEventListener('DOMContentLoaded', () => {
    const listAnggota = document.getElementById('list-anggota');
    const formTambahAnggota = document.getElementById('form-tambah-anggota');
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
    // Render Tabel Pelanggan
    if (listAnggota) {
        fetch('../data/anggota.json')
            .then(response => response.json())
            .then(data => {
                listAnggota.innerHTML = data.map(item => `
          <tr>
            <td><strong>${item.id}</strong></td>
            <td>${item.nama}</td>
            <td>${item.nik}</td>
            <td>${item.telepon}</td>
            <td>${item.alamat}</td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="alert('Edit ${item.id}')">Edit</button>
              <button class="btn btn-danger btn-sm" onclick="alert('Hapus ${item.id}')">Hapus</button>
            </td>
          </tr>
        `).join('');
            })
            .catch(err => {
                console.error('Gagal mengambil data anggota.json:', err);
                listAnggota.innerHTML = '<tr><td colspan="6" style="text-align:center;">Gagal memuat data pelanggan.</td></tr>';
            });
    }

    // Handle Form Tambah Pelanggan
    if (formTambahAnggota) {
        formTambahAnggota.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('id_pelanggan').value;
            const nama = document.getElementById('nama').value;

            alert(`Pelanggan ${nama} (${id}) berhasil ditambahkan!`);
            window.location.href = 'list.html';
        });
    }
});
