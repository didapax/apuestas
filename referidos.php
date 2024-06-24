<?php 
include "modulo.php";
if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){
?>
<html>
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
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
                width:90%;
                height: 500px;
                background: transparent;
                overflow-y: auto;
                overflow-x: hidden;
                padding:21px;
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
            
/*Menu*/            
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 8px 16px;
  text-decoration: none;
  font-size: 14px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

.topnav a.perfil {
  background-color: transparent;
  color: yellow;
  float: right;
  cursor:default;
}

.topnav a.saldo {
  background-color: transparent;
  color: white;
  float: right;
  cursor:default;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }

  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }  
  .topnav.responsive a.perfil {
    display: none;
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
                            $("#botonVer").css("display","none");
                        }
                        else{                            
                            $("#myInput").css("display","none");
                            $("#copyButton").css("display","none");
                        }
                    });
                }
            }

            function inicio(){
                leerDatos();
            }
            function guardar(){
                $.post("block",{
                    guardarWallet:"",
                    correo: document.getElementById("correo").value,
                    wallet: document.getElementById("wallet").value,
                    payeer: document.getElementById("payeer").value
                },function(data){
                    /*leerDatos();
                    document.getElementById('agregar').close();*/
                    window.location.href="referidos";
                });
            }

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
            }   
            
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("myInput");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);
                /* Alert the copied text
                alert("Copied the text: " + copyText.value);*/
            }            

        </script>
    </header>
    <body onload="inicio()">
        <div id="cabeza" class="cabeza">
        <marquee><?php verPromo(); ?></marquee>
        <?php 
                    echo "<div class=\"topnav\" id='myTopnav'>";
                    echo "<a href='index' >Home</a>";
                    echo "<a href='chat' >Chat</a>";
                    echo "<a href='miwallet'>Mi Wallet</a>";
                    echo "<a href='referidos' class='active'>Referidos</a>";
                    echo "<a href='historialcliente'>Historial</a>";
                    echo "<a href='ayuda'>Ayuda</a>";
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
                    echo "<a style='cursor:pointer;' href='miwallet' class='saldo' id='saldo'></a>";
                    echo "<a class='perfil'>".readClienteId($_SESSION['user'])['CORREO']."</a>";
                    echo "<a href=\"javascript:void(0);\" class='icon' onclick=\" myFunctionMenu();\"><i class='fa fa-bars'></i></a></div>";        
        
        ?>           
        </div>
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
        <dialog class="dialog_agregar" id="agregar" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>      
        <div id="cuerpo" class="cuerpo">
            <div style='padding:5px;'>
                <?php //statusPromocion(readClienteId($_SESSION['user'])['CORREO']); ?>
            </div>
            <div class="vista" id="vista">
                <div style='text-align: center;width:100%;display:inline-block;'>
		            <span style='font-size:2em; color:white;'>Programa de Referidos</span><br>
		            <span style='font-size:2em; color:white;'>Fortuna Royal</span><br>
		            <br>
		            <p>
		                Comparte tu Link y Por Cada Referido que Obtenga un Triunfo en el Juego,  tu ganas 0.5 USDT, cada estrella llena es un triunfo, Retira tu saldo cuando quieras, retiros minimos 10 USDT.
		            </p>
	            </div>
                <br>
                <div>
                    <br>
                    <label>Link de Referido: </label>
                    <button id="botonVer" type='button' onclick="$('#necesario').fadeIn()" >Ver Link de Referido</button>
                    <p style='display:none;' id='necesario'> Necesitas una wallet de Payeer para poder acceder al sistema de referido si ya tienes una has click <a style='color:blue;' onclick="showDialog()">Aqui</a>
                        Sino tienes una puedes abrirla muy facil desde estos link: <br>                        
                            <a target='_blanck' href='https://payeer.com/?session=5713319'>Abrir Cuenta Payeer</a>
                            Facil y Rapido sin complicaciones.
                            Aqui recibiras tus pagos por referidos.
 
                    </p>
                    <br>
                    <input id="myInput" style="width:90%;" type="text" readonly value="<?php echo "https://www.fortunaroyal.com/sesion?user=".readClienteId($_SESSION['user'])['CORREO']."&code=".readClienteId($_SESSION['user'])['CODIGOREFERIDO']?>">
                    <button id="copyButton" title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button>

                </div>
                <br>
                <label style='font-weight:bold; margin:0 0;display:block;'>Tus Referidos:</label>
                <hr>
                <?php
                    $estatus="";
                    $color="";
                    $cadena="";
                    $conexion = mysqli_connect($GLOBALS["servidor"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
                    $consulta = "SELECT * FROM REFERIDOS WHERE REFERENTE='".readClienteId($_SESSION['user'])['CODIGOREFERIDO']."' ORDER BY LOGROS DESC";
                    if($resultado = mysqli_query( $conexion, $consulta )){
                        while($row = mysqli_fetch_array($resultado)){
                                /*if(readReferido($row['REFERIDO'])['SALDO']>0){
                                    marcarValido($row['REFERIDO']);
                                    updateSaldoReferido($row['REFERENTE']);
                                    $estatus="Validado";
                                    $color="#A9EFA9;";			
                                }*/
                                $estatus=makeAnciEstrellas($row['LOGROS']);
                                $cadena= $cadena . "<br>".$estatus." ".readReferido($row['REFERIDO'])['CORREO'];
                        }
                    }
                    mysqli_close($conexion);
                    if(strlen($cadena)<1) echo "Vacio...";
                    else echo $cadena;
                    echo "<br>";
                ?>                
            </div>
        </div>
        <div id="pie" class="pie"><span>Copyring (c) 2022 Red Triangle Corporation</span></div>
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