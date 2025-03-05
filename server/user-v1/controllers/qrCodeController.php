<?php
require_once '../../models/qrCode.php';
require_once '../../models/transaction.php';
require_once '../../connection/db.php';

class QrCodeController {
    private $qrCode;
    private $transaction;

    public function __construct() {
        global $conn;
        $this->qrCode = new QrCode($conn);
        $this->transaction = new Transaction($conn);
    }

    // Generate a new QR code
    public function generateQrCode($user_id, $recipient_id, $amount) {
        $qr_data = $this->generateQrData($user_id, $recipient_id, $amount);
        $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes')); // QR code expires in 5 minutes

        $this->qrCode->user_id = $user_id;
        $this->qrCode->recipient_id = $recipient_id;
        $this->qrCode->amount = $amount;
        $this->qrCode->qr_data = $qr_data;
        $this->qrCode->expires_at = $expires_at;

        if ($this->qrCode->create()) {
            return ['qr_data' => $qr_data, 'expires_at' => $expires_at];
        }
        return false;
    }

    // Process a QR code payment
    public function processQrCodePayment($qr_data) {
        $qrCode = $this->qrCode->findById($qr_data);

        if ($qrCode && $qrCode['status'] === 'active' && strtotime($qrCode['expires_at']) >= time()) {
            // Perform the payment
            $this->transaction->user_id = $qrCode['user_id'];
            $this->transaction->recipient_id = $qrCode['recipient_id'];
            $this->transaction->amount = $qrCode['amount'];
            $this->transaction->type = 'qr_payment';

            if ($this->transaction->create()) {
                // Mark the QR code as used
                $this->qrCode->markAsUsed($qrCode['id']);
                return true; // Payment successful
            }
        }
        return false;
    }

    // Generate QR code data (e.g., a unique identifier)
    private function generateQrData($user_id, $recipient_id, $amount) {
        return base64_encode("user_id=$user_id&recipient_id=$recipient_id&amount=$amount&timestamp=" . time());
    }
}
?>