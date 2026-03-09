<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
    exit;
}
include "../includes/header.php";
?>

<div class="container">

    <h1>Welcome Vendor 👋</h1>
    <p class="subtitle">
        Manage your products, prices, and incoming orders.
    </p>

    <div class="card">
        <a class="btn" href="add_product.php">➕ Add Product</a>
        <a class="btn" href="update_price.php">💰 Update Daily Price</a>
        <a class="btn" href="view_orders.php">📦 View Orders</a>
    </div>

</div>

</body>
</html>