<?php


session_start();


require_once __DIR__ . '/db_cred.php';
require_once __DIR__ . '/db_class.php';


$db = new Database();

/**
 * Check if user is logged in
 *
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if logged-in user is an admin (user_role = 1)
 *
 * @return bool
 */
function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1;
}

/**
 * Check if logged-in user is a customer (user_role = 2)
 *
 * @return bool
 */
function is_customer() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2;
}
