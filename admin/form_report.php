<!DOCTYPE html>
<html lang="en">

<head>
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
            background: linear-gradient(to right, #f5f5dc, #f5deb3);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen relative">
    
    <div class="w-full max-w-5xl bg-[#f5f5dc] p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-4 text-[#7a6e5d]">Laporan Obat</h2>
        <form method="post" class="grid grid-cols-3 gap-6">
            <div>
                <label class="block text-[#7a6e5d] mb-2">Tanggal</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="tanggal" placeholder="Tanggal" />
                    <i class="fas fa-calendar-alt text-[#7a6e5d]"></i>
                </div>
            </div>
            <div>
                <label class="block text-[#7a6e5d] mb-2">Nama Obat</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="nama" placeholder="Nama Obat" />
                    <i class="fas fa-pills text-[#7a6e5d]"></i>
                </div>
            </div>
            <div>
                <label class="block text-[#7a6e5d] mb-2">Kategori</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="kategori" placeholder="Kategori" />
                    <i class="fas fa-tags text-[#7a6e5d]"></i>
                </div>
            </div>
            <div>
                <label class="block text-[#7a6e5d] mb-2">Jumlah Terjual</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" name="jumlah" placeholder="Jumlah Terjual" />
                    <i class="fas fa-box text-[#7a6e5d]"></i>
                </div>
            </div>
            <div>
                <label class="block text-[#7a6e5d] mb-2">Harga Satuan</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" name="harga" placeholder="Harga Satuan" />
                    <i class="fas fa-dollar-sign text-[#7a6e5d]"></i>
                </div>
            </div>
            <div>
                <label class="block text-[#7a6e5d] mb-2">Total Penjualan</label>
                <div class="flex items-center border-b border-[#7a6e5d] py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-[#7a6e5d] mr-3 py-1 px-2 leading-tight focus:outline-none" type="number" name="total" placeholder="Total Penjualan" />
                    <i class="fas fa-calculator text-[#7a6e5d]"></i>
                </div>
            </div>
            <div class="col-span-3">
                <button class="bg-gradient-to-r from-[#f5deb3] to-[#d2b48c] text-white font-bold py-3 px-6 rounded-full w-full text-lg" type="submit" name="proses">Klick</button>
            </div>
        </form>
        <!-- Back Button -->
    <div class="flex items-center mb-8">
    <a href="tabeladmin.php" class="absolute top-4 left-4 text-[#7a6e5d] hover:underline">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    </div>
    </div>
</body>

</html>


<?php
include"../connection.php";

if(isset($_POST ['proses'])){
    $result = $conn->query("SELECT * from report WHERE Tanggal='$_POST[tanggal]' ");

    if($result->num_rows > 0){
        echo'<script>alert("data sudah tersedia"); window.location.href="tabeladmin.php"</script>';
    }

    
   $sql_c= "insert into report set
   Tanggal= '$_POST[tanggal]',
   Nama_Obat= '$_POST[nama]',
   Kategori= '$_POST[kategori]',
   Jumlah_Terjual= '$_POST[jumlah]',
   Harga_Satuan= '$_POST[harga]',
   Total_Penjualan= '$_POST[total]'";

   
   $result= $conn->query($sql_c);
   if($result){
       echo'<script>alert("behasil update"); window.location.href="tabeladmin.php"</script>';
   } else {
       echo'<script>alert("data sudah tersedia"); window.location.href="tabeladmin.php"</script>';
   }
}
?>