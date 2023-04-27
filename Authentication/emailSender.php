<?php
session_start();

use Google\Service\AIPlatformNotebooks\Location;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$mail = new PHPMailer(true);

try {

    //generate random number
    $random_number = random_int(100000, 999999);

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;

    // Set the hostname of the mail server
    $mail->Host = 'smtp.office365.com';

    // Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    // Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    // Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    // SMTP username
    //$mail->Username = 'daniel_rakipllari.fshnstudent@unitir.edu.al';
    $mail->Username = 'onlineclothingstore02@outlook.com';

    // SMTP password
    $mail->Password = 'BalenamoD01';

    // Set who the message is to be sent from
    $mail->setFrom('onlineclothingstore02@outlook.com', 'Your Name');

    // Set an alternative reply-to address
    // $mail->addReplyTo('replyto@example.com', 'First Last');

    // Set who the message is to be sent to
    $mail->addAddress('onlineclothingstore02@outlook.com');

    // Set the subject line
    $mail->Subject = 'User email configuration';

    // Read an HTML message body from an external file, convert referenced images to embedded,
    // convert HTML into a basic plain-text alternative body
    $mail->isHTML(true);
    $mail->Body = 'Dear, Thank you for signing up for our service! To complete your user account setup, please click on the following link to configure your email settings: <a href="http://localhost:3000/Authentication/confirm.php?code=' . $random_number . '">Confirm Email</a>';
    // Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    //session_start();
    $_SESSION['code'] = $random_number;
    // Attach an image file

    // Send the message
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
