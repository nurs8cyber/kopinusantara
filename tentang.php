<?php
require_once 'koneksi.php';
$page_title = "Tentang Kami — KOPI NUSANTARA";
include 'header.php';
?>
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    <div>
      <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Tentang Kopi Nusantara BANG UDIN</span>
      <h1 class="font-serif-display font-extrabold text-3xl sm:text-5xl mt-2 leading-tight">Mengangkat Kekayaan Kopi Petani Lokal Indonesia</h1>
      <p class="text-sm sm:text-base text-[#cbbba8] mt-5 leading-relaxed">
        <strong>KOPI NUSANTARA BANG UDIN</strong> dikembangkan oleh tim <strong>Politeknik Bhakti Kartini</strong> sebagai platform promosi digital dan pemesanan produk kopi kemasan maupun minuman siap saji.
      </p>
      <p class="text-sm sm:text-base text-[#cbbba8] mt-4 leading-relaxed">
        Kami bekerja sama langsung dengan petani kopi di Tana Toraja, Aceh Gayo, dan Kintamani Bali untuk menghadirkan biji kopi sangrai berkualitas tinggi dengan sistem pemesanan modern yang terintegrasi dengan struk cetak dan pengiriman struk langsung ke WhatsApp pelanggan.
      </p>
      <div class="grid grid-cols-3 gap-4 mt-8">
        <div class="bg-[#1b130e] border border-white/10 rounded-2xl p-4 text-center">
          <div class="font-extrabold text-2xl text-amber-400">100%</div>
          <div class="text-xs text-[#cbbba8] mt-1">Kopi Asli Lokal</div>
        </div>
        <div class="bg-[#1b130e] border border-white/10 rounded-2xl p-4 text-center">
          <div class="font-extrabold text-2xl text-amber-400">Fresh</div>
          <div class="text-xs text-[#cbbba8] mt-1">Roasted Weekly</div>
        </div>
        <div class="bg-[#1b130e] border border-white/10 rounded-2xl p-4 text-center">
          <div class="font-extrabold text-2xl text-amber-400">24/7</div>
          <div class="text-xs text-[#cbbba8] mt-1">Order Online</div>
        </div>
      </div>
    </div>
    <div class="rounded-3xl overflow-hidden border border-amber-500/30 shadow-2xl">
      <img src="img/galeri-roasting.jpg" alt="Roastery Kopi Nusantara" class="w-full h-96 object-cover" />
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
