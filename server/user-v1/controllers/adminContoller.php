<?php
require_once '../../models/admins.php';
require_once '../../models/user.php';
require_once '../../models/transaction.php';
require_once '../../connection/db.php';

class AdminController {
    private $admin;
    private $user;
    private $transaction;

    public function __construct() {
        global $conn;
        $this->admin = new Admin($conn);
        $this->user = new User($conn);
        $this->transaction = new Transaction($conn);
    }

    public function login($username, $password) {
        $admin = $this->admin->findByUsername($username);

        if ($admin && password_verify($password, $admin['password_hash'])) {
            return $admin;
        }
        return false;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTransactions() {
        $query = "SELECT * FROM transactions";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUserTier($user_id, $tier) {
        return $this->user->updateTier($user_id, $tier);
    }

    public function deleteUser($user_id) {
        return $this->user->delete($user_id);
    }
}
?>