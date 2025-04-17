<?php
session_start();
require '../includes/MailFunction.php';

$title = "Contact Admin";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_SESSION['username'] ?? $_POST['name'] ?? 'Guest';
    $email = $_SESSION['gmail'] ?? $_POST['gmail'] ?? 'unknown@example.com';
    $message = $_POST['message'] ?? '';

    $recipient = 'comp1841courseworkemail@gmail.com';
    $subject = "New Contact Message from " . htmlspecialchars($name);
    $body = "Name: " . htmlspecialchars($name) . "\n"
          . "Gmail: " . htmlspecialchars($email) . "\n"
          . "Message:\n" . htmlspecialchars($message);

    if (sendGmail($recipient, $subject, $body)) {
        $output = "Thank you for your message. We will get back to you shortly.";
    } else {
        $output = "There was an error sending your message. Please try again later.";
    }
} else {
    ob_start();
    include '../templates/contact.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
