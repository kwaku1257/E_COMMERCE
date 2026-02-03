<?php
require_once '../Controllers/product_controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['product_title']);
    $description = trim($_POST['product_desc']);
    $price = floatval($_POST['product_price']);
    $brand = trim($_POST['product_brand']);
    $category = trim($_POST['product_cat']);
    $keywords = trim($_POST['product_keywords']);

    $image = '';
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $img_tmp = $_FILES['product_image']['tmp_name'];
        $img_name = basename($_FILES['product_image']['name']);
        $target_path = "../Images/Product/" . $img_name;

        if (move_uploaded_file($img_tmp, $target_path)) {
            $image = $img_name;
        }
    }


    if (!empty($title) && !empty($description) && $price > 0 && !empty($brand) && !empty($category)) {
        $result = add_product_controller($title, $description, $price, $image, $brand, $category, $keywords);

        if ($result) {
            header("Location: ../Admin/products.php?msg=success");
            exit();
        } else {
            header("Location: ../Admin/products.php?msg=fail");
            exit();
        }
    } else {
        header("Location: ../Admin/products.php?msg=incomplete");
        exit();
    }
} else {
    header("Location: ../Admin/products.php");
    exit();
}
