<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || $_SESSION['role'] !== 'user') {
    header("Location: login.php"); // Arahkan ke login jika belum login atau bukan user
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to Lynette Café, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h1>
    <a href="logout.php">Log Out</a>
</body>
</html>
