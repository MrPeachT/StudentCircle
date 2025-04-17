<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = "Add User";
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $gmail = $_POST['gmail'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student';

    if (!empty($username) && !empty($gmail) && !empty($password)) {
        if (substr($gmail, -10) !== '@gmail.com') {
            $error = 'Only Gmail addresses ending with @gmail.com are allowed.';
        } elseif (gmailExists($pdo, $gmail)) {
            $error = 'This Gmail is already registered.';
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            createUser($pdo, $username, $gmail, $hashed, $role);
            header('Location: users.php');
            exit;
        }
    } else {
        $error = 'All fields are required.';
    }
}

ob_start();
include '../templates/adduser.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
