<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotik Admin - Sales Report</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #7c3aed;
            --primary-light: #8b5cf6;
            --primary-lighter: #c4b5fd;
            --dark: #1e1b4b;
            --light: #f5f3ff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            padding-bottom: 6rem;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .icon-button {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            transition: all 0.2s ease;
        }

        .icon-button:hover {
            background-color: var(--primary);
            color: white;
        }

        .user-icon {
            color: var(--primary);
            font-size: 1.75rem;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin: 1.5rem 0;
            text-align: center;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin: 1.5rem 0 1rem;
            position: relative;
            padding-left: 1rem;
        }

        .section-title:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        .report-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .report-table th {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 500;
        }

        .report-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .report-table tr:last-child td {
            border-bottom: none;
        }

        .report-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .report-table tr:hover {
            background-color: #f3f4f6;
        }

        .action-link {
            color: var(--primary);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .action-link.edit:hover {
            color: var(--success);
        }

        .action-link.delete:hover {
            color: var(--danger);
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 0.75rem 0;
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #64748b;
            text-decoration: none;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .nav-item.active, .nav-item:hover {
            color: var(--primary);
            background: rgba(124, 58, 237, 0.1);
        }

        .nav-item .material-icons {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .add-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }

        .add-button:hover {
            background-color: var(--primary-light);
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <div class="flex items-center gap-3">
                <a href="profileadmin.php" class="user-icon">
                    <i class="material-icons">account_circle</i>
                </a>
                <div>
                    <div class="text-sm font-medium text-purple-600">Hello, Admin</div>
                    <div class="text-base font-semibold">Sales Report</div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="notifadmin.php" class="icon-button">
                    <i class="material-icons">notifications</i>
                </a>
                <a href="form_report.php" class="icon-button">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </header>

        <h1>Medicine Sales Report</h1>

        <div class="section-title">Medicine Sales Data</div>

        <div class="overflow-x-auto">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Medicine Name</th>
                        <th>Category</th>
                        <th>Quantity Sold</th>
                        <th>Unit Price</th>
                        <th>Total Sales</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../service/connection.php";
                    $id = 1;
                    $ambildata = mysqli_query($conn, "select * from report");
                    while ($tampil = mysqli_fetch_array($ambildata)) {
                        echo "
                        <tr>
                            <td>$id</td>
                            <td>$tampil[Tanggal]</td>
                            <td>$tampil[Nama_Obat]</td>
                            <td>$tampil[Kategori]</td>
                            <td>$tampil[Jumlah_Terjual]</td>
                            <td>Rp " . number_format($tampil['Harga_Satuan'], 0, ',', '.') . "</td>
                            <td>Rp " . number_format($tampil['Total_Penjualan'], 0, ',', '.') . "</td>
                            <td>
                                <a href='barang-ubah.php?kode=$tampil[Id]' class='action-link edit'>Edit</a>
                            </td>
                            <td>
                                <a href='hapus.php?kode=$tampil[Id]' class='action-link delete'>Delete</a>
                            </td>
                        </tr>";
                        $id++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="homeadmin.php" class="nav-item">
            <i class="material-icons">home</i>
            <span>Home</span>
        </a>
        <a href="payment.php" class="nav-item">
            <i class="material-icons">payments</i>
            <span>Payments</span>
        </a>
        <a href="form_report.php" class="nav-item active">
            <i class="material-icons">assessment</i>
            <span>Reports</span>
        </a>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const navItems = document.querySelectorAll('.nav-item');
            
            navItems.forEach(item => {
                if (item.getAttribute('href') === currentPage) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        });
    </script>

</body>
</html>