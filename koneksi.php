<?php
/**
 * ============================================================================
 * File: koneksi.php
 * Deskripsi: Konfigurasi koneksi database MySQL (phpMyAdmin) untuk Kopi Nusantara.
 * ============================================================================
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "db_kopi_nusantara";

$conn = @mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$DB_CONNECTED = ($conn !== false);

if ($DB_CONNECTED) {
    mysqli_set_charset($conn, "utf8mb4");
    // Pastikan tabel iklan_video tersedia otomatis
    @mysqli_query($conn, "CREATE TABLE IF NOT EXISTS iklan_video (
        id_iklan INT PRIMARY KEY DEFAULT 1,
        judul_iklan VARCHAR(200) NOT NULL,
        url_video TEXT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");
}

function format_rupiah($angka) {
    return "Rp" . number_format((int)$angka, 0, ",", ".");
}

function format_wa_number($nomor) {
    $clean = preg_replace('/[^0-9]/', '', (string)$nomor);
    if (substr($clean, 0, 1) === '0') {
        $clean = '62' . substr($clean, 1);
    } elseif (substr($clean, 0, 2) !== '62' && strlen($clean) > 5) {
        $clean = '62' . $clean;
    }
    return $clean;
}

/**
 * Konversi otomatis link YouTube apa saja (youtu.be, watch?v=, shorts/, embed/)
 * atau link .mp4 menjadi siap putar di halaman utama!
 */
function parse_video_iklan($url) {
    $url = trim((string)$url);
    if ($url === '') {
        return ['type' => 'youtube', 'src' => 'https://www.youtube-nocookie.com/embed/eUK2fI-cEp8?rel=0'];
    }
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        return [
            'type' => 'youtube',
            'id'   => $matches[1],
            'src'  => 'https://www.youtube-nocookie.com/embed/' . $matches[1] . '?rel=0'
        ];
    }
    return [
        'type' => 'mp4',
        'src'  => $url
    ];
}

/**
 * Ambil data video iklan aktif dari database (atau fallback default)
 */
function get_video_iklan($conn, $db_connected) {
    $default = [
        'judul_iklan' => 'Video Profil & Promo Kopi Nusantara BANG UDIN',
        'url_video'   => 'https://youtu.be/eUK2fI-cEp8?si=aBtxsC6bzuCdLuly'
    ];
    if ($db_connected) {
        $res = @mysqli_query($conn, "SELECT * FROM iklan_video WHERE id_iklan = 1 LIMIT 1");
        if ($res && mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        } else {
            $j = mysqli_real_escape_string($conn, $default['judul_iklan']);
            $u = mysqli_real_escape_string($conn, $default['url_video']);
            @mysqli_query($conn, "INSERT IGNORE INTO iklan_video (id_iklan, judul_iklan, url_video) VALUES (1, '$j', '$u')");
        }
    }
    return $default;
}

function get_default_products() {
    return [
        ['id_produk' => 1, 'id_kategori' => 1, 'nama_kategori' => 'Kopi Kemasan (Biji & Bubuk)', 'nama_produk' => 'Kopi Toraja nur (250gr)', 'harga' => 65000, 'stok' => 35, 'gambar' => 'img/nursarip.jpg', 'deskripsi' => 'Kopi Arabika khas Tana Toraja dengan aroma rempah, body tebal, dan keasaman seimbang.'],
        ['id_produk' => 2, 'id_kategori' => 1, 'nama_kategori' => 'Kopi Kemasan (Biji & Bubuk)', 'nama_produk' => 'Kopi Aceh Gayo Wine (250gr)', 'harga' => 70000, 'stok' => 28, 'gambar' => 'img/kopi-gayo.jpg', 'deskripsi' => 'Biji kopi pilihan dataran tinggi Gayo dengan sentuhan aroma fruity dan aftertaste manis.'],
        ['id_produk' => 3, 'id_kategori' => 1, 'nama_kategori' => 'Kopi Kemasan (Biji & Bubuk)', 'nama_produk' => 'Kopi Bali Kintamani (250gr)', 'harga' => 60000, 'stok' => 40, 'gambar' => 'img/kopi-kintamani.jpg', 'deskripsi' => 'Kopi Arabika Bali dengan cita rasa citrus segar dan aroma floral yang lembut.'],
        ['id_produk' => 4, 'id_kategori' => 2, 'nama_kategori' => 'Minuman Siap Saji', 'nama_produk' => 'Es Kopi Susu Gula Aren Nusantara', 'harga' => 18000, 'stok' => 100, 'gambar' => 'img/es-kopi-gula-aren.jpg', 'deskripsi' => 'Perpaduan espresso house blend, susu segar creamy, dan gula aren organik asli.'],
        ['id_produk' => 5, 'id_kategori' => 2, 'nama_kategori' => 'Minuman Siap Saji', 'nama_produk' => 'Cappuccino Nusantara Hot/Ice', 'harga' => 22000, 'stok' => 85, 'gambar' => 'img/cappuccino-nusantara.jpg', 'deskripsi' => 'Espresso double shot dengan microfoam susu lembut dan taburan cokelat bubuk.'],
        ['id_produk' => 6, 'id_kategori' => 2, 'nama_kategori' => 'Minuman Siap Saji', 'nama_produk' => 'Kopi Tubruk Klasik Nusantara', 'harga' => 12000, 'stok' => 120, 'gambar' => 'img/kopi-tubruk-klasik.jpg', 'deskripsi' => 'Seduhan kopi hitam robusta-arabika tradisional dengan aroma pekat autentik.']
    ];
}
?>
