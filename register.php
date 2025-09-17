<?php
session_start();
require "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];
    $dob      = $_POST['dob'];
    $account  = $_POST['accountType'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, address, phone, dob, account_type) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullName, $email, $password, $address, $phone, $dob, $account);

    if ($stmt->execute()) {
        $_SESSION['user'] = $fullName;
        header("Location: dashboard.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
