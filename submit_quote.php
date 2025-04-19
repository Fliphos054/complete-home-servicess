<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $service_id = filter_input(INPUT_POST, 'service_id', FILTER_SANITIZE_NUMBER_INT);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact.php?error=missing_fields");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=invalid_email");
        exit();
    }
    
    // Prepare data array
    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'service_id' => $service_id,
        'message' => $message
    ];
    
    // Save to database
    if (saveContactSubmission($data)) {
        // Send email notification
        $to = "info@powercleantech.com";
        $subject = "New Quote Request from $name";
        $email_message = "You have received a new quote request:\n\n";
        $email_message .= "Name: $name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Phone: $phone\n";
        
        if ($service_id) {
            $service = getServiceById($service_id);
            $email_message .= "Service: " . $service['name'] . "\n";
        }
        
        $email_message .= "Message:\n$message\n";
        
        $headers = "From: $email";
        
        mail($to, $subject, $email_message, $headers);
        
        // Redirect to thank you page
        header("Location: thank-you.php");
        exit();
    } else {
        header("Location: contact.php?error=database_error");
        exit();
    }
} else {
    header("Location: contact.php");
    exit();
}
?>