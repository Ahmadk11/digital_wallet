<?php
class SystemLog {
    private $conn;
    private $table = 'system_logs';

    public $id;
    public $admin_id;
    public $action;
    public $details;
    public $ip_address;
    public $timestamp;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (admin_id, action, details, ip_address) VALUES (:admin_id, :action, :details, :ip_address)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':admin_id', $this->admin_id);
        $stmt->bindParam(':action', $this->action);
        $stmt->bindParam(':details', $this->details);
        $stmt->bindParam(':ip_address', $this->ip_address);

        return $stmt->execute();
    }

    public function getAllLogs() {
        $query = "SELECT * FROM $this->table ORDER BY timestamp DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLogsByAdmin($admin_id) {
        $query = "SELECT * FROM $this->table WHERE admin_id = :admin_id ORDER BY timestamp DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLogsByAction($action) {
        $query = "SELECT * FROM $this->table WHERE action = :action ORDER BY timestamp DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':action', $action);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>