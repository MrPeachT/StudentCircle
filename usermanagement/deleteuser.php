<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../corefiles/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $user = getUserById($pdo, $_POST['id']);

    if ($user && $user['role'] === 'admin') {
        $_SESSION['error'] = 'You cannot delete an admin account.';
    } else {
        deleteUser($pdo, $_POST['id']);
    }
}

header('Location: users.php');
exit;
