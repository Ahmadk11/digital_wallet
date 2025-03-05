<?php
require_once '../controllers/walletcontroller.php';

$walletController = new WalletController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'create_wallet') {
    $user_id = $_POST['user_id'];
    $currency = $_POST['currency'];
    echo json_encode($walletController->createWallet($user_id, $currency));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_balance') {
    $user_id = $_GET['user_id'];
    echo json_encode($walletController->getBalance($user_id));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'deposit') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    echo json_encode($walletController->deposit($user_id, $amount));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'withdraw') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    echo json_encode($walletController->withdraw($user_id, $amount));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'transfer') {
    $user_id = $_POST['user_id'];
    $recipient_id = $_POST['recipient_id'];
    $amount = $_POST['amount'];
    echo json_encode($walletController->transfer($user_id, $recipient_id, $amount));
}
?>