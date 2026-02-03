<?php
require_once("../Classes/product_class.php");

// brand
function add_brand_controller($brand_name) {
    $product = new Product();
    return $product->add_brand($brand_name);
}

function get_all_brands_controller() {
    $product = new Product();
    return $product->get_all_brands();
}

function get_brand_controller($brand_id) {
    $product = new Product();
    return $product->get_brand($brand_id);
}

function update_brand_controller($brand_id, $brand_name) {
    $product = new Product();
    return $product->update_brand($brand_id, $brand_name);
}

function delete_brand_controller($brand_id) {
    $product = new Product();
    return $product->delete_brand($brand_id);
}

// product
function add_product_controller($title, $description, $price, $image, $brand_name, $cat_name, $keywords) {
    $product = new Product();
    return $product->add_product($title, $description, $price, $image, $brand_name, $cat_name, $keywords);
}

function get_all_products_controller() {
    $product = new Product();
    return $product->get_all_products();
}

function get_product_controller($id) {
    $product = new Product();
    return $product->get_product($id);
}


function get_one_product_controller($product_id) {
    $product = new Product();
    return $product->get_product($product_id);
}

function update_product_controller($id, $title, $description, $price, $image, $brand_name, $cat_name, $keywords) {
    $product = new Product();
    return $product->update_product($id, $title, $description, $price, $image, $brand_name, $cat_name, $keywords);
}

function delete_product_controller($id) {
    $product = new Product();
    return $product->delete_product($id);
}

function get_products_by_brand_controller($brand_name) {
    $product = new Product();
    return $product->get_products_by_brand($brand_name);
}

function get_products_by_category_controller($cat_name) {
    $product = new Product();
    return $product->get_products_by_category($cat_name);
}

function search_products_controller($term) {
    $product_instance = new Product();
    return $product_instance->search_product($term);
}
?>
