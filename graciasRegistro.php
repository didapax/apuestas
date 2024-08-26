<?php
    include "modulo.php";

    $correo = $_GET['correo'];
    $vkey = $_GET['vkey'];
    $para = $correo;
    $asunto = "Verificación de correo electrónico";
    $mensaje = "<a href='http://criptosignalgroup.online/verificarEmail?vkey=$vkey'>Verificar Cuenta</a>";
    $cabeceras = "From: criptosignalgroup@criptosignalgroup.online \r\n";
    $cabeceras .= "MIME-Version: 1.0" . "\r\n";
    $cabeceras .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($para, $asunto, $mensaje, $cabeceras);
?>

<!DOCTYPE html>
<html lang="en-MU">
    <head>
        <meta charset="utf-8">
        <title>CriptoSigals | GRACIAS</title>
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--CSS File-->
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link rel="stylesheet" type="text/css" href="css/Account.css">
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
        <!--BOXICONS-->
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <!-- Animate CSS -->
        <link rel="stylesheet"href="css/animate.min.css"/>
    </head>

    <body>
           <div class="mail-sent-group">
            <div class="mail-sent-container">
                <div class="mail-sent-image-container">
                    <div class="mail-sent-image"></div>
                </div>

                <div class="mail-sent-text">
                    <h1>Gracias por Unirte!</h1>
                    <span class="message">Un Email de Verificación ha sido enviado. Entra a tu correo.</span>
                    <br><br>
                    <span class="tip">Tip: Si no has recibido el email, busca en tu carpeta de SPAM o eliminados.</span>
                    <br><br>
                    <a href="index" class="add-button" style="text-decoration:none;">Continuar</a>
                </div>
            </div>
        </div>
    </body>
</html>