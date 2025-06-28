<?php
require_once 'vendor/autoload.php'; // pastikan path ini benar

session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: index.php");
    exit;
}

use Dompdf\Dompdf;
use Dompdf\Options;

include 'koneksi.php';

// Ambil data rekap per bulan
$sql = "SELECT 
            DATE_FORMAT(tanggal_pesan, '%Y-%m') AS bulan,
            DATE_FORMAT(MIN(tanggal_pesan), '%M %Y') AS nama_bulan,
            SUM(jumlah) AS total_pesanan
        FROM pesanan
        GROUP BY bulan
        ORDER BY bulan DESC";
$result = mysqli_query($koneksi, $sql);

// Bangun HTML laporan
$html = '<h3 style="text-align:center;">Laporan Jumlah Pesanan per Bulan</h3>';
$html .= '<table border="1" cellpadding="6" cellspacing="0" width="100%">
            <thead style="background:#eee;">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Total Jumlah Pesanan</th>
                </tr>
            </thead>
            <tbody>';

$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_bulan']}</td>
                    <td>{$row['total_pesanan']}</td>
                  </tr>";
        $no++;
    }
} else {
    $html .= '<tr><td colspan="3" align="center">Data tidak ditemukan</td></tr>';
}
$html .= '</tbody></table>';

// Setup DomPDF
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Tampilkan ke browser
$dompdf->stream("laporan_pesanan_bulanan.pdf", ["Attachment" => false]);
exit;
