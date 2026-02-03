<?php
require_once '../Settings/core.php';
require_once '../Controllers/product_controller.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header("Location: ../Login/login.php");
    exit();
}


if (isset($_GET['delete'])) {
    $brand_id = intval($_GET['delete']);
    delete_brand_controller($brand_id);
    header("Location: brand.php");
    exit();
}


$editing = false;
$edit_id = null;
$edit_name = "";

if (isset($_GET['edit'])) {
    $editing = true;
    $edit_id = intval($_GET['edit']);
    $brand = get_brand_controller($edit_id);
    $edit_name = $brand['brand_name'] ?? '';
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_brand'])) {
    $id = intval($_POST['brand_id']);
    $name = trim($_POST['brand_name']);
    update_brand_controller($id, $name);
    header("Location: brand.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_brand'])) {
    $name = trim($_POST['brand_name']);
    add_brand_controller($name);
    header("Location: brand.php");
    exit();
}


$brands = get_all_brands_controller();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Brands</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/admin_brand.css">
</head>
<body>
<header class="navbar">
    <div class="logo">MOVICA</div>
    <nav>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Manage Products</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="orders.php">View Orders</a></li>
            <li><a href="customers.php">Customers</a></li>
        </ul>
    </nav>
</header>

<main class="brand-container">
    <section class="form-section">
        <h2><?= $editing ? 'Edit Brand' : 'Add Brand' ?></h2>
        <form method="POST" class="brand-form">
            <input type="hidden" name="brand_id" value="<?= $edit_id ?>">
            <input type="text" name="brand_name" id="brand_name" placeholder="Brand name" value="<?= $edit_name ?>" required>
            <input type="submit" name="<?= $editing ? 'update_brand' : 'add_brand' ?>" value="<?= $editing ? 'Update Brand' : 'Add Brand' ?>">
        </form>
    </section>

    <section class="brands-list">
        <h2>All Brands</h2>
        <div class="brand-grid">
            <?php foreach ($brands as $brand): ?>
                <div class="brand-card">
                    <p><?= htmlspecialchars($brand['brand_name']) ?></p>
                    <div class="brand-actions">
                        <a href="brand.php?edit=<?= $brand['brand_id'] ?>" class="edit-btn">Edit</a>
                        <a href="brand.php?delete=<?= $brand['brand_id'] ?>" onclick="return confirm('Are you sure you want to delete this brand?')" class="delete-btn">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

</body>
</html>
