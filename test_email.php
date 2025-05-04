<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHP Version: " . phpversion() . "\n";
echo "OpenSSL installed: " . (extension_loaded('openssl') ? 'Yes' : 'No') . "\n";
if(extension_loaded('openssl')) {
    echo "OpenSSL version: " . OPENSSL_VERSION_TEXT . "\n";
}

require __DIR__ . '/process_form.php';

$test_subject = "Test Email";
$test_body = "<h1>Test Email</h1><p>This is a test email to verify the email sending functionality.</p>";
$test_to = "multihandservices@gmail.com";

try {
    if(send_email($test_to, $test_subject, $test_body)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Check error output above.";
    }
} catch (Exception $e) {
    echo "Exception caught: " . $e->getMessage() . "\n";
    echo "Stack trace: \n" . $e->getTraceAsString();
}
?>
