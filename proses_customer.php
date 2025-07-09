<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_produk = intval($_POST['id_produk']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlah_produk = intval($_POST['jumlah_produk']);

    // Hilangkan titik dari harga (misal: "20.000" → 20000)
    $total_harga = str_replace('.', '', $_POST['total_harga']);
    $total_harga = intval($total_harga);

    // Masukkan ke database
    $query = "INSERT INTO raisa_pesanan 
        (id_produk, customer_name, no_hp, alamat, jumlah_produk, total_harga)
        VALUES 
        ('$id_produk', '$customer_name', '$no_hp', '$alamat', '$jumlah_produk', '$total_harga')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('✅ Pesanan berhasil dikirim!'); window.location.href='katalog.php';</script>";
    } else {
        echo "❌ Terjadi kesalahan saat menyimpan pesanan: " . mysqli_error($conn);
    }
} else {
    echo "❌ Akses tidak diizinkan.";
}
?>
