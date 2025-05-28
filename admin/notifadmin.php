<?php
session_start();
include '../service/connection.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ./service/login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch the logged-in admin's details
$username = $_SESSION['username'];
$sql_user = "SELECT id, username FROM admin WHERE username = '$username'";
$result_user = mysqli_query($conn, $sql_user);

if ($result_user) {
    $user = mysqli_fetch_assoc($result_user); // Fetch user data
} else {
    echo "Error fetching user details: " . mysqli_error($conn);
    exit();
}

// Query to fetch unread notifications
$sql = "SELECT n.*, a.username AS customer_name
        FROM notifikasi n
        JOIN admin a ON n.id_customer = a.id  -- Menggunakan tabel admin
        WHERE n.status_baca = 0
        ORDER BY tgl_notifikasi DESC";
$result = mysqli_query($conn, $sql);

?>

<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F7F6D9;
        }
        .back-button {
            background-color: #E9E9B4;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 10px;
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
<body class="p-4">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <i class="fas fa-user text-blue-500 text-2xl"></i>
            <span class="ml-2"><?php echo $user['username']; ?> (Admin)</span>
        </div>
    </div>
    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold">NOTIFIKASI ADMIN</h1>
    </div>
    <div class="back-button">
        <a href="homeadmin.php"><i class="fas fa-arrow-left text-xl"></i> Back</a>
    </div>
    <div>
        <h2 class="text-xl font-bold mb-2">Notifikasi</h2>
        <hr class="border-t-2 border-black mb-4">
        <div class="space-y-4">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Pesan notifikasi yang dikirim ke admin
            $pesan = "Pembelian atas nama " . $row['customer_name'] ;
            
            echo '<div class="flex items-center bg-[#e9e7a0] p-4 rounded">';
            echo '<i class="fas fa-bell text-yellow-500 text-2xl"></i>';
            echo '<span class="ml-4">' . $pesan . '</span>';
            echo '<span class="ml-4 text-sm text-gray-500">' . $row['customer_name'] . '</span>'; // Menampilkan nama pelanggan
            echo '<a href="mark_as_read.php?id_notifikasi=' . $row['id_notifikasi'] . '" class="ml-4 text-blue-500">Mark as Read</a>';
            echo '</div>';
        }
    } else {
        echo "<p>Tidak ada notifikasi baru.</p>";
    }
    ?>
    </div>
    </div>
</body>
</html>
