# Shinobi Arena: Ultimate Jutsu Showdown!

Website promosi game — dibangun dengan PHP native, HTML, CSS Grid/Flexbox murni,
dan JavaScript native (tanpa framework/library apa pun).

## Struktur File

```
shinobi-arena/
├── index.php        # Halaman utama: katalog ninja + form pembelian
├── data.php          # Sumber data ninja (dipakai index.php & proses.php)
├── proses.php        # Validasi server-side + simpan ke transaksi.txt (append)
├── login.php         # Login admin sederhana (hardcoded), set session
├── logout.php        # Hapus session admin
├── riwayat.php        # Halaman admin (dilindungi session) — tabel riwayat transaksi
├── transaksi.txt      # File penyimpanan transaksi (append mode)
├── style.css          # Styling — CSS Grid & Flexbox murni, tanpa framework
└── script.js           # Validasi form native JS (tanpa alert(), tanpa jQuery)
```

## Cara Menjalankan

Proyek ini butuh server PHP (native, tidak ada dependency composer/npm).

**Opsi 1 — PHP Built-in Server**
```bash
cd shinobi-arena
php -S localhost:8000
```
Buka `http://localhost:8000` di browser.

**Opsi 2 — XAMPP / Laragon / MAMP**
Salin folder `shinobi-arena` ke direktori `htdocs` (XAMPP) atau `www` (Laragon),
lalu akses `http://localhost/shinobi-arena/`.

Pastikan folder proyek dan file `transaksi.txt` memiliki izin tulis (writable),
karena PHP akan menulis ke file tersebut setiap ada transaksi baru.

## Login Admin

Buka `login.php` (atau klik link "Panel Admin" di footer beranda):

- **Username:** `admin`
- **Password:** `admin123`

Kredensial ini hardcoded langsung di `login.php` sesuai ketentuan tugas
(tanpa database).

## Catatan Implementasi

- **Tidak ada** framework CSS (Bootstrap/Tailwind), **tidak ada** elemen `<table>`
  untuk katalog ninja — layout kartu memakai CSS Grid murni (`.card-grid`).
- **Tidak ada** library JavaScript (jQuery dll) — validasi form 100% native
  (`document.getElementById`, event listener, manipulasi `textContent`/`classList`).
- Validasi error muncul secara dinamis di bawah setiap input, bukan lewat `alert()`.
- Validasi dilakukan dua kali: di JS (client-side, untuk UX) dan di `proses.php`
  (server-side, untuk keamanan data) — sesuai praktik yang baik.
- Data transaksi disimpan sebagai satu baris teks dengan pemisah `|`:
  `waktu|nama_pemain|email|nama_ninja|harga_ninja|jumlah_dibayar`, ditambahkan
  ke `transaksi.txt` lewat `FILE_APPEND` (tidak menimpa data lama).
- Halaman `riwayat.php` memakai `session_start()` dan mengecek
  `$_SESSION['admin_logged_in']`; jika belum login, otomatis diarahkan ke
  `login.php`.
