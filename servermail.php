<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "modulo.php";

function sendEmailSoporte($to, $subject, $body) {
  // Configuración de PHPMailer
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host = 'server121.web-hosting.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'soporteadministrativo@criptosignalgroup.online';
    $mail->Password = 'F_M4Cth#YNEw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('soporteadministrativo@criptosignalgroup.online', 'Soporte Cryptosignal');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Soporte Error: {$mail->ErrorInfo}";
  }
}

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

    $mail->setFrom('criptosignalgroup@criptosignalgroup.online', 'Cryptosignal');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Cryptosignal Error: {$mail->ErrorInfo}";
  }
}

if(isset($_POST['getcodemail'])){
  $codigo = generaCode();
  $email = $_POST['email'];
  sqlconector("INSERT INTO LINKS (LINK,CORREO) VALUES('$codigo','$email')");
  sendEmail($email, "Codigo Crytosignal", "Copie este codigo: <br> $codigo <br>Generado por Cryptosignal para su seguridad no conteste este email.");  
}

if(isset($_POST['sendmailtecno'])){
  $cliente = $_POST['cliente'];
  $asunto = $_POST['asunto'];
  $mensaje = $_POST['mensaje'];
  $email = "crptsgnlgrpspprt@gmail.com";
  sendEmail($email, "Asistencia Crytosignal", "Tienes una Nueva asistencia para el Cliente:<br>$cliente<br>Asunto Tratado: $asunto<br> <u><b>Problema Presentado:</b></u> $mensaje <hr>Recuerda contestar desde el correo de soporte este mensaje es solo un recordatorio.");  
}

?>
