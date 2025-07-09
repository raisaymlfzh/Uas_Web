<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("❌ Akses ditolak.");
}

$id = intval($_GET['id'] ?? 0);

$result = mysqli_query($conn, "SELECT * FROM tabel_produk WHERE Id_product = $id");
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$produk = mysqli_fetch_assoc($result);
if (!$produk) {
    die("❌ Produk tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = $_POST['product_name'];
    $desc     = $_POST['description'];
    $harga    = (int)$_POST['price'];
    $stok     = (int)$_POST['stok'];
    $gambar   = $_POST['image_product'];

    $stmt = $conn->prepare("UPDATE tabel_produk SET product_name=?, description=?, price=?, stok=?, image_product=? WHERE Id_product=?");
    $stmt->bind_param("ssiisi", $nama, $desc, $harga, $stok, $gambar, $id);
    $stmt->execute();

    header("Location: katalog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>✏️ Edit Produk</h2>
  <form method="POST" action="">
    <div class="mb-3">
      <label>Nama Produk</label>
      <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($produk['product_name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="description" class="form-control" required><?= htmlspecialchars($produk['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="price" class="form-control" value="<?= $produk['price'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Stok</label>
      <input type="number" name="stok" class="form-control" value="<?= $produk['stok'] ?>" required>
    </div>
    <div class="mb-3">
      <label>URL Gambar</label>
      <input type="text" name="image_product" class="form-control" value="<?= $produk['image_product'] ?>">
    </div>
    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
    <a href="katalog.php" class="btn btn-secondary">Batal</a>
  </form>
</body>
</html>
