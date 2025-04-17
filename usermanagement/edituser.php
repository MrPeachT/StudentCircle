<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = "Edit User";

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../corefiles/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: users.php');
    exit;
}

$userIdToEdit = (int)$_GET['id'];
$currentUser = getUserByGmail($pdo, $_SESSION['gmail']);
$user = getUserById($pdo, $userIdToEdit);

$isAdmin = $_SESSION['role'] === 'admin';
$isOwner = $currentUser && $currentUser['id'] === $userIdToEdit;

if (!$isAdmin && !$isOwner) {
    header('Location: users.php');
    exit;
}

if (!$user) {
    $output = 'User not found.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $gmail = trim($_POST['gmail'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $user['role']; 

    if ($isAdmin) {
        $role = $_POST['role'] ?? $user['role'];
    }

    if (!empty($username) && !empty($gmail)) {
        if (!preg_match('/^[^@]+@gmail\.com$/', $gmail)) {
            $error = 'Email must end with @gmail.com';
        } else {
            updateUser($pdo, $userIdToEdit, $username, $gmail, $password, $role);
    
            if ($isOwner) {
                $_SESSION['username'] = $username;
                $_SESSION['gmail'] = $gmail;
            }
    
            header('Location: users.php');
            exit;
        }
    } else {
        $error = 'Username and Gmail cannot be empty.';
    }
    
}

ob_start();
include '../templates/edituser.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
