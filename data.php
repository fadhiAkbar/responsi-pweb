<?php
// Sumber data ninja tunggal (dipakai index.php untuk render & proses.php untuk validasi harga)
function getNinjas() {
    return [
        [
            "id"     => "kaito",
            "nama"   => "Kaito Ryuzaki",
            "desa"   => "Desa Awan Merah",
            "jutsu"  => "Naga Petir Membelah Langit",
            "harga"  => 500000,
            "rank"   => "S",
            "foto"   => "https://placehold.co/400x500/1b1f2a/c9a227?text=Kaito+Ryuzaki&font=playfair-display"
        ],
        [
            "id"     => "hana",
            "nama"   => "Hana Mizuki",
            "desa"   => "Desa Air Jernih",
            "jutsu"  => "Gelombang Seribu Cermin Es",
            "harga"  => 350000,
            "rank"   => "A",
            "foto"   => "https://placehold.co/400x500/1b1f2a/6fa8a3?text=Hana+Mizuki&font=playfair-display"
        ],
        [
            "id"     => "ryu",
            "nama"   => "Ryu Tatsumaki",
            "desa"   => "Desa Angin Puncak",
            "jutsu"  => "Badai Tornado Penebas Bayangan",
            "harga"  => 420000,
            "rank"   => "A",
            "foto"   => "https://placehold.co/400x500/1b1f2a/c23b3b?text=Ryu+Tatsumaki&font=playfair-display"
        ],
        [
            "id"     => "sora",
            "nama"   => "Sora Kagerou",
            "desa"   => "Desa Bayangan Senja",
            "jutsu"  => "Seribu Bayangan Malam Kelabu",
            "harga"  => 275000,
            "rank"   => "B",
            "foto"   => "https://placehold.co/400x500/1b1f2a/9b8bb4?text=Sora+Kagerou&font=playfair-display"
        ],
    ];
}

function getNinjaById($id) {
    foreach (getNinjas() as $n) {
        if ($n['id'] === $id) return $n;
    }
    return null;
}
