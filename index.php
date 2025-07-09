<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Warung Minang Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2019/07/05/14/19/house-4318739_1280.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 80vh;
        }

        .content-wrapper {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            margin-top: 60px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h1, p {
            color: #6a1b1a;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="content-wrapper text-center">
            <h1>Selamat Datang di Warung Minang Digital</h1>
            <p> platform kuliner daring yang 
                menghadirkan cita rasa autentik Minangkabau langsung ke ujung jari Anda. 
            </p>
            <p>
            Warung Minang Digital tidak hanya menjual makanan, tetapi juga menyajikan warisan budaya. Dimana
            di setiap hidangan yang kami tampilkan adalah hasil dari resep turun-temurun masyarakat Minangkabau
            yang kaya akan rempah dan filosofi. Mulai dari rendang,yang pernah dinobatkan sebagai makanan terenak di dunia,
            hingga sate Padang dengan kuah kentalnya yang khas. Semua kami hadirkan dengan kualitas terbaik.  
            </p>
            <p>
            Dengan semangat digitalisasi dan pelestarian budaya, Warung Minang Digital 
            menjadi jembatan antara tradisi dan teknologi. Mari dukung produk lokal dan rasakan 
            kelezatan warisan kuliner Minangkabau yang kaya rasa dan penuh makna.
            </p>

            <?php if (isset($_SESSION['username'])): ?>
                <div class="alert alert-success">Halo, <?= $_SESSION['username'] ?>!</div>

            <?php else: ?>
                <div>
                    <a href="login_admin.php" class="btn btn-warning">Masuk</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
