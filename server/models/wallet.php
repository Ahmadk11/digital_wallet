<?php
class Wallet {
    private $conn;
    private $table = 'wallets';

    public $id;
    public $user_id;
    public $balance;
    public $currency;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (user_id, currency) VALUES (:user_id, :currency)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':currency', $this->currency);
        return $stmt->execute();
    }

    public function getBalance($user_id) {
        $query = "SELECT balance FROM $this->table WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBalance($user_id, $amount) {
        $query = "UPDATE $this->table SET balance = balance + :amount WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}
?>