<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login dan berperan sebagai admin
if (!isset($_SESSION['sudah_login']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Pastikan ada parameter id di URL
if (!isset($_GET['id'])) {
    echo "ID tempat tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Ambil nama file gambar sebelum dihapus
$get = $koneksi->prepare("SELECT gambar FROM tempat_ngopi WHERE id = ?");
$get->bind_param("i", $id);
$get->execute();
$result = $get->get_result();

if ($result->num_rows === 0) {
    echo "Tempat tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
$gambar = $data['gambar'];

// Hapus data dari database
$delete = $koneksi->prepare("DELETE FROM tempat_ngopi WHERE id = ?");
$delete->bind_param("i", $id);

if ($delete->execute()) {
    // Hapus file gambar dari folder (jika ada)
    $file_path = 'img/' . $gambar;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Set session agar review.php bisa tampilkan modal
    $_SESSION['hapus_berhasil'] = true;

    // Redirect kembali ke halaman review
    header("Location: review.php");
    exit;
} else {
    echo "Gagal menghapus tempat.";
}
?>
