<?php

include 'db_connection.php';

$users = [
    ['email' => 'user1@example.com', 'phone' => '1234567890', 'password' => password_hash('password1', PASSWORD_BCRYPT), 'verified' => 1],
    ['email' => 'user2@example.com', 'phone' => '0987654321', 'password' => password_hash('password2', PASSWORD_BCRYPT), 'verified' => 1],
];


$wallets = [
    ['user_id' => 1, 'balance' => 1000.00],
    ['user_id' => 2, 'balance' => 500.00],
];


$transactions = [
    ['user_id' => 1, 'amount' => 100.00, 'type' => 'deposit', 'status' => 'completed'],
    ['user_id' => 2, 'amount' => 50.00, 'type' => 'withdrawal', 'status' => 'pending'],
];


$notifications = [
    ['user_id' => 1, 'message' => 'Welcome to the Digital Wallet Platform!', 'read' => 0],
    ['user_id' => 2, 'message' => 'Your account has been successfully verified.', 'read' => 0],
];


$system_logs = [
    ['action' => 'user_login', 'details' => 'User 1 logged in', 'admin_id' => null],
    ['action' => 'user_registration', 'details' => 'User 2 registered', 'admin_id' => null],
];


foreach ($users as $user) {
    $stmt = $pdo->prepare("INSERT INTO users (email, phone, password, verified) VALUES (:email, :phone, :password, :verified)");
    $stmt->execute($user);
}


foreach ($wallets as $wallet) {
    $stmt = $pdo->prepare("INSERT INTO wallets (user_id, balance) VALUES (:user_id, :balance)");
    $stmt->execute($wallet);
}


foreach ($transactions as $transaction) {
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, amount, type, status) VALUES (:user_id, :amount, :type, :status)");
    $stmt->execute($transaction);
}


foreach ($notifications as $notification) {
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, read) VALUES (:user_id, :message, :read)");
    $stmt->execute($notification);
}


foreach ($system_logs as $log) {
    $stmt = $pdo->prepare("INSERT INTO system_logs (action, details, admin_id) VALUES (:action, :details, :admin_id)");
    $stmt->execute($log);
}

echo "Database seeding completed successfully!";
?>
