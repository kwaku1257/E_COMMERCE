<?php


require_once("../Classes/cart_class.php");


function add_to_cart_controller($c_id, $p_id, $qty) {
    $cart = new Cart();
    return $cart->add_to_cart($c_id, $p_id, $qty);
}

function get_cart_items_controller($c_id) {
    $cart = new Cart();
    return $cart->get_cart_items($c_id);
}


function update_quantity_controller($c_id, $p_id, $qty) {
    $cart = new Cart();
    return $cart->update_quantity($c_id, $p_id, $qty);
}

function remove_from_cart_controller($c_id, $p_id) {
    $cart = new Cart();
    return $cart->remove_from_cart($c_id, $p_id);
}


function get_cart_total_controller($c_id) {
    $cart = new Cart();
    return $cart->get_cart_total($c_id);
}

