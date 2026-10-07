<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);
    
    // Validate data
    if (empty($name) || empty($email) || empty($message)) {
        echo "error: Please fill in all fields.";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error: Invalid email format.";
        exit;
    }
    
    // Set your email
    $to = "Bamissag96@yahoo.com";
    
    // Set subject
    $subject = "New Contact Form Message from $name";
    
    // Build email content
    $email_content = "You have received a new message from your website contact form.\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Build headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "success";
    } else {
        echo "error: Sorry, there was a problem sending your message. Please try again.";
    }
} else {
    echo "error: Invalid request method.";
}
?>