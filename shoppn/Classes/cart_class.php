<?php


require_once '../Settings/db_class.php';

class Cart extends Database {

    
    public function add_to_cart($c_id, $p_id, $qty) {
        $check = "SELECT * FROM cart WHERE c_id = ? AND p_id = ?";
        $stmt = $this->conn->prepare($check);
        $stmt->bind_param("ii", $c_id, $p_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $update = "UPDATE cart SET qty = qty + ? WHERE c_id = ? AND p_id = ?";
            $stmt = $this->conn->prepare($update);
            $stmt->bind_param("iii", $qty, $c_id, $p_id);
        } else {
            
            $insert = "INSERT INTO cart (p_id, ip_add, c_id, qty) VALUES (?, '', ?, ?)";
            $stmt = $this->conn->prepare($insert);
            $stmt->bind_param("iii", $p_id, $c_id, $qty);
        }

        return $stmt->execute();
    }

    public function get_cart_items($c_id) {
        $query = "SELECT c.p_id, c.qty, p.product_title, p.product_price, p.product_image 
                  FROM cart c
                  JOIN products p ON c.p_id = p.product_id
                  WHERE c.c_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function update_quantity($c_id, $p_id, $qty) {
        $query = "UPDATE cart SET qty = ? WHERE c_id = ? AND p_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $qty, $c_id, $p_id);
        return $stmt->execute();
    }

   
    public function remove_from_cart($c_id, $p_id) {
        $query = "DELETE FROM cart WHERE c_id = ? AND p_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $c_id, $p_id);
        return $stmt->execute();
    }

    public function get_cart_total($c_id) {
        $query = "SELECT SUM(p.product_price * c.qty) AS total
                  FROM cart c
                  JOIN products p ON c.p_id = p.product_id
                  WHERE c.c_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $c_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'] ?? 0;
    }

    public function insertOrder($customer_id, $invoice_no, $order_date, $order_status) {
        $query = "INSERT INTO orders (customer_id, invoice_no, order_date, order_status)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $customer_id, $invoice_no, $order_date, $order_status);
        $stmt->execute();
        return $stmt->insert_id;
    }

   
    public function insertOrderDetails($order_id, $product_id, $qty) {
        $query = "INSERT INTO orderdetails (order_id, product_id, qty)
                  VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $order_id, $product_id, $qty);
        return $stmt->execute();
    }

    public function insertPayment($amount, $customer_id, $order_id, $currency, $payment_date) {
        $query = "INSERT INTO payment (amt, customer_id, order_id, currency, payment_date)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("diiss", $amount, $customer_id, $order_id, $currency, $payment_date);
        return $stmt->execute();
    }

    public function clearCart($customer_id) {
        $query = "DELETE FROM cart WHERE c_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $customer_id);
        return $stmt->execute();
    }
}
