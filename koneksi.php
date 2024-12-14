?>
<?php
// Koneksi ke database MySQL
$servername = "localhost";  // atau alamat server MySQL Anda
$username = "root";         // username database
$password = "";             // password database
$dbname = "reservasi_cafe"; // nama database yang benar

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

