<?php
require_once '../Settings/core.php';
require_once '../Controllers/cart_controller.php';

session_start();


if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: ../View/cart.php?error=unauthorized");
    exit;
}

$customer_id = $_SESSION['user_id'];
$product_id = intval($_GET['id']);
$qty = 1; 


$success = add_to_cart_controller($customer_id, $product_id, $qty);

if ($success) {
    header("Location: ../View/cart.php?success=added");
} else {
    header("Location: ../View/cart.php?error=failed");
}
exit;
