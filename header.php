<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'KOPI NUSANTARA — Kopi Lokal Indonesia'; ?></title>
  <link rel="icon" href="img/logo.png" type="image/png" />
  <!-- Library Front-End: Tailwind CSS & Animate.css -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="bg-[#110c09] text-[#f7efe5] antialiased min-h-screen flex flex-col">

  <!-- NAVBAR UTAMA -->
  <header class="sticky top-0 z-40 bg-[#160f0b]/95 backdrop-blur border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
      <a href="index.php" class="flex items-center gap-3">
        <img src="img/logo.png" alt="Logo Kopi Nusantara" class="w-11 h-11 rounded-full object-cover border-2 border-amber-500" />
        <div>
          <span class="font-serif-display font-extrabold text-xl text-[#f7efe5]">KOPI <span class="text-amber-500">NUSANTARA</span></span>
          <p class="text-[11px] text-[#cbbba8] hidden sm:block">Keenan Technology StartUp • Kopi Lokal</p>
        </div>
      </a>

      <nav class="hidden md:flex items-center gap-7 text-sm font-semibold">
        <a href="index.php" class="<?php echo $current_page === 'index.php' ? 'text-amber-400' : 'text-[#cbbba8] hover:text-amber-400'; ?> transition-colors">Beranda</a>
        <a href="produk.php" class="<?php echo $current_page === 'produk.php' ? 'text-amber-400' : 'text-[#cbbba8] hover:text-amber-400'; ?> transition-colors">Produk</a>
        <a href="tentang.php" class="<?php echo $current_page === 'tentang.php' ? 'text-amber-400' : 'text-[#cbbba8] hover:text-amber-400'; ?> transition-colors">Tentang Kami</a>
        <a href="kontak.php" class="<?php echo $current_page === 'kontak.php' ? 'text-amber-400' : 'text-[#cbbba8] hover:text-amber-400'; ?> transition-colors">Kontak & Pesan</a>
      </nav>

      <div class="flex items-center gap-2.5">
        <a href="produk.php#form-pemesanan" class="bg-amber-600 hover:bg-amber-500 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-full transition-colors">
          🛒 Pesan Kopi
        </a>
        <a href="admin/login.php" class="border border-amber-500/40 hover:bg-amber-500/20 text-amber-300 text-xs sm:text-sm font-bold px-4 py-2.5 rounded-full transition-colors">
          Admin
        </a>
      </div>
    </div>

    <!-- Mobile Navigation Bar -->
    <div class="md:hidden flex justify-around border-t border-white/10 py-2 text-xs font-semibold bg-[#130d09]">
      <a href="index.php" class="<?php echo $current_page === 'index.php' ? 'text-amber-400' : 'text-[#cbbba8]'; ?>">Beranda</a>
      <a href="produk.php" class="<?php echo $current_page === 'produk.php' ? 'text-amber-400' : 'text-[#cbbba8]'; ?>">Produk</a>
      <a href="tentang.php" class="<?php echo $current_page === 'tentang.php' ? 'text-amber-400' : 'text-[#cbbba8]'; ?>">Tentang Kami</a>
      <a href="kontak.php" class="<?php echo $current_page === 'kontak.php' ? 'text-amber-400' : 'text-[#cbbba8]'; ?>">Kontak</a>
    </div>
  </header>
  <main class="flex-1">
