<?php
require_once '../controllers/authcontroller.php';

$authController = new AuthController();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'register') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    if ($authController->register($email, $password, $phone_number)) {
        echo json_encode(['message' => 'Registration successful']);
    } else {
        echo json_encode(['message' => 'Registration failed']);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($authController->login($email, $password)) {
        echo json_encode(['message' => 'Login successful']);
    } else {
        echo json_encode(['message' => 'Login failed']);
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'logout') {
    if ($authController->logout()) {
        echo json_encode(['message' => 'Logout successful']);
    } else {
        echo json_encode(['message' => 'Logout failed']);
    }
}
?>