<?php
session_start();
include 'koneksi.php';

// Akses hanya untuk admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("❌ Akses ditolak.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = $_POST['product_name'];
    $desc     = $_POST['description'];
    $harga    = (int)$_POST['price'];
    $stok     = (int)$_POST['stok'];
    $gambar   = $_POST['image_product'] ?? '-';

    $stmt = $conn->prepare("INSERT INTO raisa_produk (product_name, description, price, stok, image_product) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $nama, $desc, $harga, $stok, $gambar);
    $stmt->execute();

    header("Location: katalog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>➕ Tambah Produk</h2>
  <form method="POST" action="">
    <div class="mb-3">
      <label>Nama Produk</label>
      <input type="text" name="product_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Stok</label>
      <input type="number" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>URL Gambar</label>
      <input type="text" name="image_product" class="form-control">
    </div>
    <button class="btn btn-success" type="submit">Simpan</button>
    <a href="katalog.php" class="btn btn-secondary">Batal</a>
  </form>
</body>
</html>
