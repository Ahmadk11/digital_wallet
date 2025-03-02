<?php
session_start();
require_once '../../models/User.php';
require_once '../../connection/db.php';

class AuthController {
    private $user;

    public function __construct() {
        global $conn;
        $this->user = new User($conn);
    }
    
    public function register($email, $password, $phone_number) {
        $this->user->email = $email;
        $this->user->password_hash = $password;
        $this->user->phone_number = $phone_number;

        if ($this->user->create()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $user = $this->user->findByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            return true; 
        }
        return false;
    }

    public function logout() {
        session_destroy();
        return true;
    }
}
?>