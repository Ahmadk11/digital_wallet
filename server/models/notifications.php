<?php
class Notification {
    private $conn;
    private $table = 'notifications';

    public $id;
    public $user_id;
    public $message;
    public $type;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (user_id, message, type) VALUES (:user_id, :message, :type)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':type', $this->type);

        return $stmt->execute();
    }

    public function getNotifications($user_id) {
        $query = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markAsRead($notification_id) {
        $query = "UPDATE $this->table SET status = 'read' WHERE id = :notification_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':notification_id', $notification_id);
        return $stmt->execute();
    }
}
?>