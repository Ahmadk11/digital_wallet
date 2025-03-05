<?php
require_once '../../models/wallet.php';
require_once '../../models/transaction.php';
require_once '../../connection/db.php';

class WalletController {
    private $wallet;
    private $transaction;

    public function __construct() {
        global $conn;
        $this->wallet = new Wallet($conn);
        $this->transaction = new Transaction($conn);
    }

    public function createWallet($user_id, $currency = 'USD') {
        $this->wallet->user_id = $user_id;
        $this->wallet->currency = $currency;
        return $this->wallet->create();
    }

    public function getBalance($user_id) {
        return $this->wallet->getBalance($user_id);
    }

    public function deposit($user_id, $amount) {

        if ($this->wallet->updateBalance($user_id, $amount)) {

            $this->transaction->user_id = $user_id;
            $this->transaction->type = 'deposit';
            $this->transaction->amount = $amount;
            return $this->transaction->create();
        }
        return false;
    }

    public function withdraw($user_id, $amount) {
        if ($this->wallet->updateBalance($user_id, -$amount)) {

            $this->transaction->user_id = $user_id;
            $this->transaction->type = 'withdrawal';
            $this->transaction->amount = $amount;
            return $this->transaction->create();
        }
        return false;
    }

    public function transfer($user_id, $recipient_id, $amount) {
        if ($this->withdraw($user_id, $amount)) {
            if ($this->deposit($recipient_id, $amount)) {
                $this->transaction->user_id = $user_id;
                $this->transaction->recipient_id = $recipient_id;
                $this->transaction->type = 'transfer';
                $this->transaction->amount = $amount;
                return $this->transaction->create();
            }
        }
        return false;
    }
}
?>