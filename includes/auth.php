<?php
// includes/auth.php
session_start();

// Redirect to login page if not logged in
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /public/login.php');
        exit();
    }
}
?>
