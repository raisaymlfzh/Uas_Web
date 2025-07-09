<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("❌ Akses ditolak.");
}

$id = $_GET['id'] ?? 0;
$id = intval($id);

mysqli_query($conn, "DELETE FROM raisa_produk WHERE Id_product = $id");

header("Location: katalog.php");
exit;
?>
