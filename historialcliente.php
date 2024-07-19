<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){
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
        <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">         
    </head>
    <header>
        <style>

            html, body {
                margin: 0;
                width: 100%;
                background-image: url('balon.png');
                background-repeat: no-repeat;
                background-size: cover;       
                color:white;
                font-weight:bold; 
                font-family: Arial, Helvetica, sans-serif;                                            
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
                background: #333;
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
                /*background: #c1cae0;*/
                background-image: url('balon.png');
                background-repeat: no-repeat;
                background-size: cover;                 
                color:white;
                font-weight:bold;
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
            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);
                        $("#saldo").html("Saldo "+datos.saldo+" USDT");   
                        document.getElementById("payeer").value = datos.payeer;
                        document.getElementById("wallet").value = datos.wallet;
                        if(datos.wallet != null && datos.wallet.length > 0){
                            document.getElementById("wallet").readOnly = true;
                        }
                        if(datos.payeer != null && datos.payeer.length > 0){
                            document.getElementById("payeer").readOnly = true;
                        }
                    });
                }
            }

            function leerHistorial(){
                $.get("block?readHistorial=&cliente="+document.getElementById('correo').value, function(data){
                $("#vista").html(data);
                });
            }

            function inicio(){
                leerDatos();
                leerHistorial();
                myVar = setInterval(leerHistorial, 3000);
            }
            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,
                    wallet: document.getElementById("wallet").value,
                    payeer: document.getElementById("payeer").value
                },function(data){
                    leerDatos();
                    document.getElementById('agregar').close();
                });
            }

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
            }              

        </script>
    </header>
    <body onload="inicio()">
    <?php $page = "histcliente"; ?>
      <!--Iniciar Barra de Navegación @media 1200px-->
      <?php include 'barraNavegacion.php';?>
        <!--FIN Barra de Navegación @media 1200px-->  

        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <dialog class="dialog_agregar" id="agregar" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>      
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

<?php
}
else{
    header("Location: index.php");
}
?>