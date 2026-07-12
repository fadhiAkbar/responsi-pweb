<?php
require_once __DIR__ . '/data.php';

// Hanya terima method POST
// jadi program ini hanya menerima file proses.php melalui post aja kalo selain itu akan langsung mengarahkan kembali ke index.php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$namaPemain = trim($_POST['nama_pemain'] ?? '');
$email      = trim($_POST['email'] ?? '');
$ninjaId    = trim($_POST['ninja_pilihan'] ?? '');
$jumlahKoin = trim($_POST['jumlah_koin'] ?? '');

// Bersihkan format ribuan seperti "500.000" -> "500000"
$jumlahKoinBersih = preg_replace('/[.,\s]/', '', $jumlahKoin);

$ninja = getNinjaById($ninjaId);

$valid = true;

// 1. Nama & email tidak boleh kosong
if ($namaPemain === '' || $email === '') {
    $valid = false;
}

// 2. Email harus format valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid = false;
}

// 3. Ninja harus ada di data
if ($ninja === null) {
    $valid = false;
}

// 4. Jumlah koin harus angka dan minimal sesuai harga ninja
if (!ctype_digit($jumlahKoinBersih)) {
    $valid = false;
} elseif ($ninja !== null && (int) $jumlahKoinBersih < (int) $ninja['harga']) {
    $valid = false;
}

if (!$valid) {
    header('Location: index.php?status=gagal');
    exit;
}

// ============================================================
// Simpan transaksi ke transaksi.txt (append mode, baris baru)
// Format: waktu|nama_pemain|email|nama_ninja|harga_ninja|jumlah_dibayar
// ============================================================
$baris = implode('|', [
    date('Y-m-d H:i:s'),
    $namaPemain,
    $email,
    $ninja['nama'],
    $ninja['harga'],
    $jumlahKoinBersih,
]) . PHP_EOL;

$file = __DIR__ . '/transaksi.txt';
file_put_contents($file, $baris, FILE_APPEND | LOCK_EX);

header('Location: index.php?status=sukses');
exit;
