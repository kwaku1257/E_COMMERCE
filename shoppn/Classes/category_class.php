<?php
require_once '../Settings/db_class.php';

class Category extends Database {

    public function add_category($cat_name) {
        $query = "INSERT INTO categories (cat_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $cat_name);
        return $stmt->execute();
    }

    public function get_all_categories() {
        $query = "SELECT * FROM categories";
        $result = $this->conn->query($query);

        $categories = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        return $categories;
    }

    public function get_category($cat_id) {
        $query = "SELECT * FROM categories WHERE cat_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

   
    public function update_category($cat_id, $cat_name) {
        $query = "UPDATE categories SET cat_name = ? WHERE cat_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $cat_name, $cat_id);
        return $stmt->execute();
    }

    public function delete_category($cat_id) {
        $query = "DELETE FROM categories WHERE cat_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cat_id);
        return $stmt->execute();
    }
}
?>
