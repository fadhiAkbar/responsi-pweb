<?php
session_start();

// Proteksi halaman — hanya bisa diakses jika sudah login
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$file = __DIR__ . '/transaksi.txt';
$transaksiList = [];

// program ini berfungsi untuk ngecek apakah file transaksi.txt ada, 
// jika ada seluruh isi file dibaca. Setiap baris akan diproses satu persatu, 
// kemudian dipisahkan berdasarkan karakter |.

// explode adalah kebalikan nya implode, jika implode menggabungkan semua data array menjadi satu string, 
// jadi explode kebalikan nya 
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $kolom = explode('|', $line);
        if (count($kolom) === 6) {
            $transaksiList[] = [
                'waktu'   => $kolom[0],
                'nama'    => $kolom[1],
                'email'   => $kolom[2],
                'ninja'   => $kolom[3],
                'harga'   => $kolom[4],
                'dibayar' => $kolom[5],
            ];
        }
    }
}

// Tampilkan yang terbaru lebih dulu
$transaksiList = array_reverse($transaksiList);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Riwayat Transaksi — Shinobi Arena</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@500;700&family=Noto+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-wrap wide">
    <div class="top-bar">
        <h1 class="admin-title" style="margin:0;">Riwayat Transaksi Pemain</h1>
        <a href="logout.php">Logout</a>
    </div>

    <?php if (empty($transaksiList)): ?>
        <p style="color:var(--parchment-dim);">Belum ada transaksi yang tercatat.</p>
    <?php else: ?>
        <table class="riwayat">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Nama Pemain</th>
                    <th>Email</th>
                    <th>Ninja Dibeli</th>
                    <th>Harga</th>
                    <th>Dibayar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transaksiList as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['waktu']) ?></td>
                    <td><?= htmlspecialchars($t['nama']) ?></td>
                    <td><?= htmlspecialchars($t['email']) ?></td>
                    <td><?= htmlspecialchars($t['ninja']) ?></td>
                    <td>Rp <?= number_format((int) $t['harga'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format((int) $t['dibayar'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p style="margin-top:24px; font-size:0.8rem;">
        <a href="index.php">← Kembali ke beranda</a>
    </p>
</div>

</body>
</html>
