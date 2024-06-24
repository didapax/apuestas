<!DOCTYPE html>
<?php
    include "modulo.php";
    date_default_timezone_set('America/Caracas');
?>
<html style="overflow: scroll;">
    <head>
        <title>Fortuna Royal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0" />
        <link rel="shortcut icon" href="favicon.png">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <header>
        <style>
            input[type="text"]{
                margin-top: 5px;
                padding: 8px;
                font-size: 13px;
                width: 60%;
                margin:5px;
            }

            input[type="number"]{
                padding: 5px;
                font-size: 13px;
                width: 100px;
                margin:5px;
            }

            select{
                margin-top:3px;
                padding: 3px;
                width: 300px;
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

            marquee{
                background: #333;
                /*opacity: 0.8;*/
                color: white; 
                font-weight:bold;   
                text-transform: uppercase;
                font-family: 'Courier New', Courier, monospace;
            }
            .cuerpo{
                background-image: url("cancha.jpeg");
                background-repeat: no-repeat;
                background-size: cover;                              
                padding-top: 13px;
                padding-bottom: 55px;
                width: 100%;
                height: 550px;
                /*background: transparent;*/
                overflow-y: auto;
                overflow-x: hidden;
            }
            
            .pie{
                margin-top:55px;
                width:100%;
                height: 13px;
                text-align:center;
            }
            button{
                padding: 5px;
                border: 0;
                border-radius: 3px;
            }
 

            .dialog_mss{
                top: 150px;
                width:50%;
                height:300px;
                padding:25px;
                border: solid 1px black;
                box-shadow: 4px 3px 8px 1px #969696;
                /*background: #c1cae0;*/
                background-image: url('catar.png');
                background-repeat: no-repeat;
                background-size: 100% 400px;                 
                color:white;
                font-weight:bold;
                text-transform:uppercase;
                border-radius: 5px;
                z-index: 1100;
            }            

            .dialog_mss a{
                color:red;
                font: size 16px;
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
            footer{
                color: white;
                font-family: 'Oswald', sans-serif;
                width: 100%;
                background: #111;
                z-index: -100;
                position: absolute;
                margin-top:5px;
            }
            .content{
                padding:8px;
            }

            body{
                background: black;
                margin: 0;
                font-family: Arial, Helvetica, sans-serif; 
                font-weight:bold;                
                /*background-image: url("cancha.jpeg");
                background-repeat: no-repeat;
                background-size: cover;                */
            }

            a{
                padding:3px;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
                color: white;
            }

            a:hover{
                text-decoration:underline;
            }

            .datcajero{
                width:300px;
                font-weight:bold; 
                padding:2px;
                background:white;
                color:black; 
                outline:0;
                border: 0;
                border-radius: 3px;               
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

                .dialog_mss{
                    top: 80px;
                    width:80%;
                    height:250px;
                }                  
            }   

/*Menu*/            
.topnav {
    z-index: 1000;
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

.topnav .icon {
  display: none;
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

/*function myFunction() {
                var copyText = document.getElementById("cajero");
                copyText.select();
                copyText.setSelectionRange(0, 99999); 
                navigator.clipboard.writeText(copyText.value);
            }*/

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
                        document.getElementById("actualsaldo").value = datos.saldo; 
                        document.getElementById("cantidad").max = datos.saldo;
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

            function leerJuegos(){
                $.get("block?getJugadas=", function(data){
                $("#vista").html(data);
                });
            }

            function bloque(){
                alert("Juego Cerrado");
            }

            function initsession(){
                window.location.href="sesion";
            }

            function trade(id){                
                if((document.getElementById("actualsaldo").value *1) > 0 ){
                    
                    $.get("block?datosJuego&idjuego="+id,
                    function(data){                        
                        var datos= JSON.parse(data);
                        $("#calculo").html("");
                        $("#apuesta").html("");                        
                        /*$("#info").html("");*/
                        /*$("#detalles").css("display","none");*/
                        $("#equipos").html("<option id='equipos_back'></option><option value='"+datos.equipo1+"'>"+datos.equipo1+"</option><option value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option>Empate</option>");
                        if(datos.desafio == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox4)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }
                        if(datos.desafiox1_5 == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox1_5)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }
                        if(datos.desafiox3 == 1){
                            $("#equipos").html("<option id='equipos_back'></option><option value='(desafiox3)"+datos.equipo1+"'>"+datos.equipo1+" (Desafio Fortuna Royal)</option><option disabled value='"+datos.equipo2+"'>"+datos.equipo2+"</option><option disabled value='Empate'>Empate</option>");
                        }                                        
                        document.getElementById("desafiox1_5").value = datos.desafiox1_5;
                        document.getElementById("desafiox3").value = datos.desafiox3;
                        document.getElementById("desafiox4").value = datos.desafio;
                        document.getElementById("idjugada").value = datos.id;
                        document.getElementById("cantidad").value=0;
                        /*document.getElementById("cantidad").max = datos.max;*/
                        document.getElementById("referencia").value = datos.referencia; 
                        /*document.getElementById("emailCajero").value = datos.cajero;*/
                        document.getElementById("eljuego").value =  datos.id;
                        $("#equipos").css("display","inline-block");
                        /*document.getElementById("este").selected = true;*/
                        document.getElementById("jugar").disabled = false;
                        /*document.getElementById("nota").value="";*/
                        /*document.getElementById("comopago_back").selected = true;*/
                        document.getElementById("equipos_back").selected = true;
                        document.getElementById('jugada').show();
                    });
                }else{
                    alert("Saldo No Disponible");
                }

            }

            function setTipo(){
                if($("#equipos").val() == "Empate"){
                    document.getElementById('tipo').value = "Empate";
                }
                else{
                    document.getElementById('tipo').value = "Ganador";
                }                
            }

           /* function selpago(){
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
                    });
                }                
            }*/

            function jugar_back(){
                if((document.getElementById("cantidad").value *1) > 0 && (document.getElementById("cantidad").value *1) <= (document.getElementById("actualsaldo").value *1)){
                    lanzar();
                }
                else{
                    alert("Sin Apuesta Minima o Saldo no disponible..!");
                }          
            }

            function lanzar(){
                if(document.getElementById("equipos").value.length>0){
                    document.getElementById("jugar").disabled = true;
                $.post("block",{
                        jugar:"",
                        cantidad: document.getElementById("cantidad").value,
                        equipos: document.getElementById("equipos").value,
                        tipo: document.getElementById("tipo").value,
                        wallet_usdt: document.getElementById("wallet_usdt").value,
                        wallet_payeer: document.getElementById("wallet_payeer").value,
                        eljuego: document.getElementById("eljuego").value,
                        correo: document.getElementById("correo").value,
                        referencia: document.getElementById("referencia").value
                    },function(data){
                        document.getElementById('jugada').close();
                        leerDatos();
                        if(data.length>0){
                            alert(data);
                        }
                    });  
                }else{
                    alert("No hay Jugada a Realizar...");
                }         
            }

            function calculo(){
                var ganancia=0;
                ganancia = document.getElementById("cantidad").value *2;
                if($("#desafiox1_5").val() == 1){
                    ganancia = document.getElementById("cantidad").value *1.5;
                }
                if($("#desafiox3").val() == 1){
                    ganancia = document.getElementById("cantidad").value *3;
                }                
                if($("#desafiox4").val() == 1){
                    ganancia = document.getElementById("cantidad").value *4;
                }                
                $("#calculo").html("Usted Gana: "+ ganancia + "USDT");                
                $("#apuesta").html(document.getElementById("cantidad").value);
            }
             
            function inicio(){                
                leerJuegos();
                leerDatos();
                myVar = setInterval(leerJuegos, 3000);
            }
        </script>
    </header>
    <body onload="inicio()">
        <div id="cabeza" class="cabeza">
            <marquee><?php verPromo(); ?></marquee>
            <?php
            if(!isset($_SESSION['user'])){
                echo "<a style=\"color:yellow;\" href='sesion'>Jugar / Registrarse</a>";
            }else{
                if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 0){                                   
                    echo "<div class=\"topnav\" id='myTopnav'>";
                    echo "<a href='index' class='active'>Home</a>";
                    echo "<a href='chat' >Chat</a>";
                    echo "<a href='miwallet'>Mi Wallet</a>";
                    echo "<a href='referidos'>Referidos</a>";
                    echo "<a href='historialcliente'>Historial</a>";
                    echo "<a href='ayuda'>Ayuda</a>";
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
                    echo "<a style='cursor:pointer;' href='miwallet' class='saldo' id='saldo'></a>";
                    echo "<a class='perfil'>".readClienteId($_SESSION['user'])['CORREO']."</a>";
                    echo "<a href=\"javascript:void(0);\" class='icon' onclick=\" myFunctionMenu();\"><i class='fa fa-bars'></i></a></div>";
                }
                else if(isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
                    echo "<a href='historialadmin'>Historial</a>";
                    echo "<a href='trabajos'>Trabajos</a>";
                    echo "<a href='jugadas'>Jugadas</a>";
                    echo "<a href='promo'>Promociones</a>";
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a><br>";                    
                }                    
            }            
            ?>            
        </div>
        
        <?php
           if(!isset($_SESSION['user'])){
            echo "<div id=\"cuerpo\" class=\"cuerpo\">
            <div id=\"vista\" class=\"grid-container app-grid\"></div>
        </div>";
            promoFlotante();
        }else{
            promoFlotante();
        
        ?>        
        <dialog class="dialog_agregar" id="agregar" close>            
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('agregar').close()">X</a><br>            
            Esta Direccion sera Utlizada para los pagos de tus premios, asegurate que sea correcta,
            Fortuna Royal no se hace responsable por perdidas.<br>
            Wallet USDT TRC20:<br> <input style="width:300px;" type="text" id="wallet"><br>
            ID Payeer: <br> <input style="width:300px;" type="text" id="payeer"><br>
            <button id="guardar" class='appbtn' style="float:right;" type="button" onclick="guardar()">Guardar</button>
        </dialog>
        <dialog class="dialog_agregar" id="jugada" close>
            <a title="Cerrar" style="font-weight: bold;float:right;cursor:pointer;" onclick="document.getElementById('jugada').close()">X</a><br>
            <form method="post" action="index">
                <input hidden type="number" id="actualsaldo">
                <input type="hidden" value="<?php echo readClienteId($_SESSION['user'])['CORREO']; ?>" name="correo" id="correo">
                <input type="hidden" name="idjugada" id="idjugada" >
                <input type="hidden" name="cliente" id="cliente">
                <input type="hidden" name="eljuego" id="eljuego">
                <input type="hidden" name="referencia" id="referencia">
                <!--<input type="hidden" name="emailCajero" id="emailCajero">-->
                <input type="hidden" name="wallet_usdt" id="wallet_usdt">
                <input type="hidden" name="wallet_payeer" id="wallet_payeer">
                <input type="hidden" name="desafiox1_5" id="desafiox1_5">
                <input type="hidden" name="desafiox3" id="desafiox3">
                <input type="hidden" name="desafiox4" id="desafiox4">
                Selecciona tu Equipo o Jugada: <select onchange="setTipo()" required name="equipos" id="equipos"></select><br>
                <input hidden type="text" id="tipo" name="tipo"><br>
                <!--Como Vas a Pagar: <select required onchange="selpago()" name="comopago" id="comopago"><option id="comopago_back" value=""></option><option value="USDT">USDT Tron Trc20</option><option value="PAYEER">Payeer</option></select>-->
                <div id="detalles" >
                    Cantidad a Jugar: <input required type="number" name="cantidad" id="cantidad" onkeyup="calculo()" onchange="calculo()" value="0" min="1" max="50" step="1"><br>
                    <div id="calculo" style="color:green;float:right; background:white;padding:3px; border-radius:3px;"></div><br>
                    <!--Envia <span id="apuesta"></span><span id="info"></span>
                    <input readonly class="datcajero" style="" id="cajero">
                    <button title="Has Click para copiar" type="button" style="border:0;cursor:pointer;" onclick="myFunction()"><i class="far fa-copy"></i></button>
                    <br>
                    Coloca la Nota Id (txid) de la transferencia realizada:<br>
                    <input required type="text" id="nota" name="nota">-->
                </div><br>
                <button onclick="jugar_back()" class='appbtn' style="float:right;" type="button" id="jugar" name="jugar">Jugar</button>
            </form>
        </dialog>        
        <div id="cuerpo" class="cuerpo">
            <div id="vista" class="grid-container app-grid"></div>
        </div>
        <?php
        }
        ?>      

    <footer>
        <div class="content">
            <h2>Acerca De</h2>
            <p>Fortuna Royal es una página de juegos y competición creada con el propósito de entretener y relajarte, puedes hacer dinero mientras juegas!</p>
        </div>
            <center>  Red Triangle Corp@2022 All rights reserved.   </center>
    </footer>

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
