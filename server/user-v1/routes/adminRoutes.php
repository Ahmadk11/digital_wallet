<?php
require_once '../controllers/AdminController.php';

$adminController = new AdminController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = $adminController->login($username, $password);
    if ($admin) {
        echo json_encode(['message' => 'Login successful', 'admin' => $admin]);
    } else {
        echo json_encode(['message' => 'Login failed']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_all_users') {
    echo json_encode($adminController->getAllUsers());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_all_transactions') {
    echo json_encode($adminController->getAllTransactions());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update_user_tier') {
    $user_id = $_POST['user_id'];
    $tier = $_POST['tier'];

    if ($adminController->updateUserTier($user_id, $tier)) {
        echo json_encode(['message' => 'User tier updated successfully']);
    } else {
        echo json_encode(['message' => 'Failed to update user tier']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'delete_user') {
    $user_id = $_POST['user_id'];

    if ($adminController->deleteUser($user_id)) {
        echo json_encode(['message' => 'User deleted successfully']);
    } else {
        echo json_encode(['message' => 'Failed to delete user']);
    }
}
?>