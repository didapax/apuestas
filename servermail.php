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
    
     // Caracteres y codificacion
    $mail->CharSet = 'UTF-8';

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
    
    // Caracteres y codificacion
    $mail->CharSet = 'UTF-8';    

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
  
  $asunto = utf8_encode($asunto);
  $mensaje = utf8_encode($mensaje);
  $email = "crptsgnlgrpspprt@gmail.com";
  
  sendEmail($email, "Asistencia Crytosignal", "Tienes una Nueva asistencia para el Cliente:<br>$cliente<br>Asunto Tratado: $asunto<br> <u><b>Problema Presentado:</b></u> $mensaje <hr>Recuerda contestar desde el correo de soporte este mensaje es solo un recordatorio.");  
}

function recalcularEtf() {
  $url = $GLOBALS['SERVER'] . "?getprices";
  $data = consultarServidor($url, $GLOBALS['LLAVE']);

  if ($data !== null && $data['estatus'] === true) {
      foreach ($data['prices'] as $item) {
          switch ($item['MONEDA']) {
              case 'BTCUSDT':
                  sqlconector("UPDATE DATOS SET PRECIO={$item['ACTUAL']} WHERE MONEDA='BTCUSDC'");
                  break;
              case 'ETHUSDT':
                  sqlconector("UPDATE DATOS SET PRECIO={$item['ACTUAL']} WHERE MONEDA='ETHUSDC'");
                  break;          
          }
      }
  } else {
      echo "No se pudo obtener los precios.";
  }
}


function recalcularSuscripciones($correo){
  $resultado = sqlconector("SELECT * FROM LIBROCONTABLE WHERE CLIENTE='$correo' AND PAGADO=0 AND ACTIVO=1");
  if($resultado){
    while ($row = mysqli_fetch_assoc($resultado)) {
      $inversion = $row['INVERSION'];
      $devuelveCapital = $row['DEVUELVE_CAPITAL'];
      $interes_adelantado = $row['INTERES_ADELANTADO'];
      $capital = $row['MONTO'];
      $interes = $row['INTERES_MENSUAL'];
      $saldo = readCliente($row['CLIENTE'])['SALDO'];
      $dia_actual = date("Y-m-d");
      $vencimiento = $row['FECHA'];
      $ticket = $row['TICKET'];
      $cliente = $row['CLIENTE'];
      $suscripcion = readApuestaTicket($ticket);
      $n_pagos = $suscripcion['N_PAGOS'];
      $id_ticket = 0;

      if($inversion==1){
        if($interes_adelantado == 1){
          //la logica si tiene interes adelantado
          if($vencimiento <= $dia_actual){
            //calcula el id actual a menejar
            $id_ticket = $row["ID"];

            if($n_pagos > 1){
              $valor = $n_pagos - 1;
              sqlconector("UPDATE APUESTAS SET N_PAGOS=$valor WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
            else{
              $saldo = readCliente($cliente)['SALDO'] + $capital;
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
              //se le avisa al cliente de la devolucion de su capital
              sendEmail($cliente, "Devolucion de Capital", "Se le informa que su tarjeta de inversion con intereses adelantado ha expirado y se le ha devuelto su capital, gracias por preferirnos");
              sqlconector("UPDATE APUESTAS SET PAGADOS=1, ACTIVO=0, ELIMINADO=1,ESTATUS='CERRADO' WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
          }
        }
        else{
          //la logica si es solo una inversion
          if($vencimiento <= $dia_actual){
            //calcula el id actual a menejar
            $id_ticket = $row["ID"];
            if($n_pagos > 1){
              $saldo = readCliente($cliente)['SALDO'] + $interes;
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
              sendEmail($cliente, "Pago de Intereses", "Se le informa que ha recibido intereses ({$interes} USDC) por su inversion, puede retirarlos cuando usted quiera, gracias por preferirnos");
              $valor = $n_pagos - 1;
              sqlconector("UPDATE APUESTAS SET N_PAGOS=$valor WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            }
            else{
              if($devuelveCapital == 0){
                $saldo = readCliente($cliente)['SALDO'] + $interes;
                sendEmail($cliente, "Pago de Intereses", "Se le informa que su tarjeta de inversion con intereses ha expirado y se le ha abonado sus intereses ({$interes} USDC), gracias por preferirnos lo esperamos nuevamente");
              }
              else{
                $saldo = readCliente($cliente)['SALDO'] + $capital + $interes;
                sendEmail($cliente, "Devolucion de Capital+interes", "Se le informa que su tarjeta de inversion con intereses ha expirado y se le ha devuelto su capital + intereses, gracias por preferirnos lo esperamos nuevamente");
              }              
              sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
              sqlconector("UPDATE APUESTAS SET PAGADOS=1, ACTIVO=0, ELIMINADO=1,ESTATUS='CERRADO' WHERE TICKET='$ticket'");
              sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");              
            }
          }
        }
      }
      else{
        //La logica si es una suscripcion
        if($vencimiento <= $dia_actual){
          //calcula el id actual a menejar
          $id_ticket = $row["ID"];
          if(readCliente($cliente)['SALDO'] >= $capital){
            $idJuego = $row['IDJUEGO'];
            $juego = $row['JUEGO'];
            $cajero =$row['CAJERO'];
            $saldo = readCliente($cliente)['SALDO'] - $capital;
            sendEmail($cliente, "Renovamos su Suscripcion", "Se le informa que su tarjeta de suscripcion  ha sido Renovada, gracias por preferirnos");
            sqlconector("UPDATE USUARIOS SET SALDO=$saldo WHERE CORREO='$cliente'");
            sqlconector("UPDATE LIBROCONTABLE SET PAGADO=1,ACTIVO=0,ESTATUS='CERRADO' WHERE ID=$id_ticket AND CLIENTE='$cliente'");
            $fechaFinal = calcularFechaDespuesDeUnMes($dia_actual,$n_pagos);
            sqlconector("UPDATE APUESTAS SET FIN='$fechaFinal',ESTATUS='RENOVADO'  WHERE TICKET='$ticket' ");
            sqlconector("INSERT INTO LIBROCONTABLE(FECHA,TICKET,TIPO,IDJUEGO,INVERSION,JUEGO,CAJERO,CLIENTE,INTERES_ADELANTADO,MONTO,INTERES_MENSUAL,CUOTA_MENSUAL,TOTAL_PAGAR) VALUES(
              '$fechaFinal',
              '$ticket',
              'DEBITO',
               $idJuego,
               0,
              '$juego',
              '$cajero',
              '$correo',
               0,
               $capital,
               0,
               $capital,
               $capital
              )");            
          }else{
            sqlconector("UPDATE APUESTAS SET ACTIVO=0, ESTATUS='NO PAGO' WHERE TICKET='$ticket'");
            sendEmail($cliente, "Suscripcion Expirada", "Se le informa que su tarjeta de suscripcion  ha expirado por falta de saldo, si desea renovarla recargue saldo y haga Click al boton de Renovar..");
          }     
        }
      }

    }
  }
}
