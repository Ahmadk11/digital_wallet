<?php
// seeds.php

// Include your database connection file
include 'db_connection.php';

// Sample data for users table
$users = [
    ['email' => 'user1@example.com', 'phone' => '1234567890', 'password' => password_hash('password1', PASSWORD_BCRYPT), 'verified' => 1],
    ['email' => 'user2@example.com', 'phone' => '0987654321', 'password' => password_hash('password2', PASSWORD_BCRYPT), 'verified' => 1],
    // Add more users as needed
];

// Sample data for wallets table
$wallets = [
    ['user_id' => 1, 'balance' => 1000.00],
    ['user_id' => 2, 'balance' => 500.00],
    // Add more wallets as needed
];

// Sample data for transactions table
$transactions = [
    ['user_id' => 1, 'amount' => 100.00, 'type' => 'deposit', 'status' => 'completed'],
    ['user_id' => 2, 'amount' => 50.00, 'type' => 'withdrawal', 'status' => 'pending'],
    // Add more transactions as needed
];

// Sample data for notifications table
$notifications = [
    ['user_id' => 1, 'message' => 'Welcome to the Digital Wallet Platform!', 'read' => 0],
    ['user_id' => 2, 'message' => 'Your account has been successfully verified.', 'read' => 0],
    // Add more notifications as needed
];

// Sample data for system_logs table
$system_logs = [
    ['action' => 'user_login', 'details' => 'User 1 logged in', 'admin_id' => null],
    ['action' => 'user_registration', 'details' => 'User 2 registered', 'admin_id' => null],
    // Add more logs as needed
];

// Insert sample data into users table
foreach ($users as $user) {
    $stmt = $pdo->prepare("INSERT INTO users (email, phone, password, verified) VALUES (:email, :phone, :password, :verified)");
    $stmt->execute($user);
}

// Insert sample data into wallets table
foreach ($wallets as $wallet) {
    $stmt = $pdo->prepare("INSERT INTO wallets (user_id, balance) VALUES (:user_id, :balance)");
    $stmt->execute($wallet);
}

// Insert sample data into transactions table
foreach ($transactions as $transaction) {
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, amount, type, status) VALUES (:user_id, :amount, :type, :status)");
    $stmt->execute($transaction);
}

// Insert sample data into notifications table
foreach ($notifications as $notification) {
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, read) VALUES (:user_id, :message, :read)");
    $stmt->execute($notification);
}

// Insert sample data into system_logs table
foreach ($system_logs as $log) {
    $stmt = $pdo->prepare("INSERT INTO system_logs (action, details, admin_id) VALUES (:action, :details, :admin_id)");
    $stmt->execute($log);
}

echo "Database seeding completed successfully!";
?>