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

// Ambil data lama untuk ditampilkan
$sql = "SELECT p.id AS id_pesanan, pelanggan.id AS id_pelanggan, pelanggan.nama, pelanggan.no_hp, pelanggan.email, pelanggan.alamat,
               p.jenis_batako, p.jumlah
        FROM pesanan p
        JOIN pelanggan ON p.pelanggan_id = pelanggan.id
        WHERE p.id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_pesanan);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$row = mysqli_fetch_assoc($result)) {
    echo "Data tidak ditemukan.";
    exit;
}

$id_pelanggan = $row['id_pelanggan'];

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $jenis_batako = $_POST['jenis_batako'];
    $jumlah = (int)$_POST['jumlah'];

    // Update pelanggan
    $update_pelanggan = "UPDATE pelanggan SET nama=?, no_hp=?, email=?, alamat=? WHERE id=?";
    $stmt1 = mysqli_prepare($koneksi, $update_pelanggan);
    mysqli_stmt_bind_param($stmt1, "ssssi", $nama, $no_hp, $email, $alamat, $id_pelanggan);
    mysqli_stmt_execute($stmt1);

    // Update pesanan
    $update_pesanan = "UPDATE pesanan SET jenis_batako=?, jumlah=? WHERE id=?";
    $stmt2 = mysqli_prepare($koneksi, $update_pesanan);
    mysqli_stmt_bind_param($stmt2, "sii", $jenis_batako, $jumlah, $id_pesanan);
    mysqli_stmt_execute($stmt2);

    header("Location: daftar_pemesan.php?msg=updated");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan - Batako Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h3 class="mb-4">Edit Data Pemesanan</h3>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required value="<?= htmlspecialchars($row['nama']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" required value="<?= htmlspecialchars($row['no_hp']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($row['email']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($row['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Batako</label>
            <select name="jenis_batako" class="form-select" required>
                <option value="">Pilih Jenis Batako</option>
                <option value="Batako Press" <?= $row['jenis_batako'] == 'Batako Press' ? 'selected' : '' ?>>Batako Press</option>
                <option value="Batako Tras" <?= $row['jenis_batako'] == 'Batako Tras' ? 'selected' : '' ?>>Batako Tras</option>
                <option value="Batako Putih" <?= $row['jenis_batako'] == 'Batako Putih' ? 'selected' : '' ?>>Batako Putih</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" required value="<?= $row['jumlah'] ?>">
        </div>
        <div class="d-flex justify-content-between">
            <a href="daftar_pemesan.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>
