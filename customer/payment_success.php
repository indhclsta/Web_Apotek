<?php
session_start();
include '../service/connection.php';  // Pastikan file koneksi database sudah terhubung

// Mengecek apakah ada status pembayaran dan apakah statusnya adalah 'success'
if (isset($_POST['payment_status']) && $_POST['payment_status'] == 'success') {
    // Ambil data yang dikirimkan melalui POST
    $customer_name = $_POST['customer_name'];  // Nama pelanggan
    $id_customer = $_POST['id_customer'];      // ID pelanggan
    $payment_amount = $_POST['payment_amount']; // Jumlah pembayaran

    // Membuat pesan notifikasi
    $pesan = "Pembelian atas nama $customer_name telah berhasil dengan jumlah pembayaran Rp. $payment_amount.";

    // Query untuk memperbarui status pembayaran dan menyimpan pesan dalam tabel payment_status
    $sql = "UPDATE payment_status
            SET pesan = '$pesan', payment_status = 'success'
            WHERE id_customer = '$id_customer' AND payment_status != 'success'";  // Pastikan hanya transaksi yang belum sukses yang diperbarui

    if (mysqli_query($conn, $sql)) {
        echo "Notifikasi berhasil ditambahkan dan pembayaran berhasil diproses.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Status pembayaran tidak valid.";
}
?>
