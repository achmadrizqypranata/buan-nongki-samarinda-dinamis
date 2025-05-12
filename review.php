<?php
session_start();
include 'koneksi.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$lokasi = isset($_GET['lokasi']) ? trim($_GET['lokasi']) : '';

$sql = "SELECT * FROM tempat_ngopi WHERE 1";
$params = [];
$types = "";

if ($keyword !== '') {
    $sql .= " AND nama_tempat LIKE ?";
    $params[] = "%" . $keyword . "%";
    $types .= "s";
}
if ($lokasi !== '') {
    $sql .= " AND lokasi = ?";
    $params[] = $lokasi;
    $types .= "s";
}

$stmt = $koneksi->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$places = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Review Tempat Nongki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
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
                <li><a href="review.php" class="active">Review</a></li>
                <li><a href="contact.php">Contact Us</a></li>

                <?php if (!isset($_SESSION['sudah_login'])): ?>
                        <li><a href="login.php" class="btn btn-outline-brown">Login/Daftar</a></li>
                    <?php else: ?>
                        <li><a href="logout.php" class="btn btn-outline-danger">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section" style="background-image: url('img/bg1.jpg');">
        <div class="overlay"></div>
        <div class="hero-content text-center">
            <h1>Review Tempat Nongkrong</h1>
            <p>Lihat berbagai tempat nongkrong favorit di Samarinda dan ulasan pengunjungnya.</p>
        </div>
    </header>

    <!-- Filter Section -->
    <section class="filters">
        <form method="get" action="" class="filter-form">
            <input type="text" name="keyword" placeholder="Cari nama tempat..." value="<?= htmlspecialchars($keyword) ?>">
            <select name="lokasi">
                <option value="">Semua Lokasi</option>
                <option value="Loa Janan Ilir" <?= $lokasi === 'Loa Janan Ilir' ? 'selected' : '' ?>>Loa Janan Ilir</option>
                <option value="Palaran" <?= $lokasi === 'Palaran' ? 'selected' : '' ?>>Palaran</option>
                <option value="Samarinda Ilir" <?= $lokasi === 'Samarinda Ilir' ? 'selected' : '' ?>>Samarinda Ilir</option>
                <option value="Samarinda Kota" <?= $lokasi === 'Samarinda Kota' ? 'selected' : '' ?>>Samarinda Kota</option>
                <option value="Samarinda Seberang" <?= $lokasi === 'Samarinda Seberang' ? 'selected' : '' ?>>Samarinda Seberang</option>
                <option value="Samarinda Ulu" <?= $lokasi === 'Samarinda Ulu' ? 'selected' : '' ?>>Samarinda Ulu</option>
                <option value="Samarinda Utara" <?= $lokasi === 'Samarinda Utara' ? 'selected' : '' ?>>Samarinda Utara</option>
                <option value="Sambutan" <?= $lokasi === 'Sambutan' ? 'selected' : '' ?>>Sambutan</option>
                <option value="Sungai Kunjang" <?= $lokasi === 'Sungai Kunjang' ? 'selected' : '' ?>>Sungai Kunjang</option>
                <option value="Sungai Pinang" <?= $lokasi === 'Sungai Pinang' ? 'selected' : '' ?>>Sungai Pinang</option>
            </select>
            <button type="submit" class="btn-hero" style="color: brown;">Filter</button>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="tambah_tempat.php" class="btn-hero" style="background-color: #a67c52; color: white; text-decoration: none;">Tambah Tempat</a>
            <?php endif; ?>
        </form>
    </section>

    <!-- Cards Section -->
    <section class="cards">
        <?php while ($row = $places->fetch_assoc()): ?>
            <?php
            $id_tempat = $row['id'];
            $avg_q = $koneksi->query("SELECT ROUND(AVG(rating),1) as avg_rating FROM review_user WHERE tempat_id = $id_tempat");
            $avg_rating = $avg_q->fetch_assoc()['avg_rating'] ?? 'Belum ada';
            ?>
            <div class="card">
                <img src="img/<?= $row['gambar'] ?>" alt="<?= $row['nama_tempat'] ?>">
                <div class="card-content">
                    <h3><?= htmlspecialchars($row['nama_tempat']) ?></h3>
                    <p>Jam: <?= substr($row['jam_buka'], 0, 5) ?> - <?= substr($row['jam_tutup'], 0, 5) ?> <br><small><?= $row['lokasi'] ?></small></p>
                    <div class="rating"><i class="fas fa-star text-warning"></i> <?= $avg_rating ?>/5</div>

                    <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                        <a href="detail.php?id=<?= $row['id'] ?>" 
                            style="padding: 6px 12px; border-radius: 6px; background-color: #a67c52; color: #fff; text-decoration: none; font-weight: 600; font-family: 'Cormorant Garamond', serif;">
                            Lihat Detail
                        </a>

                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                            <?php
                            $nama_user = $_SESSION['nama_lengkap'];
                            $cek = $koneksi->query("SELECT id FROM review_user WHERE tempat_id = $id_tempat AND nama_user = '" . $koneksi->real_escape_string($nama_user) . "'");
                            if ($cek->num_rows > 0):
                            ?>
                                <a href="update_review.php?tempat_id=<?= $row['id'] ?>" 
                                    style="padding: 6px 12px; border-radius: 6px; background-color: #a67c52; color: #fff; text-decoration: none; font-weight: 600; font-family: 'Cormorant Garamond', serif;">
                                    Ubah Review
                                </a>
                            <?php else: ?>
                                <a href="kirim_review.php?tempat_id=<?= $row['id'] ?>" 
                                    style="padding: 6px 12px; border-radius: 6px; background-color: #a67c52; color: #fff; text-decoration: none; font-weight: 600; font-family: 'Cormorant Garamond', serif;">
                                    Beri Review
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="edit_tempat.php?id=<?= $row['id'] ?>" 
                                style="padding: 6px 12px; border-radius: 6px; background-color: #a67c52; color: #fff; text-decoration: none; font-weight: 600; font-family: 'Cormorant Garamond', serif;">
                                Edit Tempat
                            </a>
                            <a href="#" 
                                onclick="showDeleteModal(<?= $row['id'] ?>); return false;"
                                style="padding: 6px 12px; border-radius: 6px; background-color: #b30000; color: #fff; text-decoration: none; font-weight: 600; font-family: 'Cormorant Garamond', serif;">
                                Hapus
                            </a>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="footer-container">
            <p class="copyright">© 2025 Buan Nongki</p>
            <p class="tagline">Temukan Tempat Nongkrong Favoritmu!</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <div id="deleteModal" class="review-modal">
        <div class="review-modal-content">
            <div class="checkmark" style="font-size: 50px; color: orange;">&#9888;</div>
            <h4>Yakin hapus tempat ini?</h4>
            <div style="margin-top: 20px;">
            <button id="confirmDeleteBtn" style="background-color: #b30000; color: white; padding: 10px 20px; border: none; border-radius: 6px; margin-right: 10px;">Hapus</button>
            <button onclick="document.getElementById('deleteModal').style.display='none';" style="background-color: #888; color: white; padding: 10px 20px; border: none; border-radius: 6px;">Batal</button>
            </div>
        </div>
    </div>

    <script>
    function showDeleteModal(id) {
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        modal.style.display = 'flex';

        confirmBtn.onclick = function () {
        window.location.href = 'hapus_tempat.php?id=' + id;
        };
    }
    </script>

    <?php if (isset($_SESSION['hapus_berhasil'])): ?>
    <div id="hapusSuccessModal" class="review-modal" style="display: flex;">
        <div class="review-modal-content">
            <div class="checkmark" style="color: green; font-size: 50px;">&#10004;</div>
            <h4>Tempat yang anda pilih telah dihapus</h4>
            <button id="closeModal">OK</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('hapusSuccessModal');
            const closeBtn = document.getElementById('closeModal');
            modal.style.display = 'flex';
            closeBtn.onclick = () => {
                modal.style.display = 'none';
                history.replaceState(null, '', window.location.pathname);
            };
        });
    </script>
    <?php unset($_SESSION['hapus_berhasil']); endif; ?>
</body>
</html>
