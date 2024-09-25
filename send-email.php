<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $adults = $_POST['adults'];
    $kids = $_POST['kids'];
    $contact = $_POST['contact'];
    $special_request = $_POST['special_request'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';
        $mail->Password = 'your-app-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Your Name');
        $mail->addAddress('recipient-email@example.com');

        $mail->isHTML(true);
        $mail->Subject = 'New Booking Request';
        $mail->Body = "
            <h3>Booking Details</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Destination:</strong> $destination</p>
            <p><strong>Travel Date:</strong> $travel_date</p>
            <p><strong>Number of Adults:</strong> $adults</p>
            <p><strong>Number of Kids:</strong> $kids</p>
            <p><strong>Contact No:</strong> $contact</p>
            <p><strong>Special Request:</strong> $special_request</p>
        ";

        $mail->send();
        
        // Redirect to thank you page after successful submission
        header("Location: thankyou.php");
        exit();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
