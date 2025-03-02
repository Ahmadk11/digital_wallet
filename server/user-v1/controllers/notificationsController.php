<?php
require_once '../../models/Notification.php';
require_once '../../connection/db.php';

class NotificationController {
    private $notification;

    public function __construct() {
        global $conn;
        $this->notification = new Notification($conn);
    }

    public function sendNotification($user_id, $message, $type) {
        $this->notification->user_id = $user_id;
        $this->notification->message = $message;
        $this->notification->type = $type;

        if ($this->notification->create()) {
            return true;
        }
        return false;
    }

    public function getNotifications($user_id) {
        return $this->notification->getNotifications($user_id);
    }

    public function markAsRead($notification_id) {
        return $this->notification->markAsRead($notification_id);
    }
}
?>