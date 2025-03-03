<?php
require_once '../controllers/SystemLogController.php';

$systemLogController = new SystemLogController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'create_log') {
    $admin_id = $_POST['admin_id'];
    $action = $_POST['action'];
    $details = $_POST['details'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    if ($systemLogController->createLog($admin_id, $action, $details, $ip_address)) {
        echo json_encode(['message' => 'Log entry created successfully']);
    } else {
        echo json_encode(['message' => 'Failed to create log entry']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_all_logs') {
    echo json_encode($systemLogController->getAllLogs());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_logs_by_admin') {
    $admin_id = $_GET['admin_id'];
    echo json_encode($systemLogController->getLogsByAdmin($admin_id));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_logs_by_action') {
    $action = $_GET['action'];
    echo json_encode($systemLogController->getLogsByAction($action));
}
?>