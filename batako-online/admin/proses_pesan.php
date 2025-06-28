<?php
include 'koneksi.php';

// Validasi dan sanitasi input
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$jenis_batako = mysqli_real_escape_string($koneksi, $_POST['jenis_batako']);
$jumlah = intval($_POST['jumlah']);

// Mulai transaksi
mysqli_begin_transaction($koneksi);

try {
    // Insert data pelanggan
    $query_pelanggan = "INSERT INTO pelanggan (nama, alamat, no_hp, email) 
                        VALUES (?, ?, ?, ?)";
    $stmt_pelanggan = mysqli_prepare($koneksi, $query_pelanggan);
    mysqli_stmt_bind_param($stmt_pelanggan, "ssss", $nama, $alamat, $no_hp, $email);
    mysqli_stmt_execute($stmt_pelanggan);
    $pelanggan_id = mysqli_insert_id($koneksi);

    // Insert data pesanan (tambahkan tanggal_pesan)
    $query_pesanan = "INSERT INTO pesanan (pelanggan_id, jenis_batako, jumlah, tanggal_pesan) 
                      VALUES (?, ?, ?, NOW())";
    $stmt_pesanan = mysqli_prepare($koneksi, $query_pesanan);
    mysqli_stmt_bind_param($stmt_pesanan, "isi", $pelanggan_id, $jenis_batako, $jumlah);
    mysqli_stmt_execute($stmt_pesanan);

    // Commit transaksi
    mysqli_commit($koneksi);

    // Redirect ke halaman sukses
    header("Location: sukses.html");
    exit();

} catch (Exception $e) {
    // Rollback jika ada error
    mysqli_rollback($koneksi);
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
