<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $email;
    public $password_hash;
    public $phone_number;
    public $tier;
    public $updated_at;
    public $last_login;
    public $is_active;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (email, password_hash, phone_number) VALUES (:email, :password, :phone)";
        $stmt = $this->conn->prepare($query);

        $this->password_hash = password_hash($this->password_hash, PASSWORD_BCRYPT);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password_hash);
        $stmt->bindParam(':phone', $this->phone_number);

        return $stmt->execute();
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM $this->table WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE $this->table SET email = :email, phone_number = :phone, tier = :tier, is_active = :is_active, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone_number);
        $stmt->bindParam(':tier', $this->tier);
        $stmt->bindParam(':is_active', $this->is_active);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>