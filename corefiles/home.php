<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = 'Community Questions';

$showAddForm = false;
if (isset($_GET['post']) && $_GET['post'] === 'new') {
    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }
    $showAddForm = true;
    $modules = getAllModules($pdo);
    $users = getAllUsers($pdo);
}

$questions = getAllQuestions($pdo);

ob_start();
include '../templates/home.html.php'; 
$output = ob_get_clean();
include '../templates/layout.html.php';
