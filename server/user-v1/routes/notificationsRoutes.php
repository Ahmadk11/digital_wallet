<?php
require_once '../controllers/notificationsController.php';

$notificationController = new NotificationController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'send_notification') {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
    $type = $_POST['type'];

    if ($notificationController->sendNotification($user_id, $message, $type)) {
        echo json_encode(['message' => 'Notification sent successfully']);
    } else {
        echo json_encode(['message' => 'Failed to send notification']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_notifications') {
    $user_id = $_GET['user_id'];
    echo json_encode($notificationController->getNotifications($user_id));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'mark_as_read') {
    $notification_id = $_POST['notification_id'];
    if ($notificationController->markAsRead($notification_id)) {
        echo json_encode(['message' => 'Notification marked as read']);
    } else {
        echo json_encode(['message' => 'Failed to mark notification as read']);
    }
}
?>