<?php
require_once '../../models/Wallet.php';
require_once '../../connection/db.php';

class WalletController {
    private $wallet;

    public function __construct() {
        global $conn;
        $this->wallet = new Wallet($conn);
    }

    public function createWallet($user_id, $currency = 'USD') {
        $this->wallet->user_id = $user_id;
        $this->wallet->currency = $currency;
        return $this->wallet->create();
    }

    public function getBalance($user_id) {
        return $this->wallet->getBalance($user_id);
    }

    public function updateBalance($user_id, $amount) {
        return $this->wallet->updateBalance($user_id, $amount);
    }
}
?>