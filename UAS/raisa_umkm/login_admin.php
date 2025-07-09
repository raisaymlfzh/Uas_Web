<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$conn) {
        die("Koneksi gagal.");
    }

    // Ambil semua data termasuk role
    $stmt = $conn->prepare("SELECT password, role FROM tabel_user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Jika password masih disimpan dalam teks biasa
        if ($password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

          // Semua role langsung ke katalog.php
header("Location: katalog.php");
exit;

        } else {
            $error = "❌ Password salah.";
        }
    } else {
        $error = "❌ Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="w-50 mx-auto">
        <div class="text-center mb-4">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
        </div>
        <form action="login_admin.php" method="POST">
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
