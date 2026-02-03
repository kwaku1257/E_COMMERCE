
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../Settings/core.php';
require_once '../Controllers/CustomerController.php';


header('Content-Type: application/json');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$customerController = new CustomerController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $country  = trim($_POST['country'] ?? '');
    $city     = trim($_POST['city'] ?? '');
    $contact  = trim($_POST['contact'] ?? '');
    $gender   = trim($_POST['gender'] ?? '');
    $role = 2; 

    
    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
        exit;
    }

    if (strlen($name) > 100) {
        echo json_encode(['status' => 'error', 'message' => 'Name must not exceed 100 characters.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address (max 50 characters).']);
        exit;
    }

    if (
        strlen($password) < 6 ||
        !preg_match('/[A-Za-z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {
        echo json_encode(['status' => 'error', 'message' => 'Password must be at least 6 characters long and contain both letters and numbers.']);
        exit;
    }

    if (!empty($country) && strlen($country) > 30) {
        echo json_encode(['status' => 'error', 'message' => 'Country name must not exceed 30 characters.']);
        exit;
    }

    if (!empty($city) && strlen($city) > 30) {
        echo json_encode(['status' => 'error', 'message' => 'City name must not exceed 30 characters.']);
        exit;
    }

    if (!empty($contact) && !preg_match('/^[0-9]{7,15}$/', $contact)) {
        echo json_encode(['status' => 'error', 'message' => 'Contact number must be 7 to 15 digits long.']);
        exit;
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'name'     => $name,
        'email'    => $email,
        'password' => $hashedPassword,
        'country'  => $country,
        'city'     => $city,
        'contact'  => $contact,
        'gender'   => $gender,
        'role'     => $role
    ];

    try {
        $result = $customerController->register($data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Registration successful! Redirecting to login...']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
        }

    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo json_encode(['status' => 'error', 'message' => 'Email already exists. Try logging in.']);
        } else {
            error_log("Database error: " . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'A server error occurred. Please try again.']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
