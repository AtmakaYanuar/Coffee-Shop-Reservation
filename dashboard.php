<?php
session_start(); // Memulai session

// Proteksi: Cek apakah pengguna sudah login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynette Café Orders</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h2>Lynette Café</h2>
            </div>
            <ul class="menu">
                <li><a href="dashboard.php"><img src="Foto/Admin/dashboard.png" alt="Dashboard"> Dashboard</a></li>
                <li><a href="product.php"><img src="Foto/Admin/fast-food.png" alt="Product"> Product</a></li>
                <li><a href="transaction.php"><img src="Foto/Admin/clipboard.png" alt="Transaction"> Transaction</a></li>
                <li><a href="logout.php"><img src="Foto/Admin/logout.png" alt="Log Out"> Log Out</a></li>
            </ul>
        </div>

        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class="bx bx-menu sidebarBtn"></i>
                </div>
                <div class="profile-details">
                    <span class="admin_name">Admin</span>
                </div>
            </nav>
            <div class="name">
                <span class="menu-title">Selamat Datang</span>
            </div>
        </section>
    </div>
</body>
</html>
