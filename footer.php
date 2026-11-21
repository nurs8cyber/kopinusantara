  </main>

  <!-- MODAL STRUK PEMBAYARAN (CETAK & KIRIM VIA WHATSAPP PELANGGAN YA) -->
  <div id="modalStrukPesanan" class="hidden fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#1b130e] border border-amber-500/40 rounded-3xl max-w-md w-full p-5 sm:p-6 shadow-2xl space-y-4 max-h-[92vh] overflow-y-auto">
      <div class="flex items-center justify-between">
        <h3 class="font-bold text-base text-amber-400">🧾 Struk Pemesanan Kopi Nusantara BANG UDIN</h3>
        <button type="button" onclick="tutupModalStruk()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-red-500 text-white font-bold text-xs">✕</button>
      </div>

      <!-- Kertas Struk Siap Cetak -->
      <div id="receiptPrintArea" class="receipt-paper p-5 text-xs space-y-2 shadow-inner">
        <div class="text-center border-b border-dashed border-black pb-3">
          <div class="font-extrabold text-base tracking-wide">KOPI NUSANTARA</div>
          <div class="text-[11px]">Keenan Technology StartUp • Kopi Lokal</div>
          <div class="text-[11px]">Jl. Garuda 1 Blok A3 No.3, Bogor / Bekasi</div>
        </div>
        <div class="flex justify-between text-[11px]">
          <span>No: <strong id="strukKode">KN-001</strong></span>
          <span id="strukTanggal">-</span>
        </div>
        <div class="text-[11px] border-b border-dashed border-black pb-2">
          <div>Pelanggan: <strong id="strukNamaPelanggan">-</strong></div>
          <div>Alamat: <span id="strukAlamatPelanggan">-</span></div>
        </div>
        <div id="strukDaftarItem" class="space-y-1.5 py-2 border-b border-dashed border-black"></div>
        <div class="space-y-1 pt-1">
          <div class="flex justify-between font-bold text-sm">
            <span>Total Pembayaran</span>
            <span id="strukTotalBayar">Rp0</span>
          </div>
          <div class="flex justify-between">
            <span>Uang Diterima</span>
            <span id="strukUangDiterima">Rp0</span>
          </div>
          <div class="flex justify-between font-bold">
            <span>Uang Kembalian</span>
            <span id="strukKembalian">Rp0</span>
          </div>
        </div>
        <div class="text-center pt-3 border-t border-dashed border-black font-bold">
          Terima kasih telah memesan di Kopi Nusantara!
        </div>
      </div>

      <!-- Input Nomor WA Pelanggan untuk Kirim Struk Langsung -->
      <div class="bg-[#110c09] p-3.5 rounded-2xl border border-emerald-500/30 space-y-2">
        <label for="modalInputNoWaTujuan" class="block text-xs font-bold text-emerald-400">
          📲 Kirim Struk ke WhatsApp Pelanggan (Cukup Input No. WA):
        </label>
        <div class="flex gap-2">
          <input id="modalInputNoWaTujuan" type="tel" placeholder="Contoh: 081234567890" class="flex-1 bg-[#1b130e] border border-white/15 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-emerald-400" />
          <button type="button" onclick="kirimStrukKeWhatsApp()" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-4 py-2 rounded-xl text-xs whitespace-nowrap transition-colors">
            Kirim WA
          </button>
        </div>
      </div>

      <!-- Tombol Aksi Cetak & Selesai -->
      <div class="flex gap-2.5">
        <button type="button" onclick="window.print()" class="flex-1 bg-white hover:bg-gray-200 text-black font-bold py-2.5 rounded-xl text-xs transition-colors">
          🖨️ Cetak Struk
        </button>
        <button type="button" onclick="tutupModalStruk()" class="flex-1 bg-amber-600 hover:bg-amber-500 text-white font-bold py-2.5 rounded-xl text-xs transition-colors">
          Selesai
        </button>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-[#0b0705] border-t border-white/10 mt-16 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <div class="flex items-center gap-3">
          <img src="img/logo.png" alt="Logo" class="w-10 h-10 rounded-full border border-amber-500" />
          <span class="font-serif-display font-extrabold text-xl">KOPI <span class="text-amber-500">NUSANTARA</span></span>
        </div>
        <p class="text-sm text-[#cbbba8] mt-3">Menghadirkan cita rasa biji kopi lokal terbaik dari Sabang sampai Merauke dalam kemasan maupun sajian hangat.</p>
      </div>
      <div>
        <h4 class="font-bold text-sm uppercase tracking-wider text-amber-400 mb-3">Navigasi Halaman</h4>
        <ul class="space-y-2 text-sm text-[#cbbba8]">
          <li><a href="index.php" class="hover:text-amber-400">Beranda</a></li>
          <li><a href="produk.php" class="hover:text-amber-400">Katalog Produk & Pemesanan</a></li>
          <li><a href="tentang.php" class="hover:text-amber-400">Tentang Kami</a></li>
          <li><a href="kontak.php" class="hover:text-amber-400">Kontak & Lokasi</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-sm uppercase tracking-wider text-amber-400 mb-3">Keenan Technology StartUp</h4>
        <p class="text-sm text-[#cbbba8]">Aplikasi Web Promosi dan Pemesanan Produk Kopi Nusantara BANG UDIN.</p>
        <p class="text-xs text-[#cbbba8]/70 mt-2">Jam Operasional: Setiap Hari 08.00 – 23.00 WIB</p>
      </div>
    </div>
    <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-white/10 text-center text-xs text-[#cbbba8]">
      © 2026 KOPI NUSANTARA By NUR SARIFUDIN — Keenan Technology StartUp. All rights reserved.
    </div>
  </footer>

  <script src="js/app.js"></script>
</body>
</html>
