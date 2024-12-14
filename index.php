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
    <title>2318085</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div>
                <img src="Foto/logo.png" width="140px" height="50px">
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Reserve</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php" class="sign-in">Sign In</a></li>
            </ul>
        </div>
    </header>

    <div class="section"> 
        <section class="welcome-section">
            <h1 class="welcome-text" id="welcome-text">Welcome to Lynette Café</h1>
            <p class="welcome-description" id="welcome-description">
                Kami menawarkan berbagai kopi yang baru diseduh dan kue-kue buatan sendiri. Datang dan nikmati suasana nyaman dengan Wi-Fi gratis.
            </p>
            <button onclick="changeContent()">Click Me for More Info</button>
        </section>
    </div>
    <div id="snackbar">This is a snackbar message!</div>
    <div class="background">
        <img id="background-img" src="Foto/background.png" width="100%">
    </div>
   

    <script src="js/index.js"></script>
    
</body>
</html>
