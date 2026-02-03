<?php


require_once '../Settings/core.php';
require_once '../Controllers/product_controller.php';

if (!is_admin()) {
    header("Location: ../Login/login.php");
    exit();
}


$brand_name = trim($_POST['brand_name'] ?? '');

if (empty($brand_name)) {
    $_SESSION['brand_error'] = "Brand name cannot be empty.";
    header("Location: ../Admin/brand.php");
    exit();
}

$result = add_brand_controller($brand_name);

if ($result) {
    $_SESSION['brand_success'] = "Brand added successfully.";
} else {
    $_SESSION['brand_error'] = "Failed to add brand. Please try again.";
}

header("Location: ../Admin/brand.php");
exit();
