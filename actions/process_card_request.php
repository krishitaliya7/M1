<?php
// actions/process_card_request.php
require_once '../config/db.php';
require_once '../includes/auth.php';
session_start();
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardType = trim($_POST['card_type']);
    $address  = trim($_POST['delivery_address']);
    $userId   = $_SESSION['user_id'];

    if (empty($cardType) || empty($address)) {
        die("Card type and address are required.");
    }

    // Insert card request
    $stmt = $pdo->prepare("INSERT INTO cards (user_id, card_type, last_four, expiry, status, address) VALUES (?, ?, ?, ?, ?, ?)");
    // We’ll assign dummy last_four and expiry for now:
    $lastFour = rand(1000, 9999);
    $expiry = date('m/y', strtotime('+3 years'));
    $status = 'Pending';
    $stmt->execute([$userId, $cardType, $lastFour, $expiry, $status, $address]);

    header("Location: ../public/cards.php?request=success");
    exit();
}
?>
