<?php


require_once __DIR__ . '/../Settings/db_class.php';

class Customer extends Database {
    public function add(array $data): bool {
        $query = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, user_role, customer_gender)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param(
            "ssssssis",
            $data['name'],
            $data['email'],
            $data['password'],
            $data['country'],
            $data['city'],
            $data['contact'],
            $data['role'],
            $data['gender']
        );
        return $stmt->execute();
    }
    public function getByEmail(string $email): mixed {
        $query = "SELECT customer_id, customer_name, customer_email, customer_pass, user_role, Customer_gender 
                  FROM customer 
                  WHERE customer_email = ? 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
