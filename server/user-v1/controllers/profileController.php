<?php
require_once '../../models/User.php';
require_once '../../connection/db.php';

class ProfileController {
    private $user;

    public function __construct() {
        global $conn;
        $this->user = new User($conn);
    }

    public function getProfile($user_id) {
        return $this->user->getProfile($user_id);
    }

    public function updateProfile($user_id, $email, $phone_number) {
        return $this->user->updateProfile($user_id, $email, $phone_number);
    }
}
?>