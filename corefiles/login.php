<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gmail = $_POST['gmail'] ?? '';
    $password = $_POST['password'] ?? '';

    if (substr($gmail, -10) !== '@gmail.com') {
        $error = 'Only Gmail addresses ending with @gmail.com are allowed.';
    } else {
        $user = getUserByGmail($pdo, $gmail);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username']; 
            $_SESSION['gmail'] = $user['gmail'];     
            $_SESSION['role'] = $user['role'];

            header('Location: home.php');
            exit;
        } else {
            $error = 'Invalid Gmail or password';
        }
    }
}

$title = 'Login';
ob_start();
include '../templates/login.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
