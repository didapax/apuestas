<?php

include "servermail.php";

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

sendBulkEmails($emails, $subject, $body);

?>