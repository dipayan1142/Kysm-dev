<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require(__DIR__ . '/../../PHPMailer/src/Exception.php');
require(__DIR__ . '/../../PHPMailer/src/PHPMailer.php');
require(__DIR__ . '/../../PHPMailer/src/SMTP.php');

class Mailer
{
  public static function sendMail($email, $subject, $text)
  {
    try {
      $mail = new PHPMailer;
      $mail->isSMTP();                                  // Set mailer to use SMTP
      $mail->Host = getenv('MAIL_HOST');               // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                         // Enable SMTP authentication
      $mail->Username = getenv('MAIL_USERNAME');      // SMTP username
      $mail->Password = getenv('MAIL_PASSWORD');            // SMTP password
      $mail->Port = getenv('MAIL_PORT');                              // TCP port to connect to
      $mail->SMTPSecure = 'tls';

      $mail->setFrom(getenv('MAIL_USERNAME'), "Magic Moments Admin");
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $text;

      if (!$mail->send()) {
        return $mail->ErrorInfo;
      } else {
        return "Message sent!";
      }
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
