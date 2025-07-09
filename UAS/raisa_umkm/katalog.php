<?php
include 'koneksi.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'] ?? 'user'; // default ke user jika role tidak diset
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Katalog Kuliner Khas Padang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      margin-bottom: 30px;
      transition: transform 0.3s;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .header {
      background-color: #6a1b1a;
      color: white;
      padding: 20px 0;
      position: relative;
      text-align: center;
    }
    .header-buttons {
      position: absolute;
      top: 20px;
      right: 30px;
      display: flex;
      gap: 10px;
    }
    .category-badge {
      position: absolute;
      top: 10px;
      right: 10px;
    }
  </style>
</head>
<body>

<div class="header">
  <div class="header-buttons">
    <a href="profil.php" class="btn btn-light text-dark">👤 Profil</a>
    <a href="logout.php" class="btn btn-light text-dark">🚪 Logout</a>
  </div>
  <h1>KULINER KHAS PADANG</h1>
  <p class="lead">Nikmati cita rasa autentik dari Minangkabau</p>
</div>

<div class="container py-4">
  <?php if ($role === 'admin'): ?>
    <div class="mb-4 text-end">
      <a href="tambah_produk.php" class="btn btn-success">➕ Tambah Produk</a>
    </div>
  <?php endif; ?>

  <div class="row">
    <?php
    $query = "SELECT * FROM tabel_produk";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $id       = $row['Id_product'];
      $nama     = htmlspecialchars($row['product_name']);
      $desc     = htmlspecialchars($row['description']);
      $harga    = number_format($row['price'], 0, ',', '.');
      $stok     = (int)$row['stok'];
      $gambar   = $row['image_product'];

      $img_src = ($gambar == '-' || empty($gambar))
        ? 'https://via.placeholder.com/400x200?text=No+Image'
        : $gambar;
    ?>

    <div class="col-md-4">
      <div class="card product-card">
        <span class="badge bg-secondary category-badge"></span>
        <img src="<?= $img_src ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= $nama ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $nama ?></h5>
          <p class="card-text"><?= $desc ?></p>
          <div class="d-flex justify-content-between">
            <h6 class="text-danger">Rp <?= $harga ?></h6>
            <span class="text-muted">Stok: <?= $stok ?></span>
          </div>
          <a href="form_pemesanan.php?id=<?= htmlspecialchars($id) ?>" class="btn btn-warning w-100 mt-3">Pesan Sekarang</a>

          <?php if ($role === 'admin'): ?>
            <div class="d-flex gap-2 mt-2">
              <a href="edit_produk.php?id=<?= $id ?>" class="btn btn-primary w-50">✏️ Edit</a>
              <a href="hapus_produk.php?id=<?= $id ?>" class="btn btn-danger w-50" onclick="return confirm('Yakin ingin menghapus produk ini?')">🗑 Hapus</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php } ?>
  </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
  <h5>UMKM Padang © 2025</h5>
  <p>Didukung oleh semangat lokal dan cita rasa khas Minangkabau</p>
</footer>

</body>
</html>
