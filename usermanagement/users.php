<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = "Manage Users";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $gmail = $_POST['gmail'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!preg_match('/@gmail\.com$/', $gmail)) {
        $_SESSION['error'] = 'Email must end with @gmail.com';
    } elseif (gmailExists($pdo, $gmail)) {
        $_SESSION['error'] = 'Gmail already exists';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        createUser($pdo, $username, $gmail, $hashedPassword, 'student');
        header('Location: users.php');
        exit;
    }

    header('Location: users.php');
    exit;
}

$users = getAllUsers($pdo);

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

ob_start();
include '../templates/users.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
