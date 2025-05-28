<?php
session_start();
include '../service/connection.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../service/login.php"); // Redirect jika admin belum login
    exit();
}

if (isset($_GET['id_notifikasi'])) {
    $id_notifikasi = $_GET['id_notifikasi'];

    // Update status pemberitahuan menjadi dibaca
    $update_query = "UPDATE notifikasi SET status_baca = 1 WHERE id_notifikasi = $id_notifikasi";
    if (mysqli_query($conn, $update_query)) {
        // Redirect kembali ke halaman notifikasi
        header("Location: notifadmin.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
