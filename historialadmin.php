<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" type="text/css" href="css/Common.css">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <header>
        <style>
        
        </style>        
        <script>

            function leerHistorial(){
                $.get("block?readHistorialAdmin=&cliente="+document.getElementById('correo').value, function(data){
                $("#vista").html(data);
                });
            }

            function inicio(){
                leerHistorial();
                myVar = setInterval(leerHistorial, 3000);
            }

        </script>
    </header>
    <body onload="inicio()">

    <?php $page = "histadmin"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->   

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo" style="background-image:none; background:white;"> 
            <div style='padding:5px;'>
                <?php statusPromocion(readClienteId($_SESSION['user'])['CORREO']); ?>
            </div>
            <hr>
        <div class="vista" id="vista"></div>
        </div>
              <!--Iniciar footer-->
      <?php include 'footer.php';?>
        <!--FIN footer-->     
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>