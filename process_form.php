<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $service = sanitize_input($_POST['service']);
    $otherService = isset($_POST['otherService']) ? sanitize_input($_POST['otherService']) : '';
    $date = sanitize_input($_POST['date']);
    $time = sanitize_input($_POST['time']);
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = isset($_POST['address']) ? sanitize_input($_POST['address']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

    // Prepare email content
    $to = "your-email@example.com"; // Replace with your email
    $subject = "New Service Request from " . $name;

    $email_content = "New Service Request Details:\n\n";
    $email_content .= "Service: " . ($service === 'other' ? $otherService : $service) . "\n";
    $email_content .= "Date: " . $date . "\n";
    $email_content .= "Time: " . $time . "\n";
    $email_content .= "Name: " . $name . "\n";
    $email_content .= "Email: " . $email . "\n";
    $email_content .= "Phone: " . $phone . "\n";
    $email_content .= "Address: " . $address . "\n";
    $email_content .= "Additional Message: " . $message . "\n";

    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if(mail($to, $subject, $email_content, $headers)) {
        // Send confirmation email to customer
        $customer_subject = "We've Received Your Service Request";
        $customer_message = "Dear " . $name . ",\n\n";
        $customer_message .= "Thank you for your service request. We have received your information and will contact you shortly to confirm the details.\n\n";
        $customer_message .= "Your request details:\n";
        $customer_message .= "Service: " . ($service === 'other' ? $otherService : $service) . "\n";
        $customer_message .= "Preferred Date: " . $date . "\n";
        $customer_message .= "Preferred Time: " . $time . "\n\n";
        $customer_message .= "Best regards,\nYour Service Team";

        mail($email, $customer_subject, $customer_message, "From: " . $to);

        // Set success message
        $_SESSION['success_message'] = "Thank you! We've received your request and will contact you soon.";
    } else {
        $_SESSION['error_message'] = "Sorry, there was an error sending your request. Please try again later.";
    }

    // Redirect back to the form
    header("Location: index.php#request");
    exit();
} else {
    // If someone tries to access this file directly, redirect them to the homepage
    header("Location: index.php");
    exit();
}
?>
