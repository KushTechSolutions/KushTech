<?php
// Check if the form fields are set and not empty
if (
    isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['subject'], $_POST['msg']) &&
    !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) &&
    !empty($_POST['phone']) && !empty($_POST['subject']) && !empty($_POST['msg'])
) {
    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("status" => "error", "message" => "Invalid email format."));
        exit;
    }

    // Validate phone number format (optional)
    // You can use regex or other methods to validate phone number format

    // Prepare email message
    $to = "siddarthsid012@gmail.com"; // Change this to your desired email address
    $subject = "New Contact Form Submission: " . htmlspecialchars($_POST['subject']);
    $message = "First Name: " . htmlspecialchars($_POST['fname']) . "\n"
             . "Last Name: " . htmlspecialchars($_POST['lname']) . "\n"
             . "Email: " . htmlspecialchars($_POST['email']) . "\n"
             . "Phone: " . htmlspecialchars($_POST['phone']) . "\n"
             . "Subject: " . htmlspecialchars($_POST['subject']) . "\n\n"
             . "Message:\n" . htmlspecialchars($_POST['msg']);

    // Send email
    if (mail($to, $subject, $message)) {
        // If email sent successfully, send a success response
        echo json_encode(array("status" => "success", "message" => "Email sent successfully."));
    } else {
        // If email failed to send, send an error response
        echo json_encode(array("status" => "error", "message" => "Unable to send email."));
    }
} else {
    // If any required field is missing or empty, send an error response
    echo json_encode(array("status" => "error", "message" => "All fields are required."));
}
?>
