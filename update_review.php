<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['sudah_login']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['tempat_id'])) {
    echo "ID tempat tidak ditemukan.";
    exit;
}

$tempat_id = intval($_GET['tempat_id']);
$nama_user = $_SESSION['nama_lengkap'];

// Cek review lama
$stmt = $koneksi->prepare("SELECT * FROM review_user WHERE tempat_id = ? AND nama_user = ?");
$stmt->bind_param("is", $tempat_id, $nama_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Review tidak ditemukan.";
    exit;
}

$review = $result->fetch_assoc();
$ulasan_lama = $review['ulasan'];
$rating_lama = $review['rating'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating']);
    $ulasan = trim($_POST['ulasan']);

    if ($rating < 1 || $rating > 5 || empty($ulasan)) {
        $errors[] = "Rating harus antara 1–5 dan ulasan tidak boleh kosong.";
    } else {
        $stmt = $koneksi->prepare("UPDATE review_user SET rating = ?, ulasan = ?, created_at = NOW() WHERE tempat_id = ? AND nama_user = ?");
        $stmt->bind_param("isis", $rating, $ulasan, $tempat_id, $nama_user);
        if ($stmt->execute()) {
            header("Location: update_review.php?tempat_id=$tempat_id&updated=success");
            exit;
        } else {
            $errors[] = "Gagal memperbarui review.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Review</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .review-modal {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .review-modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        .checkmark {
            font-size: 50px;
            color: green;
            margin-bottom: 10px;
        }
        #closeModal {
            margin-top: 15px;
            background-color: #a67c52;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
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

    <section class="section-content">
        <div class="container" style="max-width: 600px; margin: 0 auto;">
            <h2 class="text-center">Ubah Review Anda</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="color: red;">
                    <ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label>Rating (1–5)</label>
                    <select name="rating" class="form-control" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>" <?= $i == $rating_lama ? 'selected' : '' ?>>(★<?= $i ?>)</option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Ulasan Anda</label>
                    <textarea name="ulasan" rows="5" class="form-control" style="width: 100%; padding: 10px; margin-bottom: 20px;" required><?= htmlspecialchars($ulasan_lama) ?></textarea>
                </div>

                <button type="submit" class="btn-hero" style="background-color: #a67c52; color: white; border: none; padding: 10px 25px; margin-right: 10px;">Perbarui</button>
                <a href="review.php" class="btn-hero" style="background-color: #fff; color: #a67c52; padding: 10px 25px; text-decoration: none; border: 1px solid #a67c52;">Kembali</a>
            </form>
        </div>
    </section>

    <footer class="footer-section">
        <div class="footer-container">
            <p class="copyright">© 2025 Buan Nongki</p>
            <p class="tagline">Temukan Tempat Nongkrong Favoritmu!</p>
        </div>
    </footer>
</div>

<!-- Modal Terima Kasih -->
<div id="reviewModal" class="review-modal">
    <div class="review-modal-content">
        <div class="checkmark">&#10004;</div>
        <h4>Review Anda telah diperbarui</h4>
        <button id="closeModal">OK</button>
    </div>
</div>

<?php if (isset($_GET['updated']) && $_GET['updated'] === 'success'): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('reviewModal');
        const closeBtn = document.getElementById('closeModal');
        modal.style.display = 'flex';
        closeBtn.onclick = () => {
            window.location.href = 'review.php';
        };
    });
</script>
<?php endif; ?>
</body>
</html>
