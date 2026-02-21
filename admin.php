<?php
require_once "functions/mahasiswa.php";
$data = getMahasiswa();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Data Mahasiswa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" style="background:linear-gradient(90deg,#4e73df,#224abe);">
    <div class="container">
        <span class="navbar-brand text-white fw-bold">Kelola Data Mahasiswa</span>
        <div>
            <a href="index.php" class="btn btn-light btn-sm">HOME</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <strong>Halaman Admin - Kelola Data Mahasiswa</strong>
            <a href="index.php" class="btn btn-light btn-sm">Kembali ke Home</a>
        </div>

        <div class="card-body">

            <a href="tambah.php" class="btn btn-success mb-3">
                + Tambah Data
            </a>

            <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Gender</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($data as $m): ?>
                    <tr>
                        <td><?= $m['nim'] ?></td>
                        <td><?= $m['nama'] ?></td>
                        <td><?= $m['alamat'] ?></td>
                        <td><?= $m['tanggal_lahir'] ?></td>
                        <td><?= $m['gender'] ?></td>
                        <td>
                            <a href="edit.php?nim=<?= $m['nim'] ?>" 
                               class="btn btn-primary btn-sm">Edit</a>

                            <a href="hapus.php?nim=<?= $m['nim'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>