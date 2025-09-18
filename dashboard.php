<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config/database.php";

// Fetch user and account data from the database
// ...

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - QuantumBank</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'templates/includes/header.php'; ?>

    <div class="dashboard-content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
        
        </div>

    <?php include 'templates/includes/footer.php'; ?>
</body>
</html>