<?php
// Include database connection
include 'koneksi.php';

// Inisialisasi error
$error = "";

// Tambah Transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];

    if (empty($name) || empty($product) || empty($price) || empty($payment)) {
        $error = "Semua kolom harus diisi!";
    } else {
        $stmt = $conn->prepare("INSERT INTO transaction (name, product, price, payment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $product, $price, $payment);

        if (!$stmt->execute()) {
            $error = "Gagal menambahkan transaksi.";
        }
    }
}

// Hapus Transaksi
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM transaction WHERE id = $id");
    header("Location: transaction.php");
    exit();
}

// Edit Transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];

    $stmt = $conn->prepare("UPDATE transaction SET name = ?, product = ?, price = ?, payment = ? WHERE id = ?");
    $stmt->bind_param("ssdsd", $name, $product, $price, $payment, $id);

    if (!$stmt->execute()) {
        $error = "Gagal memperbarui transaksi.";
    } else {
        header("Location: transaction.php");
        exit();
    }
}

// Ambil semua data transaksi
$transactions = $conn->query("SELECT * FROM transaction");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynette Café Transaction</title>
    <link rel="stylesheet" href="css/transaction.css">
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
                <li><a href="transaction.php" class="active"><img src="Foto/Admin/clipboard.png" alt="Transaction"> Transaction</a></li>
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

            <!-- Transaction Section -->
            <div class="menu-section">
                <h3>Transaction List</h3>

                <!-- Error Notification -->
                <?php if (!empty($error)): ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>

                <!-- Form Tambah Transaksi -->
                <div class="add-product-form">
                    <h4>Tambah Transaksi Baru</h4>
                    <form method="POST" action="">
                        <input type="hidden" name="add" value="1">
                        <div class="form-group">
                            <label for="name">Nama Customer</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="product">Produk</label>
                            <input type="text" id="product" name="product" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="payment">Pembayaran</label>
                            <input type="number" id="payment" name="payment" required>
                        </div>
                        <button type="submit" class="btn-submit">Simpan</button>
                    </form>
                </div>

                <!-- Tabel Daftar Transaksi -->
                <div class="product-list">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Pembayaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($transaction = $transactions->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($transaction['name']) ?></td>
                                    <td><?= htmlspecialchars($transaction['product']) ?></td>
                                    <td><?= htmlspecialchars($transaction['price']) ?></td>
                                    <td><?= htmlspecialchars($transaction['payment']) ?></td>
                                    <td>
                                        <a href="#" onclick="editTransaction(<?= $transaction['id'] ?>, '<?= $transaction['name'] ?>', '<?= $transaction['product'] ?>', <?= $transaction['price'] ?>, <?= $transaction['payment'] ?>)">Edit</a> |
                                        <a href="transaction.php?delete=<?= $transaction['id'] ?>" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Form Edit Transaksi -->
                <div id="edit-form" style="display:none;" class="add-product-form">
                    <h4>Edit Transaksi</h4>
                    <form method="POST" action="">
                        <input type="hidden" name="update" value="1">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Nama Customer</label>
                            <input type="text" id="edit-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-product">Produk</label>
                            <input type="text" id="edit-product" name="product" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-price">Harga</label>
                            <input type="number" id="edit-price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-payment">Pembayaran</label>
                            <input type="number" id="edit-payment" name="payment" required>
                        </div>
                        <button type="submit" class="btn-submit">Update</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        function editTransaction(id, name, product, price, payment) {
            document.getElementById('edit-form').style.display = 'block';
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-product').value = product;
            document.getElementById('edit-price').value = price;
            document.getElementById('edit-payment').value = payment;
        }
    </script>
</body>
</html>
