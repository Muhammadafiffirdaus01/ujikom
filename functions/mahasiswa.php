<?php
require_once "config/database.php";

/**
 * Ambil semua data mahasiswa
 */
function getMahasiswa($search = null) {
    global $pdo;

    if ($search) {
        $stmt = $pdo->prepare("SELECT * FROM mahasiswa 
                               WHERE nama LIKE ?
                               ORDER BY nim DESC");
        $stmt->execute(["%$search%"]);
    } else {
        $stmt = $pdo->query("SELECT * FROM mahasiswa ORDER BY nim DESC");
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Hitung total mahasiswa
 */
function getTotalMahasiswa() {
    global $pdo;
    return $pdo->query("SELECT COUNT(*) FROM mahasiswa")->fetchColumn();
}

/**
 * Hitung jumlah berdasarkan gender
 */
function getGenderCount($gender) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM mahasiswa WHERE gender=?");
    $stmt->execute([$gender]);
    return $stmt->fetchColumn();
}

/**
 * Hitung usia dari tanggal lahir
 */
function hitungUsia($tgl_lahir) {
    $birthDate = new DateTime($tgl_lahir);
    $today = new DateTime();
    return $today->diff($birthDate)->y;
}
?>