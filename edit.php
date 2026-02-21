<?php
/**
 * File: edit.php
 * Deskripsi: Edit data mahasiswa (NIM tidak bisa diubah)
 */

require_once "config/database.php";

if (!isset($_GET['nim'])) {
    header("Location: admin.php");
    exit;
}

$nim = $_GET['nim'];

// Ambil data berdasarkan NIM
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
$stmt->execute([$nim]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: admin.php");
    exit;
}

$error = "";

/**
 * PROSES UPDATE DATA
 */
if (isset($_POST['update'])) {

    $nama          = trim($_POST['nama']);
    $alamat        = trim($_POST['alamat']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $gender        = $_POST['gender'];

    if (empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($gender)) {
        $error = "Semua field wajib diisi!";
    } else {

        $update = $pdo->prepare("UPDATE mahasiswa 
                                 SET nama=?, alamat=?, tanggal_lahir=?, gender=? 
                                 WHERE nim=?");

        $update->execute([$nama, $alamat, $tanggal_lahir, $gender, $nim]);

        header("Location: admin.php?status=update_sukses");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3>Edit Data Mahasiswa</h3>

<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

    <div class="mb-3">
        <label>NIM</label>
        <input type="text" class="form-control" value="<?= $data['nim'] ?>" readonly>
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control"
               value="<?= $data['nama'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
               class="form-control"
               value="<?= $data['tanggal_lahir'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-select" required>
            <option value="L" <?= $data['gender']=='L'?'selected':'' ?>>Laki-laki</option>
            <option value="P" <?= $data['gender']=='P'?'selected':'' ?>>Perempuan</option>
        </select>
    </div>

    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="admin.php" class="btn btn-secondary">Kembali</a>

</form>

</body>
</html>