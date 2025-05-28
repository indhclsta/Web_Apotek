<?php
session_start();
include '../service/connection.php';

$getAllTransactionItems = mysqli_query($conn, "SELECT 
    transaksi.id_transaksi,
    transaksi.tgl_transaksi,
    keranjang.id AS keranjang_id,
    keranjang_items.id AS keranjang_item_id,    
    keranjang_items.quantitiy,
    keranjang.total_harga,
    obat.id AS obat_id,
    keranjang.user_id,
    admin.id AS user_id,
    admin.username,
    obat.merek,
    obat.stok_obat,
    obat.tanggal_produksi,
    obat.tanggal_eks,
    obat.komposisi,
    obat.harga,
    obat.gambar AS obat_gambar
FROM 
    transaksi
JOIN 
    keranjang ON transaksi.keranjang_id = keranjang.id
JOIN 
    keranjang_items ON keranjang.id = keranjang_items.keranjang_id
JOIN 
    obat ON keranjang_items.obat_id = obat.id
JOIN
    admin ON keranjang.user_id = admin.id
");

while($row = mysqli_fetch_assoc($getAllTransactionItems)) {
    $obat[] = $row;
}
?>

<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5dc; /* Retaining original background color */
        }
        .bottom-icons {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            background-color: black;
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .bottom-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 15px;
            color: #333;
            cursor: pointer;
        }

        .bottom-icon .material-icons {
            font-size: 24px;
            color: orange;
        }

        .bottom-icon .icon-text {
            font-size: 0.8rem;
            margin-top: 5px;
            color: orange;
        }

        .bottom-icon:nth-child(1) .material-icons,
        .bottom-icon:nth-child(3) .material-icons {
            color: white;
        }

        .bottom-icon:nth-child(1) .icon-text,
        .bottom-icon:nth-child(3) .icon-text {
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .table td {
            vertical-align: middle;
        }

        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .table-bordered {
            border: 1px solid #ccc;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body class="bg-[#f5f1d6] p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <i class="fas fa-user-circle text-blue-500 text-3xl"></i>
            <div class="ml-3">
                <p class="text-red-500 text-sm">User</p>
                <p class="text-black font-bold">Admin</p>
            </div>
        </div>
    </div>

    <!-- Title Section -->
    <h1 class="text-center text-4xl font-bold text-gray-800 mb-2">Laporan Payment</h1>
    <hr class="border-t border-gray-400 mb-6">
            <span class="text-muted">Laporan Pengeluaran</span>
        </div>
        <div class="border-top border-dark mb-4"></div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Username</th>
                        <th>Description</th>
                        <th>Available</th>
                        <th>Unit Price</th>
                        <th>Jumlah di Beli</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($obat as $o): ?>
                    <tr>
                        <td><img src="../img/<?= $o['obat_gambar'] ?>" alt="Product Image" class="product-img"></td>
                        <td><?= $o['username'] ?></td>
                        <td><?= $o['merek'] ?></td>
                        <td>-</td>
                        <td><?= number_format($o['harga'], 0, ',', '.') ?></td>
                        <td><?= $o['quantitiy'] ?></td>
                        <td><?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-icons">
        <div class="bottom-icon" onclick="window.location.href='homeadmin.php'">
            <span class="material-icons">home</span>
            <div class="icon-text">Home</div>
        </div>
        <div class="bottom-icon" onclick="window.location.href='payment.php'">
            <span class="material-icons">payment</span>
            <div class="icon-text">Payment</div>
        </div>
        <div class="bottom-icon" onclick="window.location.href='tabeladmin.php'">
            <span class="material-icons">report</span>
            <div class="icon-text">Report</div>
        </div>
    </div>
</body>
</html>
