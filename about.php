<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About - Buan Nongki Samarinda</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
    <div class="fh5co-loader"></div>

    <div id="page">
        <!-- Navbar -->
        <nav class="main-nav" id="navbar">
            <div class="container">
                <div class="logo-wrapper text-center">
                    <img src="img/logo-icon.png" alt="Logo Icon" class="logo-icon">
                    <img src="img/logo-text.png" alt="Logo Text" class="logo-text">
                </div>
                <ul class="menu text-center">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="review.php">Review</a></li>
                    <li><a href="contact.php">Contact Us</a></li>

                    <?php if (!isset($_SESSION['sudah_login'])): ?>
                        <li><a href="login.php" class="btn btn-outline-brown">Login/Daftar</a></li>
                    <?php else: ?>
                        <li><a href="logout.php" class="btn btn-outline-danger">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="hero-about" style="background-image: url('img/bg2.jpg');">
            <div class="overlay"></div>
            <div class="hero-content text-center">
                <h1>Tentang Kami</h1>
                <p>Kenali lebih dekat tentang misi dan visi dari Buan Nongki Samarinda</p>
            </div>
        </header>

        <!-- About Content -->
        <section class="section-content">
            <div class="container">
                <h2 class="text-center">Tentang Buan Nongki</h2>
                <p class="text-center"><strong>Buan Nongki Samarinda</strong> adalah platform yang menyajikan berbagai pilihan tempat nongkrong di kota Samarinda. Mulai dari cafe estetik, tempat kerja santai, hingga hidden gem di sudut kota — semuanya kami tampilkan dengan ulasan dari pengunjung.</p>

                <p class="text-center">Kami percaya bahwa tempat yang nyaman dapat menciptakan momen yang tak terlupakan. Lewat review jujur dari pengunjung, kamu bisa menemukan spot terbaik untuk bersantai, berdiskusi, atau sekadar menikmati waktu.</p>

                <p class="text-center"><strong>Yuk, bantu teman-temanmu menemukan tempat nongkrong terbaik!</strong></p>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="footer-container">
            <p class="copyright">© 2025 Buan Nongki</p>
            <p class="tagline">Temukan Tempat Nongkrong Favoritmu!</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
