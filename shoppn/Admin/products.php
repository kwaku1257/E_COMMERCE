<?php
require_once '../Settings/core.php';
require_once '../Controllers/product_controller.php';
require_once '../Controllers/category_controller.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header("Location: ../Login/login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $desc = $_POST['product_desc'];
    $keywords = $_POST['product_keywords'];
    $brand_id = $_POST['product_brand'];
    $cat_id = $_POST['product_cat'];
    $image_name = $_FILES['product_image']['name'] ?? '';
    $tmp_image = $_FILES['product_image']['tmp_name'] ?? '';
    $target = "../Images/Product/" . basename($image_name);

    if (!$image_name && isset($_POST['existing_image'])) {
        $image_name = $_POST['existing_image'];
    } elseif ($image_name) {
        move_uploaded_file($tmp_image, $target);
    }

    if ($product_id) {
        update_product_controller($product_id, $title, $desc, $price, $image_name, $brand_id, $cat_id, $keywords);
    } else {
        add_product_controller($title, $desc, $price, $image_name, $brand_id, $cat_id, $keywords);
    }

    header("Location: products.php");
    exit();
}


if (isset($_GET['delete'])) {
    delete_product_controller($_GET['delete']);
    header("Location: products.php");
    exit();
}


$edit_mode = false;
$edit_product = null;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_product = get_product_controller($_GET['edit']);
}


$categories = get_all_categories_controller();
$brands = get_all_brands_controller();
$products = get_all_products_controller();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../CSS/admin_product.css">
</head>
<body>

<header class="navbar">
    <div class="logo">MOVICA</div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="brand.php">Brands</a></li>
        <li><a href="category.php">Categories</a></li>
        <li><a href="products.php" class="active">Products</a></li>
    </ul>
</header>

<div class="product-container">
    <div class="form-section">
        <h2><?= $edit_mode ? 'Edit Product' : 'Add Product' ?></h2>
        <form method="POST" action="products.php" enctype="multipart/form-data" class="product-form">
            <?php if ($edit_mode): ?>
                <input type="hidden" name="product_id" value="<?= $edit_product['product_id'] ?>">
                <input type="hidden" name="existing_image" value="<?= $edit_product['product_image'] ?>">
            <?php endif; ?>

            <input type="text" name="product_title" placeholder="Title" required value="<?= $edit_mode ? htmlspecialchars($edit_product['product_title']) : '' ?>">
            <input type="number" step="0.01" name="product_price" placeholder="Price" required value="<?= $edit_mode ? htmlspecialchars($edit_product['product_price']) : '' ?>">
            <textarea name="product_desc" placeholder="Description" required><?= $edit_mode ? htmlspecialchars($edit_product['product_desc']) : '' ?></textarea>
            <input type="text" name="product_keywords" placeholder="Keywords" required value="<?= $edit_mode ? htmlspecialchars($edit_product['product_keywords']) : '' ?>">

            <select name="product_cat" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['cat_id'] ?>" <?= $edit_mode && $edit_product['product_cat'] == $cat['cat_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['cat_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="product_brand" required>
                <option value="">Select Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand['brand_id'] ?>" <?= $edit_mode && $edit_product['product_brand'] == $brand['brand_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($brand['brand_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="file" name="product_image" <?= $edit_mode ? '' : 'required' ?>>
            <input type="submit" value="<?= $edit_mode ? 'Update Product' : 'Add Product' ?>">
        </form>
    </div>

    <div class="products-grid">
        <h2>All Products</h2>
        <div class="grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="../Images/Product/<?= htmlspecialchars($product['product_image']) ?>" alt="Product Image">
                    <div class="details">
                        <strong><?= htmlspecialchars($product['product_title']) ?></strong>
                        <p>₵<?= number_format($product['product_price'], 2) ?></p>
                        <small><?= htmlspecialchars($product['product_desc']) ?></small>
                    </div>
                    <div class="product-actions">
                        <a href="products.php?edit=<?= $product['product_id'] ?>" class="edit-btn">Edit</a>
                        <a href="products.php?delete=<?= $product['product_id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>
