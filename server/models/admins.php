<?php
class Admin {
    private $conn;
    private $table = 'admin';

    public $id;
    public $username;
    public $password_hash;
    public $role;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (username, password_hash, role) VALUES (:username, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $this->password_hash = password_hash($this->password_hash, PASSWORD_BCRYPT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password_hash);
        $stmt->bindParam(':role', $this->role);

        return $stmt->execute();
    }

    public function findByUsername($username) {
        $query = "SELECT * FROM $this->table WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>