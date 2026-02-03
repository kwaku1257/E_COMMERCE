<?php
require_once '../Settings/core.php';
require_once '../Controllers/category_controller.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header("Location: ../Login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cat_name = trim($_POST['cat_name'] ?? '');
    $cat_id = $_POST['category_id'] ?? null;

    if (!empty($cat_name)) {
        if ($cat_id) {
            update_category_controller($cat_id, $cat_name);
        } else {
            add_category_controller($cat_name);
        }
    }

    header("Location: category.php");
    exit();
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    delete_category_controller($delete_id);
    header("Location: category.php");
    exit();
}

$categories = get_all_categories_controller();

$edit_mode = false;
$edit_id = null;
$edit_name = "";
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $category = get_category_controller($edit_id);
    if ($category) {
        $edit_mode = true;
        $edit_name = $category['cat_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories - Choggy Bags</title>
    <link rel="stylesheet" href="../CSS/index.css">  
    <link rel="stylesheet" href="../CSS/admin_category.css">
</head>
<body>

<header class="navbar">
    <div class="logo">CHOGGY BAGS</div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="brand.php">Brands</a></li>
        <li><a href="category.php" class="active">Categories</a></li>
        <li><a href="products.php">Products</a></li>
    </ul>
</header>

<div class="container">
    <h2><?= $edit_mode ? 'Edit Category' : 'Add New Category' ?></h2>

    <form method="POST" action="category.php">
        <input type="text" name="cat_name" placeholder="Category name (e.g., Purse)" value="<?= htmlspecialchars($edit_name) ?>" required>
        <?php if ($edit_mode): ?>
            <input type="hidden" name="category_id" value="<?= $edit_id ?>">
        <?php endif; ?>
        <input type="submit" value="<?= $edit_mode ? 'Update Category' : 'Add Category' ?>">
    </form>

    <div class="table-container">
        <h3>Existing Categories</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $index => $cat): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($cat['cat_name']) ?></td>
                            <td class="actions">
                                <a href="category.php?edit=<?= $cat['cat_id'] ?>">Edit</a>
                                <a href="category.php?delete=<?= $cat['cat_id'] ?>" onclick="return confirm('Delete this category?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">No categories available.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
