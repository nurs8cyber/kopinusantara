================================================================================
PROYEK UJI KOMPETENSI JUNIOR PROGRAMMER 2026
Judul Proyek : Website Promosi & Pemesanan Produk "KOPI NUSANTARA"
Pengembang   : Keenan Technology StartUp
================================================================================

1. DESKRIPSI PROYEK
Website "KOPI NUSANTARA" adalah aplikasi web promosi dan pemesanan kopi kemasan
serta minuman siap saji berbasis PHP, HTML, CSS, JavaScript, dan MySQL (phpMyAdmin).
Dilengkapi dengan fitur:
- 4 Halaman Utama Publik: Beranda (index.php), Produk & Pemesanan (produk.php),
  Tentang Kami (tentang.php), dan Kontak (kontak.php).
- Elemen Multimedia: Galeri foto produk & roastery, video profil singkat, dan
  animasi interaktif.
- Keranjang & Kalkulasi Otomatis: Menghitung total belanja dan kembalian secara
  otomatis.
- Struk Digital Cetak & Kirim WhatsApp: Struk pembayaran dapat langsung dicetak
  (Print) maupun dikirim langsung ke WhatsApp pelanggan cukup dengan menginput
  nomor WhatsApp pelanggan.
- Dashboard Admin CRUD Lengkap (admin/login.php -> admin/dashboard.php):
  Create, Read, Update, dan Delete data produk, kategori, dan transaksi.

2. STRUKTUR FOLDER & FILE
/kopi-nusantara-ukk
  |-- index.php          (Halaman Beranda, Video Profil, Produk Unggulan, Galeri)
  |-- produk.php         (Halaman Katalog Produk & Form Pemesanan + Struk WA)
  |-- tentang.php        (Halaman Tentang Kami)
  |-- kontak.php         (Halaman Kontak & Lokasi)
  |-- pesan.php          (Pemroses simpan transaksi ke database MySQL)
  |-- header.php         (Template Header & Navigasi Responsif)
  |-- footer.php         (Template Footer & Modal Struk Cetak / Kirim WhatsApp)
  |-- koneksi.php        (Konfigurasi koneksi MySQL / phpMyAdmin)
  |-- database.sql       (Skema tabel & data awal untuk di-import ke phpMyAdmin)
  |-- README.txt         (Dokumentasi proyek)
  |-- /css
  |     |-- style.css    (Stylesheet kustom & aturan print struk)
  |-- /js
  |     |-- app.js       (Logika keranjang, kalkulasi otomatis, cetak & kirim WA)
  |-- /img               (Aset logo dan gambar produk kopi)
  |-- /admin
        |-- login.php    (Halaman login administrator)
        |-- dashboard.php(Halaman CRUD Produk & Riwayat Transaksi)

3. LIBRARY FRONT-END YANG DIGUNAKAN
- Tailwind CSS (CDN) untuk tata letak responsif desktop, tablet, dan mobile.
- Animate.css (CDN) untuk animasi transisi elemen halaman.

4. CARA MENJALANKAN DI LOCALHOST (XAMPP / LARAGON)
1. Ekstrak folder ini ke dalam direktori htdocs (contoh: C:\xampp\htdocs\kopi-nusantara).
2. Jalankan Apache dan MySQL pada XAMPP Control Panel.
3. Buka http://localhost/phpmyadmin, buat database baru bernama: db_kopi_nusantara
4. Klik tab Import, pilih file database.sql dari folder proyek ini, lalu klik Go.
5. Buka browser dan akses: http://localhost/kopi-nusantara/
6. Untuk masuk ke halaman Admin CRUD, klik tombol "Admin" atau akses:
   http://localhost/kopi-nusantara/admin/login.php
   - Username : admin
   - Password : 123
================================================================================
