<?php
require_once 'koneksi.php';
$page_title = "Beranda — KOPI NUSANTARA BANG UDIN | Kopi Lokal Indonesia";

$produk_list = [];
if ($DB_CONNECTED) {
    $res = mysqli_query($conn, "SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.id_kategori = k.id_kategori ORDER BY p.id_produk ASC LIMIT 6");
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $produk_list[] = $row;
        }
    }
}
if (empty($produk_list)) {
    $produk_list = get_default_products();
}

$iklan = get_video_iklan($conn, $DB_CONNECTED);
$video_parsed = parse_video_iklan($iklan['url_video']);

include 'header.php';
?>

<!-- HERO SECTION -->
<section class="hero-nusantara py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div class="animate__animated animate__fadeInLeft">
      <span class="inline-block px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-400 text-xs font-bold uppercase tracking-wider mb-5">
        🇮🇩 100% Biji Kopi Pilihan Nusantara BANG UDIN
      </span>
      <h1 class="font-serif-display font-extrabold text-4xl sm:text-6xl leading-tight text-[#f7efe5]">
        Cita Rasa Autentik <span class="text-amber-500">Kopi Nusantara BANG UDIN</span> di Setiap Tegukan.
      </h1>
      <p class="mt-5 text-base sm:text-lg text-[#cbbba8] leading-relaxed">
        Nikmati kopi kemasan sangrai segar (Toraja, Gayo, Kintamani) maupun minuman kopi siap saji langsung dari barista terbaik kami. Pesan mudah, struk bisa langsung dicetak atau dikirim ke WhatsApp Anda!
      </p>
      <div class="mt-8 flex flex-wrap gap-4">
        <a href="produk.php" class="bg-amber-600 hover:bg-amber-500 text-white font-bold px-7 py-3.5 rounded-full shadow-lg shadow-amber-600/30 transition-all">
          Lihat Katalog & Pesan
        </a>
        <a href="#video-profil" class="border border-white/20 hover:border-amber-400 text-[#f7efe5] font-semibold px-7 py-3.5 rounded-full transition-colors">
          ▶ Tonton Video Profil
        </a>
      </div>
    </div>

    <!-- VIDEO PROFIL / IKLAN (DIKELOLA ADMIN CUKUP TEMPEL LINK) -->
    <div id="video-profil" class="animate__animated animate__fadeInRight">
      <div class="rounded-3xl p-2.5 bg-gradient-to-br from-amber-500/30 to-[#24160e] border border-amber-500/30 shadow-2xl">
        <div class="aspect-video rounded-2xl overflow-hidden bg-black relative">
          <?php if ($video_parsed['type'] === 'youtube'): ?>
            <iframe
              class="w-full h-full"
              src="<?php echo htmlspecialchars($video_parsed['src']); ?>"
              title="<?php echo htmlspecialchars($iklan['judul_iklan']); ?>"
              frameborder="0"
              referrerpolicy="strict-origin-when-cross-origin"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen>
            </iframe>
          <?php else: ?>
            <video class="w-full h-full object-cover" controls playsinline poster="img/hero-kopi.jpg">
              <source src="<?php echo htmlspecialchars($video_parsed['src']); ?>" type="video/mp4" />
              Browser Anda tidak mendukung pemutar video.
            </video>
          <?php endif; ?>
        </div>
        <div class="px-3 pt-3 pb-1 flex flex-wrap items-center justify-between gap-2 text-xs text-[#cbbba8]">
          <span class="font-bold text-amber-400">● <?php echo htmlspecialchars($iklan['judul_iklan']); ?></span>
          <a href="<?php echo htmlspecialchars($iklan['url_video']); ?>" target="_blank" rel="noopener" class="text-[11px] text-amber-300 hover:underline">Buka di YouTube ↗</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PRODUK UNGGULAN -->
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
  <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
    <div>
      <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Pilihan Terbaik</span>
      <h2 class="font-serif-display font-extrabold text-3xl sm:text-4xl mt-1">Produk Kopi Unggulan</h2>
    </div>
    <a href="produk.php" class="text-sm font-bold text-amber-400 hover:underline">Lihat Semua Produk & Form Pemesanan →</a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($produk_list as $p): ?>
      <article class="product-card overflow-hidden flex flex-col justify-between">
        <div>
          <div class="relative h-52 overflow-hidden bg-[#24160e]">
            <img src="<?php echo htmlspecialchars($p['gambar']); ?>" alt="<?php echo htmlspecialchars($p['nama_produk']); ?>" class="w-full h-full object-cover" />
            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-bold bg-black/75 text-amber-400 border border-amber-500/30">
              <?php echo htmlspecialchars($p['nama_kategori'] ?? 'Kopi Nusantara'); ?>
            </span>
          </div>
          <div class="p-5">
            <h3 class="font-bold text-lg text-[#f7efe5]"><?php echo htmlspecialchars($p['nama_produk']); ?></h3>
            <p class="text-xs text-[#cbbba8] mt-1.5 leading-relaxed"><?php echo htmlspecialchars($p['deskripsi']); ?></p>
          </div>
        </div>
        <div class="px-5 pb-5 pt-3 border-t border-white/10 flex items-center justify-between">
          <div>
            <div class="font-extrabold text-lg text-amber-400"><?php echo format_rupiah($p['harga']); ?></div>
            <div class="text-[11px] text-[#cbbba8]">Stok: <?php echo (int)$p['stok']; ?></div>
          </div>
          <a href="produk.php#form-pemesanan" class="bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-colors">
            Pesan Sekarang
          </a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<!-- GALERI FOTO KOPI NUSANTARA BANG UDIN -->
<section class="py-14 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
  <div class="text-center max-w-2xl mx-auto mb-10">
    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Galeri Foto</span>
    <h2 class="font-serif-display font-extrabold text-3xl mt-1">Dari Kebun Nusantara ke Cangkir Anda</h2>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="rounded-2xl overflow-hidden border border-white/10 h-64 relative group">
      <img src="img/galeri-roasting.jpg" alt="Proses Roasting Kopi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent p-5 flex items-end">
        <div class="font-bold text-sm text-amber-300">Roasting Biji Kopi Pilihan</div>
      </div>
    </div>
    <div class="rounded-2xl overflow-hidden border border-white/10 h-64 relative group">
      <img src="img/galeri-barista.jpg" alt="Seduhan Barista" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent p-5 flex items-end">
        <div class="font-bold text-sm text-amber-300">Racikan Barista Profesional</div>
      </div>
    </div>
    <div class="rounded-2xl overflow-hidden border border-white/10 h-64 relative group">
      <img src="img/galeri-kedai.jpg" alt="Suasana Kedai Kopi Nusantara" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent p-5 flex items-end">
        <div class="font-bold text-sm text-amber-300">Kedai Nyaman & Modern</div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
