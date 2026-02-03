<?php
require_once '../Settings/core.php';
require_once '../Classes/cart_class.php';

$c_id = $_SESSION['user_id'] ?? null;

if (!$c_id) {
    header("Location: ../Login/login.php");
    exit;
}

$cart = new Cart();
$cart_total = $cart->get_cart_total($c_id);
$amount_kobo = $cart_total * 100;

$paystack_public_key = "pk_live_d15bf78c7419d31afce917b76cfde5e3bacde951";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment – MOVICA</title>
  <link rel="stylesheet" href="../CSS/index.css">
  <link rel="stylesheet" href="../CSS/payment.css">
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

<section class="payment-section">
  <div class="payment-container">
    <h2>Checkout & Payment</h2>
    <p class="total"><strong>Total Amount:</strong> GHS <?= number_format($cart_total, 2) ?></p>

    <form id="paymentForm">
      <input type="hidden" id="amount" value="<?= $amount_kobo ?>">
      <input type="hidden" id="email" value="<?= htmlspecialchars($_SESSION['user_email'] ?? 'example@gmail.com') ?>">
      <input type="hidden" id="customer_id" value="<?= $c_id ?>">

      <button type="submit" onclick="payWithPaystack()" class="pay-btn">Pay Now</button>
    </form>
  </div>
</section>

<footer class="footer">
  <p>&copy; <?= date("Y") ?> Movica. All rights reserved.</p>
</footer>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  function payWithPaystack() {
    event.preventDefault();
    let handler = PaystackPop.setup({
      key: '<?= $paystack_public_key ?>',
      email: document.getElementById("email").value,
      amount: document.getElementById("amount").value,
      currency: "GHS",
      callback: function(response) {
        window.location.href = "../Actions/process_payment.php?reference=" + response.reference;
      },
      onClose: function() {
        alert("Payment window closed.");
      }
    });
    handler.openIframe();
  }
</script>
</body>
</html>
