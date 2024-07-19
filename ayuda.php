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
                padding:21px; 
            }

            .pie{
                width:100%;
                height: 13px;
                text-align:center;
            }
            button{

            }
            p a{
                padding:3px;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
                color:yellow;
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
            
            .tatiana{
                display:block;
                padding:8px;
                background: #051716;
                border 1px solid black;
                border-radius:3px;
                width:80%;
            }

            ul li{
                padding:5px;
            }

            ul li a{
                color: yellow;
            }

            .tatiana a{
                color: yellow;
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



            function inicio(){
                leerDatos();
                
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
        <div id="cabeza" class="cabeza">
        <marquee><?php verPromo(); ?></marquee>
        <?php 
                    echo "<div class=\"topnav\" id='myTopnav'>";
                    echo "<a href='index' >Home</a>";
                    echo "<a href='chat' >Chat</a>";
                    echo "<a href='miwallet'>Mi Wallet</a>";
                    echo "<a href='referidos'>Referidos</a>";
                    echo "<a href='historialcliente'>Historial</a>";
                    echo "<a href='ayuda' class='active'>Ayuda</a>";
                    echo "<a href='block?cerrarSesion'>Cerrar Sesion</a>"; 
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
            <h2>Ayuda Fortuna Royal</h2>
            <hr>
        <div class="vista" id="vista">
            <p>
            Para Jugar en Fortuna Royal, Necesitas tener USDT o Payeer te dejamos los vídeos tutoriales de como debes de registrate en las 
            plataformas mas populares y fáciles de utilizar.<br>
                <br><div class="tatiana"><a target='_blanck' href="https://youtu.be/Vm1iEeaPfNU">💰 COMO RETIRAR/ENVIAR Y DEPOSITAR/RECIBIR EN BINANCE USDT POR TRC20 💰</a></div> 
                <br><div class="tatiana"><a target='_blanck' href="https://youtu.be/Z8Kvgky-2j4">( PAYEER ) COMO RETIRAR, DEPOSITAR, HACER CAMBIO DE MONEDAS, TODO SOBRE PAYEER</a></div>
                <br><br>
                <p>
                También puedes registrate con nuestros link seguros:
                    <ul>
                        <li>Binance <a target='_blanck' href="https://www.binance.com/en/activity/referral/offers/claim?ref=CPA_00XHZCNLGA">Registrate Aqui</a></li>
                        <li>Payeer <a target='_blanck' href="https://payeer.com/?session=5713319">Registrate Aqui</a></li>
                    </ul>

                </p>

            </p>
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