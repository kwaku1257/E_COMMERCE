<?php
require_once '../Settings/core.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Successful – Movica</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../CSS/payment_success.css">
</head>
<body>

  <nav class="navbar">
    <div class="logo">MOVICA</div>
    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="../View/all_product.php">Shop</a></li>
      <li><a href="../View/cart.php">Cart</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </nav>


  <div class="success-container">
    <h1>Payment Successful!</h1>
    <p>Thank you for your order. Your payment has been received.</p>
    <a href="../index.php" class="home-link">Return to Home</a>
  </div>
</body>
</html>
