<?php
require_once '../Settings/core.php';
require_once '../Controllers/product_controller.php';
require_once '../Controllers/category_controller.php';

if (!isset($_GET['id'])) {
    echo "<h2>No product selected.</h2>";
    exit;
}

$product_id = $_GET['id'];
$product = get_one_product_controller($product_id);

if (!$product) {
    echo "<h2>Product not found.</h2>";
    exit;
}


$category = get_category_controller($product['product_cat']);
$brand = get_brand_controller($product['product_brand']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['product_title']) ?> | Movica</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/single_product.css">
</head>
<body>

<header class="navbar">
  <div class="logo">MOVICA</div>
  <nav>
    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="all_product.php">Products</a></li>
    </ul>
  </nav>
</header>

<section class="single-product-section">
  <div class="product-container">
    <div class="product-image">
      <img src="../Images/Product/<?= htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>">
    </div>
    <div class="product-details">
      <h2><?= htmlspecialchars($product['product_title']) ?></h2>
      <p><strong>Price:</strong> GH₵<?= number_format($product['product_price'], 2) ?></p>
      <p><strong>Category:</strong> <?= htmlspecialchars($category['cat_name']) ?></p>
      <p><strong>Brand:</strong> <?= htmlspecialchars($brand['brand_name']) ?></p>
      <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($product['product_desc'])) ?></p>
      <p><strong>Keywords:</strong> <?= htmlspecialchars($product['product_keywords']) ?></p>

      <a href="../Actions/add_to_cart.php?id=<?= $product['product_id'] ?>" class="add-cart-btn">Add to Cart</a>
      <br><br>
      <a href="all_product.php" class="back-link">← Back to All Products</a>
    </div>
  </div>
</section>

<footer class="footer">
  <p>&copy; <?= date("Y") ?> Movica. All rights reserved.</p>
</footer>

</body>
</html>
