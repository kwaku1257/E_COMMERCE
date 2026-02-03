<?php
require_once '../Settings/db_class.php';

class Product extends Database {

    // Brand
    public function add_brand($brand_name) {
        $query = "INSERT INTO brands (brand_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $brand_name);
        return $stmt->execute();
    }

    public function get_all_brands() {
        $query = "SELECT * FROM brands ORDER BY brand_id DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_brand($brand_id) {
        $query = "SELECT * FROM brands WHERE brand_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $brand_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update_brand($brand_id, $brand_name) {
        $query = "UPDATE brands SET brand_name = ? WHERE brand_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $brand_name, $brand_id);
        return $stmt->execute();
    }

    public function delete_brand($brand_id) {
        $query = "DELETE FROM brands WHERE brand_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $brand_id);
        return $stmt->execute();
    }

   // Product
public function add_product($title, $description, $price, $image, $brand, $category, $keywords) {
    $query = "INSERT INTO products (product_title, product_desc, product_price, product_image, product_brand, product_cat, product_keywords) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssdssss", $title, $description, $price, $image, $brand, $category, $keywords);
    return $stmt->execute();
}

public function get_all_products() {
    $query = "SELECT * FROM products ORDER BY product_id DESC";
    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function get_product($product_id) {
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

public function update_product($id, $title, $description, $price, $image, $brand, $category, $keywords) {
    $query = "UPDATE products 
              SET product_title = ?, product_desc = ?, product_price = ?, product_image = ?, product_brand = ?, product_cat = ?, product_keywords = ?
              WHERE product_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssdssssi", $title, $description, $price, $image, $brand, $category, $keywords, $id);
    return $stmt->execute();
}

public function delete_product($product_id) {
    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    return $stmt->execute();
}

public function get_products_by_brand($brand_name) {
    $query = "SELECT * FROM products WHERE product_brand = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $brand_name);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function get_products_by_category($cat_name) {
    $query = "SELECT * FROM products WHERE product_cat = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $cat_name);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function search_product($term) {
    $query = "SELECT * FROM products WHERE product_title LIKE ?";
    $stmt = $this->conn->prepare($query);
    $like_term = "%$term%";
    $stmt->bind_param("s", $like_term);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



}