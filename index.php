<?php
require_once __DIR__ . '/data.php';
$ninjas = getNinja  s();

// status kiriman dari proses.php (via redirect ?status=sukses)
$status = $_GET['status'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Shinobi Arena — Ultimate Jutsu Showdown!</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="hero">
    <div class="hero-seal">忍</div>
    <h1 class="hero-title">SHINOBI ARENA</h1>
    <p class="hero-sub">— Ultimate Jutsu Showdown! —</p>
    <p class="hero-tagline">Kumpulkan shinobi terkuat. Kuasai jutsu pamungkas. Rebut takhta desa tersembunyi.</p>
</header>

<?php if ($status === 'sukses'): ?>
<div class="banner banner-sukses">
    <span class="banner-icon">☑</span>
    Transaksi berhasil dicatat di gulungan misi. Terima kasih, Shinobi!
</div>
<?php elseif ($status === 'gagal'): ?>
<div class="banner banner-gagal">
    <span class="banner-icon">✕</span>
    Transaksi gagal. Periksa kembali data yang dikirim.
</div>
<?php endif; ?>

<main>
    <section class="roster">
        <h2 class="section-title"><span class="section-eyebrow">01 — Roster</span>Pilih Shinobi Andalanmu</h2>

        <div class="card-grid">
            <?php foreach ($ninjas as $n): ?>
            <article class="ninja-card">
                <div class="ninja-photo-wrap">
                    <img src="<?= htmlspecialchars($n['foto']) ?>" alt="Foto <?= htmlspecialchars($n['nama']) ?>" class="ninja-photo">
                    <span class="rank-seal" title="Rank <?= $n['rank'] ?>"><?= $n['rank'] ?></span>
                </div>
                <div class="ninja-info">
                    <h3 class="ninja-nama"><?= htmlspecialchars($n['nama']) ?></h3>
                    <p class="ninja-desa">🏯 <?= htmlspecialchars($n['desa']) ?></p>
                    <p class="ninja-jutsu">⚡ <em><?= htmlspecialchars($n['jutsu']) ?></em></p>
                    <p class="ninja-harga">Rp <?= number_format($n['harga'], 0, ',', '.') ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="form-section">
        <h2 class="section-title"><span class="section-eyebrow">02 — Perekrutan</span>Form Pembelian Karakter</h2>

        <form id="form-beli" action="proses.php" method="POST" novalidate>
            <div class="form-grid">

                <div class="field">
                    <label for="nama_pemain">Nama Pemain</label>
                    <input type="text" id="nama_pemain" name="nama_pemain" placeholder="Tulis nama shinobi-mu">
                    <span class="error-msg" id="error-nama"></span>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="nama@email.com">
                    <span class="error-msg" id="error-email"></span>
                </div>

                <div class="field">
                    <label for="ninja_pilihan">Pilihan Ninja</label>
                    <select id="ninja_pilihan" name="ninja_pilihan">
                        <?php foreach ($ninjas as $n): ?>
                        <option value="<?= htmlspecialchars($n['id']) ?>" data-harga="<?= $n['harga'] ?>">
                            <?= htmlspecialchars($n['nama']) ?> — Rp <?= number_format($n['harga'], 0, ',', '.') ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-msg" id="error-ninja"></span>
                </div>

                <div class="field">
                    <label for="jumlah_koin">Jumlah Koin Dibayarkan (Rp)</label>
                    <input type="text" id="jumlah_koin" name="jumlah_koin" placeholder="Minimal sesuai harga ninja">
                    <span class="error-msg" id="error-koin"></span>
                </div>

            </div>

            <button type="submit" class="btn-submit">Rekrut Shinobi Ini</button>
        </form>
    </section>
</main>

<footer class="site-footer">
    <p>Shinobi Arena: Ultimate Jutsu Showdown! — UADOYO Game Studio</p>
    <p><a href="login.php">Panel Admin</a></p>
</footer>

<!-- Data harga dikirim ke JS untuk validasi minimal pembayaran -->
<script id="ninja-data" type="application/json"><?= json_encode(array_column($ninjas, 'harga', 'id')) ?></script>
<script src="script.js"></script>
</body>
</html>
