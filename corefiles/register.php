<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gmail = $_POST['gmail'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (substr($gmail, -10) !== '@gmail.com') {
        $error = 'Only Gmail addresses ending with @gmail.com are allowed.';
    }
    elseif (gmailExists($pdo, $gmail)) {
        $error = 'Gmail already registered';
    }
    else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        createUser($pdo, $username, $gmail, $hashedPassword, 'student');
        header('Location: login.php');
        exit;
    }
}

$title = 'Register';
ob_start();
include '../templates/register.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
