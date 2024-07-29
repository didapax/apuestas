<?php
include "modulo.php";
?>
<html>
<head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
    </head>
    <header> 
        <style>

        </style>        
        <script>         

        </script>
    </header>
    <body>
    <?php $page = "ayuda"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->     

<div id="cuerpo" class="cuerpo" style="background-image:none; background:white; padding:5px; ">
<p>
<h2>QUIENES SOMOS: </h2>
<h3>NUESTRA HISTORIA:</h3>
FUNDADA  POR EXPERTOS INVERSORES CON 10 AÑOS DE EXPERIENCIA CONJUNTA EN EL SECTOR FINANCIERO, CRIPTOSIGNALGROUP SURGIÓ CON UNA VISIÓN CLARA Y DETERMINADA, GRACIAS A SU ENFOQUE INQUEBRANTABLE EN LA SATISFACCIÓN Y PROSPERIDAD DE SUS CLIENTES FINANCIEROS,  PROPORCIONANDO A INVERSORES, TRADERS ESPECIALIZADOS E INSTITUCIONES LAS HERRAMIENTAS ESENCIALES PARA OPERAR CON CONFIANZA. CRIPTOSIGNALGROUP SE RIGE POR NORMATIVAS RIGUROSAS, ASEGURANDO TRANSPARENCIA, SEGURIDAD Y PROFESIONALISMO EN TODOS SUS SERVICIOS. ADEMÁS, EL COMPROMISO DE CRIPTOSIGNALGROUP EN EL DINÁMICO ESCENARIO FINANCIERO ACTUAL SE ADAPTA Y RENUEVA CONSTANTEMENTE, MOTIVADO POR SU PASIÓN POR INNOVAR, OPTIMIZAR SUS PLATAFORMAS Y REALZAR LA EXPERIENCIA DEL CLIENTE. SU COMPROMISO CON OFRECER HERRAMIENTAS VITALES, EMPODERANDO A LOS INVERSORES PARA QUE TOMEN DECISIONES FUNDAMENTADAS Y CUMPLAN SUS OBJETIVOS FINANCIEROS.
</p>
</div>

       <!--Iniciar footer-->
       <?php include 'footer.php';?>
        <!--FIN footer-->            
<script>

function myFunctionMenu() {    
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
 
    </body>
</html>

