<?php
// config/db.php
$host = 'localhost';
$db   = 'quantumbank';
$user = 'root';     // default XAMPP user
$pass = '';         // default XAMPP password empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
