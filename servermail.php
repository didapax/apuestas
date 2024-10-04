<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "modulo.php";

function sendEmail($to, $subject, $body) {
  // Configuración de PHPMailer
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host = 'server121.web-hosting.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'criptosignalgroup@criptosignalgroup.online';
    $mail->Password = 'JRnc^YaDj@la';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('criptosignalgroup@criptosignalgroup.online', 'Mailer');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

if(isset($_POST['getcodemail'])){
  $codigo = generaCode();
  $email = $_POST['email'];
  sqlconector("INSERT INTO LINKS (LINK,CORREO) VALUES('$codigo','$email')");
  sendEmail($email, "Codigo Crytosignal", "Copie este codigo: <br> $codigo <br>Generado por Cryptosignal para su seguridad no conteste este email.");  
}

?>