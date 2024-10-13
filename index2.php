<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');    
?>

<html style="overflow: scroll;" lang="es">
    <head>
        <title>CriptoSignalGroup</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="Assets/favicon.png">        
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="css/newStyles.css">
        <link href='css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="Javascript/SweetAlert/slert2.min.css" />        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>        
        <script src="Javascript/SweetAlert/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
        <link rel="stylesheet" href="index-assets/css/normalize.min.css">
    <link rel="stylesheet" href="index-assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="index-assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="index-assets/css/flexslider.css">
    <link rel="stylesheet" href="index-assets/css/styles.css">
    <link rel="stylesheet" href="index-assets/css/queries.css">
    <link rel="stylesheet" href="index-assets/css/etline-font.css">
    <link rel="stylesheet" href="index-assets/bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="index-assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
        <style>
            @font-face {
                font-family: impact;
                src: url(./css/impact.ttf);
            }

            @font-face {
                font-family: futurist;
                src: url(./css/fonts/futurist.otf);
            }

            body{
                background:black;
            }

        </style>        

        <body onload='inicio()'>   

        <?php $page = "home"; ?>

        <!--Iniciar Barra de Navegación @media 1200px-->
        <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->        

            <?php
                $correo = "";
                $saldo = "0.00";

                if(isset($_SESSION['user']) && isset($_SESSION['secured'])){
                    $correo = readClienteId($_SESSION['user'])['CORREO'];
                    $saldo = readClienteId($_SESSION['user'])['SALDO'];
                    recalcularSuscripciones($correo);
                    //refreshDataAuto();
                    promoFlotante();
                }
            ?>
            <div id="cuerpo" class="cuerpo" style='margin-top: 8rem;'>
                    <input type="hidden" id="actualsaldo" value="<?php echo $saldo;?>">
                    <input type="hidden" id="correo" value="<?php echo $correo;?>" > 
                    <div id="vista" class='outerCard-container'></div>
            </div>
            
        <!--Iniciar footer-->
        <?php include 'footer.php';?>
            <!--FIN footer-->     
            <script src="Javascript/index.js"></script>
            <script defer>
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