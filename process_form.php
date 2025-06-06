<?php
// Set up error logging
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/email_errors.log');
error_reporting(E_ALL);

require __DIR__ . '/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_valid_phone($phone) {
    return preg_match("/^\+?[\d\s-]{8,}$/", $phone);
}

function send_email($to, $subject, $body, $from_name = 'Multi-Hand Services') {
    error_log("PHP version: " . phpversion());
    error_log("OpenSSL version: " . OPENSSL_VERSION_TEXT);
    try {
        error_log("Attempting to send email to: " . $to);
        $mail = new PHPMailer(true);

        // Debug settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
        $mail->Debugoutput = function($str, $level) {
            error_log($str);  // Log to the error log file
        };

        // Gmail SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        
        // Your Gmail credentials
        $mail->Username = 'multihandservices@gmail.com'; // Your Gmail address
        $mail->Password = 'nstv bdkl upyw lgni'; // Your Gmail App Password
        
        // Recipients
        $mail->setFrom('multihandservices@gmail.com', $from_name);
        $mail->addAddress($to);
        
        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        // Send the email silently
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: " . $e->getMessage());
        
        return false;
    }
}

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $service = sanitize_input($_POST['service']);
    $otherService = isset($_POST['otherService']) ? sanitize_input($_POST['otherService']) : '';
    $date = sanitize_input($_POST['date']);
    $time = sanitize_input($_POST['time']);
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = isset($_POST['address']) ? sanitize_input($_POST['address']) : '';
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

    $errors = [];
    if (empty($service)) $errors[] = "Service is required";
    if (empty($date)) $errors[] = "Date is required";
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !is_valid_email($email)) $errors[] = "Valid email is required";
    if (empty($phone) || !is_valid_phone($phone)) $errors[] = "Valid phone number is required";
    if (empty($address)) $errors[] = "Address is required";

    if (empty($errors)) {
        $email_content = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #FFFFFF; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #8FBC8F; border-radius: 8px; }
                .header { background-color: #2E8B57; color: #FFFFFF; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { padding: 20px; background-color: #FFFACD; }
                .detail { margin-bottom: 15px; padding: 10px; background-color: #FFFFFF; border-radius: 4px; }
                .label { font-weight: bold; color: #2E8B57; display: inline-block; width: 100px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'><h2>New Service Request</h2></div>
                <div class='content'>
                    <div class='detail'><span class='label'>Service:</span> " . ($service === 'other' ? $otherService : ucfirst($service)) . "</div>
                    <div class='detail'><span class='label'>Date:</span> " . $date . "</div>
                    <div class='detail'><span class='label'>Time:</span> " . $time . "</div>
                    <div class='detail'><span class='label'>Name:</span> " . $name . "</div>
                    <div class='detail'><span class='label'>Email:</span> " . $email . "</div>
                    <div class='detail'><span class='label'>Phone:</span> " . $phone . "</div>
                    <div class='detail'><span class='label'>Address:</span> " . nl2br($address) . "</div>
                    " . (!empty($message) ? "<div class='detail'><span class='label'>Message:</span><br>" . nl2br($message) . "</div>" : "") . "
                </div>
            </div>
        </body>
        </html>";

        if(send_email('multihandservices@gmail.com', "New Service Request from " . $name, $email_content)) {
            $customer_content = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #FFFFFF; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #8FBC8F; border-radius: 8px; }
                    .header { background-color: #2E8B57; color: #FFFFFF; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                    .content { padding: 20px; background-color: #FFFACD; }
                    .detail { margin-bottom: 15px; padding: 10px; background-color: #FFFFFF; border-radius: 4px; }
                    .highlight { color: #2E8B57; font-weight: bold; display: inline-block; width: 100px; }
                    .cta-button { display: inline-block; background-color: #FFD700; color: #333333; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 15px; }
                    .cta-button:hover { background-color: #2E8B57; color: #FFFFFF; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'><h2>Thank You for Your Request</h2></div>
                    <div class='content'>
                        <p>Dear " . $name . ",</p>
                        <p>Thank you for choosing Multi-Hand Services. We have received your service request and will contact you shortly to confirm the details.</p>
                        <div class='detail'>
                            <h3 style='color: #2E8B57;'>Your Request Details:</h3>
                            <p><span class='highlight'>Service:</span> " . ($service === 'other' ? $otherService : ucfirst($service)) . "</p>
                            <p><span class='highlight'>Date:</span> " . $date . "</p>
                            <p><span class='highlight'>Time:</span> " . $time . "</p>
                        </div>
                        <p>If you have any questions, please don't hesitate to contact us.</p>
                        <p>Best regards,<br><strong>Multi-Hand Services Team</strong></p>
                    </div>
                </div>
            </body>
            </html>";

            send_email($email, "We've Received Your Service Request", $customer_content);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Thank you! Your request has been sent successfully. We will contact you shortly.</div>'
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Sorry, there was an error sending your request. Please try again.</div>'
            ]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Please correct the following errors:</div>',
            'errors' => $errors
        ]);
    }
}
?>
