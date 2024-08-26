<?php
include "modulo.php";
?>
<html>
<head>
    <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/Common.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>       
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
    </head>
    <header>  
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align:justify;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            margin-bottom: 15px;
            color: #555;
        }
    </style>       
        <script>         

        </script>
    </header>
    <body>
    <?php $page = "ayuda"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->     

        <div id="cuerpo" class="cuerpo" style="margin-top: 8rem; overflow-x: hidden; padding:10%; min-height: calc(100vh - 24rem);">
        <div class="container">
        <h1>Términos de Servicio</h1>
        <p>En estos Términos de Servicio, "usted" o "su" se refiere a la persona que utiliza los servicios (como se definen a continuación). Además de los Términos de Servicio, su uso de los servicios está estrictamente sujeto a todas las políticas adicionales que incluyen, entre otras, conflictos de intereses, política de categorización de clientes, declaración de divulgación de riesgos, manejo de quejas, y cualquier otra disposición y política que la compañía pueda publicar en el sitio web de vez en cuando, según se actualice periódicamente o en cualquier otro soporte duradero (colectivamente, las “Reglas Adicionales”). Los Términos de Servicio, junto con las Reglas Adicionales y la Política de Privacidad (juntos, el "Acuerdo de Usuario"), se consideran parte integral del presente y constituyen un documento legal vinculante entre usted y la compañía.</p>
        <p>Al hacer clic en 'Aceptar', 'Acepto' o 'Continuar', según sea el caso, o al registrarse en la compañía o al utilizar o acceder a los servicios, usted confirma que ha leído y comprendido el Acuerdo de Usuario y acepta estar sujeto a los términos del Acuerdo de Usuario, y que usted expresamente nos autoriza a proporcionarle los servicios. Como tal, el Acuerdo de Usuario constituye un acuerdo entre usted y nosotros y deberá regir su uso de los servicios en todo momento. Si no está de acuerdo con alguna de las disposiciones del Acuerdo de Usuario, debe dejar de utilizar inmediatamente los servicios y cancelar su cuenta con nosotros.</p>
        <p>Usted reconoce y acepta que al hacer clic en el botón 'Aceptar' o botones o enlaces similares que puedan ser designados por la compañía para mostrar su aprobación de cualquier texto anterior, el uso de los servicios (como se define a continuación), usted está celebrando un contrato legalmente vinculante. Por la presente, usted acepta el uso de comunicación electrónica con el fin de celebrar contratos, realizar pedidos y otros registros, y a la entrega electrónica de avisos, políticas y registros de transacciones iniciadas o completadas a través de nuestros sitios web, aplicaciones y plataformas. Además, por la presente, usted renuncia a cualquier derecho o requisito en virtud de cualquier ley o reglamento en cualquier jurisdicción que requiera una firma original (no electrónica) o entrega o retención de registros no electrónicos, en la medida permitida por la ley imperativa aplicable.</p>
        <p>El acuerdo contiene los mismos derechos, obligaciones y responsabilidades que un contrato debidamente firmado. Nos reservamos el derecho de suspender, modificar, eliminar o agregar los servicios en cualquier momento y sin previo aviso. Si tiene objeciones a los términos y condiciones aquí estipulados, no utilice nuestros sitios web y plataformas comerciales de ninguna forma. Descargar, instalar y su acceso y uso de este sitio web y nuestras aplicaciones y plataformas operativas constituye su aceptación de estos Términos y condiciones y cualquier otro aviso y declaración legal contenido en este sitio web, nuestras plataformas y/o nuestras aplicaciones.</p>
    </div>
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

