<?php
require_once 'koneksi.php';
$page_title = "Kontak Kami — KOPI NUSANTARA";
$pesan_terkirim = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesan_terkirim = true;
}
include 'header.php';
?>
<section class="py-16 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
  <div class="text-center max-w-2xl mx-auto mb-12">
    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Hubungi Kami</span>
    <h1 class="font-serif-display font-extrabold text-3xl sm:text-4xl mt-1">Kontak & Lokasi Kedai</h1>
    <p class="text-sm text-[#cbbba8] mt-2">Punya pertanyaan seputar kemitraan kopi kemasan atau pemesanan acara? Kirimkan pesan Anda di bawah ini.</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-[#1b130e] border border-white/10 rounded-3xl p-6 sm:p-8 space-y-5">
      <h2 class="font-bold text-xl text-amber-400">Informasi Kontak</h2>
      <div class="space-y-3 text-sm text-[#cbbba8]">
        <p><strong class="text-white">Perusahaan:</strong> Politeknik Bhakti Kartini— Kopi Nusantara bang udin</p>
        <p><strong class="text-white">Alamat:</strong> Jl. Caringin, RT.001/RW.005, Bojong Rawalumbu, Kec. Rawalumbu, Kota Bks, Jawa Barat 17116</p>
        <p><strong class="text-white">Telepon / WhatsApp:</strong> 089518000755</p>
        <p><strong class="text-white">Email:</strong> nursya47@gmail.com</p>
      </div>
      <div class="rounded-2xl overflow-hidden border border-white/10 h-56">
        <iframe title="Peta Lokasi" src="https://maps.google.com/maps?q=-6.2951028,106.9962523+(Politeknik+Bhakti+Kartini)&t=&z=17&ie=UTF8&iwloc=B&output=embed" class="w-full h-full border-0" loading="lazy"></iframe>
      </div>
    </div>

    <div class="bg-[#1b130e] border border-white/10 rounded-3xl p-6 sm:p-8">
      <h2 class="font-bold text-xl text-amber-400 mb-4">Kirim Pesan</h2>
      <?php if ($pesan_terkirim): ?>
        <div class="mb-4 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm">
          Terima kasih! Pesan Anda telah diterima oleh tim Kopi Nusantara.
        </div>
      <?php endif; ?>
      <form method="POST" class="space-y-4">
        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Nama Lengkap *</label>
          <input type="text" name="nama" required class="w-full bg-[#110c09] border border-white/15 rounded-xl px-4 py-3 text-sm text-white" />
        </div>
        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Nomor WhatsApp *</label>
          <input type="tel" name="wa" required class="w-full bg-[#110c09] border border-white/15 rounded-xl px-4 py-3 text-sm text-white" />
        </div>
        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Isi Pesan *</label>
          <textarea name="pesan" rows="4" required class="w-full bg-[#110c09] border border-white/15 rounded-xl px-4 py-3 text-sm text-white"></textarea>
        </div>
        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-bold py-3 rounded-xl text-sm">Kirim Pesan Sekarang</button>
      </form>
    </div>
  </div>
</section>
<?php include 'footer.php'; ?>
