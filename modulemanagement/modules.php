<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = 'Manage Modules';

$showAddModuleForm = isset($_GET['action']) && $_GET['action'] === 'add';
$error = '';
$modules = [];

try {
    $modules = getAllModulesOrdered($pdo);
} catch (PDOException $e) {
    $error = 'Error: ' . $e->getMessage(); 
}

ob_start();
include '../templates/modules.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
