<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: daftar_pemesan.php");
    exit;
}

$id_pesanan = (int)$_GET['id'];

// Ambil pelanggan_id dari pesanan
$query = "SELECT pelanggan_id FROM pesanan WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_pesanan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$data = mysqli_fetch_assoc($result)) {
    header("Location: daftar_pemesan.php?msg=not_found");
    exit;
}

$pelanggan_id = $data['pelanggan_id'];

// Hapus pesanan
$delete_pesanan = "DELETE FROM pesanan WHERE id = ?";
$stmt_delete = mysqli_prepare($koneksi, $delete_pesanan);
mysqli_stmt_bind_param($stmt_delete, "i", $id_pesanan);
mysqli_stmt_execute($stmt_delete);

// Cek apakah pelanggan masih punya pesanan lain
$check = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pesanan WHERE pelanggan_id = $pelanggan_id");
$check_data = mysqli_fetch_assoc($check);

// Jika tidak ada pesanan lain, hapus pelanggan juga
if ($check_data['total'] == 0) {
    $delete_pelanggan = mysqli_prepare($koneksi, "DELETE FROM pelanggan WHERE id = ?");
    mysqli_stmt_bind_param($delete_pelanggan, "i", $pelanggan_id);
    mysqli_stmt_execute($delete_pelanggan);
}

// Redirect ke dashboard dengan notifikasi sukses
header("Location: daftar_pemesan.php?msg=deleted");
exit;
?>
