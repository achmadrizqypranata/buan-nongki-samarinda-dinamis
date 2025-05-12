<?php
session_start();
include 'koneksi.php';

$errors = [];
$success = '';

// Ambil dari session jika login
$nama_session = $_SESSION['nama_lengkap'] ?? '';
$email_session = $_SESSION['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $pesan = trim($_POST['pesan']);

    if (empty($nama) || empty($email) || empty($pesan)) {
        $errors[] = "Semua field wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email harus valid (contoh: user@gmail.com).";
    } else {
        $stmt = $koneksi->prepare("INSERT INTO contact_us (nama, email, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $pesan);
        if ($stmt->execute()) {
            $success = "Pesan berhasil dikirim.";
        } else {
            $errors[] = "Gagal mengirim pesan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Buan Nongki</title>
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

    <section class="section-content">
        <div class="container" style="max-width: 600px; margin: auto;">
            <h2 class="text-center">Ada Kendala atau Saran Tempat Nongkrong?</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="color: red;">
                    <ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul>
                </div>
            <?php elseif ($success): ?>
                <div class="alert alert-success" style="color: green;"><?= $success ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="<?= htmlspecialchars($nama_session) ?>"
                        <?= $nama_session ? 'readonly style="background-color: #eee; width: 100%; padding: 10px;"' : 'style="width: 100%; padding: 10px;"' ?>
                        required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="<?= htmlspecialchars($email_session) ?>"
                        <?= $email_session ? 'readonly style="background-color: #eee; width: 100%; padding: 10px;"' : 'style="width: 100%; padding: 10px;"' ?>
                        required>
                </div>

                <div class="mb-3">
                    <label>Pesan</label>
                    <textarea name="pesan" rows="5" class="form-control" required style="width: 100%; padding: 10px;"></textarea>
                </div>

                <button type="submit" class="btn btn-brown" style="margin-top: 15px;">Kirim Pesan</button>
                <a href="index.php" class="btn-cancel">Kembali</a>
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
</body>
</html>
