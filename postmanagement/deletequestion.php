<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $question = getQuestionById($pdo, $_POST['id']);

    if (
        isset($_SESSION['loggedin']) &&
        (
            ($_SESSION['role'] === 'admin') ||
            ($_SESSION['username'] === $question['author'])
        )
    ) {
        deleteQuestion($pdo, $_POST['id']);
    }
}

header('Location: ../corefiles/home.php');
exit;
?>
