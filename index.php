<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Recipient email address (your email)
    $to = "vmg.biz.us@gmail.com"; // REPLACE WITH YOUR EMAIL ADDRESS
    $subject = "New Contact Form Message from " . $name;

    // Email content
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n\n";
    $email_message .= "Message:\n$message\n";

    // Email headers
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "Message sent successfully! We will get back to you soon.";
    } else {
        echo "Message could not be sent. Please try again later.";
    }
} else {
    // If accessed directly without form submission
    echo "Please use the contact form to submit a message.";
}
?>
