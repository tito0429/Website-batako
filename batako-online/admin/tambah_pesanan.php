<?php
session_start();
if (!isset($_SESSION['admin_login']) || $_SESSION['admin_login'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Batako Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-label { font-weight: 500; }
        .btn-primary { background-color: #0d6efd; border: none; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Form Pemesanan Batako</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex">
                            <a href="daftar_pemesan.php" class="btn btn-success me-2">Lihat Data Pemesan</a>
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </div>
                        <form action="proses_pesan.php" method="post" id="formPesan">
                            <div class="mb-3">
                                <label class="form-label">Data Pelanggan</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" class="form-control" name="no_hp" placeholder="No. HP" required>
                                    </div>
                                    <div class="col-12">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Detail Pesanan</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <select class="form-select" name="jenis_batako" required>
                                            <option value="">Pilih Jenis Batako</option>
                                            <option value="Batako Press">Batako Press</option>
                                            <option value="Batako Tras">Batako Tras</option>
                                            <option value="Batako Putih">Batako Putih</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="jumlah" min="1" placeholder="Jumlah (buah)" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formPesan').addEventListener('submit', function(e) {
            const jumlah = document.querySelector('input[name="jumlah"]');
            if(jumlah.value < 1) {
                alert('Jumlah pesanan minimal 1 buah!');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
