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
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <header>
        <style>

            html, body {
                margin: 0;
                background: #f0f0f5;
                width: 100%;
            }            
            /* width */
            ::-webkit-scrollbar {
            width: 5px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            background: #263238;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #263238;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #263238;
            }            
            .cabeza{
                width:100%;
                height: 55px;    
                text-align:right;    
                background: #111111;
                font-weight:bold;       
                
            }

            .cabeza a{
                color: white; 
            }
            .cuerpo{
                width:100%;
                height: 500px;
                background: transparent;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .menu{
                width:98%;
                height: 20px;
                background: gray;
                overflow-y: hidden;
                overflow-x: hidden;
                padding:8px;
            }

            .vista{
                width:100%;
                height: 440px;
                background: transparent;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .pie{
                width:100%;
                height: 13px;
                text-align:center;
            }
            button{

            }
            a{
                padding:3px;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
            }

            a:hover{
                text-decoration:underline;
            }
            .dialog_agregar{
                width:350px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #c1cae0;
                border-radius: 5px;
                z-index: 1000;
            }

            input[type="text"]{
                padding: 5px;
                font-size: 13px;
                width: 60%;
                margin:5px;
            }   
            
            @media (max-width: 600px) {
                input[type="number"] {
                    margin: 3px;
                    border-radius: 3px;
                    border: 0;
                    padding: 3px;
                    font-size: 11px;
                }

                table{
                    width: 100%;
                    font-size: 11px;
                }

                a{
                    font-size:15px;
                }
            }         
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
        <div id="cabeza" class="cabeza">
            <a href='index'>Home</a>
            <a href='historialadmin'>Historial</a>            
            <a href='trabajos'>Trabajos</a>
            <a href='jugadas'>Jugadas</a>
            <a href='promo'>Promociones</a>
            <a href='block?cerrarSesion'>Cerrar Sesion</a>
        </div>
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <div id="cuerpo" class="cuerpo">
            <div style='padding:5px;'>
                <?php statusPromocion(readClienteId($_SESSION['user'])['CORREO']); ?>
            </div>
            <hr>
        <div class="vista" id="vista"></div>
        </div>
        <div id="pie" class="pie"><span>Copyring (c) 2022 Red Triangle Corporation</span></div>
    </body>
</html>

<?php
}
else{
    header("Location: index.php");
}
?>