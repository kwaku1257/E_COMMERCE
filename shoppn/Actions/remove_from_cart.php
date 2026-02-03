<?php
require_once '../Settings/core.php';
require_once '../Controllers/cart_controller.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php");
    exit();
}

if (!isset($_GET['product_id'])) {
    header("Location: ../View/cart.php?error=missing_product_id");
    exit();
}

$c_id = $_SESSION['user_id'];
$p_id = intval($_GET['product_id']);

$removed = remove_from_cart_controller($c_id, $p_id);

if ($removed) {
    header("Location: ../View/cart.php?success=removed");
} else {
    header("Location: ../View/cart.php?error=remove_failed");
}
exit();
