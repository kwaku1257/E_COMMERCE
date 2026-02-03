<?php
require_once '../Settings/core.php';
if (!is_admin()) {
  header("Location: ../index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - MOVICA</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="dashboard.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color:rgb(255, 255, 255);">

  <header class="navbar">
    <div class="logo">MOVICA</div>
    <nav>
      <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="brand.php">Brands</a></li>
        <li><a href="category.php">Categories</a></li>
        <li><a href="products.php">Products</a></li>
      </ul>
    </nav>
    <div class="nav-icons">
      <div class="dropdown">
        <a href="#" title="Account" class="icon"><i class="fas fa-user-shield"></i></a>
        <div class="dropdown-content">
          <p><strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></strong></p>
          <p><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></p>
          <a href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </header>

  <section class="hero admin-hero">
    <div class="hero-content">
      <h1 class="hero-title">Welcome back, Admin</h1>
      <p class="hero-subtext">Manage your shop, update products, view orders, and monitor customer activities.</p>
    </div>
    <div class="hero-image">
      <img src="../Videos/movlogo.jpeg" alt="Admin Dashboard Preview">
    </div>
  </section>


  <footer class="footer">
    <p>&copy; <?= date("Y") ?> Movica. Admin Panel.</p>
  </footer>

</body>
</html>
