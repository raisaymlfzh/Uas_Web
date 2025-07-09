<?php
$host = "localhost";
$user = "root"; 
$pass = "";     
$db   = "db_raisa_umkm";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
