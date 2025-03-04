<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($email, $password, $phone) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (email, password_hash, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashedPassword, $phone);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT id, email, phone, full_name, address, date_of_birth FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProfile($userId, $fullName, $address, $dateOfBirth) {
        $stmt = $this->conn->prepare("UPDATE users SET full_name = ?, address = ?, date_of_birth = ? WHERE id = ?");
        $stmt->bind_param("sssi", $fullName, $address, $dateOfBirth, $userId);
        return $stmt->execute();
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user['id'];
        }
        return false;
    }
}
?>
