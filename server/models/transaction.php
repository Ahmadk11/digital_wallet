<?php
class Transaction {
    private $conn;
    private $table = 'transactions';

    public $id;
    public $user_id;
    public $wallet_id;
    public $type;
    public $amount;
    public $fee;
    public $recipient_id;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (user_id, wallet_id, type, amount, fee, recipient_id) VALUES (:user_id, :wallet_id, :type, :amount, :fee, :recipient_id)";
        $stmt = $this->conn->prepare($query);

        $this->fee = $this->calculateFee($this->type, $this->amount);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':wallet_id', $this->wallet_id);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':fee', $this->fee);
        $stmt->bindParam(':recipient_id', $this->recipient_id);

        return $stmt->execute();
    }

    private function calculateFee($type, $amount) {
        if ($type === 'transfer') {
            return $amount * 0.01;
        }
        return 0;
    }
}
?>