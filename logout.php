<?php
session_start();
session_unset(); // Menghapus semua data dalam session
session_destroy(); // Menghancurkan session
header("Location: login.php"); // Arahkan kembali ke halaman login
exit;
?>