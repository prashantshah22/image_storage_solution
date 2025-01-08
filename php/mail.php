<?php
require __DIR__ . '/../vendor/autoload.php'; // Adjusted path

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendActivationEmail($toEmail, $authCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.a.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'a@a.com'; 
        $mail->Password = 'a@a.com'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('a@a.com', 'IMAGE Storage Solution');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'IMAGE Storage Solution Activation Code';
        $mail->Body = "Your activation code: <b><i>$authCode </i></b>"; 

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false; 
    }
}
?>
