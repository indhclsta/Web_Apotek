<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
   <script src="https://cdn.tailwindcss.com"></script>
   <!-- Bootstrap 5 CSS CDN -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- icon bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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
        .bottom-icon:nth-child(2) .material-icons {
            color: white;
        }

        .bottom-icon:nth-child(1) .icon-text,
        .bottom-icon:nth-child(2) .icon-text {
            color: white;
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
        <div class="flex items-center space-x-6">
            <i class="fas fa-bell text-gray-700 text-xl hover:text-gray-900 cursor-pointer"></i>
            <a href="./form_report.php"><i class="fas fa-plus-circle text-gray-700 text-xl hover:text-gray-900 cursor-pointer"></i></a>
        </div>
    </div>

    

    <!-- Title Section -->
    <h1 class="text-center text-4xl font-bold text-gray-800 mb-2">REPORT</h1>
    <hr class="border-t border-gray-400 mb-6">

    <!-- Subtitle Section -->
    <h2 class="text-red-500 text-2xl font-semibold mb-4">Data Obat</h2>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 shadow-lg bg-white rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200 text-gray-800">
                    <th class="border border-gray-300 p-3 text-left">No</th>
                    <th class="border border-gray-300 p-3 text-left">Tanggal</th>
                    <th class="border border-gray-300 p-3 text-left">Nama Obat</th>
                    <th class="border border-gray-300 p-3 text-left">Kategori</th>
                    <th class="border border-gray-300 p-3 text-left">Jumlah Terjual</th>
                    <th class="border border-gray-300 p-3 text-left">Harga Satuan</th>
                    <th class="border border-gray-300 p-3 text-left">Total Penjualan</th>
                    <th class="border border-gray-300 p-3 text-center" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../service/connection.php";
                $id = 1;
                $ambildata = mysqli_query($conn, "select * from report");
                while ($tampil = mysqli_fetch_array($ambildata)) {
                    echo "
                    <tr class='hover:bg-gray-100 text-gray-800'>
                        <td class='border border-gray-300 p-3'>$id</td>
                        <td class='border border-gray-300 p-3'>$tampil[Tanggal]</td>
                        <td class='border border-gray-300 p-3'>$tampil[Nama_Obat]</td>
                        <td class='border border-gray-300 p-3'>$tampil[Kategori]</td>
                        <td class='border border-gray-300 p-3'>$tampil[Jumlah_Terjual]</td>
                        <td class='border border-gray-300 p-3'>Rp $tampil[Harga_Satuan]</td>
                        <td class='border border-gray-300 p-3'>Rp $tampil[Total_Penjualan]</td>
                        <td class='border border-gray-300 p-3 text-center'>
                            <a href='barang-ubah.php?kode=$tampil[Id]' class='text-blue-500 hover:underline'>Edit</a>
                        </td>
                        <td class='border border-gray-300 p-3 text-center'>
                            <a href='hapus.php?kode=$tampil[Id]' class='text-red-500 hover:underline'>Delete</a>
                        </td>
                    </tr>";
                    $id++;
                }
                ?>
                
            </tbody>
        </table>
        </div>
    <div class="bottom-icons">
    <div class="bottom-icon" onclick="window.location.href='homeadmin.php'">
        <span class="material-icons">home</span>
        <div class="icon-text">Home</div>
    </div>
    <div class="bottom-icon" onclick="window.location.href='payment.php'">
        <span class="material-icons">payment</span>
        <div class="icon-text">Payment</div>
    </div>
    <div class="bottom-icon" onclick="window.location.href='form_report.php'">
        <span class="material-icons">report</span>
        <div class="icon-text">Report</div>
    </div>
</div>
    </div>
</body>
</html>