<?php
session_start();
include 'koneksi.php';

// Cek apakah admin
if (!isset($_SESSION['sudah_login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Cek apakah ada ID review
if (!isset($_GET['id'])) {
    echo "ID review tidak ditemukan.";
    exit;
}

$id_review = intval($_GET['id']);

// Eksekusi hapus
$stmt = $koneksi->prepare("DELETE FROM review_user WHERE id = ?");
$stmt->bind_param("i", $id_review);

if ($stmt->execute()) {
    header("Location: review.php?hapus_review=sukses");
} else {
    echo "Gagal menghapus review.";
}
?>
