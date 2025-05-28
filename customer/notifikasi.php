<?php
session_start();
include '../service/connection.php'; // Pastikan koneksi ke database sudah ada

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: ../service/login.php"); // Redirect ke halaman login jika belum login
    exit();
}

$user_id = $_SESSION['id']; // Mendapatkan ID user yang login

// Ambil data notifikasi yang belum dibaca oleh user
$sql = "SELECT * FROM notifikasi WHERE id_customer = '$user_id' ORDER BY tgl_notifikasi DESC";
$result = mysqli_query($conn, $sql);

// Cek apakah ada notifikasi
if (mysqli_num_rows($result) > 0) {
    $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $notifications = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Cure & Care</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
                .back-button {
            background-color: #E9E9B4;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .back-button a {
            color: black;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .back-button i {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="user-header">
        <div class="user-info">
            <i class="bi bi-person-circle" style="font-size: 40px; margin-left:10px; margin-right:20px;"></i>
            <div class="user-text">
                <span class="user-name">User</span>
                <span class="user-role">Customer</span>
            </div>
        </div>
        <div class="user-actions">
        <div class="flex justify-between items-center p-4">
        <a href="./dashboard.php"><i class="fas fa-arrow-left text-2xl"> Back</i></a>
    </div>
        </div>
    </header>

    <main class="p-4">
    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold">NOTIFIKASI CUSTOMER</h1>
    </div>

        <!-- Cek jika ada notifikasi -->
        <?php if (count($notifications) > 0): ?>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <?php foreach ($notifications as $notif): ?>
                    <div class="alert alert-info <?php echo $notif['status_baca'] == 'belum' ? 'bg-yellow-200' : 'bg-gray-200'; ?>">
                        <p><strong><?= $notif['pesan'] ?></strong></p>
                        <p class="text-sm text-gray-500"><?= date('d M Y', strtotime($notif['tgl_notifikasi'])) ?></p>

                        <!-- Menandai notifikasi sebagai sudah dibaca -->
                        <?php if ($notif['status_baca'] == 'belum'): ?>
                            <a href="mark_as_read.php?id_notifikasi=<?= $notif['id_notifikasi'] ?>" class="text-blue-500">Mark as read</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Tidak ada notifikasi baru.</p>
        <?php endif; ?>
    </main>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
