<?php
session_start();
include 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username=? AND password=MD5(?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_username'] = $row['username'];
        header("Location: daftar_pemesan.php");
        exit;
    } else {
        session_destroy(); // bersihkan session lama agar tidak auto-redirect
        $error = "Username atau password salah!";
    }
} elseif (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {
    header("Location: daftar_pemesan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Batako Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; }
        .login-box { max-width: 400px; margin: 80px auto; }
        .card { border-radius: 15px; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4>Login Admin</h4>
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off" autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- ✅ Tombol kembali ke root -->
            <div class="mt-3 text-center">
                <a href="../index.php" class="btn btn-link text-decoration-none">← Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
