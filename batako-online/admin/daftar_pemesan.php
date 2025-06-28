<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

$sql = "SELECT p.id AS id_pesanan, pelanggan.nama, pelanggan.no_hp, pelanggan.email, pelanggan.alamat,
               p.jenis_batako, p.jumlah, p.tanggal_pesan
        FROM pesanan p
        JOIN pelanggan ON p.pelanggan_id = pelanggan.id
        ORDER BY p.tanggal_pesan DESC";
$result = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Daftar Pemesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Daftar Pemesan Batako</h2>
        <div>
            <a href="tambah_pesanan.php" class="btn btn-primary">+ Tambah Pemesanan</a>
            <a href="laporan_pdf.php" class="btn btn-info" target="_blank">Cetak Laporan PDF</a>
            <a href="cetak_pdf_pesanan.php" class="btn btn-outline-dark" target="_blank">Cetak Semua Pesanan (PDF)</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'deleted'): ?>
        <div class="alert alert-success">Pesanan berhasil dihapus.</div>
    <?php elseif ($_GET['msg'] == 'updated'): ?>
        <div class="alert alert-success">Data pesanan berhasil diperbarui.</div>
    <?php elseif ($_GET['msg'] == 'not_found'): ?>
        <div class="alert alert-warning">Data tidak ditemukan.</div>
    <?php endif; ?>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Jenis Batako</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['no_hp']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['alamat']) . "</td>
                        <td>" . htmlspecialchars($row['jenis_batako']) . "</td>
                        <td>{$row['jumlah']}</td>
                        <td>{$row['tanggal_pesan']}</td>
                        <td>
                            <a href='edit_pesanan.php?id={$row['id_pesanan']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus_pesanan.php?id={$row['id_pesanan']}' 
                               class='btn btn-sm btn-danger'
                               onclick='return confirm(\"Yakin ingin menghapus pesanan ini?\");'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>Belum ada data pemesan.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

