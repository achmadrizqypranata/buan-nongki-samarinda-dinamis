<?php
session_start();
include 'koneksi.php';

$errors = [];
$loginSuccess = false;
$loginFailed = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $loginFailed = true;
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) {
                $_SESSION['sudah_login'] = true;
                $_SESSION['id_user'] = $user['id'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                $_SESSION['login_berhasil'] = true;
                header("Location: login.php");
                exit;
            } else {
                $loginFailed = true;
            }
        } else {
            $loginFailed = true;
        }
    }
}

if (isset($_SESSION['login_berhasil'])) {
    $loginSuccess = true;
    unset($_SESSION['login_berhasil']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Buan Nongki</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            margin-bottom: 10px;
        }
        .checkmark.success { color: green; }
        .checkmark.error { color: red; }
        #closeModal, #closeErrorModal {
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
    <nav class="main-nav">
        <div class="container">
            <div class="logo-wrapper text-center">
                <img src="img/logo-icon.png" alt="Logo Icon" class="logo-icon">
                <img src="img/logo-text2.png" alt="Logo Text" class="logo-text">
            </div>
        </div>
    </nav>

    <section class="section-content">
        <div class="container" style="max-width: 500px; margin: auto;">
            <h2 class="text-center">Login Pengguna</h2>

            <form method="post">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" class="form-control" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
                        <i class="fas fa-eye toggle-password" id="togglePassword" style="position: absolute; right: -10px; top: 40%; transform: translateY(-50%); cursor: pointer; color: #888;"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-brown mb-3">Login</button>
                <p class="mt-2">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
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
<?php if ($loginSuccess): ?>
<div id="loginSuccessModal" class="review-modal" style="display: flex;">
    <div class="review-modal-content">
        <div class="checkmark success">&#10004;</div>
        <h4>Login berhasil!</h4>
        <button id="closeModal">OK</button>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('closeModal').onclick = () => {
        window.location.href = 'review.php';
    };
});
</script>
<?php endif; ?>

<!-- Modal Gagal -->
<?php if ($loginFailed): ?>
<div id="loginErrorModal" class="review-modal" style="display: flex;">
    <div class="review-modal-content">
        <div class="checkmark error">&#10006;</div>
        <h4>Username atau Password salah</h4>
        <button id="closeErrorModal">OK</button>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('closeErrorModal').onclick = () => {
        window.location.href = 'login.php';
    };
});
</script>
<?php endif; ?>

<!-- Script toggle password -->
<script>
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>
</body>
</html>
