<?php
session_start();
include '../connection.php';

// Get the user's ID
$user_id = $_SESSION['id'];

// Query to get all products
$getAllObat = mysqli_query($conn, "SELECT * FROM obat");

// Query to count the number of unprocessed items in the cart
$cartQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM keranjang_items ki
                                  JOIN keranjang k ON ki.keranjang_id = k.id
                                  WHERE k.user_id = $user_id
                                  AND NOT EXISTS (
                                      SELECT 1 FROM transaksi t WHERE t.keranjang_id = k.id
                                  )");

$cartCount = mysqli_fetch_assoc($cartQuery);
$cartItemCount = $cartCount['total'] ?? 0;

while ($row = mysqli_fetch_assoc($getAllObat)) {
   $obats[] = $row;
}

// Check if the search term is provided
if (isset($_POST['search'])) {
   // Get the search term from the input field
   $searchTerm = $_POST['searchTerm'];

   // Prevent SQL Injection (important)
   $searchTerm = $conn->real_escape_string($searchTerm);

   // SQL query to search in the 'name' field
   $sql = "SELECT * FROM obat WHERE merek LIKE '%$searchTerm%'";

   // Execute the query
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      // Output data of each row
      // reset var obat
      unset($obats);
      while ($row = $result->fetch_assoc()) {
         $obats[] = $row;
      }
   } else {
      echo "0 results found.";
   }
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

      .cart-notification {
         position: absolute;
         top: -5px;
         right: -5px;
         background-color: #f44336;
         /* Bright red */
         color: white;
         font-size: 12px;
         font-weight: bold;
         padding: 4px 8px;
         border-radius: 50%;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         transition: all 0.3s ease-in-out;
      }

      .cart-notification:hover {
         background-color: #d32f2f;
         /* Darker red on hover */
         transform: scale(1.1);
         /* Subtle zoom effect */
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

      /* .action-btn img {
         width: 20px;
         height: 20px;
      } */

      .action-btn:hover {
         background-color: #e0e0e0;
      }

      .container {
         width: 90%;
         max-width: 1200px;
         margin: 20px auto;
         text-align: center;
      }

      h1 {
         font-size: 36px;
         margin-bottom: 20px;
      }

      .search-bar {
         margin-bottom: 40px;
      }

      .search-bar input {
         width: 60%;
         padding: 10px;
         font-size: 16px;
         border: 1px solid #ddd;
         border-radius: 25px;
         outline: none;
      }

      .search-bar button {
         padding: 10px 20px;
         font-size: 16px;
         background-color: #333;
         color: white;
         border: none;
         cursor: pointer;
         margin-left: -50px;
         border-radius: 25px;
      }

      .categories {
         margin-top: 20px;
      }

      .category-list {
         display: flex;
         justify-content: space-around;
         flex-wrap: wrap;
         gap: 20px;
      }

      .category-item {
         display: flex;
         flex-direction: column;
         align-items: center;
         padding: 20px;
         background-color: #fff;
         border: 1px solid #ddd;
         border-radius: 10px;
         width: 120px;
         transition: transform 0.3s ease;
         box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }

      .category-item:hover {
         transform: scale(1.05);
         box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
      }

      .category-icon {
         width: 50px;
         height: 50px;
         margin-bottom: 10px;
      }

      .category-item span {
         font-size: 16px;
         color: #333;
         font-weight: 500;
      }
   </style>
</head>

<body>
   <!-- header  -->
   <!-- header -->
   <header class="user-header">
      <div class="user-info">
         <a href="./profilecustomer.php"><i class="bi bi-person-circle" style="font-size: 40px; margin-left:10px; margin-right:20px;"></i></a>
         <div class="user-text">
            <span class="user-name">User</span>
            <span class="user-role">Customer</span>
         </div>
      </div>
      <div class="user-actions">
         <button class="action-btn">
            <a href="./notifikasi.php"><i class="bi bi-bell"></i></a>
         </button>
         <button class="action-btn relative flex items-center">
            <a href="./keranjang.php" class="relative flex items-center">
               <i class="bi bi-cart text-2xl"></i>
               <?php if ($cartItemCount > 0): ?>
                  <div class="cart-notification absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md"><?= $cartItemCount ?></div>
               <?php endif; ?>
            </a>
         </button>
      </div>
   </header>


   <div class="container">
      <h1 class="text-3xl font-bold mb-4">CURE & CARE</h1>

      <form method="post">
         <div class="search-bar">
            <input type="text" placeholder="Search by product name" name="searchTerm" id="searchInput">
            <button type="submit" name="search">Search</button>
         </div>
      </form>

      <!-- Categories Section -->
      <div class="mb-6">
         <h2 class="text-2xl font-bold mb-4" style="margin-left: auto; margin-right:1120px;">
            Categories
         </h2>
         <div class="flex space-x-4">
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-2">
               <i class="fas fa-syringe text-pink-500">
               </i>
               <span>
                  Diabetes
               </span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-2">
               <i class="fas fa-dumbbell text-green-500">
               </i>
               <span>
                  Fitness
               </span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-2">
               <i class="fas fa-heartbeat text-gray-500">
               </i>
               <span>
                  Kolestrol
               </span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-2">
               <i class="fas fa-pills text-blue-500">
               </i>
               <span>
                  Antibiotik
               </span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center space-x-2">
               <i class="fas fa-brain text-brown-500">
               </i>
               <span>
                  Psikiatri
               </span>
            </div>
         </div>
      </div>
      <?php if (isset($obats)): ?>
         <div>
            <h2 class="text-2xl font-bold mb-4" style="margin-left: auto; margin-right:1060px;">
               Products
            </h2>
            <div class="flex space-x-5 overflow-x-auto">
               <?php foreach ($obats as $obat): ?>
                  <div class="bg-white p-4 rounded-lg shadow-md text-center min-w-[150px]">
                     <a href="detail.php?product=<?= $obat['id'] ?>" style="text-decoration: none; color: inherit;">
                        <img alt="Image of HOT IN CREAM product" class="mx-auto mb-2" height="100" src="../img/<?= $obat['gambar'] ?>" width="100" />
                        <div><?= $obat['merek'] ?></div>
                        <div class="text-gray-500">Rp. <?= $obat['harga'] ?></div>
                     </a>
                  </div>
               <?php endforeach; ?>

               <!-- Repeat similar structure for other products -->

            </div>
         </div>
      <?php else: ?>
         <p>Not found</p>
      <?php endif; ?>

      <!-- Bootstrap 5 JS and Popper.js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
      <script>
         document.querySelectorAll('.category-item').forEach(item => {
            item.addEventListener('click', function() {
               alert(`Category: ${this.querySelector('span').textContent}`);
            });
         });
      </script>
</body>

</html>