<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    die("❌ Produk tidak ditemukan.");
}

$id_produk = intval($_GET['id']);
$query = "SELECT * FROM raisa_produk WHERE id_product = $id_produk";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("❌ Produk tidak valid.");
}

$produk = mysqli_fetch_assoc($result);
$harga = (int)$produk['price'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pemesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>📝 Form Pemesanan</h2>
  <div class="card">
    <div class="card-body">
      <form action="proses_customer.php" method="POST">
        <!-- Informasi Produk -->
        <input type="hidden" name="id_produk" value="<?php echo $produk['Id_product']; ?>">
        
        <div class="mb-3">
          <label>Nama Produk</label>
          <input type="text" class="form-control" value="<?php echo htmlspecialchars($produk['product_name']); ?>" readonly>
        </div>
        
        <div class="mb-3">
          <label>Harga</label>
          <input type="text" id="harga" class="form-control" value="<?php echo number_format($harga, 0, ',', '.'); ?>" readonly>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>No HP</label>
          <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat Lengkap</label>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <!-- Jumlah & Total -->
        <div class="mb-3">
          <label>Jumlah Produk</label>
          <input type="number" name="jumlah_produk" class="form-control" id="jumlah" value="1" min="1" required>
        </div>
        <div class="mb-3">
          <label>Total Harga</label>
          <input type="text" class="form-control" id="total" name="total_harga" readonly>
        </div>

        <button type="submit" class="btn btn-success">✅ Kirim Pesanan</button>
        <a href="katalog.php" class="btn btn-secondary">← Kembali</a>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript untuk menghitung total -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const harga = <?php echo $harga; ?>;
  const jumlahInput = document.getElementById('jumlah');
  const totalInput = document.getElementById('total');

  function updateTotal() {
    const jumlah = parseInt(jumlahInput.value) || 0;
    const total = harga * jumlah;
    totalInput.value = total.toLocaleString('id-ID');
  }

  jumlahInput.addEventListener('input', updateTotal);
  updateTotal();
});
</script>
</body>
</html>
