<?php
session_start();
include 'koneksi.php';

$error = ''; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember-me']);

    // Sanitize input to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Check if the username or email exists in the database
    $query = "SELECT * FROM users WHERE email = '$username' OR name = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['username'] = $user['name'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Set cookies if "Remember me" is checked
            if ($rememberMe) {
                setcookie('username', $username, time() + (30 * 24 * 60 * 60), "/");
                setcookie('password', $password, time() + (30 * 24 * 60 * 60), "/");
            }

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username or email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lynette Café - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="Foto/logo.png" width="140px" height="50px" alt="Lynette Café Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Menu</a></li>
            <li><a href="#">Reserve</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="login.php" class="sign-in">Sign In</a></li>
        </ul>
    </header>

    <!-- Login Section -->
    <section class="login-section">
        <div class="login-container">
            <h2>Welcome Back to Lynette Café</h2>
            <!-- Display error if login fails -->
            <?php if (!empty($error)): ?>
                <p style="color: red; text-align: center;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username/Email</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username or email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <!-- Add "Remember Me" Checkbox -->
                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember Me</label>
                </div>
                <div class="button-container">
                    <button type="submit">Login</button>
                </div>
            </form>
            <p>Don’t have an account? <a href="register.php">Sign up</a></p>
        </div>
    </section>
</body>
</html>
