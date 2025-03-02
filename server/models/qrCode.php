<?php
class QrCode {
    private $conn;
    private $table = 'qr_codes';

    public $id;
    public $user_id;
    public $recipient_id;
    public $amount;
    public $qr_data;
    public $expires_at;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (user_id, recipient_id, amount, qr_data, expires_at) VALUES (:user_id, :recipient_id, :amount, :qr_data, :expires_at)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':recipient_id', $this->recipient_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':qr_data', $this->qr_data);
        $stmt->bindParam(':expires_at', $this->expires_at);

        return $stmt->execute();
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function markAsUsed($id) {
        $query = "UPDATE $this->table SET status = 'used' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function expireOldQrCodes() {
        $query = "UPDATE $this->table SET status = 'expired' WHERE expires_at <= NOW() AND status = 'active'";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
}
?>