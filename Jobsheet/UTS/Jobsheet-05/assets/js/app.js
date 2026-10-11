/* =====================================================
   Jobsheet 05: JavaScript untuk tombol hamburger.
   Fokus hanya pada interaksi menu; data belum memakai backend.
   ===================================================== */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!menuToggle || !sidebar || !overlay) return;

    function bukaMenu() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        menuToggle.setAttribute('aria-expanded', 'true');
        menuToggle.setAttribute('aria-label', 'Tutup menu navigasi');
    }

    function tutupMenu() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Buka menu navigasi');
    }

    menuToggle.addEventListener('click', function () {
        const menuSedangTerbuka = sidebar.classList.contains('active');
        if (menuSedangTerbuka) {
            tutupMenu();
        } else {
            bukaMenu();
        }
    });

    overlay.addEventListener('click', tutupMenu);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') tutupMenu();
    });

    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', tutupMenu);
    });
});
