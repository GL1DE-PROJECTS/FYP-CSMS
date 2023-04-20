<?php
// Get the form data
$to = $_POST['to'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Send the email
$headers = 'From: Your Name <your-email@example.com>' . "\r\n" .
    'Reply-To: your-email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>