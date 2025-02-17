<?php
include "../connection.php";

if (isset($_GET['no_pesanan'])) {
    $no_pesanan = $_GET['no_pesanan'];

    if (!empty($no_pesanan)) {
        $query = "DELETE FROM pickup WHERE no_pesanan = '$no_pesanan'";

        if (mysqli_query($conn, $query)) {
            header("Location: pickup.php");
            exit();
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    } else {
        echo "Nomor pesanan tidak valid!";
    }
} else {
    echo "No pesanan tidak ditemukan!";
}
?>
