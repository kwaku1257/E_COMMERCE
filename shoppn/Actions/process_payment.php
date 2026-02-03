<?php

require_once '../Classes/cart_class.php';

session_start();
$c_id = $_SESSION['user_id'] ?? null;

if (!$c_id) {
    header("Location: ../Login/login.php");
    exit;
}
$cart = new Cart();

$invoice_no = 'INV' . strtoupper(uniqid());

$order_status = 'Success';

$order_date = date("Y-m-d H:i:s");
$order_id = $cart->insertOrder($c_id, $invoice_no, $order_date, $order_status);

if (!$order_id) {
    header("Location: ../View/payment_failed.php");
    exit;
}
$items = $cart->get_cart_items($c_id);
foreach ($items as $item) {
    $cart->insertOrderDetails($order_id, $item['p_id'], $item['qty']);
}

$amount = $cart->get_cart_total($c_id);
$currency = 'GHS';
$payment_date = date("Y-m-d H:i:s");
$cart->insertPayment($amount, $c_id, $order_id, $currency, $payment_date);


$cart->clearCart($c_id);

header("Location: ../View/payment_success.php?invoice=$invoice_no");
exit;
