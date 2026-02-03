<?php
require_once '../Settings/core.php';
require_once '../Controllers/cart_controller.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php");
    exit();
}


if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    header("Location: ../View/cart.php?error=missing_parameters");
    exit();
}

$c_id = $_SESSION['user_id'];
$p_id = intval($_POST['product_id']);
$qty  = intval($_POST['quantity']);


if ($qty < 1) {
    $qty = 1;
}

$updated = update_quantity_controller($c_id, $p_id, $qty);


if ($updated) {
    header("Location: ../View/cart.php?success=quantity_updated");
} else {
    header("Location: ../View/cart.php?error=update_failed");
}
exit();
