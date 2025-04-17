<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

$currentUsername = $_SESSION['username'];
$currentGmail = $_SESSION['gmail'];
$user = getUserByGmail($pdo, $currentGmail);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'] ?? '';
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';

    if (empty($currentPassword)) {
        $error = 'Please enter your current password to make changes.';
    } elseif (!password_verify($currentPassword, $user['password'])) {
        $error = 'Current password is incorrect.';
    } else {
        if (!empty($newUsername) && $newUsername !== $currentUsername) {
            updateUsername($pdo, $currentGmail, $newUsername);
            $_SESSION['username'] = $newUsername;
            $success = 'Username updated successfully.';
        }

        if (!empty($newPassword)) {
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            updatePassword($pdo, $currentGmail, $hashed);
            $success .= ' Password updated successfully.';
        }

        if (empty($newUsername) || $newUsername === $currentUsername) {
            if (empty($newPassword)) {
                $error = 'No changes were made.';
            }
        }
    }
}

$title = 'Edit Profile';
ob_start();
include '../templates/profile.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
