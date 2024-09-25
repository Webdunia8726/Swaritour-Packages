<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // PHPMailer autoload file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // PHPMailer object
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your Gmail address
        $mail->Password = 'your-app-password'; // Your Gmail app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email sender and recipient
        $mail->setFrom($email, $name); // Sender email and name
        $mail->addAddress('recipient-email@example.com');   // Recipient email address

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h3>Contact Details</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send the email
        $mail->send();

        // Redirect to thank you page after successful submission
        header("Location: thankyou.php");
        exit();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
