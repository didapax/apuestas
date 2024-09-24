<?php
//script de actualizacion de precios api-binance
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "modulo.php";
date_default_timezone_set('UTC');    

$emails = returnListaCorreos();
$subject = $body = "";

function sendBulkEmails($emails, $subject, $body) {
  $batchSize = 10; // Número de correos por lote
  $pause = 2; // Pausa en segundos entre lotes

  for ($i = 0; $i < count($emails); $i += $batchSize) {
    $batch = array_slice($emails, $i, $batchSize);
    foreach ($batch as $email) {
      $datos= row_sqlconector("SELECT * FROM LISTA WHERE CORREO='$email'");
      $subject = $datos['SUBJET'];
      $body = $datos['BODY'];
      sendEmail($email, $subject, $body); // Función para enviar un correo individual
      setEnviado($email,1);
    }
    sleep($pause);
  }
}

function sendEmail($to, $subject, $body) {
  // Configuración de PHPMailer
  $mail = new PHPMailer(true);
  try {
    $mail->isSMTP();
    $mail->Host = 'criptosignalgroup.online';
    $mail->SMTPAuth = true;
    $mail->Username = 'criptosignalgroup@criptosignalgroup.online';
    $mail->Password = 'T3JWeS($p([7';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 465;

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

/* Ejemplo de uso
$subject = "Análisis Semanal";
$body = "<p>Este es el análisis semanal...</p>";*/
sendBulkEmails($emails, $subject, $body);

//refreshDataAuto();

?>