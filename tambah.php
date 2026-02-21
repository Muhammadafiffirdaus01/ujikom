<?php
/**
 * File: tambah.php
 * Deskripsi: Halaman untuk menambahkan data mahasiswa
 * Author: Sistem Kelola Mahasiswa
 */

require_once "config/database.php";

$error = "";
$success = "";

/**
 * Proses Tambah Data Mahasiswa
 */
if (isset($_POST['simpan'])) {

    // Ambil dan bersihkan input
    $nim           = trim($_POST['nim']);
    $nama          = trim($_POST['nama']);
    $alamat        = trim($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gender        = $_POST['gender'];

    // =========================
    // VALIDASI INPUT
    // =========================
    if (empty($nim) || empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($gender)) {
        $error = "Semua field wajib diisi!";
    } else {

        try {

            // =========================
            // CEK NIM SUDAH ADA ATAU BELUM
            // =========================
            $cek = $pdo->prepare("SELECT COUNT(*) FROM mahasiswa WHERE nim = ?");
            $cek->execute([$nim]);
            $exists = $cek->fetchColumn();

            if ($exists > 0) {
                $error = "NIM sudah terdaftar, gunakan NIM lain!";
            } else {

                // =========================
                // INSERT DATA KE DATABASE
                // =========================
                $stmt = $pdo->prepare("INSERT INTO mahasiswa 
                    (nim, nama, alamat, tanggal_lahir, gender) 
                    VALUES (?, ?, ?, ?, ?)");

                $stmt->execute([$nim, $nama, $alamat, $tanggal_lahir, $gender]);

                // Redirect setelah berhasil
                header("Location: admin.php?status=sukses");
                exit;
            }

        } catch (PDOException $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- ========================= -->
<!-- NAVBAR -->
<!-- ========================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Aplikasi Mahasiswa</a>
        <div>
            <a href="index.php" class="btn btn-outline-light btn-sm me-2">HOME</a>
            <a href="admin.php" class="btn btn-outline-warning btn-sm">ADMIN</a>
        </div>
    </div>
</nav>

<!-- ========================= -->
<!-- FORM TAMBAH DATA -->
<!-- ========================= -->
<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Data Mahasiswa</h4>
        </div>

        <div class="card-body">

            <!-- Alert Error -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                    <small class="text-muted">NIM harus unik.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Pilih Gender --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="simpan" class="btn btn-success">
                        Simpan
                    </button>

                    <a href="admin.php" class="btn btn-warning">
                        Kembali ke Admin
                    </a>

                    <a href="index.php" class="btn btn-secondary">
                        Kembali ke Home
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

</body>
</html>