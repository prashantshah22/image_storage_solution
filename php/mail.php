<?php
require __DIR__ . '/../vendor/autoload.php'; // Adjusted path

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendActivationEmail($toEmail, $authCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.prashantshah.info.np'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@prashantshah.info.np'; 
        $mail->Password = 'ravi.sah22'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('no-reply@prashantshah.info.np', 'IMAGE Storage Solution');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'IMAGE Storage Solution Activation Code';
        $mail->Body = "Your activation code: '<b><i>$authCode </i></b>'"; 

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false; 
    }
}
?>
