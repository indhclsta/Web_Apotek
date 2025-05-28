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
    <!-- Sertakan Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
   <script src="https://cdn.tailwindcss.com"></script>
   <!-- Bootstrap 5 CSS CDN -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- icon bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../css/style.css">
    <style>
        :root {
            --primary: #3a7bd5;
            --primary-light: #5a9bf8;
            --secondary: #00d2ff;
            --accent: #ff7e5f;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f7ff;
            color: var(--dark);
        }

        .container {
            padding: 20px;
            min-height: calc(100vh - 80px);
            padding-bottom: 100px;
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
        }

        .icons-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon-button {
            background-color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            border: none;
        }

        .icon-button:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .icon-button:hover span {
            color: white;
        }

        .icon-button span {
            font-size: 20px;
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-icon {
            font-size: 36px;
            color: var(--primary);
        }

        .user-text {
            display: flex;
            flex-direction: column;
        }

        .user-text .user {
            color: var(--primary);
            font-weight: 600;
            font-size: 14px;
        }

        .user-text .admin {
            color: var(--dark);
            font-weight: 500;
            font-size: 16px;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin: 30px 0;
            color: var(--primary);
            font-weight: 700;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 25px 0;
        }

        .search-box {
            width: 50%;
            height: 55px;
            padding: 10px 20px;
            font-size: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 30px;
            outline: none;
            display: flex;
            align-items: center;
            position: relative;
            background-color: white;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.2);
        }

        .search-box input {
            border: none;
            width: 100%;
            outline: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .search-icon {
            right: 15px;
            font-size: 24px;
            color: var(--primary);
        }

        .section-title {
            font-size: 1.5rem;
            margin: 30px 0 15px;
            font-weight: 600;
            color: var(--primary);
            position: relative;
            padding-left: 15px;
        }

        .section-title:before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            height: 70%;
            width: 5px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 5px;
        }

        .categories {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .category {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 15px;
            min-width: 180px;
            height: 70px;
            box-shadow: var(--card-shadow);
            padding: 0 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .category-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            color: white;
            font-weight: 600;
            font-size: 20px;
        }

        .category:nth-child(1) .category-icon {
            background: linear-gradient(135deg, var(--success), #86efac);
        }

        .category:nth-child(2) .category-icon {
            background: linear-gradient(135deg, var(--warning), #fcd34d);
        }

        .category:nth-child(3) .category-icon {
            background: linear-gradient(135deg, var(--danger), #fca5a5);
        }

        .category-text {
            font-size: 1rem;
            color: var(--dark);
            font-weight: 500;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-box {
            position: relative;
            background-color: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 15px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .product-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .product-box img {
            width: 100%;
            height: 120px;
            object-fit: contain;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .product-name {
            font-size: 0.95rem;
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 600;
        }

        .product-actions {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border-radius: 20px;
            padding: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-box:hover .product-actions {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .action-button {
            background: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: white;
        }

        .action-button span {
            font-size: 16px;
        }

        .update-button {
            background: var(--success);
        }

        .delete-button {
            background: var(--danger);
        }

        .action-button:hover {
            transform: scale(1.1);
        }

        .add-product-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 15px;
            text-align: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .add-product-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .add-product-box .material-icons {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .add-product-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 12px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #64748b;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            padding: 5px 15px;
            border-radius: 10px;
        }

        .nav-item.active, .nav-item:hover {
            color: var(--primary);
            background: rgba(58, 123, 213, 0.1);
        }

        .nav-item .material-icons {
            font-size: 24px;
            margin-bottom: 3px;
        }

        .nav-item.active .material-icons {
            font-weight: bold;
        }

        /* Success notification */
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <div class="user-info">
                <a href="profileadmin.php">
                    <i class="bi bi-person-circle user-icon"></i>
                </a>
                <div class="user-text">
                    <span class="user">Hello, Admin</span>
                    <span class="admin">Apotek Dashboard</span>
                </div>
            </div>
            <div class="icons-left">
                <button class="icon-button">
                    <a href="notifadmin.php">
                        <span class="material-icons">notifications</span>
                    </a>
                </button>
                <button class="icon-button">
                    <a href="pickup.php">
                        <span class="material-icons">local_shipping</span>
                    </a>
                </button>
            </div>
        </header>

        <h1>Pharmacy Management</h1>

        <div class="search-container">
            <div class="search-box">
                <input type="text" placeholder="Search medicines...">
                <span class="material-icons search-icon">search</span>
            </div>
        </div>

        <div class="section-title">Medicine Categories</div>

        <div class="categories">
            <div class="category">
                <div class="category-icon">U</div>
                <div class="category-text">General Medicines</div>
            </div>
            <div class="category">
                <div class="category-icon">B</div>
                <div class="category-text">Limited Free</div>
            </div>
            <div class="category">
                <div class="category-icon">K</div>
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
                    <button class="action-button update-button" onclick="window.location.href='updateproduct.php?id=<?= $obat['id'] ?>'">
                        <span class="material-icons">edit</span>
                    </button>
                    <button class="action-button delete-button" onclick="deleteProduct(<?= $obat['id'] ?>)">
                        <span class="material-icons">delete</span>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="add-product-box" onclick="window.location.href='createproduk.php'">
                <span class="material-icons">add</span>
                <div class="add-product-text">Add Medicine</div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="homeadmin.php" class="nav-item active">
            <span class="material-icons">home</span>
            <span>Home</span>
        </a>
        <a href="payment.php" class="nav-item">
            <span class="material-icons">payments</span>
            <span>Payments</span>
        </a>
        <a href="tabeladmin.php" class="nav-item">
            <span class="material-icons">assessment</span>
            <span>Reports</span>
        </a>
    </nav>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this medicine?")) {
                window.location.href = "deleteproduct.php?id=" + id;
            }
        }
        
        // Add active class to current page in bottom nav
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