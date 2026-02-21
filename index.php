<?php
require_once "functions/mahasiswa.php";

/*
|--------------------------------------------------------------------------
| Ambil Data
|--------------------------------------------------------------------------
| - $search : menangkap input pencarian
| - $data   : mengambil data mahasiswa (descending NIM)
| - $total  : jumlah seluruh mahasiswa
| - $laki   : jumlah mahasiswa laki-laki
| - $perempuan : jumlah mahasiswa perempuan
*/

$search = $_GET['search'] ?? null;
$data = getMahasiswa($search);
$total = getTotalMahasiswa();
$laki = getGenderCount('L');
$perempuan = getGenderCount('P');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg" style="background:linear-gradient(90deg,#4e73df,#224abe);">
    <div class="container">
        <span class="navbar-brand text-white fw-bold">Data Mahasiswa</span>
        <div>
            <a href="index.php" class="btn btn-light btn-sm me-2">HOME</a>
            <a href="admin.php" class="btn btn-outline-light btn-sm">ADMIN</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <h3 class="mb-3">Data Mahasiswa</h3>

    <!-- ================= SEARCH ================= -->
    <form method="GET" class="row mb-4">
        <div class="col-md-10">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari Nama Mahasiswa..."
                   value="<?= htmlspecialchars($search ?? '') ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    <!-- ================= STATISTIK ================= -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>Total Mahasiswa</h5>
                    <h3><?= $total ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>Laki-laki</h5>
                    <h3><?= $laki ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5>Perempuan</h5>
                    <h3><?= $perempuan ?></h3>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= GRAFIK ================= -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="mb-3">Grafik Statistik Gender</h5>
            <canvas id="genderChart"></canvas>
        </div>
    </div>

    <!-- ================= TABLE ================= -->
    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Gender</th>
                        <th>Usia</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(count($data) > 0): ?>
                    <?php foreach($data as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['nim']) ?></td>
                            <td><?= htmlspecialchars($m['nama']) ?></td>
                            <td><?= htmlspecialchars($m['alamat']) ?></td>
                            <td><?= htmlspecialchars($m['tanggal_lahir']) ?></td>
                            <td><?= $m['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                            <td><?= hitungUsia($m['tanggal_lahir']) ?> Tahun</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('genderChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Laki-laki', 'Perempuan'],
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: [<?= $laki ?>, <?= $perempuan ?>],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});
</script>

</body>
</html>