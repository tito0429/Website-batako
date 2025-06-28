<?php
include 'admin/koneksi.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $jenis_batako = $_POST['jenis_batako'];
    $jumlah = (int) $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    $stmt1 = mysqli_prepare($koneksi, "INSERT INTO pelanggan (nama, no_hp, email, alamat) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt1, "ssss", $nama, $no_hp, $email, $alamat);
    mysqli_stmt_execute($stmt1);
    $pelanggan_id = mysqli_insert_id($koneksi);

    $stmt2 = mysqli_prepare($koneksi, "INSERT INTO pesanan (pelanggan_id, jenis_batako, jumlah, tanggal_pesan) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt2, "isis", $pelanggan_id, $jenis_batako, $jumlah, $tanggal);
    mysqli_stmt_execute($stmt2);

    header("Location: sukses.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Batako Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pemesanan Batako</h2>
        <a href="admin/index.php" class="btn btn-outline-dark">🔐 Login Admin</a>
    </div>

    <form method="post">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="col-md-6">
                <input type="tel" name="no_hp" class="form-control" placeholder="No HP" required>
            </div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-12">
                <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" required></textarea>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <select name="jenis_batako" class="form-select" required>
                    <option value="">Pilih Jenis Batako</option>
                    <option value="Batako Press">Batako Press</option>
                    <option value="Batako Tras">Batako Tras</option>
                    <option value="Batako Putih">Batako Putih</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="number" name="jumlah" class="form-control" min="1" placeholder="Jumlah (buah)" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">Pesan Sekarang</button>
    </form>
</div>
</body>
</html>
