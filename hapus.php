<?php
/**
 * File: hapus.php
 * Deskripsi: Menghapus data mahasiswa berdasarkan NIM
 */

require_once "config/database.php";

if (!isset($_GET['nim'])) {
    header("Location: admin.php");
    exit;
}

$nim = $_GET['nim'];

// Hapus data
$stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = ?");
$stmt->execute([$nim]);

header("Location: admin.php?status=hapus_sukses");
exit;