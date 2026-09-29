<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika sudah login, langsung alihkan ke dashboard
if (isset($_SESSION['user_id']) || isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$page_title = "Login Petugas";
include __DIR__ . '/../includes/header.php';
?>

<section style="max-width: 400px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h2>Login Petugas</h2>

    <?php if ($flash): ?>
        <p style="color: #ff6b6b; font-weight: bold; margin-bottom: 15px;">
            <?php echo htmlspecialchars(is_array($flash) ? ($flash['pesan'] ?? '') : $flash); ?>
        </p>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <p>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" style="width: 100%; padding: 8px; margin-top: 5px;" required>
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" style="width: 100%; padding: 8px; margin-top: 5px;" required>
        </p>
        <p style="margin-top: 20px;">
            <button type="submit" style="width: 100%; padding: 10px; cursor: pointer;">Login</button>
        </p>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        Belum punya akun? <a href="register.php" style="color: #e3bd8d;">Register di sini</a>
    </p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>