<?php
require_once '../Settings/core.php';
require_once '../Controllers/cart_controller.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php");
    exit();
}

$c_id = $_SESSION['user_id'];
$cart_items = get_cart_items_controller($c_id);
$total = get_cart_total_controller($c_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart | MOVICA</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../CSS/cart.css">
</head>
<body>

<header class="navbar">
  <div class="logo">MOVICA</div>
  <nav>
    <ul class="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="all_product.php">Continue Shopping</a></li>
    </ul>
  </nav>
</header>

<section class="cart-section">
  <h2>Your Shopping Cart</h2>

  <?php if (empty($cart_items)): ?>
    <p class="empty-cart">Your cart is empty. <a href="all_product.php">Shop now</a>.</p>
  <?php else: ?>
    <table class="cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart_items as $item): ?>
          <tr>
            <td class="cart-product">
              <img src="../Images/Product/<?= htmlspecialchars($item['product_image']) ?>" alt="<?= htmlspecialchars($item['product_title']) ?>">
              <span><?= htmlspecialchars($item['product_title']) ?></span>
            </td>
            <td>GH₵<?= number_format($item['product_price'], 2) ?></td>
            <td>
              <form method="POST" action="../Actions/manage_quantity_cart.php">
                <input type="hidden" name="product_id" value="<?= $item['p_id'] ?>">
                <input type="number" name="quantity" value="<?= $item['qty'] ?>" min="1" class="qty-input">
                <button type="submit" class="update-btn">Update</button>
              </form>
            </td>
            <td>GH₵<?= number_format($item['product_price'] * $item['qty'], 2) ?></td>
            <td>
              <a href="../Actions/remove_from_cart.php?product_id=<?= $item['p_id'] ?>" class="remove-btn">Remove</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="cart-summary">
      <p><strong>Total:</strong> GH₵<?= number_format($total, 2) ?></p>
      <a href="payment.php" class="checkout-btn">Proceed to Checkout</a>
    </div>
  <?php endif; ?>
</section>

<footer class="footer">
  <p>&copy; <?= date("Y") ?> MOVICA. All rights reserved.</p>
</footer>

</body>
</html>