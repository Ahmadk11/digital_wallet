<?php
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $email;
    public $phone_number;
    public $password_hash;
    public $tier;
    public $created_at;
    public $updated_at;
    public $last_login;
    public $is_active;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (email, phone_number, password_hash) VALUES (:email, :phone, :password)";
        $stmt = $this->conn->prepare($query);

        $this->password_hash = password_hash($this->password_hash, PASSWORD_BCRYPT);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone_number);
        $stmt->bindParam(':password', $this->password_hash);

        return $stmt->execute();
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM $this->table WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProfile($user_id) {
        $query = "SELECT email, phone_number, tier, created_at, updated_at, last_login, is_active FROM $this->table WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($user_id, $email, $phone_number) {
        $query = "UPDATE $this->table SET email = :email, phone_number = :phone_number, updated_at = NOW() WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':user_id', $user_id);

      
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

      
    public function updateTier($user_id, $tier) {
        $query = "UPDATE $this->table SET tier = :tier, updated_at = NOW() WHERE id = :user_id";

      
    public function delete() {
        $query = "DELETE FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tier', $tier);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }

    public function delete($user_id) {
        $query = "DELETE FROM $this->table WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }


    public function updateLastLogin($user_id) {
        $query = "UPDATE $this->table SET last_login = NOW() WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function setActiveStatus($user_id, $is_active) {
        $query = "UPDATE $this->table SET is_active = :is_active, updated_at = NOW() WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':is_active', $is_active);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }
}
?>