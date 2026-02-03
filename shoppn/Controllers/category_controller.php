<?php
require_once("../Classes/category_class.php");


function add_category_controller($cat_name) {
    $cat = new Category();
    return $cat->add_category($cat_name);
}

function get_all_categories_controller() {
    $cat = new Category();
    return $cat->get_all_categories();
}
function get_category_controller($cat_id) {
    $cat = new Category();
    return $cat->get_category($cat_id);
}


function update_category_controller($cat_id, $cat_name) {
    $cat = new Category();
    return $cat->update_category($cat_id, $cat_name);
}

function delete_category_controller($cat_id) {
    $cat = new Category();
    return $cat->delete_category($cat_id);
}
?>
