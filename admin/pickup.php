<?php
include "../connection.php"; // Include your database connection

// Query to fetch pickup data
$query = "SELECT * FROM pickup ORDER BY no_pesanan DESC";
$result = mysqli_query($conn, $query);

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $no_pesanan = $row['no_pesanan'];
        $username = $row['username'];
        $waktu = $row['waktu'];
        echo '
        ';
    }
} else 
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotik-pickup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Reset and basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #faf3e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 900px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 2px solid #e0e0e0;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-icon {
            font-size: 36px;
            margin-right: 10px;
        }

        .user-text {
            display: flex;
            flex-direction: column;
        }

        .user-text .user {
            color: orange;
            font-weight: bold;
        }

        .user-text .admin {
            color: black;
        }

        .logout-section {
            display: flex;
            align-items: center;
        }

        .logout-icon {
            font-size: 36px;
            color: black;
            margin-right: 10px;
            cursor: pointer;
        }

        .logout-button {
            background-color: white;
            color: red;
            border: 1px solid red;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background-color: red;
            color: white;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }

        .order-header {
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 5px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .order-box {
            background-color: #fff;
            padding: 12px;
            margin-top: 10px;
            border-radius: 5px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

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
    <div class="container">
        <header>
            <div class="user-info">
                <i class="fas fa-user user-icon"></i>
                <div class="user-text">
                    <span class="user">User</span>
                    <span class="admin">Admin</span>
                </div>
            </div>
            
        </header>
        <h1 class="text-center text-4xl font-bold text-gray-800 mb-2">Pick Up</h1>

        <div class="back-button">
            <a href="homeadmin.php"><i class="fas fa-arrow-left text-xl"></i> Back</a>
        </div>

        <div class="order-header">
            <span>No Pesanan</span>
            <span>Username</span>
            <span>Waktu</span>
            <span>Action</span>
        </div>

        <!-- Order items -->
        <?php
        include "../connection.php";

        // Query to get data of orders
        $query = "SELECT * FROM pickup ORDER BY no_pesanan DESC"; // Sort by order number
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $no_pesanan = $row['no_pesanan'];
                $username = $row['username'];
                $waktu = $row['waktu'];
                echo '
        <div class="order-box" id="order-' . $no_pesanan . '">
            <div>' . $no_pesanan . '</div>
            <div>' . $username . '</div>
            <div>' . $waktu . '</div>
            <div class="status-buttons">
                <a href="delete-pickup.php?no_pesanan=' . $no_pesanan . '" onclick="return confirmDelete(' . $no_pesanan . ')">
                    <button class="bg-green-500 text-white px-4 py-1 rounded-lg hover:bg-green-700 transition duration-300">SUDAH</button>
                </a>
            </div>
        </div>';
            }
        } else {
            echo "<p class='text-center text-gray-600'>Tidak ada pesanan untuk ditampilkan.</p>";
        }
        ?>
    </div>

    <script>
        function confirmDelete(orderId) {
            if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
                var orderElement = document.getElementById('order-' + orderId);
                if (orderElement) {
                    orderElement.remove();
                }
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>
