<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = "Edit Module";

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../corefiles/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: modules.php');
    exit;
}

$module = getModuleById($pdo, $_GET['id']);

if (!$module) {
    $output = 'Module not found.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateModule($pdo, $_GET['id'], $_POST['name']);
    header('Location: modules.php');
    exit;
}

ob_start();
include '../templates/editmodule.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
