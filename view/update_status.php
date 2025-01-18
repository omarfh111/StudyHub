<?php
require_once '../controller/UserController.php';

if (isset($_GET['idu']) && isset($_GET['action'])) {
    $userId = $_GET['idu'];
    $action = $_GET['action'];

    $userC = new UserController();

    if ($action === 'ban') {
        $userC->updateStatus($userId, 'ban');
    } elseif ($action === 'unban') {
        $userC->updateStatus($userId, 'unban');
    }

    // Redirection après mise à jour
    header('Location: http://localhost/login6/view/back/university/students.php');
    exit();
}
?>
