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
                background: #16A085;              
                color:white;
                font-weight:bold;
                border-radius: 5px;
                z-index: 1000;
            } 


            .dialog_retirar{
                width:350px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #F4B581;              
                color:white;
                font-weight:bold;
                border-radius: 5px;
                z-index: 1000;
            } 

            .dialog_wallet{
                display:inline-block;
                padding:5px;
                margin:2px;
                width:360px;
                height: 250px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                background: #1B2224;              
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
function myFunction() {
                var copyText = document.getElementById("cajero");
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */
                navigator.clipboard.writeText(copyText.value);
            }

            function showDialog(){
                document.getElementById('agregar').show();
                document.getElementById("myTopnav").className = "topnav";
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

            function leerDatos(){
                if(document.getElementById("correo").value.length > 0){
                    $.post("block",{
                        getUsuario:"", 
                        correo: document.getElementById("correo").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("payeer").value = datos.payeer;
                        document.getElementById("wallet").value = datos.wallet;
                        document.getElementById("wallet_payeer").value = datos.payeer;
                        document.getElementById("wallet_usdt").value = datos.wallet;  
                        $("#saldo").html("Saldo "+datos.saldo+" USDT"); 

                        if(datos.wallet != null && datos.wallet.length > 0){
                            document.getElementById("wallet").readOnly = true;
                        }
                        if(datos.payeer != null && datos.payeer.length > 0){
                            document.getElementById("payeer").readOnly = true;
                        }                       
                    });
                }
            }

            function initsession(){
                window.location.href="sesion";
            }

            function selpago(){
                if($("#comopago").val() == "USDT"){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("emailCajero").value
                    },function(data){
                        var datos= JSON.parse(data);                        
                        document.getElementById("cantidad").min = 10;
                        document.getElementById("cantidad").value = 0;
                        document.getElementById("cajero").value = datos.wallet;
                        $("#info").html("USDT + Comision a la Wallet USDT TRC20:");
                        $("#detalles").css("display","inline-block")
                        document.getElementById('tipo').value = "Deposito USDT";
                    });
                }

                if($("#comopago").val() == "PAYEER"){
                    $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("emailCajero").value
                    },function(data){
                        var datos= JSON.parse(data);
                        document.getElementById("cantidad").min = 5;
                        document.getElementById("cantidad").value = 0;
                        document.getElementById("cajero").value = datos.payeer;
                        $("#info").html("USDT + Comision a la Cuenta de Payeer:");
                        $("#detalles").css("display","inline-block");
                        document.getElementById('tipo').value = "Deposito Payeer";
                    });
                }                
            }

            function selretiro(){
                if($("#como_retiro").val() == "USDT"){
                    if(document.getElementById("wallet").value.length >0){
                        $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("correo").value
                        },function(data){
                            var datos= JSON.parse(data);                        
                            document.getElementById("cantidad_retiro").min = 10;
                            document.getElementById("cantidad_retiro").value = 0;
                            $("#info_retiro").html("USDT - Comision a la Wallet USDT TRC20:");
                            $("#detalles_retiro").css("display","inline-block")
                            document.getElementById('tipo_retiro').value = "Retiro USDT";
                            document.getElementById("cajero_retiro").value = document.getElementById("wallet_usdt").value;
                        });
                    }
                    else{
                        alert("Debe Tener una wallet USDT Para los retiros..!");
                    }
                }

                if($("#como_retiro").val() == "PAYEER"){
                    if(document.getElementById("payeer").value.length >0){
                        $.post("block",{
                        getUsuario:"",
                        correo: document.getElementById("correo").value
                        },function(data){
                            var datos= JSON.parse(data);
                            document.getElementById("cantidad_retiro").min = 10;
                            document.getElementById("cantidad_retiro").value = 0;
                            $("#info_retiro").html("USDT - Comision a la Cuenta de Payeer:");
                            $("#detalles_retiro").css("display","inline-block");
                            document.getElementById('tipo_retiro').value = "Retiro Payeer";
                            document.getElementById("cajero_retiro").value = document.getElementById("wallet_payeer").value;
                        });
                    }
                    else{
                        alert("Debe Tener una wallet Payeer Para los retiros..!");
                    }
                }                
            }

            function retirar_back(){
                if($("#como_retiro").val() == "USDT" && (document.getElementById("cantidad_retiro").value*1) > 9){
                    if((document.getElementById("tsaldo").value*1) >= (document.getElementById("cantidad_retiro").value*1)){
                        retirar();
                    }
                    else{
                        alert("saldo insuficiente");
                    }
                }                
                else if($("#como_retiro").val() == "PAYEER" && document.getElementById("cantidad_retiro").value > 9){
                    if((document.getElementById("tsaldo").value*1) >= (document.getElementById("cantidad_retiro").value*1)){
                        retirar();
                    }
                    else{
                        alert("saldo insuficiente");
                    }
                }
                else{
                    alert("Retiros Minimos USDT 10");
                }          
            }


            function jugar_back(){
                if($("#comopago").val() == "USDT" && document.getElementById("cantidad").value > 9){
                    lanzar();
                }                
                else if($("#comopago").val() == "PAYEER" && document.getElementById("cantidad").value > 4){
                    lanzar();
                }
                else{
                    alert("Depositos o Recargas Minimos en Payeer 5 y USDT 10");
                }          
            }

            function retirar(){
                if(document.getElementById("cantidad_retiro").value.length>0 && document.getElementById("como_retiro").value.length>0){
                    document.getElementById("retirar_btn").disabled = true;
                $.post("block",{
                        retirar:"",
                        cantidad: document.getElementById("cantidad_retiro").value -1,
                        tipo: document.getElementById("tipo_retiro").value,
                        comopago: document.getElementById("como_retiro").value,
                        wallet_usdt: document.getElementById("wallet_usdt").value,
                        wallet_payeer: document.getElementById("wallet_payeer").value,
                        correo: document.getElementById("correo").value,
                    },function(data){
                        document.getElementById('retirar').close();
                        document.getElementById("retirar_btn").disabled = false;
                        if(data.length>0){
                            alert(data);
                            document.getElementById("retirar_btn").disabled = false;
                        }
                        window.location.href="historialcliente";
                    });  
                }else{
                    alert("No hay Retiro a Realizar...");
                }         
            }

            function lanzar(){
                if(document.getElementById("cantidad").value.length>0 && document.getElementById("comopago").value.length>0){
                    document.getElementById("jugar").disabled = true;
                $.post("block",{
                        depositar:"",
                        nota: document.getElementById("nota").value,
                        cantidad: document.getElementById("cantidad").value,
                        tipo: document.getElementById("tipo").value,
                        comopago: document.getElementById("comopago").value,
                        cajero: document.getElementById("cajero").value,
                        correo: document.getElementById("correo").value,
                    },function(data){
                        document.getElementById('jugada').close();
                        document.getElementById("jugar").disabled = false;
                        if(data.length>0){
                            alert(data);
                            document.getElementById("jugar").disabled = false;
                        }
                        window.location.href="historialcliente";
                    });  
                }else{
                    alert("No hay Deposito a Realizar...");
                }         
            }

            function calculo_retiro(){
                var ganancia=0;
                ganancia = document.getElementById("cantidad_retiro").value -1;
                if($("#desafiox1_5").val() == 1){
                    ganancia = document.getElementById("cantidad_retiro").value -1;
                }
                if($("#desafiox3").val() == 1){
                    ganancia = document.getElementById("cantidad_retiro").value -1;
                }                
                if($("#desafiox4").val() == 1){
                    ganancia = document.getElementById("cantidad_retiro").value -1;
                }                
                $("#calculo_retiro").html("Usted Recibe: "+ ganancia + "USDT");                
                $("#apuesta_retiro").html(document.getElementById("cantidad_retiro").value -1);
            }

            function calculo(){
                var ganancia=0;
                ganancia = document.getElementById("cantidad").value *1;
                if($("#desafiox1_5").val() == 1){
                    ganancia = document.getElementById("cantidad").value *1;
                }
                if($("#desafiox3").val() == 1){
                    ganancia = document.getElementById("cantidad").value *1;
                }                
                if($("#desafiox4").val() == 1){
                    ganancia = document.getElementById("cantidad").value *1;
                }                
                $("#calculo").html("Usted Deposita: "+ ganancia + "USDT");                
                $("#apuesta").html(document.getElementById("cantidad").value);
            }
             
             function inicio(){
                leerDatos();
                myVar = setInterval(leerHistorial, 3000);
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
                    echo "<a href='#' class='active'>Mi Wallet</a>";
                    echo "<a href='referidos'>Referidos</a>";
                    echo "<a href='historialcliente'>Historial</a>";
                    echo "<a href='ayuda'>Ayuda</a>";
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
                    echo "<a style='cursor:pointer;' href='miwallet' class='saldo' id='saldo'></a>";
                    echo "<a class='perfil'>".readClienteId($_SESSION['user'])['CORREO']."</a>";
                    echo "<a href=\"javascript:void(0);\" class='icon' onclick=\" myFunctionMenu();\"><i class='fa fa-bars'></i></a></div>";        
        
        ?>
        </div>
        <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
    
        <div id="cuerpo" class="cuerpo">

        <dialog class="dialog_agregar" id="jugada" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('jugada').close()">X</a><br>
            <form method="post" action="miwallet">
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['SALDO']; ?>" name="tsaldo" id="tsaldo">
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" name="emailCajero" id="emailCajero" value="khorazi57@gmail.com">
                <input type="hidden" name="wallet_usdt" id="wallet_usdt">
                <input type="hidden" name="wallet_payeer" id="wallet_payeer">
                <input hidden type="text" id="tipo" name="tipo"><br>
                Como Vas a Pagar: <select required onchange="selpago()" name="comopago" id="comopago"><option id="comopago_back" value=""></option><option value="USDT">USDT Tron Trc20</option><option value="PAYEER">Payeer</option></select>
                <div id="detalles" style="display:none;">
                    Cantidad a Depositar: <input required type="number" name="cantidad" id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" min="10" max="50" step="1"><br>
                    <div id="calculo" style="color:green;float:right; background:white;padding:3px; border-radius:3px;"></div><br>
                    Envia <span id="apuesta"></span><span id="info"></span>
                    <input readonly class="datcajero" style="" id="cajero">
                    <button title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button>
                    <br>
                    Coloca la Nota Id (txid) de la transferencia realizada:<br>
                    <input required type="text" id="nota" name="nota">
                </div><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;" type="button" id="jugar" name="jugar">Depositar</button>
            </form>
        </dialog>

        <dialog class="dialog_retirar" id="retirar" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('retirar').close()">X</a><br>
            <form method="post" action="miwallet">
                <input hidden type="text" id="tipo_retiro" name="tipo_retiro"><br>
                Retirar con: <select required onchange="selretiro()" name="como_retiro" id="como_retiro"><option id="comopago_back" value=""></option><option value="USDT">USDT Tron Trc20</option><option value="PAYEER">Payeer</option></select>
                <div id="detalles_retiro" style="display:none;">
                    Cantidad a Retirar: <input required type="number" name="cantidad_retiro" id="cantidad_retiro" onkeyup="calculo_retiro()" onchange="calculo_retiro()" value="0" min="10"  step="1"><br>
                    <div id="calculo_retiro" style="color:green;float:right; background:white;padding:3px; border-radius:3px;"></div><br><br>
                    Recibe <span id="apuesta_retiro"></span><span id="info_retiro"></span>
                    <input readonly class="datcajero" style="" id="cajero_retiro">                    
                    <br>
                </div><br>
                <button onclick="retirar_back()" class='appbtn' style="float:right;" type="button" id="retirar_btn" name="retirar_btn">Retirar</button>
            </form>
        </dialog>

            <br>
            <div id="saldo"></div>
            <button onclick="document.getElementById('jugada').show();">Depositar</button>
            <button onclick="document.getElementById('retirar').show();">Retirar</button>
            <hr>
        <div class="vista" id="vista">
        <div class="dialog_wallet" id="agregar">                                   
            Esta Direccion sera Utlizada para los pagos de tus premios y Retiros, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br><br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </div> 
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