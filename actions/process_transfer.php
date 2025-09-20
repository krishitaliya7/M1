<?php
// actions/process_transfer.php
require_once '../config/db.php';
require_once '../includes/auth.php';
session_start();
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromAccount = $_POST['from_account'];
    $toAccount   = $_POST['to_account'];
    $amount      = floatval($_POST['amount']);
    $userId      = $_SESSION['user_id'];

    // Basic validation
    if ($amount <= 0) {
        die("Invalid amount.");
    }

    // Check ownership & balance
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("SELECT id, balance FROM accounts WHERE id=? AND user_id=? FOR UPDATE");
    $stmt->execute([$fromAccount, $userId]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$account || $account['balance'] < $amount) {
        $pdo->rollBack();
        die("Insufficient funds or account not found.");
    }

    // Deduct from sender
    $stmt = $pdo->prepare("UPDATE accounts SET balance = balance - ? WHERE id=?");
    $stmt->execute([$amount, $fromAccount]);

    // Credit to recipient
    $stmt = $pdo->prepare("UPDATE accounts SET balance = balance + ? WHERE id=?");
    $stmt->execute([$amount, $toAccount]);

    // Insert transaction records (simplified)
    $stmt = $pdo->prepare("INSERT INTO transactions (account_id, date, description, amount, status) VALUES (?, NOW(), ?, ?, 'Completed')");
    $stmt->execute([$fromAccount, "Transfer to Account #$toAccount", -$amount]);
    $stmt->execute([$toAccount, "Transfer from Account #$fromAccount", $amount]);

    $pdo->commit();
    header("Location: ../public/dashboard.php?transfer=success");
    exit();
}
?>
