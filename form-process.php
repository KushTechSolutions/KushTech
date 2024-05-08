<?php
// Check if the form fields are set and not empty
if (
    isset($_POST['fname']) && !empty($_POST['fname']) &&
    isset($_POST['lname']) && !empty($_POST['lname']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['phone']) && !empty($_POST['phone']) &&
    isset($_POST['subject']) && !empty($_POST['subject']) &&
    isset($_POST['message']) && !empty($_POST['message'])
) {
    // Sanitize input data to prevent SQL injection and other attacks
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare email message
    $to = "siddarthsid012@gmail.com"; // Change this to your desired email address
    $subject = "New Contact Form Submission: $subject";
    $message = "First Name: $fname\n"
             . "Last Name: $lname\n"
             . "Email: $email\n"
             . "Phone: $phone\n"
             . "Subject: $subject\n\n"
             . "Message:\n$message";

    // Send email
    if (mail($to, $subject, $message)) {
        // If email sent successfully, send a success response
        echo "success";
    } else {
        // If email failed to send, send an error response
        echo "Error: Unable to send email.";
    }
} else {
    // If any required field is missing or empty, send an error response
    echo "Error: All fields are required.";
}
?>
