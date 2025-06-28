<?php
require_once 'vendor/autoload.php'; // path DomPDF

session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: index.php");
    exit;
}

use Dompdf\Dompdf;
use Dompdf\Options;

include 'koneksi.php';

// Ambil data lengkap pesanan
$sql = "SELECT p.id AS id_pesanan, pelanggan.nama, pelanggan.no_hp, pelanggan.email, pelanggan.alamat,
               p.jenis_batako, p.jumlah, p.tanggal_pesan
        FROM pesanan p
        JOIN pelanggan ON p.pelanggan_id = pelanggan.id
        ORDER BY p.tanggal_pesan DESC";
$result = mysqli_query($koneksi, $sql);

// Bangun HTML
$html = '<h3 style="text-align:center;">Laporan Lengkap Data Pemesanan</h3>';
$html .= '<table border="1" cellpadding="6" cellspacing="0" width="100%">
            <thead style="background:#eee;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Jenis Batako</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>';

$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
                    <td>{$no}</td>
                    <td>".htmlspecialchars($row['nama'])."</td>
                    <td>".htmlspecialchars($row['no_hp'])."</td>
                    <td>".htmlspecialchars($row['email'])."</td>
                    <td>".htmlspecialchars($row['alamat'])."</td>
                    <td>".htmlspecialchars($row['jenis_batako'])."</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['tanggal_pesan']}</td>
                  </tr>";
        $no++;
    }
} else {
    $html .= '<tr><td colspan="8" align="center">Data belum tersedia.</td></tr>';
}
$html .= '</tbody></table>';

// DomPDF setup
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("laporan_semua_pesanan.pdf", ["Attachment" => false]);
exit;
