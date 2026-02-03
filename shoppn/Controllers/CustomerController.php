<?php


require_once __DIR__ . '/../Classes/Customer.php';

class CustomerController {
    private Customer $model;

    public function __construct() {
        
        $this->model = new Customer();
    }

    public function register(array $data): bool {
        return $this->model->add($data);
    }

    public function login(string $email, string $password): mixed {
        $user = $this->model->getByEmail($email);

        
        if ($user && password_verify($password, $user['customer_pass'])) {
            return $user;
        }

        
        return false;
    }
}
