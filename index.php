<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buan Nongki Samarinda</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
    <!-- Loading Screen -->
    <div id="loader">
        <div class="spinner"></div>
    </div>

    <div class="fh5co-loader"></div>

    <div id="page">
        <!-- Sticky Navbar -->
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
        <header class="hero-section" style="background-image: url('img/bg1.jpg');">
            <div class="overlay"></div>
            <div class="hero-content text-center">
                <h1>Buan Nongki Samarinda</h1>
                <p>Temukan tempat nongkrong terbaik dan berikan ulasan jujurmu!</p>
                <a href="review.php" class="btn-hero">Lihat Review Tempat Nongki</a>
            </div>
        </header>

        <!-- Konten Tambahan -->
        <section class="section-content">
            <div class="container">
                <h2 class="text-center">Kenapa Memilih Buan Nongki?</h2>
                <p class="text-center">Kami membantu kamu menemukan spot nongki paling cocok di Samarinda, mulai dari kafe estetik sampai tempat diskusi santai bareng teman. Yuk, jelajahi dan bantu kami dengan ulasan jujur kamu!</p>

                <div class="features">
                    <div class="feature-box">
                        <i class="fas fa-mug-hot fa-2x"></i>
                        <h3>Cafe Estetik</h3>
                        <p>Temukan tempat dengan desain kekinian dan instagramable untuk ngopi santai atau bekerja.</p>
                    </div>
                    <div class="feature-box">
                        <i class="fas fa-users fa-2x"></i>
                        <h3>Suasana Nyaman</h3>
                        <p>Rekomendasi tempat dengan suasana tenang, cocok buat ngobrol, nugas, atau healing.</p>
                    </div>
                    <div class="feature-box">
                        <i class="fas fa-star fa-2x"></i>
                        <h3>Ulasan Asli</h3>
                        <p>Semua review ditulis oleh pengguna asli untuk bantu kamu pilih tempat terbaik.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

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