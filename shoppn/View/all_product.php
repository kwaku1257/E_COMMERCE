<?php
require_once '../Settings/core.php';
require_once '../Controllers/product_controller.php';

$search_term = $_GET['search'] ?? null;
$products = $search_term ? search_products_controller($search_term) : get_all_products_controller();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../CSS/all_product.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<header class="navbar">
  <div class="logo">MOVICA</div>
  <nav>
    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="category.php">Categories</a></li>
      <li><a href="all_product.php">Products</a></li>
    </ul>
  </nav>

  <form action="all_product.php" method="GET" class="search-form">
    <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search_term ?? '') ?>">
    <button type="submit" class="icon"><i class="fas fa-search"></i></button>
  </form>

  <div class="nav-icons">
    <div class="dropdown">
      <a href="#" title="Account" class="icon"><i class="fas fa-user"></i></a>
      <div class="dropdown-content">
        <?php if (is_logged_in()): ?>
          <p><strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong></p>
          <p><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></p>
          <a href="../logout.php">Logout</a>
        <?php else: ?>
          <a href="../Login/login.php">Login</a>
          <a href="../Login/register.php">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!is_admin()): ?>
      <a href="cart.php" title="Cart" class="icon"><i class="fas fa-shopping-cart"></i></a>
    <?php endif; ?>
  </div>
</header>

<section class="product-section">
  <h2><?= $search_term ? "Results for '" . htmlspecialchars($search_term) . "'" : "All Products" ?></h2>
  <div class="product-grid">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <img src="../Images/Product/<?= htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>">
        <div class="product-info">
          <strong><?= htmlspecialchars($product['product_title']) ?></strong>
          <p class="price">₵<?= number_format($product['product_price'], 2) ?></p>
          <small><?= htmlspecialchars($product['product_desc']) ?></small>
        </div>
        <div class="product-actions">
  <a href="single_product.php?id=<?= $product['product_id'] ?>" class="view-btn">View</a>
</div>

      </div>
    <?php endforeach; ?>
  </div>
</section>

<footer class="footer">
  <p>&copy; <?= date("Y") ?> MOVICA. All rights reserved.</p>
</footer>

</body>
</html>
