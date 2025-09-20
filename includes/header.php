<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuantumBank</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

<header class="bg-indigo-700 text-white p-6">
  <div class="container mx-auto flex justify-between">
    <h1 class="text-2xl font-bold">QuantumBank</h1>
    <nav>
      <a href="/public/index.php" class="px-3">Home</a>
      <a href="/public/dashboard.php" class="px-3">Dashboard</a>
      <a href="/public/cards.php" class="px-3">Cards</a>
      <a href="/public/atm-locator.php" class="px-3">ATM Locator</a>
      <a href="/public/about.php" class="px-3">About</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/public/logout.php" class="px-3">Logout</a>
      <?php else: ?>
        <a href="/public/login.php" class="px-3">Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main class="container mx-auto px-4 py-8">
