<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM tempat_ngopi WHERE id = $id";
$result = $koneksi->query($sql);

if ($result->num_rows === 0) {
    echo "Tempat tidak ditemukan!";
    exit;
}

$tempat = $result->fetch_assoc();
$reviews = $koneksi->query("SELECT * FROM review_user WHERE tempat_id = $id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($tempat['nama_tempat']) ?> - Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="page">
    <nav class="main-nav" style="position: sticky; top: 0; z-index: 999; background-color: #fff;">
        <div class="container">
            <div class="logo-wrapper text-center">
                <img src="img/logo-icon.png" alt="Logo Icon" class="logo-icon">
                <img src="img/logo-text2.png" alt="Logo Text" class="logo-text">
            </div>
        </div>
    </nav>

    <section class="detail-container">
        <img src="img/<?= $tempat['gambar'] ?>" alt="<?= htmlspecialchars($tempat['nama_tempat']) ?>" class="detail-img">
        <div class="detail-info">
            <h1><?= htmlspecialchars($tempat['nama_tempat']) ?></h1>
            <p><strong>Jam Buka:</strong> <?= substr($tempat['jam_buka'], 0, 5) ?> - <?= substr($tempat['jam_tutup'], 0, 5) ?></p>
            <div class="description"><?= nl2br(htmlspecialchars($tempat['deskripsi'])) ?></div>
            <div class="map">
                <iframe src="<?= htmlspecialchars($tempat['maps_link']) ?>" width="100%" height="300" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <section class="user-reviews">
        <h2>Ulasan Pengunjung</h2>
        <?php if ($reviews->num_rows > 0): ?>
            <?php while ($rev = $reviews->fetch_assoc()): ?>
                <div class="review-box">
                    <div style="display:flex; align-items:center; gap:15px;">
                        <div>
                            <strong><?= htmlspecialchars($rev['nama_user']) ?></strong>
                            <div class="rating">
                                <i class="fas fa-star"></i> <?= $rev['rating'] ?>/5
                            </div>
                            <p><?= htmlspecialchars($rev['ulasan']) ?></p>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <a href="hapus_review.php?id=<?= $rev['id'] ?>" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Hapus review ini?')">Hapus Review</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Belum ada ulasan untuk tempat ini.</p>
        <?php endif; ?>
    </section>

    <footer class="footer-section">
        <div class="footer-container">
            <p class="copyright">© 2025 Buan Nongki</p>
            <p class="tagline">Temukan Tempat Nongkrong Favoritmu!</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
