<?php
require_once 'koneksi.php';
$page_title = "Produk & Pemesanan — KOPI NUSANTARA";

$produk_list = [];
$kategori_list = [];

if ($DB_CONNECTED) {
    $res_kat = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori ASC");
    if ($res_kat) {
        while ($rk = mysqli_fetch_assoc($res_kat)) {
            $kategori_list[] = $rk;
        }
    }
    $res = mysqli_query($conn, "SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.id_kategori = k.id_kategori ORDER BY p.id_produk ASC");
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $produk_list[] = $row;
        }
    }
}

if (empty($produk_list)) {
    $produk_list = get_default_products();
    $kategori_list = [
        ['nama_kategori' => 'Kopi Kemasan (Biji & Bubuk)'],
        ['nama_kategori' => 'Minuman Siap Saji']
    ];
}

include 'header.php';
?>

<section class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
  <div class="mb-8">
    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Katalog & Kasir Online</span>
    <h1 class="font-serif-display font-extrabold text-3xl sm:text-4xl mt-1">Produk Kopi & Pemesanan</h1>
    <p class="text-sm text-[#cbbba8] mt-1">Pilih produk ke keranjang, isi data pelanggan beserta nomor WhatsApp, lalu cetak struk atau kirim struk langsung via WhatsApp.</p>
  </div>

  <!-- Filter & Pencarian -->
  <div class="bg-[#1b130e] border border-white/10 rounded-2xl p-4 mb-8 flex flex-col sm:flex-row gap-4">
    <input id="cariProdukInput" type="text" placeholder="Cari kopi Toraja, Gayo, Gula Aren..." class="flex-1 bg-[#110c09] border border-white/15 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500" />
    <select id="filterKategoriSelect" class="bg-[#110c09] border border-white/15 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500">
      <option value="all">Semua Kategori</option>
      <?php foreach ($kategori_list as $k): ?>
        <option value="<?php echo htmlspecialchars($k['nama_kategori']); ?>"><?php echo htmlspecialchars($k['nama_kategori']); ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- KIRI: DAFTAR PRODUK -->
    <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
      <?php foreach ($produk_list as $p): ?>
        <article class="item-produk-card product-card overflow-hidden flex flex-col justify-between" data-nama="<?php echo htmlspecialchars($p['nama_produk']); ?>" data-kategori="<?php echo htmlspecialchars($p['nama_kategori'] ?? ''); ?>">
          <div>
            <div class="relative h-48 overflow-hidden bg-[#24160e]">
              <img src="<?php echo htmlspecialchars($p['gambar']); ?>" alt="<?php echo htmlspecialchars($p['nama_produk']); ?>" class="w-full h-full object-cover" />
              <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-[11px] font-bold bg-black/75 text-amber-400">
                <?php echo htmlspecialchars($p['nama_kategori'] ?? 'Kopi'); ?>
              </span>
            </div>
            <div class="p-5">
              <h3 class="font-bold text-lg text-[#f7efe5]"><?php echo htmlspecialchars($p['nama_produk']); ?></h3>
              <p class="text-xs text-[#cbbba8] mt-1.5"><?php echo htmlspecialchars($p['deskripsi']); ?></p>
            </div>
          </div>
          <div class="px-5 pb-5 pt-3 border-t border-white/10 flex items-center justify-between">
            <div>
              <div class="font-extrabold text-lg text-amber-400"><?php echo format_rupiah($p['harga']); ?></div>
              <div class="text-[11px] text-[#cbbba8]">Stok: <?php echo (int)$p['stok']; ?></div>
            </div>
            <button type="button" onclick="tambahKeKeranjang(<?php echo (int)$p['id_produk']; ?>, '<?php echo addslashes($p['nama_produk']); ?>', <?php echo (int)$p['harga']; ?>)" class="bg-amber-600 hover:bg-amber-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-colors">
              + Tambah
            </button>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- KANAN: KERANJANG & FORM PEMESANAN -->
    <div id="form-pemesanan" class="lg:col-span-4 bg-[#1b130e] border border-amber-500/30 rounded-3xl p-5 sm:p-6 sticky top-24 space-y-5 shadow-2xl">
      <div class="flex items-center justify-between border-b border-white/10 pb-3">
        <h2 class="font-serif-display font-bold text-xl text-[#f7efe5]">🛒 Keranjang & Struk</h2>
        <span id="badgeJumlahKeranjang" class="px-2.5 py-0.5 rounded-full bg-amber-600 text-white text-xs font-bold">0</span>
      </div>

      <div id="daftarKeranjang" class="space-y-2.5 max-h-60 overflow-y-auto"></div>

      <div class="pt-3 border-t border-white/10 flex justify-between items-center">
        <span class="text-sm text-[#cbbba8]">Total Harga</span>
        <span id="totalHargaPesanan" class="font-extrabold text-2xl text-amber-400">Rp0</span>
      </div>

      <form onsubmit="return prosesPesananSekarang(event)" class="space-y-3.5 pt-2 border-t border-white/10">
        <input type="hidden" id="inputDetailPesananJson" name="detail_pesanan" />
        <input type="hidden" id="inputTotalBayarHidden" name="total_bayar" />

        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Nama Pelanggan *</label>
          <input id="inputNamaPelanggan" type="text" required placeholder="Nama lengkap pelanggan" class="w-full bg-[#110c09] border border-white/15 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-amber-500" />
        </div>

        <div>
          <label class="block text-xs text-emerald-400 font-semibold mb-1">Nomor WhatsApp Pelanggan (Untuk Kirim Struk) *</label>
          <input id="inputNoWaPelanggan" type="tel" required placeholder="Contoh: 081234567890" class="w-full bg-[#110c09] border border-emerald-500/40 rounded-xl px-3.5 py-2.5 text-sm text-white focus:outline-none focus:border-emerald-400" />
        </div>

        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Alamat Pengiriman / Nomor Meja *</label>
          <textarea id="inputAlamatPelanggan" rows="2" required placeholder="Alamat lengkap atau Meja No. 05" class="w-full bg-[#110c09] border border-white/15 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-amber-500"></textarea>
        </div>

        <div>
          <label class="block text-xs text-[#cbbba8] mb-1">Uang Diterima / Pembayaran (Rp)</label>
          <input id="inputUangDiterima" type="number" min="0" step="1000" placeholder="Kosongkan jika uang pas ya" class="w-full bg-[#110c09] border border-white/15 rounded-xl px-3.5 py-2 text-sm text-white focus:outline-none focus:border-amber-500" />
        </div>

        <div class="flex justify-between items-center bg-[#110c09] p-3 rounded-xl border border-white/10">
          <span class="text-xs text-[#cbbba8]">Kembalian</span>
          <span id="textUangKembalian" class="font-bold text-emerald-400 text-lg">Rp0</span>
        </div>

        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-extrabold py-3.5 rounded-2xl text-sm shadow-lg shadow-amber-600/30 transition-all">
          ✓ Buat Struk & Kirim WA
        </button>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
