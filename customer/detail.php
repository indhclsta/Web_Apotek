<?php
session_start();
include '../service/connection.php';

if (!isset($_GET['product'])) {
    header("Location: dashboard.php");
    exit();
}

$user_id = $_SESSION['id'];

$getObatData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM obat WHERE id = " . $_GET['product']));

if (isset($_POST['tambah_produk'])) {
    $produk_id = $_POST['produk_id'];
    $quantity = $_POST['quantity'];

    // Query to check if the user already has an active cart
    $res = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id = $user_id AND NOT EXISTS (
        SELECT 1 FROM transaksi WHERE transaksi.keranjang_id = keranjang.id
    );");

    if (mysqli_num_rows($res) > 0) {
        // Use existing cart
        $keranjang_id = mysqli_fetch_assoc($res)['id'];
        mysqli_query($conn, "INSERT INTO keranjang_items VALUES (NULL, $keranjang_id, $produk_id, $quantity)");
    } else {
        // Create new cart
        mysqli_query($conn, "INSERT INTO keranjang VALUES (NULL, $user_id, '" . $_SESSION['username'] . "', 0)");
        
        // Get the new cart id
        $res = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id = $user_id AND NOT EXISTS (
            SELECT 1 FROM transaksi WHERE transaksi.keranjang_id = keranjang.id
        );");

        $keranjang_id = mysqli_fetch_assoc($res)['id'];

        // Add item to the new cart
        mysqli_query($conn, "INSERT INTO keranjang_items VALUES (NULL, $keranjang_id, $produk_id, $quantity)");
    }

    // Insert notification for admin after checkout
    $current_time = date('Y-m-d H:i:s');
    $customer_name = $_SESSION['username']; // Get the customer's name from session

    // Insert notification into the 'notifikasi' table
    $notification_query = "INSERT INTO notifikasi (id_customer, customer_name, pesan, status_baca, tgl_notifikasi, status_pembayaran)
                           VALUES ($user_id, '$customer_name', 'Pembelian atas nama $customer_name SUKSES. Transaksi akan segera diproses.', 0, '$current_time', 'pending')";
    mysqli_query($conn, $notification_query);

    // Redirect the user to the cart page
    header("Location: keranjang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cure & Care</title>
    <!-- tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.15);
            padding: 10px 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .user-text {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            color: red;
            font-size: 20px;
        }

        .user-role {
            color: black;
            font-size: 18px;
            font-weight: bold;
        }

        .user-actions {
            display: flex;
            gap: 20px;
        }

        .action-btn {
            background-color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            transition: background-color 0.3s ease;
        }

        .action-btn:hover {
            background-color: #e0e0e0;
        }

        .cart-item {
            margin-bottom: 20px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f0f0db;
            border-radius: 8px;
        }

        .item-image {
            width: 100px;
        }

        .item-details {
            display: flex;
            flex-direction: column;
            margin-left: 10px;
            flex-grow: 1;
        }

        .item-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .item-quantity {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            background-color: #d9534f;
            border: none;
            color: white;
            font-size: 14px;
            padding: 4px 8px;
            margin: 0 5px;
            border-radius: 4px;
            cursor: pointer;
        }

        .text-red-500 {
            font-size: 25px;
        }

        .total-price {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .font-bold {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- header  -->
    <header class="user-header">
        <div class="user-info">
            <i class="bi bi-person-circle" style="font-size: 40px; margin-left:10px; margin-right:20px;"></i>
            <div class="user-text">
                <span class="user-name">User</span>
                <span class="user-role">Customer</span>
            </div>
        </div>
        <div class="user-actions">
            <button class="action-btn">
                <a href="./notifikasi.php"><i class="bi bi-bell"></i></a>
            </button>
            <button class="action-btn">
                <a href="./keranjang.php"><i class="bi bi-cart"></i></a>
            </button>
        </div>
    </header>
    <div class="flex justify-between items-center p-4">
        <a href="./keranjang.php"><i class="fas fa-arrow-left text-2xl"> Back</i></a>
    </div>

    <main class="p-4">
    <section class="flex space-x-8 bg-white rounded-lg p-4">
        <!-- Product Image (left side) -->
        <div class="w-1/3 flex justify-center">
            <img src="../img/<?= $getObatData['gambar'] ?>" alt="Image of <?= $getObatData['merek'] ?>" class="w-36 h-36 object-cover rounded-lg">
        </div>

        <!-- Product Information (right side) -->
        <div class="w-2/3">
            <h2 class="text-xl font-bold mb-4">Details Produk</h2>
            <h3 class="text-lg font-bold"><?= $getObatData['merek'] ?></h3>
            <p class="text-sm text-gray-600">Terjual 500+ | <i class="fas fa-star text-yellow-500"></i> 5 (150 rating)</p>
            <p class="text-2xl font-bold text-red-600 mt-2" id="price">Rp. <?= number_format($getObatData['harga'], 3, ',', '.') ?></p>

            <div class="mt-4">
                <p class="font-bold">Indikasi:</p>
                <ul class="text-sm list-disc list-inside">
                    <?php
                    // Split 'indikasi' by commas
                    $indikasi = $getObatData['indikasi'];
                    $indikasiItems = explode(',', $indikasi);
                    foreach ($indikasiItems as $item) {
                        echo "<li>" . trim($item) . "</li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="mt-4">
                <p class="font-bold">Komposisi:</p>
                <p class="text-sm">Tiap gram mengandung:</p>
                <ul class="text-sm list-disc list-inside">
                    <?= $getObatData['komposisi'] ?>
                </ul>
            </div>
        </div>

            <div class="w-1/3 mt-24">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-lg font-bold mb-4">Atur Jumlah</h2>
                    <div class="flex items-center space-x-2 mb-4">
                        <button id="decreaseBtn" class="quantity-btn">-</button>
                        <input type="text" id="quantity_data" class="text-center border border-gray-400 rounded-md w-12" value="1" readonly />
                        <button id="increaseBtn" class="quantity-btn">+</button>
                    </div>
                    <span class="text-lg font-bold" id="subtotal">Rp. <?= number_format($getObatData['harga'], 3, ',', '.') ?>,-</span>
                    <form method="POST" action="">
                        <input type="hidden" name="produk_id" value="<?= $getObatData['id'] ?>" />
                        <input type="hidden" name="quantity" id="quantity" value="1" />
                        <button type="submit" name="tambah_produk" class="w-full mt-4 py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Update the price in JavaScript to use the formatted PHP price
        const pricePerUnit = <?= $getObatData['harga'] ?>; // This will be the raw price value
        let quantity = 1;

        // Update DOM elements for quantity and subtotal
        const quantityDisplay = document.getElementById('quantity_data');
        const subtotalDisplay = document.getElementById('subtotal');

        // Increase Quantity
        document.getElementById('increaseBtn').addEventListener('click', () => {
            if (quantity < <?= $getObatData['stok_obat'] ?>) { // Check stock limit
                quantity++;
                quantityDisplay.value = quantity;
                updateDisplay();
            }
        });

        // Decrease Quantity
        document.getElementById('decreaseBtn').addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantityDisplay.value = quantity;
                updateDisplay();
            }
        });

        // Update display for quantity and subtotal
        function updateDisplay() {
            const subtotal = quantity * pricePerUnit;
            const formattedSubtotal = subtotal.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // Format the subtotal with commas and 3 decimal places
            subtotalDisplay.textContent = `Rp. ${formattedSubtotal},-`; // Display the formatted subtotal
        }

        // Initialize the display
        updateDisplay();
    </script>
</body>
</html>
