<?php
include '../koneksi.php'; // karena koneksi.php di folder utama

// Jika metode adalah POST, simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama    = $_POST['customer_name'] ?? '';
    $no_hp   = $_POST['no_hp'] ?? '';
    $alamat  = $_POST['alamat'] ?? '';
    $jumlah  = $_POST['jumlah_produk'] ?? 0;
    $total   = $_POST['total_harga'] ?? 0;
    $tanggal = date('Y-m-d');

    // Validasi input
    if (empty($nama) || empty($no_hp) || empty($alamat) || empty($jumlah) || empty($total)) {
        echo "<div style='color:red;'>❌ Semua field wajib diisi.</div>";
    } else {
        $sql = "INSERT INTO tabel_customer (nama_customer, no_hp, alamat, jumlah_produk, total_harga, tanggal_pesanan)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssids", $nama, $no_hp, $alamat, $jumlah, $total, $tanggal);
            if ($stmt->execute()) {
                echo "<div style='color:green;'>✅ Data berhasil disimpan!</div>";
            } else {
                echo "<div style='color:red;'>❌ Gagal menyimpan data: {$stmt->error}</div>";
            }
            $stmt->close();
        } else {
            echo "<div style='color:red;'>❌ Prepare gagal: {$conn->error}</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pemesanan Manual</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Form Pemesanan Manual</h2>
  <form action="" method="POST" class="row g-3">

    <div class="col-md-6">
      <label for="customer_name" class="form-label">Nama Pelanggan</label>
      <input type="text" class="form-control" name="customer_name" required>
    </div>

    <div class="col-md-6">
      <label for="no_hp" class="form-label">No HP</label>
      <input type="text" class="form-control" name="no_hp" required>
    </div>

    <div class="col-12">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" name="alamat" rows="2" required></textarea>
    </div>

    <div class="col-md-6">
      <label for="jumlah_produk" class="form-label">Jumlah Produk</label>
      <input type="number" class="form-control" name="jumlah_produk" min="1" required>
    </div>

    <div class="col-md-6">
      <label for="total_harga" class="form-label">Total Harga</label>
      <input type="number" class="form-control" name="total_harga" min="0" required>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
    </div>

  </form>
</body>
</html>
