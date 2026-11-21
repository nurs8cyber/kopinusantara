-- ============================================================================
-- DATABASE: db_kopi_nusantara
-- Proyek: Aplikasi Web Promosi dan Pemesanan Produk "KOPI NUSANTARA"
-- Pengembang: Keenan Technology StartUp (Uji Kompetensi Junior Programmer 2026)
-- ============================================================================

CREATE DATABASE IF NOT EXISTS db_kopi_nusantara CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_kopi_nusantara;

-- 1. Tabel Kategori Produk
CREATE TABLE IF NOT EXISTS kategori (
  id_kategori INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(100) NOT NULL,
  deskripsi TEXT
) ENGINE=InnoDB;

INSERT INTO kategori (id_kategori, nama_kategori, deskripsi) VALUES
(1, 'Kopi Kemasan (Biji & Bubuk)', 'Biji kopi sangrai dan kopi bubuk pilihan dari seluruh penjuru Nusantara.'),
(2, 'Minuman Siap Saji', 'Racikan kopi segar siap minum panas maupun dingin.'),
(3, 'Paket Bundling & Hampers', 'Paket hemat kopi kemasan dan minuman favorit.');

-- 2. Tabel Produk
CREATE TABLE IF NOT EXISTS produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY,
  id_kategori INT NOT NULL,
  nama_produk VARCHAR(150) NOT NULL,
  harga INT NOT NULL DEFAULT 0,
  stok INT NOT NULL DEFAULT 0,
  gambar VARCHAR(255) NOT NULL DEFAULT 'img/kopi-toraja.jpg',
  deskripsi TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO produk (id_produk, id_kategori, nama_produk, harga, stok, gambar, deskripsi) VALUES
(1, 2, 'Kopi Toraja Sapan (250gr)', 65000, 35, 'img/kopi-toraja.jpg', 'Kopi Arabika khas Tana Toraja dengan aroma rempah, body tebal, dan keasaman seimbang.'),
(2, 1, 'Kopi Aceh Gayo Wine (250gr)', 70000, 28, 'img/kopi-gayo.jpg', 'Biji kopi pilihan dataran tinggi Gayo dengan sentuhan aroma fruity dan aftertaste manis.'),
(3, 1, 'Kopi Bali Kintamani (250gr)', 60000, 40, 'img/kopi-kintamani.jpg', 'Kopi Arabika Bali dengan cita rasa citrus segar dan aroma floral yang lembut.'),
(4, 2, 'Es Kopi Susu Gula Aren Nusantara', 18000, 100, 'img/es-kopi-gula-aren.jpg', 'Perpaduan espresso house blend, susu segar creamy, dan gula aren organik asli.'),
(5, 2, 'Cappuccino Nusantara Hot/Ice', 22000, 85, 'img/cappuccino-nusantara.jpg', 'Espresso double shot dengan microfoam susu lembut dan taburan cokelat bubuk.'),
(6, 2, 'Kopi Tubruk Klasik Nusantara', 12000, 120, 'img/kopi-tubruk-klasik.jpg', 'Seduhan kopi hitam robusta-arabika tradisional dengan aroma pekat autentik.');

-- 3. Tabel Video Iklan (Admin cukup tempel link YouTube biasa/shorts/embed atau MP4)
CREATE TABLE IF NOT EXISTS iklan_video (
  id_iklan INT PRIMARY KEY DEFAULT 1,
  judul_iklan VARCHAR(200) NOT NULL,
  url_video TEXT NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO iklan_video (id_iklan, judul_iklan, url_video) VALUES
(1, 'Video Profil & Promo Kopi Nusantara', 'https://youtu.be/eUK2fI-cEp8?si=aBtxsC6bzuCdLuly');

-- 4. Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
  id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
  nama_pelanggan VARCHAR(120) NOT NULL,
  no_wa VARCHAR(25) NOT NULL,
  alamat TEXT
) ENGINE=InnoDB;

-- 5. Tabel Transaksi / Pemesanan
CREATE TABLE IF NOT EXISTS transaksi (
  id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
  kode_struk VARCHAR(30) NOT NULL UNIQUE,
  nama_pelanggan VARCHAR(120) NOT NULL,
  no_wa VARCHAR(25) NOT NULL,
  alamat TEXT NOT NULL,
  detail_pesanan TEXT NOT NULL,
  total_bayar INT NOT NULL,
  uang_diterima INT NOT NULL DEFAULT 0,
  kembalian INT NOT NULL DEFAULT 0,
  tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO transaksi (kode_struk, nama_pelanggan, no_wa, alamat, detail_pesanan, total_bayar, uang_diterima, kembalian) VALUES
('KN-2026001', 'Budi Santoso', '081234567890', 'Jl. Sudirman No. 12, Bekasi', '[{"nama":"Kopi Toraja Sapan (250gr)","qty":1,"harga":65000},{"nama":"Es Kopi Susu Gula Aren Nusantara","qty":2,"harga":18000}]', 101000, 150000, 49000);

-- 6. Tabel Admin
CREATE TABLE IF NOT EXISTS admin_users (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_plain VARCHAR(100) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

INSERT INTO admin_users (username, password_plain, nama_lengkap) VALUES
('admin', '123', 'Administrator Kopi Nusantara');
