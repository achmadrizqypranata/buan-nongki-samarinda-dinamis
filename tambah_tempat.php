<?php
session_start();
include 'koneksi.php';

// Cek jika bukan admin
if (!isset($_SESSION['sudah_login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_tempat']);
    $lokasi = trim($_POST['lokasi']);
    $gambar = $_FILES['gambar']['name'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    $deskripsi = trim($_POST['deskripsi']);
    $maps_link = trim($_POST['maps_link']);

    if ($nama && $lokasi && $gambar && $jam_buka && $jam_tutup && $deskripsi && $maps_link) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        $stmt = $koneksi->prepare("INSERT INTO tempat_ngopi (nama_tempat, lokasi, gambar, jam_buka, jam_tutup, deskripsi, maps_link) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama, $lokasi, $gambar, $jam_buka, $jam_tutup, $deskripsi, $maps_link);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Gagal menyimpan ke database.";
        }
    } else {
        $errors[] = "Semua field wajib diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Tempat - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
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
        <div class="container">
            <h2 class="text-center">Tambah Tempat Nongki</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="form-admin">
                <label>Nama Tempat</label>
                <input type="text" name="nama_tempat" required>

                <label>Lokasi</label>
                <select name="lokasi" required>
                    <option value="">-- Pilih Lokasi --</option>
                    <option>Loa Janan Ilir</option>
                    <option>Palaran</option>
                    <option>Samarinda Ilir</option>
                    <option>Samarinda Kota</option>
                    <option>Samarinda Seberang</option>
                    <option>Samarinda Ulu</option>
                    <option>Samarinda Utara</option>
                    <option>Sambutan</option>
                    <option>Sungai Kunjang</option>
                    <option>Sungai Pinang</option>
                </select>

                <label>Jam Buka</label>
                <input type="time" name="jam_buka" required>

                <label>Jam Tutup</label>
                <input type="time" name="jam_tutup" required>

                <label>Gambar Tempat</label>
                <input type="file" name="gambar" required>

                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3" required></textarea>

                <label>Embed Google Maps</label>
                <textarea name="maps_link" rows="2" placeholder="https://www.google.com/maps/embed?..." required></textarea>

                <button type="submit" class="btn-submit">Simpan Tempat</button>
                <a href="review.php" class="btn-cancel">Kembali</a>
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

<!-- Modal Sukses -->
<?php if ($success): ?>
<div id="reviewModal" class="review-modal" style="display: flex;">
    <div class="review-modal-content">
        <div class="checkmark">&#10004;</div>
        <h4>Tempat baru telah ditambahkan</h4>
        <button id="closeModal">OK</button>
    </div>
</div>
<script>
    document.getElementById('closeModal').onclick = function () {
        window.location.href = "review.php";
    };
</script>
<?php endif; ?>
</body>
</html>