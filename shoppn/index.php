<?php
require_once 'Settings/core.php';


if (is_admin()) {
  header("Location: Admin/dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MOVICA</title>
  <link rel="stylesheet" href="CSS/index.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>


<header class="navbar">
  <div class="logo">MOVICA</div>
  <nav>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>                       
      <li><a href="#">Categories</a></li>
      <li><a href="View/all_product.php">Products</a></li>
    </ul>
  </nav>

  
  <form action="View/all_product.php" method="GET" class="search-form">
    <input type="text" name="search" placeholder="Search products...">
    <button type="submit" class="icon"><i class="fas fa-search"></i></button>
  </form>

  <div class="nav-icons">
    
    <div class="dropdown">
      <a href="#" title="Account" class="icon"><i class="fas fa-user"></i></a>
      <div class="dropdown-content">
        <?php if (is_logged_in()): ?>
          <p><strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong></p>
          <p><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></p>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="Login/login.php">Login</a>
          <a href="Login/register.php">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>

    
    <?php if (!is_admin()): ?>
      <a href="View/cart.php" title="Cart" class="icon"><i class="fas fa-shopping-cart"></i></a>
    <?php endif; ?>
  </div>
</header>


<section class="hero">
  <div class="hero-content">
    <h1 class="hero-title">Explore our latest products</h1>
    <p class="hero-subtext">Enjoy shopping with MOVICA</p>
    <?php if (is_logged_in()): ?>
      <a href="View/all_product.php" class="shop-btn">Shop Now</a>
    <?php else: ?>
      <a href="Login/register.php" class="shop-btn">Shop Now</a>
    <?php endif; ?>
  </div>
  <div class="hero-image">
    <img src="Videos/movlogo.jpeg" alt="Model with Choggy Bag">
  </div>
</section>


<footer class="footer">
  <p>&copy; <?= date("Y") ?> Movica. All rights reserved.</p>
</footer>

</body>
</html>
