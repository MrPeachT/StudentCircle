<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = $_POST['title'] ?? '';

$modules = getAllModules($pdo);

if (!isset($_GET['id'])) {
    die('Question ID is required.');
}

$question_id = $_GET['id'];
$question = getQuestionById($pdo, $question_id);

if (!$question) {
    die('Question not found.');
}

if (!isset($_SESSION['gmail'])) {
    die('You must be logged in to edit a question.');
}

$user = getUserByGmail($pdo, $_SESSION['gmail']);

if (!$user || !($user['id'] === $question['user_id'] || $_SESSION['role'] === 'admin')) {
    header('Location: ../corefiles/home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = $_POST['question_text'] ?? '';
    $module_id = $_POST['module_id'] ?? null;
    $imageName = $question['image']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageName);
    }

    updateQuestion($pdo, $question_id, $title, $question_text, $imageName, $question['user_id'], $module_id);

    header('Location: ../corefiles/home.php');
    exit;
}

$title = 'Edit Question';

ob_start();
include '../templates/editquestion.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
