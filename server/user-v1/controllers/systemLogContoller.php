<?php
require_once '../../models/SystemLog.php';
require_once '../../connection/db.php';

class SystemLogController {
    private $systemLog;

    public function __construct() {
        global $conn;
        $this->systemLog = new SystemLog($conn);
    }

    public function createLog($admin_id, $action, $details, $ip_address) {
        $this->systemLog->admin_id = $admin_id;
        $this->systemLog->action = $action;
        $this->systemLog->details = $details;
        $this->systemLog->ip_address = $ip_address;
        return $this->systemLog->create();
    }

    public function getAllLogs() {
        return $this->systemLog->getAllLogs();
    }

    public function getLogsByAdmin($admin_id) {
        return $this->systemLog->getLogsByAdmin($admin_id);
    }

    public function getLogsByAction($action) {
        return $this->systemLog->getLogsByAction($action);
    }
}
?>