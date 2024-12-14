<?php
// Include dompdf library
require 'dompdf/autoload.inc.php'; // Gantilah path sesuai dengan lokasi dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Menginisialisasi dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

// Include database connection
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_pdf'])) {
    // Mengambil data produk dari database
    $products = $conn->query("SELECT * FROM products");

    // Membuat konten HTML untuk PDF
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            .product-table { width: 100%; border-collapse: collapse; }
            .product-table th, .product-table td { border: 1px solid #000; padding: 8px; }
            .product-table th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2>Lynette Café - Product List</h2>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>';

    // Menambahkan data produk ke tabel
    while ($product = $products->fetch_assoc()) {
        $html .= '
            <tr>
                <td>' . $product['name'] . '</td>
                <td>' . $product['description'] . '</td>
                <td>' . $product['price'] . '</td>
                <td>' . $product['stock'] . '</td>
            </tr>';
    }

    $html .= '
            </tbody>
        </table>
    </body>
    </html>';

    // Load konten HTML
    $dompdf->loadHtml($html);

    // Set ukuran kertas (A4 secara default)
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF (langkah pertama)
    $dompdf->render();

    // Menampilkan PDF (bisa diunduh atau ditampilkan)
    $dompdf->stream("product_list.pdf", array("Attachment" => 0)); // 0 untuk ditampilkan, 1 untuk diunduh
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynette Café Product</title>
    <link rel="stylesheet" href="css/product.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>Lynette Café</h2>
            </div>
            <ul class="menu">
                <li><a href="dashboard.php"><img src="Foto/Admin/dashboard.png" alt="Dashboard"> Dashboard</a></li>
                <li><a href="product.php"><img src="Foto/Admin/fast-food.png" alt="Product"> Product</a></li>
                <li><a href="transaction.php"><img src="Foto/Admin/clipboard.png" alt="Transaction"> Transaction</a></li>
                <li><a href="#"><img src="Foto/Admin/logout.png" alt="Log Out"> Log Out</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class="bx bx-menu sidebarBtn"></i>
                </div>
                <div class="profile-details">
                    <span class="admin_name">Admin</span>
                </div>
            </nav>

            <!-- Product List and Print PDF Button -->
            <div class="menu-section">
                <h3>Product List</h3>
                <!-- Tombol Print PDF -->
                <form method="POST">
                    <button type="submit" name="generate_pdf" class="btn-print">Print PDF</button>
                </form>

                <!-- Tabel Daftar Produk -->
                <div class="product-list">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th scope="col" style="width: 30%">Description</th>
                                <th scope="col" style="width: 15%">Price</th>
                                <th scope="col" style="width: 20%">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Ambil data produk
                                $products = $conn->query("SELECT * FROM products");
                                while ($product = $products->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['description'] ?></td>
                                    <td><?= $product['price'] ?></td>
                                    <td><?= $product['stock'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

</body>
</html>
