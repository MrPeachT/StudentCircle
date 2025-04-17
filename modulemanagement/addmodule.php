<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = "Add Module";
$error = '';
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if (empty($name)) {
        $error = 'Module name cannot be empty.';
    } elseif (moduleNameExists($pdo, $name)) {
        $error = 'Module name already exists.';
    } else {
        addModule($pdo, $name);
        header('Location: modules.php');
        exit;
    }
}

ob_start();
include '../templates/addmodule.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
