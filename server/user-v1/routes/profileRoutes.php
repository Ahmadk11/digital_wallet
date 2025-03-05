<?php
require_once '../controllers/profileController.php';

$profileController = new ProfileController();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'get_profile') {
    $user_id = $_GET['user_id'];
    echo json_encode($profileController->getProfile($user_id));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'update_profile') {
    $user_id = $_POST['user_id'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    echo json_encode($profileController->updateProfile($user_id, $email, $phone_number));
}
?>