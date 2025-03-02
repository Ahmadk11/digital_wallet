<?php
require_once '../controllers/QrCodeController.php';

$qrCodeController = new QrCodeController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'generate_qr_code') {
    $user_id = $_POST['user_id'];
    $recipient_id = $_POST['recipient_id'];
    $amount = $_POST['amount'];

    $result = $qrCodeController->generateQrCode($user_id, $recipient_id, $amount);
    if ($result) {
        echo json_encode(['message' => 'QR code generated successfully', 'qr_data' => $result['qr_data'], 'expires_at' => $result['expires_at']]);
    } else {
        echo json_encode(['message' => 'Failed to generate QR code']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'process_qr_payment') {
    $qr_data = $_POST['qr_data'];

    if ($qrCodeController->processQrCodePayment($qr_data)) {
        echo json_encode(['message' => 'Payment successful']);
    } else {
        echo json_encode(['message' => 'Payment failed']);
    }
}
?>