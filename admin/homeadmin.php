<?php
session_start();

include '../service/connection.php';

$getAllObat = mysqli_query($conn, "SELECT * FROM obat");

while($row = mysqli_fetch_assoc($getAllObat)) {
   $obats[] = $row;
}

// Menampilkan pesan konfirmasi jika produk berhasil dihapus
if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotik Admin Dashboard</title>
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

        .search-box {
            width: 100%;
            max-width: 500px;
            margin: 1.5rem auto;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-right: 2.5rem;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            outline: none;
            transition: all 0.2s ease;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
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

        .categories {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
            flex-wrap: wrap;
        }

        .category {
            flex: 1;
            min-width: 150px;
            background: white;
            border-radius: 0.75rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .category:hover {
            transform: translateY(-2px);
        }

        .category-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            font-weight: 600;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .product-box {
            background: white;
            border-radius: 0.75rem;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .product-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-box img {
            width: 100%;
            height: 100px;
            object-fit: contain;
            margin-bottom: 0.75rem;
        }

        .product-name {
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 0.875rem;
            color: var(--primary);
            font-weight: 600;
        }

        .product-actions {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            display: none;
            flex-direction: column;
            gap: 0.25rem;
        }

        .product-box:hover .product-actions {
            display: flex;
        }

        .action-button {
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .add-product-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-product-box:hover {
            background: var(--primary-light);
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
                    <div class="text-base font-semibold">Apotek Dashboard</div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="notifadmin.php" class="icon-button">
                    <i class="material-icons">notifications</i>
                </a>
                <a href="pickup.php" class="icon-button">
                    <i class="material-icons">local_shipping</i>
                </a>
            </div>
        </header>

        <h1>Pharmacy Management</h1>

        <div class="search-box">
            <input type="text" placeholder="Search medicines...">
            <i class="material-icons search-icon">search</i>
        </div>

        <div class="section-title">Medicine Categories</div>

        <div class="categories">
            <div class="category">
                <div class="category-icon" style="background: var(--success);">U</div>
                <div class="category-text">General Medicines</div>
            </div>
            <div class="category">
                <div class="category-icon" style="background: var(--warning);">B</div>
                <div class="category-text">Limited Free</div>
            </div>
            <div class="category">
                <div class="category-icon" style="background: var(--danger);">K</div>
                <div class="category-text">Hard Medicines</div>
            </div>
        </div>
        
        <div class="section-title">Medicine Inventory</div>
        
        <div class="products-grid">
            <?php foreach ($obats as $obat): ?>
            <div class="product-box">
                <img src="../img/<?= $obat['gambar'] ?>" alt="<?= $obat['merek'] ?>">
                <div class="product-name"><?= $obat['merek'] ?></div>
                <div class="product-price">Rp <?= number_format($obat['harga'], 0, ',', '.') ?></div>

                <div class="product-actions">
                    <button class="action-button" style="background: var(--success);" onclick="window.location.href='updateproduct.php?id=<?= $obat['id'] ?>'">
                        <i class="material-icons" style="font-size: 1rem;">edit</i>
                    </button>
                    <button class="action-button" style="background: var(--danger);" onclick="deleteProduct(<?= $obat['id'] ?>)">
                        <i class="material-icons" style="font-size: 1rem;">delete</i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="add-product-box" onclick="window.location.href='createproduk.php'">
                <i class="material-icons">add</i>
                <div class="text-sm mt-1">Add Medicine</div>
            </div>
        </div>
    </div>

    <nav class="bottom-nav">
        <a href="homeadmin.php" class="nav-item active">
            <i class="material-icons">home</i>
            <span>Home</span>
        </a>
        <a href="payment.php" class="nav-item">
            <i class="material-icons">payments</i>
            <span>Payments</span>
        </a>
        <a href="tabeladmin.php" class="nav-item">
            <i class="material-icons">assessment</i>
            <span>Reports</span>
        </a>
    </nav>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this medicine?")) {
                window.location.href = "deleteproduct.php?id=" + id;
            }
        }
        
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