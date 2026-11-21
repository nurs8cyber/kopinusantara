<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $DB_CONNECTED) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode_struk'] ?? ('KN-' . rand(100000, 999999)));
    $nama = mysqli_real_escape_string($conn, $_POST['nama_pelanggan'] ?? 'Pelanggan');
    $no_wa = mysqli_real_escape_string($conn, $_POST['no_wa'] ?? '');
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
    $detail = mysqli_real_escape_string($conn, $_POST['detail_pesanan'] ?? '[]');
    $total = (int)($_POST['total_bayar'] ?? 0);
    $dibayar = (int)($_POST['uang_diterima'] ?? $total);
    $kembalian = (int)($_POST['kembalian'] ?? 0);

    mysqli_query($conn, "INSERT INTO pelanggan (nama_pelanggan, no_wa, alamat) VALUES ('$nama', '$no_wa', '$alamat')");
    $sql = "INSERT INTO transaksi (kode_struk, nama_pelanggan, no_wa, alamat, detail_pesanan, total_bayar, uang_diterima, kembalian)
            VALUES ('$kode', '$nama', '$no_wa', '$alamat', '$detail', $total, $dibayar, $kembalian)";
    $ok = mysqli_query($conn, $sql);

    header('Content-Type: application/json');
    echo json_encode(['status' => $ok ? 'ok' : 'error']);
    exit;
}
header("Location: produk.php");
exit;
?>
