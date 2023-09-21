<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the recipient email address
    $receiving_email_address = 'Sandeshshrivastava12@gmail.com';

    // Function to sanitize input data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get form data and sanitize it
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    // Perform basic form validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // Send the email using PHP's mail() function
        $headers = "From: $email" . "\r\n" .
            "Reply-To: $email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($receiving_email_address, $subject, $message, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent.";
        }
    }
} else {
    // If the form was not submitted, display an error message or redirect as needed
    echo "This page should not be accessed directly.";
}
?>