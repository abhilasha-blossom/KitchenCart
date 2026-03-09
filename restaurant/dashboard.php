<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'restaurant') {
    header("Location: ../auth/login.php");
    exit;
}
include "../includes/header.php";
?>

<div class="container">

    <h1>Good morning!</h1>
    <p class="subtitle">
        Compare prices and place your daily raw material orders.
    </p>

    <div class="card">
        <h3>Quick Actions</h3>
        <a class="btn" href="view_prices.php">📊 View & Compare Prices</a>
    </div>

</div>

</body>
</html>