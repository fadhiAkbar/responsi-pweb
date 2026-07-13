<?php
session_start();

// Kredensial hardcoded sederhana sesuai ketentuan tugas
const ADMIN_USER = 'admin';
const ADMIN_PASS = 'admin123';

$error = '';

// jika method nya post maka program nya jalan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USER && $password === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: riwayat.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}

// Jika sudah login, langsung arahkan ke riwayat
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: riwayat.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin — Shinobi Arena</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-wrap">
    <h1 class="admin-title">Panel Admin</h1>

    <?php if ($error): ?>
        <p style="color:#e88; margin-bottom:18px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" novalidate>
        <div class="field" style="margin-bottom:16px;">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="admin">
        </div>
        <div class="field" style="margin-bottom:20px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••">
        </div>
        <button type="submit" class="btn-submit">Masuk</button>
    </form>

    <p style="margin-top:20px; font-size:0.8rem; color:var(--parchment-dim);">
        <a href="index.php">← Kembali ke beranda</a>
    </p>
</div>

</body>
</html>
