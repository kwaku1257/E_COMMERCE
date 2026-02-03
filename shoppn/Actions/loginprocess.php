<?php


require_once '../Settings/core.php';
require_once '../Controllers/CustomerController.php';


$customerController = new CustomerController();


$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


$user = $customerController->login($email, $password);

if ($user) {
    
    $_SESSION['user_id'] = $user['customer_id'];
    $_SESSION['user_email'] = $user['customer_email'];
    $_SESSION['user_name'] = $user['customer_name'];
    $_SESSION['user_role'] = $user['user_role'];

    
    if ($user['user_role'] == 1) {
        
        header('Location: ../Admin/dashboard.php');
    } else {
        
        header('Location: ../index.php');
    }
    exit();
} else {
    
    header('Location: ../Login/login.php?error=invalid');
    exit();
}
