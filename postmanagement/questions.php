<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = 'All Questions';

try {
    $questions = getAllQuestions($pdo);
} catch (PDOException $e) {
    $questions = [];
    $error = 'Error fetching questions: ' . $e->getMessage();
}

ob_start();
include '../templates/questions.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';
