<?php
session_start();
include 'koneksi.php';

$error = ''; // Initialize error message
$success = ''; // Initialize success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'admin'; // Default role for the registration

    // Check if email already exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $error = "Email is already registered.";
    } else {
        // Hash password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin into the database
        $insertQuery = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashedPassword', '$role')";
        if ($conn->query($insertQuery) === TRUE) {
            $success = "Admin registered successfully. You can now log in.";
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <div class="logo">
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
    <section class="login-section">
        <div class="login-container">
            <h2>Admin Registration</h2>
            
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <form action="admin_register.php" method="POST">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="button-container">
                    <button type="submit">Register</button>
                </div>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </section>
</body>
</html>
