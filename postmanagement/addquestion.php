<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

$title = 'Add Question';
$modules = getAllModules($pdo);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titleInput = $_POST['title'] ?? '';
    $question_text = $_POST['question_text'] ?? '';
    $module_id = $_POST['module_id'] ?? null;
    $imageName = null;

    if (!isset($_SESSION['gmail'])) {
        $error = 'You must be logged in to post a question.';
    } else {
        $user = getUserByGmail($pdo, $_SESSION['gmail']);
        if (!$user) {
            $error = 'User not found.';
        } else {
            $user_id = $user['id'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageName = basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $imageName);
            }

            addQuestion($pdo, $titleInput, $question_text, $imageName, $user_id, $module_id);

            header('Location: ../corefiles/home.php');
            exit;
        }
    }
}

ob_start();
include '../templates/addquestion.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
